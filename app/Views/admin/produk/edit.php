<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> <?= $title; ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item active"> <?= $title; ?></li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Edit Produk
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

                            <form action="<?= base_url('produk/ubah/' . $produk['id_produk']) ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="nama_produk">Nama Produk</label>
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="gambarLama" value="<?= $produk['gambar_produk'] ?>">
                                        <input type="text" name="nama_produk" id="nama_produk" class="form-control" value="<?= $produk['nama_produk'] ?>">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="kategori_slug">Kategori Produk</label>
                                        <select name="id_kategori" id="id_kategori" class="form-control <?= $validation->hasError('kategori_slug') ? 'is-invalid' : null ?>">
                                            <option value="<?= $produk['id_kategori'] ?>" hidden></option>
                                            <!-- panggil data kategori -->
                                            <?php foreach ($kategori_produk as $kategori) : ?>
                                                <option value="<?= $kategori->id_kategori; ?>" <?= $produk['id_kategori'] == $kategori->id_kategori ? 'selected' : null ?>> <?= $kategori->nama_kategori; ?> </option>
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
                                            <!-- panggil data subkate -->
                                            <?php foreach ($subkate_produk as $subkate) : ?>
                                                <option value="<?= $subkate->id_subkate; ?>" <?= $produk['id_subkate'] == $subkate->id_subkate ? 'selected' : null ?>> <?= $subkate->nama_subkate; ?> </option>
                                            <?php endforeach; ?>
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
                                            <!-- panggil data satuan -->
                                            <?php foreach ($satuan_produk as $satuan) : ?>
                                                <option value="<?= $satuan->id_satuan; ?>" <?= $produk['id_satuan'] == $satuan->id_satuan ? 'selected' : null ?>> <?= $satuan->nama_satuan; ?> - <?= $satuan->singkatan; ?> </option>
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
                                        <input type="number" name="stok" id="stok" class="form-control <?= $validation->hasError('stok') ? 'is-invalid' : null ?>" value="<?= $produk['stok'] ?>">
                                        <?php if ($validation->hasError('stok')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('stok'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="harga">Harga</label>
                                        <input type="number" name="harga" id="harga" class="form-control <?= $validation->hasError('harga') ? 'is-invalid' : null ?>" value="<?= $produk['harga'] ?>">
                                        <?php if ($validation->hasError('harga')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('harga'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi" cols="20" rows="6" class="form-control <?= $validation->hasError('deskripsi') ? 'is-invalid' : null ?>"><?= $produk['deskripsi'] ?></textarea>
                                        <?php if ($validation->hasError('deskripsi')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('deskripsi'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="gambar_produk">Upload Foto</label>
                                        <input type="file" name="foto" id="foto" accept="image/*" class="form-control <?= $validation->hasError('gambar_produk') ? 'is-invalid' : null ?>" onchange="PreviewImage();" value="<?= $produk['gambar_produk'] ?>" />
                                        <?php if ($validation->hasError('gambar_produk')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('gambar_produk'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <label for="gambar_produk">Preview</label><br>
                                        <img src="<?= base_url('foto/' . $produk['gambar_produk']) ?>" alt="" id="gambar_load" width="100px" height="100px">
                                    </div>
                                </div>
                                <div class="justify-content-end d-flex">
                                    <button class="btn btn-primary btn-sm">Ubah</button>
                                    <span>&nbsp;</span>
                                    <a href="<?= base_url('produk') ?>" class="btn btn-dark btn-sm">Kembali</a>
                                </div>
                            </form>


                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>

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
                    url: "<?= base_url('ProdukController/ambilKategori') ?>",
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
        $('#foto').change(function() {
            bacaGambar(this);
        });
    </script>
    <?= $this->endSection() ?>