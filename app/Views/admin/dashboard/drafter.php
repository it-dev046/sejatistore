<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard Drafter Sejati Store</h1>
            <ol class="breadcrumb mb-1">
            </ol>
            <!-- Content Row -->

            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Survei Lapangan
                        </div>
                        <div class="card-body">
                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>
                            <table id="table3" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Lokasi</th>
                                        <th>Keterangan</th>
                                        <th>Drafter</th>
                                        <th>Pekerja</th>
                                        <th>Sketsa</th>
                                        <th>Pengajuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($daftar_survei as $survei) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= date('d M Y', strtotime($survei->tanggal)); ?></td>
                                            <td> <?= $survei->alamat; ?> <br>
                                                (<strong><?= $survei->pelanggan; ?></strong>)
                                            </td>
                                            <td> <?= $survei->keterangan; ?><br>
                                                (<strong><?= $survei->pengukur; ?></strong>)
                                            </td>
                                            <td> <?= $survei->drafter; ?> </td>
                                            <td>
                                                <?php if (empty($survei->status)) { ?>
                                                    Belum Ada
                                                <?php } else { ?>
                                                    <?= $survei->tukang; ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('survei/sketsa/' . $survei->id_survei) ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-download"></i>
                                                    Unduh
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('survei/uraian/' . $survei->id_survei) ?>" class="btn btn-secondary btn-sm">
                                                    <i class="fas fa-list"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Rekap Pemasangan
                </div>
                <div class="card-body">
                    <table id="table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Invoice</th>
                                <th>Pemasangan</th>
                                <th>Pekerjaan</th>
                                <th>Volume</th>
                                <th>Total</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($daftar_pasang as $pasang) : ?>
                                <!-- html... -->
                                <tr>
                                    <td> <?= $no++; ?> </td>
                                    <td> <?= $pasang->invoice; ?> </td>
                                    <td> <?= $pasang->nama; ?> ( <?= $pasang->alamat; ?> ) </td>
                                    <td> <?= $pasang->kerja; ?> </td>
                                    <td> <?= $pasang->volume; ?> m2</td>
                                    <td> <?= number_to_currency($pasang->biaya, 'IDR', 'id_ID') ?> </td>
                                    <td>
                                        <a href="<?= base_url('rekap/gambar/' . $pasang->id_pasang) ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-download"></i>
                                            Unduh
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('rekap/detail/' . $pasang->id_pasang) ?>" class="btn btn-dark btn-sm">
                                            <i class="fas fa-list"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar HBK Pemasangan
                </div>
                <div class="card-body">
                    <table id="table2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No HBK</th>
                                <th>Tim Lapangan</th>
                                <th>Pekerjaan</th>
                                <th>Pemasangan</th>
                                <th>Pengawas</th>
                                <th>Total HBK</th>
                                <th>Gambar</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($daftar_hbk as $hbk) : ?>
                                <!-- html... -->
                                <tr>
                                    <td> <?= $no++; ?> </td>
                                    <td> <?= $hbk->no_hbk; ?> </td>
                                    <td> <?= $hbk->tukang; ?> </td>
                                    <td> <?= $hbk->kerja; ?> </td>
                                    <td><?= $hbk->nama; ?> - <?= $hbk->alamat; ?> </td>
                                    <td><?= $hbk->pengawas; ?> </td>
                                    <td> <?= number_to_currency($hbk->total_hbk, 'IDR', 'id_ID', 2) ?> </td>
                                    <td>
                                        <?php if (!empty($hbk->gambar)) { ?>
                                            <a href="<?= base_url('hbk/gambar/' . $hbk->id_hbk) ?>" class="btn btn-warning btn-sm">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        <?php } else { ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('hbk/uraian/' . $hbk->id_hbk) ?>" class="btn btn-dark btn-sm">
                                            <i class="fas fa-list"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <?= $this->endSection()  ?>
    <?= $this->Section('script') ?>
    <script>
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

        $(document).ready(function() {
            var table = $('#table2').DataTable({
                buttons: ['copy', 'csv', 'print', 'excel', 'pdf', 'colvis'],
                dom: "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'row'<'col-md-5'i><'col-md-7'p>>",
                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "All"]
                ]
            });

            table2.buttons().container()
                .appendTo('#table_wrapper .col-md-5:eq(0)');
        });

        $(document).ready(function() {
            var table = $('#table3').DataTable({
                buttons: ['copy', 'csv', 'print', 'excel', 'pdf', 'colvis'],
                dom: "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'row'<'col-md-5'i><'col-md-7'p>>",
                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "All"]
                ]
            });

            table3.buttons().container()
                .appendTo('#table_wrapper .col-md-5:eq(0)');
        });
    </script>
    <?= $this->endSection() ?>