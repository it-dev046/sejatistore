<?php

namespace App\Controllers;

class OngkirController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Ongkir Produk',
            'daftar_ongkir' => $this->OngkirModel->orderBy('id_ongkir', 'DESC')->findAll(),
        ];

        return view('admin/ongkir/index', $data);
    }

    public function store()
    {
        //simpan data le database
        $data = [
            'nama_wilayah' => esc($this->request->getPost('nama_wilayah')),
            'biaya' => esc($this->request->getPost('biaya'))
        ];
        $this->OngkirModel->insert($data);

        return redirect()->back()->with('success', 'Data Ongkir Berhasil Ditambahkan');
    }

    public function update($id_ongkir)
    {
        //simpan data ke database
        $data = [
            'biaya' => esc($this->request->getPost('biaya'))
        ];
        $this->OngkirModel->update($id_ongkir, $data);

        return redirect()->back()->with('success', 'Data Ongkir Berhasil Diubah');
    }

    public function destroy($id_ongkir)
    {
        // Hapus data
        $this->OngkirModel->where('id_ongkir', $id_ongkir)->delete();

        return redirect()->back()->with('success', 'Data Ongkir Berhasil Dihapus');
    }
}
