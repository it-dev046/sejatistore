<?php

date_default_timezone_set("Asia/Manila");

use App\Models\DetailHutangModel;

$this->DetailHutangModel = new DetailHutangModel();

?>
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
                            Daftar Hutang Perusahaan
                        </div>
                        <div class="card-body">

                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>

                            <form action="<?= base_url('hutang/tambah') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                                <div class="row">
                                    <div class="mb-3 col-2">
                                        <label for="nilai">
                                            <h6>Tanggal</h6>
                                        </label>
                                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="nilai">
                                            <h6>Nama Perusahaan</h6>
                                        </label>
                                        <select name="usaha" id="id_select" class="form-control" required>
                                            <option value="" hidden>--Pilih--</option>
                                            <!-- panggil data Sumber -->
                                            <?php foreach ($daftar_rekening as $key => $rekening) { ?>
                                                <option value="<?= $rekening->usaha ?>"><?= $rekening->usaha ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="alamat">
                                            <h6>Alamat</h6>
                                        </label>
                                        <input type="text" name="alamat" id="alamat" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="total">
                                            <h6>Total Hutang</h6>
                                        </label>
                                        <input type="text" name="total" id="total" class="form-control" required>
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
                                        <th>Perusahaan</th>
                                        <th>Alamat</th>
                                        <th>Keterangan</th>
                                        <th>Total</th>
                                        <th>Sisa Hutang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($daftar_hutang as $value) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= date('d M Y', strtotime($value->tanggal)) ?></td>
                                            <td> <?= $value->usaha; ?> </td>
                                            <td> <?= $value->alamat; ?> </td>
                                            <td> <?= $value->keterangan; ?> </td>
                                            <td>
                                                <?= number_to_currency($value->total, 'IDR', 'id_ID',) ?>
                                            </td>
                                            <td>
                                                <?php
                                                $totalbayar = $this->DetailHutangModel->totalbayar($value->id_hutang);
                                                $sisa = $value->total - $totalbayar;
                                                ?>
                                                <?= number_to_currency($sisa, 'IDR', 'id_ID',) ?>
                                            </td>
                                            <td class="text-canter">
                                                <a href="<?= base_url('hutang/uraian/' . $value->id_hutang) ?>" class="btn btn-secondary btn-sm">
                                                    <i class="fas fa-list"></i>
                                                </a>
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $value->id_hutang; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $value->id_hutang; ?>">
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

    <?php foreach ($daftar_hutang as $hutang) : ?>
        <div class="modal fade" id="ubahModal<?= $hutang->id_hutang; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Hutang Perusahaan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('hutang/ubah/' . $hutang->id_hutang) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="mb-3">
                                <label for="nilai">
                                    <h6>Nama Perusahaan</h6>
                                </label>
                                <select name="usaha" id="usaha" class="form-control" required>
                                    <!-- panggil data Sumber -->
                                    <?php foreach ($daftar_rekening as $rekening) : ?>
                                        <option value="<?= $rekening->usaha; ?>" <?= $hutang->usaha == $rekening->usaha ? 'selected' : null ?>>
                                            <?= $rekening->usaha ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="alamat">
                                    <h6>Alamat</h6>
                                </label>
                                <input type="text" name="alamat" id="alamat" class="form-control" value="<?= $hutang->alamat; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="total">
                                    <h6>Total Hutang</h6>
                                </label>
                                <input type="number" name="total" id="total" class="form-control" value="<?= $hutang->total; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan">
                                    <h6>Keterangan</h6>
                                </label>
                                <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="3" required><?= $hutang->keterangan; ?></textarea>
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

<?php foreach ($daftar_hutang as $hutang) : ?>
    <div class="modal fade" id="hapusModal<?= $hutang->id_hutang; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Hutang Perusahaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('hutang/hapus/' . $hutang->id_hutang) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                        <input type="hidden" name="_method" value="DELETE">
                        <p>
                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td colspan="2" scope="row">Yakin Data Hutang Perusahaan</td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Tanggal</td>
                                    <td> : <strong><?= date('d F Y', strtotime($hutang->tanggal)) ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="150px">Perusahaan</td>
                                    <td> : <strong><?= $hutang->usaha ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="150px">Alamat</td>
                                    <td> : <strong><?= $hutang->alamat ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="150px">Keterangan</td>
                                    <td> : <strong><?= $hutang->keterangan ?></strong></td>
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
    // Fungsi untuk membuat combobox searchable
    $(document).ready(function() {
        $("#id_select").select2({
            placeholder: "-- Pilih --",
            allowClear: true,
        });
    });
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