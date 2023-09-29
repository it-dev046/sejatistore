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
            'daftar_gatuk' => $this->GatukModel->orderBy('id_gatuk', 'DESC')->findAll(),
            'daftar_rpt' => $this->RPTModel->orderBy('id_rpt', 'DESC')->findAll(),
            'daftar_rekening' => $this->RekeningModel->orderBy('usaha', 'ASC')->findAll(),
        ];

        return view('admin/gatuk/index', $data);
    }

    public function store()
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            $id_rpt = $this->request->getPost('id_rpt');
            $id_rekening = $this->request->getPost('id_rekening');
            $rpt =  $this->rptModel->orderBy('id_rpt', 'DESC')
                ->join('pemasangan', 'pemasangan.id_pasang = rpt.id_pasang', 'left')
                ->where('id_rpt', $id_rpt)->first();
            $cek = $this->KasbonModel->isInvoiceExists($id_rekening);
            $potongan = $this->request->getPost('potongan');
            if ($cek) {
                $kasbon = $this->KasbonModel->orderBy('id_kasbon', 'ASC')
                    ->where('id_rekening', $id_rekening)->first();
            }

            //simpan data database
            $data = [
                'tanggal' => esc($this->request->getPost('tanggal')),
                'id_rekening' => esc($this->request->getPost('id_rekening')),
                'nilai' => esc($this->request->getPost('nilai')),
                'potongan' => esc($this->request->getPost('potongan')),
                'keterangan' => esc($this->request->getPost('keterangan')),
                'invoice' => $rpt->invoice,
                'sisa_hbk' => $sisa_hbk,
            ];
            $this->GatukModel->insert($data);

            return redirect()->back()->with('success', 'Gaji Tukang Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function update($id_gatuk)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            //simpan data database
            $data = [
                'tanggal' => esc($this->request->getPost('tanggal')),
                'rek' => esc($this->request->getPost('rek')),
                'bank' => esc($this->request->getPost('bank')),
                'AN' => esc($this->request->getPost('AN')),
                'keterangan' => esc($this->request->getPost('keterangan')),
                'nilai' => esc($this->request->getPost('nilai')),
            ];
            $this->GatukModel->update($id_gatuk, $data);

            return redirect()->back()->with('success', 'Gaji Tukang Berhasil Diubah');
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
            $this->GatukModel->where('id_gatuk', $id_gatuk)->delete();

            return redirect()->back()->with('success', 'Gaji Tukang Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }
}
