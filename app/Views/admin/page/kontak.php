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
                            Data Tampilan Contact
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
                                        <th>link Map</th>
                                        <th>Email</th>
                                        <th>Telepon WA</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                <tbody>
                                    <?php foreach ($page as $value) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $value->contact_titel; ?> </td>
                                            <td> <?php $contact_judul = html_entity_decode($value->contact_judul); ?>
                                                <?= $contact_judul; ?></td>
                                            <td class="text-truncate" style="max-width: 150px;"> <?php $google_map = html_entity_decode($value->google_map); ?>
                                                <?= $google_map; ?></td>
                                            <td> <?php $email = html_entity_decode($value->email); ?>
                                                <?= $email; ?></td>
                                            <td> <?php $telpon = html_entity_decode($value->telpon); ?>
                                                <?= $telpon; ?> </td>
                                            <td> <?php $alamat = html_entity_decode($value->alamat); ?>
                                                <?= $alamat; ?></td>
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
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Tampilan Contact</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('page/kontak/ubah/' . $value->id) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="contact_titel">Titel</label>
                                <input type="text" name="contact_titel" id="contact_titel" class="form-control" value="<?= $value->contact_titel; ?>" required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="contact_judul">Judul</label>
                                <textarea name="contact_judul" id="editor" class="form-control" cols="1" rows="5" required><?= $value->contact_judul; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="google_map">Link Map</label>
                                <textarea name="google_map" class="form-control" cols="1" rows="5" required><?= $value->google_map; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="email">Email</label>
                                <textarea name="email" id="editor3" class="form-control" cols="1" rows="5" required><?= $value->email; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="telpon">Nomor WA</label>
                                <textarea name="telpon" id="editor4" class="form-control" cols="1" rows="5" required><?= $value->telpon; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="editor5" class="form-control" cols="1" rows="5" required><?= $value->alamat; ?></textarea>
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