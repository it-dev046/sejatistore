<?php

namespace App\Controllers;

class LogoutController extends BaseController
{
    public function index()
    {

        $userData = [
            'name',
            'email',
            'logged_in'
        ];

        session()->remove($userData);
        session()->remove('isLoggedIn');
        session()->remove('id');
        session()->remove('level');
        session()->remove('status');

        return redirect()->to(base_url('login'));
    }

    //--------------------------------------------------------------------

}
