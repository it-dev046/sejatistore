<!DOCTYPE HTML>
<html lang="en">
<?php

use App\Models\PageModel;

$this->PageModel = new PageModel();
$page = $this->PageModel->findAll();
?>
<?php foreach ($page as $value) : ?>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php $nama_usaha = html_entity_decode($value->nama_usaha); ?>
      <?= $nama_usaha; ?>">
    <meta name="author" content="Paul">

    <!-- Favicons -->
    <link rel="shortcut icon" href="<?= base_url('foto/page/' . $value->logo) ?>">
    <link rel="apple-touch-icon" href="<?= base_url('foto/page/' . $value->logo) ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url('foto/page/' . $value->logo) ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url('foto/page/' . $value->logo) ?>">

    <title><?php $nama_usaha = html_entity_decode($value->nama_usaha); ?>
      <?= $nama_usaha; ?></title>

    <!-- Fonts -->
    <link href="<?= base_url('asset'); ?>/css/fonts.googleapis.com_css_family.css" rel="stylesheet">
    <link href="<?= base_url('asset'); ?>/css/fonts.googleapis.css" rel="stylesheet">

    <!-- Styles -->
    <link href="<?= base_url('asset'); ?>/css/style.css" rel="stylesheet" media="screen">
    <link href="<?= base_url('asset'); ?>/css/dark.css" rel="stylesheet" media="screen">
  </head>

  <body class="body-fullpage">
    <?= $this->include('beranda/layout/navbar'); ?>
    <!-- Footer -->
    <div class="copy-bottom white boxed">© <?php $nama_usaha = html_entity_decode($value->nama_usaha); ?>
      <?= $nama_usaha; ?> 2023.</div>
    <!-- Content Page Piling -->
    <div class="pagepiling">
      <?= $this->RenderSection('content'); ?>
    </div>
    <!-- jQuery -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="<?= base_url('asset'); ?>/js/jquery.min.js"></script>
    <script src="<?= base_url('asset'); ?>/js/bootstrap.min.js"></script>
    <script src="<?= base_url('asset'); ?>/js/smoothscroll.js"></script>
    <script src="<?= base_url('asset'); ?>/js/jquery.pagepiling.min.js"></script>
    <script src="<?= base_url('asset'); ?>/js/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url('asset'); ?>/js/owl.carousel.min.js"></script>
    <script src="<?= base_url('asset'); ?>/js/gmap.js"></script>
    <!-- Scripts -->
    <script src="<?= base_url('asset'); ?>/js/scripts.js"></script>
  </body>
<?php endforeach; ?>

</html>