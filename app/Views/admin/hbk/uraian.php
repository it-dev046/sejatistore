<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $title; ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard-drafter') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item"><a href=" <?= base_url('hbk') ?> ">Daftar HBK</a></li>
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
                    Daftar Pekerjaan
                </div>
                <div class="card-body">
                    <?php if (empty($cekbayar)) { ?>
                        <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    <?php } ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Uraian Pekerjaan</th>
                                <th>Volume</th>
                                <th>Harga</th>
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
                                    <td><?= $value->volume ?> <?= $value->ukuran ?></td>
                                    <td><?= number_to_currency($value->harga, 'IDR', 'id_ID') ?></td>
                                    <td><?= number_to_currency($value->biaya, 'IDR', 'id_ID') ?></td>
                                    <td>
                                        <?php if (empty($cekbayar)) { ?>
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $value->id; ?>">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $value->id; ?>">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <a class="btn btn-warning btn-block m-2" href="<?= base_url('hbk/uraian/cetak/' . $hbk->id_hbk) ?>">
                        <i class="fas fa-print"></i> Cetak HBK
                    </a>
                    <?php if (empty($cekbayar)) { ?>
                        <a class="btn btn-dark btn-block m-2" href="<?= base_url('hbk/uraian/batal/' . $hbk->id_hbk) ?>">
                            <i class="fas fa-trash"></i> Batalkan
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
                                        <div class="fw-bold">Pemasangan</div>
                                        <?= $invoice->nama; ?> - <?= $invoice->alamat; ?> ( <?= $invoice->keterangan; ?> )
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Drafter</div>
                                        <?= $invoice->drafter; ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Tim Lapangan</div>
                                        <?= $hbk->tukang; ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Pengawas</div>
                                        <?= $hbk->pengawas; ?>
                                    </div>
                                </li>
                            </ol>
                        </div>
                        <a class="btn btn-secondary btn-block m-2" href="<?= base_url('rekap/detail/' . $invoice->id_pasang) ?>">
                            <i class="fas fa-list"></i> Rincian Biaya Pemasangan
                        </a>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Data Pemborong
                        </div>
                        <div class="card-body">
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">No HBK Pemasangan</div>
                                        <?= $hbk->no_hbk; ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Tanggal Terbit HBK</div>
                                        <?= date('d-m-Y', strtotime($hbk->tanggal_input)) ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Total Biaya</div>
                                        <?php if (!empty($jumlahbiaya)) { ?>
                                            <?= number_to_currency($jumlahbiaya, 'IDR', 'id_ID') ?>
                                        <?php } else { ?>
                                            <?= $jumlahbiaya; ?>
                                        <?php } ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Total Pembulatan</div>
                                        <?php if (!empty($hbk->total_hbk)) { ?>
                                            <?= number_to_currency($hbk->total_hbk, 'IDR', 'id_ID') ?>
                                        <?php } else { ?>
                                            <?= $hbk->total_hbk; ?>
                                        <?php } ?>
                                    </div>
                                </li>
                            </ol>
                        </div>
                        <button type="button" class="btn btn-info btn-block m-2" data-bs-toggle="modal" data-bs-target="#updateModal">
                            <i class="fas fa-edit"></i> Refisi Total Pembulatan
                        </button>
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
                    <form action="<?= base_url('hbk/uraian/tambah') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_hbk" id="id_hbk" value="<?= $hbk->id_hbk; ?>" class="form-control" required>
                        <div class="mb-3">
                            <label for="uraian">Uraian Pengerjaan</label>
                            <select name="uraian" id="uraian" class="form-control">
                                <option value="" hidden>--Pilih--</option>
                                <!-- panggil data kategori -->
                                <?php foreach ($uraian_kerja as $value) : ?>
                                    <option value="<?= $value->nama; ?> ( <?= $value->nama_sub; ?> )"> <?= $value->nama; ?> ( <?= $value->nama_sub; ?> )</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="volume">Jumlah</label>
                            <input type="text" name="volume" id="volume" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="ukuran">Satuan Ukur</label>
                            <select name="ukuran" id="ukuran" class="form-control">
                                <option value="" hidden>--Pilih--</option>
                                <!-- panggil data kategori -->
                                <?php foreach ($ukuran as $value) : ?>
                                    <option value="<?= $value->nama; ?>"> <?= $value->keterangan; ?> -> <?= $value->nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="biaya">Harga Satuan</label>
                            <input type="number" min=1 name="harga" id="harga" class="form-control" required>
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
                        <form action=" <?= base_url('hbk/uraian/ubah/' . $value->id) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id_hbk" id="id_hbk" value="<?= $value->id_hbk; ?>" class="form-control" required>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="uraian">Uraian Pekerjaan</label>
                                <select name="uraian" id="uraian" class="form-control">
                                    <option value="<?= $value->uraian ?>" hidden>--<?= $value->uraian ?>--</option>
                                    <!-- panggil data kategori -->
                                    <?php foreach ($uraian_kerja as $kerja) : ?>
                                        <option value="<?= $kerja->nama; ?> ( <?= $kerja->nama_sub; ?> )"> <?= $kerja->nama; ?> ( <?= $kerja->nama_sub; ?> )</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="volume">volume</label>
                                <input type="text" name="volume" id="volume" class="form-control" value="<?= $value->volume; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="ukuran">Satuan Ukur</label>
                                <select name="ukuran" id="ukuran" class="form-control">
                                    <option value="<?= $value->ukuran ?>" hidden>--<?= $value->ukuran ?>--</option>
                                    <!-- panggil data kategori -->
                                    <?php foreach ($ukuran as $satuan) : ?>
                                        <option value="<?= $satuan->nama; ?>" <?= $value->ukuran == $satuan->nama ? 'selected' : null ?>> <?= $satuan->nama; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="harga">Harga Satuan</label>
                                <input type="number" name="harga" id="harga" class="form-control" value="<?= $value->harga; ?>" required>
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
                        <form action=" <?= base_url('hbk/uraian/hapus/' . $value->id) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id_hbk" id="id_hbk" value="<?= $hbk->id_hbk; ?>" class="form-control" required>
                            <p>
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <tr>
                                        <td colspan="2" scope="row">Yakin Data Uraian Pemasangan</td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="100px">Uraian Pekerjaan</td>
                                        <td> : <strong><?= $value->uraian; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="100px">volume</td>
                                        <td> : <strong><?= $value->volume; ?> <?= $value->ukuran; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="100px">biaya</td>
                                        <td> : <strong><?= number_to_currency($value->biaya, 'IDR', 'id_ID') ?></strong></td>
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
    <div class="modal fade" id="hapusModalpasang<?= $invoice->id_pasang; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash-alt"></i> Hapus HBK Pemasangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('rekap/hapus/' . $invoice->id_pasang) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="gambar" value="<?= $invoice->gambar; ?>">
                        <p>
                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td colspan="2" scope="row">Yakin Data HBK Pemasangan </td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">No Invoice</td>
                                    <td> : <strong><?= $invoice->invoice; ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Pelaggan</td>
                                    <td> : <strong><?= $invoice->nama; ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Lokasi</td>
                                    <td> : <strong><?= $invoice->alamat; ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Tanggal</td>
                                    <td> : <strong><?= date('d-m-Y', strtotime($invoice->tanggal)) ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Total Deal</td>
                                    <td> : <strong><?= number_to_currency($invoice->biaya, 'IDR', 'id_ID') ?></strong></td>
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

    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Refisi Total Pembulatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('hbk/uraian/total/' . $hbk->id_hbk) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">
                        <div class="mb-3">
                            <label for="total_hbk">Total HBK</label>
                            <input type="text" name="total_hbk" id="total_hbk" class="form-control" value="<?= $hbk->total_hbk; ?>" required>
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
    <?= $this->endSection()  ?>