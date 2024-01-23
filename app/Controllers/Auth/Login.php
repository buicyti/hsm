<?php

namespace App\Controllers\Auth;
use App\Controllers\BaseController;
use App\Models\Auth;

class Login extends BaseController
{
    public function index()
    {
        //nếu đang đăng nhập rồi thì đăng xuất ra ngoài
        if (session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/auth/signout'));
        }
        
        return view('Auth/Login');
    }

    public function submitLogin()
    {
        helper('date');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $rules = [
            'username' => [
                'label' => "Tên tài khoản", 
                'rules' => 'required|min_length[4]|max_length[32]|alpha_numeric',//điều kiện nhập
                'errors' => [
                    'required' => 'Vui lòng nhập tên tài khoản',
                    'min_length' => 'Độ dài của tài khoản tối thiểu là 4',
                    'max_length' => 'Độ dài của tài khoản tối đa là 32',
                    'alpha_numeric' => 'Tên tài khoản chỉ là chữ hoặc số'
                ]
            ],
            'password' => [
                'label' => "Mật khẩu", 
                'rules' => 'required|min_length[6]|max_length[32]',
                'errors' => [
                    'required' => 'Vui lòng nhập mật khẩu',
                    'min_length' => 'Độ dài của mật khẩu tối thiểu là 6',
                    'max_length' => 'Độ dài của mật khẩu tối đa là 32'
                ]
                ]
        ];

        if($this->validate($rules)){
            $session = session();
            $auth = new Auth();
            $data = $auth->where('user_name', $username)->first();
            
            if($data){
                $authenticatePassword = password_verify($password, $data['user_pass']);
                if(!$authenticatePassword){
                    return $this->response->setJSON([
                        'error' => true,
                        'message' =>  'Sai mật khẩu!'
                    ]);
                }
                if($data['user_active'] != "1"){
                    return $this->response->setJSON([
                        'error' => true,
                        'message' =>  'Tài khoản chưa được kích hoạt hoặc đã bị khoá!'
                    ]);
                }
                if($authenticatePassword){
                    $ses_data = [
                        'name' => $data['user_name'],
                        'isLoggedIn' => TRUE
                    ];
                    $session->set($ses_data);
                    return $this->response->setJSON([
                        'error' => false
                    ]);

                }
            }
            else {
                return $this->response->setJSON([
                    'error' => true,
                    'message' => 'Không tồn tại tài khoản này!'
                ]);
            }
            
        }
        else{
            return $this->response->setJSON([
                'error' => true,
                'message' => $this->validator->listErrors() //lấy danh sách lỗi input của tên tài khoản và mật khẩu
            ]);
        }
    }
}