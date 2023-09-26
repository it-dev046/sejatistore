<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Import Data Produk</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= $title; ?> </li>
            </ol>
            <?php if (session('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session('success'); ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pilih File Import</h5>
                            <?= form_open_multipart('import/produk'); ?>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2" name="produk_file" accept=".xlsx, .xls" require>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Upload</button>
                                </div>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Format Pengisian Tabel Import</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" width="15px">Kolom</th>
                                        <th scope="col" width="150px">Nama Kolom</th>
                                        <th scope="col">Intruksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Nama Produk</td>
                                        <td>Harus isi Kode Produk <br>Contoh <strong>(SJ 2001, BK 001, SJP 001, dll)</strong></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Harga Satuan</td>
                                        <td>Harus isi sesuai Harga Jual<br> Penulisan tanpa Rp dan titik <br>Contoh <strong>1 juta = ( 1000000 ) </strong></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Stok Porduk</td>
                                        <td>Harus isi sesuai Sesuai Stok Sekarang <br>Contoh <strong> 10 dus = ( 10 ) </strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="<?= base_url('import/download') ?>" class="btn btn-success">Download Template</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?= $this->endSection()  ?>