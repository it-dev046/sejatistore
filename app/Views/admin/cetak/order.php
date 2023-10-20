<?= $this->extend('admin/layout/template_stok')  ?>
<?= $this->Section('content');  ?>
<main>
    <div class="container-fluid">
        <div class="row justify-content-md-center mt-4">
            <div class="col col-lg-3">
                <img src="<?= base_url('cetak/logo.png') ?>" width="220px" height="120px" class="rounded float-left mt-4" alt="...">
            </div>
            <div class="col col-lg-4 mt-4">
                <figure class="text-center">
                    <br>
                    <blockquote class="blockquote">
                        <p class="h1">Order Barang ASN</p>
                    </blockquote>
                </figure>
            </div>
            <div class="col col-lg-4 mt-4">
                <figure class="text-end">
                    <br>
                    <blockquote class="blockquote">
                        <p class="h3">PT Anugerah Sejati Nusantara</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        Jl. Sultan Sulaiman Depan Pelita 4 Sambutan Samarinda
                        <br>
                        <cite title="Source Title">Telp. 0811 5567 17 / 0811 5587 17</cite>
                    </figcaption>
                </figure>
            </div>
        </div>
        <div class="row row-col mt-3">
            <table id="table3" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pemesan</th>
                        <th>Penerima</th>
                        <th>Pekerjaan</th>
                        <th>Toko</th>
                        <th>Status</th>
                        <th>Orderan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($daftar_order as $order) : ?>
                        <!-- html... -->
                        <tr>
                            <td> <?= $no++; ?> </td>
                            <td> <?= date('d M Y', strtotime($order->tanggal)); ?></td>
                            <td> <?= $order->pemesan; ?> </td>
                            <td> <?= $order->penerima; ?> </td>
                            <td> <?= $order->kerja; ?> </td>
                            <td> <?= $order->nama; ?> <br> <?= $order->keterangan; ?> </td>
                            <td>
                                <?php if ($order->bukti <> "Belum") { ?>
                                    <a href="<?= base_url('order/nota/gambar/' . $order->id_order) ?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-list-alt"></i>
                                    </a>
                                    <a href="<?= base_url('order/bukti/gambar/' . $order->id_order) ?>" class="btn btn-dark btn-sm">
                                        <i class="fas fa-file"></i>
                                    </a>
                                <?php } elseif ($order->nota <> "Belum") { ?>
                                    <a href="<?= base_url('order/nota/gambar/' . $order->id_order) ?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-list-alt"></i>
                                    </a>
                                <?php } else { ?>
                                    <?= $order->status; ?>
                                <?php } ?>
                            </td>
                            <td>
                                <?php
                                $no2 = 1;
                                foreach ($daftar_uraian as $key => $value) {
                                    if ($value->id_order == $order->id_order) { ?>
                                        <?= $no2++; ?> . <?= $value->nama ?> ( <?= $value->jumlah ?> ) <br>
                                    <?php } ?>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?= $this->endSection()  ?>
<?= $this->Section('script') ?>
<script>
    $(document).ready(function() {
        var table = $('#table3').DataTable({
            buttons: ['copy', 'csv', 'print', 'excel', 'pdf', 'colvis'],
            dom: "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row'<'col-md-5'i><'col-md-7'p>>",
            lengthMenu: [
                [100, -1],
                [100, "All"]
            ]
        });

        table3.buttons().container()
            .appendTo('#table_wrapper .col-md-5:eq(0)');
    });
</script>
<?= $this->endSection() ?>