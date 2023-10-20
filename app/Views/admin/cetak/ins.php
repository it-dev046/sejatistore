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
                <h5 class="card-title text-center mt-3"><strong>PEMBAYARAN INSENTIF</strong></h5>
                <div class="row justify-content-evenly mt-3">
                    <div class="col-5">
                        <table class="table table-sm table-borderless">
                            <tbody>
                                <tr>
                                    <th scope="row">Pembayaran Kepada</th>
                                </tr>
                                <tr>
                                    <th scope="row">Jabatan</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-5">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <th scope="row">:</th>
                                    <td class="text-start"><?= $ins->nama; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">:</th>
                                    <td colspan="2"><?= $ins->posisi; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-evenly">
                    <div class="col-5">
                        <h4 class="card-title">
                            <font color="red"><strong>Pemasukan</strong></font>
                        </h4>
                        <table class="table table-sm table-borderless">
                            <tbody>
                                <tr>
                                    <th scope="row"> <i class="fas fa-check-square"></i> Operasional</th>
                                </tr>
                                <tr>
                                    <th scope="row"> <i class="fas fa-check-square"></i> Uang Makan</th>
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
                                <tr>
                                    <th scope="row">:</th>
                                    <td colspan="2" class="text-start"><?= number_to_currency($ins->op, 'IDR', 'id_ID',) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">:</th>
                                    <td colspan="2" class="text-start"> <?= number_to_currency($ins->um, 'IDR', 'id_ID',) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-evenly">
                    <div class="col-5">
                        <h4 class="card-title">
                            <font color="red"><strong>Pengeluaran</strong></font>
                        </h4>
                        <table class="table table-sm table-borderless">
                            <tbody>
                                <tr>
                                    <th scope="row"><i class="fas fa-check-square"></i> Potongan Kasbon</th>
                                </tr>
                                <tr>
                                    <th scope="row"><i class="fas fa-check-square"></i> Absensi</th>
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
                                <tr>
                                    <th scope="row">:</th>
                                    <td class="text-start"><?= number_to_currency($ins->potongan, 'IDR', 'id_ID',) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">:</th>
                                    <td class="text-start"><?= number_to_currency($ins->absen, 'IDR', 'id_ID',) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-evenly">
                    <div class="col-5">
                        <table class="table table-sm table-borderless">
                            <tbody>
                                <tr>
                                    <th scope="row"><strong>TOTAL KESELURUHAN</strong></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-5">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <th>:&nbsp;</th>
                                    <td><strong>
                                            <font size="4"><?= number_to_currency($ins->total, 'IDR', 'id_ID',) ?></font>
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
                    <div class="col-4">
                        <table class="table table-sm table-borderless text-center">
                            <tbody>
                                <tr>
                                    <th scope="row">Samarinda, <?= date('d M Y', strtotime($tanggal)); ?></th>
                                </tr>
                                <tr>
                                    <th scope="row">Karyawan</th>
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
                                    <th scope="row"><?= $ins->nama; ?>
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