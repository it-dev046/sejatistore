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
                            Daftar Detail Laba Rugi
                        </div>

                        <div class="card-body">
                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>
                            <form action="<?= base_url('kas/labarugi/tambah') ?>" method="post">
                                <?= csrf_field() ?>
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
                                        <label for="keterangan">
                                            <h6>Tanggal Awal</h6>
                                        </label>
                                        <input type="date" name="tgl_awal" id="tgl_awal" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="keterangan">
                                            <h6>Tanggal Akhir</h6>
                                        </label>
                                        <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="keterangan">
                                            <h6>Keterangan</h6>
                                        </label>
                                        <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="Keterangan">
                                            <h6>Jenis Kas</h6>
                                        </label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis" id="inlineRadio1" value="1">
                                            <label class="form-check-label" for="inlineRadio1">Pandapatan</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis" id="inlineRadio2" value="2">
                                            <label class="form-check-label" for="inlineRadio2">Pengeluaran</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-1">
                                        <label for="keterangan">
                                            <h6> </h6>
                                        </label><br>
                                        <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                                    </div>
                                </div>
                            </form>
                            <form action="<?= base_url('cetak/labarugi') ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="mb-3 col-2">
                                        <label for="id">
                                            <h6>Daftar Kategori</h6>
                                        </label>
                                        <select name="bulan" id="bulan" class="form-control">
                                            <option value="" hidden>--Pilih--</option>
                                            <option value="Januari">Januari</option>
                                            <option value="Februari">Februari</option>
                                            <option value="Maret">Maret</option>
                                            <option value="April">April</option>
                                            <option value="Mei">Mei</option>
                                            <option value="Juni">Juni</option>
                                            <option value="Juli">Juli</option>
                                            <option value="Agustus">Agustus</option>
                                            <option value="September">September</option>
                                            <option value="Oktober">Oktober</option>
                                            <option value="November">November</option>
                                            <option value="Desember">Desember</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="keterangan">
                                            <h6>Tahun</h6>
                                        </label>
                                        <input type="number" name="tahun" id="tahun" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="keterangan">
                                            <h6>Tanggal Terbit</h6>
                                        </label>
                                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="keterangan">
                                            <h6> </h6>
                                        </label><br>
                                        <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-print"></i> Laporan Laba Rugi</button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <table id="table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Saldo</th>
                                        <th>Keterangan</th>
                                        <th>Jenis</th>
                                        <th>Saldo</th>
                                        <th>Daftar Kas</th>
                                        <th>Kategori</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($daftar_labarugi as $value) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= $value['kode']; ?> </td>
                                            <td>
                                                <?php if (empty($value['subtotal'])) { ?>
                                                    0
                                                <?php } else { ?>
                                                    <?= number_to_currency($value['subtotal'], 'IDR', 'id_ID',) ?>
                                                <?php } ?>
                                            </td>
                                            <td> <?= $value['keterangan']; ?> </td>
                                            <td>
                                                <?php if ($value['jenis'] == '1') {
                                                    echo "Pendapatan";
                                                } else {
                                                    echo "Pengeluaran";
                                                } ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $value['id'] ?>">
                                                    <i class="fas fa-refresh"></i> Update
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal<?= $value['id'] ?>">
                                                    <i class="fas fa-list"></i> Detail
                                                </button>
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

    <!-- Modal -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Item Laba Rugi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('kas/labarugi/tambah') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="kategori">Jenis Kas</label>
                            <select name="jenis" id="jenis" class="form-control">
                                <option value="1">Pandapatan</option>
                                <option value="2">Pengeluaran</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="slug_kategori">Kategori</label>
                            <select name="id_katekas" id="id_katekas" class="form-control">
                                <option value="" hidden>--Pilih--</option>
                                <!-- panggil data kategori -->
                                <?php foreach ($katekas as $key => $value) { ?>
                                    <option value="<?= $value['id_katekas'] ?>"><?= $value['kode'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control" required>
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

    <?php foreach ($daftar_labarugi as $key => $value) { ?>
        <div class="modal fade" id="ubahModal<?= $value['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Update Saldo Kas </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('kas/labarugi/ubah/' . $value['id']) ?>" method="post">
                        <div class="modal-body">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PUT">
                            <input type="text" name="jenis" id="jenis" value="<?= $value['jenis']; ?>" hidden>
                            <input type="text" name="id_katekas" id="id_katekas" value="<?= $value['id_katekas']; ?>" hidden>
                            <div class="mb-3">
                                <label for="kode">Tanggal Awal</label>
                                <input type="date" name="tgl_awal" id="tgl_awal" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan">Tanggal Akhir</label>
                                <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" required>
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
    <?php } ?>

    <?php foreach ($daftar_labarugi as $key => $value) { ?>
        <div class="modal fade" id="detailModal<?= $value['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Detail Uraian Kas </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('kas/labarugi/preview') ?>" method="post">
                        <div class="modal-body">
                            <?= csrf_field() ?>
                            <input type="text" name="id_katekas" id="id_katekas" value="<?= $value['id_katekas']; ?>" hidden>
                            <div class="mb-3">
                                <label for="kode">Tanggal Awal</label>
                                <input type="date" name="tgl_awal" id="tgl_awal" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan">Tanggal Akhir</label>
                                <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-dark btn-sm">Cek Detail</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php foreach ($daftar_labarugi as $key => $value) { ?>
        <div class="modal fade" id="hapusModal<?= $value['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Kas Harian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('kas/labarugi/hapus/' . $value['id']) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <p>
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <tr>
                                        <td colspan="2" scope="row">Yakin Data Kas Harian</td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="100px">Jenis</td>
                                        <td> : <strong><?= $value['jenis']; ?></strong></td>
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
                                        <td scope="row" width="100px">subtotal</td>
                                        <td> : <strong><?= number_to_currency($value['subtotal'], 'IDR', 'id_ID',) ?></strong></td>
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