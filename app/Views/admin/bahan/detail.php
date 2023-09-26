<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $title; ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard-admin') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item"><a href=" <?= base_url('bahan') ?> ">Pemasangan</a></li>
                <li class="breadcrumb-item active"><?= $title; ?> </li>
            </ol>
            <?php if (session('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session('success'); ?>
                </div>
            <?php endif; ?>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-plus me-1"></i>
                    Tambah Bahan Pemasangan
                </div>
                <div class="card-body">
                    <form action="<?= base_url('bahan/pakai') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="mb-3 col-4 mt-1">
                                <label for="id_produk">
                                    <h6>Nama Produk</h6>
                                </label>
                                <select id="id_produk" name="id_produk" class="form-control">
                                    <option value="">-- Pilih Produk --</option>
                                    <?php foreach ($daftar_produk as $produk) : ?>
                                        <option value="<?= $produk['id_produk']; ?>"><?= $produk['nama_produk']; ?> (<?= $produk['singkatan']; ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3 col-2">
                                <label for="nama_kategori">
                                    <h6>Kategori</h6>
                                </label>
                                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" readonly required>
                                <input type="number" name="id_pasang" id="id_pasang" class="form-control" value="<?= $pemasangan->id_pasang; ?>" hidden>
                            </div>
                            <div class="mb-3 col-2">
                                <label for="nama_subkate">
                                    <h6>Subkategori</h6>
                                </label>
                                <input type="text" name="nama_subkate" id="nama_subkate" class="form-control" readonly required>
                            </div>
                            <div class="mb-3 col-1">
                                <label for="stok">
                                    <h6>Stok</h6>
                                </label>
                                <input type="text" name="stok" id="stok" class="form-control" readonly required>
                            </div>
                            <div class="mb-3 col-1">
                                <label for="nama_satuan">
                                    <h6>Satuan</h6>
                                </label>
                                <input type="text" name="nama_satuan" id="nama_satuan" class="form-control" readonly required>
                            </div>
                            <div class="mb-3 col-2">
                                <label for="deskripsi">
                                    <h6>Deskripsi</h6>
                                </label>
                                <input type="text" name="deskripsi" id="deskripsi" class="form-control" readonly required>
                            </div>
                            <div class="mb-3 col-1">
                                <label for="jumlah">
                                    <h6>Jumlah</h6>
                                </label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                            </div>
                            <div class="mb-3 col-2">
                                <label for="keterangan">
                                    <h6>Keterangan</h6>
                                </label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                            </div>
                            <div class="mb-3 col-2">
                                <label for="tanggal">
                                    <h6>Tanggal</h6>
                                </label>
                                <input type="text" name="tanggal" id="tgl_pembuatan" class="form-control" value="<?= date('m/d/Y'); ?>" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </form>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Bahan Pemasangan
                </div>
                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Spek</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($daftar_detail as $key => $value) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= date('d-m-Y', strtotime($value->tanggal)) ?></td>
                                    <td><?= $value->nama_produk ?></td>
                                    <td><?= $value->nama_kategori ?></td>
                                    <td><?= $value->singkatan ?></td>
                                    <td><?= $value->jumlah ?> (<?= $value->nama_satuan ?>)</td>
                                    <td><?= $value->keterangan ?></td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $value->id; ?>">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus2Modal<?= $value->id; ?>">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?php foreach ($daftar_detail as $value) : ?>
        <div class="modal fade" id="ubahModal<?= $value->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Bahan Pemasangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('bahan/pakai/ubah/' . $value->id) ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" max="<?= $value->stok; ?>" name="jumlah" id="jumlah" class="form-control" value="<?= $value->jumlah; ?>" required>
                                <input type="number" name="jumlahawal" id="jumlahawal" class="form-control" value="<?= $value->jumlah; ?>" hidden>
                                <input type="number" name="id_produk" id="id_produk" class="form-control" value="<?= $value->id_produk; ?>" hidden>
                                <input type="number" name="stok" id="stok" class="form-control" value="<?= $value->stok; ?>" hidden>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?= $value->keterangan; ?>" required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="tanggal">Tanggal</label>
                                <input type="text" name="tanggal" id="tgl_ubah<?= $value->id; ?>" class="form-control" value="<?= date('m/d/Y', strtotime($value->tanggal)); ?>" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm">ubah</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php foreach ($daftar_detail as $bahan) : ?>
        <div class="modal fade" id="hapus2Modal<?= $bahan->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Daftar Bahan Pemasangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('bahan/pakai/hapus/' . $bahan->id) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <p>
                                Yakin Data Bahan Pemasangan <br>
                                Produk : <strong> <?= $bahan->nama_kategori; ?> -> <?= $bahan->nama_produk; ?> (<?= $bahan->jumlah; ?> <?= $bahan->nama_satuan; ?>) </strong> , akan dihapus ?
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
    <?php endforeach; ?>
    <?= $this->endSection()  ?>

    <?= $this->Section('script') ?>
    <script type="text/javascript">
        $(function() {
            $(document).ready(function() {
                $('#tgl_pembuatan').datepicker({
                    format: 'mm/dd/yyyy',
                    todayHighlight: true,

                    language: "id",
                    locale: "id",
                });
            });
        });
        // Fungsi untuk membuat combobox searchable
        $(document).ready(function() {
            $("#id_produk").select2({
                placeholder: "-- Pilih Produk --",
                allowClear: true,
            });
        });

        $(document).ready(function() {
            $('#id_produk').change(function(e) {
                var selectedCategoryId = $(this).val();
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: "<?= base_url('produk/ambilProduk') ?>",
                    data: {
                        id_produk: selectedCategoryId
                    },
                    success: function(response) {
                        // Isi form dengan data barang yang diterima dari controller
                        $('#nama_kategori').val(response.nama_kategori);
                        $('#nama_subkate').val(response.nama_subkate);
                        $('#nama_satuan').val(response.nama_satuan);
                        $('#stok').val(response.stok);
                        $('#deskripsi').val(response.deskripsi);
                        // Isi elemen form lainnya sesuai dengan kebutuhan
                    }
                });

            });
        });
    </script>
    <?php foreach ($daftar_detail as $value) : ?>
        <script type="text/javascript">
            $(function() {
                $(document).ready(function() {
                    $('#tgl_ubah<?= $value->id; ?>').datepicker({
                        format: 'mm/dd/yyyy',
                        todayHighlight: true,

                        language: "id",
                        locale: "id",
                    });
                });
            });
        </script>

    <?php endforeach; ?>
    <?= $this->endSection() ?>