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
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Daftar Belanja Produk
                    </div>
                    <?php if (session('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session('success'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (session('error')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session('error'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <?php
                        $keranjang = $cart->contents();
                        if (empty($keranjang)) { ?>
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <h6>Daftar Masih Kosong, Silahkan Pilih Produk</h6>
                                </div>
                            </div>
                        <?php } else { ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" width="100px">Qty</th>
                                        <th scope="col">Satuan</th>
                                        <th scope="col">Spek</th>
                                        <th scope="col">Produk</th>
                                        <th scope="col">harga</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    echo form_open(base_url('kasir/update'));
                                    $no = 1;
                                    $tot_qty = 0;
                                    $diskon = ($cart->total() * $faktur->diskon_khusus) / 100;
                                    foreach ($keranjang as $key => $value) {
                                        $tot_qty = $tot_qty + $value['qty'];
                                    ?>
                                        <tr>
                                            <td>
                                                <input type="number" min="1" max="<?= $value['optional']['stok'] ?>" name="qty<?= $no++; ?>" class="form-control" value="<?= $value['qty'] ?>">
                                            </td>
                                            <td><?= $value['optional']['satuan'] ?></td>
                                            <td><?= $value['optional']['singkatan'] ?></td>
                                            <td><?= $value['name'] ?></td>
                                            <td><?= number_to_currency($value['price'], 'IDR', 'id_ID', 2) ?></td>
                                            <td><?= number_to_currency($value['subtotal'], 'IDR', 'id_ID', 2)  ?></td>
                                            <td>
                                                <a class="btn btn-danger btn-sm" href="<?= base_url('kasir/' . $value['rowid'] . '/delete') ?>"><i class="fas fa-trash"></i>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-6">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th>Total barang</th>
                                                <td><?= $tot_qty ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 50%;">Ongkir</th>
                                                <td><?= number_to_currency($faktur->biaya, 'IDR', 'id_ID', 2); ?></td>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th style="width: 50%;">Subtotal</th>
                                                <?php
                                                $totalawal = $faktur->biaya + $cart->total();
                                                ?>
                                                <td><?= number_to_currency($totalawal, 'IDR', 'id_ID', 2) ?></td>
                                                </th>
                                            </tr>
                                        </table>
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                                        <?php
                                        echo form_close(); ?>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="table-responsive">
                                        <table class="table">

                                            <form action="<?= base_url('kasir/potongan') ?>" method="post">
                                                <tr>
                                                    <th style="width: 50%;">Diskon <?= $faktur->diskon_khusus; ?> %</th>
                                                    <td>
                                                        (<?= number_to_currency($diskon, 'IDR', 'id_ID', 2) ?>)
                                                    </td>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>Potongan Rp</th>
                                                    <td>
                                                        <input type="number" class="form-control" name="potongan" id="potongan" value="<?= $faktur->potongan ?>">
                                                        <input type="text" class="form-control" name="id" id="id_faktur" value="<?= $faktur->id; ?>" hidden>
                                                    </td>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>Total Bayar</th>
                                                    <td>
                                                        <?php
                                                        if ($faktur->total <> $totalawal) { ?>
                                                            <?= number_to_currency($totalawal - $diskon, 'IDR', 'id_ID', 2) ?>
                                                        <?php } else { ?>
                                                            <?= number_to_currency($faktur->total, 'IDR', 'id_ID', 2) ?>
                                                        <?php } ?>
                                                        <input type="number" class="form-control" name="totsub" id="totsub" value="<?= $cart->total() ?>" hidden>
                                                        <input type="number" class="form-control" name="ongkir" id="ongkir" value="<?= $faktur->biaya ?>" hidden>
                                                        <input type="number" class="form-control" name="diskon" id="diskon" value="<?= $diskon ?>" hidden>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Terima Uang</th>
                                                    <td>
                                                        <input type="number" class="form-control" name="bayar" id="bayar" value="<?= $faktur->bayar ?>">
                                                    </td>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th style="width: 50%;">Kembalian</th>
                                                    <td>
                                                        ( <?= number_to_currency($faktur->kembalian, 'IDR', 'id_ID', 2) ?> )
                                                    </td>
                                                    </th>
                                                </tr>
                                        </table>
                                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Hitung Sekarang</button>
                                        <?php
                                        if ($faktur->total == 0) { ?>
                                        <?php } else { ?>
                                            <a href="<?= base_url('kasir/' . $faktur->id . '/simpan') ?>" class="btn btn-dark"><i class="fas fa-print"></i> Cetak Nota & Surat Jalan</a>
                                        <?php } ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <a class="btn btn-warning btn-block m-2" href="<?= base_url('kasir/clear') ?>">
                        <i class="fas fa-trash"></i> Kosongkan Keranjang
                    </a>
                    <a class="btn btn-danger btn-block m-2" href="<?= base_url('kasir/hapus/') ?>">
                        <i class="fas fa-trash"></i> Batalkan Penjualan
                    </a>
                </div>
                <?php echo form_close(); ?>
            </div>

            <div class="card mb-4">
                <div class="card-header"><i class="fas fa-list"></i>
                    Tambah Ke Keranjang
                </div>
                <div class="card-body">
                    <form action="<?= base_url('kasir/add') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="mb-3 mt-1">
                                <label for="id">
                                    <h6>Daftar Produk</h6>
                                </label>
                                <select id="id" name="id" class="form-control">
                                    <option value="">-- Pilih Produk --</option>
                                    <?php foreach ($daftar_produk as $produk) : ?>
                                        <option value="<?= $produk['id_produk']; ?>"><?= $produk['nama_produk']; ?> <?= $produk['singkatan']; ?> <?= $produk['nama_kategori']; ?> - <?= $produk['nama_subkate']; ?> (<?= $produk['stok']; ?> <?= $produk['nama_satuan']; ?>) <?= number_to_currency($produk['harga'], 'IDR', 'id_ID',) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3 col-2">
                                <label for="nama_kategori">
                                    <h6>Nama Produk</h6>
                                </label>
                                <input type="text" name="name" id="name" class="form-control" readonly required>
                            </div>
                            <div class="mb-3 col-1">
                                <label for="price">
                                    <h6>Stok</h6>
                                </label>
                                <input type="text" name="price" id="price" class="form-control" readonly hidden>
                                <input type="text" name="stok" id="stok" class="form-control" readonly required>
                            </div>
                            <div class="mb-3 col-1">
                                <label for="nama_kategori">
                                    <h6>Satuan</h6>
                                </label>
                                <input type="text" name="satuan" id="satuan" class="form-control" readonly required>
                            </div>
                            <div class="mb-3 col-2">
                                <label for="nama_subkate">
                                    <h6>Spek</h6>
                                </label>
                                <input type="text" name="singkatan" id="singkatan" class="form-control" readonly required>
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
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?= $this->endSection()  ?>

    <?= $this->Section('script') ?>
    <script type="text/javascript">
        // Fungsi untuk membuat combobox searchable
        $(document).ready(function() {
            $("#id").select2({
                placeholder: "-- Pilih Produk --",
                allowClear: true,
            });
        });

        $(document).ready(function() {
            $('#id').change(function(e) {
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
                        $('#price').val(response.harga);
                        $('#name').val(response.nama_produk);
                        $('#nama_subkate').val(response.nama_subkate);
                        $('#satuan').val(response.nama_satuan);
                        $('#stok').val(response.stok);
                        $('#singkatan').val(response.singkatan);
                        $('#deskripsi').val(response.deskripsi);
                        // Isi elemen form lainnya sesuai dengan kebutuhan
                    }
                });

            });
        });
    </script>
    <?= $this->endSection() ?>