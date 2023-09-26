<?php

namespace App\Controllers;

class InvoiceController extends BaseController
{

    public function index()
    {
        $data = [
            'title' => 'Halaman Invoice Pemasangan',
            'daftar_pasang' => $this->PasangModel->orderBy('id_pasang', 'DESC')->findAll()
        ];

        return view('admin/pasang/index', $data);
    }

    public function store()
    {
        $jumlahTransaksi = $this->PasangModel->countSalesToday();
        $tambahtransaksi = $jumlahTransaksi + 1;
        $tahun = date('Y');
        $month = date('n'); // Mengambil angka bulan saat ini (1-12)
        $romanMonth = $this->convertToRoman($month); // Mengonversi angka bulan menjadi huruf Romawi
        $jumlahPenjualanFormat = str_pad($tambahtransaksi, 2, '0', STR_PAD_LEFT);

        $nomorFaktur = $jumlahPenjualanFormat . "/" . "INV-ASN" . "/" . $romanMonth . "/" . $tahun;
        //simpan data database
        $data = [
            'nama' => esc($this->request->getPost('nama')),
            'alamat' => esc($this->request->getPost('alamat')),
            'tanggal' => esc($this->request->getPost('tanggal')),
            'biaya' => esc($this->request->getPost('biaya')),
            'sisa' => esc($this->request->getPost('biaya')),
            'invoice' => $nomorFaktur
        ];
        $this->PasangModel->insert($data);

        return redirect()->back()->with('success', 'Data Pemasangan Berhasil Ditambahkan');
    }

    public function uraiansimpan()
    {
        //simpan data database
        $data = [
            'uraian' => esc($this->request->getPost('uraian')),
            'keterangan' => esc($this->request->getPost('keterangan')),
            'biaya' => esc($this->request->getPost('biaya')),
            'id_pasang' => esc($this->request->getPost('id_pasang')),
        ];
        $this->DetailpasangModel->insert($data);

        return redirect()->back()->with('success', 'Data Pemasangan Berhasil Ditambahkan');
    }

    public function bayarpasang()
    {
        $jumlahTransaksi = $this->BayarpasangModel->countSalesToday();
        $tambahtransaksi = $jumlahTransaksi + 1;
        $tahun = date('Y');
        $month = date('n'); // Mengambil angka bulan saat ini (1-12)
        $romanMonth = $this->convertToRoman($month); // Mengonversi angka bulan menjadi huruf Romawi
        $jumlahPenjualanFormat = str_pad($tambahtransaksi, 2, '0', STR_PAD_LEFT);
        $nomor = $jumlahPenjualanFormat . "/" . "KWI-ASN" . "/" . $romanMonth . "/" . $tahun;
        $isExists = $this->BayarpasangModel->isInvoiceExists($nomor);
        if ($isExists) {
            $data = $this->BayarpasangModel->orderBy('kwitansi', 'DESC')->first();
            $kwitansi = $data->kwitansi;
            $digit = strlen($kwitansi);

            if ($romanMonth == "I" || $romanMonth == "V" || $romanMonth == "X") {
                if ($digit == 17) {
                    $ambildigit = substr($kwitansi, 0, 2);
                    $nilai = (int)$ambildigit;
                } else {
                    $ambildigit = substr($kwitansi, 0, 3);
                    $nilai = (int)$ambildigit;
                }
            } elseif ($romanMonth == "II" || $romanMonth == "IV" || $romanMonth == "VI" || $romanMonth == "IX" || $romanMonth == "XI") {
                if ($digit == 18) {
                    $ambildigit = substr($kwitansi, 0, 2);
                    $nilai = (int)$ambildigit;
                } else {
                    $ambildigit = substr($kwitansi, 0, 3);
                    $nilai = (int)$ambildigit;
                }
            } elseif ($romanMonth == "III" || $romanMonth == "VII" || $romanMonth == "XII") {
                if ($digit == 19) {
                    $ambildigit = substr($kwitansi, 0, 2);
                    $nilai = (int)$ambildigit;
                } else {
                    $ambildigit = substr($kwitansi, 0, 3);
                    $nilai = (int)$ambildigit;
                }
            } else {
                if ($digit == 20) {
                    $ambildigit = substr($kwitansi, 0, 2);
                    $nilai = (int)$ambildigit;
                } else {
                    $ambildigit = substr($kwitansi, 0, 3);
                    $nilai = (int)$ambildigit;
                }
            }
            $tambahtransaksi2 = $nilai + 1;
            $jumlahPenjualanFormat2 = str_pad($tambahtransaksi2, 2, '0', STR_PAD_LEFT);
            $nomorFaktur = $jumlahPenjualanFormat2 . "/" . "KWI-ASN" . "/" . $romanMonth . "/" . $tahun;
        } else {
            $nomorFaktur = $jumlahPenjualanFormat . "/" . "KWI-ASN" . "/" . $romanMonth . "/" . $tahun;
        }

        $id_pasang = $this->request->getPost('id_pasang');
        $biaya = $this->request->getPost('biaya');
        $bayar = $this->request->getPost('bayar');
        $sisa = $biaya - $bayar;

        $updatebayar = [
            'sisa' => $sisa
        ];
        $this->PasangModel->update($id_pasang, $updatebayar);

        //simpan data database
        $data = [
            'id_pasang' => esc($this->request->getPost('id_pasang')),
            'tanggal' => esc($this->request->getPost('tanggal')),
            'bayar' => esc($this->request->getPost('bayar')),
            'keterangan' => esc($this->request->getPost('keterangan')),
            'kwitansi' => $nomorFaktur
        ];
        $this->BayarpasangModel->insert($data);

        return redirect()->back()->with('success', 'Data Pemasangan Berhasil Ditambahkan');
    }

    public function update($id_pasang)
    {
        $jumlahterbayar = $this->BayarpasangModel->jumlahbayar($id_pasang);
        $total = $this->request->getPost('biaya');
        if ($jumlahterbayar > 0) {
            $sisa_hbk = $total - $jumlahterbayar;
        } else {
            $sisa_hbk = $total;
        }
        //simpan data ke database
        $data = [
            'nama' => esc($this->request->getPost('nama')),
            'alamat' => esc($this->request->getPost('alamat')),
            'tanggal' => esc($this->request->getPost('tanggal')),
            'biaya' => esc($this->request->getPost('biaya')),
            'sisa' => $sisa_hbk,
        ];
        $this->PasangModel->update($id_pasang, $data);

        return redirect()->back()->with('success', 'Data Pemasangan Berhasil Diubah');
    }

    public function update2($id)
    {
        //simpan data ke database
        $data = [
            'uraian' => esc($this->request->getPost('uraian')),
            'keterangan' => esc($this->request->getPost('keterangan')),
            'biaya' => esc($this->request->getPost('biaya')),
        ];
        $this->DetailpasangModel->update($id, $data);

        return redirect()->back()->with('success', 'Data Uraian Pemasangan Berhasil Diubah');
    }

    public function destroy($id_pasang)
    {
        $data = $this->PasangModel->where('id_pasang', $id_pasang)->first();
        $nama_file = $data->gambar;
        if ($nama_file == "") {
        } else {
            unlink('foto/sketsa/' . $nama_file);
        }
        // Hapus data
        $this->PasangModel->where('id_pasang', $id_pasang)->delete();
        $this->BayarpasangModel->where('id_pasang', $id_pasang)->delete();

        return redirect()->to(base_url('invoice'))->with('success', 'Pemasangan telah dibatalkan');
    }

    public function preview($id)
    {
        $data = [
            'title' => 'Halaman Detail Pembayaran',
            'invoice' => $this->PasangModel->where('id_pasang', $id)
                ->first(),
            'daftar_bayar' => $this->BayarpasangModel->where('id_pasang', $id)
                ->orderBy('tanggal_input', 'DESC')
                ->findAll(),
            'jumlahterbayar' => $this->BayarpasangModel->jumlahbayar($id)
        ];
        // var_dump($data);

        echo view('admin/pasang/detail', $data);
    }

    public function uraian($id)
    {
        $data = [
            'title' => 'Halaman Uraian Pemasangan',
            'invoice' => $this->PasangModel->where('id_pasang', $id)->first(),
            'daftar_bayar' => $this->BayarpasangModel
                ->orderBy('tanggal_input', 'DESC')
                ->where('id_pasang', $id)->findAll(),
            'jumlahterbiaya' => $this->DetailpasangModel->jumlahbiaya($id),
            'daftar_uraian' => $this->DetailpasangModel
                ->orderBy('id', 'ASC')
                ->where('id_pasang', $id)->findAll(),
        ];
        // var_dump($data);

        echo view('admin/pasang/uraian', $data);
    }

    public function destroy2($id)
    {
        $detail = $this->BayarpasangModel->where('id', $id)->first();
        $invoice = $this->PasangModel->where('id_pasang', $detail->id_pasang)->first();
        $biaya = $invoice->sisa;
        $bayar = $detail->bayar;
        $sisa = $biaya + $bayar;

        $updatebayar = [
            'sisa' => $sisa
        ];
        $this->PasangModel->update($invoice->id_pasang, $updatebayar);

        // Hapus data
        $this->BayarpasangModel->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Pemasangan telah dibatalkan');
    }

    public function destroy3($id)
    {
        // Hapus data
        $this->DetailpasangModel->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data Uraian Pemasangan Berhasil dihapus');
    }

    public function destroy4($id_pasang)
    {
        // Hapus data
        $this->DetailpasangModel->where('id_pasang', $id_pasang)->delete();

        return redirect()->to(base_url('invoice'))->with('success', 'Data Uraian telah dibatalkan');
    }

    protected function convertToRoman($number)
    {
        $romans = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        ];

        return $romans[$number];
    }
}
