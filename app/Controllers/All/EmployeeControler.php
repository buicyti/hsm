<?php

namespace App\Controllers\All;
use App\Controllers\BaseController;
use App\Models\Auth;
use App\Models\EmployeeModels;

use \Hermawan\DataTables\DataTable;

class EmployeeControler extends BaseController{
    public array $nav = [
        array(
        'name' => 'Home',
        'url' => '/all/employees',
        'icon' => 'fa-solid fa-house-laptop',
        ),
        array(
            'name' => 'Admin',
            //'url' => '/all/employees/hrm',
            'icon' => 'fa-solid fa-house-laptop',
            'children' => [
                array(
                'name' => 'Dashboard',
                //'url' => '/dashboard',
                'icon' => 'fa-solid fa-chart-line',
                'children' => [
                    array(
                    'name' => 'hí',
                    'url' => '/dashboard',
                    'icon' => 'fa-solid fa-chart-line'
                    ),
                    array(
                        'name' => 'hesssss',
                        'url' => '/dashboard/sdsd',
                        'icon' => 'fa-solid fa-chart-line'
                    )]
                ),
                array(
                    'name' => 'Dashboard',
                    'url' => '/dashboard',
                    'icon' => 'fa-solid fa-chart-line'
                )]
        )];
    public function index() {  
        $auth = new Auth();
        $employees = new EmployeeModels();

        $dataView['nav'] = $this->nav;
        $dataView['title'] = 'Danh sách nhân viên';
        $dataView['breadcrumb'] = ['Nhân viên', 'Thông tin', 'Danh sách'];
        $dataView['info'] = $auth->getUserInfomation();
        $dataView['part'] = $employees->getPart();
        
        echo view('includes/header', $dataView); 
        echo view('includes/top'); 
        echo view('All/Employees/Home');
        echo view('includes/footer'); 
    }
    public function viewInfomation($id) {
        $auth = new Auth();
        $employees = new EmployeeModels();

        $dataView['nav'] = $this->nav;
        $dataView['title'] = 'Xem thông tin';
        $dataView['breadcrumb'] = ['Nhân viên', 'Thông tin', 'Xem'];
        $dataView['info'] = $auth->getUserInfomation();
        $dataView['id'] = $id;
        $dataView['mode'] = 'infomation';
        $dataView['employees'] = $employees->getIDEmployees($id);

        if($dataView['employees'] == null)//nếu không tìm thấy thông tin thì quay lại và in thông báo
            return redirect()
                ->back()
                ->with('msg_error', 'Không tìm thấy thông tin hoặc bạn không có quyền xem thông tin của nhân viên này!');
                
        echo view('includes/header', $dataView); 
        echo view('includes/top'); 
        echo view('All/Employees/Info');
        echo view('includes/footer'); 
    }

    public function editInfomation($id) {
        $auth = new Auth();
        $employees = new EmployeeModels();

        $dataView['nav'] = $this->nav;
        $dataView['title'] = 'Chỉnh sửa thông tin';
        $dataView['breadcrumb'] = ['Nhân viên', 'Thông tin', 'Sửa'];
        $dataView['info'] = $auth->getUserInfomation();
        $dataView['id'] = $id;
        $dataView['mode'] = 'edit';
        $dataView['employees'] = $employees->getIDEmployees($id);

        if($dataView['employees'] == null)//nếu không tìm thấy thông tin thì quay lại và in thông báo
            return redirect()
                ->back()
                ->with('msg_error', 'Không tìm thấy thông tin hoặc bạn không có quyền xem thông tin của nhân viên này!');

        echo view('includes/header', $dataView); 
        echo view('includes/top'); 
        echo view('All/Employees/Edit');
        echo view('includes/footer'); 
    }

    public function historyInfomation($id) {
        $auth = new Auth();
        $employees = new EmployeeModels();

        $dataView['nav'] = $this->nav;
        $dataView['title'] = 'Lịch sử hoạt động của nhân viên';
        $dataView['breadcrumb'] = ['Nhân viên', 'Thông tin', 'Lịch sử'];
        $dataView['info'] = $auth->getUserInfomation();
        $dataView['id'] = $id;
        $dataView['mode'] = 'history';
        $dataView['employees'] = $employees->getIDEmployees($id);

        if($dataView['employees'] == null)//nếu không tìm thấy thông tin thì quay lại và in thông báo
            return redirect()
                ->back()
                ->with('msg_error', 'Không tìm thấy thông tin hoặc bạn không có quyền xem thông tin của nhân viên này!');

        echo view('includes/header', $dataView); 
        echo view('includes/top'); 
        echo view('All/Employees/History');
        echo view('includes/footer'); 
    }

    public function permissionInfomation($id) {
        $auth = new Auth();
        $employees = new EmployeeModels();


        $dataView['nav'] = $this->nav;
        $dataView['title'] = 'Quyền truy cập';
        $dataView['breadcrumb'] = ['Nhân viên', 'Thông tin', 'Quyền'];
        $dataView['info'] = $auth->getUserInfomation();
        $dataView['id'] = $id;
        $dataView['mode'] = 'permission';
        $dataView['employees'] = $employees->getIDEmployees($id);

        if($dataView['employees'] == null)//nếu không tìm thấy thông tin thì quay lại và in thông báo
            return redirect()
                ->back()
                ->with('msg_error', 'Không tìm thấy thông tin hoặc bạn không có quyền xem thông tin của nhân viên này!');

        echo view('includes/header', $dataView); 
        echo view('includes/top'); 
        echo view('All/Employees/Permission');
        echo view('includes/footer'); 
    }

    public function datatablesEmployees()
    {
        $employees = new EmployeeModels();
        $part = $employees->getPart();
        $builder = $employees->select('ROW_NUMBER() OVER (ORDER BY id ASC) AS id_no, id,id_employee,name_employee,gender,birthday,join_date,class,rank,rank_no,title,part, factory,shift, job,phone1,phone2,residence,temporary_residence,cccd,school,specialized,raduation_year')
            ->whereIn('part', $part);

        return DataTable::of($builder)
        //lọc dữ liệu
        ->filter(function ($builder, $request) {
            //nếu giá trị tìm kiếm được nhập
            if ($request->searchTable)
                $builder->like('name_employee', $request->searchTable, 'before')->orLike('id_employee', $request->searchTable);
            //nếu có giá trị part được nhập
            if ($request->filterPart)
                $builder->whereIn('part', $request->filterPart);
        })
        ->add('avatar_url', function($row){
            return (new EmployeeModels())->checkAvatar($row->id_employee);
        })
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
            return '<span class="btn btn-sm" style="color: var(--bs-body-color);" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-regular fa-pen-to-square"></i></span>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="'. base_url('all/employees/infomation/') . $row->id_employee .'">Xem</a></li>
                        <li><a class="dropdown-item" href="'. base_url('all/employees/edit/') . $row->id_employee .'">Sửa thông tin</a></li>
                    </ul>' ;
        })
        //in ra với json
        ->toJson(true);
    }

}