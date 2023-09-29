<?php

namespace App\Controllers;

class GajiController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Gaji Karyawan',
            'userId' => $this->session->get('id'),
            'daftar_gaji' => $this->GajiModel
                ->join('karyawan', 'karyawan.id_karyawan = gaji.id_karyawan', 'left')
                ->select('gaji.*, karyawan.gapok, karyawan.bonus, karyawan.rekening, karyawan.bank, karyawan.nama')
                ->orderBy('id_gaji', 'DESC')->findAll(),
            'daftar_karyawan' => $this->KaryawanModel->orderBy('id_karyawan', 'DESC')->findAll(),
        ];

        return view('admin/gaji/index', $data);
    }

    public function store()
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            $id_karyawan = $this->request->getPost('id_karyawan');
            $potongan = $this->request->getPost('potongan');
            $karyawan = $this->KaryawanModel->where('id_karyawan', $id_karyawan)->first();

            $tanggal = $this->request->getPost('tanggal');
            $dateParts = date_parse($tanggal);
            $nama = $karyawan->nama;
            $bulan = $dateParts['month'];
            $tahun = $dateParts['year'];
            $bulanan = $this->AbsenModel->bulanan($nama, $bulan, $tahun);
            if (empty($bulanan)) {
                $total = $karyawan->gapok + $karyawan->bonus - $potongan;
            } else {
                $total = $karyawan->gapok - $potongan;
            }

            //simpan data database
            $data = [
                'tanggal' => esc($this->request->getPost('tanggal')),
                'keterangan' => esc($this->request->getPost('keterangan')),
                'id_karyawan' => $id_karyawan,
                'potongan' => $potongan,
                'total' => $total,
            ];
            $this->GajiModel->insert($data);

            return redirect()->back()->with('success', 'Data Gaji Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function update($id_gaji)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            $id_karyawan = $this->request->getPost('id_karyawan');
            $potongan = $this->request->getPost('potongan');
            $karyawan = $this->KaryawanModel->where('id_karyawan', $id_karyawan)->first();

            $total = $karyawan->gapok + $karyawan->bonus - $potongan;
            //simpan data database
            $data = [
                'keterangan' => esc($this->request->getPost('keterangan')),
                'potongan' => $potongan,
                'total' => $total,
            ];
            $this->GajiModel->update($id_gaji, $data);

            return redirect()->back()->with('success', 'Data Gaji Berhasil Diubah');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function destroy($id_gaji)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            // Hapus data
            $this->GajiModel->where('id_gaji', $id_gaji)->delete();

            return redirect()->back()->with('success', 'Data Gaji Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }
}
