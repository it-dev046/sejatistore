<?php

namespace App\Controllers;

class LabarugikasController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Detail Laba Rugi',
            'katekas' => $this->KatekasModel->findAll(),
            'allkategori' => $this->KasModel->getLatestDataByCategory(),
            'daftar_labarugi' => $this->LabarugiModel
                ->orderBy('id', 'ASC')
                ->join('katekas', 'katekas.id_katekas = labarugi.id_katekas', 'left')
                ->select('labarugi.*, katekas.kode')
                ->findAll(),
        ];
        return view('admin/kas/labarugi', $data);
    }

    public function preview()
    {
        $id_katekas = $this->request->getPost('id_katekas');
        $tgl_awal = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');

        $debet = $this->KasModel->jumlahkatedebet($id_katekas, $tgl_awal, $tgl_akhir);
        $kredit = $this->KasModel->jumlahkatekredit($id_katekas, $tgl_awal, $tgl_akhir);
        $data = [
            'title' => 'Halaman Detail Kategori Kas',
            'daftar_kas' => $this->KasModel->orderBy('tanggal', 'ASC')
                ->where('kas.id_katekas', $id_katekas)
                ->where('DATE(tanggal) >=', $tgl_awal)
                ->where('DATE(tanggal) <=', $tgl_akhir)
                ->join('katekas', 'katekas.id_katekas = kas.id_katekas', 'left')
                ->join('sumber_kas', 'sumber_kas.id_sumber = kas.id_sumber', 'left')
                ->select('kas.*, sumber_kas.kode as kode_sumber, katekas.kode')
                ->findAll(),
            'katekas' => $this->KatekasModel->findAll(),
            'jumlahdebet' => $debet,
            'jumlahkredit' => $kredit,
        ];
        // var_dump($data);

        echo view('admin/kas/detail', $data);
    }

    public function store()
    {
        $id_katekas = $this->request->getPost('id_katekas');
        $jenis = $this->request->getPost('jenis');
        $tgl_awal = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');

        $debet = $this->KasModel->jumlahkatedebet($id_katekas, $tgl_awal, $tgl_akhir);
        $kredit = $this->KasModel->jumlahkatekredit($id_katekas, $tgl_awal, $tgl_akhir);
        if ($jenis == 1) {
            $nilai = $debet - $kredit;
        } else {
            $nilai = $kredit - $debet;
        }

        $data = [
            'keterangan' => esc($this->request->getPost('keterangan')),
            'id_katekas' => $id_katekas,
            'jenis' => $jenis,
            'subtotal' => $nilai,
        ];
        $this->LabarugiModel->insert($data);

        return redirect()->back()->with('success', 'Data Laba Rugi Kas Berhasil Ditambahkan');
    }

    public function update($id)
    {
        $id_katekas = $this->request->getPost('id_katekas');
        $jenis = $this->request->getPost('jenis');
        $tgl_awal = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');

        $debet = $this->KasModel->jumlahkatedebet($id_katekas, $tgl_awal, $tgl_akhir);
        $kredit = $this->KasModel->jumlahkatekredit($id_katekas, $tgl_awal, $tgl_akhir);
        if ($jenis == 1) {
            $nilai = $debet - $kredit;
        } else {
            $nilai = $kredit - $debet;
        }

        $data = [
            'subtotal' => $nilai,
        ];
        $this->LabarugiModel->update($id, $data);
        return redirect()->back()->with('success', 'Saldo Kategori Kas Berhasil Diupdate');
    }

    public function destroy($id)
    {
        // Hapus data
        $this->LabarugiModel->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data Laba Rugi Kas Berhasil Dihapus');
    }
}
