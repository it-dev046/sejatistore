<?php

date_default_timezone_set("Asia/Manila");

use App\Models\GatukModel;

$this->GatukModel = new GatukModel();

?>
<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> <?= $title; ?> </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard-admin') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item"><a href=" <?= base_url('gatuk') ?> ">Gaji Tukang</a></li>
                <li class="breadcrumb-item active">Laporan <?= date('d M Y', strtotime($tanggal)); ?> </li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Pembayaran Tukang
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
                                        <th>Uraian</th>
                                        <th>Invoice</th>
                                        <th>Nilai</th>
                                        <th>Rekening</th>
                                        <th>Penerima</th>
                                        <th>Pekerjaan</th>
                                        <th>Sisa HBK</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($daftar_tukang as $data) :
                                        $tukang = $data->tukang;
                                    ?>
                                        <!-- html... -->
                                        <?php foreach ($daftar_gatuk as $gatuk) :
                                            $subtotal = $gatuk->nilai - $gatuk->potongan;
                                        ?>
                                            <?php if ($gatuk->tukang == $tukang) {  ?>
                                                <tr>
                                                    <td> <?= $no++; ?> </td>
                                                    <td><?= $gatuk->keterangan; ?></td>
                                                    <td><?= $gatuk->invoice; ?></td>
                                                    <td>
                                                        <?php if (!empty($subtotal)) { ?>
                                                            <?= number_to_currency($subtotal, 'IDR', 'id_ID',) ?>
                                                        <?php } else { ?>
                                                            <?= $subtotal; ?>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?= $gatuk->AN; ?> <br>
                                                        <?= $gatuk->bank; ?> <br>
                                                        <?= $gatuk->rek; ?>
                                                    </td>
                                                    <td><?= $gatuk->usaha; ?></td>
                                                    <td>
                                                        <?= $gatuk->nama; ?> <br>
                                                        <?= $gatuk->alamat; ?>
                                                    </td>
                                                    <td>
                                                        <?php if (!empty($gatuk->sisa_hbk)) { ?>
                                                            <?= number_to_currency($gatuk->sisa_hbk, 'IDR', 'id_ID',) ?>
                                                        <?php } else { ?>
                                                            <?= $gatuk->sisa_hbk; ?>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php endforeach;  ?>
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td></td>
                                            <td class="text text-center">
                                                <strong> Total <?= $data->tukang ?> </strong>
                                            </td>
                                            <td>
                                                <strong>
                                                    <?php
                                                    $totalnilai = $this->GatukModel->totalnilai($tanggal, $tukang);
                                                    $totalpotongan = $this->GatukModel->totalpotongan($tanggal, $tukang);
                                                    $tukangtotal = $totalnilai - $totalpotongan;
                                                    ?>
                                                    <?php if ($tukangtotal > 0) { ?>
                                                        <?= number_to_currency($tukangtotal, 'IDR', 'id_ID',) ?>
                                                    <?php } else { ?>
                                                        Rp 0
                                                    <?php } ?>
                                                </strong>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php endforeach;  ?>
                                    <tr>
                                        <td> <?= $no++; ?> </td>
                                        <td></td>
                                        <td class="text text-center">
                                            <strong> Total Pembayaran </strong>
                                        </td>
                                        <td>
                                            <strong>
                                                <?php if ($jumlahtotal > 0) { ?>
                                                    <?= number_to_currency($jumlahtotal, 'IDR', 'id_ID',) ?>
                                                <?php } else { ?>
                                                    Rp 0
                                                <?php } ?>
                                            </strong>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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