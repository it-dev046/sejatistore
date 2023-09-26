<?php

namespace App\Controllers;

class KatepelController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Kategori Pelanggan',
            'daftar_katepel' => $this->KatepelModel->orderBy('id_katepel', 'DESC')->findAll()
        ];

        return view('admin/pelanggan/kategori', $data);
    }

    public function store()
    {
        // Buat Slug katepel
        $slug = url_title($this->request->getPost('nama_katepel'), '-', TRUE);

        //simpan data le database
        $data = [
            'nama_katepel' => esc($this->request->getPost('nama_katepel')),
            'diskon_khusus' => esc($this->request->getPost('diskon_khusus')),
            'keterangan' => esc($this->request->getPost('keterangan')),
            'slug_katepel' => $slug
        ];
        $this->KatepelModel->insert($data);

        return redirect()->back()->with('success', 'Data Kategori Pelanggan Berhasil Ditambahkan');
    }

    public function update($id_katepel)
    {
        // Buat Slug katepel
        $slug = url_title($this->request->getPost('nama_katepel'), '-', TRUE);

        //simpan data ke database
        $data = [
            'nama_katepel' => esc($this->request->getPost('nama_katepel')),
            'potongan_harga' => esc($this->request->getPost('potongan_harga')),
            'diskon_khusus' => esc($this->request->getPost('diskon_khusus')),
            'keterangan' => esc($this->request->getPost('keterangan')),
            'slug_katepel' => $slug
        ];
        $this->KatepelModel->update($id_katepel, $data);

        return redirect()->back()->with('success', 'Data Kategori Pelanggan Berhasil Diubah');
    }

    public function destroy($id_katepel)
    {
        // Hapus data
        $this->KatepelModel->where('id_katepel', $id_katepel)->delete();

        return redirect()->back()->with('success', 'Data Kategori Pelanggan Berhasil Dihapus');
    }
}
