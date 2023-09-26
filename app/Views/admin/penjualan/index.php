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
                            Daftar Penjualan Sejati Store
                        </div>

                        <div class="card-body">
                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>
                            <a class="btn btn-primary btn-sm mb-2" href="<?= base_url('kasir') ?>">
                                <i class="fas fa-plus"></i> Tambah
                            </a>
                            <a class="btn btn-warning btn-sm mb-2" target="_blank" href="<?= base_url('download/penjualan') ?>">
                                <i class="fas fa-print"></i> Export Excel
                            </a>
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Faktur</th>
                                        <th>Penerima</th>
                                        <th>Telepon</th>
                                        <th>Total Belanja</th>
                                        <th>Tanggal Input</th>
                                        <th>Aksi</th>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php $modal1 = 1; ?>
                                    <?php $modal2 = 1; ?>
                                    <?php foreach ($daftar_transaksi as $transkasi) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= $transkasi->id_trans; ?> </td>
                                            <td> <?= $transkasi->penerima; ?> </td>
                                            <td> <?= $transkasi->telepon; ?> </td>
                                            <td> <?= number_to_currency($transkasi->total, 'IDR', 'id_ID', 2) ?> </td>
                                            <td> <?= date('d/m/Y', strtotime($transkasi->tanggal_input)); ?> </td>
                                            <td width="30%" class="text-canter">
                                                <a class="btn btn-success btn-sm" href="<?= base_url('penjualan/' . $transkasi->id . '/preview') ?>">
                                                    <i class="fas fa-list"></i> Detail
                                                </a>
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

    <!-- Modal -->
    <?php
    foreach ($daftar_transaksi as $transaksi) : ?>
        <div class="modal fade" id="hapusModal<?= $transkasi->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus transaksi Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('penjualan/hapus/' . $transaksi->id) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="text" name="id_trans" value="<?= $transaksi->id_trans; ?>" hidden>
                            <p>
                                Yakin Data transaksi Produk : <?= $transaksi->penerima; ?>, akan dihapus ?
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

    <?= $this->endSection() ?>
    <?= $this->Section('script') ?>
    <?= $this->endSection() ?>