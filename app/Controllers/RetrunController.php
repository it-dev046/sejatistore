<?php

namespace App\Controllers;

class RetrunController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Barang Kembali',
            'daftar_kembali' => $this->KembaliModel->orderBy('id_kembali', 'DESC')
                ->join('detail_transaksi', 'detail_transaksi.id_detail = produk_kembali.id_detail', 'left')
                ->join('produk', 'produk.id_produk = detail_transaksi.id_produk', 'left')
                ->join('satuan_produk', 'satuan_produk.id_satuan = produk.id_satuan', 'left')
                ->join('transaksi', 'transaksi.id_trans = detail_transaksi.id_trans', 'left')
                ->select('produk.nama_produk, produk_kembali.jumlah_kembali, produk_kembali.keterangan, produk_kembali.id_kembali, produk_kembali.tanggal_input, transaksi.penerima, transaksi.id_trans')
                ->findAll()
        ];

        return view('admin/retrun/index', $data);
    }

    public function pilihtrans()
    {
        $data = [
            'title' => 'Halaman Daftar Detail Penjualan',
            'daftar_detail' => $this->DetailModel->orderBy('id_detail', 'DESC')
                ->join('produk', 'produk.id_produk = detail_transaksi.id_produk', 'left')
                ->join('satuan_produk', 'satuan_produk.id_satuan = produk.id_satuan', 'left')
                ->join('transaksi', 'transaksi.id_trans = detail_transaksi.id_trans', 'left')
                ->select('detail_transaksi.id_detail, detail_transaksi.jumlah_produk, detail_transaksi.subtotal, transaksi.id_trans, transaksi.penerima, produk.nama_produk, satuan_produk.nama_satuan, satuan_produk.singkatan')
                ->findAll()
        ];

        return view('admin/retrun/retrun', $data);
    }

    public function preview($id_detail)
    {
        $data = [
            'title' => 'Halaman Detail Retrun',
            'detail' => $this->DetailModel->orderBy('id_detail', $id_detail)
                ->join('produk', 'produk.id_produk = detail_transaksi.id_produk', 'left')
                ->join('satuan_produk', 'satuan_produk.id_satuan = produk.id_satuan', 'left')
                ->join('transaksi', 'transaksi.id_trans = detail_transaksi.id_trans', 'left')
                ->first(),
            'validation' => \Config\Services::validation()
        ];

        // var_dump($data);

        return view('admin/retrun/detail', $data);
    }

    public function store($id_detail)
    {
        $detail = $this->DetailModel->where('id_detail', $id_detail)
            ->join('produk', 'produk.id_produk = detail_transaksi.id_produk', 'left')
            ->join('transaksi', 'transaksi.id_trans =detail_transaksi.id_trans', 'left')
            ->first();

        $qty_kembali = $this->request->getPost('jumlah_kembali');
        $uang_kembali = $this->request->getPost('ganti');

        $updatestok = [
            'stok' => $detail->stok + $qty_kembali
        ];
        $this->ProdukModel->update($detail->id_produk, $updatestok);

        $updatetot = [
            'total' => $detail->total - $uang_kembali
        ];
        $this->TransaksiModel->update($detail->id_trans, $updatetot);

        $data = [
            'id_detail' => $detail->id_detail,
            'jumlah_kembali' => $qty_kembali,
            'keterangan' =>  $this->request->getPost('keterangan')
        ];
        $this->KembaliModel->insert($data);

        $detailupdate = [
            'jumlah_produk' => $detail->jumlah_produk - $qty_kembali
        ];
        $this->DetailModel->update($detail->id_detail, $detailupdate);


        return redirect()->to(base_url('retrun'))->with('success', 'Produk telah di Retrun');
    }

    public function destroy($id_kembali)
    {
        $detail = $this->KembaliModel->where('id_kembali', $id_kembali)
            ->join('detail_transaksi', 'detail_transaksi.id_detail = produk_kembali.id_detail', 'left')
            ->join('produk', 'produk.id_produk = detail_transaksi.id_produk', 'left')
            ->join('transaksi', 'transaksi.id_trans = detail_transaksi.id_trans', 'left')
            ->first();

        $qty_kembali = $detail->jumlah_kembali;
        $uang_masuk = $qty_kembali * $detail->harga;

        $updatestok = [
            'stok' => $detail->stok - $qty_kembali,
        ];
        $this->ProdukModel->update($detail->id_produk, $updatestok);

        $updatetot = [
            'total' => $detail->total + $uang_masuk,
        ];
        $this->TransaksiModel->update($detail->id_trans, $updatetot);

        $detailupdate = [
            'jumlah_produk' => $detail->jumlah_produk + $qty_kembali
        ];
        $this->DetailModel->update($detail->id_detail, $detailupdate);

        // Hapus data
        $this->KembaliModel->where('id_kembali', $id_kembali)->delete();

        return redirect()->back()->with('success', 'Data Retrun Produk Berhasil Dihapus');
    }
}
