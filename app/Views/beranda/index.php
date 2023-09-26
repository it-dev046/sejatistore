<?= $this->extend('beranda/layout/template')  ?>
<?= $this->Section('content');  ?>

<?php foreach ($page as $value) : ?>
  <!-- Section Home -->
  <div class="pp-scrollable scrollable-home text-white section">
    <div class="scroll-wrap">
      <div class="section-bg" style="background-image:url(<?= base_url('foto/page/' . $value->home_gambar) ?>"></div>
      <div class="scrollable-content">
        <div class="vertical-centred">
          <div class="boxed boxed-inner">
            <div class="vertical-title hidden-xs hidden-sm"><span><?= $value->home_titel; ?></span></div>
            <div class="boxed">
              <div class="container">
                <div class="intro">
                  <div class="row">
                    <div class="col-md-8 col-lg-6">
                      <p class="subtitle-top">
                        <font size="5"><?php $home_judul = html_entity_decode($value->home_judul); ?>
                          <?= $home_judul; ?></font>
                      </p>
                      <h1 class="display-1 text-white"><span><?php $home_text = html_entity_decode($value->home_text); ?>
                          <?= $home_text; ?></span></h1>
                      <div class="hr-bottom"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Section About -->
  <div class="pp-scrollable scrollable-about section">
    <div class="scroll-wrap">
      <div class="scrollable-content">
        <div class="vertical-centred">
          <div class="boxed boxed-inner">
            <div class="vertical-title text-white hidden-xs hidden-sm"><span><?= $value->about_titel; ?></span></div>
            <div class="boxed">
              <div class="container">
                <div class="intro">
                  <div class="row">
                    <div class="col-md-5 col-lg-5">
                      <p class="subtitle-top text-white"><?php $about_judul = html_entity_decode($value->about_judul); ?>
                        <?= $about_judul; ?></p>
                      <h2 class="title-uppercase"> <?php $about_text = html_entity_decode($value->about_text); ?>
                        <?= $about_text; ?></h2>
                      <ul class="service-list">
                        <?php $about_list = html_entity_decode($value->about_list); ?>
                        <?= $about_list; ?>
                      </ul>
                    </div>
                    <div class="col-md-6 col-lg-5 col-md-offset-1 col-lg-offset-2">
                      <div class="dots-image-2">
                        <img alt="" class="img-responsive" src="<?= base_url('foto/page/' . $value->about_gambar) ?>">
                        <div class="dots"></div>
                        <div class="experience-info">
                          <div class="number"><?php $about_nomor = html_entity_decode($value->about_nomor); ?>
                            <?= $about_nomor; ?></div>
                          <div class="text"><?php $about_text3 = html_entity_decode($value->about_text3); ?>
                            <?= $about_text3; ?></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Section Projects -->
  <div class="pp-scrollable scrollable-projects text-white section">
    <div class="scroll-wrap">
      <div class="bg-changer">
        <div class="section-bg" style="background-image:url(<?= base_url('foto/page/' . $value->projects_gambar) ?>);"></div>
      </div>
      <div class="scrollable-content">
        <div class="vertical-centred">
          <div class="boxed boxed-inner">
            <div class="vertical-title hidden-xs hidden-sm"><span><?= $value->project_titel; ?></span></div>
            <div class="boxed">
              <div class="container">
                <div class="intro">
                  <div class="row">
                    <div class="col-md-12">
                      <h2 class="title-uppercase text-white"><?php $project_judul = html_entity_decode($value->project_judul); ?>
                        <?= $project_judul; ?></h2>
                      <div class="row-project-box row">

                        <!-- Project Item 1 -->
                        <?php foreach ($daftar_project as $project) : ?>
                          <div class="col-project-box col-sm-6 col-md-4 col-lg-3">
                            <a href="#project<?= $project->id; ?>" class="project-box popup-with-zoom-anim">
                              <div class="project-box-inner">
                                <h5><?php $nama_project = html_entity_decode($project->nama_project); ?>
                                  <?= $nama_project; ?></h5>
                                <div class="project-category"><?php $pengerjaan = html_entity_decode($project->pengerjaan); ?>
                                  <?= $pengerjaan; ?></div>
                              </div>
                            </a>
                            <!-- Project Modal Dialog 1 -->
                            <div id="project<?= $project->id; ?>" class="container zoom-anim-dialog mfp-hide">
                              <div class="row">
                                <div class="col-lg-8"><img alt="" class="project-detail-img" src="<?= base_url('foto/page/' . $project->gambar) ?>"></div>
                                <div class="col-lg-4">
                                  <h3 class="project-detail-title"><?php $nama_project = html_entity_decode($project->nama_project); ?>
                                    <?= $nama_project; ?></h3>
                                  <p class="project-detail-text"><?php $deskripsi = html_entity_decode($project->deskripsi); ?>
                                    <?= $deskripsi; ?></p>
                                  <ul class="project-detail-list text-white">
                                    <li>
                                      <span class="left">Pelanggan :</span>
                                      <span class="right"><?php $pelanggan = html_entity_decode($project->pelanggan); ?>
                                        <?= $pelanggan; ?></span>
                                    </li>
                                    <li>
                                      <span class="left">Selesai Pengerjaan:</span>
                                      <span class="right"><?php $tanggal = html_entity_decode($project->tanggal); ?>
                                        <?= $tanggal; ?></span>
                                    </li>
                                    <li>
                                      <span class="left">Project Pengerjaan:</span>
                                      <span class="right"><?php $pengerjaan = html_entity_decode($project->pengerjaan); ?>
                                        <?= $pengerjaan; ?></span>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Section Partners -->
  <div class="pp-scrollable scrollable-partners section">
    <div class="scroll-wrap">
      <div class="scrollable-content">
        <div class="vertical-centred">
          <div class="boxed boxed-inner">
            <div class="vertical-title text-white hidden-xs hidden-sm"><span><?= $value->partner_titel; ?></span></div>
            <div class="boxed">
              <div class="container">
                <div class="intro overflow-hidden">
                  <div class="row">
                    <div class="col-md-12">
                      <h2 class="title-uppercase"><?php $partner_judul = html_entity_decode($value->partner_judul); ?>
                        <?= $partner_judul; ?></h2>
                      <div class="row-partners">
                        <?php foreach ($daftar_partner as $partner) : ?>
                          <div class="col-partner">
                            <div class="partner-inner"><img alt="" width="200px" height="200px" src="<?= base_url('foto/page/' . $partner->logo) ?>"></div>
                          </div>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Testimonials-->
  <div class="pp-scrollable scrollable-testimonials text-white section">
    <div class="scroll-wrap">
      <div class="section-bg" style="background-image:url(images/bg/bg3.jpg);"></div>
      <div class="scrollable-content">
        <div class="vertical-centred">
          <div class="boxed boxed-inner">
            <div class="vertical-title hidden-xs hidden-sm"><span><?= $value->testimoni_titel; ?></span></div>
            <div class="boxed">
              <div class="container">
                <div class="intro">
                  <div class="row">
                    <div class="col-md-6 col-lg-5">
                      <span class="icon-quote"><ion-icon name="chatbubble-ellipses-outline"></ion-icon></span>
                      <h2 class="title-uppercase text-white"><?php $testimoni_judul = html_entity_decode($value->testimoni_judul); ?> <?= $testimoni_judul; ?></h2>
                    </div>
                    <div class="col-md-5 col-lg-5  col-md-offset-1 col-lg-offset-2">
                      <div class="review-carousel owl-carousel">
                        <?php foreach ($daftar_testimoni as $testimoni) : ?>
                          <div class="review-carousel-item">
                            <div class="text"><?php $ucapan = html_entity_decode($testimoni->ucapan); ?> <?= $ucapan; ?>
                            </div>
                            <div class="review-author">
                              <div class="author-name"><?php $nama_pelanggan = html_entity_decode($testimoni->nama_pelanggan); ?> <?= $nama_pelanggan; ?></div>
                              <i><?php $project = html_entity_decode($testimoni->project); ?> <?= $project; ?></i>
                            </div>
                          </div>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Section Contacts -->
  <div class="pp-scrollable scrollable-contacts section">
    <div class="scroll-wrap">
      <div class="scrollable-content">
        <div class="vertical-centred">
          <div class="boxed boxed-inner">
            <div class="vertical-title text-white hidden-xs hidden-sm"><span><?= $value->contact_titel; ?></span></div>
            <div class="boxed">
              <div class="container">
                <div class="intro overflow-hidden">
                  <div class="row">
                    <div class="col-md-12">
                      <h2 class="title-uppercase"><?php $contact_judul = html_entity_decode($value->contact_judul); ?>
                        <?= $contact_judul; ?></h2>
                      <iframe src="<?= $value->google_map; ?>" width="1900" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                      <div class="contact-info">
                        <div class="row-contact-info row">
                          <div class="col-contact-info col-md-6 col-lg-4">
                            <div class="row">
                              <h3 class="col-sm-3 col-md-4">Email</h3>
                              <div class="col-right col-sm-8 col-md-7 col-sm-offset-1 col-md-offset-1">
                                <div class="contact-info-row col-sm-6 col-md-12">
                                  <?php $email = html_entity_decode($value->email); ?>
                                  <?= $email; ?>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-contact-info col-md-6 col-lg-4">
                            <div class="row">
                              <h3 class="col-sm-3 col-md-4">Telepon</h3>
                              <div class="col-right col-sm-8 col-md-7 col-sm-offset-1 col-md-offset-1">
                                <div class="contact-info-row col-sm-6 col-md-12">
                                  <?php $telpon = html_entity_decode($value->telpon); ?>
                                  <?= $telpon; ?>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-contact-info col-md-6 col-lg-4">
                            <div class="row">
                              <h3 class="col-sm-3 col-md-4">Alamat</h3>
                              <div class="col-right col-sm-8 col-md-7 col-sm-offset-1 col-md-offset-1">
                                <div class="contact-info-row col-sm-6 col-md-12">
                                  <?php $alamat = html_entity_decode($value->alamat); ?>
                                  <?= $alamat; ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
<?= $this->endSection()  ?>