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
                            Daftar Faktur Penjualan
                        </div>

                        <div class="card-body">
                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>
                            <a href="<?= base_url('pembayaran/laporan/') ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-file"></i> Pembayaran Faktur
                            </a>
                            <hr>
                            <table id="table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Faktur</th>
                                        <th>Penerima</th>
                                        <th>Telepon</th>
                                        <th>Total Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php $modal1 = 1; ?>
                                    <?php $modal2 = 1; ?>
                                    <?php foreach ($daftar_transaksi as $transkasi) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= $transkasi->id_trans; ?> </td>
                                            <td> <?= $transkasi->penerima; ?> </td>
                                            <td> <?= $transkasi->telepon; ?> </td>
                                            <td> <?= number_to_currency($transkasi->total, 'IDR', 'id_ID', 2) ?> </td>
                                            <td> <?= date('d F Y', strtotime($transkasi->tanggal_input)); ?> </td>
                                            <td>
                                                <a class="btn btn-warning btn-sm" href="<?= base_url('cetak/' . $transkasi->id . '/nota') ?>">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                                <a class="btn btn-info btn-sm" href="<?= base_url('cetak/' . $transkasi->id . '/suratjalan') ?>">
                                                    <i class="fas fa-car"></i>
                                                </a>
                                                <a class="btn btn-dark btn-sm" href="<?= base_url('pembayaran/' . $transkasi->id . '/preview') ?>">
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