<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Subtotal;

date_default_timezone_set("Asia/Manila");

class KasController extends BaseController
{
    public function laporan()
    {
        $id_sumber = $this->request->getPost('id_sumber');
        $tanggal = $this->request->getPost('tanggal');
        $saldo = $this->request->getPost('saldo');

        $total_all = $this->KasModel
            ->where('id_sumber', $id_sumber)
            ->select('SUM(debet) as debet, SUM(kredit) as kredit')
            ->first();
        $total_sekarang = $total_all['debet'] - $total_all['kredit'];
        $saldo_awal = $saldo - $total_sekarang;

        $total_sebelum = $this->KasModel
            ->where('id_sumber', $id_sumber)
            ->where('DATE(tanggal) <', $tanggal)
            ->select('SUM(debet) as debet, SUM(kredit) as kredit')
            ->first();

        $total = $this->KasModel
            ->where('id_sumber', $id_sumber)
            ->where('DATE(tanggal) =', $tanggal)
            ->select('SUM(debet) as debet, SUM(kredit) as kredit')
            ->first();
        $subtotal = $total['debet'] - $total['kredit'];

        $saldo_kemarin = $saldo_awal + ($total_sebelum['debet'] - $total_sebelum['kredit']);

        $totalsaldo = $saldo_kemarin + $subtotal;

        $data = [
            'title' => 'Laporan Kas Tanggal ',
            'tanggal' => $tanggal,
            'sumber' => $this->SumberKasModel
                ->where('id_sumber', $id_sumber)
                ->first(),
            'daftar_kas' => $this->KasModel->orderBy('id_kas', 'ASC')
                ->where('id_sumber', $id_sumber)
                ->where('DATE(tanggal)', $tanggal)
                ->join('katekas', 'katekas.id_katekas = kas.id_katekas', 'left')
                ->select('kas.*, katekas.kode')
                ->findAll(),
            'katekas' => $this->KatekasModel->findAll(),
            'totaldebet' => $total['debet'],
            'totalkredit' => $total['kredit'],
            'totalsaldo' => $totalsaldo,
        ];

        return view('admin/kas/laporan', $data);
    }

    public function preview($id_sumber)
    {
        $data = [
            'title' => 'Halaman Kas Harian',
            'sumber' => $this->SumberKasModel
                ->where('id_sumber', $id_sumber)
                ->first(),
            'daftar_kas' => $this->KasModel->orderBy('tanggal', 'ASC')
                ->where('id_sumber', $id_sumber)
                ->join('katekas', 'katekas.id_katekas = kas.id_katekas', 'left')
                ->select('kas.*, katekas.kode')
                ->findAll(),
            'katekas' => $this->KatekasModel->findAll(),
            'jumlahdebet' => $this->KasModel->jumlahdebetkas($id_sumber),
            'jumlahkredit' => $this->KasModel->jumlahkreditkas($id_sumber),
            'jumlahbulan' => $this->KasModel->jumlahbulan($id_sumber),
        ];

        return view('admin/kas/index', $data);
    }

    public function store()
    {
        $tanggal_from_datepicker = $this->request->getPost('tanggal');
        $id_sumber = $this->request->getPost('id_sumber');

        // Ubah format tanggal sesuai dengan format database (Y-m-d)
        $tanggal = date('Y-m-d', strtotime($tanggal_from_datepicker));
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
            'id_katekas' => $this->request->getPost('id_katekas'),
            'id_sumber' => $id_sumber,
            'nama' => $this->request->getPost('nama'),
            'uraian' => $this->request->getPost('uraian'),
            'debet' => $debet,
            'kredit' => $kredit,
        ];

        $this->KasModel->insert($data);

        $totaldebet = $this->KasModel->jumlahdebetkas($id_sumber);
        $totalkredit = $this->KasModel->jumlahkreditkas($id_sumber);

        $saldo = $totaldebet - $totalkredit;
        $updatesaldo = [
            'saldo' => $saldo,
        ];

        $this->SumberKasModel->update($id_sumber, $updatesaldo);


        return redirect()->back()->with('success', 'Data Kas Harian Berhasil Ditambahkan');
    }

    public function update($id_kas)
    {
        $kas = $this->KasModel->where('id_kas', $id_kas)->first();
        $tanggal_from_datepicker = $this->request->getPost('tanggal');
        // Ubah format tanggal sesuai dengan format database (Y-m-d)
        $tanggal = date('Y-m-d', strtotime($tanggal_from_datepicker));

        $saldoawal = $this->request->getPost('saldo');
        $id_sumber = $this->request->getPost('id_sumber');


        $pilihan = $this->request->getPost('pilihan');
        $nilai = $this->request->getPost('nilai');
        if ($pilihan == 1 && $nilai <> $kas['debet']) {
            $debet = $nilai;
            $kredit = 0;
        } elseif ($pilihan == 1 && $nilai == $kas['debet']) {
            $debet = $nilai;
            $kredit = 0;
        } elseif ($pilihan == 2 && $nilai <> $kas['kredit']) {
            $kredit = $nilai;
            $debet = 0;
        } else {
            $kredit = $nilai;
            $debet = 0;
        }

        $data = [
            'tanggal' => $tanggal,
            'id_katekas' => $this->request->getPost('id_katekas'),
            'nama' => $this->request->getPost('nama'),
            'uraian' => $this->request->getPost('uraian'),
            'debet' => $debet,
            'kredit' => $kredit,
        ];

        $this->KasModel->update($id_kas, $data);

        $totaldebet = $this->KasModel->jumlahdebetkas($id_sumber);
        $totalkredit = $this->KasModel->jumlahkreditkas($id_sumber);

        $saldo = $totaldebet - $totalkredit;
        $updatesaldo = [
            'saldo' => $saldo,
        ];

        $this->SumberKasModel->update($id_sumber, $updatesaldo);

        return redirect()->back()->with('success', 'Data Kas Harian Berhasil Diubah');
    }

    public function destroy($id_kas)
    {
        $kas = $this->KasModel->where('id_kas', $id_kas)->first();
        $saldoawal = $this->request->getPost('saldo');
        $id_sumber = $this->request->getPost('id_sumber');
        if (!empty($kas['debet'])) {
            $saldo = $saldoawal - $kas['debet'];
        } else {
            $saldo = $saldoawal + $kas['kredit'];
        }
        $updatesaldo = [
            'saldo' => $saldo,
        ];
        $this->SumberKasModel->update($id_sumber, $updatesaldo);
        // Hapus data
        $this->KasModel->where('id_kas', $id_kas)->delete();
        return redirect()->back()->with('success', 'Data Kas Harian Berhasil Dihapus');
    }
}
