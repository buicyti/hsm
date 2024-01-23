<?php

namespace App\Controllers\Auth;
use App\Controllers\BaseController;
use App\Models\Auth;
use App\Models\EmployeeModels;
use App\Models\PermissionModels;

use \Hermawan\DataTables\DataTable;
class Permission extends BaseController{
    

    public function index() {  
        $auth = new Auth();
        $employees = new EmployeeModels();

        //$dataView['nav'] = $this->nav;
        $dataView['title'] = 'Phân quyền tài khoản';
        $dataView['breadcrumb'] = ['Phân quyền', 'Danh sách', 'Xem'];
        $dataView['info'] = $auth->getUserInfomation();

        $config = config('Variables');
        $dataView['GroupAndPermission'] = $config->GroupAndPermission;
        
        echo view('includes/header', $dataView); 
        echo view('includes/top'); 
        echo view('Permission/Home');
        echo view('includes/footer'); 
    }

    public function datatablesListEmp(){
        $db = db_connect();
        $config = config('Variables');
        $GroupAndPermission = $config->GroupAndPermission;
        
        $sub0 = ['id_employee', 'name_employee', 'user_active'];
        if(isset($GroupAndPermission)) foreach ($GroupAndPermission as $key => $value) {
            if($value['permission'] != null){
                foreach ($value['permission'] as $k => $val) {
                    $sub0[] = 'MAX(CASE WHEN user_permission = "'.$key . '.'. $k .'" THEN "1" ELSE "0" END) AS '.$key.$k;
                }
            }
            /* else {
                $sub0[] = 'MAX(CASE WHEN user_permission = "'.$key.'" THEN "1" ELSE "0" END) AS '.$key;//không có quyền gì thì là superadmin
            } */  
            
        }

        $sub1 = $db->table('auth_accounts')->select('id_employee');
        $sub2 = $db->table('auth_accounts as t1')
            ->select('t1.id_employee, t1.user_active, auth_permissions.user_permission, employees.name_employee')
            ->join('auth_permissions', 't1.user_name = auth_permissions.user_name', 'LEFT')
            ->join('employees', 't1.id_employee = employees.id_employee', 'INNER')
            ->whereIn('t1.id_employee', $sub1);
            
        $builder = $db->newQuery()->fromSubquery($sub2, 'tmp')
            ->select($sub0)
            ->groupBy(['id_employee', 'name_employee', 'user_active']);
            

            return DataTable::of($builder)
            //lọc dữ liệu
            ->filter(function ($builder, $request) {
                //nếu giá trị tìm kiếm được nhập
                //if ($request->searchTable)
                //    $builder->like('name_employee', $request->searchTable, 'before')->orLike('id_employee', $request->searchTable);
                //nếu có giá trị part được nhập
                /* if ($request->filterPart)
                    $builder->whereIn('part', $request->filterPart); */
            })
            /* ->add('avatar_url', function($row){
                return (new EmployeeModels())->checkAvatar($row->id_employee);
            }) */
            //thêm nội dung hiển thị ảnh tên và ID nhân viên
            ->add('name_and_id', function($row){
                
                return '<div class="d-flex align-items-center">
                            <img src="'. (new EmployeeModels()) -> checkAvatar($row->id_employee) .'" class="avatar rounded-circle" alt="'. $row->name_employee. '" />
                            <div class="d-flex flex-column text-start">
                                <strong>'. $row->name_employee. '</strong>
                                <span>'. $row->id_employee. '</span>
                            </div>
                        </div>';
            })
            //thêm cột thao tác
            ->add('action', function($row){
                return '<span class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-regular fa-pen-to-square"></i>
                        </span>
                        <ul class="dropdown-menu">
                            <li class="dropdown-item" ac="active"><i class="fa-solid fa-shield-halved"></i>'. ($row->user_active == "1" ? "Huỷ kích hoạt" : "Kích hoạt").'</li>
                            <li class="dropdown-item" ac="updatepermission"><i class="fa-solid fa-user-pen"></i> Cập nhật quyền</li>
                            <li class="dropdown-item" ac="resetpassword"><i class="fa-solid fa-user-lock"></i> Làm mới mật khẩu</li>
                            <li class="dropdown-item"><a href="'.base_url('permission/action/delete').'" class="text-danger"><i class="fa-regular fa-trash-can"></i> Xoá tài khoản</a></li>
                        </ul>' ;
            })
            ->addNumbering('no')
            ->toJson(true);
    }







    //các hành động trên bảng
    public function actionActive(){
        $id = $this->request->getGet('id');
        $id_key = $this->request->getGet('id_key');

        if($id_key == '0' || $id_key == '1' ){
            $builder = new Auth();
            $builder->set('user_active', $id_key);
            $builder->where('id_employee', $id);
            $kq = $builder->update();
    
            if($kq)
                return redirect()
                ->back()
                ->with('msg_success', 'Bạn đã kích hoạt thành công!');
            else 
                return redirect()
                ->back()
                ->with('msg_error', 'Không thể thay đổi trạng thái tài khoản!');
        }
        else
            return redirect()
            ->back()
            ->with('msg_error', 'Giá trị nhập vào có lỗi!');
        
    }

    public function actionUpdatePermission(){
        $json = $this->request->getPost();
        //lấy tên tài khoản của người được chọn
        $builder = new Auth();
        $data = $builder->where('id_employee', $json['id'])->first();
        if(!$data)
            return $this->response->setJSON([
                'status' => 'error',
                'msg' => 'Không tìm thấy tài khoản cần thay đổi'

            ]);
        //xoá tất cả quyền của user đi
        $builder = new PermissionModels();
        $builder->where('user_name', $data['user_name']);
        $builder->delete();
        //tạo vòng lặp để thêm lại các quyền được chọn
        $per = [];
        foreach ($json as $key => $value) {
            if($key != 'id' && $value == 'true')
                $per[] = array(
                    'user_name' => $data['user_name'],
                    'user_permission' => str_replace('_', '.',$key)
                );
        }
        if(!empty($per)){
            $builder = new PermissionModels();
            $builder->insertBatch($per);
        }
        return $this->response->setJSON([
            'status' => 'success',
            'msg' => 'Thay đổi quyền hạn thành công của ' . $data['user_name']

        ]);
    }

    public function actionResetPassword(){
        $id = $this->request->getGet('id');

        $builder = new Auth();
        $builder->set('user_pass', password_hash('abc123!', PASSWORD_BCRYPT));//PASSWORD_DEFAULT
        $builder->where('id_employee', $id);
        $kq = $builder->update();
    
            if($kq)
                return redirect()
                ->back()
                ->with('msg_success', 'Bạn đã lấy lại mật khẩu thành công! Mật khẩu mặc định là: abc123!');
            else 
                return redirect()
                ->back()
                ->with('msg_error', 'Không thể cấp lại mật khẩu!');
        
        
    }
}