<?php

namespace App\Controllers;

date_default_timezone_set("Asia/Manila");

class HutangController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Daftar Hutang Perusahaan',
            'userId' => $this->session->get('id'),
            'daftar_hutang' => $this->HutangModel->orderBy('id_hutang', 'DESC')
                ->join('rekening', 'rekening.id_rekening = hutang.id_rekening', 'left')
                ->findAll(),
            'daftar_rekening' => $this->RekeningModel->orderBy('usaha', 'ASC')->findAll(),
        ];

        return view('admin/hutang/index', $data);
    }

    public function store()
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {

            //simpan data database
            $data = [
                'tanggal' => esc($this->request->getPost('tanggal')),
                'id_rekening' => esc($this->request->getPost('id_rekening')),
                'alamat' => esc($this->request->getPost('alamat')),
                'keterangan' => esc($this->request->getPost('keterangan')),
                'total' => esc($this->request->getPost('total')),
            ];
            $this->HutangModel->insert($data);

            return redirect()->back()->with('success', 'Data Hutang Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function update($id_hutang)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            //simpan data database
            $data = [
                'id_rekening' => esc($this->request->getPost('id_rekening')),
                'alamat' => esc($this->request->getPost('alamat')),
                'keterangan' => esc($this->request->getPost('keterangan')),
                'total' => esc($this->request->getPost('total')),
            ];
            $this->HutangModel->update($id_hutang, $data);

            return redirect()->back()->with('success', 'Data Hutang Berhasil Diubah');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function destroy($id_hutang)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            // Hapus data
            $this->HutangModel->where('id_hutang', $id_hutang)->delete();
            $this->DetailHutangModel->where('id_hutang', $id_hutang)->delete();

            return redirect()->back()->with('success', 'Data Hutang Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }


    public function uraian($id_hutang)
    {
        $hutang = $this->HutangModel->where('id_hutang', $id_hutang)->first();
        $totalbayar = $this->DetailHutangModel->totalbayar($id_hutang);
        $sisa = $hutang->total - $totalbayar;

        $data = [
            'title' => 'Halaman Detail hutang',
            'hutang' => $this->HutangModel
                ->join('rekening', 'rekening.id_rekening = hutang.id_rekening', 'left')
                ->where('id_hutang', $id_hutang)
                ->first(),
            'daftar_uraian' => $this->DetailHutangModel
                ->where('id_hutang', $hutang->id_hutang)
                ->orderBy('tanggal', 'DESC')
                ->findAll(),
            'totalbayar' => $totalbayar,
            'sisa' => $sisa,
        ];
        // var_dump($data);

        echo view('admin/hutang/uraian', $data);
    }

    public function uraiansimpan()
    {
        //simpan data database
        $tanggal = $this->request->getPost('tanggal');
        $id_hutang = $this->request->getPost('id_hutang');
        $keterangan = $this->request->getPost('keterangan');
        $sumber = $this->request->getPost('sumber');
        $tujuan = $this->request->getPost('tujuan');
        $bayar = $this->request->getPost('bayar');

        $data = [
            'tanggal' => $tanggal,
            'id_hutang' => $id_hutang,
            'sumber' => $sumber,
            'tujuan' => $tujuan,
            'keterangan' => $keterangan,
            'bayar' => $bayar,
        ];

        $this->DetailHutangModel->insert($data);

        return redirect()->back()->with('success', 'Data Uraian Data Hutang Berhasil Ditambahkan');
    }

    public function uraianhapus($id)
    {
        // Hapus data
        $this->DetailHutangModel->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data Uraian Data Hutang Berhasil dihapus');
    }

    public function uraianbatal($id_hutang)
    {
        // Hapus data
        $this->DetailHutangModel->where('id_hutang', $id_hutang)->delete();

        return redirect()->back()->with('success', 'Data Uraian telah dibatalkan');
    }
}
