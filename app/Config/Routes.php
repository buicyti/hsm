<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
$routes->get('/', 'Home::index' , ['filter' => 'auth']);


$routes->group('/auth', ['namespace' => 'App\Controllers\Auth'], function ($routes) {
    $routes->get('/', 'Login::index');
    $routes->get('signin', 'Login::index');
    $routes->get('signout', 'Logout::logoutAuth');
    $routes->post('signin/loginSubmit', 'Login::submitLogin');
});

$routes -> group('all', ['filter' => 'auth'], function($routes){
    $routes->group('employees', ['namespace' => 'App\Controllers\All', 'filter' => 'groups:superadmin, all, employees'], function($routes){
        $routes->get('/', 'EmployeeControler::index');
        //$routes->get('infomation', 'EmployeeControler::viewInfomation1');
        $routes->get('infomation/(:num)', 'EmployeeControler::viewInfomation/$1');
        $routes->get('edit/(:num)', 'EmployeeControler::editInfomation/$1');
        $routes->get('history/(:num)', 'EmployeeControler::historyInfomation/$1');
        $routes->get('permission/(:num)', 'EmployeeControler::permissionInfomation/$1', ['filter' => 'groups:superadmin']);
        $routes->post('query', 'EmployeeControler::datatablesEmployees');
    });
    
    $routes->group('esd', ['namespace' => 'App\Controllers\All', 'filter' => 'groups:superadmin, all, esd'], function($routes){
        $routes->get('/', 'ESDControler::index');
    });
    //$routes->get('esd', 'ESD\Home::index');
});