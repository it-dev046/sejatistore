<?php

namespace App\Controllers;

class InsController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Insentif Karyawan',
            'userId' => $this->session->get('id'),
            'daftar_ins' => $this->InsModel
                ->join('karyawan', 'karyawan.id_karyawan = insentif.id_karyawan', 'left')
                ->select('insentif.*, karyawan.op, karyawan.um, karyawan.rekening, karyawan.bank, karyawan.nama')
                ->orderBy('id_ins', 'DESC')
                ->findAll(),
            'daftar_karyawan' => $this->KaryawanModel->orderBy('id_karyawan', 'DESC')->findAll(),
        ];

        return view('admin/ins/index', $data);
    }

    public function store()
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            $id_karyawan = $this->request->getPost('id_karyawan');
            $potongan = $this->request->getPost('potongan');
            $tglakhir = $this->request->getPost('tanggal');

            // Menghitung tanggal 6 hari sebelumnya
            $tglawal = date('Y-m-d', strtotime('-6 days', strtotime($tglakhir)));
            $mingguan = $this->AbsenModel->mingguan($tglawal, $tglakhir);
            $karyawan = $this->KaryawanModel->where('id_karyawan', $id_karyawan)->first();

            $allpotongan = $potongan + $mingguan;
            $total = $karyawan->um + $karyawan->op - $allpotongan;

            //simpan data database
            $data = [
                'tanggal' => esc($this->request->getPost('tanggal')),
                'keterangan' => esc($this->request->getPost('keterangan')),
                'id_karyawan' => $id_karyawan,
                'potongan' => $allpotongan,
                'total' => $total,
            ];
            $this->InsModel->insert($data);

            return redirect()->back()->with('success', 'Data Insentif Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function update($id_ins)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            $id_karyawan = $this->request->getPost('id_karyawan');
            $potongan = $this->request->getPost('potongan');
            $tglakhir = $this->request->getPost('tanggal');

            // Menghitung tanggal 6 hari sebelumnya
            $tglawal = date('Y-m-d', strtotime('-6 days', strtotime($tglakhir)));
            $mingguan = $this->AbsenModel->mingguan($tglawal, $tglakhir);
            $karyawan = $this->KaryawanModel->where('id_karyawan', $id_karyawan)->first();

            $allpotongan = $potongan + $mingguan;
            $total = $karyawan->um + $karyawan->op - $allpotongan;
            //simpan data database
            $data = [
                'tanggal' => esc($this->request->getPost('tanggal')),
                'keterangan' => esc($this->request->getPost('keterangan')),
                'potongan' => $allpotongan,
                'total' => $total,
            ];
            $this->InsModel->update($id_ins, $data);

            return redirect()->back()->with('success', 'Data Insentif Berhasil Diubah');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function destroy($id_ins)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            // Hapus data
            $this->InsModel->where('id_ins', $id_ins)->delete();

            return redirect()->back()->with('success', 'Data Insentif Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }
}
