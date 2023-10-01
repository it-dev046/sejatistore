<?php

namespace App\Controllers;

use SebastianBergmann\CodeCoverage\Driver\Selector;

class GatukController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Gaji Tukang',
            'userId' => $this->session->get('id'),
            'daftar_gatuk' => $this->GatukModel->orderBy('id_gatuk', 'DESC')
                ->join('rekening', 'rekening.id_rekening = gatuk.id_rekening', 'left')->findAll(),
            'daftar_rpt' => $this->RPTModel->orderBy('id_rpt', 'DESC')->findAll(),
            'daftar_rekening' => $this->RekeningModel->orderBy('usaha', 'ASC')
                ->join('kasbon', 'kasbon.id_rekening = rekening.id_rekening', 'left')->findAll(),
        ];

        return view('admin/gatuk/index', $data);
    }

    public function store()
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            $nilai = $this->request->getPost('nilai');
            $id_rpt = $this->request->getPost('id_rpt');
            $id_rekening = $this->request->getPost('id_rekening');
            $rpt =  $this->RPTModel->orderBy('id_rpt', 'DESC')
                ->join('pemasangan', 'pemasangan.invoice = rpt.invoice', 'left')
                ->where('id_rpt', $id_rpt)->first();
            $cek = $this->KasbonModel->isInvoiceExists($id_rekening);
            $potongan = $this->request->getPost('potongan');
            if ($cek) {
                $kasbon = $this->KasbonModel->orderBy('id_kasbon', 'ASC')
                    ->where('id_rekening', $id_rekening)
                    ->first();
                $sisakasbon = $kasbon->sisa - $potongan;
                $data = [
                    'sisa' => $sisakasbon,
                ];
                $this->KasbonModel->update($kasbon->id_kasbon, $data);
            }
            $bayar = $nilai - $potongan;
            $sisa = $rpt->sisa_hbk - $bayar;

            //simpan data database
            $data = [
                'tanggal' => esc($this->request->getPost('tanggal')),
                'id_rekening' => esc($this->request->getPost('id_rekening')),
                'nilai' => esc($this->request->getPost('nilai')),
                'potongan' => esc($this->request->getPost('potongan')),
                'keterangan' => esc($this->request->getPost('keterangan')),
                'invoice' => $rpt->invoice,
                'sisa_hbk' => $sisa,
            ];
            $this->GatukModel->insert($data);

            return redirect()->back()->with('success', 'Gaji Tukang Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function destroy($id_gatuk)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            // Hapus data
            $gatuk = $this->GatukModel->orderBy('id_gatuk', 'DESC')
                ->where('id_gatuk', $id_gatuk)->first();
            $id_rekening = $gatuk->id_rekening;
            $potongan = $gatuk->potongan;
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

            $this->GatukModel->where('id_gatuk', $id_gatuk)->delete();

            return redirect()->back()->with('success', 'Gaji Tukang Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }
}
