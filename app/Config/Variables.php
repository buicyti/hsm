<?php 
namespace Config;
use CodeIgniter\Config\BaseConfig;

class Variables extends BaseConfig
{
    
    /**
     * tạo ma trận nhóm và quyền truy cập
     */
    public array $GroupAndPermission = [
        'superadmin' => [
            'title' => 'Supper Admin',
            'description' => 'Giới hạn quyền cao nhất',
            'permission' => null
        ],
        'employees' => [
            'title' => 'Nhân viên',
            'description' => 'Quyền thao tác với nhóm nhân viên',
            'permission' => [
                'admin' => [
                    'title' => 'Admin',
                    'description' => 'Toàn quyền quản lý mục nhân viên'
                ],
                'add' => [
                    'title' => 'Thêm',
                    'description' => 'Toàn quyền quản lý mục nhân viên'
                ],
                'edit' => [
                    'title' => 'Sửa',
                    'description' => 'Toàn quyền quản lý mục nhân viên'
                ],
                'del' => [
                    'title' => 'Xoá',
                    'description' => 'Toàn quyền quản lý mục nhân viên'
                ]
            ]
        ]
    ];
}