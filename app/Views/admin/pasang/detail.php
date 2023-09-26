<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $title; ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard-admin') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item"><a href=" <?= base_url('invoice') ?> ">Pemasangan</a></li>
                <li class="breadcrumb-item active"><?= $title; ?> </li>
            </ol>
            <?php if (session('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session('success'); ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Cetak Invoice</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a type="button" class="small text-white stretched-link" href="<?= base_url('invoice/uraian/cetak/' . $invoice->id_pasang) ?>""></a>
                        </div>
                    </div>
                </div>
                <div class=" col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Batalkan Data Penjualan</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a type="button" class="small text-white stretched-link" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $invoice->id_pasang; ?>"></a>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Pembayaran
                        </div>
                        <div class="card-body">
                            <?php if ($invoice->biaya == $jumlahterbayar) { ?>
                            <?php } else { ?>
                                <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            <?php } ?>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Kwitansi</th>
                                        <th>Tanggal</th>
                                        <th>Pembayaran</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($daftar_bayar as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $value->kwitansi; ?></td>
                                            <td><?= date('d-m-Y', strtotime($value->tanggal)) ?></td>
                                            <td><?= number_to_currency($value->bayar, 'IDR', 'id_ID', 2) ?></td>
                                            <td><?= $value->keterangan ?></td>
                                            <td>
                                                <a href="<?= base_url('invoice/kwitansi/cetak/' . $value->id) ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-print"></i> Kwitansi
                                                </a>
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
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Pembayaran Invoice
                                </div>
                                <div class="card-body">
                                    <ol class="list-group list-group-numbered">
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">Jumlah Terbayar</div>
                                                <?php if ($jumlahterbayar == 0) { ?>
                                                    Pembayaran Tidak ada
                                                <?php } else { ?>
                                                    <?= number_to_currency($jumlahterbayar, 'IDR', 'id_ID', 2) ?>
                                                <?php } ?>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">Total Pembayaran</div>
                                                <?= number_to_currency($invoice->biaya, 'IDR', 'id_ID', 2) ?>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">Sisa Pembayaran </div>
                                                <?= number_to_currency($invoice->sisa, 'IDR', 'id_ID', 2) ?>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">Status</div>
                                                <?php if ($invoice->biaya == $jumlahterbayar) { ?>
                                                    <font color="green"><strong>-- Lunas --</strong></font>
                                                <?php } else { ?>
                                                    <font color="red"><strong>-- Kredit --</strong></font>
                                                <?php } ?>
                                            </div>
                                        </li>
                                    </ol>
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Pemasangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('invoice/bayar') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="tanggal">Tanggal Pemasangan</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="bayar">Nominal Pembayaran</label>
                            <input type="text" name="id_pasang" id="id_pasang" class="form-control" value="<?= $invoice->id_pasang; ?>" hidden>
                            <?php if ($invoice->sisa == 0) { ?>
                                <input type="text" name="biaya" id="biaya" class="form-control" value="<?= $invoice->biaya; ?>" hidden>
                            <?php } else { ?>
                                <input type="text" name="biaya" id="biaya" class="form-control" value="<?= $invoice->sisa; ?>" hidden>
                            <?php } ?>
                            <input type="number" name="bayar" id="bayar" class="form-control" required>
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

    <?php foreach ($daftar_bayar as $bayar) : ?>
        <div class="modal fade" id="hapus2Modal<?= $bayar->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Daftar Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('invoice/bayar/hapus/' . $bayar->id) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <p>
                                Yakin Data pembayaran tanggal : <?= date('d-m-Y', strtotime($bayar->tanggal)) ?><br>
                                Sebesar <?= number_to_currency($value->bayar, 'IDR', 'id_ID', 2) ?>, akan dihapus ?
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

    <div class="modal fade" id="hapusModal<?= $invoice->id_pasang; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Batalkan Pemasangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="  <?= base_url('invoice/hapus/' . $invoice->id_pasang) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <p>
                            Yakin Hapus Data Pemasangan dengan No invoic : <strong><?= $invoice->invoice; ?></strong></p>
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