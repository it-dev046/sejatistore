<!DOCTYPE html>
<html lang="en">
<?php

use App\Models\PageModel;

$this->PageModel = new PageModel();
$page = $this->PageModel->findAll();
?>
<?php foreach ($page as $value) : ?>

  <?php
  date_default_timezone_set("Asia/Manila");
  ?>

  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title> <?= $title; ?> </title>
    <link rel="shortcut icon" href="<?= base_url('foto/page/' . $value->logo) ?>">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('asset-admin'); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('asset-admin'); ?>/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('asset-admin'); ?>/DataTables/Buttons-1.5.6/css/buttons.bootstrap4.min.css">

    <link href="<?= base_url('asset-admin'); ?>/css/net_npm_simple-datatables.css" rel="stylesheet" />
    <link href="<?= base_url('asset-admin'); ?>/css/styles.css" rel="stylesheet" />
    <script src="<?= base_url('asset-admin'); ?>/js/use.fontawesome.com_releases_v6.1.0_js_all.js" crossorigin="anonymous"></script>
    <link href="<?= base_url('asset-admin'); ?>/css/cdnjs.cloudflare.com_ajax_libs_select2_4.0.7_css_select2.min.css" rel="stylesheet" />
    <script src="<?= base_url('asset-admin'); ?>/js/code.jquery.com_jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="<?= base_url('asset-admin'); ?>/js/cdnjs.cloudflare.com_ajax_libs_select2_4.0.7_js_select2.min.js"></script>
    <script type="text/javascript" src="<?= base_url('asset-admin'); ?>/js/cdnjs.cloudflare.com_ajax_libs_bootstrap-datepicker_1.6.4_js_bootstrap-datepicker.min.js"></script>

    <script type="text/javascript" src="<?= base_url('asset-admin'); ?>/js/cdnjs.cloudflare.com_ajax_libs_bootstrap-datepicker_1.6.4_locales_bootstrap-datepicker.id.min.js" charset="UTF-8"></script>
    <link rel="stylesheet" href="<?= base_url('asset-admin'); ?>/css/cdnjs.cloudflare.com_ajax_libs_bootstrap-datepicker_1.6.4_css_bootstrap-datepicker3.css" />

  </head>

  <body>
    <!-- Render halaman konten -->
    <?= $this->RenderSection('content'); ?>


    <!-- Datatables -->
    <script src="<?= base_url('asset-admin'); ?>/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('asset-admin'); ?>/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <script src="<?= base_url('asset-admin'); ?>/DataTables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('asset-admin'); ?>/DataTables/Buttons-1.5.6/js/buttons.bootstrap4.min.js"></script>

    <script src="<?= base_url('asset-admin'); ?>/DataTables/JSZip-2.5.0/jszip.min.js"></script>
    <script src="<?= base_url('asset-admin'); ?>/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="<?= base_url('asset-admin'); ?>/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="<?= base_url('asset-admin'); ?>/DataTables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
    <script src="<?= base_url('asset-admin'); ?>/DataTables/Buttons-1.5.6/js/buttons.print.min.js"></script>
    <script src="<?= base_url('asset-admin'); ?>/DataTables/Buttons-1.5.6/js/buttons.colVis.min.js"></script>
    <script src="<?= base_url('asset-admin'); ?>/js/cdn.jsdelivr.net_npm_bootstrap@5.1.3_dist_js_bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('asset-admin'); ?>/js/cdn.jsdelivr.net_npm_jquery-validation@1.19.2_dist_jquery.validate.js"></script>
    <script src="<?= base_url('asset-admin'); ?>/js/scripts.js"></script>
    <script src="<?= base_url('asset-admin'); ?>/js/cdnjs.cloudflare.com_ajax_libs_Chart.js_2.8.0_Chart.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('asset-admin'); ?>/demo/chart-area-demo.js"></script>
    <script src="<?= base_url('asset-admin'); ?>/demo/chart-bar-demo.js"></script>
    <script src="<?= base_url('asset-admin'); ?>/js/cdn.jsdelivr.net_npm_simple-datatables@latest.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('asset-admin'); ?>/js/datatables-simple-demo.js"></script>
    <script src="<?= base_url('asset-admin'); ?>/js/main.js"></script>
    <script src="<?= base_url('asset-admin'); ?>/ckeditor/ckeditor.js"></script>
    <script src="<?= base_url('asset-admin'); ?>/js/cdataTables.bootstrap5.min.js"></script>
    <?= $this->RenderSection('script'); ?>
  </body>
<?php endforeach; ?>

</html>