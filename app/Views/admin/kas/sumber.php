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
                            Daftar Sumber Kas
                        </div>

                        <div class="card-body">
                            <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                <i class="fas fa-plus"></i> Tambah
                            </button>
                            <a href="<?= base_url('sumber/detail') ?>" class="btn btn-warning btn-sm mb-2">
                                <i class="fas fa-file"></i> Laporan
                            </a>
                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>

                            <table id="table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Keterangan</th>
                                        <th>Saldo</th>
                                        <th>Pilih Tanggal</th>
                                        <th>Laporan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($daftar_sumber as $key => $sumber) { ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= $sumber['kode'] ?> </td>
                                            <td> <?= $sumber['keterangan'] ?> </td>
                                            <td>
                                                <?php if ($sumber['saldo'] == 0) { ?>
                                                    <?= $sumber['saldo'] ?>
                                                <?php } else { ?>
                                                    <?= number_to_currency($sumber['saldo'], 'IDR', 'id_ID',) ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <form action="<?= base_url('kas/laporan/preview') ?>" method="post">
                                                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                                                    <input type="text" name="id_sumber" id="id_sumber" value="<?= $sumber['id_sumber'] ?>" class="form-control" hidden>
                                                    <input type="number" name="saldo" id="saldo" value="<?= $sumber['saldo'] ?>" class="form-control" hidden>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-info btn-sm">
                                                    <i class="fas fa-list"></i> Lihat
                                                </button>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('kas/' . $sumber['id_sumber'] . '/preview') ?>" class="btn btn-dark btn-sm">
                                                    <i class="fas fa-folder"></i> Detail
                                                </a>
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $sumber['id_sumber'] ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $sumber['id_sumber'] ?>">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php }  ?>
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Sumber Dana</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('sumber/tambah') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="kode">Kode Sumber Dana</label>
                            <input type="text" name="kode" id="kode" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Jenis Simpanan </label><br>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="cash" value="1">
                                <label class="form-check-label">Uang Cash</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="cash" value="2">
                                <label class="form-check-label">Rekening</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="saldo">Saldo Awal</label>
                            <input type="number" name="saldo" id="saldo" class="form-control" required>
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

    <?php foreach ($daftar_sumber as $key => $value) { ?>
        <div class="modal fade" id="ubahModal<?= $value['id_sumber'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Sumber Kas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('sumber/ubah/' . $value['id_sumber']) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="mb-3">
                                <label for="kode">Kode Sumber Dana</label>
                                <input type="text" name="kode" id="kode" class="form-control" value="<?= $value['kode'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?= $value['keterangan'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Jenis Simpanan </label><br>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="cash" value="1" <?php if ($value['cash'] === '1') echo 'checked'; ?>>
                                    <label class="form-check-label">Uang Cash</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="cash" value="2" <?php if ($value['cash'] === '2') echo 'checked'; ?>>
                                    <label class="form-check-label">Rekening</label>
                                </div>
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
<?php } ?>

<?php foreach ($daftar_sumber as $key => $value) { ?>
    <div class="modal fade" id="hapusModal<?= $value['id_sumber'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Sumber Kas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('sumber/hapus/' . $value['id_sumber']) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <p>
                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td colspan="2" scope="row">Yakin Data Sumber Kas</td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Kode</td>
                                    <td> : <strong><?= $value['kode']; ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Keterangan</td>
                                    <td> : <strong><?= $value['keterangan']; ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">saldo</td>
                                    <td> : <strong><?= $value['saldo']; ?></strong></td>
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
<?php } ?>
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