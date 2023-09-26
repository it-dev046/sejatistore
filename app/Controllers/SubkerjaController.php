<?php

namespace App\Controllers;

class SubkerjaController extends BaseController
{
    public function index($id_kerja)
    {
        $data = [
            'title' => 'Halaman Sub Kategori Kerja',
            'daftar_subkerja' => $this->SubkerjaModel
                ->where('id_kerja', $id_kerja)
                ->orderBy('id', 'DESC')->findAll(),
            'kerjaan' => $this->KerjaModel
                ->where('id_kerja', $id_kerja)->first()
        ];

        return view('admin/kerja/sub', $data);
    }

    public function store()
    {
        //simpan data le database
        $id_kerja = $this->request->getPost('id_kerja');
        $data = [
            'id_kerja' => $id_kerja,
            'nama_sub' => esc($this->request->getPost('nama_sub')),
            'keterangan' => esc($this->request->getPost('keterangan')),
        ];
        $this->SubkerjaModel->insert($data);

        return redirect()->back()->with('success', 'Data Sub Kerja Berhasil Ditambahkan');
    }

    public function update($id)
    {
        //simpan data ke database
        $data = [
            'nama_sub' => esc($this->request->getPost('nama_sub')),
            'keterangan' => esc($this->request->getPost('keterangan')),
        ];
        $this->SubkerjaModel->update($id, $data);

        return redirect()->back()->with('success', 'Data Sub Kerja Berhasil Diubah');
    }

    public function destroy($id)
    {
        // Hapus data
        $this->SubkerjaModel->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data Sub Kerja Berhasil Dihapus');
    }
}
