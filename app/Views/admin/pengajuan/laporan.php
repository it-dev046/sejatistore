<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> <?= $title; ?> </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard-admin') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item"><a href=" <?= base_url('pengajuan') ?> ">Daftar Pengajuan Dana</a></li>
                <li class="breadcrumb-item active">Laporan <?= date('d M Y', strtotime($tanggal)); ?> </li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Pengajuan <?= date('d M Y', strtotime($tanggal)); ?>
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
                                        <th>Nama</th>
                                        <th>Rekening</th>
                                        <th>Keterangan</th>
                                        <th>Nonimal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($daftar_pengajuan as $value) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= date('d M Y', strtotime($value->tanggal)) ?></td>
                                            <td> <?= $value->usaha; ?> </td>
                                            <td> <?= $value->AN; ?> <br> (<?= $value->bank; ?>) <br> <?= $value->rek; ?> </td>
                                            <td> <?= $value->keterangan; ?> </td>
                                            <td> <?= number_to_currency($value->nilai, 'IDR', 'id_ID',) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td> <?= $no++; ?> </td>
                                        <td colspan="4" class="text text-center"><strong>Total Pengajuan Dana</strong></td>
                                        <td> <strong><?= number_to_currency($jumlahtotal, 'IDR', 'id_ID',) ?></strong></td>
                                    </tr>
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
                    [100, -1],
                    [100, "All"]
                ]
            });

            table.buttons().container()
                .appendTo('#table_wrapper .col-md-5:eq(0)');
        });
    </script>
    <?= $this->endSection() ?>