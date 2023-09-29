<?php

namespace App\Controllers;

date_default_timezone_set("Asia/Manila");

class PiutangController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Piutang',
            'userId' => $this->session->get('id'),
            'daftar_piutang' => $this->PiutangModel->orderBy('id_piutang', 'DESC')
                ->join('rekening', 'rekening.id_rekening = piutang.id_rekening', 'left')->findAll(),
            'daftar_rekening' => $this->RekeningModel->orderBy('usaha', 'ASC')->findAll(),
        ];

        return view('admin/piutang/index', $data);
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
                'saldo' => 0,
            ];
            $this->PiutangModel->insert($data);

            return redirect()->back()->with('success', 'Piutang Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function update($id_piutang)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            //simpan data database
            $data = [
                'id_rekening' => esc($this->request->getPost('id_rekening')),
                'alamat' => esc($this->request->getPost('alamat')),
                'keterangan' => esc($this->request->getPost('keterangan')),
            ];
            $this->PiutangModel->update($id_piutang, $data);

            return redirect()->back()->with('success', 'Piutang Berhasil Diubah');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function destroy($id_piutang)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            // Hapus data
            $this->PiutangModel->where('id_piutang', $id_piutang)->delete();
            $this->DetailPiutangModel->where('id_piutang', $id_piutang)->delete();

            return redirect()->back()->with('success', 'Piutang Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }


    public function uraian($id_piutang)
    {
        $piutang = $this->PiutangModel->where('id_piutang', $id_piutang)->first();
        $data = [
            'title' => 'Halaman Detail Piutang',
            'piutang' => $this->PiutangModel->where('id_piutang', $id_piutang)
                ->join('rekening', 'rekening.id_rekening = piutang.id_rekening', 'left')
                ->first(),
            'daftar_uraian' => $this->DetailPiutangModel
                ->where('id_piutang', $piutang->id_piutang)
                ->orderBy('tanggal', 'DESC')
                ->findAll(),
            'jumlahdebet' => $this->DetailPiutangModel->jumlahdebet($id_piutang),
            'jumlahkredit' => $this->DetailPiutangModel->jumlahkredit($id_piutang),
        ];
        // var_dump($data);

        echo view('admin/piutang/uraian', $data);
    }

    public function uraiansimpan()
    {
        //simpan data database
        $tanggal = $this->request->getPost('tanggal');
        $id_piutang = $this->request->getPost('id_piutang');
        $keterangan = $this->request->getPost('keterangan');
        $pilihan = $this->request->getPost('pilihan');
        $nilai = $this->request->getPost('nilai');
        if ($pilihan == 1) {
            $debet = $nilai;
            $kredit = 0;
        } else {
            $kredit = $nilai;
            $debet = 0;
        }

        $data = [
            'tanggal' => $tanggal,
            'id_piutang' => $id_piutang,
            'debet' => $debet,
            'kredit' => $kredit,
            'keterangan' => $keterangan,
        ];

        $this->DetailPiutangModel->insert($data);

        $totaldebet = $this->DetailPiutangModel->debetpiutang($id_piutang);
        $totalkredit = $this->DetailPiutangModel->kreditpiutang($id_piutang);

        $saldo = $totaldebet - $totalkredit;
        $updatesaldo = [
            'saldo' => $saldo,
        ];

        $this->PiutangModel->update($id_piutang, $updatesaldo);

        return redirect()->back()->with('success', 'Data Uraian piutang Berhasil Ditambahkan');
    }

    public function uraianhapus($id)
    {
        // Hapus data
        $id_piutang = $this->request->getPost('id_piutang');
        $this->DetailPiutangModel->where('id', $id)->delete();

        $totaldebet = $this->DetailPiutangModel->debetpiutang($id_piutang);
        $totalkredit = $this->DetailPiutangModel->kreditpiutang($id_piutang);

        $saldo = $totaldebet - $totalkredit;
        $updatesaldo = [
            'saldo' => $saldo,
        ];

        $this->PiutangModel->update($id_piutang, $updatesaldo);

        return redirect()->back()->with('success', 'Data Uraian piutang Berhasil dihapus');
    }

    public function uraianbatal($id_piutang)
    {
        // Hapus data
        $id_piutang = $this->request->getPost('id_piutang');
        $this->DetailPiutangModel->where('id_piutang', $id_piutang)->delete();
        $totalbiaya = $this->DetailPiutangModel->jumlahbiaya($id_piutang);

        $data2 = [
            'total_piutang' => $totalbiaya,
        ];
        $this->PiutangModel->update($id_piutang, $data2);

        return redirect()->back()->with('success', 'Data Uraian telah dibatalkan');
    }
}
