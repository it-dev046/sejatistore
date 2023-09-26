<?php

namespace App\Controllers;

use CodeIgniter\Session\Session;

class UserController extends BaseController
{

    protected $session;

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        $data = [
            'title' => 'Halaman User',
            'daftar_user' => $this->UserModel->orderBy('id', 'DESC')->findAll()
        ];
        // var_dump($data);
        return view('admin/user/index', $data);
    }

    public function store()
    {
        //simpan data le database
        $data = [
            'name' => esc($this->request->getPost('name')),
            'email' => esc($this->request->getPost('email')),
            'password' => esc($this->request->getPost('password')),
            'level' => esc($this->request->getPost('level'))
        ];

        $save = $this->UserModel->insert($data);

        if ($save) {
            session()->setFlashdata('success', 'Register Berhasil!');
            return redirect()->back();
        } else {
            session()->setFlashdata('error', $this->UserModel->errors());
            return redirect()->back();
        }
    }

    public function update($id)
    {
        //simpan data ke database
        $data = [
            'email' => esc($this->request->getPost('email'))
        ];

        $save = $this->UserModel->update($id, $data);

        if ($save) {
            session()->setFlashdata('success', 'Data User Berhasil Diubah!');
            return redirect()->back();
        } else {
            session()->setFlashdata('error', $this->UserModel->errors());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        // Hapus data
        $this->UserModel->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data User Berhasil Dihapus');
    }

    public function password()
    {
        $data = [
            'title' => 'Halaman Ubah Password'
        ];

        return view('admin/user/password', $data);
    }

    public function changePassword()
    {
        $passlama = $this->request->getPost('passlama');
        $passbaru = $this->request->getPost('passbaru');
        $userId = $this->session->get('id');
        $user = $this->UserModel->where('id', $userId)->first();

        $passwordCheck = password_verify($passlama, $user['password']);

        if (!$passwordCheck) {
            return redirect()->back()->with('success', 'Password tidak sesuai');
        }

        //simpan data ke database
        $hashedPassword = password_hash($passbaru, PASSWORD_DEFAULT);
        $data = [
            'password' => $hashedPassword
        ];
        $this->UserModel->update($userId, $data);

        return redirect()->to(base_url('logout'))->with('success', 'Password berhasil diubah');
    }
}
