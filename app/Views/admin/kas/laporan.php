<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> <?= $title; ?> </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard-admin') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item"><a href=" <?= base_url('sumber') ?> ">Sumber Kas</a></li>
                <li class="breadcrumb-item active"> <?= $title; ?> <?= date('d M Y', strtotime($tanggal)); ?> </li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Kas <?= date('d M Y', strtotime($tanggal)); ?>
                        </div>
                        <div class="card-body">
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
                                        <th>Tanggal</th>
                                        <th>Kode</th>
                                        <th>Penanggung Jawab</th>
                                        <th>Uraian</th>
                                        <th>Debet</th>
                                        <th>Kredit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($daftar_kas as $key => $value) { ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= date('d M Y', strtotime($value['tanggal'])); ?></td>
                                            <td> <?= $value['kode'] ?> </td>
                                            <td> <?= $value['nama'] ?> </td>
                                            <td> <?= $value['uraian'] ?> </td>
                                            <td>
                                                <?= number_to_currency($value['debet'], 'IDR', 'id_ID',) ?>
                                            </td>
                                            <td>
                                                <?= number_to_currency($value['kredit'], 'IDR', 'id_ID',) ?>
                                            </td>
                                        </tr>
                                    <?php }  ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Kas <?= $sumber['kode']; ?></th>
                                        <th><?= $sumber['keterangan']; ?></th>
                                        <th>
                                            Saldo Pertanggal </th>
                                        <th>
                                            <?php if ($totalsaldo > 0) { ?>
                                                <?= number_to_currency($totalsaldo, 'IDR', 'id_ID',) ?>
                                            <?php } else { ?>
                                                Rp 0
                                            <?php } ?>
                                        </th>
                                        <th>Total</th>
                                        <th>
                                            <?php if ($totaldebet > 0) { ?>
                                                <?= number_to_currency($totaldebet, 'IDR', 'id_ID',) ?>
                                            <?php } else { ?>
                                                Rp 0
                                            <?php } ?>
                                        </th>
                                        <th>
                                            <?php if ($totalkredit > 0) { ?>
                                                <?= number_to_currency($totalkredit, 'IDR', 'id_ID',) ?>
                                            <?php } else { ?>
                                                Rp 0
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
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Sub Kategori Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('kas/tambah') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="number" name="id_sumber" id="id_sumber" class="form-control" value="<?= $sumber['id_sumber'] ?>" hidden>
                        <input type="number" name="saldo" id="saldo" class="form-control" value="<?= $sumber['saldo'] ?>" hidden>
                        <div class="mb-3">
                            <label for="tanggal">Tanggal</label>
                            <input type="text" name="tanggal" id="tgl_pembuatan" class="form-control" required>
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
                            <label for="nama">Penaggung Jawab</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="uraian">Uraian</label>
                            <input type="text" name="uraian" id="uraian" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="Keterangan">Keterangan</label>
                            <select name="pilihan" id="pilihan" class="form-control">
                                <option value="1">Debet</option>
                                <option value="2">Kredit</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nilai">Nominal</label>
                            <input type="number" name="nilai" id="nilai" class="form-control" required>
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