<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> <?= $title; ?> </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item active"> <?= $title; ?> </li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Tampilan Project
                        </div>

                        <div class="card-body">
                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>

                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>Titel</th>
                                        <th>Judul</th>
                                        <th>Background</th>
                                        <th>Aksi</th>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($page as $value) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $value->project_titel; ?> </td>
                                            <td> <?php $project_judul = html_entity_decode($value->project_judul); ?>
                                                <?= $project_judul; ?></td>
                                            <td>
                                                <img src="<?= base_url('foto/page/' . $value->projects_gambar) ?>" alt="" width="400px" height="300px">
                                            </td>
                                            <td class="text-canter">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $value->id; ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                </tr>
                                </thead>
                            </table>
                            <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                <i class="fas fa-plus"></i> Tambah Project
                            </button>
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Poryek</th>
                                        <th>Deskripsi</th>
                                        <th>Pelanggan</th>
                                        <th>Penegerjaan</th>
                                        <th>Tanggal selesai</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($daftar_project as $value) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?php $nama_project = html_entity_decode($value->nama_project); ?>
                                                <?= $nama_project; ?></td>
                                            <td> <?php $deskripsi = html_entity_decode($value->deskripsi); ?>
                                                <?= $deskripsi; ?></td>
                                            <td> <?php $pelanggan = html_entity_decode($value->pelanggan); ?>
                                                <?= $pelanggan; ?></td>
                                            <td> <?php $pengerjaan = html_entity_decode($value->pengerjaan); ?>
                                                <?= $pengerjaan; ?></td>
                                            <td> <?php $tanggal = html_entity_decode($value->tanggal); ?>
                                                <?= $tanggal; ?></td>
                                            <td>
                                                <img src="<?= base_url('foto/page/' . $value->gambar) ?>" alt="" width="100px" height="100px">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubah2Modal<?= $value->id; ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus2Modal<?= $value->id; ?>">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Hasil Pemasangan </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('page/proyek/tambah') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="nama_project">Nama Project</label>
                            <textarea name="nama_project" id="editor" class="form-control" cols="1" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="pelanggan">Nama Pelanggan</label>
                            <textarea name="pelanggan" id="editor2" class="form-control" cols="1" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="editor3" class="form-control" cols="1" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="pengerjaan">Pengerjaan</label>
                            <textarea name="pengerjaan" id="editor4" class="form-control" cols="1" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal">Tanggal Selesai</label>
                            <textarea name="tanggal" id="editor5" class="form-control" cols="1" rows="5" required></textarea>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="gambar_produk">Upload Foto</label>
                            <input type="file" name="foto" id="preview_gambar" accept="image/*" class="form-control" onchange="PreviewImage();" />
                            <label for="gambar_produk">Preview</label><br>
                            <img src="<?= base_url('foto/blank.jpg') ?>" alt="" id="gambar_load" width="100px" height="100px">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php foreach ($daftar_project as $value) : ?>
    <div class="modal fade" id="ubah2Modal<?= $value->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('page/proyek/ubahdata/' . $value->id) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <input type="hidden" name="_method" value="PUT">
                            <label for="nama_project">Nama Project</label>
                            <textarea name="nama_project" id="editor6<?= $value->id; ?>" class="form-control" cols="1" rows="5" required><?= $value->nama_project; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="pelanggan">Nama Pelanggan</label>
                            <textarea name="pelanggan" id="editor7<?= $value->id; ?>" class="form-control" cols="1" rows="5" required><?= $value->pelanggan; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="editor8<?= $value->id; ?>" class="form-control" cols="1" rows="5" required><?= $value->deskripsi; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="pengerjaan">Pengerjaan</label>
                            <textarea name="pengerjaan" id="editor9<?= $value->id; ?>" class="form-control" cols="1" rows="5" required><?= $value->pengerjaan; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal">Tanggal Selesai</label>
                            <textarea name="tanggal" id="editor10<?= $value->id; ?>" class="form-control" cols="1" rows="5" required><?= $value->tanggal; ?></textarea>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="gambar_produk">Upload Foto</label>
                            <input type="hidden" name="gambarLama" value="<?= $value->gambar; ?>">
                            <input type="file" name="foto" id="preview0<?= $value->id; ?>" accept="image/*" class="form-control" onchange="PreviewImage();" value="<?= $value->gambar; ?>" />
                            <label for="gambar_produk">Preview</label><br>
                            <img src="<?= base_url('foto/page/' . $value->gambar) ?>" alt="" id="load0<?= $value->id; ?>" width="100px" height="100px">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm">Ubah</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
<?php endforeach; ?>

<?php foreach ($daftar_project as $value) : ?>
    <div class="modal fade" id="hapus2Modal<?= $value->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('page/proyek/hapusdata/' . $value->id) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="gambar" value="<?= $value->gambar; ?>">
                        <p>
                            Yakin Data Project : <?= $value->nama_project; ?> , akan dihapus ?
                        </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
<?php endforeach; ?>

<?php foreach ($page as $value) : ?>
    <div class="modal fade" id="ubahModal<?= $value->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Tampilan Halaman Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('page/proyek/ubah/' . $value->id) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <input type="hidden" name="_method" value="PUT">
                            <label for="project_titel">Titel</label>
                            <input type="text" class="form-control" name="project_titel" id="project_titel" value="<?= $value->project_titel; ?>">
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="_method" value="PUT">
                            <label for="project_judul">Judul</label>
                            <textarea name="project_judul" id="editor11" class="form-control" cols="1" rows="5" required><?= $value->project_judul; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="_method" value="PUT">
                            <label for="projects_gambar">Upload Background</label>
                            <input type="hidden" name="gambarLama" value="<?= $value->projects_gambar; ?>">
                            <input type="file" name="projects_gambar" id="foto" accept="image/*" class="form-control" onchange="PreviewImage();" value="<?= $value->projects_gambar; ?>" />
                            <label for="gambar_produk">Preview</label><br>
                            <img src="<?= base_url('foto/page/' . $value->projects_gambar) ?>" alt="" id="gambar_load2" width="200px" height="100px">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Ubah</button>
                </div>
                </form>
            </div>
        </div>
    </div>

<?php endforeach; ?>
<?= $this->endSection() ?>
<?= $this->Section('script') ?>
<script>
    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#gambar_load').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#preview_gambar').change(function() {
        bacaGambar(this);
    });

    function bacaGambar2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#gambar_load2').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#foto').change(function() {
        bacaGambar2(this);
    });

    <?php foreach ($daftar_project as $value) : ?>

        function bacaGambar0<?= $value->id; ?>(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#load0<?= $value->id; ?>').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $('#preview0<?= $value->id; ?>').change(function() {
            bacaGambar0<?= $value->id; ?>(this);
        });

    <?php endforeach; ?>

    CKEDITOR.replace('editor');
    CKEDITOR.replace('editor2');
    CKEDITOR.replace('editor3');
    CKEDITOR.replace('editor4');
    CKEDITOR.replace('editor5');
    <?php foreach ($daftar_project as $value) : ?>
        CKEDITOR.replace('editor6<?= $value->id; ?>');
        CKEDITOR.replace('editor7<?= $value->id; ?>');
        CKEDITOR.replace('editor8<?= $value->id; ?>');
        CKEDITOR.replace('editor9<?= $value->id; ?>');
        CKEDITOR.replace('editor10<?= $value->id; ?>');
    <?php endforeach; ?>
    CKEDITOR.replace('editor11');
</script>
<?= $this->endSection() ?>