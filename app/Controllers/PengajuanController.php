<?php

namespace App\Controllers;

use SebastianBergmann\CodeCoverage\Driver\Selector;

class PengajuanController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Pengajuan Dana',
            'userId' => $this->session->get('id'),
            'daftar_pengajuan' => $this->PengajuanModel->orderBy('id_pengajuan', 'DESC')->findAll(),
        ];

        return view('admin/pengajuan/index', $data);
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
                'rek' => esc($this->request->getPost('rek')),
                'nilai' => esc($this->request->getPost('nilai')),
                'keterangan' => esc($this->request->getPost('keterangan')),
            ];
            $this->PengajuanModel->insert($data);

            return redirect()->back()->with('success', 'Pengajuan Dana Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function update($id_pengajuan)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            //simpan data database
            $data = [
                'tanggal' => esc($this->request->getPost('tanggal')),
                'nama' => esc($this->request->getPost('nama')),
                'rek' => esc($this->request->getPost('rek')),
                'nilai' => esc($this->request->getPost('nilai')),
                'keterangan' => esc($this->request->getPost('keterangan')),
            ];
            $this->PengajuanModel->update($id_pengajuan, $data);

            return redirect()->back()->with('success', 'Pengajuan Dana Berhasil Diubah');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function destroy($id_pengajuan)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            // Hapus data
            $this->PengajuanModel->where('id_pengajuan', $id_pengajuan)->delete();

            return redirect()->back()->with('success', 'Pengajuan Dana Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }
}
