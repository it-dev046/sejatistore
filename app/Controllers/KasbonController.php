<?php

namespace App\Controllers;

class KasbonController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Kasbon',
            'userId' => $this->session->get('id'),
            'daftar_kasbon' => $this->KasbonModel->orderBy('id_kasbon', 'DESC')
                ->join('rekening', 'rekening.id_rekening = kasbon.id_rekening', 'left')->findAll(),
            'daftar_rekening' => $this->RekeningModel->orderBy('usaha', 'ASC')->findAll(),
        ];

        return view('admin/kasbon/index', $data);
    }

    public function store()
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            //simpan data database
            $data = [
                'tanggal' => esc($this->request->getPost('tanggal')),
                'keterangan' => esc($this->request->getPost('keterangan')),
                'id_rekening' => esc($this->request->getPost('id_rekening')),
                'jumlah' => esc($this->request->getPost('jumlah')),
                'sisa' => esc($this->request->getPost('jumlah')),
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
