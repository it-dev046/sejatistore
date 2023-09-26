<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $title; ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard-drafter') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item"><a href=" <?= base_url('survei') ?> ">Daftar Survei</a></li>
                <li class="breadcrumb-item active"><?= $title; ?> </li>
            </ol>
            <?php if (session('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session('success'); ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <?php if (!empty($survei->status)) { ?>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">Buat Rekap Pemasangan</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" data-bs-toggle="modal" data-bs-target="#tambahModal2"></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Pekerjaan
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
                        <i class="fas fa-plus"></i> Tambah
                    </button>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Uraian Pengerjaan</th>
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
                                    <td><?= $value->nama ?> ( <?= $value->nama_sub ?> )</td>
                                    <td><?= $value->volume ?> <?= $value->ukuran ?></td>
                                    <?php if (!empty($value->harga)) { ?>
                                        <td><?= number_to_currency($value->harga, 'IDR', 'id_ID') ?></td>
                                    <?php } else { ?>
                                        <td><?= $value->harga ?></td>
                                    <?php } ?>
                                    <?php if (!empty($value->biaya)) { ?>
                                        <td><?= number_to_currency($value->biaya, 'IDR', 'id_ID') ?></td>
                                    <?php } else { ?>
                                        <td><?= $value->biaya ?></td>
                                    <?php } ?>
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
                    <a class="btn btn-warning btn-block m-2" href="<?= base_url('survei/uraian/cetak/' . $survei->id_survei) ?>">
                        <i class="fas fa-print"></i> Cetak Pengajuan
                    </a>
                    <?php if ($totalbiaya > 0) { ?>
                        <a class="btn btn-dark btn-block m-2" href="<?= base_url('survei/uraian/batal/' . $survei->id_survei) ?>">
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
                                        <?= date('d F Y', strtotime($survei->tanggal)) ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Nama Pemasangan</div>
                                        <?= $survei->pelanggan; ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Alamat</div>
                                        <?= $survei->alamat; ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Surveyor</div>
                                        <?= $survei->pengukur; ?>
                                    </div>
                                </li>
                            </ol>
                        </div>
                        <a class="btn btn-secondary btn-block m-2" href="<?= base_url('rekap') ?>">
                            <i class="fas fa-list"></i> Daftar Pemasangan
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
                                        <div class="fw-bold">Total Biaya</div>
                                        <?php if (!empty($totalbiaya)) {  ?>
                                            <?= number_to_currency($totalbiaya, 'IDR', 'id_ID') ?>
                                        <?php } else {  ?>
                                            Belum ada pekerjaan
                                        <?php } ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Total Pengajuan</div>
                                        <?php if (!empty($survei->biaya)) {  ?>
                                            <?= number_to_currency($survei->biaya, 'IDR', 'id_ID') ?>
                                        <?php } else {  ?>
                                            Belum ada pekerjaan
                                        <?php } ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Tim Lapangan</div>
                                        <?php if (!empty($survei->tukang)) {  ?>
                                            <?= $survei->tukang; ?>
                                        <?php } else {  ?>
                                            Belum Deal
                                        <?php } ?>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Keterangan</div>
                                        <?= $survei->keterangan; ?>
                                    </div>
                                </li>
                            </ol>
                        </div>
                        <button type="button" class="btn btn-info btn-block m-2" data-bs-toggle="modal" data-bs-target="#updateModal">
                            <i class="fas fa-edit"></i> Refisi Total Pengajuan
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Uraian Pekerjaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('survei/uraian/tambah') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="uraian">Uraian Pekerjaan</label>
                            <select name="id_sub" id="id_sub" class="form-control">
                                <option value="" hidden>--Pilih--</option>
                                <!-- panggil data kategori -->
                                <?php foreach ($subkerja as $value) : ?>
                                    <option value="<?= $value->id; ?>"> <?= $value->nama; ?> -> <?= $value->nama_sub; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="volume">Jumlah / Volume</label>
                            <input type="text" name="volume" id="volume" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="uraian">Satuan Ukur</label>
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
                            <input type="text" name="id_survei" id="id_survei" class="form-control" value="<?= $survei->id_survei; ?>" hidden>
                            <input type="number" name="harga" id="harga" class="form-control" required>
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

    <div class="modal fade" id="tambahModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Rekap Pemasangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('rekap/tambah') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_survei" value="<?= $survei->id_survei; ?>">
                        <div class="mb-3">
                            <label for="kerja">Pekerjaan</label>
                            <select name="kerja" id="kerja" class="form-control">
                                <option value="" hidden>--Pilih--</option>
                                <!-- panggil data kategori -->
                                <?php foreach ($kerja as $value) : ?>
                                    <option value="<?= $value->nama; ?>"> <?= $value->nama; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tukang">Volume</label>
                            <input type="number" step="0.01" name="volume" id="volume" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="Keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" cols="15" rows="3" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="gambar">Upload Gambar Kerja</label>
                            <input type="file" name="gambar" id="gambar" class="form-control" required>
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
                        <form action=" <?= base_url('survei/uraian/ubah/' . $value->id) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id_survei" value="<?= $survei->id_survei; ?>">
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="uraian">Uraian Pekerjaan</label>
                                <select name="id_sub" id="id_sub" class="form-control">
                                    <option value="<?= $value->id_sub; ?>">-- <?= $value->nama; ?>( <?= $value->nama_sub; ?> ) --</option>
                                    <!-- panggil data kategori -->
                                    <?php foreach ($subkerja as $sub) : ?>
                                        <option value="<?= $sub->id; ?>"> <?= $sub->nama; ?> ( <?= $sub->nama_sub; ?> )</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="volume">volume</label>
                                <input type="text" name="volume" id="volume" class="form-control" value="<?= $value->volume; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="ukuran">Satuan Ukur</label>
                                <select name="ukuran" id="ukuran" class="form-control">
                                    <option value="" hidden>--Pilih--</option>
                                    <!-- panggil data kategori -->
                                    <?php foreach ($ukuran as $satuan) : ?>
                                        <option value="<?= $satuan->nama; ?>" <?= $value->ukuran == $satuan->nama ? 'selected' : null ?>> <?= $satuan->nama; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
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
                        <form action=" <?= base_url('survei/uraian/hapus/' . $value->id) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id_survei" value="<?= $survei->id_survei; ?>">
                            <p>
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <tr>
                                        <td colspan="2" scope="row">Yakin Data Uraian Pemasangan</td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="100px">Pekerjaan</td>
                                        <td> : <strong><?= $value->nama ?> ( <?= $value->nama_sub ?> ) </strong></td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="100px">volume</td>
                                        <td> : <strong><?= $value->volume; ?> <?= $value->ukuran; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="100px">biaya</td>
                                        <?php if (!empty($value->biaya)) { ?>
                                            <td><?= number_to_currency($value->biaya, 'IDR', 'id_ID') ?></td>
                                        <?php } else { ?>
                                            <td><?= $value->biaya ?></td>
                                        <?php } ?>
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
    <div class="modal fade" id="hapusModalpasang<?= $survei->id_survei; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash-alt"></i> Hapus Uraian Pemasangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('survei/hapus/' . $survei->id_survei) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td colspan="2" scope="row">Yakin Data Pemasangan Pemasangan</td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Pelaggan</td>
                                    <td> : <strong><?= $survei->pelanggan; ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Lokasi</td>
                                    <td> : <strong><?= $survei->alamat; ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Tanggal</td>
                                    <td> : <strong><?= date('d-m-Y', strtotime($survei->tanggal)) ?></strong></td>
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Refisi Total Pengajuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('survei/uraian/total/' . $survei->id_survei) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">
                        <div class="mb-3">
                            <label for="biaya">Biaya Total</label>
                            <input type="text" name="biaya" id="biaya" class="form-control" value="<?= $survei->biaya; ?>" required>
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