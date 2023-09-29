<?php

namespace App\Controllers;

class TokoController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Daftar Toko',
            'userId' => $this->session->get('id'),
            'daftar_toko' => $this->TokoModel->orderBy('nama', 'ASC')->findAll(),
        ];

        return view('admin/toko/index', $data);
    }

    public function store()
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            //simpan data database
            $data = [
                'nama' => esc($this->request->getPost('nama')),
                'rek1' => esc($this->request->getPost('rek1')),
                'rek2' => esc($this->request->getPost('rek2')),
                'rek3' => esc($this->request->getPost('rek3')),
                'keterangan' => esc($this->request->getPost('keterangan')),
            ];
            $this->TokoModel->insert($data);

            return redirect()->back()->with('success', 'Data toko Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function update($id_toko)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            //simpan data ke database
            $data = [
                'nama' => esc($this->request->getPost('nama')),
                'rek1' => esc($this->request->getPost('rek1')),
                'rek2' => esc($this->request->getPost('rek2')),
                'rek3' => esc($this->request->getPost('rek3')),
                'keterangan' => esc($this->request->getPost('keterangan')),
            ];
            $this->TokoModel->update($id_toko, $data);

            return redirect()->back()->with('success', 'Data toko Berhasil Diubah');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function destroy($id_toko)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            // Hapus data
            $this->TokoModel->where('id_toko', $id_toko)->delete();

            return redirect()->back()->with('success', 'Data toko Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }
}
