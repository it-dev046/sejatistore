<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container">
    <?php

    use App\Models\PageModel;

    $this->PageModel = new PageModel();
    $page = $this->PageModel->findAll();
    ?>
    <?php foreach ($page as $value) : ?>
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image text-lg-center">
                                <img src="<?= base_url('foto/page/' . $value->logo) ?>" alt="" width="400px" height="400px">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        <?php if (session()->getFlashdata('success')) { ?>
                                            <div class="alert alert-success">
                                                <?php echo session()->getFlashdata('success'); ?>
                                            </div>
                                        <?php } ?>
                                        <?php if (session()->getFlashdata('error')) { ?>
                                            <div class="alert alert-danger">
                                                <?php echo session()->getFlashdata('error'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?= form_open('login'); ?>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block">Login</button>
                                    <?= form_close(); ?>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('/') ?>">Kembali Ke Beranda</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?= $this->endSection() ?>