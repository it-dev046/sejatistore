<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-1">
            </ol>
            <!-- Content Row -->
            <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        <a href="<?= base_url('laporan/masuk') ?>" class="btn btn-primary btn-sm">
                                            <strong>Pendapatan Hari ini</strong>
                                        </a>
                                    </div>
                                    <?php $pemasukan = $totalpembayaran + $masukharian; ?>
                                    <?php if (empty($pemasukan)) { ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Belum Ada Pemasukan</div>
                                    <?php } else { ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= number_to_currency($pemasukan, 'IDR', 'id_ID',) ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        <a href="<?= base_url('laporan/keluar') ?>" class="btn btn-info btn-sm">
                                            <strong>Pengeluaran Hari ini</strong>
                                        </a>
                                    </div>
                                    <?php if (empty($keluarharian)) { ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Belum Ada Pengeluaran</div>
                                    <?php } else { ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_to_currency($keluarharian, 'IDR', 'id_ID',) ?></div>
                                    <?php } ?>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        <a href="<?= base_url('laporan/masukbulan') ?>" class="btn btn-success btn-sm">
                                            <strong>Masuk Bulan ini</strong>
                                        </a>
                                    </div>
                                    <?php $pemasukanbulan = $totalbayarbulan + $masukbulanan; ?>
                                    <?php if (empty($pemasukanbulan)) { ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Belum Ada Pemasukan</div>
                                    <?php } else { ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_to_currency($pemasukanbulan, 'IDR', 'id_ID',) ?></div>
                                    <?php } ?>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        <a href="<?= base_url('laporan/keluarbulan') ?>" class="btn btn-warning btn-sm">
                                            <strong>Keluar Bulan ini</strong>
                                        </a>
                                    </div>
                                    <?php if (empty($keluarbulanan)) { ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Belum Ada Pengeluaran</div>
                                    <?php } else { ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_to_currency($keluarbulanan, 'IDR', 'id_ID',) ?></div>
                                    <?php } ?>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Pembayaran Faktur
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
                                        <th>No Faktur</th>
                                        <th>Pelanggan</th>
                                        <th>Tanggal</th>
                                        <th>Total Bayar</th>
                                        <th>Sisa Pembayaran</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php $modal1 = 1; ?>
                                    <?php $modal2 = 1; ?>
                                    <?php foreach ($daftar_bayar as $transkasi) : ?>
                                        <!-- html... -->
                                        <?php if ($transkasi['id_trans'] == 0) { ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td> <?= $no++; ?> </td>
                                                <td>
                                                    <?= $transkasi['id_trans']; ?>
                                                </td>
                                                <td> <?= $transkasi['nama_pel']; ?> (<?= $transkasi['nama_katepel']; ?>) </td>
                                                <td>
                                                    <?= date('d M Y', strtotime($transkasi['tanggal_input'])); ?>
                                                </td>
                                                <td>
                                                    <?php if ($transkasi['total'] == $transkasi['sisa']) { ?>
                                                        0
                                                    <?php } elseif (!empty($transkasi['total'])) { ?>
                                                        <?= number_to_currency($transkasi['total'], 'IDR', 'id_ID') ?>
                                                    <?php } else { ?>
                                                        0
                                                    <?php } ?>
                                                </td>
                                                <?php if (empty($transkasi['sisa'])) { ?>
                                                    <td>0</td>
                                                <?php } else { ?>
                                                    <td><?= number_to_currency($transkasi['sisa'], 'IDR', 'id_ID') ?></td>
                                                <?php } ?>
                                                <?php if (empty($transkasi['total'])) { ?>
                                                    <td>Belum Lunas</td>
                                                <?php } elseif (empty($transkasi['sisa'])) {  ?>
                                                    <td>Lunas</td>
                                                <?php } else { ?>
                                                    <td>Belum Lunas</td>
                                                <?php } ?>
                                                <td>
                                                    <a class="btn btn-warning btn-sm" href="<?= base_url('cetak/' . $transkasi['id'] . '/nota') ?>">
                                                        <i class="fas fa-print"></i>
                                                    </a>
                                                    <a class="btn btn-info btn-sm" href="<?= base_url('cetak/' . $transkasi['id'] . '/suratjalan') ?>">
                                                        <i class="fas fa-car"></i>
                                                    </a>
                                                    <a class="btn btn-dark btn-sm" href="<?= base_url('pembayaran/' . $transkasi['id'] . '/preview') ?>">
                                                        <i class="fas fa-list"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" class="text text-center">
                                            Total Sisa Pembayaran Faktur
                                        </th>
                                        <th>
                                            <?php if ($totalsisa > 0) { ?>
                                                <?= number_to_currency($totalsisa, 'IDR', 'id_ID',) ?>
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
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Pembayaran Pemasangan
                </div>
                <div class="card-body">
                    <table id="table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Inv</th>
                                <th>Tanggal</th>
                                <th>Alamat</th>
                                <th>Nama</th>
                                <th>Biaya</th>
                                <th>Sisa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($daftar_pasang as $key => $value) { ?>
                                <!-- html... -->
                                <tr>
                                    <td> <?= $no++; ?> </td>
                                    <td> <?= $value->invoice; ?> </td>
                                    <td> <?= date('d F Y', strtotime($value->tanggal)) ?></td>
                                    <td> <?= $value->alamat; ?> </td>
                                    <td> <?= $value->nama; ?> </td>
                                    <?php if ($value->biaya == 0) { ?>
                                        <td> <?= $value->biaya; ?> </td>
                                    <?php } else { ?>
                                        <td> <?= number_to_currency($value->biaya, 'IDR', 'id_ID',) ?> </td>
                                    <?php } ?>
                                    <?php if ($value->sisa == 0) { ?>
                                        <td> Lunas </td>
                                    <?php } else { ?>
                                        <td> <?= number_to_currency($value->sisa, 'IDR', 'id_ID',) ?> </td>
                                    <?php } ?>
                                    <td>
                                        <a href="<?= base_url('invoice/' . $value->id_pasang . '/preview') ?>" class="btn btn-dark btn-sm">
                                            <i class="fas fa-list"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6" class="text text-center">
                                    Total Sisa Pembayaran Pemasangan
                                </th>
                                <th>
                                    <?php if (empty($jumlahsisapasang)) { ?>
                                        0
                                    <?php } else { ?>
                                        <?= number_to_currency($jumlahsisapasang, 'IDR', 'id_ID',) ?>
                                    <?php } ?>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Pembayaran HBK
                </div>
                <div class="card-body">
                    <table id="table2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No HBK</th>
                                <th>Tim Pekerja</th>
                                <th>Pengerjaan</th>
                                <th>Alamat</th>
                                <th>Pengawas</th>
                                <th>Total HBK</th>
                                <th>Sisa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($daftar_hbk as $key => $value) { ?>
                                <!-- html... -->
                                <tr>
                                    <td> <?= $no++; ?> </td>
                                    <td> <?= $value->no_hbk; ?> </td>
                                    <td> <?= $value->tukang; ?> </td>
                                    <td><?= $value->nama; ?></td>
                                    <td> <?= $value->alamat; ?></td>
                                    <td> <?= $value->pengawas; ?></td>
                                    <?php if ($value->total_hbk == 0) { ?>
                                        <td> <?= $value->total_hbk; ?> </td>
                                    <?php } else { ?>
                                        <td> <?= number_to_currency($value->total_hbk, 'IDR', 'id_ID',) ?> </td>
                                    <?php } ?>
                                    <?php if ($value->sisa_hbk == 0) { ?>
                                        <td> Lunas </td>
                                    <?php } else { ?>
                                        <td> <?= number_to_currency($value->sisa_hbk, 'IDR', 'id_ID',) ?> </td>
                                    <?php } ?>
                                    <td>
                                        <a href="<?= base_url('hbk/' . $value->id_hbk . '/preview') ?>" class="btn btn-dark btn-sm">
                                            <i class="fas fa-list"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="7" class="text text-center">
                                    Total Sisa Pembayaran HBK Pekerja
                                </th>
                                <th>
                                    <?php if (empty($jumlahsisahbk)) { ?>
                                        0
                                    <?php } else { ?>
                                        <?= number_to_currency($jumlahsisahbk, 'IDR', 'id_ID',) ?>
                                    <?php } ?>
                                </th>
                            </tr>
                        </tfoot>
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