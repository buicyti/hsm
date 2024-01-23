<?php

namespace App\Controllers\Auth;
use App\Controllers\BaseController;
use App\Models\Auth;
use App\Models\EmployeeModels;

class Setting extends BaseController
{
    public function index()
    {   
        $auth = new Auth();
        $employees = new EmployeeModels();

        //$dataView['nav'] = $this->nav;
        $dataView['title'] = 'Cài đặt tài khoản';
        $dataView['breadcrumb'] = ['Cá nhân', 'Cài đặt', 'Cài đặt'];
        $dataView['info'] = $auth->getUserInfomation();
        $dataView['part'] = $employees->getPart();
         
        echo view('includes/header', $dataView);
        echo view('includes/top');
        echo view('includes/breadcrumb'); 
        echo view('Auth/Setting');
        echo view('includes/footer');
    }

    public function changepassword(){
        $post = $this->request->getPost();
        $data = (new Auth())->where('user_name', session()->get('name'))->first();
        //kiểm tra đầu vào
        $rules = [
            'password_old' => [
                'label' => "Mật khẩu", 
                'rules' => 'required|min_length[6]|max_length[32]',
                'errors' => [
                    'required' => 'Vui lòng nhập mật khẩu',
                    'min_length' => 'Độ dài của mật khẩu tối thiểu là 6',
                    'max_length' => 'Độ dài của mật khẩu tối đa là 32'
                ]
            ],
            'password_new' => [
                'label' => "Mật khẩu", 
                'rules' => 'required|min_length[6]|max_length[32]|differs[password_old]',
                'errors' => [
                    'required' => 'Vui lòng nhập mật khẩu',
                    'min_length' => 'Độ dài của mật khẩu tối thiểu là 6',
                    'max_length' => 'Độ dài của mật khẩu tối đa là 32',
                    'differs' => 'Mật khẩu mới giống mật khẩu cũ'
                ]
            ],
            'password_re_new' => [
                'label' => "Mật khẩu", 
                'rules' => 'required|min_length[6]|max_length[32]|matches[password_new]',
                'errors' => [
                    'required' => 'Vui lòng nhập mật khẩu',
                    'min_length' => 'Độ dài của mật khẩu tối thiểu là 6',
                    'max_length' => 'Độ dài của mật khẩu tối đa là 32',
                    'matches' => 'Mật khẩu nhập lại không giống mật khẩu mới'
                ]
            ]   
        ];


        if($this->validate($rules)){
            if(password_verify($post['password_old'], $data['user_pass'])){
                $builder = new Auth();
                $builder->set('user_pass', password_hash($post['password_new'], PASSWORD_BCRYPT));
                $builder->where('user_name', session()->get('name'));
                $builder->update();
                return redirect()
                ->back()
                ->with('msg_success', 'ÔK!');
            }
            else{
                return redirect()
                    ->back()
                    ->with('msg_error', 'Sai mật khẩu!');
            }  
            
        
        }
        else{
            return redirect()
                ->back()
                ->with('msg_error', $this->validator->listErrors());
        
        }
    }
    
    /* public function submitLogin()
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
    } */
}