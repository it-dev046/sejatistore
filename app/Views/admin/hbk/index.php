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
                            Daftar Pemasangan
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
                                        <th>No HBK</th>
                                        <th>Tim Lapangan</th>
                                        <th>Pekerjaan</th>
                                        <th>Pemasangan</th>
                                        <th>Pengawas</th>
                                        <th>Total HBK</th>
                                        <th>Aksi</th>
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
                                                <a href="<?= base_url('hbk/' . $hbk->id_hbk . '/preview') ?>" class="btn btn-dark btn-sm">
                                                    <i class="fas fa-list"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                </tr>
                                </thead>
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