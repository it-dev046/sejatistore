<?php namespace App\Controllers;

class KategoriController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Kategori Produk',
            'daftar_kategori' => $this->KategoriModel->orderBy('id_kategori', 'DESC')->findAll()
        ];

        return view('admin/kategori/index', $data);
    }

    public function store() {
        // Buat Slug kategori
        $slug = url_title($this->request->getPost('nama_kategori'), '-', TRUE);
    
        //simpan data le database
        $data = [
        'nama_kategori' => esc($this->request->getPost('nama_kategori')),
        'slug_kategori' => $slug
        ];
        $this->KategoriModel->insert($data);
    
        return redirect()->back()->with('success', 'Data Kategori Produk Berhasil Ditambahkan');
    }
    
    public function update($id_kategori) {
        // Buat Slug kategori
        $slug = url_title($this->request->getPost('nama_kategori'), '-', TRUE);
    
        //simpan data ke database
        $data = [
        'nama_kategori' => esc($this->request->getPost('nama_kategori')),
        'slug_kategori' => $slug
        ];
        $this->KategoriModel->update($id_kategori, $data);
    
        return redirect()->back()->with('success', 'Data Kategori Produk Berhasil Diubah');
    }
    
    public function destroy($id_kategori) {
        // Hapus data
        $this->KategoriModel->where('id_kategori', $id_kategori) ->delete();
    
        return redirect()->back()->with('success', 'Data Kategori Produk Berhasil Dihapus');
    }

}
