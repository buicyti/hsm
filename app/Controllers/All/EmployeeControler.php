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
        $data['nav'] = $this->nav;

        $auth = new Auth();
        $employees = new EmployeeModels();
        $data['info'] = $auth->getUserInfomation();

        $data['part'] = $employees->getPart();
        

        

        echo view('includes/header'); 
        echo view('includes/top', $data); 
        echo view('All/Employees/Home');
        echo view('includes/footer'); 
    }
    public function viewInfomation($id) {
        $data['nav'] = $this->nav;
        $data['title'] = 'Xem thông tin';
        $data['breadcrumb'] = ['Nhân viên', 'Thông tin', 'Xem'];

        $auth = new Auth();
        $employees = new EmployeeModels();

        $data['info'] = $auth->getUserInfomation();
        $data['id'] = $id;
        $data['mode'] = 'infomation';
        $data['employees'] = $employees->getIDEmployees($id);

        echo view('includes/header'); 
        echo view('includes/top', $data); 
        echo view('All/Employees/Info');
        echo view('includes/footer'); 
    }

    public function editInfomation($id) {
        $data['nav'] = $this->nav;
        $data['title'] = 'Chỉnh sửa thông tin';
        $data['breadcrumb'] = ['Nhân viên', 'Thông tin', 'Sửa'];
        $auth = new Auth();
        $employees = new EmployeeModels();

        $data['info'] = $auth->getUserInfomation();
        $data['id'] = $id;
        $data['mode'] = 'edit';
        $data['employees'] = $employees->getIDEmployees($id);

        echo view('includes/header'); 
        echo view('includes/top', $data); 
        echo view('All/Employees/Edit');
        echo view('includes/footer'); 
    }

    public function historyInfomation($id) {
        $data['nav'] = $this->nav;
        $data['title'] = 'Lịch sử hoạt động của nhân viên';
        $data['breadcrumb'] = ['Nhân viên', 'Thông tin', 'Lịch sử'];

        $auth = new Auth();
        $employees = new EmployeeModels();

        $data['info'] = $auth->getUserInfomation();
        $data['id'] = $id;
        $data['mode'] = 'history';
        $data['employees'] = $employees->getIDEmployees($id);

        echo view('includes/header'); 
        echo view('includes/top', $data); 
        echo view('All/Employees/History');
        echo view('includes/footer'); 
    }

    public function permissionInfomation($id) {
        $data['nav'] = $this->nav;
        $data['title'] = 'Quyền truy cập';
        $data['breadcrumb'] = ['Nhân viên', 'Thông tin', 'Quyền'];

        $auth = new Auth();
        $employees = new EmployeeModels();

        $data['info'] = $auth->getUserInfomation();
        $data['id'] = $id;
        $data['mode'] = 'permission';
        $data['employees'] = $employees->getIDEmployees($id);

        echo view('includes/header'); 
        echo view('includes/top', $data); 
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
        ->filter(function ($builder, $request) {
            
            if ($request->searchTable)
                $builder->like('name_employee', $request->searchTable, 'before')->orLike('id_employee', $request->searchTable);
            if ($request->filterPart)
                $builder->whereIn('part', $request->filterPart);
        })
        ->add('name_and_id', function($row){
            $filename = ROOTPATH . 'public\\images\\avatars\\' . $row->id_employee . '.jpg';
            if (file_exists($filename))
                $avatar = base_url('public/images/avatars/' . $row->id_employee . '.jpg');
            else
                $avatar = base_url('public/images/default/default-user-icon.png');

            return '<div class="d-flex align-items-center">
                        <img src="'. $avatar .'" class="avatar rounded-circle" alt="'. $row->name_employee. '" />
                        <div class="d-flex flex-column text-start">
                            <strong>'. $row->name_employee. '</strong>
                            <span>'. $row->id_employee. '</span>
                        </div>
                    </div>';
        })
        ->add('action', function($row){
            return '<span class="btn btn-sm" style="color: var(--bs-body-color);" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-regular fa-pen-to-square"></i></span>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="'. base_url('all/employees/infomation/') . $row->id_employee .'">Xem</a></li>
                        <li><a class="dropdown-item" href="'. base_url('all/employees/edit/') . $row->id_employee .'">Sửa thông tin</a></li>
                    </ul>' ;
        })
        ->toJson(true);
    }


}