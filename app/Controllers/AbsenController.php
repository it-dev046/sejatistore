<?php

namespace App\Controllers;

class AbsenController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Absensi Karyawan',
            'userId' => $this->session->get('id'),
            'daftar_absen' => $this->AbsenModel->orderBy('tanggal', 'DESC')->findAll(),
            'daftar_karyawan' => $this->KaryawanModel->orderBy('nama', 'ASC')->findAll(),
            'daftar_status' => $this->StatusModel->orderBy('status', 'ASC')->findAll(),
        ];

        return view('admin/absen/index', $data);
    }

    public function store()
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            //simpan data database
            $id_status = $this->request->getPost('status');
            $status = $this->StatusModel->where('id_status', $id_status)->first();
            $data = [
                'nama' => esc($this->request->getPost('nama')),
                'tanggal' => esc($this->request->getPost('tanggal')),
                'status' => $status->status,
                'potongan' => $status->potongan,
            ];
            $this->AbsenModel->insert($data);

            return redirect()->back()->with('success', 'Data absen Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function update($id_absen)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            //simpan data ke database
            $id_status = $this->request->getPost('status');
            $status = $this->StatusModel->where('id_status', $id_status)->first();
            $data = [
                'status' => $status->status,
                'potongan' => $status->potongan,
            ];
            $this->AbsenModel->update($id_absen, $data);

            return redirect()->back()->with('success', 'Data absen Berhasil Diubah');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function destroy($id_absen)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            // Hapus data
            $this->AbsenModel->where('id_absen', $id_absen)->delete();

            return redirect()->back()->with('success', 'Data absen Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function simpanstatus()
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            //simpan data database
            $data = [
                'potongan' => esc($this->request->getPost('potongan')),
                'status' => esc($this->request->getPost('status')),
            ];
            $this->StatusModel->insert($data);

            return redirect()->back()->with('success', 'Data status Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function updatestatus($id_status)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            //simpan data ke database
            $data = [
                'potongan' => esc($this->request->getPost('potongan')),
                'status' => esc($this->request->getPost('status')),
            ];
            $this->StatusModel->update($id_status, $data);

            return redirect()->back()->with('success', 'Data status Berhasil Diubah');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function destroystatus($id_status)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            // Hapus data
            $this->StatusModel->where('id_status', $id_status)->delete();

            return redirect()->back()->with('success', 'Data status Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }
}
