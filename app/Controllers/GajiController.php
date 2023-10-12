<?php

namespace App\Controllers;

class GajiController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Gaji Karyawan',
            'userId' => $this->session->get('id'),
            'daftar_gaji' => $this->GajiModel
                ->join('karyawan', 'karyawan.id_karyawan = gaji.id_karyawan', 'left')
                ->join('rekening', 'rekening.id_rekening = karyawan.id_rekening', 'left')
                ->select('gaji.*, karyawan.gapok, karyawan.bonus, rekening.AN, rekening.rek, rekening.bank, karyawan.nama')
                ->orderBy('tanggal', 'DESC')->findAll(),
            'daftar_karyawan' => $this->KaryawanModel->orderBy('nama', 'ASC')
                ->join('rekening', 'rekening.id_rekening = karyawan.id_rekening', 'left')
                ->join('kasbon', 'kasbon.id_rekening = rekening.id_rekening', 'left')
                ->select('karyawan.*, rekening.*, kasbon.sisa')
                ->findAll(),
        ];

        return view('admin/gaji/index', $data);
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

            $tanggal = $this->request->getPost('tanggal');
            $dateParts = date_parse($tanggal);
            $nama = $karyawan->nama;
            $bulan = $dateParts['month'];
            $tahun = $dateParts['year'];
            $bulanan = $this->AbsenModel->bulanan($nama, $bulan, $tahun);
            if (empty($bulanan)) {
                $total = $karyawan->gapok + $karyawan->bonus - $potongan;
            } else {
                $total = $karyawan->gapok - $potongan;
            }

            //simpan data database
            $data = [
                'tanggal' => esc($this->request->getPost('tanggal')),
                'keterangan' => esc($this->request->getPost('keterangan')),
                'id_karyawan' => $id_karyawan,
                'potongan' => $potongan,
                'total' => $total,
            ];
            $this->GajiModel->insert($data);

            return redirect()->back()->with('success', 'Data Gaji Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function destroy($id_gaji)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            $gaji = $this->GajiModel->orderBy('id_gaji', 'DESC')
                ->join('karyawan', 'karyawan.id_karyawan = gaji.id_karyawan', 'left')
                ->join('rekening', 'rekening.id_rekening = karyawan.id_rekening', 'left')
                ->select('gaji.potongan, rekening.id_rekening')
                ->where('id_gaji', $id_gaji)->first();
            $id_rekening = $gaji->id_rekening;
            $potongan = $gaji->potongan;
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
            $this->GajiModel->where('id_gaji', $id_gaji)->delete();

            return redirect()->back()->with('success', 'Data Gaji Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }
}
