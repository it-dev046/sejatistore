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
                    <!-- Notifikasi Berhasil -->
                    <?php if (session('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session('success'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Data Halaman Partner
                            </div>
                            <div class="card-body">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th>Titel</th>
                                            <th>Judul</th>
                                            <th>Aksi</th>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($page as $value) : ?>
                                            <!-- html... -->
                                            <tr>
                                                <td> <?= $value->partner_titel; ?> </td>
                                                <td> <?php $partner_judul = html_entity_decode($value->partner_judul); ?>
                                                    <?= $partner_judul; ?></td>
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
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Daftar Partner
                            </div>
                            <div class="card-body"><button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                    <i class="fas fa-plus"></i> Tambah Partner
                                </button>
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Logo Partner</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($daftar_data as $value) : ?>
                                            <tr>
                                                <td> <?= $no++; ?> </td>
                                                <td> <?php $nama = html_entity_decode($value->nama); ?>
                                                    <?= $nama; ?></td>
                                                <td>
                                                    <img src="<?= base_url('foto/page/' . $value->logo) ?>" alt="" width="50px" height="50px">
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
                                </table>
                            </div>
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Data Partner </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('page/partner/tambah') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="nama">Nama Partner</label>
                            <textarea name="nama" id="editor" class="form-control" cols="1" rows="5" required></textarea>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="gambar_produk">Upload Logo</label>
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

<?php foreach ($daftar_data as $value) : ?>
    <div class="modal fade" id="ubah2Modal<?= $value->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Data Partner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('page/partner/ubahdata/' . $value->id) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <input type="hidden" name="_method" value="PUT">
                            <label for="nama">Nama Partner</label>
                            <textarea name="nama" id="editor0<?= $value->id; ?>" class="form-control" cols="1" rows="5" required><?= $value->nama; ?></textarea>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="gambar_produk">Upload Logo</label>
                            <input type="hidden" name="gambarLama" value="<?= $value->logo; ?>">
                            <input type="file" name="foto" id="preview<?= $value->id; ?>" accept="image/*" class="form-control" onchange="PreviewImage();" value="<?= $value->logo; ?>" />
                            <label for="gambar_produk">Preview</label><br>
                            <img src="<?= base_url('foto/page/' . $value->logo) ?>" alt="" id="load<?= $value->id; ?>" width="100px" height="100px">
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

<?php foreach ($daftar_data as $value) : ?>
    <div class="modal fade" id="hapus2Modal<?= $value->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('page/partner/hapusdata/' . $value->id) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="gambar" value="<?= $value->logo; ?>">
                        <p>
                            Yakin Data Project : <?= $value->nama; ?> , akan dihapus ?
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Tampilan Halaman Partner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('page/partner/ubah/' . $value->id) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <input type="hidden" name="_method" value="PUT">
                            <label for="partner_titel">Titel</label>
                            <input type="text" name="partner_titel" id="partner_titel" class="form-control" value="<?= $value->partner_titel; ?>" required>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="_method" value="PUT">
                            <label for="partner_judul">Judul</label>
                            <textarea name="partner_judul" id="editor2" class="form-control" cols="1" rows="5" required><?= $value->partner_judul; ?></textarea>
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

    <?php foreach ($daftar_data as $value) : ?>

        function baca<?= $value->id; ?>(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#load<?= $value->id; ?>').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $('#preview<?= $value->id; ?>').change(function() {
            baca<?= $value->id; ?>(this);
        });
    <?php endforeach; ?>
    CKEDITOR.disableAutoInline = true;

    <?php foreach ($daftar_data as $value) : ?>
        CKEDITOR.replace('editor0<?= $value->id; ?>');
    <?php endforeach; ?>

    CKEDITOR.replace('editor');
    CKEDITOR.replace('editor2');
</script>
<?= $this->endSection() ?>