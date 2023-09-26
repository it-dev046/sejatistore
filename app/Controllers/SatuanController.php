<?php

namespace App\Controllers;

class SatuanController extends BaseController
{

    public function index()
    {
        $data = [
            'title' => 'Halaman Satuan Produk',
            'daftar_satuan' => $this->SatuanModel->orderBy('id_satuan', 'DESC')->findAll()
        ];

        return view('admin/satuan/index', $data);
    }

    public function store()
    {
        // Buat Slug satuan
        $slug = url_title($this->request->getPost('nama_satuan'), '-', TRUE);

        //simpan data le database
        $data = [
            'nama_satuan' => esc($this->request->getPost('nama_satuan')),
            'singkatan' => esc($this->request->getPost('singkatan')),
            'slug_satuan' => $slug
        ];
        $this->SatuanModel->insert($data);

        return redirect()->back()->with('success', 'Data Satuan Produk Berhasil Ditambahkan');
    }

    public function update($id_satuan)
    {
        // Buat Slug kategori
        $slug = url_title($this->request->getPost('nama_satuan'), '-', TRUE);

        //simpan data ke database
        $data = [
            'nama_satuan' => esc($this->request->getPost('nama_satuan')),
            'singkatan' => esc($this->request->getPost('singkatan')),
            'slug_kategori' => $slug
        ];
        $this->SatuanModel->update($id_satuan, $data);

        return redirect()->back()->with('success', 'Data Satuan Produk Berhasil Diubah');
    }

    public function destroy($id_satuan)
    {
        // Hapus data
        $this->SatuanModel->where('id_satuan', $id_satuan)->delete();

        return redirect()->back()->with('success', 'Data Satuan Produk Berhasil Dihapus');
    }
}
