<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $title; ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= $title; ?> </li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Pilih Produk
                </div>
                <?php if (session('success')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session('success'); ?>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th scope="row">#</th>
                                <th>Nama Produk</th>
                                <th>Gambar</th>
                                <th>Kategori</th>
                                <th>Sub Kategori</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th scope="row">#</th>
                                <th>Nama Produk</th>
                                <th>Gambar</th>
                                <th>Kategori</th>
                                <th>Sub Kategori</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($daftar_produk as $key => $value) { ?>
                                <tr>
                                    <th scope="row"> <?= $no++; ?></th>
                                    <td><?= $value['nama_produk'] ?></td>
                                    <td>
                                        <img src="<?= base_url('foto/' . $value['gambar_produk']) ?>" alt="" width="100px" height="100px">
                                    </td>
                                    <td><?= $value['nama_kategori'] ?></td>
                                    <td><?= $value['nama_subkate'] ?></td>
                                    <td><?= $value['nama_satuan'] ?></td>
                                    <td><?= number_to_currency($value['harga'], 'IDR', 'id_ID', 2) ?></td>
                                    <td><?= $value['stok'] ?></td>
                                    <?php if (empty($value['stok'])) { ?>
                                        <td></td>
                                    <?php } else { ?>
                                        <td>
                                            <?php
                                            echo form_open(base_url('/KasirController/add'));
                                            echo form_hidden('id', $value['id_produk']);
                                            echo form_hidden('price', $value['harga']);
                                            echo form_hidden('name', $value['nama_produk']);
                                            echo form_hidden('stok', $value['stok']);
                                            echo form_hidden('satuan', $value['nama_satuan']);
                                            ?>
                                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></button>
                                            <?php echo form_close(); ?>
                                            </button>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <?php
                    echo form_open(base_url('/KasirController/update')); ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Daftar Belanja Produk
                        </div>
                        <div class="card-body">
                            <?php
                            $keranjang = $cart->contents();
                            if (empty($keranjang)) { ?>
                                <div class="row justify-content-center">
                                    <div class="col-8">
                                        <h6>Daftar Masih Kosong, Silahkan Pilih Produk</h6>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="100px">Qty</th>
                                            <th scope="col">Satuan</th>
                                            <th scope="col">Produk</th>
                                            <th scope="col">harga</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $tot_qty = 0;
                                        foreach ($keranjang as $key => $value) {
                                            $tot_qty = $tot_qty + $value['qty'];
                                        ?>
                                            <tr>
                                                <td>
                                                    <input type="number" min="1" max="<?= $value['optional']['stok'] ?>" name="qty<?= $no++; ?>" class="form-control" value="<?= $value['qty'] ?>">
                                                </td>
                                                <td><?= $value['optional']['satuan'] ?></td>
                                                <td><?= $value['name'] ?></td>
                                                <td><?= number_to_currency($value['price'], 'IDR', 'id_ID', 2) ?></td>
                                                <td><?= number_to_currency($value['subtotal'], 'IDR', 'id_ID', 2)  ?></td>
                                                <td>
                                                    <a class="btn btn-danger btn-sm" href="KasirController/delete/<?= $value['rowid'] ?>"><i class="fas fa-trash"></i>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div class="col-6">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width: 50%;">Subtotal</th>
                                                <td><?= number_to_currency($cart->total(), 'IDR', 'id_ID', 2) ?></td>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Total barang</th>
                                                <td><?= $tot_qty ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row no-print">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                                    <a class="btn btn-warning" href="KasirController/clear">
                                        <i class="fas fa-trash"></i> Kosongkan Keranjang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>

                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Detail Pelanggan
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <div class="card">
                                        <button type="submit" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#tambahModal">Cari Pelanggan</button>
                                        <div class="card-body">
                                            <form action="KasirController/simpanfaktur" method="post" enctype="multipart/form-data">
                                                <?= csrf_field() ?>
                                                <input type="int" id="id_pel" name="id_pel" class="form-control" hidden>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">Nama </th>
                                                            <td><input type="text" id="nama_pel" name="penerima" class="form-control"></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Kategori</th>
                                                            <td><input type="text" id="nama_katepel" name="nama_katepel" class="form-control"></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Telepon / WhatsApp</th>
                                                            <td><input type="text" name="telepon" id="telepon" class="form-control"></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Alamat Pengantaran</th>
                                                            <td><textarea name="alamat" id="alamat" cols="10" rows="4" class="form-control"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Pengiriman</th>
                                                            <td>
                                                                <select name="pengiriman" id="pengiriman" class="form-control">
                                                                    <option value="">--Pilih Pengiriman--</option>
                                                                    <option value="antar">Pengantaran</option>
                                                                    <option value="ambil">Ambil Sendiri</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="table">
                                                    <tbody>
                                                        <th scope="row">Ongkir</th>
                                                        <td style="width: 310px;">
                                                            <input type="number" id="ongkir" name="ongkir" class="form-control">
                                                        </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-block">Cetak Nota</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Pelanggan Baru</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?= base_url('pelanggan') ?>">Lengkapi data</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Produk Baru</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?= base_url('produk/tambah') ?>">Isi data Produk</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-black mb-4">
                        <div class="card-body">Cari Penjualan</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-black stretched-link" href="#">Liat Daftar</a>
                            <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Barang Kembali</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">Perbarui Stok</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Pilih Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pelanggan</th>
                                <th>No Telepon</th>
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
                                    <td> <?= $value['nama_katepel'] ?> </td>
                                    <td class="text-canter">
                                        <button type="button" class="btn btn-success btn-sm" id="select" data-id="<?= $value['id_pel'] ?>" data-nama="<?= $value['nama_pel'] ?>" data-katepel="<?= $value['nama_katepel'] ?>" data-alamat="<?= $value['alamat'] ?>" data-kota="<?= $value['kota'] ?>" data-telepon="<?= $value['telepon'] ?>">
                                            <i class="fas fa-plus"></i>
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
    <?= $this->endSection()  ?>
    <?= $this->Section('script') ?>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#select', function() {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var telepon = $(this).data('telepon');
                var kota = $(this).data('kota');
                var alamat = $(this).data('alamat');
                var nama_katepel = $(this).data('katepel');
                $("#id_pel").val(id);
                $("#nama_pel").val(nama);
                $("#telepon").val(telepon);
                $("#alamat").val(alamat);
                $("#kota").val(kota);
                $("#nama_katepel").val(nama_katepel);
            })
        });
    </script>
    <?= $this->endSection() ?>