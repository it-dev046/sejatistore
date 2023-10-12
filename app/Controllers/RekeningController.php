<?php

namespace App\Controllers;

class RekeningController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Daftar Rekening',
            'userId' => $this->session->get('id'),
            'daftar_rekening' => $this->RekeningModel->orderBy('id_rekening', 'DESC')->findAll(),
            'daftar_usaha' => $this->RekeningModel
                ->orderBy('usaha', 'ASC')
                ->distinct()
                ->select('usaha')
                ->findAll(),
        ];

        return view('admin/rekening/index', $data);
    }

    public function store()
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            //simpan data database
            $data = [
                'usaha' => esc($this->request->getPost('usaha')),
                'rek' => esc($this->request->getPost('rek')),
                'AN' => esc($this->request->getPost('AN')),
                'bank' => esc($this->request->getPost('bank')),
            ];
            $this->RekeningModel->insert($data);

            return redirect()->back()->with('success', 'Data rekening Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function update($id_rekening)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            //simpan data ke database
            $data = [
                'usaha' => esc($this->request->getPost('usaha')),
                'rek' => esc($this->request->getPost('rek')),
                'AN' => esc($this->request->getPost('AN')),
                'bank' => esc($this->request->getPost('bank')),
            ];
            $this->RekeningModel->update($id_rekening, $data);

            return redirect()->back()->with('success', 'Data rekening Berhasil Diubah');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function destroy($id_rekening)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            // Hapus data
            $this->RekeningModel->where('id_rekening', $id_rekening)->delete();

            return redirect()->back()->with('success', 'Data rekening Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function uraian()
    {
        $usaha = $this->request->getPost('usaha');
        $data = [
            'title' => 'Halaman Detail Rekening',
            'userId' => $this->session->get('id'),
            'daftar_rekening' => $this->RekeningModel
                ->where('usaha =', $usaha)
                ->findAll(),
        ];
        // var_dump($data);

        echo view('admin/rekening/uraian', $data);
    }
}
