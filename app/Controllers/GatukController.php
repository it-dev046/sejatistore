<?php

namespace App\Controllers;

use SebastianBergmann\CodeCoverage\Driver\Selector;

class GatukController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Gaji Tukang',
            'userId' => $this->session->get('id'),
            'daftar_gatuk' => $this->GatukModel->orderBy('id_gatuk', 'DESC')->findAll(),
            'daftar_hbk' => $this->HbkModel->orderBy('id_hbk', 'DESC')
                ->join('pemasangan', 'pemasangan.id_pasang = hbk.id_pasang', 'left')
                ->findAll()
        ];

        return view('admin/gatuk/index', $data);
    }

    public function store()
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            $id_hbk = $this->request->getPost('id_hbk');
            $hbk =  $this->HbkModel->orderBy('id_hbk', 'DESC')
                ->join('pemasangan', 'pemasangan.id_pasang = hbk.id_pasang', 'left')
                ->where('id_hbk', $id_hbk)->first();

            //simpan data database
            $data = [
                'tanggal' => esc($this->request->getPost('tanggal')),
                'rek' => esc($this->request->getPost('rek')),
                'bank' => esc($this->request->getPost('bank')),
                'AN' => esc($this->request->getPost('AN')),
                'keterangan' => esc($this->request->getPost('keterangan')),
                'nilai' => esc($this->request->getPost('nilai')),
                'invoice' => $hbk->invoice,
                'penerima' => $hbk->tukang,
                'sisa_hbk' => $hbk->sisa_hbk,
            ];
            $this->GatukModel->insert($data);

            return redirect()->back()->with('success', 'Gaji Tukang Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function update($id_gatuk)
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
            $this->GatukModel->update($id_gatuk, $data);

            return redirect()->back()->with('success', 'Gaji Tukang Berhasil Diubah');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function destroy($id_gatuk)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            // Hapus data
            $this->GatukModel->where('id_gatuk', $id_gatuk)->delete();

            return redirect()->back()->with('success', 'Gaji Tukang Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }
}
