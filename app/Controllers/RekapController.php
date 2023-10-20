<?php

namespace App\Controllers;

class RekapController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Rekap Pemasangan',
            'daftar_pasang' => $this->PasangModel->orderBy('id_pasang', 'DESC')->findAll(),
            'kerja' => $this->KerjaModel->orderBy('id_kerja', 'DESC')->findAll(),
            'daftar_survei' => $this->SurveiModel
                ->where('status =', 1)
                ->orderBy('id_survei', 'DESC')->findAll()
        ];

        return view('admin/rekap/index', $data);
    }

    public function store()
    {
        $id_survei = $this->request->getPost('id_survei');
        $survei = $this->SurveiModel
            ->where('id_survei', $id_survei)
            ->orderBy('id_survei', 'DESC')->first();
        $gambar = $this->request->getFile('gambar');
        $nama_file = $gambar->getRandomName();

        $tahun = date('Y');
        $month = date('n'); // Mengambil angka bulan saat ini (1-12)
        $romanMonth = $this->convertToRoman($month); // Mengonversi angka bulan menjadi huruf Romawi
        $data = $this->PasangModel->orderBy('id_pasang', 'DESC')->first();
        $invoice = $data->invoice;
        $digit = strlen($invoice);
        $cektahun = substr($invoice, $digit - 4, 4);
        if ($tahun == $cektahun) {
            if ($romanMonth == "I" || $romanMonth == "V" || $romanMonth == "X") {
                if ($digit == 17) {
                    $ambildigit = substr($invoice, 0, 2);
                    $nilai = (int)$ambildigit;
                } else {
                    $ambildigit = substr($invoice, 0, 3);
                    $nilai = (int)$ambildigit;
                }
            } elseif ($romanMonth == "II" || $romanMonth == "IV" || $romanMonth == "VI" || $romanMonth == "IX" || $romanMonth == "XI") {
                if ($digit == 18) {
                    $ambildigit = substr($invoice, 0, 2);
                    $nilai = (int)$ambildigit;
                } else {
                    $ambildigit = substr($invoice, 0, 3);
                    $nilai = (int)$ambildigit;
                }
            } elseif ($romanMonth == "III" || $romanMonth == "VII" || $romanMonth == "XII") {
                if ($digit == 19) {
                    $ambildigit = substr($invoice, 0, 2);
                    $nilai = (int)$ambildigit;
                } else {
                    $ambildigit = substr($invoice, 0, 3);
                    $nilai = (int)$ambildigit;
                }
            } else {
                if ($digit == 20) {
                    $ambildigit = substr($invoice, 0, 2);
                    $nilai = (int)$ambildigit;
                } else {
                    $ambildigit = substr($invoice, 0, 3);
                    $nilai = (int)$ambildigit;
                }
            }
        } else {
            $nilai = 0;
        }
        $tambahtransaksi2 = $nilai + 1;
        $jumlahPenjualanFormat2 = str_pad($tambahtransaksi2, 2, '0', STR_PAD_LEFT);
        $nomorFaktur = $jumlahPenjualanFormat2 . "/" . "INV-ASN" . "/" . $romanMonth . "/" . $tahun;
        $no_rbp = $jumlahPenjualanFormat2 . "/" . "RBP-ASN" . "/" . $romanMonth . "/" . $tahun;
        $no_rhb = $jumlahPenjualanFormat2 . "/" . "HBK-ASN" . "/" . $romanMonth . "/" . $tahun;

        //simpan data database
        $data = [
            'nama' => $survei->pelanggan,
            'alamat' => $survei->alamat,
            'tanggal' => $survei->tanggal,
            'biaya' => $survei->biaya,
            'sisa' => $survei->biaya,
            'tukang' => esc($this->request->getPost('tukang')),
            'kerja' => esc($this->request->getPost('kerja')),
            'volume' => esc($this->request->getPost('volume')),
            'keterangan' => esc($this->request->getPost('keterangan')),
            'gambar' => $nama_file,
            'invoice' => $nomorFaktur,
            'no_rbp' => $no_rbp,
            'no_rhb' => $no_rhb,
            'id_survei' => $id_survei,
        ];
        $gambar->move('foto/sketsa', $nama_file);
        $this->PasangModel->insert($data);

        $pasang = $this->PasangModel
            ->where('invoice', $nomorFaktur)
            ->orderBy('id_pasang', 'DESC')->first();

        return redirect()->to(base_url('rekap/detail/' . $pasang->id_pasang))->with('success', 'Data Pemasangan Berhasil Ditambahkan');
    }



    public function update($id_pasang)
    {
        $file = $this->request->getFile('gambar');
        //cek file gambar Diubah
        if ($file->getError() == 4) {
            $nama_file = $this->request->getPost('gambarLama');
        } else {
            //buat nama file
            $nama_file = $file->getRandomName();
            // pindahkan file
            $file->move('foto/sketsa', $nama_file);
            $filelama = $this->request->getPost('gambarLama');
            if ($filelama == "") {
            } else {
                //hapus gambar lama
                unlink('foto/sketsa/' . $this->request->getPost('gambarLama'));
            }
        }

        $rbp = $this->request->getPost('rbp');
        if (empty($rbp)) {
            $data = $this->PasangModel->where('id_pasang', $id_pasang)->first();
            $invoice = $data->invoice;
            $digit = strlen($invoice);
            $month = date('n', strtotime($data->tanggal)); // Mengambil angka bulan saat ini (1-12)
            $romanMonth = $this->convertToRoman($month); // Mengonversi angka bulan menjadi huruf Romawi
            if ($romanMonth == "I" || $romanMonth == "V" || $romanMonth == "X") {
                if ($digit == 17) {
                    $ambildigit = substr($invoice, 0, 2);
                    $nilai = (int)$ambildigit;
                    $length = strlen($invoice) - 11;
                    $rightText = substr($invoice, 11, $length);
                } else {
                    $ambildigit = substr($invoice, 0, 3);
                    $nilai = (int)$ambildigit;
                    $length = strlen($invoice) - 12;
                    $rightText = substr($invoice, 12, $length);
                }
            } elseif ($romanMonth == "II" || $romanMonth == "IV" || $romanMonth == "VI" || $romanMonth == "IX" || $romanMonth == "XI") {
                if ($digit == 18) {
                    $ambildigit = substr($invoice, 0, 2);
                    $nilai = (int)$ambildigit;
                    $length = strlen($invoice) - 11;
                    $rightText = substr($invoice, 11, $length);
                } else {
                    $ambildigit = substr($invoice, 0, 3);
                    $nilai = (int)$ambildigit;
                    $length = strlen($invoice) - 12;
                    $rightText = substr($invoice, 12, $length);
                }
            } elseif ($romanMonth == "III" || $romanMonth == "VII" || $romanMonth == "XII") {
                if ($digit == 19) {
                    $ambildigit = substr($invoice, 0, 2);
                    $nilai = (int)$ambildigit;
                    $length = strlen($invoice) - 11;
                    $rightText = substr($invoice, 11, $length);
                } else {
                    $ambildigit = substr($invoice, 0, 3);
                    $nilai = (int)$ambildigit;
                    $length = strlen($invoice) - 12;
                    $rightText = substr($invoice, 12, $length);
                }
            } else {
                if ($digit == 20) {
                    $ambildigit = substr($invoice, 0, 2);
                    $nilai = (int)$ambildigit;
                    $length = strlen($invoice) - 11;
                    $rightText = substr($invoice, 11, $length);
                } else {
                    $ambildigit = substr($invoice, 0, 3);
                    $nilai = (int)$ambildigit;
                    $length = strlen($invoice) - 12;
                    $rightText = substr($invoice, 12, $length);
                }
            }
            $tambahtransaksi2 = $nilai;
            $jumlahPenjualanFormat2 = str_pad($tambahtransaksi2, 2, '0', STR_PAD_LEFT);
            $nomorFaktur = $jumlahPenjualanFormat2 . "/" . "INV-ASN" . "/" . $rightText;
            $no_rbp = $jumlahPenjualanFormat2 . "/" . "RBP-ASN" . "/" . $rightText;
            $no_rhb = $jumlahPenjualanFormat2 . "/" . "HBK-ASN" . "/" . $rightText;
        } else {
            $pasang = $this->PasangModel->where('id_pasang', $id_pasang)->first();
            $nomorFaktur = $pasang->invoice;
            $no_rbp = $pasang->no_rbp;
            $no_rhb = $pasang->no_rhb;
        }

        $jumlahterbayar = $this->BayarpasangModel->jumlahbayar($id_pasang);
        $total = $this->request->getPost('biaya');
        if ($jumlahterbayar > 0) {
            $sisa_hbk = $total - $jumlahterbayar;
        } else {
            $sisa_hbk = $total;
        }
        //simpan data ke database
        $data = [
            'tukang' => esc($this->request->getPost('tukang')),
            'kerja' => esc($this->request->getPost('kerja')),
            'volume' => esc($this->request->getPost('volume')),
            'keterangan' => esc($this->request->getPost('keterangan')),
            'biaya' => esc($this->request->getPost('biaya')),
            'sisa' => $sisa_hbk,
            'gambar' => $nama_file,
            'invoice' => $nomorFaktur,
            'no_rbp' => $no_rbp,
            'no_rhb' => $no_rhb,
        ];
        $this->PasangModel->update($id_pasang, $data);

        return redirect()->back()->with('success', 'Data Pemasangan Berhasil Diubah');
    }

    public function destroy($id_pasang)
    {
        $nama_file = $this->request->getPost('gambar');
        if ($nama_file == "") {
        } else {
            unlink('foto/sketsa/' . $this->request->getPost('gambar'));
        }
        // Hapus data
        $this->PasangModel->where('id_pasang', $id_pasang)->delete();
        $this->BayarpasangModel->where('id_pasang', $id_pasang)->delete();
        $this->DetailpasangModel->where('id_pasang', $id_pasang)->delete();

        return redirect()->to(base_url('rekap'))->with('success', 'Pemasangan telah dibatalkan');
    }

    public function preview($id)
    {
        $pasang = $this->PasangModel->where('id_pasang', $id)->first();
        $data = [
            'title' => 'Halaman Rincian Biaya Pemasangan',
            'invoice' => $this->PasangModel->where('id_pasang', $id)
                ->join('survei', 'survei.id_survei = pemasangan.id_survei', 'left')
                ->select('pemasangan.*, survei.pengukur, survei.tukang, survei.drafter')
                ->first(),
            'subkerja' => $this->KerjaModel->orderBy('kerja.nama', 'ASC')
                ->join('subkerja', 'subkerja.id_kerja = kerja.id_kerja', 'left')
                ->findAll(),
            'kerja' => $this->KerjaModel->orderBy('nama', 'ASC')
                ->findAll(),
            'ukuran' => $this->UkuranModel->orderBy('id_ukuran', 'DESC')->findAll(),
            'daftar_bayar' => $this->BayarpasangModel
                ->orderBy('tanggal_input', 'DESC')
                ->where('id_pasang', $id)->findAll(),
            'totalbiaya' => $this->DetailpasangModel->jumlahbiaya($pasang->id_survei),
            'daftar_uraian' => $this->DetailpasangModel
                ->join('pemasangan', 'pemasangan.id_survei = detail_pemasangan.id_survei', 'left')
                ->join('subkerja', 'subkerja.id = detail_pemasangan.id_sub', 'left')
                ->join('kerja', 'kerja.id_kerja = subkerja.id_kerja', 'left')
                ->select('detail_pemasangan.*, subkerja.nama_sub, kerja.nama')
                ->orderBy('kerja.nama', 'DESC')
                ->where('id_pasang', $id)->findAll(),
            'pengawas' => $this->PengukurModel->orderBy('id_pengukur', 'DESC')->findAll(),
            'daftar_tukang' => $this->TukangModel->orderBy('id_tukang', 'DESC')->findAll(),
            'daftar_kerja' => $this->KerjaModel->orderBy('id_kerja', 'DESC')->findAll(),
            'daftar_pasang' => $this->PasangModel->orderBy('id_pasang', 'DESC')->findAll(),
            'isExists' => $this->HbkModel->isInvoiceExists($pasang->no_rhb),
        ];
        // var_dump($data);

        echo view('admin/rekap/uraian', $data);
    }

    public function uraiansimpan()
    {
        //simpan data database
        $id_pasang = $this->request->getPost('id_pasang');
        $id = $this->request->getPost('id_survei');
        $harga = $this->request->getPost('harga');
        $volume = $this->request->getPost('volume');
        $subtotal = $harga * $volume;
        $data = [
            'id_survei' => $id,
            'id_sub' => esc($this->request->getPost('id_sub')),
            'volume' => esc($this->request->getPost('volume')),
            'ukuran' => esc($this->request->getPost('ukuran')),
            'harga' => esc($this->request->getPost('harga')),
            'biaya' => $subtotal,
        ];
        $this->DetailpasangModel->insert($data);

        $totalbiaya = $this->DetailpasangModel->jumlahbiaya($id);

        $data2 = [
            'biaya' => $totalbiaya,
        ];
        $this->PasangModel->update($id_pasang, $data2);

        return redirect()->back()->with('success', 'Data Pekerjaan berhasil Ditambahkan');
    }

    public function updateuraian($id)
    {
        //simpan data ke database
        $id_pasang = $this->request->getPost('id_pasang');
        $pasang = $this->PasangModel->where('id_pasang', $id_pasang)->first();
        $harga = $this->request->getPost('harga');
        $volume = $this->request->getPost('volume');
        $subtotal = $harga * $volume;
        $data = [
            'id_sub' => esc($this->request->getPost('id_sub')),
            'volume' => esc($this->request->getPost('volume')),
            'harga' => esc($this->request->getPost('harga')),
            'ukuran' => esc($this->request->getPost('ukuran')),
            'biaya' => $subtotal,
        ];
        $this->DetailpasangModel->update($id, $data);

        $totalbiaya = $this->DetailpasangModel->jumlahbiaya($pasang->id_survei);

        $data2 = [
            'biaya' => $totalbiaya,
        ];
        $this->PasangModel->update($id_pasang, $data2);

        return redirect()->back()->with('success', 'Data Pekerjaan berhasil Diubah');
    }

    public function updatetotal($id)
    {
        //simpan data ke database
        $jumlahterbayar = $this->BayarpasangModel->jumlahbayar($id);
        $total = $this->request->getPost('biaya');
        if ($jumlahterbayar > 0) {
            $sisa_hbk = $total - $jumlahterbayar;
        } else {
            $sisa_hbk = $total;
        }
        $data = [
            'biaya' => $total,
            'sisa' => $sisa_hbk,
        ];
        $this->PasangModel->update($id, $data);

        return redirect()->back()->with('success', 'Total Deal Berhasil Diupdate');
    }

    public function uraianhapus($id)
    {
        // Hapus data
        $id_pasang = $this->request->getPost('id_pasang');
        $pasang = $this->PasangModel->where('id_pasang', $id_pasang)->first();
        $this->DetailpasangModel->where('id', $id)->delete();

        $totalbiaya = $this->DetailpasangModel->jumlahbiaya($pasang->id_survei);

        $data2 = [
            'biaya' => $totalbiaya,
        ];
        $this->PasangModel->update($id_pasang, $data2);

        return redirect()->back()->with('success', 'Data Uraian Pemasangan Berhasil dihapus');
    }

    public function uraianbatal($id_pasang)
    {
        // Hapus data
        $this->DetailpasangModel->where('id_pasang', $id_pasang)->delete();

        $totalbiaya = $this->DetailpasangModel->jumlahbiaya($pasang->id_survei);

        $data2 = [
            'biaya' => $totalbiaya,
        ];
        $this->PasangModel->update($id_pasang, $data2);

        return redirect()->back()->with('success', 'Data Uraian telah dibatalkan');
    }

    public function gambar($id_pasang)
    {
        $pasang = $this->PasangModel->where('id_pasang', $id_pasang)->first();
        $file = 'foto/sketsa/' . $pasang->gambar; // Ganti dengan path file yang ingin di-download

        if (file_exists($file)) {
            return $this->response->download($file, null);
        } else {
            // Jika file tidak ditemukan, tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            return redirect()->back()->with('success', 'File Template Tidak Tersedia');
        }
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
