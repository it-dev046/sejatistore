<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> <?= $title; ?> </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item active"> <?= $title; ?> </li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Tampilan Home
                        </div>
                        <div class="card-body">
                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="table-responsive-sm">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th>Titel</th>
                                            <th>Judul</th>
                                            <th>Haedline</th>
                                            <th>Background</th>
                                            <th>Aksi</th>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($page as $value) : ?>
                                            <!-- html... -->
                                            <tr>
                                                <td> <?= $value->home_titel; ?> </td>
                                                <td> <?php $home_judul = html_entity_decode($value->home_judul); ?>
                                                    <?= $home_judul; ?></td>
                                                <td> <?php $home_text = html_entity_decode($value->home_text); ?>
                                                    <?= $home_text; ?></td>
                                                <td>
                                                    <img src="<?= base_url('foto/page/' . $value->home_gambar) ?>" alt="" width="400px" height="300px">
                                                </td>
                                                <td class="text-canter">
                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $value->id; ?>">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Info Perusahaan
                        </div>
                        <div class="card-body">
                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="table-responsive-sm">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th>Logo</th>
                                            <th>Nama Perusahaan</th>
                                            <th width="10%">Slogan</th>
                                            <th>Facebook Link</th>
                                            <th>Instagram Link</th>
                                            <th>Youtube Link</th>
                                            <th>WhatsApp Link</th>
                                            <th>Aksi</th>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($page as $value) : ?>
                                            <!-- html... -->
                                            <tr>
                                                <td>
                                                    <img src="<?= base_url('foto/page/' . $value->logo) ?>" alt="" width="100px" height="100px">
                                                </td>
                                                <td><?php $nama_usaha = html_entity_decode($value->nama_usaha); ?>
                                                    <?= $nama_usaha; ?></td>
                                                <td><?php $slogan = html_entity_decode($value->slogan); ?>
                                                    <?= $slogan; ?></td>
                                                <td class="text-truncate" style="max-width: 150px;"><?= $value->link_fb; ?> </td>
                                                <td class="text-truncate" style="max-width: 150px;"><?= $value->link_ig; ?> </td>
                                                <td class="text-truncate" style="max-width: 150px;"><?= $value->link_yt; ?> </td>
                                                <td class="text-truncate" style="max-width: 150px;"><?= $value->link_wa; ?> </td>
                                                <td class="text-canter">
                                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal2<?= $value->id; ?>">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <?php foreach ($page as $value) : ?>
        <div class="modal fade" id="ubahModal<?= $value->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Tampilan Home</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('page/home/ubah/' . $value->id) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="home_titel">Titel</label>
                                <input type="text" name="home_titel" id="home_titel" class="form-control" value="<?= $value->home_titel; ?>" required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="home_judul">Judul</label>
                                <textarea name="home_judul" id="editor" class="form-control" cols="1" rows="5" required><?= $value->home_judul; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="home_text">Headline</label>
                                <textarea name="home_text" id="editor2" class="form-control" cols="1" rows="5" required><?= $value->home_text; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="home_gambar">Upload Background</label>
                                <input type="hidden" name="gambarLama" value="<?= $value->home_gambar; ?>">
                                <input type="file" name="home_gambar" id="foto" accept="image/*" class="form-control" onchange="PreviewImage();" value="<?= $value->home_gambar; ?>" />
                                <label for="gambar_produk">Preview</label><br>
                                <img src="<?= base_url('foto/page/' . $value->home_gambar) ?>" alt="" id="gambar_load" width="200px" height="100px">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm">Ubah</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
    <?php foreach ($page as $value) : ?>
        <div class="modal fade" id="ubahModal2<?= $value->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Data Perushaan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('page/usaha/ubah/' . $value->id) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="nama_usaha">Nama Perusahaan</label>
                                <textarea name="nama_usaha" id="editor3" class="form-control" cols="1" rows="5" required><?= $value->nama_usaha; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="slogan">Slogan</label>
                                <textarea name="slogan" id="editor4" class="form-control" cols="1" rows="5" required><?= $value->slogan; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="link_fb">Link Facebook</label>
                                <input type="text" name="link_fb" id="link_fb" class="form-control" value="<?= $value->link_fb; ?>" required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="link_ig">Link Instagram</label>
                                <input type="text" name="link_ig" id="link_ig" class="form-control" value="<?= $value->link_ig; ?>" required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="link_yt">Link Youtube</label>
                                <input type="text" name="link_yt" id="link_yt" class="form-control" value="<?= $value->link_yt; ?>" required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="link_wa">Link WhatsApp</label>
                                <input type="text" name="link_wa" id="link_wa" class="form-control" value="<?= $value->link_wa; ?>" required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="logo">Upload Logo</label>
                                <input type="hidden" name="gambarLama" value="<?= $value->logo; ?>">
                                <input type="file" name="logo" id="foto2" accept="image/*" class="form-control" onchange="PreviewImage();" value="<?= $value->logo; ?>" />
                                <label for="gambar_produk">Preview</label><br>
                                <img src="<?= base_url('foto/page/' . $value->logo) ?>" alt="" id="gambar_load2" width="100px" height="100px">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm">Ubah</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
    <?= $this->endSection() ?>
    <?= $this->Section('script') ?>
    <script>
        function bacaGambar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#gambar_load').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $('#foto').change(function() {
            bacaGambar(this);
        });

        function bacaGambar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#gambar_load2').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $('#foto2').change(function() {
            bacaGambar(this);
        });

        CKEDITOR.replace('editor');
        CKEDITOR.replace('editor2');
        CKEDITOR.replace('editor3');
        CKEDITOR.replace('editor4');
    </script>
    <?= $this->endSection() ?>