<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;

class importController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman import Produk'
        ];

        return view('admin/import/index', $data);
    }

    public function produk()
    {
        $file = $this->request->getFile('produk_file');

        if ($file->isValid() && $file->getExtension() === 'xls') {
            $spreadsheet = IOFactory::load($file->getTempName());
            $worksheet = $spreadsheet->getActiveSheet();

            $data = [];
            $firstRow = true;

            foreach ($worksheet->getRowIterator() as $row) {
                // Lewati baris pertama (header)
                if ($firstRow) {
                    $firstRow = false;
                    continue;
                }

                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);

                $rowData = [];

                foreach ($cellIterator as $cell) {
                    $rowData[] = $cell->getValue();
                }

                $data[] = $rowData;
            }

            // Di sini Anda dapat melakukan query ke database untuk menyimpan data
            // Sesuaikan dengan kebutuhan aplikasi Anda
            foreach ($data as $row) {
                $slug = url_title($row[0], '-', TRUE);
                $satuan = $this->SatuanModel->orderBy('id_satuan', 'DESC')->first();
                $kategori = $this->KategoriModel->orderBy('id_kategori', 'DESC')->first();
                $subkate = $this->SubkategoriModel->where('id_kategori', $kategori->id_kategori)
                    ->orderBy('id_subkate', 'DESC')->first();

                //simpan data le database
                $data = [
                    'nama_produk' => $row[0],
                    'harga' => $row[1],
                    'stok' => $row[2],
                    'id_kategori' => $kategori->id_kategori,
                    'id_subkate' => $subkate->id_subkate,
                    'id_satuan' => $satuan->id_satuan,
                    'slug_produk' => $slug,
                ];
                $this->ProdukModel->insert($data);
            }

            return redirect()->back()->with('success', 'Data Produk Berhasil Ditambahkan');
            // var_dump($data); // Contoh: tampilkan data dalam var_dump
        } else {
            return redirect()->back()->with('success', 'File Import Berlum diupload');
        }
    }

    public function download()
    {
        $file = 'Import_Produk.xls'; // Ganti dengan path file yang ingin di-download

        if (file_exists($file)) {
            return $this->response->download($file, null);
        } else {
            // Jika file tidak ditemukan, tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            return redirect()->back()->with('success', 'File Template Tidak Tersedia');
        }
    }
}
