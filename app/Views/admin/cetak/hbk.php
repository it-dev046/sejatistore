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
                <h5 class="card-title text-center"><strong>KWITANSI PEMBAYARAN HBK</strong></h5>
                <p class="card-text text-center"> No : <?= $detail->kwitansi; ?></p>
                <div class="row justify-content-evenly">
                    <div class="col-3">
                        <table class="table table-sm table-borderless">
                            <tbody>
                                <tr>
                                    <th scope="row">Pembayaran Kepada</th>
                                </tr>
                                <tr>
                                    <th scope="row">Tempat & Tanggal</th>
                                </tr>
                                <tr>
                                    <th scope="row">Banyaknya Uang</th>
                                </tr>
                                <tr>
                                    <th scope="row">Keterangan</th>
                                </tr>
                                <tr>
                                    <th scope="row">Pengerjaan</th>
                                </tr>
                                <tr>
                                    <th scope="row">No Invoice</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-7">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <th scope="row">:</th>
                                    <td><?= $hbk->tukang; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">:</th>
                                    <td>Samarinda, <?= date('d M Y', strtotime($detail->tanggal)); ?> </td>
                                </tr>
                                <tr>
                                    <th scope="row">:</th>
                                    <td><?= $terbilang_bayar; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">:</th>
                                    <td colspan="2"><?= $detail->keterangan; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">:</th>
                                    <td colspan="2"><?= $hbk->alamat; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">:</th>
                                    <td colspan="2"><?= $hbk->invoice; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-evenly">
                    <div class="col-3">
                        <?php if ($hbk->sisa_hbk == 0) { ?>
                            <table class="table table-sm table-borderless text-center">
                                <tbody>
                                    <tr>
                                        <th scope="row"> &nbsp; </th>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <img src="<?= base_url('cetak/lunas.png') ?>" width="180px" height="74px" alt="...">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th scope="row"> Jumlah Pembayaran </th>
                                    </tr>
                                    <tr>
                                        <td scope="row">
                                            <strong>
                                                <font color="red"><?= number_to_currency($detail->bayar, 'IDR', 'id_ID') ?></font>
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <table class="table table-sm table-borderless text-center">
                                <tbody>
                                    <tr>
                                        <th scope="row"> &nbsp; </th>
                                    </tr>
                                    <tr>
                                        <th scope="row"> Jumlah Pembayaran </th>
                                    </tr>
                                    <tr>
                                        <td scope="row">
                                            <strong>
                                                <font color="red"><?= number_to_currency($detail->bayar, 'IDR', 'id_ID') ?></font>
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> Sisa Pembayaran </th>
                                    </tr>
                                    <tr>
                                        <td scope="row">
                                            <strong>
                                                <font color="red"><?= number_to_currency($hbk->sisa_hbk, 'IDR', 'id_ID') ?></font>
                                            </strong>
                                            <hr>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>
                    <div class="col-4">
                        <table class="table table-sm table-borderless ">
                            <tbody>
                                <tr>
                                    <th class="text-center" scope="row">Admin Keuangan</th>
                                </tr>
                                <tr>
                                    <th scope="row"><img src="<?= base_url('cetak/stampel.png') ?>" width="130px" height="88px" alt="..."><img src="<?= base_url('cetak/ttd2.png') ?>" width="70px" height="70px" alt="..."></th>
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
                        <table class="table table-sm table-borderless text-center">
                            <tbody>
                                <tr>
                                    <th scope="row">Pekerja Lapangan</th>
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
                                    <th scope="row"><?= $hbk->tukang; ?>
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