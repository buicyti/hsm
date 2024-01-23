<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class PermissionModels extends Model{
    protected $table = 'auth_permissions';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_name',
        'user_permission',
        'created_at'
    ];


    //kiểm tra bản thân có quyền ko
    public function isPermissions($arrPermission):bool{
        $my_user = session()->get('name');
        
        return $this->select('id')
        ->where('user_name', $my_user)
        ->whereIn('user_permission', $arrPermission)
        ->countAllResults();
    }

}