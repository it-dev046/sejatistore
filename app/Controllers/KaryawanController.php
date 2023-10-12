<?php

namespace App\Controllers;

class KaryawanController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman karyawan',
            'userId' => $this->session->get('id'),
            'daftar_karyawan' => $this->KaryawanModel->orderBy('id_karyawan', 'DESC')
                ->join('rekening', 'rekening.id_rekening = karyawan.id_rekening', 'left')->findAll(),
            'daftar_posisi' => $this->PosisiModel->orderBy('nama', 'ASC')->findAll(),
            'daftar_rekening' => $this->RekeningModel->orderBy('AN', 'ASC')->findAll(),
        ];

        return view('admin/karyawan/index', $data);
    }

    public function store()
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            //simpan data database
            $data = [
                'nama' => esc($this->request->getPost('nama')),
                'tanggal' => esc($this->request->getPost('tanggal')),
                'alamat' => esc($this->request->getPost('alamat')),
                'ktp' => esc($this->request->getPost('ktp')),
                'gapok' => esc($this->request->getPost('gapok')),
                'um' => esc($this->request->getPost('um')),
                'op' => esc($this->request->getPost('op')),
                'bonus' => esc($this->request->getPost('bonus')),
                'id_rekening' => esc($this->request->getPost('id_rekening')),
                'posisi' => esc($this->request->getPost('posisi')),
            ];
            $this->KaryawanModel->insert($data);

            return redirect()->back()->with('success', 'Data karyawan Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function update($id_karyawan)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            //simpan data ke database
            $data = [
                'nama' => esc($this->request->getPost('nama')),
                'tanggal' => esc($this->request->getPost('tanggal')),
                'alamat' => esc($this->request->getPost('alamat')),
                'ktp' => esc($this->request->getPost('ktp')),
                'id_rekening' => esc($this->request->getPost('id_rekening')),
                'posisi' => esc($this->request->getPost('posisi')),
                'gapok' => esc($this->request->getPost('gapok')),
                'um' => esc($this->request->getPost('um')),
                'op' => esc($this->request->getPost('op')),
                'bonus' => esc($this->request->getPost('bonus')),
            ];
            $this->KaryawanModel->update($id_karyawan, $data);

            return redirect()->back()->with('success', 'Data karyawan Berhasil Diubah');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function destroy($id_karyawan)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            // Hapus data
            $this->KaryawanModel->where('id_karyawan', $id_karyawan)->delete();

            return redirect()->back()->with('success', 'Data karyawan Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }
}
