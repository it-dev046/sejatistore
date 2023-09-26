<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $title; ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard-drafter') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item"><a href=" <?= base_url('order') ?> ">Daftar Order</a></li>
                <li class="breadcrumb-item active"><?= $title; ?> </li>
            </ol>
            <?php if (session('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session('success'); ?>
                </div>
            <?php endif; ?>
            <?php if (session('error')) : ?>
                <div class="alert alert-error" role="alert">
                    <?= session('error'); ?>
                </div>
            <?php endif; ?>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Detail Order
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
                        <i class="fas fa-plus"></i> Tambah
                    </button>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Spek</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($daftar_uraian as $key => $value) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $value->nama ?></td>
                                    <td><?= $value->spek ?></td>
                                    <td><?= $value->jumlah ?></td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $value->id; ?>">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $value->id; ?>">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Data Order
                        </div>
                        <div class="card-body">
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Tanggal Order</div>
                                        <?= date('d F Y', strtotime($order->tanggal)) ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Pemesan</div>
                                        <?= $order->pemesan; ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Penerima</div>
                                        <?= $order->penerima; ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Pekerjaan</div>
                                        <?= $order->kerja; ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">keterangan</div>
                                        <?= $order->keterangan; ?>
                                    </div>
                                </li>
                            </ol>
                        </div>
                        <a class="btn btn-secondary btn-block m-2" href="<?= base_url('order') ?>">
                            <i class="fas fa-list"></i> Daftar Order
                        </a>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Informasi
                        </div>
                        <div class="card-body">
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Nama Toko</div>
                                        <?php if (!empty($order->toko)) {  ?>
                                            <?= $order->toko; ?>
                                        <?php } else {  ?>
                                            Belum diorder
                                        <?php } ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <?php if ($order->nota == "Belum") {  ?>
                                            <div class="fw-bold">Nota Orderan</div>
                                            <?= $order->nota; ?>
                                        <?php } else {  ?>
                                            <div class="fw-bold">
                                                <a href="<?= base_url('order/nota/gambar/' . $order->id_order) ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-download"></i> Nota Orderan
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto"><?php if ($order->bukti == "Belum") {  ?>
                                            <div class="fw-bold">Bukti Transfer</div>
                                            <?= $order->bukti; ?>
                                        <?php } else {  ?>
                                            <div class="fw-bold">
                                                <a href="<?= base_url('order/bukti/gambar/' . $order->id_order) ?>" class="btn btn-info btn-sm">
                                                    <i class="fas fa-download"></i> Bukti Transfer
                                                </a>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </li>
                            </ol>
                        </div>
                        <?php if ($level == 1) { ?>
                            <button type="button" class="btn btn-warning btn-block m-2" data-bs-toggle="modal" data-bs-target="#notaModal">
                                <i class="fas fa-upload"></i> Upload Nota Toko
                            </button>
                        <?php } elseif ($level == 2) { ?>
                            <button type="button" class="btn btn-info btn-block m-2" data-bs-toggle="modal" data-bs-target="#buktiModal">
                                <i class="fas fa-upload"></i> Upload Bukti Transfer
                            </button>
                        <?php } else { ?>
                        <?php } ?>
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Detail Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('order/uraian/tambah') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                        <input type="text" name="id_order" id="id_order" class="form-control" value="<?= $order->id_order; ?>" hidden>
                        <div class="mb-3">
                            <label for="nama">Nama Barang</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="spek">Spek</label>
                            <textarea name="spek" id="spek" cols="15" rows="3" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" required>
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

    <div class="modal fade" id="notaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Upload Nota Toko</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('order/nota/' . $order->id_order) ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="text" name="notalama" id="notalama" class="form-control" value="<?= $order->nota; ?>" hidden>
                        <input type="text" name="status" id="status" class="form-control" value="Proses" hidden>
                        <?= csrf_field() ?>
                        <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                        <div class="mb-3">
                            <label for="toko">Nama Toko</label>
                            <input type="text" name="toko" id="toko" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="nota">Upload Nota</label>
                            <input type="file" name="nota" id="nota" class="form-control" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning btn-sm">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="buktiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Upload Bukti Transfer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('order/bukti/' . $order->id_order) ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="text" name="buktilama" id="buktilama" class="form-control" value="<?= $order->bukti; ?>" hidden>
                        <input type="text" name="status" id="status" class="form-control" value="ACC" hidden>
                        <?= csrf_field() ?>
                        <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                        <div class="mb-3">
                            <label for="bukti">Upload Bukti Transfer</label>
                            <input type="file" name="bukti" id="bukti" class="form-control" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info btn-sm">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <?php foreach ($daftar_uraian as $value) : ?>
        <div class="modal fade" id="ubahModal<?= $value->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Detail Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('order/uraian/ubah/' . $value->id) ?>" method="post">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="nama">Nama Barang</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="<?= $value->nama; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="spek">Spek</label>
                                <textarea name="spek" id="spek" cols="15" rows="3" class="form-control" required><?= $value->spek; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control" value="<?= $value->jumlah; ?>" required>
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
    <?php endforeach; ?>

    <?php foreach ($daftar_uraian as $value) : ?>
        <div class="modal fade" id="hapusModal<?= $value->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash-alt"></i> Hapus Uraian Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('order/uraian/hapus/' . $value->id) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                            <input type="hidden" name="id_order" value="<?= $order->id_order; ?>">
                            <p>
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <tr>
                                        <td colspan="2" scope="row">Yakin Data Detail Order</td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="120px">Nama Barang</td>
                                        <td> : <strong><?= $value->nama ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="100px">Spek</td>
                                        <td> : <strong><?= $value->spek; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="100px">Jumlah</td>
                                        <td> : <strong><?= $value->jumlah; ?></strong></td>
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
    <?php endforeach; ?>
    <?= $this->endSection()  ?>