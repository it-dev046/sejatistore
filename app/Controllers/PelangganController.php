<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PelangganController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Data Pelanggan',
            'daftar_pel' => $this->PelangganModel->AllData(),
            'katepel' => $this->PelangganModel->AllKatepel()
        ];

        return view('admin/pelanggan/index', $data);
    }
    public function store()
    {
        // Buat Slug pel
        $slug = url_title($this->request->getPost('nama_pel'), '-', TRUE);

        //simpan data le database
        $data = [
            'nama_pel' => esc($this->request->getPost('nama_pel')),
            'telepon' => esc($this->request->getPost('telepon')),
            'alamat' => esc($this->request->getPost('alamat')),
            'kota' => esc($this->request->getPost('kota')),
            'id_katepel' => esc($this->request->getPost('id_katepel')),
            'slug_pel' => $slug
        ];
        $this->PelangganModel->insert($data);

        return redirect()->back()->with('success', 'Data Pelanggan Berhasil Ditambahkan');
    }

    public function update($id_pel)
    {
        // Buat Slug kategori
        $slug = url_title($this->request->getPost('nama_pel'), '-', TRUE);

        //simpan data ke database
        $data = [
            'nama_pel' => esc($this->request->getPost('nama_pel')),
            'telepon' => esc($this->request->getPost('telepon')),
            'alamat' => esc($this->request->getPost('alamat')),
            'kota' => esc($this->request->getPost('kota')),
            'id_katepel' => esc($this->request->getPost('id_katepel')),
            'slug_pel' => $slug
        ];
        $this->PelangganModel->update($id_pel, $data);

        return redirect()->back()->with('success', 'Data Pelanggan Berhasil Diubah');
    }

    public function destroy($id_pel)
    {
        // Hapus data
        $this->PelangganModel->where('id_pel', $id_pel)->delete();

        return redirect()->back()->with('success', 'Data Pelanggan Berhasil Dihapus');
    }

    public function exportpelanggan()
    {
        $produk = $this->PelangganModel->AllData();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama Pelanggan')
            ->setCellValue('B1', 'No Telepon')
            ->setCellValue('C1', 'Alamat')
            ->setCellValue('D1', 'Kota')
            ->setCellValue('E1', 'Kategori');

        $column = 2;

        foreach ($produk as $value) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $value['nama_pel'])
                ->setCellValue('B' . $column, $value['telepon'])
                ->setCellValue('C' . $column, $value['alamat'])
                ->setCellValue('D' . $column, $value['kota'])
                ->setCellValue('E' . $column, $value['nama_katepel']);

            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename =  'Data-Pelanggan-' . date('Y-m-d-His');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
