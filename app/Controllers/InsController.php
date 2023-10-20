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
                ->join('rekening', 'rekening.id_rekening = karyawan.id_rekening', 'left')
                ->select('insentif.*, karyawan.op, karyawan.um, karyawan.nama, rekening.rek, rekening.bank, rekening.AN')
                ->orderBy('id_ins', 'DESC')
                ->findAll(),
            'daftar_karyawan' => $this->KaryawanModel->orderBy('nama', 'ASC')
                ->join('rekening', 'rekening.id_rekening = karyawan.id_rekening', 'left')
                ->join('kasbon', 'kasbon.id_rekening = rekening.id_rekening', 'left')
                ->select('karyawan.*, rekening.*, kasbon.sisa')
                ->findAll(),
        ];

        return view('admin/ins/index', $data);
    }

    public function store()
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            $id_karyawan = $this->request->getPost('id_karyawan');
            $karyawan =  $this->KaryawanModel->orderBy('id_karyawan', 'DESC')
                ->join('rekening', 'rekening.id_rekening = karyawan.id_rekening', 'left')
                ->where('id_karyawan', $id_karyawan)->first();
            $cek = $this->KasbonModel->isInvoiceExists($karyawan->id_rekening);
            $potongan = $this->request->getPost('potongan');
            if ($cek) {
                $kasbon = $this->KasbonModel->orderBy('id_kasbon', 'ASC')
                    ->where('id_rekening', $karyawan->id_rekening)
                    ->first();
                $sisakasbon = $kasbon->sisa - $potongan;
                $data = [
                    'sisa' => $sisakasbon,
                ];
                $this->KasbonModel->update($kasbon->id_kasbon, $data);
            }

            $tglakhir = $this->request->getPost('tanggal');
            // Menghitung tanggal 6 hari sebelumnya
            $nama = $karyawan->nama;
            $tglawal = date('Y-m-d', strtotime('-6 days', strtotime($tglakhir)));
            $mingguan = $this->AbsenModel->mingguan($tglawal, $tglakhir, $nama);
            $karyawan = $this->KaryawanModel->where('id_karyawan', $id_karyawan)->first();

            $allpotongan = $potongan + $mingguan;
            $total = $karyawan->um + $karyawan->op - $allpotongan;

            //simpan data database
            $data = [
                'tanggal' => esc($this->request->getPost('tanggal')),
                'keterangan' => esc($this->request->getPost('keterangan')),
                'id_karyawan' => $id_karyawan,
                'potongan' => $potongan,
                'absen' => $mingguan,
                'total' => $total,
            ];
            $this->InsModel->insert($data);

            return redirect()->back()->with('success', 'Data Insentif Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function destroy($id_ins)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            $ins = $this->InsModel->orderBy('id_ins', 'DESC')
                ->join('karyawan', 'karyawan.id_karyawan = insentif.id_karyawan', 'left')
                ->join('rekening', 'rekening.id_rekening = karyawan.id_rekening', 'left')
                ->select('insentif.potongan, rekening.id_rekening')
                ->where('id_ins', $id_ins)->first();
            $id_rekening = $ins->id_rekening;
            $potongan = $ins->potongan;
            $cek = $this->KasbonModel->isInvoiceExists($id_rekening);
            if ($cek) {
                $kasbon = $this->KasbonModel->orderBy('id_kasbon', 'ASC')
                    ->where('id_rekening', $id_rekening)
                    ->first();
                $sisakasbon = $kasbon->sisa + $potongan;
                $data = [
                    'sisa' => $sisakasbon,
                ];
                $this->KasbonModel->update($kasbon->id_kasbon, $data);
            }
            // Hapus data
            $this->InsModel->where('id_ins', $id_ins)->delete();

            return redirect()->back()->with('success', 'Data Insentif Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }
}
