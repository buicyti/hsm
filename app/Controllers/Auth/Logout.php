<?php

namespace App\Controllers\Auth;
use App\Controllers\BaseController;

class Logout extends BaseController
{
    public function logoutAuth() {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/auth/signin'));
    }
}