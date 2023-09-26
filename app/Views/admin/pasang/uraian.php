<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $title; ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard-admin') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item"><a href=" <?= base_url('invoice') ?> ">Pemasangan</a></li>
                <li class="breadcrumb-item"><a href=" <?= base_url('invoice/' . $invoice->id_pasang . '/preview') ?> ">Detail</a></li>
                <li class="breadcrumb-item active"><?= $title; ?> </li>
            </ol>
            <?php if (session('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session('success'); ?>
                </div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Uraian
                </div>
                <div class="card-body">
                    <?php if ($invoice->biaya == $jumlahterbiaya) { ?>
                    <?php } else { ?>
                        <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    <?php } ?>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Uraian Pekerjaan</th>
                                <th>Keterangan</th>
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
                                    <td><?= $value->uraian ?></td>
                                    <td><?= $value->keterangan ?></td>
                                    <td><?= number_to_currency($value->biaya, 'IDR', 'id_ID', 2) ?></td>
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
                    <?php if ($invoice->biaya > 0) { ?>
                        <a class="btn btn-warning btn-block m-2" href="<?= base_url('invoice/uraian/cetak/' . $invoice->id_pasang) ?>">
                            <i class="fas fa-print"></i> Cetak Invoice
                        </a>
                    <?php } ?>
                    <?php if ($jumlahterbiaya > 0) { ?>
                        <a class="btn btn-dark btn-block m-2" href="<?= base_url('invoice/uraian/batal/' . $invoice->id_pasang) ?>">
                            <i class="fas fa-trash"></i> Batalkan Uraian
                        </a>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Data Pemasangan
                        </div>
                        <div class="card-body">
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Tanggal Pemasangan</div>
                                        <?= date('d-m-Y', strtotime($invoice->tanggal)) ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Nama Pemasangan</div>
                                        <?= $invoice->nama; ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Alamat</div>
                                        <?= $invoice->alamat; ?>
                                    </div>
                                </li>
                            </ol>
                        </div>
                        <a class="btn btn-secondary btn-block m-2" href="<?= base_url('invoice') ?>">
                            <i class="fas fa-list"></i> Daftar Pemasangan
                        </a>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Pembayaran
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Pembayaran</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($daftar_bayar as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= date('d-m-Y', strtotime($value->tanggal)) ?></td>
                                            <td><?= number_to_currency($value->bayar, 'IDR', 'id_ID', 2) ?></td>
                                            <td><?= $value->keterangan ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <a class="btn btn-secondary btn-block m-2" href="<?= base_url('invoice/' . $invoice->id_pasang . '/preview') ?>">
                            <i class="fas fa-edit"></i> Edit Pembayaran
                        </a>
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Uraian Pemasangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('invoice/uraian/tambah') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="uraian">Uraian Pengerjaan</label>
                            <input type="text" name="uraian" id="uraian" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="biaya">Nilai Pengerjaan</label>
                            <input type="text" name="id_pasang" id="id_pasang" class="form-control" value="<?= $invoice->id_pasang; ?>" hidden>
                            <input type="number" name="biaya" id="biaya" class="form-control" required>
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

    <?php foreach ($daftar_uraian as $value) : ?>
        <div class="modal fade" id="ubahModal<?= $value->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Uraian Pekerjaan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('invoice/uraian/ubah/' . $value->id) ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="uraian">Uraian Pekerjaan</label>
                                <input type="text" name="uraian" id="uraian" class="form-control" value="<?= $value->uraian; ?>" required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?= $value->keterangan; ?>" required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="biaya">Biaya</label>
                                <input type="number" name="biaya" id="biaya" class="form-control" value="<?= $value->biaya; ?>" required>
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
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash-alt"></i> Hapus Uraian Pemasangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('invoice/uraian/hapus/' . $value->id) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <p>
                                Yakin Data Uraian Pemasangan : <font color="red"><strong><?= $value->uraian; ?></strong></font> , akan dihapus ?
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