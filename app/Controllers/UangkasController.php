<?php

namespace App\Controllers;

class UangkasController extends BaseController
{

    public function preview($id_sumber)
    {
        $sumber =  $this->SumberKasModel
            ->where('id_sumber', $id_sumber)
            ->first();
        $total = $this->UangKasModel->jumlahbayar($id_sumber);
        $saldo = $sumber['saldo'];
        $selisih = $saldo - $total;
        $data = [
            'title' => 'Halaman Uang Kas',
            'total' => $total,
            'saldo' => $saldo,
            'selisih' => $selisih,
            'daftar_uang' => $this->UangKasModel->orderBy('id_uang', 'DESC')
                ->where('uang_kas.id_sumber', $id_sumber)
                ->findAll(),
            'sumber' => $this->SumberKasModel
                ->where('id_sumber', $id_sumber)
                ->first(),
            'katekas' => $this->KatekasModel->findAll(),
        ];
        return view('admin/kas/uang', $data);
        // var_dump($data);
    }

    public function sumber()
    {
        $data = [
            'title' => 'Halaman Sumber Kas Cash',
            'daftar_sumber' => $this->SumberKasModel->orderBy('id_sumber', 'DESC')
                ->where('cash', 1)
                ->findAll(),
        ];

        return view('admin/kas/sumberuang', $data);
    }

    public function store()
    {
        $nilai = $this->request->getPost('nilai');
        $jumlah = $this->request->getPost('jumlah');
        $subtotal = $nilai * $jumlah;
        $data = [
            'id_sumber' => esc($this->request->getPost('id_sumber')),
            'jenis' => esc($this->request->getPost('jenis')),
            'nilai' => $nilai,
            'jumlah' => $jumlah,
            'subtotal' => $subtotal,
        ];
        $this->UangKasModel->insert($data);

        return redirect()->back()->with('success', 'Data Uang Kas Berhasil Ditambahkan');
    }

    public function update($id_uang)
    {
        $nilai = $this->request->getPost('nilai');
        $jumlah = $this->request->getPost('jumlah');
        $subtotal = $nilai * $jumlah;
        $data = [
            'jumlah' => $jumlah,
            'subtotal' => $subtotal,
        ];
        $this->UangKasModel->update($id_uang, $data);

        return redirect()->back()->with('success', 'Data Uang Kas Berhasil Diubah');
    }

    public function destroy($id_uang)
    {
        // Hapus data
        $this->UangKasModel->where('id_uang', $id_uang)->delete();

        return redirect()->back()->with('success', 'Data Uang Kas Berhasil Dihapus');
    }
}
