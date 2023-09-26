<?php

namespace App\Controllers;


class MemoController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Memo Perusahaan',
            'userId' => $this->session->get('id'),
            'daftar_memo' => $this->MemoModel->orderBy('id_memo', 'DESC')->findAll(),
        ];

        return view('admin/memo/index', $data);
    }

    public function store()
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {

            //simpan data database
            $data = [
                'tanggal' => esc($this->request->getPost('tanggal')),
                'nama' => esc($this->request->getPost('nama')),
                'nomor' => esc($this->request->getPost('nomor')),
                'telpon' => esc($this->request->getPost('telpon')),
                'barang' => esc($this->request->getPost('barang')),
                'alamat' => esc($this->request->getPost('alamat')),
            ];
            $this->MemoModel->insert($data);

            return redirect()->back()->with('success', 'Memo Perusahaan Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function update($id_memo)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            //simpan data database
            $data = [
                'tanggal' => esc($this->request->getPost('tanggal')),
                'nama' => esc($this->request->getPost('nama')),
                'nomor' => esc($this->request->getPost('nomor')),
                'telpon' => esc($this->request->getPost('telpon')),
                'barang' => esc($this->request->getPost('barang')),
                'alamat' => esc($this->request->getPost('alamat')),
            ];
            $this->MemoModel->update($id_memo, $data);

            return redirect()->back()->with('success', 'Memo Perusahaan Berhasil Diubah');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function destroy($id_memo)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            // Hapus data
            $this->MemoModel->where('id_memo', $id_memo)->delete();

            return redirect()->back()->with('success', 'Memo Perusahaan Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }
}
