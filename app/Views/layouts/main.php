<!DOCTYPE html>
<html lang="en">
<?php

use App\Models\PageModel;

$this->PageModel = new PageModel();
$page = $this->PageModel->findAll();
?>
<?php foreach ($page as $value) : ?>

    <head>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">
        <title><?= $title; ?></title>
        <link rel="shortcut icon" href="<?= base_url('foto/page/' . $value->logo) ?>">
        <link rel="apple-touch-icon" href="<?= base_url('foto/page/' . $value->logo) ?>">
        <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url('foto/page/' . $value->logo) ?>">
        <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url('foto/page/' . $value->logo) ?>">
        <link rel="stylesheet" href="<?= base_url('css') ?>/stackpath.bootstrapcdn.com_bootstrap_4.4.1_css_bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>

    <body class="bg-image" style="background-image: url('<?= base_url('foto/page/' . $value->home_gambar) ?>');">

        <!-- Content -->
        <?= $this->renderSection('content') ?>

        <!-- /.Content -->

        <footer class="text-center text-white mt-5">
            <p><em><small>
                        <?php $nama_usaha = html_entity_decode($value->nama_usaha); ?>
                        <?= $nama_usaha; ?>
                        -
                        <?php $slogan = html_entity_decode($value->slogan); ?>
                        <?= $slogan; ?></em></p>
        </footer>
        <script src="<?= base_url('js') ?>/code.jquery.com_jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="<?= base_url('js') ?>/cdn.jsdelivr.net_npm_popper.js@1.16.0_dist_umd_popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="<?= base_url('js') ?>/stackpath.bootstrapcdn.com_bootstrap_4.4.1_js_bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    </body>
<?php endforeach; ?>

</html>