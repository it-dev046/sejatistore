<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $title; ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= $title; ?> </li>
            </ol>
            <!-- Notifikasi Berhasil -->
            <?php if (session('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session('success'); ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Password User minimal 8 Karater</h5>
                            <form action="<?= base_url('user/password/ubah') ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="mb-3">
                                    <label for="passlama">Password Lama</label>
                                    <input type="password" name="passlama" id="passlama" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="passbaru">Password Baru</label>
                                    <input type="password" name="passbaru" id="passbaru" class="form-control" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">Ubah Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?= $this->endSection()  ?>