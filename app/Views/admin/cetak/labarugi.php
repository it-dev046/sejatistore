<?= $this->extend('admin/layout/template_stok')  ?>
<?= $this->Section('content');  ?>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="row justify-content-start">
                    <div class="col-4 text-end">
                        <img src="<?= base_url('cetak/logo.png') ?>" width="180px" height="90px" class="rounded float-left mt-3" alt="...">
                    </div>
                    <div class="col-8">
                        <figure class="text-center">
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
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h5 class="card-title text-center"><strong>LAPORAN KEUANGAN</strong></h5>
                <p class="card-text text-center"><strong> Periode <?= $bulan; ?> </strong></p>
                <?php if ($jumlahmasuk > 0) { ?>
                    <div class="row justify-content-evenly">
                        <div class="col-5">
                            <h4 class="card-title">
                                <font color="red"><strong>PENDAPATAN</strong></font>
                            </h4>
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    <?php foreach ($daftar_masuk as $key => $value) { ?>
                                        <tr>
                                            <th scope="row"> <i class="fas fa-check-square"></i> <?= $value['keterangan'] ?></th>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <th scope="row"><strong>TOTAL PENDAPATAN</strong></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-5">
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <th scope="row">&nbsp;</th>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php foreach ($daftar_masuk as $key => $value) { ?>
                                        <tr>
                                            <th scope="row">:</th>
                                            <td><?= number_to_currency($value['subtotal'], 'IDR', 'id_ID',) ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <th scope="row">:</th>
                                        <td>&nbsp;</td>

                                        <?php if ($jumlahmasuk == 0) { ?>
                                            <td><strong>0</strong>
                                            <?php } else { ?>
                                            <td><strong> <?= number_to_currency($jumlahmasuk, 'IDR', 'id_ID',) ?></strong>
                                            <?php } ?>

                                            </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($jumlahkeluar > 0) { ?>
                    <div class="row justify-content-evenly">
                        <div class="col-5">
                            <h4 class="card-title">
                                <font color="red"><strong>BIAYA -BIAYA</strong></font>
                            </h4>
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    <?php foreach ($daftar_keluar as $key => $value) { ?>
                                        <tr>
                                            <th scope="row"><i class="fas fa-check-square"></i> <?= $value['keterangan'] ?></th>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <th scope="row"><strong>TOTAL BIAYA</strong></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-5">
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <th scope="row">&nbsp;</th>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php foreach ($daftar_keluar as $key => $value) { ?>
                                        <tr>
                                            <th scope="row">:</th>
                                            <td><?= number_to_currency($value['subtotal'], 'IDR', 'id_ID',) ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <th scope="row">:</th>
                                        <td>&nbsp;</td>
                                        <td><strong><?= number_to_currency($jumlahkeluar, 'IDR', 'id_ID',) ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>
                <div class="row justify-content-evenly">
                    <div class="col-7">
                        <table class="table table-sm table-borderless">
                            <tbody>
                                <tr>
                                    <th scope="row"><strong>TOTAL KESELURUHAN</strong></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-3">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <th>:&nbsp;</th>
                                    <td><strong>

                                            <?php if ($jumlahmasuk >= $jumlahkeluar) { ?>
                                                <font size="4"><?= number_to_currency($total, 'IDR', 'id_ID',) ?></font>
                                            <?php } else { ?>
                                                <font size="4" color="red">(<?= number_to_currency($total, 'IDR', 'id_ID',) ?>)</font>
                                            <?php } ?>
                                        </strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-evenly">
                    <div class="col-3">
                        <table class="table table-sm table-borderless text-center">
                            <tbody>
                                <tr>
                                    <th class="text-center" scope="row">&nbsp;</th>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">Admin Keuangan</th>
                                </tr>
                                <tr>
                                    <th scope="row">&nbsp;</th>
                                </tr>
                                <tr>
                                    <th scope="row">&nbsp;</th>
                                </tr>
                                <tr>
                                    <th scope="row">&nbsp;</th>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">Ajeng WD
                                        <hr>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-3">
                        <table class="table table-sm table-borderless ">
                            <tbody>
                                <tr>
                                    <th class="text-center" scope="row">&nbsp;</th>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">Direktur</th>
                                </tr>
                                <tr>
                                    <th scope="row">&nbsp;</th>
                                </tr>
                                <tr>
                                    <th scope="row">&nbsp;</th>
                                </tr>
                                <tr>
                                    <th scope="row">&nbsp;</th>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">Nur Kumala Dewi
                                        <hr>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-4">
                        <table class="table table-sm table-borderless text-center">
                            <tbody>
                                <tr>
                                    <th scope="row">Samarinda, <?= $tanggal; ?></th>
                                </tr>
                                <tr>
                                    <th scope="row">Pemilik Usaha</th>
                                </tr>
                                <tr>
                                    <th scope="row">&nbsp;</th>
                                </tr>
                                <tr>
                                    <th scope="row">&nbsp;</th>
                                </tr>
                                <tr>
                                    <th scope="row">&nbsp;</th>
                                </tr>
                                <tr>
                                    <th scope="row">Darmawan Saputro
                                        <hr>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection()  ?>