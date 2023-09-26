<?php

namespace App\Controllers;

class KatekasController extends BaseController

{
    public function index()
    {
        $data = [
            'title' => 'Halaman Kategori Kas',
            'daftar_katekas' => $this->KatekasModel->orderBy('id_katekas', 'DESC')->findAll()
        ];

        return view('admin/kas/kategori', $data);
    }

    public function store()
    {
        //simpan data database
        $data = [
            'kode' => esc($this->request->getPost('kode')),
            'keterangan' => esc($this->request->getPost('keterangan')),
        ];
        $this->KatekasModel->insert($data);

        return redirect()->back()->with('success', 'Data Kategori Kas Berhasil Ditambahkan');
    }

    public function update($id_katekas)
    {
        //simpan data database
        $data = [
            'kode' => esc($this->request->getPost('kode')),
            'keterangan' => esc($this->request->getPost('keterangan')),
        ];
        $this->KatekasModel->update($id_katekas, $data);
        return redirect()->back()->with('success', 'Data Kategori Kas Berhasil Diubah');
    }

    public function destroy($id_katekas)
    {
        $this->KatekasModel->delete($id_katekas);
        $this->KasModel->where('id_katekas', $id_katekas)->delete();
        return redirect()->back()->with('success', 'Data Kategori Kas Berhasil Dihapus');
    }
}
