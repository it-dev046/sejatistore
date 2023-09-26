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
                            Daftar Sub Kategori Produk
                        </div>

                        <div class="card-body">
                            <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                <i class="fas fa-plus"></i> Tambah
                            </button>

                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>

                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama subkate</th>
                                        <th>Kategori</th>
                                        <th>Aksi</th>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($daftar_subkate as $key => $value) { ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= $value['nama_subkate'] ?> </td>
                                            <td> <?= $value['nama_kategori'] ?> </td>
                                            <td width="30%" class="text-canter">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $value['id_subkate'] ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $value['id_subkate'] ?>">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php }  ?>
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

    <!-- Modal -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Sub Kategori Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('subkategori/tambah') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="nama_subkate">Nama Sub Kategori</label>
                            <input type="text" name="nama_subkate" id="nama_subkate" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="slug_kategori">Kategori</label>
                            <select name="id_kategori" id="id_kategori" class="form-control">
                                <option value="" hidden>--Pilih--</option>
                                <!-- panggil data kategori -->
                                <?php foreach ($daftar_kategori as $kategori) : ?>
                                    <option value="<?= $kategori->id_kategori; ?>"><?= $kategori->nama_kategori; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php foreach ($daftar_subkate as $key => $value) { ?>
    <div class="modal fade" id="ubahModal<?= $value['id_subkate'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Sub Kategori Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('subkategori/ubah/' . $value['id_subkate']) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <input type="hidden" name="_method" value="PUT">
                            <label for="nama_subkate">Nama SUb Kategori</label>
                            <input type="text" name="nama_subkate" id="nama_subkate" class="form-control" value="<?= $value['nama_subkate'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="_method" value="PUT">
                            <label for="id_kategori">Kategori</label>
                            <select name="id_kategori" id="id_kategori" class="form-control">
                                <option value="<?= $value['id_kategori'] ?>" hidden>--<?= $value['nama_kategori'] ?>--</option>
                                <!-- panggil data kategori -->
                                <?php foreach ($daftar_kategori as $kategori) : ?>
                                    <option value="<?= $kategori->id_kategori; ?>"><?= $kategori->nama_kategori; ?></option>
                                <?php endforeach; ?>
                            </select>
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
    </div>
<?php } ?>

<?php foreach ($daftar_subkate as $key => $value) { ?>
    <div class="modal fade" id="hapusModal<?= $value['id_subkate'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Sub Kategori Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('subkategori/hapus/' . $value['id_subkate']) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <p>
                            Yakin Data Sub Kategori Produk : <?= $value['nama_subkate'] ?>, akan dihapus ?
                        </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
<?php } ?>



<?= $this->endSection() ?>
<?= $this->Section('script') ?>
<script>
    $(document).ready(function() {
        $('#id_kategori').change(function(e) {
            var id_kategori = $("#id_kategori").val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('SubkategoriController/ambilKategori') ?>",
                data: {
                    id_kategori: id_kategori
                },
                success: function(response) {
                    $("#id_subkate").html(response);
                }
            });

        });
    });
</script>
<?= $this->endSection() ?>