<?php

namespace App\Controllers;

use App\Models\TransaksiModel;

class KasirController extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('number');
    }
    public function index()
    {
        $data = [
            'title' => 'Halaman Kasir Pembayaran',
            'daftar_pel' => $this->PelangganModel->AllData(),
            'daftar_produk' => $this->ProdukModel->AllData(),
            'cart' => \Config\Services::cart()
        ];

        return view('admin/kasir/index', $data);
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
        return redirect()->to(base_url('kasir'))->with('success', 'Keranjang Berhasil dikosongkan');
    }

    public function add()
    {
        $cart = \Config\Services::cart();
        $cart->insert(array(
            'id'      => $this->request->getPost('id'),
            'qty'     => 1,
            'price'   => $this->request->getPost('price'),
            'name'    => $this->request->getPost('name'),
            'optional' => array(
                'stok' => $this->request->getPost('stok'),
                'satuan' => $this->request->getPost('satuan')
            )
        ));
        return redirect()->to(base_url('kasir'))->with('success', 'Produk Berhasil Masuk Keranjang');
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
        return redirect()->to(base_url('kasir'))->with('success', 'Keranjang berhasil di Update');
    }

    public function delete($rowid)
    {
        $cart = \Config\Services::cart();
        $cart->remove($rowid);
        return redirect()->to(base_url('kasir'))->with('success', 'Produk Berhasil dihapus dari Keranjang');
    }

    public function simpanfaktur()
    {

        $cart = \Config\Services::cart();
        $keranjang = $cart->contents();
        $model = new TransaksiModel();

        $tanggalSekarang = date('Y-m-d');
        $jumlahTransaksi = $model->where('tanggal_input', $tanggalSekarang)->countAllResults();

        $tambahtransaksi = $jumlahTransaksi + 1;
        $tahun = date('Y');
        $bulan = date('m');
        $tanggal = date('d');
        $jumlahPenjualanFormat = str_pad($tambahtransaksi, 2, '0', STR_PAD_LEFT);

        $nomorFaktur = "ASN" . "/" . $tahun . "/" . $bulan . "/" . $tanggal . "/" . $jumlahPenjualanFormat;

        //simpan data detail transaksi

        $result = array();
        foreach ($keranjang as $key => $value) {
            $result[] = array(
                'id_trans' => $nomorFaktur,
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
        //simpan data transaksi
        $data = [
            'id_trans' => $nomorFaktur,
            'id_pel' => esc($this->request->getPost('id_pel')),
            'pengiriman' => esc($this->request->getPost('pengiriman')),
            'penerima' => esc($this->request->getPost('penerima')),
            'telepon' => esc($this->request->getPost('telepon')),
            'alamat' => esc($this->request->getPost('alamat')),
            'ongkir' => esc($this->request->getPost('rupiah2')),
            'total' => $cart->total()
        ];
        $this->TransaksiModel->insert($data);

        //bersihkan keranjang
        $cart->destroy();

        return redirect()->back()->with('success', 'Data Penjualan Sudah ditambahkan');
    }
}
