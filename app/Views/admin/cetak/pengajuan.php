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
                <h6 class="card-title text-center"><strong>PENGAJUAN ANGGARAN BIAYA</strong></h6>
                <p class="card-text text-center"></p>
                <div class="row justify-content-evenly">
                    <div class="col-5">
                        <p>
                            Kepada Yth.
                            <br>
                            <strong><?= $survei->pelanggan; ?></strong>
                            <br>
                            di -
                            <br>
                            <strong><?= $survei->alamat; ?></strong>
                        </p>
                    </div>
                    <div class="col-5 text-end">
                        <p>Samarinda, <?= date('d F Y', strtotime($survei->tanggal)); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <table class="table table-bordered table-sm">
                    <thead class="thead-dark">
                        <tr class="table-primary">
                            <th width="50px" scope="col" class="text-center">#</th>
                            <th width="500px" scope="col" class="text-center">Uraian Pekerjaan</th>
                            <th width="300px" scope="col" class="text-center">Volume</th>
                            <th width="200px" scope="col" class="text-center">Harga Satuan</th>
                            <th width="200px" scope="col" class="text-center">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($daftar_uraian as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $value->nama ?> ( <?= $value->nama_sub ?> )</td>
                                <td class="text-center"><?= $value->volume ?> <?= $value->ukuran ?></td>
                                <?php if ($value->harga == 0) { ?>
                                    <td class="text-end"> <?= $value->harga; ?> </td>
                                <?php } else { ?>
                                    <td class="text-end"><?= number_to_currency($value->harga, 'IDR', 'id_ID') ?></td>
                                <?php } ?>
                                <?php if ($value->biaya == 0) { ?>
                                    <td class="text-end"> <?= $value->biaya; ?> </td>
                                <?php } else { ?>
                                    <td class="text-end"><?= number_to_currency($value->biaya, 'IDR', 'id_ID') ?></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td width="20px"></td>
                            <td class="text-center" colspan="3" width="200px"><strong>Total Biaya</strong></td>
                            <?php if ($jumlahterbiaya == 0) { ?>
                                <td class="text-end"> <?= $jumlahterbiaya; ?> </td>
                            <?php } else { ?>
                                <td class="text-end" style="background-color:yellow"><strong><?= number_to_currency($jumlahterbiaya, 'IDR', 'id_ID') ?></strong></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td width="20px"></td>
                            <td class="text-center" colspan="3" width="200px"><strong>Total Deal</strong></td>
                            <?php if ($survei->biaya == 0) { ?>
                                <td class="text-end"> <?= $survei->biaya; ?> </td>
                            <?php } else { ?>
                                <td class="text-end" style="background-color:yellow"><Strong><?= number_to_currency($survei->biaya, 'IDR', 'id_ID') ?></Strong></td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-borderless table-sm">
                    <tbody>
                        <tr>
                            <td width="200px" class="text-center">
                                <strong>Terbilang : </strong>
                            </td>
                            <td>
                                <cite> <strong><?= $terbilang_biaya; ?> Rupiah</strong> </cite>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-10 offset-md-1">
                <div class="row justify-content-evenly">
                    <div class="col-11">
                        Pembayaran dapat ditransfer ke rekening kami :
                        <br>
                        <table cellpadding="1">
                            <tbody>
                                <tr>
                                    <th scope="row" width="20px">1.</th>
                                    <td width="80px"><strong>BCA</strong></td>
                                    <td width="200px"><strong>254-322-3344</strong></td>
                                    <td width="350px"><strong>PT. Anugerah Sejati Nusantara</strong></td>
                                </tr>
                                <tr>
                                    <th scope="row" width="10px">2.</th>
                                    <td width="10px"><strong>Mandiri</strong></td>
                                    <td><strong>148-001-774-0237</strong></td>
                                    <td><strong>PT. Anugerah Sejati Nusantara</strong></td>
                                </tr>
                                <tr>
                                    <th scope="row" width="10px">3.</th>
                                    <td width="10px"><strong>BRI</td>
                                    <td><strong>0448-01-000-570-308</td>
                                    <td><strong>PT. Anugerah Sejati Nusantara</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        Demikian hal ini kami sampaikan, atas perhatian dan kerjasamanya diucapkan terima kasih
                    </div>
                </div>
                <div class="row justify-content-evenly mt-1">
                    <div class="col-4"></div>
                    <div class="col-1"></div>
                    <div class="col-5">
                        <table class="table table-sm table-borderless text-center">
                            <tbody>
                                <tr>
                                    <th scope="row">Hormat Kami, </th>
                                </tr>
                                <tr>
                                    <th scope="row">PT ANUGERAH SEJATI NUSANTARA</th>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <img src="<?= base_url('cetak/ttd_bos.png') ?>" width="250px" height="80px" class="rounded float-left mt-2" alt="...">
                                    </th>
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