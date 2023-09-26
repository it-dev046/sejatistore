<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $title; ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard-admin') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item"><a href=" <?= base_url('pembayaran') ?> ">Daftar Faktur</a></li>
                <li class="breadcrumb-item active"><?= $title; ?> </li>
            </ol>
            <?php if (session('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session('success'); ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <?php if (empty($bayar['sisa'])) { ?>
                <?php } else { ?>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Tambah Pembayaran</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">

                                <a class="small text-white stretched-link" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal"></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if (empty($bayar['total'])) { ?>
                <?php } else { ?>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body">Batalkan Data Pembayaran</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a type="button" class="small text-white stretched-link" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $faktur->id; ?>"></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Pembayaran Faktur
                </div>
                <div class="card-body">
                    <table id="table" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Total</th>
                                <th>Sisa</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($daftar_detail as $key => $value) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td> <?= date('d M Y', strtotime($value['tanggal'])); ?></td>
                                    <?php if ($value['total'] == 0) { ?>
                                        <td><?= $value['total']; ?></td>
                                    <?php } else { ?>
                                        <td><?= number_to_currency($value['total'], 'IDR', 'id_ID', 2) ?></td>
                                    <?php } ?>
                                    <?php if ($value['sisa'] == 0) { ?>
                                        <td><?= $value['sisa']; ?></td>
                                    <?php } else { ?>
                                        <td>
                                            <font color="red">
                                                <?= number_to_currency($value['sisa'], 'IDR', 'id_ID', 2) ?>
                                            </font>
                                        </td>
                                    <?php } ?>
                                    <td> <?= $value['keterangan']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Detail Faktur
                        </div>
                        <div class="card-body">
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Nama Pelaggan</div>
                                        <?= $faktur->penerima; ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Tanggal Transaksi</div>
                                        <?= date('d F Y', strtotime($faktur->tanggal_input)) ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Alamat</div>
                                        <?= $faktur->alamat; ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Nilai Ongkir</div>
                                        <?php if ($faktur->biaya == 0) { ?>
                                            (Free Ongkir / Ambil Sendiri)
                                        <?php } else { ?>
                                            <?= number_to_currency($faktur->biaya, 'IDR', 'id_ID', 2) ?>
                                        <?php } ?>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Rincian Pembayaran Faktur
                        </div>
                        <div class="card-body">
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Jumlah Terbayar</div>
                                        <?php if ($bayar['total'] == 0) { ?>
                                            Belum Ada Pembayaran
                                        <?php } else { ?>
                                            <?= number_to_currency($bayar['total'], 'IDR', 'id_ID', 2) ?>
                                        <?php } ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Total Transaksi</div>
                                        <?php if ($bayar['total'] == 0) { ?>
                                            Belum Ada Pembayaran
                                        <?php } elseif ($status == 1) {
                                            $nilai = $faktur->total - $faktur->biaya ?>
                                            <?= number_to_currency($faktur->total, 'IDR', 'id_ID', 2) ?> - <?= number_to_currency($faktur->biaya, 'IDR', 'id_ID', 2) ?> (Ongkir) = <?= number_to_currency($nilai, 'IDR', 'id_ID', 2) ?>
                                        <?php } else { ?>
                                            <?= number_to_currency($bayar['total'], 'IDR', 'id_ID', 2) ?>
                                        <?php } ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Sisa Pembayaran </div>
                                        <?php if (!empty($bayar['sisa'])) { ?>
                                            <?= number_to_currency($bayar['sisa'], 'IDR', 'id_ID', 2) ?>
                                        <?php } else { ?>
                                            0
                                        <?php } ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Status</div>
                                        <?php if (empty($bayar['sisa'])) { ?>
                                            <font color="green"><strong>-- Lunas --</strong></font>
                                        <?php } else { ?>
                                            <font color="red"><strong>-- Proses Pembayaran --</strong></font>
                                        <?php } ?>
                                    </div>
                                </li>
                            </ol>
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Pembayaran Faktur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('pembayaran/tambah') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="tanggal">Tanggal</label>
                            <input type="text" name="tanggal" id="tgl_pembuatan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="bayar">Nominal Pembayaran</label>
                            <input type="text" name="id_bayar" id="id_bayar" class="form-control" value="<?= $bayar['id_bayar']; ?>" hidden>
                            <input type="number" max="<?= $bayar['sisa']; ?>" name="bayar" id="bayar" class="form-control" value="<?= $faktur->total; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="bayar">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                        </div>
                        <?php if ($jumlahpembayaran == 0) { ?>
                            <div class="mb-3">
                                <label for="status">Biaya Ongkir </label><br>
                                <input type="text" name="ongkir" id="ongkir" class="form-control" value="<?= $faktur->biaya; ?>" hidden>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Tim Pengantaran</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0">
                                    <label class="form-check-label" for="inlineRadio2">Kantor</label>
                                </div>
                            </div>
                        <?php } else { ?>
                            <input type="text" name="status" id="status" class="form-control" value="0" hidden>
                            <input type="text" name="ongkir" id="ongkir" class="form-control" value="0" hidden>
                        <?php } ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <?php foreach ($daftar_detail as $bayar) : ?>
        <div class="modal fade" id="hapus2Modal<?= $bayar['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Daftar Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('pembayaran/detail/hapus/' . $bayar['id']) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <p>
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <tr>
                                        <td colspan="2" scope="row">Yakin Data pembayaran pembayaran</td>
                                        <input type="text" name="id_bayar" id="id_bayar" class="form-control" value="<?= $bayar['id_bayar']; ?>" hidden>
                                        <input type="number" name="total" id="total" class="form-control" value="<?= $bayar['total']; ?>" hidden>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="100px">Tanggal</td>
                                        <td> : <strong> <?= date('d M Y', strtotime($value['tanggal'])); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="100px">Jumlah</td>
                                        <td> : <strong><?= $bayar['total']; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="100px">Keterangan</td>
                                        <td> : <strong><?= $bayar['keterangan']; ?></strong></td>
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

    <?php endforeach; ?>

    <div class="modal fade" id="hapusModal<?= $faktur->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Batalkan Pembayaran pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="  <?= base_url('pembayaran/hapus/' . $bayar['id_bayar']) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <p>
                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td colspan="2" scope="row">Yakin Data pembayaran pembayaran</td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">penerimaan</td>
                                    <td> : <strong><?= $faktur->penerima; ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Tempat</td>
                                    <td> : <strong><?= $faktur->alamat; ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">No Faktur</td>
                                    <td> : <strong><?= $faktur->id_trans; ?></strong></td>
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
    <?= $this->endSection()  ?>
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
        $(function() {
            $(document).ready(function() {
                $('#tgl_pembuatan').datepicker({
                    format: 'mm/dd/yyyy',
                    todayHighlight: true,

                    language: "id",
                    locale: "id",
                });
            });
        });
    </script>
    <?= $this->endSection() ?>