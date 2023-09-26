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
                <br>
                <div class="row justify-content-evenly">
                    <div class="col-5">
                        <p>
                            Kepada Yth.
                            <br>
                            <strong><?= $hbk->tukang; ?></strong>
                            <br>
                            di -
                            <br>
                            <strong> Samarinda </strong>
                        </p>
                    </div>
                    <div class="col-5 text-end">
                        <p>Samarinda, <?= date('d F Y', strtotime($hbk->tanggal_input)); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-10 offset-md-1">
                <h5 class="card-title text-center"><strong>HARGA BORONGAN KERJA</strong></h5>
                <p class="card-text text-center">
                    <font size="4"><?= $hbk->no_hbk; ?></font>
                </p>
                <div class="row justify-content-evenly">
                    <div class="col-8">
                        Pengerjaan : <strong> <?= $hbk->kerja; ?> </strong>
                        <br>
                        Lokasi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                        <strong> <?= $invoice->alamat; ?> ( <?= $invoice->nama; ?> ) </strong>
                        </p>
                    </div>
                    <div class="col-2 text-end">
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
                                <td><?= $value->uraian ?></td>
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
                            <td class="text-center" colspan="3" width="200px"><strong>Total Pembulatan</strong></td>
                            <?php if ($hbk->total_hbk == 0) { ?>
                                <td class="text-end"> <?= $hbk->total_hbk; ?> </td>
                            <?php } else { ?>
                                <td class="text-end" style="background-color:yellow"><Strong><?= number_to_currency($hbk->total_hbk, 'IDR', 'id_ID') ?></Strong></td>
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
                        Demikianlah harga borongan dari kami. Atas bantuan dan kerjasamanya sebelumnya kami sampaikan banyak terima kasih.
                        <br>
                        <strong>Catatan:</strong>
                        <br>
                        <table cellpadding="1">
                            <tbody>
                                <tr>
                                    <td width="1000px">1. Pengawas akan melakukan pengecakan terhadap pekerjaan yang dilakukan, apabila terdapat</td>
                                </tr>
                                <tr>
                                    <td width="1000px"> &nbsp;&nbsp;&nbsp;&nbsp;kekurangan/ kesalahan pekerja harus memperbaiki pekerjaannya</td>
                                </tr>
                                <tr>
                                    <td width="1000px">2. Pekerjaan selesai wajib ditandatangani pengawas lapangan agar upah kerja bisa direalisasikan.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-evenly">
                    <div class="col-5">
                    </div>
                    <div class="col-5 text-center">
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-evenly mt-1">
            <div class="col-4">
                <table class="table table-sm table-borderless text-center">
                    <tbody>
                        <tr>
                            <th class="text-center" scope="row">&nbsp;</th>
                        </tr>
                        <tr>
                            <th class="text-center" scope="row">Pekerja</th>
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
                            <th class="text-center" scope="row"><?= $hbk->tukang; ?>
                                <hr>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-1"></div>
            <div class="col-5">
                <table class="table table-sm table-borderless text-center">
                    <tbody>
                        <tr>
                            <th scope="row">Hormat Kami, </th>
                        </tr>
                        <tr>
                            <th scope="row">Pengawas Lapangan</th>
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
                            <th scope="row"><?= $hbk->pengawas; ?>
                                <hr>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection()  ?>