<?php

namespace App\Controllers;

use App\Libraries\MY_TCPDF as TCPDF;
use App\Libraries\Terbilang;


class CetakController extends BaseController
{

    public function nota($id)
    {

        helper('terbilang');

        date_default_timezone_set("Asia/Manila");

        $faktur = $this->TransaksiModel->where('id', $id)
            ->join('pelanggan', 'pelanggan.id_pel = transaksi.id_pel', 'left')
            ->join('katepel', 'katepel.id_katepel = transaksi.id_katepel', 'left')
            ->join('ongkir', 'ongkir.id_ongkir = transaksi.id_ongkir', 'left')
            ->select('transaksi.*, pelanggan.*, katepel.diskon_khusus ,katepel.keterangan , ongkir.biaya')
            ->first();
        $detail = $this->DetailModel->where('id_trans', $faktur->id_trans)
            ->join('produk', 'produk.id_produk = detail_transaksi.id_produk', 'left')
            ->join('satuan_produk', 'satuan_produk.id_satuan = produk.id_satuan', 'left')
            ->select('produk.nama_produk, produk.harga, detail_transaksi.jumlah_produk, detail_transaksi.subtotal, satuan_produk.nama_satuan, satuan_produk.singkatan')
            ->findAll();
        $jumlahbayar = $this->DetailModel->jumlahbayar($faktur->id_trans);
        $jumlahdiskon = ($jumlahbayar + $faktur->potongan + $faktur->biaya) - $faktur->total;
        $no = 1;

        $tanggal = date('d F Y');
        // create new PDF document
        $pdf = new TCPDF('p', 'mm', 'A4', true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nota Sejati');
        $pdf->SetTitle('Nota Sejati');
        $pdf->SetSubject('Nota Sejati');
        $pdf->SetKeywords('Nota Sejati');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 6455), array(0, 64, 128));
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        //view mengarah ke invoice.php
        $html = <<<EOD
        <table>
            <tr>
                <td width="245px" height="55px">
                </td>
                <td width="200px"><h1>NOTA INVOICE</h1></td>
            </tr>
        </table>
        <table>
            <tr>
                <td width="300px"><strong>PT ANUGERAH SEJATI NUSANTARA</strong></td>
                <td width="100px"></td>
                <td width="80px">No Nota</td>
                <td width="20px"> : </td>
                <td width="150px">$faktur->id_trans</td>
            </tr>
            <tr>
                <td>Jl. Sultan Sulaiman Depan Pelita 4 Sambutan, </td>
                <td></td>
                <td>Tanggal</td>
                <td> : </td>
                <td>$tanggal</td>
            </tr>
            <tr>
                <td>Kota Samarinda - KALTIM</td>
                <td></td>   
                <td>Tuan / Toko</td>
                <td> : </td>
                <td>$faktur->nama_pel</td>
            </tr>
            <tr>
                <td>Telp. 0811-556-717 | 0811-558-717</td>
                <td></td>
                <td>Telepon</td>
                <td> : </td>
                <td>$faktur->telepon </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Alamat</td>
                <td> : </td>
                <td>$faktur->alamat </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <table id="tb-item" cellpadding="4">
            <tr style="background-color:#a9a9a9">
                <th width="7%" style="height: 20px;text-align:center"><strong>No</strong></th>
                <th width="50%" style="height: 20px;text-align:center"><strong>Nama Barang</strong></th>
                <th width="10%" style="height: 20px;text-align:center"><strong>Qty</strong></th>
                <th width="14%" style="height: 20px;text-align:center"><strong>Harga</strong></th>
                <th width="19%" style="height: 20px;text-align:center"><strong>Total</strong></th>
            </tr>
        EOD;
        foreach ($detail as $key => $value) {
            $nomor = $no++;
            $harga = number_to_currency($value->harga, 'IDR', 'id_ID');
            $subtotal = number_to_currency($value->subtotal, 'IDR', 'id_ID');
            $html .= <<<EOD
            <tr>
                <td style="height: 20px;text-align:center">$nomor</td>
                <td style="height: 20px">$value->nama_produk ($value->singkatan)</td>
                <td style="height: 20px;text-align:center">$value->jumlah_produk ($value->nama_satuan)</td>
                <td style="height: 20px;text-align:right">$harga</td>
                <td style="height: 20px;text-align:right">$subtotal</td>
            </tr>
            EOD;
        }
        $jumlahbayar = number_to_currency($jumlahbayar, 'IDR', 'id_ID');
        $jumlahdiskon = number_to_currency($jumlahdiskon, 'IDR', 'id_ID');
        $bayar = number_to_currency($faktur->bayar, 'IDR', 'id_ID');
        $ongkir = number_to_currency($faktur->biaya, 'IDR', 'id_ID');
        $potongan = number_to_currency($faktur->potongan, 'IDR', 'id_ID');
        $hutang = $faktur->kembalian * -1;
        $sisabayar = number_to_currency($hutang, 'IDR', 'id_ID');
        $total = number_to_currency($faktur->total, 'IDR', 'id_ID');
        $angka = $faktur->total;
        $terbilang = new Terbilang();
        $terbilang_angka = $terbilang->angkaTerbilang($angka);
        if ($faktur->diskon_khusus > 0) {
            $html .= <<<EOD
            <tr style="border:1px solid #000">
                <td colspan="4" style="height: 20px;text-align:right"><strong>Subtotal</strong></td>
                <td style="height: 20px;text-align:right;"><strong>$jumlahbayar</strong></td>
            </tr>
            <tr style="border:1px solid #000">
                <td colspan="4" style="height: 20px;text-align:right"><strong>Diskon $faktur->diskon_khusus % - $faktur->keterangan</strong></td>
                <td style="height: 20px;text-align:right;"><strong>($jumlahdiskon)</strong></td>
            </tr>
            EOD;
        }
        if ($faktur->biaya > 0) {
            $html .= <<<EOD
            <tr style="border:1px solid #000">
                <td colspan="4" style="height: 20px;text-align:right"><strong>Ongkir</strong></td>
                <td style="height: 20px;text-align:right;"><strong>$ongkir</strong></td>
            </tr>
            EOD;
        }
        if ($faktur->potongan > 0) {
            $html .= <<<EOD
            <tr style="border:1px solid #000">
                <td colspan="4" style="height: 20px;text-align:right"><strong>Potongan</strong></td>
                <td style="height: 20px;text-align:right;"><strong>($potongan)</strong></td>
            </tr>
            EOD;
        }
        if ($faktur->bayar < $faktur->total) {
            $html .= <<<EOD
            <tr style="border:1px solid #000">
                <td colspan="4" style="height: 20px;text-align:right"><strong>Pembayaran Awal</strong></td>
                <td style="height: 20px;text-align:right;"><strong>$bayar</strong></td>
            </tr>
            <tr style="border:1px solid #000">
                <td colspan="4" style="height: 20px;text-align:right"><strong>Sisa Bayar</strong></td>
                <td style="height: 20px;text-align:right;color:red"><strong>($sisabayar)</strong></td>
            </tr>
            EOD;
        }
        $html .= <<<EOD
            <tr style="border:1px solid #000">
                <td colspan="4" style="height: 20px;text-align:right"><strong>Total Pembayaran</strong></td>
                <td style="height: 20px;text-align:right;background-color:yellow"><span style="font-size: 10px;"><strong>$total</strong></span></td>
            </tr>
            EOD;
        if ($faktur->status == 3 && $hutang > 0) {
            $html .= <<<EOD
            <tr style="border:1px solid #000">
                <td colspan="4" style="height: 20px;text-align:right"><strong>Status Pembayaran</strong></td>
                <td style="height: 20px;text-align:right;background-color:yellow"><span style="font-size: 10px;"><strong>--Invoice--</strong></span></td>
            </tr>
            EOD;
        } elseif ($faktur->status == 2 && $hutang > 0) {
            $html .= <<<EOD
            <tr style="border:1px solid #000">
                <td colspan="4" style="height: 20px;text-align:right"><strong>Status Pembayaran</strong></td>
                <td style="height: 20px;text-align:right;background-color:yellow;text-align:centar"><span style="font-size: 10px;"><strong>--COD--</strong></span></td>
            </tr>
            EOD;
        } elseif ($hutang > 0) {
            $html .= <<<EOD
            <tr style="border:1px solid #000">
                <td colspan="4" style="height: 20px;text-align:right"><strong>Status Pembayaran</strong></td>
                <td style="height: 20px;text-align:right;background-color:yellow;text-align:centar"><span style="font-size: 10px;"><strong>--COD--</strong></span></td>
            </tr>
            EOD;
        } else {
            $html .= <<<EOD
            <tr style="border:1px solid #000">
                <td colspan="4" style="height: 20px;text-align:right"><strong>Status Pembayaran</strong></td>
                <td style="height: 20px;text-align:right;background-color:yellow;text-align:centar"><span style="font-size: 10px;"><strong>--Tunai--</strong></span></td>
            </tr>
            EOD;
        }
        $html .= <<<EOD
            <tr style="border:1px solid #000">
                <td colspan="6" style="height: 20px;text-align:centar"><span style="font-size: 10px;"><strong><em>" $terbilang_angka "</em></strong></span></td>
            </tr>
        </table>
        <br>
        <br>
        <table>
            <tr>
                <td width="339px"><strong>BARANG YANG SUDAH DIBELI TIDAK</strong></td>
                <td width="1px"></td>
                <td width="85px">Transfer A/N</td>
                <td width="20px"> : </td>
                <td width="200px">PT. Anugerah Sejati Nusantara </td>
            </tr>
            <tr>
                <td><strong>DAPAT DITUKAR / DIKEMBALIKAN LAGI</strong></td>
                <td></td>
                <td>BCA</td>
                <td> : </td>
                <td>254.322.3344</td>
            </tr>
            <tr>
                <td><p style="color:red">PEMBAYARAN VIA TRANSFER HARUS MENGIRIMKAN </p></td>
                <td></td>   
                <td>Mandiri</td>
                <td> : </td>
                <td>14800.1774.0237</td>
            </tr>
            <tr>
                <td><p style="color:red">BUKTI TRANSFER JIKA TIDAK MAKA PEMBELIAN </p></td>
                <td></td>
                <td>BRI</td>
                <td> : </td>
                <td>0448.01.000570.30.8 </td>
            </tr>
            <tr>
                <td><p style="color:red">TIDAK AKAN KAMI PROSES </p></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>

        <style>
            p,
            span,
            table {
                font-size: 9px;
            }

            table {
                width: 100%;
                border: 1px solid #dee2e6;
            }

            table#tb-item tr th,
            table#tb-item tr td {
                border: 1px solid #000;
            }
        </style>
        EOD;

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', 13, $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------
        $this->response->setContentType('application/pdf');
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.

        $pdf->Output('nota-sejati.pdf', 'I');
    }

    public function bahan($id)
    {

        date_default_timezone_set("Asia/Manila");

        $faktur = $this->BahanModel->where('id_pasang', $id)->first();
        $detail = $this->DetailbahanModel->where('id_pasang', $id)
            ->join('produk', 'produk.id_produk=detail_bahan.id_produk', 'left')
            ->join('kategori_produk', 'kategori_produk.id_kategori=produk.id_kategori', 'left')
            ->join('subkategori', 'subkategori.id_subkate=produk.id_subkate', 'left')
            ->join('satuan_produk', 'satuan_produk.id_satuan=produk.id_satuan', 'left')
            ->select('produk.nama_produk, satuan_produk.nama_satuan, satuan_produk.singkatan, detail_bahan.jumlah')
            ->findAll();
        $no = 1;

        $tanggal = date('d F Y', strtotime($faktur->tanggal));
        // create new PDF document
        $pdf = new TCPDF('p', 'mm', 'A4', true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Surat Jalan Sejati');
        $pdf->SetTitle('Surat Jalan Sejati');
        $pdf->SetSubject('Surat Jalan Sejati');
        $pdf->SetKeywords('Surat Jalan Sejati');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 6455), array(0, 64, 128));
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();


        //view mengarah ke invoice.php
        // Logo
        $image_file = ROOTPATH . 'public/cetak/logosejati.png';
        $html = <<<EOD
        <table>
            <tr>
                <td width="245px" height="55px"></td>
                <td width="150px"><h1>SURAT JALAN</h1></td>
            </tr>
        </table>
        <table>
            <tr>
                <td width="300px"><strong>PT ANUGERAH SEJATI NUSANTARA</strong></td>
                <td width="100px"></td>
                <td width="80px">Tanggal</td>
                <td width="20px"> : </td>
                <td width="150px">$tanggal</td>
            </tr>
            <tr>
                <td>Jl. Sultan Sulaiman Depan Pelita 4 Sambutan, </td>
                <td></td>
                <td>Pemasangan</td>
                <td> : </td>
                <td>$faktur->nama_pasang</td>
            </tr>
            <tr>
                <td>Kota Samarinda - KALTIM</td>
                <td></td>   
                <td>Alamat</td>
                <td> : </td>
                <td>$faktur->alamat</td>
            </tr>
            <tr>
                <td>Telp. 0811-556-717 | 0811-558-717</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr> 
        </table>
        <table id="tb-item" cellpadding="4">
            <tr style="background-color:#a9a9a9">
                <th width="5%" style="height: 20px;text-align:center"><strong>No</strong></th>
                <th width="75%" style="height: 20px;text-align:center"><strong>Nama Barang</strong></th>
                <th width="20%" style="height: 20px;text-align:center"><strong>Qty</strong></th>
            </tr>
        EOD;
        foreach ($detail as $key => $value) {
            $nomor = $no++;
            $html .= <<<EOD
            <tr>
                <td style="height: 20px;text-align:center">$nomor</td>
                <td style="height: 20px">$value->nama_produk ($value->singkatan)</td>
                <td style="height: 20px;text-align:center">$value->jumlah ($value->nama_satuan)</td>
            </tr>
            EOD;
        }
        $html .= <<<EOD
        </table>
        <br>
        <br>
        <table>
            <tr>
                <td width="300px" height="75px"><strong style="color:red">JIKA ADA BARANG PEMASANGAN YANG DIKEMBALIKAN/SISA PEMASANGAN/ 
                TIDAK SESUAI HARAP SEGERA DIKEMBALIKAN KE GUDANG DAN LAPORKAN PADA ADMIN </strong></td>
                <td width="110px" style="height: 20px;text-align:center"><strong>Kep.Gudang</strong></td>
                <td width="110px" style="height: 20px;text-align:center"><strong>pengirim</strong></td>
                <td width="110px" style="height: 20px;text-align:center"><strong>Penerima</strong></td>
            </tr>
            <tr>
                <td width="300px"></td>
                <td width="110px" style="height: 20px;text-align:center">(..................)</td>
                <td width="110px" style="height: 20px;text-align:center">(..................)</td>
                <td width="110px" style="height: 20px;text-align:center">(..................)</td>
            </tr>
        </table>

        <style>
            p,
            span,
            table {
                font-size: 9px
            }

            table {
                border: 1px solid #dee2e6;
            }

            table#tb-item tr th,
            table#tb-item tr td {
                border: 1px solid #000
            }
        </style>
        EOD;

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', 13, $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------
        $this->response->setContentType('application/pdf');
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.

        $pdf->Output('nota-sejati.pdf', 'I');
    }

    public function suratjalan($id)
    {

        date_default_timezone_set("Asia/Manila");

        $faktur = $this->TransaksiModel->where('id', $id)
            ->join('pelanggan', 'pelanggan.id_pel = transaksi.id_pel', 'left')
            ->join('katepel', 'katepel.id_katepel = transaksi.id_katepel', 'left')
            ->join('ongkir', 'ongkir.id_ongkir = transaksi.id_ongkir', 'left')
            ->select('transaksi.*, pelanggan.*, katepel.diskon_khusus , ongkir.biaya')
            ->first();
        $detail = $this->DetailModel->where('id_trans', $faktur->id_trans)
            ->join('produk', 'produk.id_produk = detail_transaksi.id_produk', 'left')
            ->join('satuan_produk', 'satuan_produk.id_satuan = produk.id_satuan', 'left')
            ->select('produk.nama_produk, detail_transaksi.jumlah_produk, satuan_produk.nama_satuan, satuan_produk.singkatan')
            ->findAll();
        $no = 1;

        $tanggal = date('d F Y');
        // create new PDF document
        $pdf = new TCPDF('p', 'mm', 'A4', true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Surat Jalan Sejati');
        $pdf->SetTitle('Surat Jalan Sejati');
        $pdf->SetSubject('Surat Jalan Sejati');
        $pdf->SetKeywords('Surat Jalan Sejati');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 6455), array(0, 64, 128));
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();


        //view mengarah ke invoice.php
        // Logo
        $image_file = ROOTPATH . 'public/cetak/logosejati.png';
        $html = <<<EOD
        <table>
            <tr>
                <td width="245px" height="55px"></td>
                <td width="150px"><h1>SURAT JALAN</h1></td>
            </tr>
        </table>
        <table>
            <tr>
                <td width="300px"><strong>PT ANUGERAH SEJATI NUSANTARA</strong></td>
                <td width="100px"></td>
                <td width="80px">No Nota</td>
                <td width="20px"> : </td>
                <td width="150px">$faktur->id_trans</td>
            </tr>
            <tr>
                <td>Jl. Sultan Sulaiman Depan Pelita 4 Sambutan, </td>
                <td></td>
                <td>Tanggal</td>
                <td> : </td>
                <td>$tanggal</td>
            </tr>
            <tr>
                <td>Kota Samarinda - KALTIM</td>
                <td></td>   
                <td>Tuan / Toko</td>
                <td> : </td>
                <td>$faktur->nama_pel</td>
            </tr>
            <tr>
                <td>Telp. 0811-556-717 | 0811-558-717</td>
                <td></td>
                <td>Telepon</td>
                <td> : </td>
                <td>$faktur->telepon </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Alamat</td>
                <td> : </td>
                <td>$faktur->alamat </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr> 
        </table>
        <table id="tb-item" cellpadding="4">
            <tr style="background-color:#a9a9a9">
                <th width="5%" style="height: 20px;text-align:center"><strong>No</strong></th>
                <th width="75%" style="height: 20px;text-align:center"><strong>Nama Barang</strong></th>
                <th width="20%" style="height: 20px;text-align:center"><strong>Qty</strong></th>
            </tr>
        EOD;
        foreach ($detail as $key => $value) {
            $nomor = $no++;
            $html .= <<<EOD
            <tr>
                <td style="height: 20px;text-align:center">$nomor</td>
                <td style="height: 20px">$value->nama_produk ($value->singkatan)</td>
                <td style="height: 20px;text-align:center">$value->jumlah_produk ($value->nama_satuan)</td>
            </tr>
            EOD;
        }
        $html .= <<<EOD
        </table>
        <br>
        <br>
        <table>
            <tr>
                <td width="300px" height="75px"><strong style="color:red">BARANG YANG SUDAH DIBELI TIDAK DAPAT DITUKAR ATAU DIKEMBALIKAN LAGI</strong></td>
                <td width="110px" style="height: 20px;text-align:center"><strong>Kep.Gudang</strong></td>
                <td width="110px" style="height: 20px;text-align:center"><strong>pengirim</strong></td>
                <td width="110px" style="height: 20px;text-align:center"><strong>Penerima</strong></td>
            </tr>
            <tr>
                <td width="300px"></td>
                <td width="110px" style="height: 20px;text-align:center">(..................)</td>
                <td width="110px" style="height: 20px;text-align:center">(..................)</td>
                <td width="110px" style="height: 20px;text-align:center">(..................)</td>
            </tr>
        </table>

        <style>
            p,
            span,
            table {
                font-size: 9px
            }

            table {
                border: 1px solid #dee2e6;
            }

            table#tb-item tr th,
            table#tb-item tr td {
                border: 1px solid #000
            }
        </style>
        EOD;

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', 13, $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------
        $this->response->setContentType('application/pdf');
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.

        $pdf->Output('nota-sejati.pdf', 'I');
    }

    public function daftarstok()
    {

        date_default_timezone_set("Asia/Manila");
        $data = [
            'title' => 'Laporan_Stok_Periode_' . date('d_F_Y'),
            'tanggal' => date('d F Y'),
            'produk' => $this->ProdukModel->orderBy('nama_produk', 'ASC')
                ->join('kategori_produk', 'kategori_produk.id_kategori = produk.id_kategori', 'left')
                ->join('subkategori', 'subkategori.id_subkate = produk.id_subkate', 'left')
                ->join('satuan_produk', 'satuan_produk.id_satuan = produk.id_satuan', 'left')
                ->select('produk.nama_produk, produk.gambar_produk, produk.harga, produk.deskripsi, kategori_produk.nama_kategori, subkategori.nama_subkate, produk.stok, satuan_produk.nama_satuan, satuan_produk.singkatan')
                ->findAll()
        ];

        return view('admin/cetak/stok', $data);
        // var_dump($daftar_produk);
    }

    public function invoice($id)
    {

        date_default_timezone_set("Asia/Manila");
        $invoice = $this->PasangModel->where('id_pasang', $id)->first();

        $terbilang = new Terbilang();
        $terbilang_biaya = $terbilang->angkaTerbilang($invoice->biaya);
        $terbilang_sisa = $terbilang->angkaTerbilang($invoice->sisa);

        $data = [
            'title' => 'Invoice_Pemasangan_' . $invoice->invoice,
            'tanggal' => date('d F Y'),
            'invoice' => $this->PasangModel->where('id_pasang', $id)->first(),
            'daftar_bayar' => $this->BayarpasangModel->where('id_pasang', $id)->findAll(),
            'jumlahterbiaya' => $this->DetailpasangModel->jumlahbiaya($invoice->id_survei),
            'jumlahterbayar' => $this->BayarpasangModel->jumlahbayar($id),
            'daftar_uraian' => $this->DetailpasangModel
                ->join('pemasangan', 'pemasangan.id_survei = detail_pemasangan.id_survei', 'left')
                ->join('subkerja', 'subkerja.id = detail_pemasangan.id_sub', 'right')
                ->join('kerja', 'kerja.id_kerja = subkerja.id_kerja', 'right')
                ->select('detail_pemasangan.*, subkerja.nama_sub, kerja.nama')
                ->orderBy('kerja.nama', 'DESC')
                ->where('id_pasang', $id)->findAll(),
            'terbilang_biaya' => $terbilang_biaya,
            'terbilang_sisa' => $terbilang_sisa,
        ];

        return view('admin/cetak/invoice', $data);
        // var_dump($data);
    }

    public function pengajuan($id)
    {

        date_default_timezone_set("Asia/Manila");
        $survei = $this->SurveiModel->where('id_survei', $id)->first();

        $terbilang = new Terbilang();
        $terbilang_biaya = $terbilang->angkaTerbilang($survei->biaya);

        $tahun = date('Y');
        $month = date('n'); // Mengambil angka bulan saat ini (1-12)
        $romanMonth = $this->convertToRoman($month); // Mengonversi angka bulan menjadi huruf Romawi

        $nomor =  "/" . "RAB-ASN" . "/" . $romanMonth . "/" . $tahun;

        $data = [
            'title' => 'Pengajuan_RAB_' . $survei->pelanggan,
            'tanggal' => date('d F Y'),
            'survei' => $this->SurveiModel->where('id_survei', $id)->first(),
            'jumlahterbiaya' => $this->DetailpasangModel->jumlahbiaya($id),
            'daftar_uraian' => $this->DetailpasangModel
                ->join('subkerja', 'subkerja.id = detail_pemasangan.id_sub', 'right')
                ->join('kerja', 'kerja.id_kerja = subkerja.id_kerja', 'right')
                ->select('detail_pemasangan.*, subkerja.nama_sub, kerja.nama')
                ->orderBy('kerja.nama', 'DESC')
                ->where('id_survei', $id)->findAll(),
            'terbilang_biaya' => $terbilang_biaya,
            'nomor' => $nomor,
        ];

        return view('admin/cetak/pengajuan', $data);
        // var_dump($data);
    }

    public function uraian($id)
    {

        date_default_timezone_set("Asia/Manila");
        $invoice = $this->PasangModel->where('id_pasang', $id)->first();

        $terbilang = new Terbilang();
        $terbilang_biaya = $terbilang->angkaTerbilang($invoice->biaya);

        $data = [
            'title' => $invoice->no_rbp,
            'tanggal' => date('d F Y'),
            'invoice' => $this->PasangModel->where('id_pasang', $id)->first(),
            'daftar_bayar' => $this->BayarpasangModel->where('id_pasang', $id)->findAll(),
            'jumlahterbiaya' => $this->DetailpasangModel->jumlahbiaya($invoice->id_survei),
            'daftar_uraian' => $this->DetailpasangModel
                ->join('pemasangan', 'pemasangan.id_survei = detail_pemasangan.id_survei', 'left')
                ->join('subkerja', 'subkerja.id = detail_pemasangan.id_sub', 'right')
                ->join('kerja', 'kerja.id_kerja = subkerja.id_kerja', 'right')
                ->select('detail_pemasangan.*, subkerja.nama_sub, kerja.nama')
                ->orderBy('kerja.nama', 'DESC')
                ->where('id_pasang', $id)->findAll(),
            'terbilang_biaya' => $terbilang_biaya,
        ];

        return view('admin/cetak/uraian', $data);
        // var_dump($data);
    }

    public function uraianhbk($id_hbk)
    {

        date_default_timezone_set("Asia/Manila");
        $hbk = $this->HbkModel->where('id_hbk', $id_hbk)->first();

        $terbilang = new Terbilang();
        $terbilang_total = $terbilang->angkaTerbilang($hbk->total_hbk);

        $data = [
            'title' => $hbk->no_hbk,
            'tanggal' => date('d F Y'),
            'invoice' => $this->PasangModel->where('id_pasang', $hbk->id_pasang)->first(),
            'hbk' => $this->HbkModel->where('id_hbk', $id_hbk)->first(),
            'daftar_uraian' => $this->DetailhbkModel
                ->orderBy('id', 'ASC')
                ->where('id_hbk', $hbk->id_hbk)->findAll(),
            'terbilang_biaya' => $terbilang_total,
            'jumlahterbiaya' => $this->DetailhbkModel->jumlahbiaya($hbk->id_hbk),
        ];

        return view('admin/cetak/uraianhbk', $data);
        // var_dump($data);
    }

    public function kwitansi($id)
    {

        date_default_timezone_set("Asia/Manila");
        $detail = $this->BayarpasangModel->where('id', $id)->first();

        $terbilang = new Terbilang();
        $terbilang_bayar = $terbilang->angkaTerbilang($detail->bayar);

        $data = [
            'title' => $detail->kwitansi,
            'tanggal' => date('d F Y'),
            'invoice' => $this->PasangModel->where('id_pasang', $detail->id_pasang)->first(),
            'detail' => $this->BayarpasangModel->where('id', $id)->first(),
            'terbilang_bayar' => $terbilang_bayar,
            'jumlahterbayar' => $this->BayarpasangModel->jumlahbayar($id),
        ];

        return view('admin/cetak/kwitansi', $data);
        // var_dump($data);
    }

    public function hbk($id)
    {

        date_default_timezone_set("Asia/Manila");
        $detail = $this->BayarhbkModel->where('id', $id)->first();

        $terbilang = new Terbilang();
        $terbilang_bayar = $terbilang->angkaTerbilang($detail->bayar);

        $data = [
            'title' => $detail->kwitansi,
            'tanggal' => date('d F Y'),
            'hbk' => $this->HbkModel
                ->where('id_hbk', $detail->id_hbk)
                ->join('pemasangan', 'pemasangan.id_pasang = hbk.id_pasang', 'left')
                ->orderBy('id_hbk', 'DESC')
                ->first(),
            'detail' => $this->BayarhbkModel->where('id', $id)->first(),
            'terbilang_bayar' => $terbilang_bayar,
            'jumlahterbayar' => $this->BayarhbkModel->jumlahbayar($id),
        ];

        return view('admin/cetak/hbk', $data);
        // var_dump($data);
    }

    public function labarugi()
    {
        date_default_timezone_set("Asia/Manila");


        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');
        $tanggal = $this->request->getPost('tanggal');

        $jumlahmasuk = $this->LabarugiModel->jumlahmasuk();
        $jumlahkeluar = $this->LabarugiModel->jumlahkeluar();
        if ($jumlahmasuk >= $jumlahkeluar) {
            $nilai = $jumlahmasuk - $jumlahkeluar;
        } else {
            $nilai = $jumlahkeluar - $jumlahmasuk;
        }

        $data = [
            'title' => 'Laporan_Keuangan_' . $bulan . '_' . $tahun,
            'tanggal' => date('d F Y', strtotime($tanggal)),
            'bulan' => $bulan . ' ' . $tahun,
            'daftar_masuk' => $this->LabarugiModel
                ->join('katekas', 'katekas.id_katekas = labarugi.id_katekas', 'left')
                ->select('labarugi.*, katekas.kode')
                ->where('jenis', 1)
                ->findAll(),
            'daftar_keluar' => $this->LabarugiModel
                ->join('katekas', 'katekas.id_katekas = labarugi.id_katekas', 'left')
                ->select('labarugi.*, katekas.kode')
                ->where('jenis', 2)
                ->findAll(),
            'jumlahmasuk' => $this->LabarugiModel->jumlahmasuk(),
            'jumlahkeluar' => $this->LabarugiModel->jumlahkeluar(),
            'total' => $nilai,
        ];

        return view('admin/cetak/labarugi', $data);
        // var_dump($daftar_produk);
    }

    public function memo($id)
    {

        $memo = $this->MemoModel->where('id_memo', $id)->first();
        date_default_timezone_set("Asia/Manila");
        $data = [
            'title' => 'memo_' . date('d F Y', strtotime($memo->tanggal)) . ' _ ' . $memo->nama,
            'tanggal' => date('d F Y'),
            'memo' => $this->MemoModel->where('id_memo', $id)->first(),
        ];

        return view('admin/cetak/memo', $data);
        // var_dump($data);
    }

    protected function convertToRoman($number)
    {
        $romans = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        ];

        return $romans[$number];
    }
}
