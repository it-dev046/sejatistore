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
                            Daftar Penggajian Karyawan
                        </div>
                        <div class="card-body">

                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>

                            <form action="<?= base_url('gaji/tambah') ?>" method="post">
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
                                        <label for="nilai">
                                            <h6>Nama karyawan</h6>
                                        </label>
                                        <select name="id_karyawan" id="id_karyawan" class="form-control" required>
                                            <option value="" hidden>--Pilih--</option>
                                            <!-- panggil data Sumber -->
                                            <?php foreach ($daftar_karyawan as $key => $karyawan) { ?>
                                                <option value="<?= $karyawan->id_karyawan ?>"><?= $karyawan->nama ?> (<?= $karyawan->posisi ?>)</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="potongan">
                                            <h6>Potongan</h6>
                                        </label>
                                        <input type="number" name="potongan" id="potongan" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="keterangan">
                                            <h6>Keterangan</h6>
                                        </label>
                                        <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="3" required></textarea>
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
                                        <th>Nama</th>
                                        <th>Nominal</th>
                                        <th>Total</th>
                                        <th>Rekening</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($daftar_gaji as $value) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= date('d M Y', strtotime($value->tanggal)) ?></td>
                                            <td> <?= $value->nama; ?> </td>
                                            <td>
                                                Gapok :
                                                <?php if (!empty($value->gapok)) { ?>
                                                    <?= number_to_currency($value->gapok, 'IDR', 'id_ID',) ?>
                                                <?php } else { ?>
                                                    0
                                                <?php } ?>
                                                <br>
                                                Bonus :
                                                <?php if (!empty($value->bonus)) { ?>
                                                    <?= number_to_currency($value->bonus, 'IDR', 'id_ID',) ?>
                                                <?php } else { ?>
                                                    0
                                                <?php } ?>
                                                <br>
                                                Potongan :
                                                <?php if (!empty($value->potongan)) { ?>
                                                    <?= number_to_currency($value->potongan, 'IDR', 'id_ID',) ?>
                                                <?php } else { ?>
                                                    0
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($value->total)) { ?>
                                                    <?= number_to_currency($value->total, 'IDR', 'id_ID',) ?>
                                                <?php } else { ?>
                                                    0
                                                <?php } ?>
                                            </td>
                                            <td> <?= $value->rekening; ?> (<?= $value->bank; ?>) </td>
                                            <td> <?= $value->keterangan; ?> </td>
                                            <td class="text-canter">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $value->id_gaji; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $value->id_gaji; ?>">
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

    <?php foreach ($daftar_gaji as $gaji) : ?>
        <div class="modal fade" id="ubahModal<?= $gaji->id_gaji; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Penggajian Karyawan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('gaji/ubah/' . $gaji->id_gaji) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                            <input type="number" name="id_karyawan" id="id_karyawan" class="form-control" value="<?= $gaji->id_karyawan; ?>" hidden>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="mb-3">
                                <label for="potongan">
                                    <h6>Potongan</h6>
                                </label>
                                <input type="number" name="potongan" id="potongan" class="form-control" value="<?= $gaji->potongan; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan">
                                    <h6>Keterangan</h6>
                                </label>
                                <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="3" required><?= $gaji->keterangan; ?></textarea>
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

<?php foreach ($daftar_gaji as $gaji) : ?>
    <div class="modal fade" id="hapusModal<?= $gaji->id_gaji; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Penggajian Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('gaji/hapus/' . $gaji->id_gaji) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                        <input type="hidden" name="_method" value="DELETE">
                        <p>
                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td colspan="2" scope="row">Yakin Penggajian Karyawan Karyawan</td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Tanggal</td>
                                    <td> : <strong><?= date('d F Y', strtotime($gaji->tanggal)) ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="150px">Nama</td>
                                    <td> : <strong><?= $gaji->nama ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="150px">Rekening</td>
                                    <td> : <strong><?= $gaji->rekening ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="150px">Bank</td>
                                    <td> : <strong><?= $gaji->bank ?></strong></td>
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