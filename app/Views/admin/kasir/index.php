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
                            <i class="fas fa-list me-1"></i>
                            Silahkan Pilih Pelanggan
                        </div>

                        <div class="card-body">
                            <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                <i class="fas fa-plus"></i> Pelanggan baru
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
                                        <th>Nama Pelanggan</th>
                                        <th>No Telepon</th>
                                        <th>Alamat</th>
                                        <th>kota</th>
                                        <th>Kategori</th>
                                        <th>Aksi</th>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($daftar_pel as $key => $value) { ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= $value['nama_pel'] ?> </td>
                                            <td> <?= $value['telepon'] ?> </td>
                                            <td> <?= $value['alamat'] ?> </td>
                                            <td> <?= $value['kota'] ?> </td>
                                            <td> <?= $value['nama_katepel'] ?> </td>
                                            <td width="30%" class="text-canter">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $value['id_pel'] ?>">
                                                    <i class="fas fa-edit"></i> Pilih
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Pelanggan baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('pelanggan/tambah') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="nama_pel">Nama Pelanggan</label>
                            <input type="text" name="nama_pel" id="nama_pel" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="telepon">Telepon / WA</label>
                            <input type="text" name="telepon" id="telepon" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="kota">Kota</label>
                            <input type="text" name="kota" id="kota" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="slug_kategori">Kategori</label>
                            <select name="id_katepel" id="id_katepel" class="form-control">
                                <!-- panggil data kategori -->
                                <?php foreach ($katepel as $key => $value) { ?>
                                    <option value="<?= $value['id_katepel'] ?>"><?= $value['nama_katepel'] ?></option>
                                <?php } ?>
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

<?php foreach ($daftar_pel as $key => $value) { ?>
    <div class="modal fade" id="ubahModal<?= $value['id_pel'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Pilih Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('kasir/simpanfaktur') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <input type="hidden" name="_method" value="PUT">
                            <label for="nama_pel">Nama Pelanggan</label>
                            <input type="int" id="id_pel" name="id_pel" class="form-control" value="<?= $value['id_pel'] ?>" hidden>
                            <input type="text" name="nama_pel" id="nama_pel" class="form-control" value="<?= $value['nama_pel'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="_method" value="PUT">
                            <label for="telepon">Telepon</label>
                            <input type="text" name="telepon" id="telepon" class="form-control" value="<?= $value['telepon'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="_method" value="PUT">
                            <label for="alamat">Alamat Pengantaran</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" value="<?= $value['alamat'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="_method" value="PUT">
                            <label for="id_katepel">Kategori</label>
                            <select name="id_katepel" id="id_katepel" class="form-control">
                                <option value="<?= $value['id_katepel'] ?>" hidden>--<?= $value['nama_katepel'] ?>--</option>
                                <?php foreach ($katepel as $key => $id) { ?>
                                    <option value="<?= $id['id_katepel'] ?>"><?= $id['nama_katepel'] ?> - <?= $id['keterangan'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="_method" value="PUT">
                            <label for="id_ongkir">Biaya Ongkir Pengiriman</label>
                            <select name="id_ongkir" id="id_ongkir" class="form-control" required>
                                <!-- panggil data ongkir -->
                                <?php foreach ($daftar_ongkir as $value) : ?>
                                    <option value="<?= $value->id_ongkir; ?>"><?= $value->nama_wilayah; ?> (<?= number_to_currency($value->biaya, 'IDR', 'id_ID', 2); ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status">Metode Pembayaran</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="1">--Tunai/Transfer--</option>
                                <option value="2">--COD--</option>
                                <option value="3">--Invoice--</option>
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
<?php } ?>
<?= $this->endSection() ?>