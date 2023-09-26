<?php

namespace App\Controllers;

use App\Models\TransaksiModel;

class KasirController extends BaseController
{

    protected $session;

    public function __construct()
    {
        helper('form');
        helper('number');
        $this->session = session();
    }
    public function index()
    {
        $cek = $this->session->get('keranjang');
        if (!empty($cek)) {
            return redirect()->to(base_url('kasir/keranjang'))->with('success', 'Nomor Faktur Sudah ada');
        } else {
            $data = [
                'title' => 'Halaman Kasir Pembayaran',
                'daftar_pel' => $this->PelangganModel->AllData(),
                'katepel' => $this->PelangganModel->AllKatepel(),
                'daftar_ongkir' => $this->OngkirModel->orderBy('id_ongkir', 'DESC')->findAll(),
                'cart' => \Config\Services::cart()
            ];
            return view('admin/kasir/index', $data);
        }
    }

    public function simpanfaktur()
    {
        $data = $this->TransaksiModel->orderBy('id', 'DESC')->first();
        $id_trans = $data->id_trans;
        $digit = strlen($id_trans);
        if ($digit == 20) {
            $ambildigit = substr($id_trans, 0, 2);
            $nilai = (int)$ambildigit;
        } else {
            $ambildigit = substr($id_trans, 0, 3);
            $nilai = (int)$ambildigit;
        }
        $jumlahTransaksi = $this->TransaksiModel->countSalesMonth();

        if (!empty($jumlahTransaksi)) {
            $tambahtransaksi = $nilai + 1;
        } else {
            $tambahtransaksi = $jumlahTransaksi + 1;
        }

        $tahun = date('Y');
        $month = date('n'); // Mengambil angka bulan saat ini (1-12)
        $romanMonth = $this->convertToRoman($month); // Mengonversi angka bulan menjadi huruf Romawi
        $jumlahPenjualanFormat = str_pad($tambahtransaksi, 2, '0', STR_PAD_LEFT);
        $nomor = $jumlahPenjualanFormat . "/" . "NOTA-ASN" . "/" . $romanMonth . "/" . $tahun;
        $faktur = (string)$nomor;
        $isExists = $this->TransaksiModel->isInvoiceExists($faktur);

        if ($isExists) {
            $tambahtransaksi2 = $nilai + 2;
            $jumlahPenjualanFormat2 = str_pad($tambahtransaksi2, 2, '0', STR_PAD_LEFT);
            $nomorFaktur = $jumlahPenjualanFormat2 . "/" . "NOTA-ASN" . "/" . $romanMonth . "/" . $tahun;
        } else {
            $nomorFaktur = $jumlahPenjualanFormat . "/" . "NOTA-ASN" . "/" . $romanMonth . "/" . $tahun;
        }

        //simpan data le database
        $data = [
            'title' => 'Halaman Keranjang Produk',
            'daftar_produk' => $this->ProdukModel->AllData(),
            'data_katepel' => $this->TransaksiModel->findAll(),
            'id_trans' => $nomorFaktur,
            'id_pel' => esc($this->request->getPost('id_pel')),
            'id_katepel' => esc($this->request->getPost('id_katepel')),
            'id_ongkir' => esc($this->request->getPost('id_ongkir')),
            'penerima' => esc($this->request->getPost('nama_pel')),
            'telepon' => esc($this->request->getPost('telepon')),
            'alamat' => esc($this->request->getPost('alamat')),
            'status' => esc($this->request->getPost('status')),
            'total' => 0,
            'cart' => \Config\Services::cart()
        ];
        $this->TransaksiModel->insert($data);

        $this->session->set('keranjang', $nomorFaktur);

        // var_dump($data);
        return redirect()->to(base_url('kasir/keranjang'))->with('success', 'Nomor Faktur Sudah dibuat');
    }

    public function keranjang()
    {
        $id_trans = $this->session->get('keranjang');
        $data = [
            'title' => 'Halaman Kasir Pembayaran',
            'daftar_produk' => $this->ProdukModel->AllData(),
            'faktur' => $this->TransaksiModel->where('id_trans', $id_trans)
                ->join('pelanggan', 'pelanggan.id_pel = transaksi.id_pel', 'left')
                ->join('katepel', 'katepel.id_katepel = transaksi.id_katepel', 'left')
                ->join('ongkir', 'ongkir.id_ongkir = transaksi.id_ongkir', 'left')
                ->select('transaksi.*, pelanggan.id_pel, katepel.diskon_khusus, ongkir.biaya')
                ->first(),
            'cart' => \Config\Services::cart()
        ];
        return view('admin/kasir/keranjang', $data);
    }

    public function ubahkeranjang($id)
    {
        $datafaktur = $this->TransaksiModel->where('id', $id)->first();
        $detail = $this->DetailModel->where('id_trans', $datafaktur->id_trans)
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
        // var_dump($dataToUpdate);
        foreach ($dataToUpdate as $data3) {
            $id = $data3['id'];
            unset($data3['id']); // Remove the 'id' key from the data array
            $this->ProdukModel->update($id, $data3);
        }
        $this->DetailModel->where('id_trans', $datafaktur->id_trans)->delete();

        $data = [
            'title' => 'Halaman Kasir Pembayaran',
            'daftar_produk' => $this->ProdukModel->AllData(),
            'faktur' => $this->TransaksiModel->where('id_trans', $datafaktur->id_trans)
                ->join('pelanggan', 'pelanggan.id_pel = transaksi.id_pel', 'left')
                ->join('katepel', 'katepel.id_katepel = transaksi.id_katepel', 'left')
                ->join('ongkir', 'ongkir.id_ongkir = transaksi.id_ongkir', 'left')
                ->select('transaksi.*, pelanggan.id_pel, katepel.diskon_khusus, ongkir.biaya')
                ->first(),
            'cart' => \Config\Services::cart()
        ];

        $this->session->set('keranjang', $datafaktur->id_trans);

        return view('admin/kasir/keranjang', $data);
    }

    public function ambilPelanggan()
    {
        $id_pel = $this->request->getPost('id_pel');
        $sub = $this->TransaksiModel->AllPel($id_pel);
        echo '<option value="">--Pilihan--</option>';
        foreach ($sub as $key => $k) {
            echo "<option value=" . $k['id_subkate'] . ">" . $k['nama_subkate'] . "</option>";
        }
    }

    public function cek()
    {
        $cart = \Config\Services::cart();
        $response = $cart->contents();
        echo '<pre>';
        print_r($response);
        echo '</pre>';
    }

    public function clear()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();
        return redirect()->to(base_url('kasir/keranjang'))->with('success', 'Keranjang Berhasil dikosongkan');
    }

    public function add()
    {
        $cart = \Config\Services::cart();
        $stok = $this->request->getPost('stok');
        $jumlah = $this->request->getPost('jumlah');
        if ($stok >= $jumlah) {
            $cart->insert(array(
                'id'      => $this->request->getPost('id'),
                'qty'     => $this->request->getPost('jumlah'),
                'price'   => $this->request->getPost('price'),
                'name'    => $this->request->getPost('name'),
                'optional' => array(
                    'stok' => $this->request->getPost('stok'),
                    'satuan' => $this->request->getPost('satuan'),
                    'singkatan' => $this->request->getPost('singkatan')
                )
            ));
            return redirect()->to(base_url('kasir/keranjang'))->with('success', 'Produk Berhasil Masuk Keranjang');
        } else {
            return redirect()->to(base_url('kasir/keranjang'))->with('error', 'Jumlah Produk Tidak Cukup');
        }
    }

    public function update()
    {
        $cart = \Config\Services::cart();
        $i = 1;
        foreach ($cart->contents() as $key => $value) {
            $cart->update(array(
                'rowid'   => $value['rowid'],
                'qty'     => $this->request->getPost('qty' . $i++)
            ));
        }
        return redirect()->to(base_url('kasir/keranjang'))->with('success', 'Keranjang berhasil di Update');
    }

    public function delete($rowid)
    {
        $cart = \Config\Services::cart();
        $cart->remove($rowid);
        return redirect()->to(base_url('kasir/keranjang'))->with('success', 'Produk Berhasil dihapus dari Keranjang');
    }

    public function destroy()
    {
        $faktur = $this->TransaksiModel->orderBy('id_trans', 'DESC')
            ->first();
        $this->TransaksiModel->where('id_trans', $faktur->id_trans)->delete();
        //bersihkan keranjang
        $cart = \Config\Services::cart();
        $cart->destroy();
        session()->remove('keranjang');
        return redirect()->to(base_url('kasir'))->with('success', 'Penjualan telah dibatalkan');
    }

    public function store($id)
    {
        $cart = \Config\Services::cart();
        $keranjang = $cart->contents();
        $faktur = $this->TransaksiModel->where('id', $id)->first();
        $result = array();
        foreach ($keranjang as $key => $value) {
            $result[] = array(
                'id_trans' => $faktur->id_trans,
                'id_produk' => $value['id'],
                'jumlah_produk' => $value['qty'],
                'subtotal' => $value['subtotal']
            );
        }
        $this->DetailModel->insertBatch($result);
        //kurangi Stok barang
        $dataToUpdate = array();
        foreach ($keranjang as $key => $value) {
            $dataToUpdate[] = array(
                'id' =>  $value['id'],
                'stok' => $value['optional']['stok'] - $value['qty']
            );
        }
        foreach ($dataToUpdate as $data3) {
            $id = $data3['id'];
            unset($data3['id']); // Remove the 'id' key from the data array
            $this->ProdukModel->update($id, $data3);
        }
        //bersihkan keranjang
        $cart = \Config\Services::cart();
        $cart->destroy();
        session()->remove('keranjang');
        return redirect()->to(base_url('penjualan/' . $faktur->id . '/preview'))->with('success', 'Keranjang belanja telah disimpan');
        // return redirect()->to(base_url('kasir'))->with('success', 'Detail telah disimpan');
    }

    public function potongan()
    {
        //simpan data ke database
        $id_trans = $this->request->getPost('id');
        $bayar = $this->request->getPost('bayar');
        $subtot = $this->request->getPost('totsub');
        $diskon = $this->request->getPost('diskon');
        $ongkir = $this->request->getPost('ongkir');
        $potongan = $this->request->getPost('potongan');
        $totalbayar = $ongkir + ($subtot - $diskon) - $potongan;
        $kembalian = $bayar - $totalbayar;
        $data = [
            'potongan' => $potongan,
            'bayar' => $bayar,
            'total' => $totalbayar,
            'kembalian' => $kembalian
        ];
        $this->TransaksiModel->update($id_trans, $data);
        return redirect()->back()->with('success', 'Total Telah dihitung ulang');
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
