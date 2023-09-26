<?php

namespace App\Controllers;

class PengukurController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Kategori Surveyor',
            'daftar_pengukur' => $this->PengukurModel->orderBy('id_pengukur', 'DESC')->findAll(),
        ];

        return view('admin/pengukur/index', $data);
    }

    public function store()
    {
        //simpan data le database
        $data = [
            'nama' => esc($this->request->getPost('nama'))
        ];
        $this->PengukurModel->insert($data);

        return redirect()->back()->with('success', 'Data Surveyor Berhasil Ditambahkan');
    }

    public function update($id_pengukur)
    {
        //simpan data ke database
        $data = [
            'nama' => esc($this->request->getPost('nama'))
        ];
        $this->PengukurModel->update($id_pengukur, $data);

        return redirect()->back()->with('success', 'Data Surveyor Berhasil Diubah');
    }

    public function destroy($id_pengukur)
    {
        // Hapus data
        $this->PengukurModel->where('id_pengukur', $id_pengukur)->delete();

        return redirect()->back()->with('success', 'Data Surveyor Berhasil Dihapus');
    }
}
