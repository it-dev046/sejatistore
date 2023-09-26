<?php

namespace App\Controllers;

class UkuranController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Kategori Satuan Ukur',
            'daftar_ukuran' => $this->UkuranModel->orderBy('id_ukuran', 'DESC')->findAll(),
        ];

        return view('admin/ukuran/index', $data);
    }

    public function store()
    {
        //simpan data le database
        $data = [
            'nama' => esc($this->request->getPost('nama')),
            'keterangan' => esc($this->request->getPost('keterangan'))
        ];
        $this->UkuranModel->insert($data);

        return redirect()->back()->with('success', 'Data Ukuran Berhasil Ditambahkan');
    }

    public function update($id_ukuran)
    {
        //simpan data ke database
        $data = [
            'nama' => esc($this->request->getPost('nama')),
            'keterangan' => esc($this->request->getPost('keterangan'))
        ];
        $this->UkuranModel->update($id_ukuran, $data);

        return redirect()->back()->with('success', 'Data Ukuran Berhasil Diubah');
    }

    public function destroy($id_ukuran)
    {
        // Hapus data
        $this->UkuranModel->where('id_ukuran', $id_ukuran)->delete();

        return redirect()->back()->with('success', 'Data Ukuran Berhasil Dihapus');
    }
}
