<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> <?= $title; ?> </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard-admin') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item"><a href=" <?= base_url('sumber') ?> ">Daftar Sumber</a></li>
                <li class="breadcrumb-item active"> <?= $title; ?> </li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Sumber Detail Kas
                        </div>

                        <div class="card-body">
                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>
                            <form action="<?= base_url('sumber/detail/tambah') ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="mb-3 col-3 mt-1">
                                        <label for="id">
                                            <h6>Daftar Sumber Kas</h6>
                                        </label>
                                        <select name="id_sumber" id="id_select" class="form-control">
                                            <option value="" hidden>--Pilih--</option>
                                            <!-- panggil data Sumber -->
                                            <?php foreach ($sumber as $key => $value) { ?>
                                                <option value="<?= $value['id_sumber'] ?>"><?= $value['keterangan'] ?> (<?= $value['kode'] ?>)</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-2 mt-2">
                                        <label for="keterangan">
                                            <h6> </h6>
                                        </label><br>
                                        <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                                    </div>
                                </div>
                            </form>
                            <form action="<?= base_url('cetak/sumber') ?>" method="post">
                                <div class="row">
                                    <div class="mb-3 col-2">
                                        <label for="tgl_awal">
                                            <h6>Tanggal</h6>
                                        </label>
                                        <input type="text" name="tanggal" id="tgl_awal" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2 mt-2">
                                        <label for="keterangan">
                                            <h6> </h6>
                                        </label><br>
                                        <button type="submit" class="btn btn-warning btn-sm"><strong>Laporan Detail Sumber</strong></button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <table id="table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Keterangan</th>
                                        <th>Saldo</th>
                                        <th>Update</th>
                                        <th>Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($daftar_sumber as $value) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= $value['kode']; ?> </td>
                                            <td> <?= $value['keterangan']; ?> </td>
                                            <td>
                                                <?php if (empty($value['saldo'])) { ?>
                                                    0
                                                <?php } else { ?>
                                                    <?= number_to_currency($value['saldo'], 'IDR', 'id_ID',) ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <form action=" <?= base_url('sumber/detail/ubah/' . $value['id']) ?>" method="post">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <input type="text" name="id_sumber" id="id_sumber" value="<?= $value['id_sumber']; ?>" hidden>
                                                    <button type="submit" class="btn btn-success btn-sm"> <i class="fas fa-refresh"></i> Saldo</button>
                                                </form>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $value['id'] ?>">
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

    <?php foreach ($daftar_sumber as $key => $value) { ?>
        <div class="modal fade" id="hapusModal<?= $value['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Detail Sumber</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('sumber/detail/hapus/' . $value['id']) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <p>
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <tr>
                                        <td colspan="2" scope="row">Yakin Data Detail Sumber</td>
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
                                        <td scope="row" width="100px">Saldo</td>
                                        <td> : <strong><?= number_to_currency($value['saldo'], 'IDR', 'id_ID',) ?></strong></td>
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
    <?php } ?>
    <?= $this->endSection() ?>
    <?= $this->Section('script') ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#id_select").select2({
                placeholder: "-- Pilih Sumber --",
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

        $(function() {
            $(document).ready(function() {
                $('#tgl_awal').datepicker({
                    format: 'mm/dd/yyyy',
                    todayHighlight: true,

                    language: "id",
                    locale: "id",
                });
            });
        });

        $(function() {
            $(document).ready(function() {
                $('#tgl_akhir').datepicker({
                    format: 'mm/dd/yyyy',
                    todayHighlight: true,

                    language: "id",
                    locale: "id",
                });
            });
        });
    </script>
    <?= $this->endSection() ?>