<?php

namespace App\Controllers;

use SebastianBergmann\CodeCoverage\Driver\Selector;

class RPTController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Rancangan Pembayaran',
            'userId' => $this->session->get('id'),
            'daftar_rpt' => $this->RPTModel->orderBy('tanggal', 'DESC')->findAll(),
            'daftar_hbk' => $this->HbkModel->orderBy('id_hbk', 'DESC')
                ->join('pemasangan', 'pemasangan.id_pasang = hbk.id_pasang', 'left')
                ->where('sisa_hbk >', 0)
                ->findAll()
        ];

        return view('admin/rpt/index', $data);
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
                'keterangan' => esc($this->request->getPost('keterangan')),
                'nama' => $hbk->nama,
                'alamat' => $hbk->alamat,
                'invoice' => $hbk->invoice,
                'tukang' => $hbk->tukang,
                'sisa_hbk' => $hbk->sisa_hbk,
            ];
            $this->RPTModel->insert($data);

            return redirect()->back()->with('success', 'Rancangan Pembayaran Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function update($id_rpt)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            //simpan data database
            $data = [
                'tanggal' => esc($this->request->getPost('tanggal')),
                'keterangan' => esc($this->request->getPost('keterangan')),
            ];
            $this->RPTModel->update($id_rpt, $data);

            return redirect()->back()->with('success', 'Rancangan Pembayaran Berhasil Diubah');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function destroy($id_rpt)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            // Hapus data
            $this->RPTModel->where('id_rpt', $id_rpt)->delete();

            return redirect()->back()->with('success', 'Rancangan Pembayaran Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }
}
