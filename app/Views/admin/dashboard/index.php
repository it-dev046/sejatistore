<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard Hari ini</h1>
            <ol class="breadcrumb mb-1">
            </ol>
            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        <strong>Pendapatan Hari ini</strong>
                                    </div>
                                    <?php if (empty($totalharian)) { ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Belum Ada Pembelian</div>
                                    <?php } else { ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_to_currency($totalharian, 'IDR', 'id_ID', 2) ?></div>
                                    <?php } ?>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><strong>Jumlah Hari ini</strong>
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahharian; ?> Pembeli</div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        <strong>Pendapatan Bulan ini</strong>
                                    </div>
                                    <?php if (empty($totalbulanan)) { ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Belum Ada Pembelian</div>
                                    <?php } else { ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_to_currency($totalbulanan, 'IDR', 'id_ID', 2) ?></div>
                                    <?php } ?>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        <strong>Jumlah Bulan Ini</strong>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahbulanan; ?> Transaksi</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Stok Barang
                </div>
                <div class="card-body">
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
                                <th>Deskripsi</th>
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
                                    <td> <?= $value['stok'] ?> <?= $value['nama_satuan'] ?></td>
                                    <td> <?= $value['deskripsi'] ?> </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <?= $this->endSection()  ?>