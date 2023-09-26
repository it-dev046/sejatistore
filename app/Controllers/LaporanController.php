<?php

namespace App\Controllers;

date_default_timezone_set("Asia/Manila");

class LaporanController extends BaseController
{
    public function masuk()
    {
        $tanggal = date('Y-m-d');
        $data = [
            'title' => 'Laporan Pemasukan Tgl ' . date('d M Y', strtotime($tanggal)),
            'daftar_bayar' => $this->DetailBayarModel
                ->orderBy('transaksi.id', 'ASC')
                ->where('DATE(detail_pembayaran.tanggal)', $tanggal)
                ->join('pembayaran', 'pembayaran.id_bayar = detail_pembayaran.id_bayar', 'right')
                ->join('transaksi', 'transaksi.id_trans = pembayaran.id_trans', 'right')
                ->join('pelanggan', 'pelanggan.id_pel = transaksi.id_pel', 'right')
                ->join('katepel', 'katepel.id_katepel = transaksi.id_katepel', 'right')
                ->join('ongkir', 'ongkir.id_ongkir = transaksi.id_ongkir', 'right')
                ->select('pembayaran.sisa AS totalsisa, detail_pembayaran.keterangan, detail_pembayaran.tanggal, detail_pembayaran.sisa, detail_pembayaran.total, transaksi.id_trans ,transaksi.id ,transaksi.total AS totalbayar , transaksi.tanggal_input , pelanggan.nama_pel, katepel.nama_katepel')
                ->findAll(),
            'daftar_bayarpasang' => $this->BayarpasangModel
                ->orderBy('pemasangan.id_pasang', 'ASC')
                ->where('DATE(bayarpasang.tanggal)', $tanggal)
                ->join('pemasangan', 'pemasangan.id_pasang = bayarpasang.id_pasang', 'right')
                ->select('bayarpasang.keterangan, bayarpasang.bayar, pemasangan.biaya , pemasangan.invoice ,pemasangan.nama')
                ->findAll(),
            'tanggal' => $tanggal,
            'masukharian' => $this->BayarpasangModel->calculateTodayRevenue(),
            'totalpembayaran' => $this->DetailBayarModel->totalpembayaran(),
        ];

        return view('admin/laporan/masuk', $data);
    }

    public function keluar()
    {
        $tanggal = date('Y-m-d');
        $data = [
            'title' => 'Laporan Pengeluaran Tgl ' . date('d M Y', strtotime($tanggal)),
            'daftar_hbk' => $this->BayarhbkModel
                ->where('DATE(bayarhbk.tanggal)', $tanggal)
                ->join('hbk', 'hbk.id_hbk = bayarhbk.id_hbk', 'right')
                ->join('pemasangan', 'pemasangan.id_pasang = hbk.id_pasang', 'right')
                ->select('bayarhbk.keterangan, bayarhbk.bayar, pemasangan.biaya , pemasangan.nama , pemasangan.invoice')
                ->orderBy('id', 'DESC')
                ->findAll(),
            'tanggal' => $tanggal,
            'keluarharian' => $this->BayarhbkModel->calculateTodayRevenue(),
        ];

        return view('admin/laporan/keluar', $data);
    }

    public function masukbulan()
    {
        $startDate = date('Y-m-01');
        $endDate = date('Y-m-t');
        $data = [
            'title' => 'Laporan Pemasukan Bulan ' . date('M Y', strtotime($endDate)),
            'daftar_bayar' => $this->DetailBayarModel
                ->orderBy('transaksi.id', 'ASC')
                ->where('DATE(detail_pembayaran.tanggal) >=', $startDate)
                ->where('DATE(detail_pembayaran.tanggal) <=', $endDate)
                ->join('pembayaran', 'pembayaran.id_bayar = detail_pembayaran.id_bayar', 'right')
                ->join('transaksi', 'transaksi.id_trans = pembayaran.id_trans', 'right')
                ->join('pelanggan', 'pelanggan.id_pel = transaksi.id_pel', 'right')
                ->join('katepel', 'katepel.id_katepel = transaksi.id_katepel', 'right')
                ->join('ongkir', 'ongkir.id_ongkir = transaksi.id_ongkir', 'right')
                ->select('pembayaran.sisa AS totalsisa, detail_pembayaran.keterangan, detail_pembayaran.tanggal, detail_pembayaran.sisa, detail_pembayaran.total, transaksi.id_trans ,transaksi.id ,transaksi.total AS totalbayar , transaksi.tanggal_input , pelanggan.nama_pel, katepel.nama_katepel')
                ->findAll(),
            'daftar_bayarpasang' => $this->BayarpasangModel
                ->orderBy('pemasangan.id_pasang', 'ASC')
                ->where('DATE(bayarpasang.tanggal) >=', $startDate)
                ->where('DATE(bayarpasang.tanggal) <=', $endDate)
                ->join('pemasangan', 'pemasangan.id_pasang = bayarpasang.id_pasang', 'right')
                ->select('bayarpasang.tanggal, bayarpasang.keterangan, bayarpasang.bayar, pemasangan.biaya , pemasangan.invoice ,pemasangan.nama')
                ->findAll(),
            'tanggal' => $endDate,
            'masukbulanan' => $this->BayarpasangModel->calculateCurrentMonthRevenue(),
            'totalbayarbulan' => $this->DetailBayarModel->totalbayarbulan(),
        ];

        return view('admin/laporan/masukbulan', $data);
    }

    public function keluarbulan()
    {
        $startDate = date('Y-m-01');
        $endDate = date('Y-m-t');
        $data = [
            'title' => 'Laporan Pengeluaran Bulan ' . date('M Y', strtotime($endDate)),
            'daftar_hbk' => $this->BayarhbkModel
                ->where('DATE(bayarhbk.tanggal) >=', $startDate)
                ->where('DATE(bayarhbk.tanggal) <=', $endDate)
                ->join('hbk', 'hbk.id_hbk = bayarhbk.id_hbk', 'right')
                ->join('pemasangan', 'pemasangan.id_pasang = hbk.id_pasang', 'right')
                ->select('bayarhbk.tanggal, bayarhbk.keterangan, bayarhbk.bayar, pemasangan.biaya , pemasangan.nama , pemasangan.invoice, hbk.pekerja')
                ->orderBy('id', 'DESC')
                ->findAll(),
            'tanggal' => $endDate,
            'keluarbulanan' => $this->BayarhbkModel->calculateCurrentMonthRevenue(),
        ];

        return view('admin/laporan/keluarbulan', $data);
    }
}
