<?php 
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Permissions implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $auth = new GroupModels();
        if(!$auth->isPermissions($arguments))
            return redirect()
            ->back()
            ->with('msg_error', 'Bạn không có quyền thực hiện thao tác này.');

        // Nếu không, cho phép tiếp tục xử lý yêu cầu
        //return ;
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //không làm gì cả
    }
}