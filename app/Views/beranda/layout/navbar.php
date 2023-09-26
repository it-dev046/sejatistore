<?php foreach ($page as $value) : ?>
  <!-- Loader -->
  <div class="loader">
    <div class="spinner">
      <div class="double-bounce1"></div>
      <div class="double-bounce2"></div>
    </div>
  </div>

  <!-- Content CLick Capture-->
  <div class="click-capture"></div>

  <!-- Sidebar Menu-->
  <div class="menu">
    <span class="close-menu right-boxed"><ion-icon name="close-outline"></ion-icon></span>
    <nav class="nav mobile-menu menu-pagepiling">
      <ul class="menu-list right-boxed">
        <li>
          <a data-menuanchor="main" href="#main">Home</a>
        </li>
        <li>
          <a data-menuanchor="about" href="#about">About</a>
        </li>
        <li>
          <a data-menuanchor="projects" href="#projects">Projects</a>
        </li>
        <li>
          <a data-menuanchor="partners" href="#partners">Partners</a>
        </li>
        <li>
          <a data-menuanchor="testimonials" href="#testimonials">Testimonials</a>
        </li>
        <li>
          <a data-menuanchor="contacts" href="#contacts">Contacts</a>
        </li>
        <li>
          <a data-menuanchor="stok" href="<?php echo base_url('cetak/stok'); ?>">Stok Produk</a>
        </li>
        <li>
          <a data-menuanchor="login" href="<?php echo base_url('login'); ?>">Login</a>
        </li>
      </ul>
    </nav>
    <div class="menu-footer right-boxed">
      <div class="social-list">
        <a href="<?= $value->link_fb; ?>"><ion-icon name="logo-facebook"></ion-icon></a>
        <a href="<?= $value->link_ig; ?>"><ion-icon name="logo-instagram"></ion-icon></a>
        <a href="<?= $value->link_yt; ?>"><ion-icon name="logo-youtube"></ion-icon></a>
        <a href="<?= $value->link_wa; ?>"><ion-icon name="logo-whatsapp"></ion-icon></a>
      </div>
      <div class="copy">© <?php $nama_usaha = html_entity_decode($value->nama_usaha); ?>
        <?= $nama_usaha; ?> 2023. All Rights Reseverd<br> Design by Unity-Tekno</div>
    </div>
  </div>

  <!-- Navbar -->
  <header class="navbar navbar-2 navbar-white boxed">
    <div class="navbar-bg"></div>
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>

    <a class="brand" href="#">
      <img class="brand-img-white" alt="" src="">
      <div class="brand-info">
        <div class="brand-name"><?php $nama_usaha = html_entity_decode($value->nama_usaha); ?>
          <?= $nama_usaha; ?></div>
        <div class="brand-text mt"><?php $slogan = html_entity_decode($value->slogan); ?>
          <?= $slogan; ?></div>
      </div>
    </a>

    <address class="navbar-address visible-lg">call us: <span class="text-white"><?php $telpon = html_entity_decode($value->telpon); ?>
        <?= $telpon; ?></span></address>
    <div class="social-list hidden-xs">
      <a href="<?= $value->link_fb; ?>"><ion-icon name="logo-facebook"></ion-icon></a>
      <a href="<?= $value->link_ig; ?>"><ion-icon name="logo-instagram"></ion-icon></a>
      <a href="<?= $value->link_yt; ?>"><ion-icon name="logo-youtube"></ion-icon></a>
      <a href="<?= $value->link_wa; ?>"><ion-icon name="logo-whatsapp"></ion-icon></a>
    </div>
  </header>
<?php endforeach; ?>