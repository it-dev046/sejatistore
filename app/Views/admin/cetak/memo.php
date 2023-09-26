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
                <h3 class="card-title text-center mt-2"><strong>MEMO</strong></h3>
                <p class="card-text text-center"> Samarinda, <?= date('d F Y', strtotime($memo->tanggal)) ?></p>
                <div class="row justify-content-evenly">
                    <div class="col-3">
                        <table class="table table-sm table-borderless">
                            <tbody>
                                <tr>
                                    <th scope="row">Nama Supir</th>
                                </tr>
                                <tr>
                                    <th scope="row">Telepon / WA</th>
                                </tr>
                                <tr>
                                    <th scope="row">No Plat Kendaraan</th>
                                </tr>
                                <tr>
                                    <th scope="row">Pengambilan Barang</th>
                                </tr>
                                <tr>
                                    <th scope="row">Alamat Pengambilan</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-7">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <th>:</th>
                                    <td><?= $memo->nama; ?></td>
                                </tr>
                                <tr>
                                    <th>:</th>
                                    <td><?= $memo->telpon; ?></td>
                                </tr>
                                <tr>
                                    <th>:</th>
                                    <td><?= $memo->nomor; ?></td>
                                </tr>
                                <tr>
                                    <th>:</th>
                                    <td><?= $memo->barang; ?></td>
                                </tr>
                                <tr>
                                    <th>:</th>
                                    <td><?= $memo->alamat; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-evenly">
                    <div class="col-4">
                        <table class="table table-sm table-borderless ">
                        </table>
                    </div>
                    <div class="col-3">
                        <table class="table table-sm table-borderless text-center">
                            <tbody>
                                <tr>
                                    <th class="text-center" scope="row">Owener</th>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <img src="<?= base_url('cetak/ttd_bos.png') ?>" width="210px" height="88px" alt="...">
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">Darmawan Saputro
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