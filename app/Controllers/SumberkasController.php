<?php

namespace App\Controllers;

class SumberkasController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Sumber Kas',
            'daftar_sumber' => $this->SumberKasModel->orderBy('id_sumber', 'DESC')
                ->findAll(),
        ];

        return view('admin/kas/sumber', $data);
    }

    public function store()
    {
        $data = [
            'kode' => $this->request->getPost('kode'),
            'keterangan' => $this->request->getPost('keterangan'),
            'cash' => $this->request->getPost('cash'),
            'saldo' => $this->request->getPost('saldo'),
        ];

        $this->SumberKasModel->insert($data);

        return redirect()->back()->with('success', 'Data Sumber Kas Berhasil Ditambahkan');
    }

    public function update($id_sumber)
    {
        $data = [
            'kode' => $this->request->getPost('kode'),
            'keterangan' => $this->request->getPost('keterangan'),
            'cash' => $this->request->getPost('cash'),
        ];

        $this->SumberKasModel->update($id_sumber, $data);

        return redirect()->back()->with('success', 'Data Sumber Kas Berhasil Diubah');
    }

    public function destroy($id_sumber)
    {

        $this->KasModel->where('id_sumber', $id_sumber)->delete();
        $this->SumberKasModel->where('id_sumber', $id_sumber)->delete();
        // Hapus data
        return redirect()->back()->with('success', 'Data Kas Harian Berhasil Dihapus');
    }
}
