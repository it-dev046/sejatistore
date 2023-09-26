<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="jumbotron text-center" style="height: 500px">
    <h1 class="mt-5">BELAJAR KODING MULAI DARI NOL</h1>
    <p class="lead text-muted">
        Mau buat website bingung mulai dari mana? Yuk kita sama-sama belajar di sini.
    </p>
    <a href="<?php echo base_url('login'); ?>" class="btn btn-outline-primary my-2">Login</a>
    <a href="<?php echo base_url('register'); ?>" class="btn btn-success my-2">Register</a>
</section>

<?= $this->endSection() ?>
