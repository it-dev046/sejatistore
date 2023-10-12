<?php

namespace App\Controllers;

class PosisiController extends BaseController
{
    public function store()
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            //simpan data database
            $data = [
                'nama' => esc($this->request->getPost('nama')),
            ];
            $this->PosisiModel->insert($data);

            return redirect()->back()->with('success', 'Data posisi Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function update($id_posisi)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            //simpan data ke database
            $data = [
                'nama' => esc($this->request->getPost('nama')),
            ];
            $this->PosisiModel->update($id_posisi, $data);

            return redirect()->back()->with('success', 'Data posisi Berhasil Diubah');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function destroy($id_posisi)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            // Hapus data
            $this->PosisiModel->where('id_posisi', $id_posisi)->delete();

            return redirect()->back()->with('success', 'Data posisi Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }
}
