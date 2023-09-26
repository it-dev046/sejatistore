<?php

namespace App\Controllers;

class TukangController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Kategori Tukang',
            'daftar_tukang' => $this->TukangModel->orderBy('id_tukang', 'DESC')->findAll(),
        ];

        return view('admin/tukang/index', $data);
    }

    public function store()
    {
        //simpan data le database
        $data = [
            'nama' => esc($this->request->getPost('nama'))
        ];
        $this->TukangModel->insert($data);

        return redirect()->back()->with('success', 'Data Tukang Berhasil Ditambahkan');
    }

    public function update($id_tukang)
    {
        //simpan data ke database
        $data = [
            'nama' => esc($this->request->getPost('nama'))
        ];
        $this->TukangModel->update($id_tukang, $data);

        return redirect()->back()->with('success', 'Data Tukang Berhasil Diubah');
    }

    public function destroy($id_tukang)
    {
        // Hapus data
        $this->TukangModel->where('id_tukang', $id_tukang)->delete();

        return redirect()->back()->with('success', 'Data Tukang Berhasil Dihapus');
    }
}
