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
                            Daftar Gaji Tukang
                        </div>
                        <div class="card-body">

                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>

                            <form action="<?= base_url('gatuk/tambah') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                                <div class="row">
                                    <div class="mb-3 col-2">
                                        <label for="nilai">
                                            <h6>Tanggal</h6>
                                        </label>
                                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-7">
                                        <label for="nilai">
                                            <h6>Pilih Invoice</h6>
                                        </label>
                                        <select name="id_hbk" id="id_hbk" class="form-control" required>
                                            <option value="" hidden>--Pilih--</option>
                                            <!-- panggil data Sumber -->
                                            <?php foreach ($daftar_hbk as $key => $hbk) { ?>
                                                <option value="<?= $hbk->id_hbk ?>"><?= $hbk->invoice ?> -- <?= $hbk->nama ?> (<?= $hbk->alamat ?>) -- <?= $hbk->tukang ?> --
                                                    <?= number_to_currency($hbk->sisa_hbk, 'IDR', 'id_ID',) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="nilai">
                                            <h6>Nominal</h6>
                                        </label>
                                        <input type="number" name="nilai" id="nilai" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="rek">
                                            <h6>No Rekeing</h6>
                                        </label>
                                        <input type="text" name="rek" id="rek" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="AN">
                                            <h6>Atas Nama</h6>
                                        </label>
                                        <input type="text" name="AN" id="AN" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="bank">
                                            <h6>Bank</h6>
                                        </label>
                                        <input type="text" name="bank" id="bank" class="form-control" required>
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
                                        <th>Invoice</th>
                                        <th>Penerima</th>
                                        <th>Rekening</th>
                                        <th>Sisa HBK</th>
                                        <th>Pembayaran</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($daftar_gatuk as $value) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= date('d M Y', strtotime($value->tanggal)) ?></td>
                                            <td> <?= $value->invoice; ?> </td>
                                            <td> <?= $value->penerima; ?> </td>
                                            <td> <?= $value->AN; ?> - <?= $value->rek; ?> ( <?= $value->bank; ?> ) </td>
                                            <td> <?= number_to_currency($value->sisa_hbk, 'IDR', 'id_ID',) ?></td>
                                            <td> <?= number_to_currency($value->nilai, 'IDR', 'id_ID',) ?></td>
                                            <td> <?= $value->keterangan; ?> </td>
                                            <td class="text-canter">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $value->id_gatuk; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $value->id_gatuk; ?>">
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

    <?php foreach ($daftar_gatuk as $gatuk) : ?>
        <div class="modal fade" id="ubahModal<?= $gatuk->id_gatuk; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Gaji Tukang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('gatuk/ubah/' . $gatuk->id_gatuk) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="mb-3">
                                <label for="tanggal">
                                    <h6>tanggal</h6>
                                </label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= $gatuk->tanggal; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="nilai">
                                    <h6>Nominal Pembayaran</h6>
                                </label>
                                <input type="number" name="nilai" id="nilai" class="form-control" value="<?= $gatuk->nilai; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="rek">
                                    <h6>No Rekeing</h6>
                                </label>
                                <input type="text" name="rek" id="rek" class="form-control" value="<?= $gatuk->rek; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="AN">
                                    <h6>Atas Nama</h6>
                                </label>
                                <input type="text" name="AN" id="AN" class="form-control" value="<?= $gatuk->AN; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="bank">
                                    <h6>Bank</h6>
                                </label>
                                <input type="text" name="bank" id="bank" class="form-control" value="<?= $gatuk->bank; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan">
                                    <h6>Keterangan</h6>
                                </label>
                                <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="3" required><?= $gatuk->keterangan; ?></textarea>
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

<?php foreach ($daftar_gatuk as $gatuk) : ?>
    <div class="modal fade" id="hapusModal<?= $gatuk->id_gatuk; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Gaji Tukang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('gatuk/hapus/' . $gatuk->id_gatuk) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                        <input type="hidden" name="_method" value="DELETE">
                        <p>
                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td colspan="2" scope="row">Yakin Gaji Tukang</td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Tanggal</td>
                                    <td> : <strong><?= date('d F Y', strtotime($gatuk->tanggal)) ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="150px">Penerima</td>
                                    <td> : <strong><?= $gatuk->penerima ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="150px">Nominal</td>
                                    <td> : <strong><?= number_to_currency($gatuk->nilai, 'IDR', 'id_ID',) ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="150px">Keterangan</td>
                                    <td> : <strong><?= $gatuk->keterangan ?></strong></td>
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