<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PenjualanController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Penjualan Sejati Store',
            'daftar_transaksi' => $this->TransaksiModel->orderBy('id', 'DESC')->findAll()
        ];

        return view('admin/penjualan/index', $data);
    }

    public function preview($id)
    {
        $datafaktur = $this->TransaksiModel->where('id', $id)->first();
        $data = [
            'title' => 'Halaman Kasir Pembayaran',
            'daftar_produk' => $this->ProdukModel->AllData(),
            'faktur' => $this->TransaksiModel->where('id_trans', $datafaktur->id_trans)
                ->join('pelanggan', 'pelanggan.id_pel = transaksi.id_pel', 'left')
                ->join('katepel', 'katepel.id_katepel = transaksi.id_katepel', 'left')
                ->join('ongkir', 'ongkir.id_ongkir = transaksi.id_ongkir', 'left')
                ->select('transaksi.* , pelanggan.nama_pel, pelanggan.telepon, pelanggan.alamat, pelanggan.kota, katepel.nama_katepel, ongkir.nama_wilayah, ongkir.biaya')
                ->first(),
            'detail' => $this->DetailModel->where('id_trans', $datafaktur->id_trans)
                ->join('produk', 'produk.id_produk = detail_transaksi.id_produk', 'left')
                ->join('satuan_produk', 'satuan_produk.id_satuan = produk.id_satuan', 'left')
                ->select('produk.nama_produk, produk.gambar_produk, produk.harga, satuan_produk.nama_satuan, satuan_produk.singkatan, detail_transaksi.jumlah_produk, detail_transaksi.subtotal')
                ->findAll()
        ];
        // var_dump($data);

        echo view('admin/penjualan/detail', $data);
    }
    public function hapusdetail($id_detail)
    {
        $detail = $this->DetailModel->where('id_detail', $id_detail)
            ->join('produk', 'produk.id_produk = detail_transaksi.id_produk', 'left')
            ->first();
        $faktur = $this->TransaksiModel->where('id_trans', $detail->id_trans)
            ->join('pelanggan', 'pelanggan.id_pel = transaksi.id_pel', 'left')
            ->join('katepel', 'katepel.id_katepel = transaksi.id_katepel', 'left')
            ->join('ongkir', 'ongkir.id_ongkir = transaksi.id_ongkir', 'left')
            ->first();
    }

    public function destroy($id)
    {
        $faktur = $this->TransaksiModel->where('id', $id)->first();
        $detail = $this->DetailModel->where('id_trans', $faktur->id_trans)
            ->join('produk', 'produk.id_produk = detail_transaksi.id_produk', 'left')
            ->join('satuan_produk', 'satuan_produk.id_satuan = produk.id_satuan', 'left')
            ->findAll();

        $dataToUpdate = array();
        foreach ($detail as $key => $value) {
            $dataToUpdate[] = array(
                'id' =>  $value->id_produk,
                'stok' => $value->stok + $value->jumlah_produk
            );
        }
        foreach ($dataToUpdate as $data3) {
            $id = $data3['id'];
            unset($data3['id']); // Remove the 'id' key from the data array
            $this->ProdukModel->update($id, $data3);
        }

        $this->DetailModel->where('id_trans', $faktur->id_trans)->delete();

        $this->TransaksiModel->where('id_trans', $faktur->id_trans)->delete();

        return redirect()->to(base_url('penjualan'))->with('success', 'Penjualan telah dibatalkan');
    }

    public function exportpenjualan()
    {
        $faktur = $this->TransaksiModel->orderBy('id_trans', 'DESC')
            ->join('pelanggan', 'pelanggan.id_pel = transaksi.id_pel', 'left')
            ->join('katepel', 'katepel.id_katepel = transaksi.id_katepel', 'left')
            ->join('ongkir', 'ongkir.id_ongkir = transaksi.id_ongkir', 'left')
            ->findAll();


        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No Faktur')
            ->setCellValue('B1', 'Tanggal')
            ->setCellValue('C1', 'Pelanggan')
            ->setCellValue('D1', 'Alamat')
            ->setCellValue('E1', 'Kota')
            ->setCellValue('F1', 'Kategori')
            ->setCellValue('G1', 'Pengiriman')
            ->setCellValue('H1', 'Ongkir')
            ->setCellValue('I1', 'Potongan')
            ->setCellValue('J1', 'Total Belanja');

        $column = 2;

        foreach ($faktur as $value) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $value->id_trans)
                ->setCellValue('B' . $column, $value->tanggal_input)
                ->setCellValue('C' . $column, $value->penerima)
                ->setCellValue('D' . $column, $value->alamat)
                ->setCellValue('E' . $column, $value->kota)
                ->setCellValue('F' . $column, $value->nama_katepel)
                ->setCellValue('G' . $column, $value->nama_wilayah)
                ->setCellValue('H' . $column, $value->biaya)
                ->setCellValue('I' . $column, $value->potongan)
                ->setCellValue('J' . $column, $value->total);

            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename =  'Data-Penjualan-' . date('Y-m-d-His');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
