<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> <?= $title; ?> </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard-drafter') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item active"> <?= $title; ?> </li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Order Barang
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
                                        <th>Tanggal</th>
                                        <th>Pemesan</th>
                                        <th>Penerima</th>
                                        <th>Pekerjaan</th>
                                        <th>Status</th>
                                        <th>Orderan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($daftar_order as $order) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= date('d M Y', strtotime($order->tanggal)); ?></td>
                                            <td> <?= $order->pemesan; ?> </td>
                                            <td> <?= $order->penerima; ?> </td>
                                            <td> <?= $order->kerja; ?> <br> ( <?= $order->keterangan; ?> ) </td>
                                            <td>
                                                <?php if ($order->bukti <> "Belum") { ?>
                                                    <a href="<?= base_url('order/nota/gambar/' . $order->id_order) ?>" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-list-alt"></i>
                                                    </a>
                                                    <a href="<?= base_url('order/bukti/gambar/' . $order->id_order) ?>" class="btn btn-dark btn-sm">
                                                        <i class="fas fa-file"></i>
                                                    </a>
                                                <?php } elseif ($order->nota <> "Belum") { ?>
                                                    <a href="<?= base_url('order/nota/gambar/' . $order->id_order) ?>" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-list-alt"></i>
                                                    </a>
                                                <?php } else { ?>
                                                    <?= $order->status; ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php
                                                $no = 1;
                                                foreach ($daftar_uraian as $key => $value) {
                                                    if ($value->id_order == $order->id_order) { ?>
                                                        <?= $no++; ?> . <?= $value->nama ?> ( <?= $value->jumlah ?> ) <br>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                            <td class="text-canter">
                                                <a href="<?= base_url('order/uraian/' . $order->id_order) ?>" class="btn btn-info btn-sm">
                                                    <i class="fas fa-list"></i>
                                                </a><br>
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $order->id_order; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button><br>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $order->id_order; ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Order Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('order/tambah') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="pemesan">Pemesan</label>
                            <input type="text" name="pemesan" id="pemesan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="penerima">Penerima</label>
                            <input type="text" name="penerima" id="penerima" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="kerja">Pekerjaan</label>
                            <input type="text" name="kerja" id="kerja" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control" required>
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

    <?php foreach ($daftar_order as $order) : ?>
        <div class="modal fade" id="ubahModal<?= $order->id_order; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Order Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('order/ubah/' . $order->id_order) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="mb-3">
                                <label for="pemesan">Pemesanan</label>
                                <input type="text" name="pemesan" id="pemesan" class="form-control" value="<?= $order->pemesan; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="penerima">Penerima</label>
                                <input type="text" name="penerima" id="penerima" class="form-control" value="<?= $order->penerima; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="kerja">Pekerjaan</label>
                                <input type="text" name="kerja" id="kerja" class="form-control" value="<?= $order->kerja; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?= $order->keterangan; ?>" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm">Ubah</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
</div>
<?php endforeach; ?>

<?php foreach ($daftar_order as $order) : ?>
    <div class="modal fade" id="hapusModal<?= $order->id_order; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Order Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('order/hapus/' . $order->id_order) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <p>
                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td colspan="2" scope="row">Yakin Data pembayaran HBK</td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">tanggal</td>
                                    <td> : <strong><?= date('d M Y', strtotime($order->tanggal)); ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">pemesan</td>
                                    <td> : <strong><?= $order->pemesan; ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">penerima</td>
                                    <td> : <strong><?= $order->penerima; ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Keterangan</td>
                                    <td> : <strong><?= $order->keterangan; ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                        </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection() ?>
<?= $this->Section('script') ?>
<?= $this->endSection() ?>