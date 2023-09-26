<?php

namespace App\Controllers;

date_default_timezone_set("Asia/Manila");

class bulananController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Daftar Bulanan Perusahaan',
            'userId' => $this->session->get('id'),
            'daftar_bulanan' => $this->BulananModel->orderBy('id_bulanan', 'DESC')
                ->findAll(),
        ];

        return view('admin/bulanan/index', $data);
    }

    public function store()
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {

            //simpan data database
            $data = [
                'tempo' => esc($this->request->getPost('tempo')),
                'nama' => esc($this->request->getPost('nama')),
                'nomor' => esc($this->request->getPost('nomor')),
                'keterangan' => esc($this->request->getPost('keterangan')),
            ];
            $this->BulananModel->insert($data);

            return redirect()->back()->with('success', 'Data bulanan Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function update($id_bulanan)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            //simpan data database
            $data = [
                'tempo' => esc($this->request->getPost('tempo')),
                'nama' => esc($this->request->getPost('nama')),
                'nomor' => esc($this->request->getPost('nomor')),
                'keterangan' => esc($this->request->getPost('keterangan')),
            ];
            $this->BulananModel->update($id_bulanan, $data);

            return redirect()->back()->with('success', 'Data bulanan Berhasil Diubah');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function destroy($id_bulanan)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            // Hapus data
            $this->BulananModel->where('id_bulanan', $id_bulanan)->delete();

            return redirect()->back()->with('success', 'Data bulanan Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function uraian($id_bulanan)
    {
        $data = [
            'title' => 'Halaman Detail bulanan',
            'bulanan' => $this->BulananModel
                ->where('id_bulanan', $id_bulanan)
                ->first(),
            'daftar_uraian' => $this->DetailBulananModel
                ->where('id_bulanan', $id_bulanan)
                ->orderBy('tanggal', 'DESC')
                ->findAll(),
        ];
        // var_dump($data);

        echo view('admin/bulanan/uraian', $data);
    }

    public function uraiansimpan()
    {
        //simpan data database
        $tanggal = $this->request->getPost('tanggal');
        $id_bulanan = $this->request->getPost('id_bulanan');
        $keterangan = $this->request->getPost('keterangan');
        $sumber = $this->request->getPost('sumber');
        $tujuan = $this->request->getPost('tujuan');
        $bayar = $this->request->getPost('bayar');

        $data = [
            'tanggal' => $tanggal,
            'id_bulanan' => $id_bulanan,
            'sumber' => $sumber,
            'tujuan' => $tujuan,
            'keterangan' => $keterangan,
            'bayar' => $bayar,
        ];

        $this->DetailBulananModel->insert($data);

        return redirect()->back()->with('success', 'Data Uraian Data bulanan Berhasil Ditambahkan');
    }

    public function uraianhapus($id)
    {
        // Hapus data
        $this->DetailBulananModel->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data Uraian Data bulanan Berhasil dihapus');
    }
}
