<?php

namespace App\Controllers;

use SebastianBergmann\CodeCoverage\Driver\Selector;

class DepositController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Deposit Customer',
            'userId' => $this->session->get('id'),
            'daftar_deposit' => $this->DepositModel->orderBy('id_deposit', 'DESC')->findAll(),
            'daftar_pel' => $this->PelangganModel->orderBy('id_pel', 'DESC')->findAll(),
        ];

        return view('admin/deposit/index', $data);
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
                'nilai' => esc($this->request->getPost('nilai')),
                'keterangan' => esc($this->request->getPost('keterangan')),
            ];
            $this->DepositModel->insert($data);

            return redirect()->back()->with('success', 'Deposit Customer Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function update($id_deposit)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            //simpan data database
            $data = [
                'tanggal' => esc($this->request->getPost('tanggal')),
                'rek' => esc($this->request->getPost('rek')),
                'bank' => esc($this->request->getPost('bank')),
                'AN' => esc($this->request->getPost('AN')),
                'keterangan' => esc($this->request->getPost('keterangan')),
                'nilai' => esc($this->request->getPost('nilai')),
            ];
            $this->DepositModel->update($id_deposit, $data);

            return redirect()->back()->with('success', 'Deposit Customer Berhasil Diubah');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function destroy($id_deposit)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            // Hapus data
            $this->DepositModel->where('id_deposit', $id_deposit)->delete();

            return redirect()->back()->with('success', 'Deposit Customer Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }
}
