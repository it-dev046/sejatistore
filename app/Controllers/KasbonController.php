<?php

namespace App\Controllers;

class KasbonController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman kasbon Karyawan',
            'userId' => $this->session->get('id'),
            'daftar_kasbon' => $this->KasbonModel->orderBy('id_kasbon', 'DESC')->findAll(),
            'daftar_karyawan' => $this->KaryawanModel->orderBy('id_karyawan', 'DESC')->findAll(),
        ];

        return view('admin/kasbon/index', $data);
    }

    public function store()
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            $id_karyawan = $this->request->getPost('id_karyawan');
            $potongan = $this->request->getPost('potongan');
            $jumlah = $this->request->getPost('jumlah');
            $sisa = $jumlah - $potongan;

            $karyawan = $this->KaryawanModel->where('id_karyawan', $id_karyawan)->first();

            //simpan data database
            $data = [
                'tanggal' => esc($this->request->getPost('tanggal')),
                'tempo' => esc($this->request->getPost('tempo')),
                'keterangan' => esc($this->request->getPost('keterangan')),
                'nama' => $karyawan->nama,
                'jumlah' => $jumlah,
                'sisa' => $sisa,
                'potongan' => $potongan,
            ];
            $this->KasbonModel->insert($data);

            return redirect()->back()->with('success', 'Data kasbon Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function update($id_kasbon)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            $potongan = $this->request->getPost('potongan');
            $jumlah = $this->request->getPost('jumlah');
            $sisa = $jumlah - $potongan;

            //simpan data database
            $data = [
                'tempo' => esc($this->request->getPost('tempo')),
                'keterangan' => esc($this->request->getPost('keterangan')),
                'jumlah' => $jumlah,
                'sisa' => $sisa,
                'potongan' => $potongan,
            ];
            $this->KasbonModel->update($id_kasbon, $data);

            return redirect()->back()->with('success', 'Data kasbon Berhasil Diubah');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function destroy($id_kasbon)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            // Hapus data
            $this->KasbonModel->where('id_kasbon', $id_kasbon)->delete();

            return redirect()->back()->with('success', 'Data kasbon Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }
}
