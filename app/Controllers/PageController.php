<?php

namespace App\Controllers;

class PageController extends BaseController
{
    public function home()
    {
        $data = [
            'title' => 'Halaman Home Company',
            'page' => $this->PageModel->findAll()
        ];
        // var_dump($data);

        return view('admin/page/home', $data);
    }

    public function homeupdate($id)
    {
        $foto = $this->request->getFile('home_gambar');
        //cek file gambar Diubah
        if ($foto->getError() == 4) {
            $nama_file = $this->request->getPost('gambarLama');
        } else {
            //buat nama file
            $nama_file = $foto->getRandomName();
            // pindahkan file
            $foto->move('foto/page', $nama_file);

            $filelama = $this->request->getPost('gambarLama');
            if ($filelama == "") {
            } else {
                //hapus gambar lama
                unlink('foto/page/' . $this->request->getPost('gambarLama'));
            }
        }

        //simpan data ke database
        $data = [
            'home_judul' => esc($this->request->getPost('home_judul')),
            'home_titel' => esc($this->request->getPost('home_titel')),
            'home_text' => esc($this->request->getPost('home_text')),
            'home_gambar' => $nama_file
        ];
        $this->PageModel->update($id, $data);

        return redirect()->back()->with('success', 'Data Halaman Home Berhasil Diubah');
    }

    public function usahaupdate($id)
    {
        $foto = $this->request->getFile('logo');
        //cek file gambar Diubah
        if ($foto->getError() == 4) {
            $nama_file = $this->request->getPost('gambarLama');
        } else {
            //buat nama file
            $nama_file = $foto->getRandomName();
            // pindahkan file
            $foto->move('foto/page', $nama_file);

            $filelama = $this->request->getPost('gambarLama');
            if ($filelama == "") {
            } else {
                //hapus gambar lama
                unlink('foto/page/' . $this->request->getPost('gambarLama'));
            }
        }

        //simpan data ke database
        $data = [
            'nama_usaha' => esc($this->request->getPost('nama_usaha')),
            'slogan' => esc($this->request->getPost('slogan')),
            'link_fb' => esc($this->request->getPost('link_fb')),
            'link_ig' => esc($this->request->getPost('link_ig')),
            'link_yt' => esc($this->request->getPost('link_yt')),
            'link_wa' => esc($this->request->getPost('link_wa')),
            'logo' => $nama_file
        ];
        $this->PageModel->update($id, $data);

        return redirect()->back()->with('success', 'Data Perusahaan Berhasil Diubah');
    }

    public function testimoniupdate($id)
    {
        //simpan data ke database
        $data = [
            'testimoni_titel' => esc($this->request->getPost('testimoni_titel')),
            'testimoni_judul' => esc($this->request->getPost('testimoni_judul'))
        ];
        $this->PageModel->update($id, $data);

        return redirect()->back()->with('success', 'Data Halaman Testimoni Berhasil Diubah');
    }

    public function kontakupdate($id)
    {
        //simpan data ke database
        $data = [
            'contact_titel' => esc($this->request->getPost('contact_titel')),
            'contact_judul' => esc($this->request->getPost('contact_judul')),
            'google_map' => esc($this->request->getPost('google_map')),
            'email' => esc($this->request->getPost('email')),
            'telpon' => esc($this->request->getPost('telpon')),
            'alamat' => esc($this->request->getPost('alamat'))
        ];
        $this->PageModel->update($id, $data);

        return redirect()->back()->with('success', 'Data Halaman Home Berhasil Diubah');
    }

    public function proyekupdate($id)
    {
        $foto = $this->request->getFile('projects_gambar');
        //cek file gambar Diubah
        if ($foto->getError() == 4) {
            $nama_file = $this->request->getPost('gambarLama');
        } else {
            //buat nama file
            $nama_file = $foto->getRandomName();
            // pindahkan file
            $foto->move('foto/page', $nama_file);

            $filelama = $this->request->getPost('gambarLama');
            if ($filelama == "") {
            } else {
                //hapus gambar lama
                unlink('foto/page/' . $this->request->getPost('gambarLama'));
            }
        }

        //simpan data ke database
        $data = [
            'project_titel' => esc($this->request->getPost('project_titel')),
            'project_judul' => esc($this->request->getPost('project_judul')),
            'projects_gambar' => $nama_file
        ];
        $this->PageModel->update($id, $data);

        return redirect()->back()->with('success', 'Data Halaman Project Berhasil Diubah');
    }

    public function aboutupdate($id)
    {
        $foto = $this->request->getFile('about_gambar');
        //cek file gambar Diubah
        if ($foto->getError() == 4) {
            $nama_file = $this->request->getPost('gambarLama');
        } else {
            //buat nama file
            $nama_file = $foto->getRandomName();
            // pindahkan file
            $foto->move('foto/page', $nama_file);

            $filelama = $this->request->getPost('gambarLama');
            if ($filelama == "") {
            } else {
                //hapus gambar lama
                unlink('foto/page/' . $this->request->getPost('gambarLama'));
            }
        }

        //simpan data ke database
        $data = [
            'about_titel' => esc($this->request->getPost('about_titel')),
            'about_judul' => esc($this->request->getPost('about_judul')),
            'about_text' => esc($this->request->getPost('about_text')),
            'about_list' => esc($this->request->getPost('about_list')),
            'about_nomor' => esc($this->request->getPost('about_nomor')),
            'about_text3' => esc($this->request->getPost('about_text3')),
            'about_gambar' => $nama_file
        ];
        $this->PageModel->update($id, $data);

        return redirect()->back()->with('success', 'Data Halaman About Berhasil Diubah');
    }

    public function about()
    {
        $data = [
            'title' => 'Halaman About Company',
            'page' => $this->PageModel->findAll()
        ];

        return view('admin/page/about', $data);
    }

    public function proyek()
    {
        $data = [
            'title' => 'Halaman Projects Company',
            'page' => $this->PageModel->findAll(),
            'daftar_project' => $this->ProjectModel->findAll()
        ];

        return view('admin/page/proyek', $data);
    }

    public function partner()
    {
        $data = [
            'title' => 'Halaman Partner Company',
            'page' => $this->PageModel->findAll(),
            'daftar_data' => $this->PartnerModel->findAll()
        ];

        return view('admin/page/partner', $data);
    }

    public function testimoni()
    {
        $data = [
            'title' => 'Halaman Testimoni Company',
            'page' => $this->PageModel->findAll(),
            'daftar_data' => $this->TestimoniModal->findAll()
        ];

        return view('admin/page/testimoni', $data);
    }

    public function kontak()
    {
        $data = [
            'title' => 'Halaman Contact Company',
            'page' => $this->PageModel->findAll()
        ];

        return view('admin/page/kontak', $data);
    }

    public function proyekstore()
    {
        $foto = $this->request->getFile('foto');
        $nama_file = $foto->getRandomName();

        //simpan data le database
        $data = [
            'nama_project' => esc($this->request->getPost('nama_project')),
            'deskripsi' => esc($this->request->getPost('deskripsi')),
            'pelanggan' => esc($this->request->getPost('pelanggan')),
            'pengerjaan' => esc($this->request->getPost('pengerjaan')),
            'tanggal' => esc($this->request->getPost('tanggal')),
            'gambar' => $nama_file
        ];
        $foto->move('foto/page/', $nama_file);
        $this->ProjectModel->insert($data);

        return redirect()->back()->with('success', 'Data Project Berhasil Ditambahkan');
    }

    public function proyekdataupdate($id)
    {
        $foto = $this->request->getFile('foto');
        //cek file gambar Diubah
        if ($foto->getError() == 4) {
            $nama_file = $this->request->getPost('gambarLama');
        } else {
            //buat nama file
            $nama_file = $foto->getRandomName();
            // pindahkan file
            $foto->move('foto/page/', $nama_file);

            $filelama = $this->request->getPost('gambarLama');
            if ($filelama == "") {
            } else {
                //hapus gambar lama
                unlink('foto/page/' . $this->request->getPost('gambarLama'));
            }
        }

        //simpan data le database
        $data = [
            'nama_project' => esc($this->request->getPost('nama_project')),
            'deskripsi' => esc($this->request->getPost('deskripsi')),
            'pelanggan' => esc($this->request->getPost('pelanggan')),
            'pengerjaan' => esc($this->request->getPost('pengerjaan')),
            'tanggal' => esc($this->request->getPost('tanggal')),
            'gambar' => $nama_file
        ];

        $this->ProjectModel->update($id, $data);

        return redirect()->back()->with('success', 'Data Project Berhasil Diubah');
    }

    public function destroy($id)
    {
        // Hapus data
        $nama_file = $this->request->getPost('gambar');
        if ($nama_file == "") {
        } else {
            unlink('foto/page/' . $this->request->getPost('gambar'));
        }
        $this->ProjectModel->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data Project telah Dihapus');
    }

    public function partnerupdate($id)
    {
        //simpan data ke database
        $data = [
            'partner_titel' => esc($this->request->getPost('partner_titel')),
            'partner_judul' => esc($this->request->getPost('partner_judul'))
        ];
        $this->PageModel->update($id, $data);

        return redirect()->back()->with('success', 'Data Halaman Partner Berhasil Diubah');
    }

    public function partnerstore()
    {
        $foto = $this->request->getFile('foto');
        $nama_file = $foto->getRandomName();

        //simpan data le database
        $data = [
            'nama' => esc($this->request->getPost('nama')),
            'logo' => $nama_file
        ];
        $foto->move('foto/page/', $nama_file);
        $this->PartnerModel->insert($data);

        return redirect()->back()->with('success', 'Data Partner Berhasil Ditambahkan');
    }

    public function partnerdataupdate($id)
    {
        $foto = $this->request->getFile('foto');
        //cek file gambar Diubah
        if ($foto->getError() == 4) {
            $nama_file = $this->request->getPost('gambarLama');
        } else {
            //buat nama file
            $nama_file = $foto->getRandomName();
            // pindahkan file
            $foto->move('foto/page/', $nama_file);

            $filelama = $this->request->getPost('gambarLama');
            if ($filelama == "") {
            } else {
                //hapus gambar lama
                unlink('foto/page/' . $this->request->getPost('gambarLama'));
            }
        }

        //simpan data le database
        $data = [
            'nama' => esc($this->request->getPost('nama')),
            'logo' => $nama_file
        ];

        $this->PartnerModel->update($id, $data);

        return redirect()->back()->with('success', 'Data Partner Berhasil Diubah');
    }

    public function partnerdestroy($id)
    {
        // Hapus data
        $nama_file = $this->request->getPost('gambar');
        if ($nama_file == "") {
        } else {
            unlink('foto/page/' . $this->request->getPost('gambar'));
        }
        $this->PartnerModel->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data Partner telah Dihapus');
    }

    public function testimonistore()
    {
        $data = [
            'nama_pelanggan' => esc($this->request->getPost('nama_pelanggan')),
            'project' => esc($this->request->getPost('project')),
            'ucapan' => esc($this->request->getPost('ucapan'))
        ];
        $this->TestimoniModal->insert($data);

        return redirect()->back()->with('success', 'Data Testimoni Berhasil Ditambahkan');
    }


    public function testimonidataupdate($id)
    {
        //simpan data le database
        $data = [
            'nama_pelanggan' => esc($this->request->getPost('nama_pelanggan')),
            'project' => esc($this->request->getPost('project')),
            'ucapan' => esc($this->request->getPost('ucapan'))
        ];

        $this->TestimoniModal->update($id, $data);

        return redirect()->back()->with('success', 'Data Testimoni Berhasil Diubah');
    }

    public function testimonidestroy($id)
    {
        $this->TestimoniModal->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data Testimoni telah Dihapus');
    }
}
