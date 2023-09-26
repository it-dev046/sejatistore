<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> <?= $title; ?> </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard-admin') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item"><a href=" <?= base_url('kas/sumber/uang') ?> ">Sumber Uang Cash</a></li>
                <li class="breadcrumb-item active"> <?= $title; ?> </li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Uang Kas
                        </div>

                        <div class="card-body">
                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>
                            <form action="<?= base_url('kas/uang/tambah') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="number" name="id_sumber" id="id_sumber" class="form-control" value="<?= $sumber['id_sumber'] ?>" hidden>
                                <div class="row">
                                    <div class="mb-3 col-2">
                                        <label for="nilai">
                                            <h6>Nilai Uang</h6>
                                        </label>
                                        <input type="text" name="nilai" id="nilai" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="jumlah">
                                            <h6>Jumlah</h6>
                                        </label>
                                        <input type="text" name="jumlah" id="jumlah" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="Keterangan">
                                            <h6>Jenis</h6>
                                        </label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis" id="inlineRadio1" value="Kertas">
                                            <label class="form-check-label" for="inlineRadio1">Kertas</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis" id="inlineRadio2" value="Logam">
                                            <label class="form-check-label" for="inlineRadio2">Logam</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                            </form>
                            <hr>
                            <table id="table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis</th>
                                        <th>Nominal</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($daftar_uang as $uang) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= $uang['jenis']; ?> </td>
                                            <?php if ($uang['nilai'] > 0) { ?>
                                                <td> <?= number_to_currency($uang['nilai'], 'IDR', 'id_ID',) ?> </td>
                                            <?php } else { ?>
                                                <td> 0 </td>
                                            <?php } ?>
                                            <td> <?= $uang['jumlah']; ?> </td>
                                            <?php if ($uang['subtotal'] > 0) { ?>
                                                <td> <?= number_to_currency($uang['subtotal'], 'IDR', 'id_ID',) ?> </td>
                                            <?php } else { ?>
                                                <td> 0 </td>
                                            <?php } ?>
                                            <td>
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $uang['id_uang']; ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $uang['id_uang']; ?>">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Saldo Kas</th>
                                        <th>
                                            <?php if ($saldo > 0) { ?>
                                                <?= number_to_currency($saldo, 'IDR', 'id_ID',) ?>
                                            <?php } else { ?>
                                                0
                                            <?php } ?>
                                        </th>
                                        <th>Selisih</th>
                                        <th>
                                            <?php if ($selisih <> 0) { ?>
                                                <?= number_to_currency($selisih, 'IDR', 'id_ID',) ?>
                                            <?php } else { ?>
                                                0
                                            <?php } ?>
                                        </th>
                                        <th>Total Uang</th>
                                        <th>
                                            <?php if ($total > 0) { ?>
                                                <?= number_to_currency($total, 'IDR', 'id_ID',) ?>
                                            <?php } else { ?>
                                                0
                                            <?php } ?>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <?php foreach ($daftar_uang as $uang) : ?>
        <div class="modal fade" id="ubahModal<?= $uang['id_uang']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Uang Kas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('kas/uang/ubah/' . $uang['id_uang']) ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="Jumlah">Jumlah Uang</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control" value="<?= $uang['jumlah']; ?>" required>
                                <input type="number" name="nilai" id="nilai" class="form-control" value="<?= $uang['nilai']; ?>" hidden>
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

<?php foreach ($daftar_uang as $uang) : ?>
    <div class="modal fade" id="hapusModal<?= $uang['id_uang']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Uang Kas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('kas/uang/hapus/' . $uang['id_uang']) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <p>
                            Yakin Data Uang Kas :<font color="red"> <?= number_to_currency($uang['nilai'], 'IDR', 'id_ID',) ?> </font>, akan dihapus ?
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
        $("#id_select").select2({
            placeholder: "-- Pilih Kategori --",
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