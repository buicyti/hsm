<?php 
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

use App\Models\GroupModels;
class Groups implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $auth = new GroupModels();
        if(!$auth->checkGroups($arguments))
            return redirect()
            //->to('')
            ->back()
            ->with('msg', 'Bạn không được phép truy cập vào mục này.');

        // Nếu không, cho phép tiếp tục xử lý yêu cầu
        //return ;
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //không làm gì cả
    }
}