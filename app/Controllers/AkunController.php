<?php

namespace App\Controllers;

class AkunController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman User Setting'
        ];

        return view('admin/akun/index', $data);
    }

    public function changePassword()
    {
        $data = [];

        // Validasi form
        $validationRules = [
            'cekpass' => 'required',
            'passbaru' => 'required|min_length[6]',
            'passbaru' => 'required|matches[passbaru]'
        ];

        if ($this->validate($validationRules)) {
            // Form valid, lanjutkan dengan mengubah password
            $currentPassword = $this->request->getPost('cekpass');
            $newPassword = $this->request->getPost('passbaru');

            // Dapatkan data pengguna yang sedang login (misalnya menggunakan session)
            $userId = session()->get('id');
            $userModel = new UserModel();
            $user = $userModel->find($userId);

            // Verifikasi password saat ini
            if (password_verify($currentPassword, $user['password'])) {
                // Password valid, update password baru
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                $userModel->update($userId, ['password' => $hashedPassword]);

                // Tambahkan pesan sukses
                session()->setFlashdata('success', 'Password berhasil diubah.');
            } else {
                // Password saat ini tidak valid, tambahkan pesan error
                session()->setFlashdata('error', 'Password saat ini salah.');
            }

            return redirect()->back();
        } else {
            // Tampilkan kembali form dengan pesan error validasi
            $data['validation'] = $this->validator;
            return view('user/change_password', $data);
        }
    }
}
