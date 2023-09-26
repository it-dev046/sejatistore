<?php

namespace App\Controllers;

class PembayaranController extends BaseController

{
    public function index()
    {
        $data = [
            'title' => 'Halaman Pembayaran Faktur Kasir',
            'daftar_transaksi' => $this->TransaksiModel->orderBy('id', 'DESC')
                ->join('pelanggan', 'pelanggan.id_pel = transaksi.id_pel', 'left')
                ->join('katepel', 'katepel.id_katepel = transaksi.id_katepel', 'left')
                ->join('ongkir', 'ongkir.id_ongkir = transaksi.id_ongkir', 'left')
                ->select('transaksi.* , pelanggan.nama_pel, pelanggan.telepon, pelanggan.alamat, pelanggan.kota, katepel.nama_katepel, ongkir.nama_wilayah, ongkir.biaya')
                ->findAll(),
        ];

        return view('admin/pembayaran/index', $data);
    }

    public function ongkir()
    {
        $tahun = date('Y');
        $ongkir = $this->TransaksiModel
            ->join('ongkir', 'ongkir.id_ongkir=transaksi.id_ongkir', 'left')
            ->where('year(transaksi.tanggal_input) =', $tahun)
            ->select('SUM(biaya) as total')
            ->first();

        $data = [
            'title' => 'Halaman Daftar Pembayaran Ongkir',
            'daftar_transaksi' => $this->TransaksiModel->orderBy('id', 'DESC')
                ->join('pelanggan', 'pelanggan.id_pel = transaksi.id_pel', 'left')
                ->join('katepel', 'katepel.id_katepel = transaksi.id_katepel', 'left')
                ->join('ongkir', 'ongkir.id_ongkir = transaksi.id_ongkir', 'left')
                ->select('transaksi.* , pelanggan.nama_pel, pelanggan.telepon, pelanggan.alamat, pelanggan.kota, katepel.nama_katepel, ongkir.nama_wilayah, ongkir.biaya')
                ->where('ongkir.biaya <>', 0)
                ->findAll(),
            'totalongkir' => $ongkir->total,
        ];

        return view('admin/pembayaran/ongkir', $data);
    }

    public function laporan()
    {
        $totalsisa = $this->PembayaranModel->totalsisa();
        $data = [
            'title' => 'Halaman Pembayaran Faktur Kasir',
            'daftar_bayar' => $this->PembayaranModel
                ->orderBy('transaksi.id', 'DESC')
                ->select('pembayaran.total, pembayaran.sisa, transaksi.tanggal_input, transaksi.id_trans, transaksi.id , pelanggan.nama_pel, katepel.nama_katepel')
                ->join('transaksi', 'transaksi.id_trans = pembayaran.id_trans', 'right')
                ->join('pelanggan', 'pelanggan.id_pel = transaksi.id_pel', 'right')
                ->join('katepel', 'katepel.id_katepel = transaksi.id_katepel', 'right')
                ->findAll(),
            'totalsisa' => $totalsisa,
            'totalall' => $this->PembayaranModel->totalall(),
        ];

        // var_dump($data);
        return view('admin/pembayaran/laporan', $data);
    }

    public function preview($id)
    {
        $faktur = $this->TransaksiModel->where('id', $id)->first();
        $bayar = $this->PembayaranModel
            ->where('id_trans', $faktur->id_trans)
            ->first();
        if (!empty($bayar)) {
            $id_bayar = $bayar['id_bayar'];
        } else {
            $tambah = [
                'id_trans' => $faktur->id_trans,
                'total' => 0,
                'sisa' => $faktur->total,
            ];
            $this->PembayaranModel->insert($tambah);

            return redirect()->to(base_url('pembayaran/' . $faktur->id . '/preview'));
        }

        $ongkir = $this->DetailBayarModel
            ->where('id_bayar', $id_bayar)
            ->orderBy('id', 'ASC')
            ->select('status')
            ->first();

        if (!empty($ongkir)) {
            $status = $ongkir['status'];
        } else {
            $status = 0;
        }

        $jumlahpembayaran = $this->DetailBayarModel->jumlahpembayaran($bayar['id_bayar']);
        $data = [
            'title' => 'Halaman Detail Pembayaran',
            'faktur' => $this->TransaksiModel->where('id_trans', $faktur->id_trans)
                ->join('pelanggan', 'pelanggan.id_pel = transaksi.id_pel', 'left')
                ->join('katepel', 'katepel.id_katepel = transaksi.id_katepel', 'left')
                ->join('ongkir', 'ongkir.id_ongkir = transaksi.id_ongkir', 'left')
                ->select('transaksi.* , pelanggan.nama_pel, pelanggan.telepon, pelanggan.alamat, pelanggan.kota, katepel.nama_katepel, ongkir.nama_wilayah, ongkir.biaya')
                ->first(),
            'bayar' => $this->PembayaranModel
                ->where('id_bayar', $id_bayar)
                ->first(),
            'daftar_detail' => $this->DetailBayarModel
                ->where('id_bayar', $id_bayar)
                ->orderBy('id', 'ASC')
                ->findAll(),
            'status' => $status,
            'jumlahpembayaran' => $jumlahpembayaran,
        ];
        // var_dump($data);

        echo view('admin/pembayaran/detail', $data);
    }

    public function store()
    {
        $tanggal_from_datepicker = $this->request->getPost('tanggal');
        // Ubah format tanggal sesuai dengan format database (Y-m-d)
        $tanggal = date('Y-m-d', strtotime($tanggal_from_datepicker));

        $id_bayar = $this->request->getPost('id_bayar');
        $status = $this->request->getPost('status');
        $keterangan = $this->request->getPost('keterangan');
        $ongkir = $this->request->getPost('ongkir');
        $total = $this->request->getPost('bayar');
        $bayar = $this->PembayaranModel
            ->where('id_bayar', $id_bayar)
            ->first();

        if (!empty($status)) {
            $subtotal = $bayar['total'] + $total - $ongkir;
            $sisa = $bayar['sisa'] - $total;
        } else {
            $subtotal = $bayar['total'] + $total;
            $sisa = $bayar['sisa'] - $total;
        }

        //simpan data database
        $data = [
            'total' => $subtotal,
            'sisa' => $sisa,
        ];
        $this->PembayaranModel->update($id_bayar, $data);

        $data2 = [
            'id_bayar' => $id_bayar,
            'status' => $status,
            'keterangan' => $keterangan,
            'total' => $subtotal,
            'sisa' => $sisa,
            'tanggal' => $tanggal,
        ];
        $this->DetailBayarModel->insert($data2);
        return redirect()->back()->with('success', 'Data Pembayaran Faktur Kasir Berhasil Ditambahkan');
    }

    public function destroy($id)
    {
        $id_bayar = $this->request->getPost('id_bayar');
        $total = $this->request->getPost('total');
        $bayar = $this->PembayaranModel
            ->where('id_bayar', $id_bayar)
            ->first();
        $sisa = $bayar['sisa'] + $total;

        //simpan data database
        $data = [
            'sisa' => $sisa,
        ];
        $this->PembayaranModel->update($id_bayar, $data);

        $this->DetailBayarModel->delete($id);
        return redirect()->back()->with('success', 'Data Detail Pembayaran Faktur Kasir Berhasil Dihapus');
    }
    public function destroy2($id_bayar)
    {
        $this->DetailBayarModel->where('id_bayar', $id_bayar)->delete();
        $this->PembayaranModel->delete($id_bayar);
        return redirect()->to(base_url('pembayaran'))->with('success', 'Data Daftar Pembayaran Faktur Kasir telah dibatalkan');
    }
}
