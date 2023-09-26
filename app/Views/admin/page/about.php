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
                            Data Tampilan About
                        </div>

                        <div class="card-body">
                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>

                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>Titel</th>
                                        <th>Judul</th>
                                        <th>Haedline</th>
                                        <th>List Pelayanan</th>
                                        <th>Nomor</th>
                                        <th>keterangan</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($page as $value) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $value->about_titel; ?> </td>
                                            <td> <?php $about_judul = html_entity_decode($value->about_judul); ?>
                                                <?= $about_judul; ?></td>
                                            <td> <?php $about_text = html_entity_decode($value->about_text); ?>
                                                <?= $about_text; ?></td>
                                            <td> <?php $about_list = html_entity_decode($value->about_list); ?>
                                                <?= $about_list; ?></td>
                                            <td> <?php $about_nomor = html_entity_decode($value->about_nomor); ?>
                                                <?= $about_nomor; ?></td>
                                            <td> <?php $about_text3 = html_entity_decode($value->about_text3); ?>
                                                <?= $about_text3; ?> </td>
                                            <td>
                                                <img src="<?= base_url('foto/page/' . $value->about_gambar) ?>" alt="" width="100px" height="100px">
                                            </td>
                                            <td class="text-canter">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $value->id; ?>">
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
                        <form action=" <?= base_url('page/about/ubah/' . $value->id) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="about_titel">titel</label>
                                <input type="text" name="about_titel" id="about_titel" class="form-control" value="<?= $value->about_titel; ?>" required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="about_judul">Judul</label>
                                <textarea name="about_judul" id="editor3" class="form-control" cols="1" rows="5" required><?= $value->about_judul; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="about_text">Headline</label>
                                <textarea name="about_text" id="editor2" class="form-control" cols="1" rows="5" required><?= $value->about_text; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="about_list">List Pelayanan</label>
                                <textarea name="about_list" id="editor" class="form-control" cols="1" rows="5" required><?= $value->about_list; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="about_nomor">Nomor</label>
                                <textarea name="about_nomor" id="editor5" class="form-control" cols="1" rows="5" required><?= $value->about_nomor; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="about_text3">keterangan </label>
                                <textarea name="about_text3" id="editor4" class="form-control" cols="1" rows="5" required><?= $value->about_text3; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="about_gambar">Upload Gambar</label>
                                <input type="hidden" name="gambarLama" value="<?= $value->about_gambar; ?>">
                                <input type="file" name="about_gambar" id="about_gambar" accept="image/*" class="form-control" onchange="PreviewImage();" value="<?= $value->about_gambar; ?>" />
                                <label for="gambar_produk">Preview</label><br>
                                <img src="<?= base_url('foto/page/' . $value->about_gambar) ?>" alt="" id="gambar_load" width="100px" height="100px">
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

        CKEDITOR.replace('editor');
        CKEDITOR.replace('editor2');
        CKEDITOR.replace('editor3');
        CKEDITOR.replace('editor4');
        CKEDITOR.replace('editor5');
    </script>
    <?= $this->endSection() ?>