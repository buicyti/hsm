<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class EmployeeModels extends Model{
    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_employee',
        'name_employee',
        'gender',
        'birthday',
        'join_date',
        'class',
        'rank',
        'rank_no',
        'title',
        'part',
        'factory',
        'shift',
        'phone1',
        'phone2',
        'residence',
        'temporary_residence',
        'cccd',
        'school',
        'specialized',
        'raduation_year',
        'tuyen_xe',
        'diem_don',
        'created_at'
    ];

    

    public function checkAvatar($id){
        $filename = ROOTPATH . 'public\\images\\avatars\\' . $id . '.jpg';
        if (file_exists($filename))
            return base_url('public/images/avatars/' . $id . '.jpg');
        else
            return base_url('public/images/default/default-user-icon.png');
    }

    public function getIDEmployees($id){
        $employee = $this->select('*')
        ->whereIn('part', $this->getPart())
        ->where('id_employee', $id)
        ->get()
        ->getRowArray();

        if($employee != null) $employee['avatar_url'] = $this->checkAvatar($employee['id_employee']); //nếu có dữ liệu thì kiểm tra xem có ảnh đại diện không
        
        return $employee;
    }

    
    public function getPart(){
        $my_user = session()->get('name');
        $arrGroup = ['superadmin'];//liệt kê các nhóm đc lấy tất cả tên part
        $group = new GroupModels();

        if($group->isGroups($arrGroup)){
            $query = $this->select('part')
            ->groupBy('part')
            ->get();
        }
        else{//nếu sai thì lấy tên part của nhóm mình
            $query = $this->db->table('employees')
            ->select('part')
            ->join('auth_accounts', 'auth_accounts.id_employee = employees.id_employee', 'LEFT')
            ->where('auth_accounts.user_name', $my_user)
            ->groupBy('part')
            ->get();
        }

        $data = [];
        foreach($query->getResultArray() as $row){
            $data[] = $row['part'];
        }
        
        return $data;
    }

}