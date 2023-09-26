<?php

namespace App\Controllers;

class KerjaController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Kategori Kerja',
            'daftar_kerja' => $this->KerjaModel->orderBy('id_kerja', 'DESC')->findAll(),
        ];

        return view('admin/kerja/index', $data);
    }

    public function store()
    {
        //simpan data le database
        $data = [
            'nama' => esc($this->request->getPost('nama')),
            'keterangan' => esc($this->request->getPost('keterangan')),
        ];
        $this->KerjaModel->insert($data);

        return redirect()->back()->with('success', 'Data Kerja Berhasil Ditambahkan');
    }

    public function update($id_kerja)
    {
        //simpan data ke database
        $data = [
            'nama' => esc($this->request->getPost('nama')),
            'keterangan' => esc($this->request->getPost('keterangan')),
        ];
        $this->KerjaModel->update($id_kerja, $data);

        return redirect()->back()->with('success', 'Data Kerja Berhasil Diubah');
    }

    public function destroy($id_kerja)
    {
        // Hapus data
        $this->KerjaModel->where('id_kerja', $id_kerja)->delete();

        return redirect()->back()->with('success', 'Data Kerja Berhasil Dihapus');
    }
}
