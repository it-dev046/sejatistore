<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> <?= $title; ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard-admin') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item active"> <?= $title; ?></li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Pembayaran HBK Bulan ini
                </div>
                <div class="card-body">
                    <table id="table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Invoice</th>
                                <th>Tanggal</th>
                                <th>Tim Pekerja</th>
                                <th>Pengerjaan</th>
                                <th>Bayar HBK</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($daftar_hbk as $key => $value) { ?>
                                <!-- html... -->
                                <tr>
                                    <td> <?= $no++; ?> </td>
                                    <td> <?= $value->invoice; ?> </td>
                                    <td> <?= date('d M Y', strtotime($value->tanggal)); ?></td>
                                    <td> <?= $value->tukang; ?> </td>
                                    <td> <?= $value->nama; ?> </td>
                                    <?php if ($value->bayar == 0) { ?>
                                        <td> <?= $value->bayar; ?> </td>
                                    <?php } else { ?>
                                        <td> <?= number_to_currency($value->bayar, 'IDR', 'id_ID',) ?> </td>
                                    <?php } ?>
                                    <td> <?= $value->keterangan; ?> </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5" class="text text-center">
                                    Total Pengeluaran Bulan ini
                                </th>
                                <th>
                                    <?php if (empty($keluarbulanan)) { ?>
                                        0
                                    <?php } else { ?>
                                        <?= number_to_currency($keluarbulanan, 'IDR', 'id_ID',) ?>
                                    <?php } ?>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
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