<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> <?= $title; ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item active"> <?= $title; ?></li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Retrun Data Penjualan
                        </div>

                        <div class="card-body">
                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>
                            <!-- Notifikasi Gagal -->
                            <?php if (session('failed')) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session('failed'); ?>
                                </div>
                            <?php endif; ?>
                            <form action="<?= base_url('retrun/tambah/' . $detail->id_detail) ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="mb-3 col-2">
                                        <label for="id_trans">No Nota</label>
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="text" name="id_trans" id="id_trans" class="form-control" value="<?= $detail->id_trans; ?>" disabled>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="penerima">Pelanggan</label>
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="text" name="penerima" id="penerima" class="form-control" value="<?= $detail->penerima; ?>" disabled>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="nama_produk">Produk</label>
                                        <input type="text" name="nama_produk" id="nama_produk" class="form-control <?= $validation->hasError('nama_produk') ? 'is-invalid' : null ?>" value="<?= $detail->nama_produk; ?>" disabled>
                                        <?php if ($validation->hasError('nama_produk')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('nama_produk'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3 col-1">
                                        <label for="jumlah_kembali">Qty</label>
                                        <input type="number" name="jumlah_kembali" max="<?= $detail->jumlah_produk; ?>" id="jumlah_kembali" class="form-control <?= $validation->hasError('jumlah_kembali') ? 'is-invalid' : null ?>" value="<?= $detail->jumlah_produk; ?>">
                                        <?php if ($validation->hasError('jumlah_kembali')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('jumlah_kembali'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="ganti">ganti Uang</label>
                                        <input type="number" name="ganti" id="ganti" value="0" class="form-control <?= $validation->hasError('ganti') ? 'is-invalid' : null ?>">
                                        <?php if ($validation->hasError('ganti')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('ganti'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" cols="10" rows="1" class="form-control <?= $validation->hasError('keterangan') ? 'is-invalid' : null ?>"></textarea>
                                        <?php if ($validation->hasError('keterangan')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('keterangan'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="justify-content-end d-flex">
                                    <button class="btn btn-primary btn-sm">Retrun</button>
                                    <span>&nbsp;</span>
                                    <a href="<?= base_url('retrun') ?>" class="btn btn-dark btn-sm">Kembali</a>
                                </div>
                            </form>


                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?= $this->endSection()  ?>