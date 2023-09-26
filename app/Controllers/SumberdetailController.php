<?php

namespace App\Controllers;

date_default_timezone_set("Asia/Manila");

class SumberdetailController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Sumber Detail Kas',
            'sumber' => $this->SumberKasModel->orderBy('id_sumber', 'DESC')->findAll(),
            'daftar_sumber' => $this->DetailSumberModel->orderBy('id_sumber', 'DESC')->findAll(),
        ];

        return view('admin/kas/sumberdetail', $data);
    }

    public function store()
    {
        $id_sumber = $this->request->getPost('id_sumber');
        $sumber = $this->SumberKasModel->where('id_sumber', $id_sumber)->first();
        $data = [
            'id_sumber' => $sumber['id_sumber'],
            'kode' => $sumber['kode'],
            'saldo' => $sumber['saldo'],
            'keterangan' => $sumber['keterangan'],
        ];

        $this->DetailSumberModel->insert($data);

        return redirect()->back()->with('success', 'Data Detail Sumber Kas Berhasil Ditambahkan');
    }

    public function update($id)
    {
        $id_sumber = $this->request->getPost('id_sumber');
        $sumber = $this->SumberKasModel->where('id_sumber', $id_sumber)->first();
        $data = [
            'saldo' => $sumber['saldo'],
        ];

        $this->DetailSumberModel->update($id, $data);

        return redirect()->back()->with('success', 'Saldo Sumber Kas Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $this->DetailSumberModel->where('id', $id)->delete();
        // Hapus data
        return redirect()->back()->with('success', 'Data Detail Sumber Kas Berhasil Dihapus');
    }

    public function cetak()
    {

        $tanggal_from_datepicker = $this->request->getPost('tanggal');
        // Ubah format tanggal sesuai dengan format database (Y-m-d)
        $tanggal = date('Y-m-d', strtotime($tanggal_from_datepicker));
        $data = [
            'title' => 'Laporan_Kas_' . date('d_F_Y', strtotime($tanggal)),
            'tgl' => $tanggal,
            'daftar_sumber' => $this->DetailSumberModel->orderBy('id_sumber', 'DESC')->findAll(),
            'detail_kas' => $this->KasModel
                ->where('DATE(tanggal) =', $tanggal)
                ->findAll(),
        ];

        return view('admin/cetak/sumber', $data);
    }
}
