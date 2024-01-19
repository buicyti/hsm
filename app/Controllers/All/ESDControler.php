<?php

namespace App\Controllers\All;
use App\Controllers\BaseController;
use App\Models\Auth;
//use App\Models\EmployeeModels;

class ESDControler extends BaseController{
    public function index()
    {  
        $employees = new Auth();
        /* $my_user = session()->get('name');


        $employees->table('auth_accounts')
        ->select('*')
        ->join('employees', 'auth_accounts.id_employee = employees.id_employee', 'LEFT')
        ->where('auth_accounts.user_name', $my_user);
        
        $query = $employees->get();

        $data['info'] = $query->getResultArray()[0]; */
        $data['info'] = $employees->getUserInfomation();


       /*  $data['info'] = $employees->where('employees.user_name', $my_user)
            ->join('employees', 'accounts.id_employee = employees.id_employee')
            ->get(); */

        echo view('includes/header'); 
        echo view('includes/top', $data); 
        echo view('All/ESD/Home');
        echo view('includes/footer'); 
    }
}