<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProdukController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Produk',
            'kategori_produk' => $this->KategoriModel->findAll(),
            'daftar_produk' => $this->ProdukModel->AllData(),
            'daftar_subkate' => $this->SubkategoriModel->AllData(),
            'satuan_produk' => $this->SatuanModel->orderBy('nama_satuan', 'ASC')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/produk/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Halaman Tambah Produk',
            'kategori_produk' => $this->KategoriModel->findAll(),
            'daftar_subkate' => $this->SubkategoriModel->AllData(),
            'satuan_produk' => $this->SatuanModel->orderBy('nama_satuan', 'ASC')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/produk/tambah', $data);
    }

    public function preview($id_produk)
    {
        $data = [
            'title' => 'Halaman Edit Produk',
            'produk' => $this->ProdukModel->where('id_produk', $id_produk)->first(),
            'validation' => \Config\Services::validation(),
            'kategori_produk' => $this->KategoriModel->findAll(),
            'subkate_produk' => $this->SubkategoriModel->findAll(),
            'satuan_produk' => $this->SatuanModel->orderBy('nama_satuan', 'ASC')->findAll()
        ];
        echo view('admin/produk/edit', $data);
    }

    public function update($id_produk)
    {
        // Buat Slug produk
        $slug = url_title($this->request->getPost('nama_produk'), '-', TRUE);
        $foto = $this->request->getFile('foto');
        //cek file gambar Diubah
        if ($foto->getError() == 4) {
            $nama_file = $this->request->getPost('gambarLama');
        } else {
            //buat nama file
            $nama_file = $foto->getRandomName();
            // pindahkan file
            $foto->move('foto', $nama_file);
            $filelama = $this->request->getPost('gambarLama');
            if ($filelama == "") {
            } else {
                //hapus gambar lama
                unlink('foto/' . $this->request->getPost('gambarLama'));
            }
        }
        //simpan data le database
        $data = [
            'nama_produk' => esc($this->request->getPost('nama_produk')),
            'id_kategori' => esc($this->request->getPost('id_kategori')),
            'id_subkate' => esc($this->request->getPost('id_subkate')),
            'id_satuan' => esc($this->request->getPost('id_satuan')),
            'stok' => esc($this->request->getPost('stok')),
            'harga' => esc($this->request->getPost('harga')),
            'deskripsi' => esc($this->request->getPost('deskripsi')),
            'id_satuan' => esc($this->request->getPost('id_satuan')),
            'gambar_produk' => esc($this->request->getPost('foto')),
            'slug_produk' => $slug,
            'gambar_produk' => $nama_file
        ];
        $this->ProdukModel->update($id_produk, $data);
        return redirect()->to(base_url('produk'))->with('success', 'Data Produk Berhasil Diubah');
    }

    public function store()
    {
        // Buat Slug produk
        $slug = url_title($this->request->getPost('nama_produk'), '-', TRUE);
        $foto = $this->request->getFile('foto');
        $nama_file = $foto->getRandomName();

        //simpan data le database
        $data = [
            'nama_produk' => esc($this->request->getPost('nama_produk')),
            'id_kategori' => esc($this->request->getPost('id_kategori')),
            'id_subkate' => esc($this->request->getPost('id_subkate')),
            'id_satuan' => esc($this->request->getPost('id_satuan')),
            'stok' => esc($this->request->getPost('stok')),
            'harga' => esc($this->request->getPost('harga')),
            'deskripsi' => esc($this->request->getPost('deskripsi')),
            'id_satuan' => esc($this->request->getPost('id_satuan')),
            'gambar_produk' => esc($this->request->getPost('foto')),
            'slug_produk' => $slug,
            'gambar_produk' => $nama_file
        ];
        $foto->move('foto', $nama_file);
        $this->ProdukModel->insert($data);
        return redirect()->back()->with('success', 'Data Produk Berhasil Ditambahkan');
    }

    public function destroy($id_produk)
    {
        // Hapus data
        $nama_file = $this->request->getPost('gambar');
        if ($nama_file == "") {
        } else {
            unlink('foto/' . $this->request->getPost('gambar'));
        }
        $this->ProdukModel->where('id_produk', $id_produk)->delete();
        return redirect()->back()->with('success', 'Data Produk Berhasil Dihapus');
    }

    public function ambilKategori()
    {
        $id_kategori = $this->request->getPost('id_kategori');
        $sub = $this->SubkategoriModel->AllSubkate($id_kategori);
        echo '<option value="">--Pilihan--</option>';
        foreach ($sub as $key => $k) {
            echo "<option value=" . $k['id_subkate'] . ">" . $k['nama_subkate'] . "</option>";
        }
    }

    public function ambilProduk()
    {
        $id_produk = $this->request->getPost('id_produk');
        $produkData = $this->ProdukModel->where('id_produk', $id_produk)
            ->join('kategori_produk', 'kategori_produk.id_kategori=produk.id_kategori', 'left')
            ->join('subkategori', 'subkategori.id_subkate=produk.id_subkate', 'left')
            ->join('satuan_produk', 'satuan_produk.id_satuan=produk.id_satuan', 'left')
            ->first();

        if ($produkData) {
            return $this->response->setJSON($produkData);
        } else {
            return $this->response->setJSON([]);
        }
    }

    public function exportproduk()
    {
        $produk = $this->ProdukModel->AllData();
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama Produk')
            ->setCellValue('B1', 'kategori')
            ->setCellValue('C1', 'Sub Kategori')
            ->setCellValue('D1', 'Satuan')
            ->setCellValue('E1', 'Spesifikasi')
            ->setCellValue('F1', 'Harga')
            ->setCellValue('G1', 'Stok')
            ->setCellValue('H1', 'Deskripsi');
        $column = 2;
        foreach ($produk as $value) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $value['nama_produk'])
                ->setCellValue('B' . $column, $value['nama_kategori'])
                ->setCellValue('C' . $column, $value['nama_subkate'])
                ->setCellValue('D' . $column, $value['nama_satuan'])
                ->setCellValue('E' . $column, $value['singkatan'])
                ->setCellValue('F' . $column, $value['harga'])
                ->setCellValue('G' . $column, $value['stok'])
                ->setCellValue('H' . $column, $value['deskripsi']);
            $column++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename =  'Data-Produk-' . date('Y-m-d-His');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}
