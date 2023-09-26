<?php

namespace App\Controllers;

class HargaController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Kategori harga',
            'daftar_harga' => $this->HargaModel->orderBy('id_harga', 'DESC')->findAll(),
        ];

        return view('admin/harga/index', $data);
    }

    public function store()
    {
        //simpan data le database
        $data = [
            'nama' => esc($this->request->getPost('nama')),
            'nominal' => esc($this->request->getPost('nominal')),
            'keterangan' => esc($this->request->getPost('keterangan'))
        ];
        $this->HargaModel->insert($data);

        return redirect()->back()->with('success', 'Data Harga Berhasil Ditambahkan');
    }

    public function update($id_harga)
    {
        //simpan data ke database
        $data = [
            'nama' => esc($this->request->getPost('nama')),
            'nominal' => esc($this->request->getPost('nominal')),
            'keterangan' => esc($this->request->getPost('keterangan'))
        ];
        $this->HargaModel->update($id_harga, $data);

        return redirect()->back()->with('success', 'Data Harga Berhasil Diubah');
    }

    public function destroy($id_harga)
    {
        // Hapus data
        $this->HargaModel->where('id_harga', $id_harga)->delete();

        return redirect()->back()->with('success', 'Data Harga Berhasil Dihapus');
    }
}
