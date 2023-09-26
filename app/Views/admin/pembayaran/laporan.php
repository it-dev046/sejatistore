<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> <?= $title; ?> </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard-admin') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item"><a href=" <?= base_url('pembayaran') ?> ">Daftar Faktur</a></li>
                <li class="breadcrumb-item active"> <?= $title; ?> </li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Pembayaran Faktur Kasir
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
                                        <th>No Faktur</th>
                                        <th>Pelanggan</th>
                                        <th>Tanggal</th>
                                        <th>Total Bayar</th>
                                        <th>Sisa Pembayaran</th>
                                        <th>Keterangan</th>
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
                                                <?php if (empty($transkasi['sisa'])) { ?>
                                                    <td>
                                                        <?php if (!empty($transkasi['total'])) { ?>
                                                            <?= number_to_currency($transkasi['total'], 'IDR', 'id_ID') ?>
                                                        <?php } else { ?>
                                                            0
                                                        <?php } ?>
                                                    </td>
                                                <?php } else { ?>
                                                    <td>0</td>
                                                <?php } ?>
                                                <?php if (empty($transkasi['sisa'])) { ?>
                                                    <td>0</td>
                                                <?php } else { ?>
                                                    <td><?= number_to_currency($transkasi['sisa'], 'IDR', 'id_ID') ?></td>
                                                <?php } ?>
                                                <?php if (empty($transkasi['sisa'])) { ?>
                                                    <td>Lunas</td>
                                                <?php } else { ?>
                                                    <td>Belum Lunas</td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" class="text text-center">
                                            Total Pembayaran Faktur
                                        </th>
                                        <th>
                                            <?php if ($totalall > 0) { ?>
                                                <?= number_to_currency($totalall, 'IDR', 'id_ID',) ?>
                                            <?php } else { ?>
                                                Rp 0
                                            <?php } ?>
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
        </div>
    </main>
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