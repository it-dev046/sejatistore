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
                            Tambah Produk
                        </div>

                        <div class="card-body">
                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>
                            <!-- Notifikasi Gagal -->
                            <?php if (session('failed')) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session('failed'); ?>
                                </div>
                            <?php endif; ?>

                            <form action="<?= base_url('produk/simpan') ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="nama_produk">Nama Produk</label>
                                        <input type="text" name="nama_produk" id="nama_produk" class="form-control">
                                    </div>

                                    <div class="mb-3 col-4">
                                        <label for="kategori_slug">Kategori Produk</label>
                                        <select name="id_kategori" id="id_kategori" class="form-control <?= $validation->hasError('kategori_slug') ? 'is-invalid' : null ?>">
                                            <option value="" hidden>--Pilih--</option>
                                            <!-- panggil data kategori -->
                                            <?php foreach ($kategori_produk as $kategori) : ?>
                                                <?php if (old('kategori_slug') == $kategori->slug_kategori) : ?>
                                                    <option value="<?= $kategori->id_kategori; ?>" selected> <?= $kategori->nama_kategori; ?> </option>
                                                <?php else : ?>
                                                    <option value="<?= $kategori->id_kategori; ?>"> <?= $kategori->nama_kategori; ?> </option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if ($validation->hasError('kategori_slug')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('kategori_slug'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-3 col-4">
                                        <label for="sub_slug">Sub Kategori</label>
                                        <select name="id_subkate" id="id_subkate" class="form-control <?= $validation->hasError('sub_slug') ? 'is-invalid' : null ?>">
                                        </select>
                                        <?php if ($validation->hasError('sub_slug')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('sub_slug'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-3 col-4">
                                        <label for="id_satuan">Satuan Produk</label>
                                        <select name="id_satuan" id="id_satuan" class="form-control <?= $validation->hasError('id_satuan') ? 'is-invalid' : null ?>">
                                            <option value="" hidden>--Pilih--</option>
                                            <!-- panggil data satuan -->
                                            <?php foreach ($satuan_produk as $satuan) : ?>
                                                <?php if (old('id_satuan') == $satuan->id_satuan) : ?>
                                                    <option value="<?= $satuan->id_satuan; ?>" selected> <?= $satuan->nama_satuan; ?> - <?= $satuan->singkatan; ?> </option>
                                                <?php else : ?>
                                                    <option value="<?= $satuan->id_satuan; ?>"> <?= $satuan->nama_satuan; ?> - <?= $satuan->singkatan; ?> </option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if ($validation->hasError('id_satuan')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('id_satuan'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-3 col-4">
                                        <label for="stok">Stok</label>
                                        <input type="number" name="stok" id="stok" class="form-control <?= $validation->hasError('stok') ? 'is-invalid' : null ?>" value="<?= old('stok') ?>">
                                        <?php if ($validation->hasError('stok')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('stok'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-3 col-4">
                                        <label for="harga">Harga</label>
                                        <input type="number" name="harga" id="harga" class="form-control <?= $validation->hasError('harga') ? 'is-invalid' : null ?>" value="<?= old('harga') ?>">
                                        <?php if ($validation->hasError('harga')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('harga'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi" cols="20" rows="6" class="form-control <?= $validation->hasError('deskripsi') ? 'is-invalid' : null ?>"><?= old('deskripsi') ?></textarea>
                                        <?php if ($validation->hasError('deskripsi')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('deskripsi'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="gambar_produk">Upload Foto</label>
                                        <input type="file" name="foto" id="preview_gambar" accept="image/*" class="form-control <?= $validation->hasError('gambar_produk') ? 'is-invalid' : null ?>" onchange="PreviewImage();" />
                                        <?php if ($validation->hasError('gambar_produk')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('gambar_produk'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <label for="gambar_produk">Preview</label><br>
                                        <img src="<?= base_url('foto/blank.jpg') ?>" alt="" id="gambar_load" width="100px" height="100px">
                                    </div>
                                </div>
                                <div class="justify-content-end d-flex">
                                    <button class="btn btn-primary btn-sm">Tambah</button>
                                    <span>&nbsp;</span>
                                    <a href="<?= base_url('produk') ?>" class="btn btn-dark btn-sm">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?= $this->endSection()  ?>

    <?= $this->Section('script') ?>
    <script>
        $(document).ready(function() {
            $('#id_kategori').change(function(e) {
                var id_kategori = $("#id_kategori").val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('produk/ambilKategori') ?>",
                    data: {
                        id_kategori: id_kategori
                    },
                    success: function(response) {
                        $("#id_subkate").html(response);
                    }
                });

            });
        });

        function bacaGambar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#gambar_load').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $('#preview_gambar').change(function() {
            bacaGambar(this);
        });
    </script>
    <?= $this->endSection() ?>