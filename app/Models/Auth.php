<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class Auth extends Model{
    protected $table = 'auth_accounts';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_name',
        'user_pass',
        'id_employee',
        'user_status',
        'user_active',
        'created_at',
        'updated_at',
        'tokens'
    ];


    public function getUserInfomation(){
        $my_user = session()->get('name');//lấy session `name` là tên tài khoản

        $data =  $this->select('employees.id_employee, name_employee, job')
        ->join('employees', 'auth_accounts.id_employee = employees.id_employee', 'LEFT')
        ->where('auth_accounts.user_name', $my_user)
        ->get()
        //->getResultArray()[0];//lấy dòng đầu tiên in ra
        //->getResult();
        ->getRowArray();
        //kiêm tra link avatar
        $filename = ROOTPATH . 'public\\images\\avatars\\' . $data['id_employee'] . '.jpg';
        if (file_exists($filename))
            $data['avatar'] = base_url('public/images/avatars/' . $data['id_employee'] . '.jpg');
        else
            $data['avatar'] = base_url('public/images/default/default-user-icon.png');
        
        
        return $data;
    }

}