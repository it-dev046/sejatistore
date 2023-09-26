<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $title; ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item"><a href=" <?= base_url('penjualan') ?> ">Penjualan</a></li>
                <li class="breadcrumb-item active"><?= $title; ?> </li>
            </ol>
            <?php if (session('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session('success'); ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Cetak Nota Invoice</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?= base_url('cetak/' . $faktur->id . '/nota') ?>"></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-black mb-4">
                        <div class="card-body">Cetak Surat Jalan</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?= base_url('cetak/' . $faktur->id . '/suratjalan') ?>"></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Revisi Daftar Belanja</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?= base_url('kasir/' . $faktur->id . '/update') ?>"></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Batalkan Data Penjualan</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a type="button" class="small text-white stretched-link" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $faktur->id; ?>"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Data Pengiriman
                        </div>
                        <div class="card-body">
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Nama Pelanggan</div>
                                        <?= $faktur->penerima; ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Telepon (WA)</div>
                                        <?= $faktur->telepon; ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Alamat</div>
                                        <?= $faktur->alamat; ?>
                                    </div>
                                </li>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Kota</div>
                                        <?= $faktur->kota; ?>
                                    </div>
                                </li>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Kategori</div>
                                        <?= $faktur->nama_katepel; ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Pengiriman</div>
                                        <?= $faktur->nama_wilayah; ?>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Pembayaran Kasir
                        </div>
                        <div class="card-body">
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Total Sub</div>
                                        <?php
                                        $total = $faktur->total;
                                        $potongan = $faktur->potongan;
                                        $totaldetail = $total + $potongan; ?>
                                        <?= number_to_currency($totaldetail, 'IDR', 'id_ID', 2) ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Potongan Bayar</div>
                                        <?= number_to_currency($faktur->potongan, 'IDR', 'id_ID', 2) ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Ongkir</div>
                                        <?= number_to_currency($faktur->biaya, 'IDR', 'id_ID', 2) ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Total Pembayaran</div>
                                        <?= number_to_currency($faktur->total, 'IDR', 'id_ID', 2) ?>
                                    </div>
                                </li>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Jumlah Bayar</div>
                                        <?= number_to_currency($faktur->bayar, 'IDR', 'id_ID', 2) ?>
                                    </div>
                                </li>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Kembalian</div>
                                        ( <?= number_to_currency($faktur->kembalian, 'IDR', 'id_ID', 2) ?> )
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Belanja
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar Produk</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Spek</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($detail as $key => $value) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <img src="<?= base_url('foto/' . $value->gambar_produk) ?>" alt="" width="100px" height="100px">
                                    </td>
                                    <td><?= $value->nama_produk ?></td>
                                    <td><?= number_to_currency($value->harga, 'IDR', 'id_ID', 2) ?></td>
                                    <td><?= $value->singkatan ?></td>
                                    <td><?= $value->jumlah_produk ?> (<?= $value->nama_satuan ?>) </td>
                                    <td><?= number_to_currency($value->subtotal, 'IDR', 'id_ID', 2) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <div class="modal fade" id="hapusModal<?= $faktur->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Batalkan Penjualan Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('penjualan/' . $faktur->id . '/hapus') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <p>
                            Yakin Hapus Data Penjualan No Faktur : <strong><?= $faktur->id_trans; ?></strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?= $this->endSection()  ?>