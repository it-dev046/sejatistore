<?php

namespace App\Controllers;

date_default_timezone_set("Asia/Manila");

class OrderController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Order Barang',
            'userId' => $this->session->get('id'),
            'level' => $this->session->get('level'),
            'daftar_order' => $this->OrderModel
                ->join('toko', 'toko.id_toko = order.id_toko', 'left')
                ->orderBy('id_order', 'DESC')
                ->findAll(),
            'daftar_uraian' => $this->DetailorderModel->orderBy('id_order', 'DESC')->findAll(),
        ];

        return view('admin/order/index', $data);
    }

    public function store()
    {
        $tanggal = date('Y-m-d');

        //simpan data le database
        $data = [
            'tanggal' => $tanggal,
            'pemesan' => esc($this->request->getPost('pemesan')),
            'penerima' => esc($this->request->getPost('penerima')),
            'kerja' => esc($this->request->getPost('kerja')),
            'keterangan' => esc($this->request->getPost('keterangan')),
            'tanggal_acc' => $tanggal,
            'bayar' => 0,
            'status' => 'Belum',
            'nota' => 'Belum',
            'bukti' => 'Belum',
        ];
        $this->OrderModel->insert($data);

        return redirect()->back()->with('success', 'Data order Berhasil Ditambahkan');
    }

    public function update($id_order)
    {
        //simpan data ke database
        $data = [
            'pemesan' => esc($this->request->getPost('pemesan')),
            'penerima' => esc($this->request->getPost('penerima')),
            'kerja' => esc($this->request->getPost('kerja')),
            'keterangan' => esc($this->request->getPost('keterangan')),
            'bayar' => esc($this->request->getPost('bayar')),
        ];
        $this->OrderModel->update($id_order, $data);

        return redirect()->back()->with('success', 'Data order Berhasil Diubah');
    }

    public function nota($id_order)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');
        $status = $this->request->getPost('status');

        if ($userId == $cekid) {

            $file = $this->request->getFile('nota');
            //cek file gambar Diubah
            if ($file->getError() == 4) {
                $nama_file = $this->request->getPost('notalama');
            } else {
                //buat nama file
                $nama_file = $file->getRandomName();
                // pindahkan file
                $file->move('foto/order', $nama_file);
                $filelama = $this->request->getPost('notalama');
                if ($filelama == "Belum") {
                } else {
                    //hapus gambar lama
                    unlink('foto/order/' . $this->request->getPost('notalama'));
                }
            }

            //simpan data ke database
            $data = [
                'id_toko' => esc($this->request->getPost('id_toko')),
                'bayar' => esc($this->request->getPost('bayar')),
                'nota' => $nama_file,
                'status' => $status,
            ];
            $this->OrderModel->update($id_order, $data);

            return redirect()->back()->with('success', 'Nota Toko Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function bukti($id_order)
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');
        $status = $this->request->getPost('status');

        if ($userId == $cekid) {

            $file = $this->request->getFile('bukti');
            //cek file gambar Diubah
            if ($file->getError() == 4) {
                $nama_file = $this->request->getPost('buktilama');
            } else {
                //buat nama file
                $nama_file = $file->getRandomName();
                // pindahkan file
                $file->move('foto/order', $nama_file);
                $filelama = $this->request->getPost('buktilama');
                if ($filelama == "Belum") {
                } else {
                    //hapus gambar lama
                    unlink('foto/order/' . $this->request->getPost('buktilama'));
                }
            }

            //simpan data ke database
            $data = [
                'bukti' => $nama_file,
                'status' => $status,
            ];
            $this->OrderModel->update($id_order, $data);

            return redirect()->back()->with('success', 'Bukti Transfer Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function destroy($id_order)
    {
        // Hapus data
        $order = $this->OrderModel->where('id_order', $id_order)->first();
        $bukti = $order->bukti;
        if ($bukti == "Belum") {
        } else {
            unlink('foto/order/' . $bukti);
        }

        $nota = $order->nota;
        if ($nota == "Belum") {
        } else {
            unlink('foto/order/' . $nota);
        }
        $this->DetailorderModel->where('id_order', $id_order)->delete();
        $this->OrderModel->where('id_order', $id_order)->delete();

        return redirect()->back()->with('success', 'Data order Berhasil Dihapus');
    }


    public function uraian($id_order)
    {
        $order = $this->OrderModel->where('id_order', $id_order)->first();
        $data = [
            'title' => 'Halaman Detail Order',
            'userId' => $this->session->get('id'),
            'level' => $this->session->get('level'),
            'order' => $this->OrderModel
                ->join('toko', 'toko.id_toko=order.id_toko', 'left')
                ->select('order.*, toko.nama, toko.rek1, toko.rek2, toko.rek3, toko.keterangan AS ket')
                ->where('id_order', $id_order)
                ->first(),
            'daftar_toko' => $this->TokoModel->orderBy('nama', 'ASC')->findAll(),
            'daftar_uraian' => $this->DetailorderModel
                ->where('id_order', $order->id_order)
                ->findAll(),
        ];
        // var_dump($data);

        echo view('admin/order/uraian', $data);
    }

    public function uraiansimpan()
    {
        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {

            $data = [
                'id_order' => esc($this->request->getPost('id_order')),
                'nama' => esc($this->request->getPost('nama')),
                'jumlah' => esc($this->request->getPost('jumlah')),
                'spek' => esc($this->request->getPost('spek')),
            ];
            $this->DetailorderModel->insert($data);

            return redirect()->back()->with('success', 'Data Order Barang Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function updateuraian($id)
    {
        //simpan data ke database

        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            $data = [
                'nama' => esc($this->request->getPost('nama')),
                'spek' => esc($this->request->getPost('spek')),
                'jumlah' => esc($this->request->getPost('jumlah')),
            ];
            $this->DetailorderModel->update($id, $data);

            return redirect()->back()->with('success', 'Data Order Barang Berhasil Diubah');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function uraianhapus($id)
    {
        // Hapus data

        $cekid = $this->session->get('id');
        $userId = $this->request->getPost('userId');

        if ($userId == $cekid) {
            $this->DetailorderModel->where('id', $id)->delete();

            return redirect()->back()->with('success', 'Data Order Barang Berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Maaf Server sedang sibuk silakhan input ulang');
        }
    }

    public function unduhnota($id_order)
    {
        $order = $this->OrderModel->where('id_order', $id_order)->first();
        $file = 'foto/order/' . $order->nota; // Ganti dengan path file yang ingin di-download

        if (file_exists($file)) {
            return $this->response->download($file, null);
        } else {
            // Jika file tidak ditemukan, tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            return redirect()->back()->with('success', 'File Template Tidak Tersedia');
        }
    }

    public function unduhbukti($id_order)
    {
        $order = $this->OrderModel->where('id_order', $id_order)->first();
        $file = 'foto/order/' . $order->bukti; // Ganti dengan path file yang ingin di-download

        if (file_exists($file)) {
            return $this->response->download($file, null);
        } else {
            // Jika file tidak ditemukan, tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            return redirect()->back()->with('success', 'File Template Tidak Tersedia');
        }
    }
}
