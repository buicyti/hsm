<?php 
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Permissions implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        /* if (!session()->get('isLoggedIn'))
        {
            return redirect() -> to('/auth/signin');
        }
        
        return; */
        return redirect() -> to ('?back=' . implode($arguments) );
        //không làm gì cả
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //không làm gì cả
    }
}