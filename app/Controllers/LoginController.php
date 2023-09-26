<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Session\Session;

class LoginController extends BaseController
{
    protected $model;
    protected $session;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->helpers = ['form', 'url'];
        $this->session = session();
    }

    public function index()
    {
        if ($this->isLoggedIn()) {
            return redirect()->to(base_url('dashboard'));
        }

        $data = [
            'title' => 'Login Sejatistore.com'
        ];

        return view('auth/login', $data);
    }

    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $credentials = ['email' => $email];

        $user = $this->model->where($credentials)
            ->first();

        if (!$user) {
            session()->setFlashdata('error', 'Email atau password anda salah.');
            return redirect()->back();
        }

        $passwordCheck = password_verify($password, $user['password']);

        if (!$passwordCheck) {
            session()->setFlashdata('error', 'Email atau password anda salah.');
            return redirect()->back();
        }

        $this->session->set('id', $user['id']);
        $this->session->set('level', $user['level']);
        $this->session->set('status', 1);

        $this->session->set('isLoggedIn', true);

        $userdata = [
            'name' => $user['name'],
            'email' => $user['email'],
        ];

        session()->set($userdata);

        if ($user['level'] == 2) {
            return redirect()->to(base_url('dashboard-admin'));
        } elseif ($user['level'] == 3) {
            return redirect()->to(base_url('dashboard-drafter'));
        } elseif ($user['level'] == 4) {
            return redirect()->to(base_url('dashboard-survei'));
        } else {
            return redirect()->to(base_url('dashboard'));
        }
    }


    private function isLoggedIn(): bool
    {
        if (session()->get('logged_in')) {
            return true;
        }

        return false;
    }
}
