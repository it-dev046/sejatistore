<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {


        $data = [
            'title' => 'Dashboard | Sejatistore',
            'daftar_produk' => $this->ProdukModel->orderBy('nama_produk', 'ASC')
                ->join('kategori_produk', 'kategori_produk.id_kategori = produk.id_kategori', 'left')
                ->join('subkategori', 'subkategori.id_subkate = produk.id_subkate', 'left')
                ->join('satuan_produk', 'satuan_produk.id_satuan = produk.id_satuan', 'left')
                ->select('produk.nama_produk, kategori_produk.nama_kategori, subkategori.nama_subkate, satuan_produk.nama_satuan, satuan_produk.singkatan, produk.harga, produk.stok, produk.deskripsi')
                ->findAll(),
            'jumlahharian' => $this->TransaksiModel->countSalesToday(),
            'totalharian' => $this->TransaksiModel->calculateTodayRevenue(),
            'totalbulanan' => $this->TransaksiModel->calculateCurrentMonthRevenue(),
            'jumlahbulanan' => $this->TransaksiModel->countCurrentMonthSales(),
        ];
        // var_dump($data);

        return view('admin/dashboard/index', $data);
    }

    public function admin()
    {
        $data = [
            'title' => 'Dashboard Admin | Sejatistore',
            'daftar_pasang' => $this->PasangModel
                ->orderBy('id_pasang', 'DESC')
                ->findAll(),
            'daftar_hbk' => $this->HbkModel
                ->join('pemasangan', 'pemasangan.id_pasang = hbk.id_pasang', 'left')
                ->orderBy('id_hbk', 'DESC')
                ->select('hbk.*, pemasangan.nama, pemasangan.alamat')
                ->findAll(),
            'jumlahsisahbk' => $this->HbkModel->jumlahsisa(),
            'jumlahsisapasang' => $this->PasangModel->jumlahsisa(),
            'masukharian' => $this->BayarpasangModel->calculateTodayRevenue(),
            'keluarharian' => $this->BayarhbkModel->calculateTodayRevenue(),
            'masukbulanan' => $this->BayarpasangModel->calculateCurrentMonthRevenue(),
            'keluarbulanan' => $this->BayarhbkModel->calculateCurrentMonthRevenue(),
            'daftar_bayar' => $this->PembayaranModel
                ->orderBy('transaksi.id', 'DESC')
                ->select('pembayaran.total, pembayaran.sisa, transaksi.tanggal_input, transaksi.id_trans, transaksi.id , pelanggan.nama_pel, katepel.nama_katepel')
                ->join('transaksi', 'transaksi.id_trans = pembayaran.id_trans', 'right')
                ->join('pelanggan', 'pelanggan.id_pel = transaksi.id_pel', 'right')
                ->join('katepel', 'katepel.id_katepel = transaksi.id_katepel', 'right')
                ->findAll(),
            'totalsisa' => $this->PembayaranModel->totalsisa(),
            'totalpembayaran' => $this->DetailBayarModel->totalpembayaran(),
            'totalbayarbulan' => $this->DetailBayarModel->totalbayarbulan(),
        ];
        // var_dump($data);

        return view('admin/dashboard/admin', $data);
    }

    public function drafter()
    {
        $data = [
            'title' => 'Dashboard Drafter | Sejatistore',
            'daftar_survei' => $this->SurveiModel->orderBy('id_survei', 'DESC')->findAll(),
            'daftar_pasang' => $this->PasangModel->orderBy('id_pasang', 'DESC')->findAll(),
            'daftar_hbk' => $this->HbkModel->orderBy('id_hbk', 'DESC')
                ->join('pemasangan', 'pemasangan.id_pasang = hbk.id_pasang', 'left')
                ->findAll()
        ];
        // var_dump($data);

        return view('admin/dashboard/drafter', $data);
    }


    public function survei()
    {
        $data = [
            'title' => 'Halaman Survei Lapangan',
            'pengukur' => $this->PengukurModel->orderBy('id_pengukur', 'DESC')->findAll(),
            'drafter' => $this->DrafterModel->orderBy('id_drafter', 'DESC')->findAll(),
            'daftar_tukang' => $this->TukangModel->orderBy('id_tukang', 'DESC')->findAll(),
            'daftar_survei' => $this->SurveiModel->orderBy('id_survei', 'DESC')->findAll()
        ];

        return view('admin/dashboard/survei', $data);
    }
}
