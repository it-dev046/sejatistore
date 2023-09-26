<?php

use App\Models\PageModel;

$this->session = session();
$level = $this->session->get('level');
$this->PageModel = new PageModel();
$page = $this->PageModel->findAll();
?>
<?php foreach ($page as $value) : ?>
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" target="_blank" href="<?= base_url('/') ?>">Sejati Store</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar atas-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
      <?php if ($level == "1") { ?>
        <div class="input-group">
          <a class="btn btn-primary" href="<?= base_url('kasir') ?>"><i class="fas fa-cash-register"></i> Kasir</a>
        </div>
      <?php } ?>
    </form>
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <a class="btn btn-primary" href=""> <?= date('d F Y') ?> </a>
    </ul><!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="<?= base_url('user/password') ?>">Ubah Password</a></li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a></li>
        </ul>
      </li>
    </ul>
  </nav>

  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="sb-sidenav-menu-heading">
              Menu
            </div>
            <?php if ($level == "2") { ?>
              <a class="nav-link" href="<?= base_url('dashboard-admin') ?>">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-home"></i>
                </div>
                Dashboard
              </a>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-book"></i>
                </div>
                Pembukuan Kas
                <div class="sb-sidenav-collapse-arrow">
                  <i class="fas fa-angle-down"></i>
                </div>
              </a>
              <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="<?= base_url('sumber') ?>">Kas Harian</a>
                  <a class="nav-link" href="<?= base_url('kas/sumber/uang') ?>">Uang Kas</a>
                  <a class="nav-link" href="<?= base_url('kas/kategori') ?>">kategori Kas</a>
                  <a class="nav-link" href="<?= base_url('kas/labarugi') ?>">Laba Rugi</a>
                </nav>
              </div>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts6" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-cash-register"></i>
                </div>
                Penjualan
                <div class="sb-sidenav-collapse-arrow">
                  <i class="fas fa-angle-down"></i>
                </div>
              </a>
              <div class="collapse" id="collapseLayouts6" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="<?= base_url('pembayaran') ?>">Pembayaran Kasir</a>
                  <a class="nav-link" href="<?= base_url('pembayaran/ongkir') ?>">Daftar Ongkir</a>
                </nav>
              </div>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts5" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-home"></i>
                </div>
                Pemasangan
                <div class="sb-sidenav-collapse-arrow">
                  <i class="fas fa-angle-down"></i>
                </div>
              </a>
              <div class="collapse" id="collapseLayouts5" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="<?= base_url('invoice') ?>">Daftar Invoice</a>
                  <a class="nav-link" href="<?= base_url('hbk') ?>">Pembayaran HBK</a>
                  <a class="nav-link" href="<?= base_url('order') ?>">Order Barang</a>
                </nav>
              </div>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts8" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-user"></i>
                </div>
                Karyawan
                <div class="sb-sidenav-collapse-arrow">
                  <i class="fas fa-angle-down"></i>
                </div>
              </a>
              <div class="collapse" id="collapseLayouts8" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="<?= base_url('karyawan') ?>"> Daftar</a>
                  <a class="nav-link" href="<?= base_url('absen') ?>">Absensi</a>
                  <a class="nav-link" href="<?= base_url('ins') ?>">Insentif</a>
                  <a class="nav-link" href="<?= base_url('gaji') ?>">Gaji Karyawan</a>
                  <a class="nav-link" href="<?= base_url('kasbon') ?>">Kasbon</a>
                </nav>
              </div>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts9" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-users"></i>
                </div>
                Tim Lapang
                <div class="sb-sidenav-collapse-arrow">
                  <i class="fas fa-angle-down"></i>
                </div>
              </a>
              <div class="collapse" id="collapseLayouts9" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="<?= base_url('rpt') ?>">Recana Pembayaran</a>
                  <a class="nav-link" href="<?= base_url('gatuk') ?>">Gaji Pekerja</a>
                </nav>
              </div>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts10" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-building"></i>
                </div>
                Perusahaan
                <div class="sb-sidenav-collapse-arrow">
                  <i class="fas fa-angle-down"></i>
                </div>
              </a>
              <div class="collapse" id="collapseLayouts10" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="<?= base_url('deposit') ?>">Deposit Costumer</a>
                  <a class="nav-link" href="<?= base_url('piutang') ?>">Piutang</a>
                  <a class="nav-link" href="<?= base_url('rekening') ?>">Rekening</a>
                  <a class="nav-link" href="<?= base_url('hutang') ?>">Hutang</a>
                  <a class="nav-link" href="<?= base_url('bulanan') ?>">Pemakaian</a>
                  <a class="nav-link" href="<?= base_url('memo') ?>">Memo</a>
                  <a class="nav-link" href="<?= base_url('pengajuan') ?>">Pengajuan Dana</a>
                </nav>
              </div>
            <?php } elseif ($level == "3") { ?>
              <a class="nav-link" href="<?= base_url('dashboard-drafter') ?>">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-home"></i>
                </div>
                Dashboard
              </a>
              <a class="nav-link" href="<?= base_url('survei') ?>">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-check-square"></i>
                </div>
                Survei Lapangan
              </a>
              <a class="nav-link" href="<?= base_url('rekap') ?>">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-book"></i>
                </div>
                Rekap Pemasangan
              </a>
              <a class="nav-link" href="<?= base_url('hbk') ?>">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-calculator"></i>
                </div>
                Borongan Kerja
              </a>
              <a class="nav-link" href="<?= base_url('order') ?>">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-box"></i>
                </div>
                Order Barang
              </a>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-list-ol"></i>
                </div>
                Daftar Kategori
                <div class="sb-sidenav-collapse-arrow">
                  <i class="fas fa-angle-down"></i>
                </div>
              </a>
              <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="<?= base_url('drafter') ?>">Tim Gambar</a>
                  <a class="nav-link" href="<?= base_url('pengukur') ?>">Tim Survei</a>
                  <a class="nav-link" href="<?= base_url('tukang') ?>">Tim Pemasang</a>
                  <a class="nav-link" href="<?= base_url('kerja') ?>">Pekerjaan</a>
                  <a class="nav-link" href="<?= base_url('harga') ?>">Daftar Harga</a>
                  <a class="nav-link" href="<?= base_url('ukuran') ?>">Satuan Ukur</a>
                </nav>
              </div>
            <?php } elseif ($level == "4") { ?>
              <a class="nav-link" href="<?= base_url('dashboard-survei') ?>">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-home"></i>
                </div>
                Dashboard
              </a>
              <a class="nav-link" href="<?= base_url('order') ?>">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-box"></i>
                </div>
                Order Barang
              </a>
            <?php } else { ?>
              <a class="nav-link" href="<?= base_url('dashboard') ?>">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-home"></i>
                </div>
                Dashboard
              </a>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-users"></i>
                </div>
                Pelanggan
                <div class="sb-sidenav-collapse-arrow">
                  <i class="fas fa-angle-down"></i>
                </div>
              </a>
              <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="<?= base_url('pelanggan') ?>">Daftar Pelanggan</a>
                  <a class="nav-link" href="<?= base_url('katepel') ?>">Kategori Pelanggan</a>
                </nav>
              </div>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts4" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-cubes"></i>
                </div>
                Produk
                <div class="sb-sidenav-collapse-arrow">
                  <i class="fas fa-angle-down"></i>
                </div>
              </a>
              <div class="collapse" id="collapseLayouts4" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="<?= base_url('produk') ?>">Daftar Produk</a>
                  <a class="nav-link" href="<?= base_url('produk/tambah') ?>">Tambah Produk</a>
                  <a class="nav-link" href="<?= base_url('import') ?>">Import Produk</a>
                  <a class="nav-link" href="<?= base_url('satuan') ?>">Satuan</a>
                  <a class="nav-link" href="<?= base_url('kategori') ?>">Kategori</a>
                  <a class="nav-link" href="<?= base_url('subkategori') ?>">Sub kategori</a>
                </nav>
              </div>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-folder"></i>
                </div>
                Penjualan
                <div class="sb-sidenav-collapse-arrow">
                  <i class="fas fa-angle-down"></i>
                </div>
              </a>
              <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="<?= base_url('penjualan') ?>">Daftar Penjualan</a>
                  <a class="nav-link" href="<?= base_url('ongkir') ?>">Daftar Ongkir</a>
                  <!-- <a class="nav-link" href="">Promo Diskon</a> -->
                  <a class="nav-link" href="<?= base_url('kasir') ?>">Kasir</a>
                  <a class="nav-link" href="<?= base_url('retrun') ?>">Barang Kembali</a>
                </nav>
              </div>
              <a class="nav-link" href="<?= base_url('bahan') ?>">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-list"></i>
                </div>
                Bahan Pemasangan
              </a>
              <a class="nav-link" href="<?= base_url('order') ?>">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-box"></i>
                </div>
                Order Barang
              </a>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-home"></i>
                </div>
                Company Profile
                <div class="sb-sidenav-collapse-arrow">
                  <i class="fas fa-angle-down"></i>
                </div>
              </a>
              <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="<?= base_url('page/home') ?>">Home</a>
                  <a class="nav-link" href="<?= base_url('page/about') ?>">About</a>
                  <a class="nav-link" href="<?= base_url('page/proyek') ?>">Projects</a>
                  <a class="nav-link" href="<?= base_url('page/partner') ?>">Partners</a>
                  <a class="nav-link" href="<?= base_url('page/testimoni') ?>">Testimonials</a>
                  <a class="nav-link" href="<?= base_url('page/kontak') ?>">Contacts</a>
                </nav>
              </div>
            <?php } ?>
            <?php if ($level == "2") { ?>
              <a class="nav-link" href="<?= base_url('user') ?>">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-user-md"></i>
                </div>
                Daftar User
              </a>
            <?php } ?>
          </div>
        </div>
        <div class="sb-sidenav-footer">
          <div class="small">
            <?php $nama_usaha = html_entity_decode($value->nama_usaha); ?>
            <?= $nama_usaha; ?>
          </div>
          <?php $slogan = html_entity_decode($value->slogan); ?>
          <?= $slogan; ?>
        </div>
      </nav>
    </div>
  <?php endforeach; ?>