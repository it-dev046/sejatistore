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
                            Daftar Produk
                        </div>
                        <div class="card-body">
                            <a class="btn btn-primary btn-sm mb-2" href="produk/tambah/">
                                <i class="fas fa-plus"></i> Tambah Produk
                            </a>
                            <a class="btn btn-secondary btn-sm mb-2" target="_blank" href="<?= base_url('cetak/stok') ?>">
                                <i class="fas fa-print"></i> Cetak Stok
                            </a>
                            <a class="btn btn-warning btn-sm mb-2" target="_blank" href="<?= base_url('download/produk') ?>">
                                <i class="fas fa-print"></i> Export Excel
                            </a>
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
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Sub Kategori</th>
                                        <th>Spek</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Edit</th>
                                        <th>Hapus</th>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($daftar_produk as $key => $value) { ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= $value['nama_produk'] ?> </td>
                                            <td> <?= $value['nama_kategori'] ?> </td>
                                            <td> <?= $value['nama_subkate'] ?> </td>
                                            <td> <?= $value['singkatan'] ?> </td>
                                            <td> <?= number_to_currency($value['harga'], 'IDR', 'id_ID', 2) ?> </td>
                                            <td> <?= $value['stok'] ?> <?= $value['nama_satuan'] ?> </td>
                                            <td>
                                                <a class="btn btn-success btn-sm" href="<?= base_url('produk/' . $value['id_produk'] . '/preview') ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $value['id_produk'] ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
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

    <?php foreach ($daftar_produk as $key => $value) { ?>
        <div class="modal fade" id="hapusModal<?= $value['id_produk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Kategori Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('produk/hapus/' . $value['id_produk']) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="gambar" value="<?= $value['gambar_produk'] ?>">
                            <p>
                                Yakin Data Kategori Produk : <?= $value['nama_produk'] ?>, akan dihapus ?
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
    <?php } ?>

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
        $('#preview_gambar').change(function() {
            bacaGambar(this);
        });

        function printPage() {
            window.print();
        };
    </script>
    <?= $this->endSection() ?>