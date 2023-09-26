<?php

namespace App\Controllers;

class SubkategoriController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Sub Kategori',
            'daftar_subkate' => $this->SubkategoriModel->AllData(),
            'daftar_kategori' => $this->KategoriModel->orderBy('id_kategori', 'DESC')->findAll()
        ];

        return view('admin/subkategori/index', $data);
    }

    public function store()
    {
        // Buat Slug subkate
        $slug = url_title($this->request->getPost('nama_subkate'), '-', TRUE);

        //simpan data le database
        $data = [
            'nama_subkate' => esc($this->request->getPost('nama_subkate')),
            'id_kategori' => esc($this->request->getPost('id_kategori')),
            'slug_subkate' => $slug
        ];
        $this->SubkategoriModel->insert($data);

        return redirect()->back()->with('success', 'Data Sub Kategori Produk Berhasil Ditambahkan');
    }

    public function update($id_subkate)
    {
        // Buat Slug kategori
        $slug = url_title($this->request->getPost('nama_subkate'), '-', TRUE);

        //simpan data ke database
        $data = [
            'nama_subkate' => esc($this->request->getPost('nama_subkate')),
            'id_kategori' => esc($this->request->getPost('id_kategori')),
            'slug_subkate' => $slug
        ];
        $this->SubkategoriModel->update($id_subkate, $data);

        return redirect()->back()->with('success', 'Data Sub Kategori Produk Berhasil Diubah');
    }

    public function destroy($id_subkate)
    {
        // Hapus data
        $this->SubkategoriModel->where('id_subkate', $id_subkate)->delete();

        return redirect()->back()->with('success', 'Data Sub Kategori Produk Berhasil Dihapus');
    }

    // public function ambilKategori()
    // {
    //     $id_kategori = $this->request->getPost('id_kategori');
    //     $sub = $this->SubkategoriModel->AllSubkate($id_kategori);
    //     echo '<option value="">--Pilihan--</option>';
    //     foreach ($sub as $key => $k) {
    //         echo "<option value=" . $k['id_subkate'] . ">" . $k['nama_subkate'] . "</option>";
    //     }
    // }
}
