<?php

namespace App\Controllers;

class DrafterController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Kategori Drafter',
            'daftar_drafter' => $this->DrafterModel->orderBy('id_drafter', 'DESC')->findAll(),
        ];

        return view('admin/drafter/index', $data);
    }

    public function store()
    {
        //simpan data le database
        $data = [
            'nama' => esc($this->request->getPost('nama'))
        ];
        $this->DrafterModel->insert($data);

        return redirect()->back()->with('success', 'Data Drafter Berhasil Ditambahkan');
    }

    public function update($id_drafter)
    {
        //simpan data ke database
        $data = [
            'nama' => esc($this->request->getPost('nama'))
        ];
        $this->DrafterModel->update($id_drafter, $data);

        return redirect()->back()->with('success', 'Data Drafter Berhasil Diubah');
    }

    public function destroy($id_drafter)
    {
        // Hapus data
        $this->DrafterModel->where('id_drafter', $id_drafter)->delete();

        return redirect()->back()->with('success', 'Data Drafter Berhasil Dihapus');
    }
}
