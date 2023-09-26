<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> <?= $title; ?> </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard-admin') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item"><a href=" <?= base_url('sumber') ?> ">Sumber Kas</a></li>
                <li class="breadcrumb-item active"> <?= $title; ?> </li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Data Kas Harian
                        </div>
                        <div class="card-body">
                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>
                            <form action="<?= base_url('kas/tambah') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="number" name="id_sumber" id="id_sumber" class="form-control" value="<?= $sumber['id_sumber'] ?>" hidden>
                                <input type="number" name="saldo" id="saldo" class="form-control" value="<?= $sumber['saldo'] ?>" hidden>
                                <div class="row">
                                    <div class="mb-3 col-2 mt-1">
                                        <label for="id">
                                            <h6>Daftar Kategori</h6>
                                        </label>
                                        <select name="id_katekas" id="id_select" class="form-control">
                                            <option value="" hidden>--Pilih--</option>
                                            <!-- panggil data kategori -->
                                            <?php foreach ($katekas as $key => $value) { ?>
                                                <option value="<?= $value['id_katekas'] ?>"><?= $value['keterangan'] ?> (<?= $value['kode'] ?>)</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="tanggal">
                                            <h6>Tanggal</h6>
                                        </label>
                                        <input type="text" name="tanggal" id="tgl_pembuatan" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="nama">
                                            <h6>Penanggung Jawab</h6>
                                        </label>
                                        <input type="text" name="nama" id="nama" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="uraian">
                                            <h6>Uraian</h6>
                                        </label>
                                        <input type="text" name="uraian" id="uraian" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="nilai">
                                            <h6>Nominal</h6>
                                        </label>
                                        <input type="number" name="nilai" id="nilai" class="form-control" required>
                                    </div>

                                    <div class="mb-3 col-2">
                                        <label for="Keterangan">
                                            <h6>Jenis</h6>
                                        </label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pilihan" id="inlineRadio1" value="1">
                                            <label class="form-check-label" for="inlineRadio1">Debet</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pilihan" id="inlineRadio2" value="2">
                                            <label class="form-check-label" for="inlineRadio2">Kredit</label>
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
                                        <th>Tanggal</th>
                                        <th>Kode</th>
                                        <th>Penanggung Jawab</th>
                                        <th>Uraian</th>
                                        <th>Debet</th>
                                        <th>Kredit</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($daftar_kas as $key => $value) { ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= date('d-m-Y', strtotime($value['tanggal'])); ?></td>
                                            <td> <?= $value['kode'] ?> </td>
                                            <td> <?= $value['nama'] ?> </td>
                                            <td> <?= $value['uraian'] ?> </td>
                                            <td>
                                                <?= number_to_currency($value['debet'], 'IDR', 'id_ID',) ?>
                                            </td>
                                            <td>
                                                <?= number_to_currency($value['kredit'], 'IDR', 'id_ID',) ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $value['id_kas'] ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $value['id_kas'] ?>">
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
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Data Sumber Kas
                        </div>
                        <div class="card-body">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Kode Sumber</div>
                                    <?= $sumber['kode']; ?>
                                </div>
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Keterangan Sumber</div>
                                    <?= $sumber['keterangan']; ?>
                                </div>
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Jumlah Bulan ini </div>
                                    <?= $jumlahbulan; ?> Transaksi
                                </div>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Detail Kas Perbulan
                        </div>
                        <div class="card-body">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Total Debet</div>
                                    <?php if ($jumlahdebet > 0) { ?>
                                        <?= number_to_currency($jumlahdebet, 'IDR', 'id_ID',) ?>
                                    <?php } else { ?>
                                        0
                                    <?php } ?>
                                </div>
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Total Kredit</div>
                                    <?php if ($jumlahkredit > 0) { ?>
                                        <?= number_to_currency($jumlahkredit, 'IDR', 'id_ID',) ?>
                                    <?php } else { ?>
                                        0
                                    <?php } ?>
                                </div>
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Total Saldo</div>
                                    <?php if ($sumber['saldo'] <> 0) { ?>
                                        <?= number_to_currency($sumber['saldo'], 'IDR', 'id_ID',) ?>
                                    <?php } else { ?>
                                        0
                                    <?php } ?>
                                </div>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->

    <?php foreach ($daftar_kas as $key => $value) { ?>
        <div class="modal fade" id="ubahModal<?= $value['id_kas'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Kas Harian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('kas/ubah/' . $value['id_kas']) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="number" name="id_sumber" id="id_sumber" class="form-control" value="<?= $sumber['id_sumber'] ?>" hidden>
                            <input type="number" name="saldo" id="saldo" class="form-control" value="<?= $sumber['saldo'] ?>" hidden>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="tanggal">Tanggal</label>
                                <input type="text" name="tanggal" id="tgl_ubah<?= $value['id_kas'] ?>" class="form-control" value="<?= date('m/d/Y', strtotime($value['tanggal'])); ?>" required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="id_katekas">Kategori</label>
                                <select name="id_katekas" id="id_katekas" class="form-control">
                                    <option value="<?= $value['id_katekas'] ?>" hidden>--<?= $value['kode'] ?>--</option>
                                    <!-- panggil data katekas -->
                                    <?php foreach ($katekas as $key => $kode) { ?>
                                        <option value="<?= $kode['id_katekas'] ?>"><?= $kode['kode'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="nama">Penaggung Jawab</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="<?= $value['nama'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="uraian">uraian</label>
                                <input type="text" name="uraian" id="uraian" class="form-control" value="<?= $value['uraian'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="Keterangan">Keterangan</label>
                                <select name="pilihan" id="pilihan" class="form-control">
                                    <?php if ($value['debet'] > 0) { ?>
                                        <option value="1">--Debet--</option>
                                    <?php } else { ?>
                                        <option value="2">--Kredit--</option>
                                    <?php } ?>
                                    <option value="1">Debet</option>
                                    <option value="2">Kredit</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="nilai">Nominal</label>
                                <?php if ($value['debet'] > 0) { ?>
                                    <input type="number" name="nilai" id="nilai" class="form-control" value="<?= $value['debet'] ?>" required>
                                <?php } else { ?>
                                    <input type="number" name="nilai" id="nilai" class="form-control" value="<?= $value['kredit'] ?>" required>
                                <?php } ?>
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

<?php foreach ($daftar_kas as $key => $value) { ?>
    <div class="modal fade" id="hapusModal<?= $value['id_kas'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Kas Harian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('kas/hapus/' . $value['id_kas']) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="number" name="id_sumber" id="id_sumber" class="form-control" value="<?= $sumber['id_sumber'] ?>" hidden>
                        <input type="number" name="saldo" id="saldo" class="form-control" value="<?= $sumber['saldo'] ?>" hidden>
                        <input type="hidden" name="_method" value="DELETE">
                        <p>
                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td colspan="2" scope="row">Yakin Data Kas Harian</td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Tanggal</td>
                                    <td> : <strong><?= date('d M Y', strtotime($value['tanggal'])); ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Kode</td>
                                    <td> : <strong><?= $value['kode']; ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Nama</td>
                                    <td> : <strong><?= $value['nama']; ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">uraian</td>
                                    <td> : <strong><?= $value['uraian']; ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Nominal</td>
                                    <?php if ($value['debet'] > 0) { ?>
                                        <td> : <strong><?= number_to_currency($value['debet'], 'IDR', 'id_ID',) ?></strong></td>
                                    <?php } else { ?>
                                        <td> : <strong><?= number_to_currency($value['kredit'], 'IDR', 'id_ID',) ?></strong></td>
                                    <?php } ?>
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
    // Fungsi untuk membuat combobox searchable
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
<?php foreach ($daftar_kas as $value) : ?>
    <script type="text/javascript">
        $(function() {
            $(document).ready(function() {
                $('#tgl_ubah<?= $value['id_kas']; ?>').datepicker({
                    format: 'mm/dd/yyyy',
                    todayHighlight: true,

                    language: "id",
                    locale: "id",
                });
            });
        });
    </script>
<?php endforeach; ?>
<?= $this->endSection() ?>