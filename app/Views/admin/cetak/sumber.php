<?php

date_default_timezone_set("Asia/Manila");

use App\Models\KasModel;

$this->KasModel = new KasModel();

?>
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
                <h5 class="card-title text-center"><strong>LAPORAN SUMBER KAS HARIAN </strong></h5>
                <p class="card-text text-center"><strong> Periode <?= date('d F Y', strtotime($tgl)) ?> </strong></p>
                <div class="row justify-content-evenly">
                    <?php foreach ($daftar_sumber as $key => $sumber) { ?>
                        <div class="col-5">
                            <h4 class="card-title">
                                <font color="red"><strong><?= $sumber['keterangan'] ?> (<?= $sumber['kode'] ?>)</strong></font>
                            </h4>
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    <?php foreach ($detail_kas as $key => $value) { ?>
                                        <?php if ($value['id_sumber'] == $sumber['id_sumber']) { ?>
                                            <tr>
                                                <th scope="row"> <i class="fas fa-check-square"></i> <?= $value['uraian'] ?> ( <?= $value['nama'] ?> )</th>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                    <tr>
                                        <th scope="row"><strong>SUBTOTAL</strong></th>
                                    </tr>
                                    <tr>
                                        <th scope="row"><strong>SALDO AWAL</strong></th>
                                    </tr>
                                    <tr>
                                        <th scope="row"><strong>TOTAL SALDO</strong></th>
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
                                    <?php foreach ($detail_kas as $key => $value) { ?>
                                        <?php if ($value['id_sumber'] == $sumber['id_sumber']) { ?>
                                            <tr>
                                                <th scope="row">:</th>
                                                <?php if (!empty($value['debet'])) { ?>
                                                    <td class="text text-center"><?= number_to_currency($value['debet'], 'IDR', 'id_ID',) ?></td>
                                                <?php } else { ?>
                                                    <td class="text text-center">(<?= number_to_currency($value['kredit'], 'IDR', 'id_ID',) ?>)</td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                    <tr>
                                        <th scope="row">:</th>
                                        <td>&nbsp;</td>
                                        <td class="text text-center">
                                            <strong>
                                                <?php
                                                $total = $this->KasModel
                                                    ->where('id_sumber', $sumber['id_sumber'])
                                                    ->where('DATE(tanggal) =', $tgl)
                                                    ->select('SUM(debet) as debet, SUM(kredit) as kredit')
                                                    ->first();
                                                $subtotal = $total['debet'] - $total['kredit'];
                                                if (empty($subtotal)) { ?>
                                                    Rp 0
                                                <?php } elseif ($subtotal < 0) {
                                                    $nilai = $subtotal * (-1); ?>
                                                    (<?= number_to_currency($nilai, 'IDR', 'id_ID',) ?>)
                                                <?php } else { ?>
                                                    <?= number_to_currency($subtotal, 'IDR', 'id_ID',) ?>
                                                <?php } ?>
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">:</th>
                                        <td>&nbsp;</td>
                                        <td class="text text-center">
                                            <strong>
                                                <?php
                                                $total_all = $this->KasModel
                                                    ->where('id_sumber', $sumber['id_sumber'])
                                                    ->select('SUM(debet) as debet, SUM(kredit) as kredit')
                                                    ->first();
                                                $total_sekarang = $total_all['debet'] - $total_all['kredit'];
                                                $saldo_awal = $sumber['saldo'] - $total_sekarang;

                                                $total_sebelum = $this->KasModel
                                                    ->where('id_sumber', $sumber['id_sumber'])
                                                    ->where('DATE(tanggal) <', $tgl)
                                                    ->select('SUM(debet) as debet, SUM(kredit) as kredit')
                                                    ->first();
                                                $saldo_kemarin = $saldo_awal + ($total_sebelum['debet'] - $total_sebelum['kredit']);
                                                if (empty($saldo_kemarin)) { ?>
                                                    Rp 0
                                                <?php } elseif ($saldo_kemarin < 0) {
                                                    $nilai = $saldo_kemarin * (-1); ?>
                                                    (<?= number_to_currency($nilai, 'IDR', 'id_ID',) ?>)
                                                <?php } else { ?>
                                                    <?= number_to_currency($saldo_kemarin, 'IDR', 'id_ID',) ?>
                                                <?php } ?>
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">:</th>
                                        <td>&nbsp;</td>
                                        <td class="text text-center">
                                            <strong>
                                                <font color="red">
                                                    <?php
                                                    $saldo = $saldo_kemarin + $subtotal;
                                                    if (empty($saldo)) { ?>
                                                        Rp 0
                                                    <?php } elseif ($saldo < 0) {
                                                        $nilai = $saldo * (-1); ?>
                                                        (<?= number_to_currency($nilai, 'IDR', 'id_ID',) ?>)
                                                    <?php } else { ?>
                                                        <?= number_to_currency($saldo, 'IDR', 'id_ID',) ?>
                                                    <?php } ?>
                                                </font>
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
                <div class="row justify-content-evenly">
                    <div class="col-3">
                        <table class="table table-sm table-borderless text-left">
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
                                    <th scope="row">Samarinda, <?= date('d F Y', strtotime($tgl)) ?></th>
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