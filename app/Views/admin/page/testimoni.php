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
                        <div class="col-xl-5">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Data Halaman Testimoni
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
                                                <td> <?= $value->testimoni_titel; ?> </td>
                                                <td width="50%"><?php $testimoni_judul = html_entity_decode($value->testimoni_judul); ?> <?= $testimoni_judul; ?></td>
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
                        <div class="col-xl-7">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Daftar Testimoni
                            </div>
                            <div class="card-body"><button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                    <i class="fas fa-plus"></i> Tambah Testimoni
                                </button>
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Project</th>
                                            <th>Testimoni</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($daftar_data as $value) : ?>
                                            <tr>
                                                <td> <?= $no++; ?> </td>
                                                <td> <?php $nama_pelanggan = html_entity_decode($value->nama_pelanggan); ?> <?= $nama_pelanggan; ?></td>
                                                <td> <?php $project = html_entity_decode($value->project); ?> <?= $project; ?></td>
                                                <td width="30%"> <?php $ucapan = html_entity_decode($value->ucapan); ?> <?= $ucapan; ?></td>
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Data Testimoni </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('page/testimoni/tambah') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="nama_pelanggan">Pelanggan</label>
                            <textarea name="nama_pelanggan" id="editor" class="form-control" cols="1" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="project">Project</label>
                            <textarea name="project" id="editor2" class="form-control" cols="1" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="ucapan">Testimoni</label>
                            <textarea name="ucapan" id="editor3" class="form-control" cols="1" rows="5" required></textarea>
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

    <?php foreach ($daftar_data as $value) : ?>
        <div class="modal fade" id="ubah2Modal<?= $value->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Data Testimoni</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('page/testimoni/ubahdata/' . $value->id) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="nama_pelanggan">Pelanggan</label>
                                <textarea name="nama_pelanggan" id="editor4<?= $value->id; ?>" class="form-control" cols="1" rows="5" required><?= $value->nama_pelanggan; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="project">Project</label>
                                <textarea name="project" id="editor5<?= $value->id; ?>" class="form-control" cols="1" rows="5" required><?= $value->project; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="ucapan">Testimoni</label>
                                <textarea name="ucapan" id="editor6<?= $value->id; ?>" class="form-control" cols="1" rows="5" required><?= $value->ucapan; ?></textarea>
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
                    <form action=" <?= base_url('page/testimoni/hapusdata/' . $value->id) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <p>
                            Yakin Data Project : <?= $value->nama_pelanggan; ?> , akan dihapus ?
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Tampilan Halaman testimoni</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('page/testimoni/ubah/' . $value->id) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <input type="hidden" name="_method" value="PUT">
                            <label for="testimoni_titel">Titel</label>
                            <input type="text" name="testimoni_titel" id="testimoni_titel" class="form-control" value="<?= $value->testimoni_titel; ?>" required>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="_method" value="PUT">
                            <label for="testimoni_judul">Judul</label>
                            <textarea name="testimoni_judul" id="editor7" class="form-control" cols="1" rows="5" required><?= $value->testimoni_judul; ?></textarea>
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
    <?php foreach ($daftar_data as $value) : ?>
        CKEDITOR.replace('editor4<?= $value->id; ?>');
        CKEDITOR.replace('editor5<?= $value->id; ?>');
        CKEDITOR.replace('editor6<?= $value->id; ?>');
    <?php endforeach; ?>

    CKEDITOR.replace('editor');
    CKEDITOR.replace('editor2');
    CKEDITOR.replace('editor3');
    CKEDITOR.replace('editor7');
</script>
<?= $this->endSection() ?>