<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> <?= $title; ?> </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard-drafter') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item"><a href=" <?= base_url('kerja') ?> ">Daftar Pekerjaan</a></li>
                <li class="breadcrumb-item active"> <?= $title; ?> </li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Sub Pekerjaan <?= $kerjaan->nama; ?>
                        </div>

                        <div class="card-body">
                            <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                <i class="fas fa-plus"></i> Tambah
                            </button>

                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>

                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Sub</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($daftar_subkerja as $value) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= $value->nama_sub; ?> </td>
                                            <td> <?= $value->keterangan; ?> </td>
                                            <td width="30%" class="text-canter">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $value->id; ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $value->id; ?>">
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
    </main>

    <!-- Modal -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Sub Pekerjaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('kerja/sub/tambah') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_kerja" id="id_kerja" class="form-control" value="<?= $kerjaan->id_kerja; ?>">
                        <div class="mb-3">
                            <label for="nama_sub">Nama Sub</label>
                            <input type="text" name="nama_sub" id="nama_sub" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control" required>
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

    <?php foreach ($daftar_subkerja as $kerja) : ?>
        <div class="modal fade" id="ubahModal<?= $kerja->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Pekerjaan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('kerja/sub/ubah/' . $kerja->id) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="mb-3">
                                <label for="nama_sub">Pekerjaan</label>
                                <input type="text" name="nama_sub" id="nama_sub" class="form-control" value="<?= $kerja->nama_sub; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?= $kerja->keterangan; ?>" required>
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

<?php foreach ($daftar_subkerja as $kerja) : ?>
    <div class="modal fade" id="hapusModal<?= $kerja->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Pekerjaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('kerja/sub/hapus/' . $kerja->id) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <p>
                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td colspan="2" scope="row">Yakin Data Pekerjaan</td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Pekerjaan</td>
                                    <td> : <strong><?= $kerjaan->nama; ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Sub Kerja</td>
                                    <td> : <strong><?= $kerja->nama_sub; ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Keterangan</td>
                                    <td> : <strong><?= $kerja->keterangan; ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
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

<?= $this->endSection() ?>
<?= $this->Section('script') ?>
<?= $this->endSection() ?>