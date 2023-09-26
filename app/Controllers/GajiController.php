<?php

namespace App\Controllers;

class GajiController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Gaji Karyawan',
            'userId' => $this->session->get('id'),
            'daftar_gaji' => $this->GajiModel->orderBy('id_gaji', 'DESC')->findAll(),
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
            $gapok = $this->request->getPost('gapok');
            $bonus = $this->request->getPost('bonus');
            $potongan = $this->request->getPost('potongan');

            $total = $gapok + $bonus - $potongan;
            $karyawan = $this->KaryawanModel->where('id_karyawan', $id_karyawan)->first();

            //simpan data database
            $data = [
                'tanggal' => esc($this->request->getPost('tanggal')),
                'keterangan' => esc($this->request->getPost('keterangan')),
                'nama' => $karyawan->nama,
                'rek' => $karyawan->rekening,
                'bank' => $karyawan->bank,
                'bonus' => $bonus,
                'gapok' => $gapok,
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
            $gapok = $this->request->getPost('gapok');
            $bonus = $this->request->getPost('bonus');
            $potongan = $this->request->getPost('potongan');

            $total = $gapok + $bonus - $potongan;
            //simpan data database
            $data = [
                'keterangan' => esc($this->request->getPost('keterangan')),
                'rek' => esc($this->request->getPost('rek')),
                'bank' => esc($this->request->getPost('bank')),
                'bonus' => $bonus,
                'gapok' => $gapok,
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
