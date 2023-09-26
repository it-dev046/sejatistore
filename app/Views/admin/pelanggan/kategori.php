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
                            Daftar Kategori Pelanggan
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
                                        <th>Kategori</th>
                                        <th>Diskon Khusus</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($daftar_katepel as $katepel) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= $katepel->nama_katepel; ?> </td>
                                            <td> <?= $katepel->diskon_khusus; ?> </td>
                                            <td> <?= $katepel->keterangan; ?> </td>
                                            <td width="30%" class="text-canter">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $katepel->id_katepel; ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $katepel->id_katepel; ?>">
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah katepel Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('katepel/tambah') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="nama_katepel">Kategori Pelanggan</label>
                            <input type="text" name="nama_katepel" id="nama_katepel" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="diskon_khusus">Diskon Khusus</label>
                            <input type="number" name="diskon_khusus" id="diskon_khusus" class="form-control" required>
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
    <?php foreach ($daftar_katepel as $katepel) : ?>
        <div class="modal fade" id="ubahModal<?= $katepel->id_katepel; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah katepel Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('katepel/ubah/' . $katepel->id_katepel) ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="nama_katepel">Nama katepel</label>
                                <input type="text" name="nama_katepel" id="nama_katepel" class="form-control" value="<?= $katepel->nama_katepel; ?>" required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="diskon_khusus">Diskon Khusus</label>
                                <input type="number" name="diskon_khusus" id="diskon_khusus" class="form-control" value="<?= $katepel->diskon_khusus; ?>" required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?= $katepel->keterangan; ?>" required>
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
</div>
<?php endforeach; ?>

<?php foreach ($daftar_katepel as $katepel) : ?>
    <div class="modal fade" id="hapusModal<?= $katepel->id_katepel; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus katepel Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('katepel/hapus/' . $katepel->id_katepel) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <p>
                            Yakin Data katepel Produk :<font color="red"> <?= $katepel->nama_katepel; ?> </font>, akan dihapus ?
                        </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Hapus</button>
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