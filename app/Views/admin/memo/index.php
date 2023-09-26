<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> <?= $title; ?> </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard-admin') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item active"> <?= $title; ?> </li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Memo Perusahaan
                        </div>
                        <div class="card-body">

                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>

                            <form action="<?= base_url('memo/tambah') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                                <div class="row">
                                    <div class="mb-3 col-2">
                                        <label for="nilai">
                                            <h6>Tanggal</h6>
                                        </label>
                                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="nama">
                                            <h6>Nama Supir</h6>
                                        </label>
                                        <input type="text" name="nama" id="nama" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="telpon">
                                            <h6>Telepon / WA</h6>
                                        </label>
                                        <input type="text" name="telpon" id="telpon" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="nomor">
                                            <h6>No Plat</h6>
                                        </label>
                                        <input type="text" name="nomor" id="nomor" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="barang">
                                            <h6>Pengambilan</h6>
                                        </label>
                                        <textarea name="barang" id="barang" class="form-control" cols="30" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="alamat">
                                            <h6>Alamat</h6>
                                        </label>
                                        <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3 col-1 mt-5">
                                        <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                                    </div>
                                </div>
                            </form>
                            <hr>

                            <table id="table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Supir</th>
                                        <th>Telepon</th>
                                        <th>No Plat</th>
                                        <th>Pengambilan</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($daftar_memo as $value) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= date('d M Y', strtotime($value->tanggal)) ?></td>
                                            <td> <?= $value->nama; ?> </td>
                                            <td> <?= $value->telpon; ?> </td>
                                            <td> <?= $value->nomor; ?> </td>
                                            <td> <?= $value->barang; ?> </td>
                                            <td> <?= $value->alamat; ?> </td>
                                            <td class="text-canter">
                                                <a href="<?= base_url('memo/cetak/' . $value->id_memo) ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $value->id_memo; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $value->id_memo; ?>">
                                                    <i class="fas fa-trash-alt"></i>
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

    <?php foreach ($daftar_memo as $memo) : ?>
        <div class="modal fade" id="ubahModal<?= $memo->id_memo; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Memo Perusahaan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('memo/ubah/' . $memo->id_memo) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="mb-3">
                                <label for="nilai">
                                    <h6>Tanggal</h6>
                                </label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= $memo->tanggal; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama">
                                    <h6>Nama Supir</h6>
                                </label>
                                <input type="text" name="nama" id="nama" class="form-control" value="<?= $memo->nama; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="telpon">
                                    <h6>Telepon / WA</h6>
                                </label>
                                <input type="text" name="telpon" id="telpon" class="form-control" value="<?= $memo->telpon; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="nomor">
                                    <h6>No Plat</h6>
                                </label>
                                <input type="text" name="nomor" id="nomor" class="form-control" value="<?= $memo->nomor; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="barang">
                                    <h6>Pengambilan Barang</h6>
                                </label>
                                <textarea name="barang" id="barang" class="form-control" cols="30" rows="3" required><?= $memo->barang; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="alamat">
                                    <h6>Alamat Pengambilan</h6>
                                </label>
                                <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="3" required><?= $memo->alamat; ?></textarea>
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

<?php foreach ($daftar_memo as $memo) : ?>
    <div class="modal fade" id="hapusModal<?= $memo->id_memo; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Memo Perusahaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('memo/hapus/' . $memo->id_memo) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                        <input type="hidden" name="_method" value="DELETE">
                        <p>
                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td colspan="2" scope="row">Yakin Memo Perusahaan</td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Tanggal</td>
                                    <td> : <strong><?= date('d F Y', strtotime($memo->tanggal)) ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="150px">Nama</td>
                                    <td> : <strong><?= $memo->nama ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="150px">Pengambilan</td>
                                    <td> : <strong><?= $memo->barang ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="150px">Alamat</td>
                                    <td> : <strong><?= $memo->alamat ?></strong></td>
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
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#table').DataTable({
            buttons: ['copy', 'csv', 'print', 'excel', 'pdf', 'colvis'],
            dom: "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row'<'col-md-5'i><'col-md-7'p>>",
            lengthMenu: [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ]
        });

        table.buttons().container()
            .appendTo('#table_wrapper .col-md-5:eq(0)');
    });
</script>
<?= $this->endSection() ?>