<?php

namespace App\Controllers;

class HbkController extends BaseController
{

    public function index()
    {
        $data = [
            'title' => 'Halaman HBK Pemasangan',
            'daftar_pasang' => $this->PasangModel->orderBy('id_pasang', 'DESC')->findAll(),
            'daftar_hbk' => $this->HbkModel->orderBy('id_hbk', 'DESC')
                ->join('pemasangan', 'pemasangan.id_pasang = hbk.id_pasang', 'left')
                ->findAll()
        ];

        return view('admin/hbk/index', $data);
    }


    public function hbk()
    {
        $data = [
            'title' => 'Halaman HBK Pemasangan',
            'pengawas' => $this->PengukurModel->orderBy('id_pengukur', 'DESC')->findAll(),
            'daftar_tukang' => $this->TukangModel->orderBy('id_tukang', 'DESC')->findAll(),
            'daftar_kerja' => $this->KerjaModel->orderBy('id_kerja', 'DESC')->findAll(),
            'daftar_pasang' => $this->PasangModel->orderBy('id_pasang', 'DESC')->findAll(),
            'daftar_uraian' => $this->DetailpasangModel
                ->join('subkerja', 'subkerja.id = detail_pemasangan.id_sub', 'right')
                ->join('kerja', 'kerja.id_kerja = subkerja.id_kerja', 'right')
                ->select('detail_pemasangan.*, subkerja.nama_sub, kerja.nama')
                ->orderBy('kerja.nama', 'DESC')
                ->findAll(),
            'daftar_hbk' => $this->HbkModel->orderBy('id_hbk', 'DESC')
                ->join('pemasangan', 'pemasangan.id_pasang = hbk.id_pasang', 'left')
                ->select('hbk.*, pemasangan.nama, pemasangan.alamat')
                ->findAll()
        ];

        return view('admin/hbk/borongan', $data);
    }

    public function store()
    {
        $gambar = $this->request->getFile('gambar');
        $nama_file = $gambar->getRandomName();
        $id = $this->request->getPost('id_pasang');
        $pasang = $this->PasangModel->where('id_pasang', $id)->first();

        //simpan data database
        $data = [
            'id_pasang' => esc($this->request->getPost('id_pasang')),
            'kerja' => esc($this->request->getPost('kerja')),
            'tukang' => esc($this->request->getPost('tukang')),
            'pengawas' => esc($this->request->getPost('pengawas')),
            'drafter' => esc($this->request->getPost('drafter')),
            'keterangan' => esc($this->request->getPost('keterangan')),
            'total_hbk' => esc($this->request->getPost('total_hbk')),
            'sisa_hbk' => esc($this->request->getPost('total_hbk')),
            'gambar' => $nama_file,
            'no_hbk' => $pasang->no_rhb,
        ];
        $gambar->move('foto/sketsa', $nama_file);
        $this->HbkModel->insert($data);

        $hbk = $this->HbkModel
            ->where('no_hbk', $pasang->no_rhb)
            ->orderBy('id_hbk', 'DESC')->first();

        return redirect()->to(base_url('hbk/uraian/' . $hbk->id_hbk))->with('success', 'Data HBK Berhasil Ditambahkan');
    }

    public function update($id_hbk)
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

        $no_hbk = $this->request->getPost('no_hbk');
        $id_pasang = $this->request->getPost('id_pasang');
        if ($no_hbk == "") {
            $pasang = $this->PasangModel->where('id_pasang', $id_pasang)->first();
            $nomorFaktur = $pasang->no_rhb;
        } else {
            $nomorFaktur = $this->request->getPost('no_hbk');
        }
        //simpan data ke database
        $jumlahterbayar = $this->BayarhbkModel->jumlahbayar($id_hbk);
        $total = $this->request->getPost('total_hbk');
        if ($jumlahterbayar > 0) {
            $sisa_hbk = $total - $jumlahterbayar;
        } else {
            $sisa_hbk = $total;
        }

        $data = [
            'id_pasang' => esc($this->request->getPost('id_pasang')),
            'kerja' => esc($this->request->getPost('kerja')),
            'tukang' => esc($this->request->getPost('tukang')),
            'pengawas' => esc($this->request->getPost('pengawas')),
            'total_hbk' => esc($this->request->getPost('total_hbk')),
            'sisa_hbk' => $sisa_hbk,
            'gambar' => $nama_file,
            'no_hbk' => $nomorFaktur,
        ];
        $this->HbkModel->update($id_hbk, $data);

        return redirect()->back()->with('success', 'Data HBK Berhasil Diubah');
    }

    public function preview($id)
    {
        $data = [
            'title' => 'Halaman Detail HBK',
            'hbk' => $this->HbkModel
                ->where('id_hbk', $id)
                ->join('pemasangan', 'pemasangan.id_pasang = hbk.id_pasang', 'left')
                ->orderBy('hbk.tanggal_input', 'ASC')
                ->first(),
            'daftar_bayar' => $this->BayarhbkModel
                ->where('id_hbk', $id)
                ->orderBy('tanggal_input', 'ASC')
                ->findAll(),
            'jumlahterbayar' => $this->BayarhbkModel->jumlahbayar($id)
        ];
        // var_dump($data);

        echo view('admin/hbk/detail', $data);
    }

    public function bayarhbk()
    {
        $tahun = date('Y');
        $month = date('n'); // Mengambil angka bulan saat ini (1-12)
        $romanMonth = $this->convertToRoman($month); // Mengonversi angka bulan menjadi huruf Romawi
        $data = $this->BayarhbkModel->orderBy('id', 'DESC')->first();
        $kwitansi = $data->kwitansi;
        $digit = strlen($kwitansi);
        $cektahun = substr($kwitansi, $digit - 4, 4);
        if ($tahun == $cektahun) {
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
        } else {
            $nilai = 0;
        }
        $tambahtransaksi2 = $nilai + 1;
        $jumlahPenjualanFormat2 = str_pad($tambahtransaksi2, 2, '0', STR_PAD_LEFT);
        $nomorFaktur = $jumlahPenjualanFormat2 . "/" . "HBK-ASN" . "/" . $romanMonth . "/" . $tahun;

        $id_hbk = $this->request->getPost('id_hbk');
        $biaya = $this->request->getPost('biaya');
        $bayar = $this->request->getPost('bayar');
        $sisa_hbk = $biaya - $bayar;

        $updatebayar = [
            'sisa_hbk' => $sisa_hbk
        ];
        $this->HbkModel->update($id_hbk, $updatebayar);

        //simpan data database
        $data = [
            'id_hbk' => esc($this->request->getPost('id_hbk')),
            'id_pasang' => esc($this->request->getPost('id_pasang')),
            'tanggal' => esc($this->request->getPost('tanggal')),
            'bayar' => esc($this->request->getPost('bayar')),
            'keterangan' => esc($this->request->getPost('keterangan')),
            'kwitansi' => $nomorFaktur
        ];
        $this->BayarhbkModel->insert($data);

        return redirect()->back()->with('success', 'Data Uraian HBK Berhasil Ditambahkan');
    }

    public function destroy($id_hbk)
    {
        // Hapus Gambar
        $data = $this->HbkModel->where('id_hbk', $id_hbk)->first();
        $nama_file = $data->gambar;
        if ($nama_file == "") {
        } else {
            unlink('foto/sketsa/' . $nama_file);
        }
        // Hapus data
        $this->HbkModel->where('id_hbk', $id_hbk)->delete();
        $this->BayarhbkModel->where('id_hbk', $id_hbk)->delete();
        $this->DetailhbkModel->where('id_hbk', $id_hbk)->delete();

        return redirect()->to(base_url('hbk'))->with('success', 'Data HBK telah dibatalkan');
    }

    public function destroy2($id)
    {
        $detail = $this->BayarhbkModel->where('id', $id)->first();
        $hbk = $this->HbkModel->where('id_hbk', $detail->id_hbk)->first();
        $biaya = $hbk->sisa_hbk;
        $bayar = $detail->bayar;
        $sisa_hbk = $biaya + $bayar;

        $updatebayar = [
            'sisa_hbk' => $sisa_hbk
        ];
        $this->HbkModel->update($hbk->id_hbk, $updatebayar);

        // Hapus data
        $this->BayarhbkModel->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data Pembayaran HBK telah dihapus');
    }


    public function gambar($id_hbk)
    {
        $hbk = $this->HbkModel->where('id_hbk', $id_hbk)->first();
        $file = 'foto/sketsa/' . $hbk->gambar; // Ganti dengan path file yang ingin di-download

        if (file_exists($file)) {
            return $this->response->download($file, null);
        } else {
            // Jika file tidak ditemukan, tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            return redirect()->back()->with('success', 'File Template Tidak Tersedia');
        }
    }

    public function uraian($id_hbk)
    {
        $hbk = $this->HbkModel->where('id_hbk', $id_hbk)->first();

        $data = [
            'title' => 'Halaman Harga Borongan Kerja',
            'invoice' => $this->PasangModel->where('id_pasang', $hbk->id_pasang)
                ->join('survei', 'survei.id_survei = pemasangan.id_survei', 'left')
                ->select('pemasangan.*, survei.pengukur, survei.tukang, survei.drafter')
                ->first(),
            'cekbayar' => $this->BayarhbkModel->cekbayar($id_hbk),
            'hbk' => $this->HbkModel->where('id_hbk', $id_hbk)->first(),
            'ukuran' => $this->UkuranModel->orderBy('id_ukuran', 'DESC')->findAll(),
            'uraian_kerja' => $this->DetailpasangModel
                ->join('pemasangan', 'pemasangan.id_survei = detail_pemasangan.id_survei', 'left')
                ->join('subkerja', 'subkerja.id = detail_pemasangan.id_sub', 'right')
                ->join('kerja', 'kerja.id_kerja = subkerja.id_kerja', 'right')
                ->select('detail_pemasangan.*, subkerja.nama_sub, kerja.nama')
                ->orderBy('kerja.nama', 'DESC')
                ->where('id_pasang', $hbk->id_pasang)
                ->findAll(),
            'daftar_uraian' => $this->DetailhbkModel
                ->where('id_hbk', $hbk->id_hbk)
                ->findAll(),
            'jumlahbiaya' => $this->DetailhbkModel->jumlahbiaya($hbk->id_hbk),
        ];
        // var_dump($data);

        echo view('admin/hbk/uraian', $data);
    }

    public function uraiansimpan()
    {
        //simpan data database
        $id_hbk = $this->request->getPost('id_hbk');
        $harga = $this->request->getPost('harga');
        $volume = $this->request->getPost('volume');
        $subtotal = $harga * $volume;
        $data = [
            'id_hbk' => esc($this->request->getPost('id_hbk')),
            'uraian' => esc($this->request->getPost('uraian')),
            'volume' => esc($this->request->getPost('volume')),
            'ukuran' => esc($this->request->getPost('ukuran')),
            'harga' => esc($this->request->getPost('harga')),
            'biaya' => $subtotal,
        ];
        $this->DetailhbkModel->insert($data);

        $totalbiaya = $this->DetailhbkModel->jumlahbiaya($id_hbk);

        $data2 = [
            'total_hbk' => $totalbiaya,
            'sisa_hbk' => $totalbiaya,
        ];
        $this->HbkModel->update($id_hbk, $data2);

        return redirect()->back()->with('success', 'Data Uraian HBK Berhasil Ditambahkan');
    }

    public function updateuraian($id)
    {
        //simpan data ke database
        $id_hbk = $this->request->getPost('id_hbk');
        $harga = $this->request->getPost('harga');
        $volume = $this->request->getPost('volume');
        $subtotal = $harga * $volume;
        $data = [
            'uraian' => esc($this->request->getPost('uraian')),
            'volume' => esc($this->request->getPost('volume')),
            'harga' => esc($this->request->getPost('harga')),
            'ukuran' => esc($this->request->getPost('ukuran')),
            'biaya' => $subtotal,
        ];
        $this->DetailhbkModel->update($id, $data);

        $totalbiaya = $this->DetailhbkModel->jumlahbiaya($id_hbk);

        $data2 = [
            'total_hbk' => $totalbiaya,
            'sisa_hbk' => $totalbiaya,
        ];
        $this->HbkModel->update($id_hbk, $data2);

        return redirect()->back()->with('success', 'Data Uraian HBK Berhasil Diubah');
    }
    public function uraianhapus($id)
    {
        // Hapus data
        $id_hbk = $this->request->getPost('id_hbk');
        $this->DetailhbkModel->where('id', $id)->delete();

        $totalbiaya = $this->DetailhbkModel->jumlahbiaya($id_hbk);

        $data2 = [
            'total_hbk' => $totalbiaya,
            'sisa_hbk' => $totalbiaya,
        ];
        $this->HbkModel->update($id_hbk, $data2);

        return redirect()->back()->with('success', 'Data Uraian HBK Berhasil dihapus');
    }

    public function uraianbatal($id_hbk)
    {
        // Hapus data
        $this->DetailhbkModel->where('id_hbk', $id_hbk)->delete();

        $totalbiaya = $this->DetailhbkModel->jumlahbiaya($id_hbk);

        $data3 = [
            'total_hbk' => $totalbiaya,
            'sisa_hbk' => $totalbiaya,
        ];
        $this->HbkModel->update($id_hbk, $data3);

        return redirect()->back()->with('success', 'Data Uraian telah dibatalkan');
    }

    public function updatetotal($id_hbk)
    {
        //simpan data ke database 
        $jumlahterbayar = $this->BayarhbkModel->jumlahbayar($id_hbk);
        $total = $this->request->getPost('total_hbk');
        if ($jumlahterbayar > 0) {
            $sisa_hbk = $total - $jumlahterbayar;
        } else {
            $sisa_hbk = $total;
        }
        $data2 = [
            'total_hbk' => $total,
            'sisa_hbk' => $sisa_hbk,
        ];
        $this->HbkModel->update($id_hbk, $data2);

        return redirect()->back()->with('success', 'Total Deal Berhasil Diupdate');
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
