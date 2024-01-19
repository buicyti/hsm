<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class GroupModels extends Model{
    protected $table = 'auth_groups';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_name',
        'user_group',
        'created_at'
    ];


    public function checkGroups($arrGroup):bool{
        $my_user = session()->get('name');
        
        return $this->select('id')
        ->where('user_name', $my_user)
        ->whereIn('user_group', $arrGroup)
        ->countAllResults();
    }

}