<?php

namespace App\Controllers;

class SurveiController extends BaseController
{

    public function index()
    {
        $data = [
            'title' => 'Halaman Survei Lapangan',
            'pengukur' => $this->PengukurModel->orderBy('nama', 'ASC')->findAll(),
            'drafter' => $this->DrafterModel->orderBy('nama', 'ASC')->findAll(),
            'daftar_tukang' => $this->TukangModel->orderBy('nama', 'ASC')->findAll(),
            'daftar_survei' => $this->SurveiModel->orderBy('id_survei', 'DESC')->findAll()
        ];

        return view('admin/survei/index', $data);
    }

    public function store()
    {
        $sketsa = $this->request->getFile('sketsa');
        $nama_file = $sketsa->getRandomName();
        //simpan database
        $data = [
            'tanggal' => esc($this->request->getPost('tanggal')),
            'pelanggan' => esc($this->request->getPost('pelanggan')),
            'alamat' => esc($this->request->getPost('alamat')),
            'telepon' => esc($this->request->getPost('telepon')),
            'pengukur' => esc($this->request->getPost('pengukur')),
            'keterangan' => esc($this->request->getPost('keterangan')),
            'drafter' => esc($this->request->getPost('drafter')),
            'status' => 0,
            'biaya' => 0,
            'sketsa' => $nama_file
        ];
        $sketsa->move('foto/sketsa', $nama_file);
        $this->SurveiModel->insert($data);

        return redirect()->back()->with('success', 'Data Survei Lapangan Berhasil Ditambahkan');
    }

    public function deal($id_survei)
    {
        //simpan database
        $tanggal = date('Y-m-d');
        $data = [
            'status' => esc($this->request->getPost('status')),
            'biaya' => esc($this->request->getPost('biaya')),
            'tukang' => esc($this->request->getPost('tukang')),
            'tanggal_update' => $tanggal,
        ];
        $this->SurveiModel->update($id_survei, $data);

        return redirect()->back()->with('success', 'Status Survei Lapangan Sudah Deal');
    }

    public function update($id_survei)
    {
        $file = $this->request->getFile('sketsa');
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
        //simpan data ke database
        $data = [
            'tanggal' => esc($this->request->getPost('tanggal')),
            'pelanggan' => esc($this->request->getPost('pelanggan')),
            'alamat' => esc($this->request->getPost('alamat')),
            'telepon' => esc($this->request->getPost('telepon')),
            'pengukur' => esc($this->request->getPost('pengukur')),
            'keterangan' => esc($this->request->getPost('keterangan')),
            'drafter' => esc($this->request->getPost('drafter')),
            'sketsa' => $nama_file
        ];
        $this->SurveiModel->update($id_survei, $data);

        return redirect()->back()->with('success', 'Data Survei Lapangan Berhasil Diubah');
    }

    public function destroy($id_survei)
    {
        $nama_file = $this->request->getPost('sketsa');
        if ($nama_file == "") {
        } else {
            unlink('foto/sketsa/' . $this->request->getPost('sketsa'));
        }
        // Hapus data
        $this->SurveiModel->where('id_survei', $id_survei)->delete();

        return redirect()->back()->with('success', 'Data Survei Lapangan Berhasil Dihapus');
    }

    public function sketsa($id_survei)
    {
        $survei = $this->SurveiModel->where('id_survei', $id_survei)->first();
        $file = 'foto/sketsa/' . $survei->sketsa; // Ganti dengan path file yang ingin di-download

        if (file_exists($file)) {
            return $this->response->download($file, null);
        } else {
            // Jika file tidak ditemukan, tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            return redirect()->back()->with('success', 'File Template Tidak Tersedia');
        }
    }

    public function uraian($id)
    {
        $survei = $this->SurveiModel->where('id_survei', $id)->first();
        $data = [
            'title' => 'Halaman Rincian Biaya Pemasangan',
            'survei' => $this->SurveiModel->where('id_survei', $id)->first(),
            'subkerja' => $this->KerjaModel->orderBy('kerja.nama', 'ASC')
                ->join('subkerja', 'subkerja.id_kerja = kerja.id_kerja', 'left')
                ->findAll(),
            'kerja' => $this->KerjaModel->orderBy('nama', 'ASC')
                ->findAll(),
            'ukuran' => $this->UkuranModel->orderBy('keterangan', 'ASC')->findAll(),
            'totalbiaya' => $this->DetailpasangModel->jumlahbiaya($id),
            'daftar_uraian' => $this->DetailpasangModel
                ->join('subkerja', 'subkerja.id = detail_pemasangan.id_sub', 'right')
                ->join('kerja', 'kerja.id_kerja = subkerja.id_kerja', 'right')
                ->select('detail_pemasangan.*, subkerja.nama_sub, kerja.nama')
                ->orderBy('kerja.nama', 'DESC')
                ->where('id_survei', $id)->findAll(),
            'pengawas' => $this->PengukurModel->orderBy('nama', 'ASC')->findAll(),
            'daftar_tukang' => $this->TukangModel->orderBy('nama', 'ASC')->findAll(),
            'daftar_kerja' => $this->KerjaModel->orderBy('nama', 'ASC')->findAll(),
        ];
        // var_dump($data);

        echo view('admin/survei/uraian', $data);
    }

    public function uraiansimpan()
    {
        //simpan data database
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
        $this->SurveiModel->update($id, $data2);

        return redirect()->back()->with('success', 'Data Pekerjaan berhasil Ditambahkan');
    }

    public function updateuraian($id)
    {
        //simpan data ke database
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

        $id_survei = $this->request->getPost('id_survei');

        $totalbiaya = $this->DetailpasangModel->jumlahbiaya($id_survei);
        $data2 = [
            'biaya' => $totalbiaya,
        ];
        $this->SurveiModel->update($id_survei, $data2);

        return redirect()->back()->with('success', 'Data Pekerjaan berhasil Diubah');
    }

    public function uraianhapus($id)
    {
        // Hapus data
        $this->DetailpasangModel->where('id', $id)->delete();

        $data2 = [
            'biaya' => $totalbiaya,
        ];
        $this->SurveiModel->update($id, $data2);

        $id_survei = $this->request->getPost('id_survei');
        $totalbiaya = $this->DetailpasangModel->jumlahbiaya($id_survei);
        $data2 = [
            'biaya' => $totalbiaya,
        ];
        $this->SurveiModel->update($id_survei, $data2);

        return redirect()->back()->with('success', 'Data Uraian Pemasangan Berhasil dihapus');
    }

    public function uraianbatal($id_survei)
    {
        // Hapus data
        $this->DetailpasangModel->where('id_survei', $id_survei)->delete();

        $totalbiaya = $this->DetailpasangModel->jumlahbiaya($id_survei);
        $data2 = [
            'biaya' => $totalbiaya,
        ];
        $this->SurveiModel->update($id_survei, $data2);

        return redirect()->back()->with('success', 'Data Uraian telah dibatalkan');
    }

    public function updatetotal($id)
    {
        //simpan data ke database
        $data = [
            'biaya' => esc($this->request->getPost('biaya')),
        ];
        $this->SurveiModel->update($id, $data);

        return redirect()->back()->with('success', 'Total Deal Berhasil Diupdate');
    }
}
