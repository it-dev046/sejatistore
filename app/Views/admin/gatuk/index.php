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

                            <!-- Notifikasi Berhasil -->
                            <?php if (session('error')) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session('error'); ?>
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
                                            <h6>Rancangan Pembayaran</h6>
                                        </label>
                                        <select name="id_rpt" id="id_select" class="form-control" required>
                                            <option value="" hidden>--Pilih--</option>
                                            <!-- panggil data Sumber -->
                                            <?php foreach ($daftar_rpt as $key => $daftar_rpt) { ?>
                                                <option value="<?= $daftar_rpt->id_rpt ?>"><?= $daftar_rpt->invoice ?> -- <?= $daftar_rpt->nama ?> (<?= $daftar_rpt->alamat ?>) -- <?= $daftar_rpt->tukang ?> --
                                                    <?= number_to_currency($daftar_rpt->sisa_hbk, 'IDR', 'id_ID',) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="nilai">
                                            <h6>Pembayaran</h6>
                                        </label>
                                        <input type="number" name="nilai" id="nilai" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-5">
                                        <label for="nama">
                                            <h6>Nama & Nilai Kasbon</h6>
                                        </label>
                                        <select name="id_rekening" id="id_select2" class="form-control" required>
                                            <option value="" hidden>--Pilih--</option>
                                            <!-- panggil data Sumber -->
                                            <?php foreach ($daftar_rekening as $key => $rekening) { ?>
                                                <option value="<?= $rekening->id_rekening ?>"><?= $rekening->usaha ?> -- <?= $rekening->bank ?>
                                                    <?php if (!empty($rekening->sisa)) { ?>(
                                                    <?= number_to_currency($rekening->sisa, 'IDR', 'id_ID',) ?>
                                                    )
                                                <?php } ?>
                                                </option>
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
                            <form action="<?= base_url('gatuk/laporan/preview') ?>" method="post">
                                <div class="row">
                                    <div class="mb-3 col-2">
                                        <label for="tgl_awal">
                                            <h6>Tanggal Laporan</h6>
                                        </label>
                                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2 mt-2">
                                        <label for="keterangan">
                                            <h6> </h6>
                                        </label><br>
                                        <button type="submit" class="btn btn-warning btn-sm"><strong>Cari</strong></button>
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
                                        <th>Pekerjaan</th>
                                        <th>Penerima</th>
                                        <th>Pembayaran</th>
                                        <th>Sisa</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($daftar_gatuk as $value) :
                                        $bayar = $value->nilai - $value->potongan;
                                    ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= date('d M Y', strtotime($value->tanggal)) ?></td>
                                            <td> <?= $value->invoice; ?> </td>
                                            <td>
                                                <?= $value->tukang; ?> <br>
                                                (<?= $value->nama; ?> - <?= $value->alamat; ?>) <br>
                                            </td>
                                            <td> <?= $value->usaha; ?> <br> <?= $value->AN; ?> <br> <?= $value->rek; ?> <br> ( <?= $value->bank; ?> ) </td>
                                            <td>
                                                <?php if (!empty($bayar)) { ?>
                                                    <?= number_to_currency($bayar, 'IDR', 'id_ID') ?>
                                                <?php } else { ?>
                                                    0
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($value->sisa_hbk)) { ?>
                                                    <?= number_to_currency($value->sisa_hbk, 'IDR', 'id_ID') ?>
                                                <?php } else { ?>
                                                    0
                                                <?php } ?>
                                            </td>
                                            <td> <?= $value->keterangan; ?> </td>
                                            <td>
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
                                        <td scope="row" width="150px">Nama</td>
                                        <td> : <strong><?= $gatuk->usaha ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="150px">Nominal</td>
                                        <td> : <strong>
                                                <?php if (!empty($value->nilai)) { ?>
                                                    (<?= number_to_currency($value->nilai, 'IDR', 'id_ID', 2) ?>)
                                                <?php } else { ?>
                                                    0
                                                <?php } ?>
                                            </strong></td>
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
        // Fungsi untuk membuat combobox searchable
        $(document).ready(function() {
            $("#id_select2").select2({
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