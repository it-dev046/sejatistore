<?php

namespace App\Controllers;

class BahanController extends BaseController
{

    public function index()
    {
        $data = [
            'title' => 'Halaman Bahan Pemasangan',
            'daftar_pasang' => $this->BahanModel->orderBy('id_pasang', 'DESC')->findAll()
        ];

        return view('admin/bahan/index', $data);
    }

    public function store()
    {
        // Ambil data dari form
        $tanggal_from_datepicker = $this->request->getPost('tanggal');

        // Ubah format tanggal sesuai dengan format database (Y-m-d)
        $tanggal = date('Y-m-d', strtotime($tanggal_from_datepicker));

        //simpan data le database
        $data = [
            'nama_pasang' => esc($this->request->getPost('nama_pasang')),
            'alamat' => esc($this->request->getPost('alamat')),
            'tanggal' => $tanggal,
        ];
        $this->BahanModel->insert($data);

        return redirect()->back()->with('success', 'Data Pemasangan Berhasil Ditambahkan');
    }

    public function update($id_pasang)
    {
        $tanggal_from_datepicker = $this->request->getPost('tanggal');

        // Ubah format tanggal sesuai dengan format database (Y-m-d)
        $tanggal = date('Y-m-d', strtotime($tanggal_from_datepicker));

        //simpan data le database
        $data = [
            'nama_pasang' => esc($this->request->getPost('nama_pasang')),
            'alamat' => esc($this->request->getPost('alamat')),
            'tanggal' => $tanggal,
        ];
        $this->BahanModel->update($id_pasang, $data);

        return redirect()->back()->with('success', 'Data Pemasangan Berhasil Diubah');
    }

    public function destroy($id_pasang)
    {
        $detail = $this->DetailbahanModel->where('id_pasang', $id_pasang)
            ->join('produk', 'produk.id_produk = detail_bahan.id_produk', 'left')
            ->findAll();

        $dataToUpdate = array();
        foreach ($detail as $key => $value) {
            $dataToUpdate[] = array(
                'id_produk' =>  $value->id_produk,
                'stok' => $value->stok + $value->jumlah,
            );
        }
        foreach ($dataToUpdate as $data3) {
            $id = $data3['id_produk'];
            unset($data3['id_produk']); // Remove the 'id' key from the data array
            $this->ProdukModel->update($id, $data3);
        }
        // Hapus data
        $this->BahanModel->where('id_pasang', $id_pasang)->delete();
        $this->DetailbahanModel->where('id_pasang', $id_pasang)->delete();

        return redirect()->back()->with('success', 'Data Pemasangan Berhasil Dihapus');
    }

    public function preview($id)
    {
        $data = [
            'title' => 'Halaman Bahan Pemasangan',
            'daftar_produk' => $this->ProdukModel->AllData(),
            'pemasangan' => $this->BahanModel->where('id_pasang', $id)->first(),
            'daftar_detail' => $this->DetailbahanModel->where('id_pasang', $id)
                ->join('produk', 'produk.id_produk=detail_bahan.id_produk', 'left')
                ->join('kategori_produk', 'kategori_produk.id_kategori=produk.id_kategori', 'left')
                ->join('subkategori', 'subkategori.id_subkate=produk.id_subkate', 'left')
                ->join('satuan_produk', 'satuan_produk.id_satuan=produk.id_satuan', 'left')
                ->select('detail_bahan.tanggal, produk.nama_produk, produk.stok, produk.id_produk, kategori_produk.nama_kategori, satuan_produk.nama_satuan, satuan_produk.singkatan, detail_bahan.jumlah, detail_bahan.keterangan, detail_bahan.id')
                ->findAll()
        ];
        // var_dump($data);

        echo view('admin/bahan/detail', $data);
    }

    public function store2()
    {
        $tanggal_from_datepicker = $this->request->getPost('tanggal');

        // Ubah format tanggal sesuai dengan format database (Y-m-d)
        $tanggal = date('Y-m-d', strtotime($tanggal_from_datepicker));

        $id_produk = $this->request->getPost('id_produk');
        $stok = $this->request->getPost('stok');
        $jumlah = $this->request->getPost('jumlah');
        if ($stok >= $jumlah) {
            $sisa = $stok - $jumlah;
            $updatedata = [
                'stok' => $sisa,
            ];
            $this->ProdukModel->update($id_produk, $updatedata);
            //simpan data le database
            $data = [
                'id_pasang' => esc($this->request->getPost('id_pasang')),
                'id_produk' => esc($this->request->getPost('id_produk')),
                'keterangan' => esc($this->request->getPost('keterangan')),
                'jumlah' => esc($this->request->getPost('jumlah')),
                'tanggal' => $tanggal,
            ];
            $this->DetailbahanModel->insert($data);

            return redirect()->back()->with('success', 'Bahan pemasangan Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('success', 'Bahan pemasangan Stok Tidak Cukup');
        }
    }

    public function update2($id)
    {

        $tanggal_from_datepicker = $this->request->getPost('tanggal');

        // Ubah format tanggal sesuai dengan format database (Y-m-d)
        $tanggal = date('Y-m-d', strtotime($tanggal_from_datepicker));

        $id_produk = $this->request->getPost('id_produk');
        $stok = $this->request->getPost('stok');
        $jumlah = $this->request->getPost('jumlah');
        $jumlahawal = $this->request->getPost('jumlahawal');
        if ($jumlah > $jumlahawal) {
            $total = $jumlah - $jumlahawal;
            $sisa = $stok - $total;
            $updatedata = [
                'stok' => $sisa,
            ];
            $this->ProdukModel->update($id_produk, $updatedata);
        } else if ($jumlah < $jumlahawal) {
            $total = $jumlahawal - $jumlah;
            $sisa = $stok + $total;
            $updatedata = [
                'stok' => $sisa,
            ];
            $this->ProdukModel->update($id_produk, $updatedata);
        }
        //simpan data le database
        $data = [
            'keterangan' => esc($this->request->getPost('keterangan')),
            'jumlah' => esc($this->request->getPost('jumlah')),
            'tanggal' => $tanggal,
        ];
        $this->DetailbahanModel->update($id, $data);

        return redirect()->back()->with('success', 'Bahan Bahan Pemasangan Berhasil Diubah');
    }

    public function destroy2($id)
    {
        $detail = $this->DetailbahanModel->where('id', $id)
            ->join('produk', 'produk.id_produk = detail_bahan.id_produk', 'left')
            ->first();
        $updatedata = [
            'id_produk' =>  $detail->id_produk,
            'stok' => $detail->stok + $detail->jumlah,
        ];
        $this->ProdukModel->update($detail->id_produk, $updatedata);

        // Hapus data
        $this->DetailbahanModel->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data Bahan Pemasangan Berhasil Dihapus');
    }
}
