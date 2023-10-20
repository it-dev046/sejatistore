<?php

date_default_timezone_set("Asia/Manila");

use App\Models\BayarhbkModel;

$this->BayarhbkModel = new BayarhbkModel();

?>
<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> <?= $title; ?> </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard-admin') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item active"> <?= $title; ?> </li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Daftar Pemasangan
                    </div>

                    <div class="card-body">
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
                                    <th>No HBK</th>
                                    <th>Tim Lapangan</th>
                                    <th>Pekerjaan</th>
                                    <th>Pemasangan</th>
                                    <th>Pengawas</th>
                                    <th>Drafter</th>
                                    <th>Total HBK</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($daftar_hbk as $hbk) : ?>
                                    <!-- html... -->
                                    <tr>
                                        <td> <?= $no++; ?> </td>
                                        <td> <?= $hbk->no_hbk; ?> </td>
                                        <td> <?= $hbk->tukang; ?> </td>
                                        <td> <?= $hbk->kerja; ?> </td>
                                        <td><?= $hbk->nama; ?> <br>( <?= $hbk->alamat; ?> ) </td>
                                        <td><?= $hbk->pengawas; ?> </td>
                                        <td><?= $hbk->drafter; ?> </td>
                                        <td> <?= number_to_currency($hbk->total_hbk, 'IDR', 'id_ID', 2) ?> </td>
                                        <td>
                                            <a href="<?= base_url('hbk/uraian/' . $hbk->id_hbk) ?>" class="btn btn-dark btn-sm">
                                                <i class="fas fa-list"></i>
                                            </a>
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $hbk->id_hbk; ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <?php if (!empty($hbk->gambar)) { ?>
                                                <a href="<?= base_url('hbk/gambar/' . $hbk->id_hbk) ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            <?php } else { ?>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah HBK Pengerjaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('hbk/tambah') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="nama">Dafar Pemasangan</label>
                            <select name="id_pasang" id="id_pasang" class="form-control">
                                <option value="" hidden>--Pilih--</option>
                                <?php foreach ($daftar_pasang as $value) : ?>
                                    <option value="<?= $value->id_pasang; ?>"> <?= $value->nama; ?> - <?= $value->invoice; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kerja">Pekerjaan</label>
                            <select name="kerja" id="kerja" class="form-control">
                                <option value="" hidden>--Pilih--</option>
                                <?php foreach ($daftar_kerja as $value) : ?>
                                    <option value="<?= $value->nama; ?>"> <?= $value->nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tukang">Tim Lapangan</label>
                            <select name="tukang" id="tukang" class="form-control">
                                <option value="" hidden>--Pilih--</option>
                                <?php foreach ($daftar_tukang as $value) : ?>
                                    <option value="<?= $value->nama; ?>"> <?= $value->nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pengawas">Pengawas</label>
                            <select name="pengawas" id="pengawas" class="form-control">
                                <option value="" hidden>--Pilih--</option>
                                <?php foreach ($pengawas as $value) : ?>
                                    <option value="<?= $value->nama; ?>"> <?= $value->nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="total_hbk">Total HBK</label>
                            <input type="number" name="total_hbk" id="total_hbk" class="form-control" required>
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

    <?php foreach ($daftar_hbk as $hbk) : ?>
        <div class="modal fade" id="ubahModal<?= $hbk->id_hbk; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i>
                            Ubah hbk
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('hbk/ubah/' . $hbk->id_hbk) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="no_hbk" value="<?= $hbk->no_hbk; ?>">
                            <input type="hidden" name="gambarLama" value="<?= $hbk->gambar; ?>">
                            <div class="mb-3">
                                <label for="kerja">Pekerjaan</label>
                                <select name="kerja" id="kerja" class="form-control">
                                    <option value="" hidden>--Pilih--</option>
                                    <?php foreach ($daftar_kerja as $kerja) : ?>
                                        <option value="<?= $kerja->nama; ?>" <?= $hbk->kerja == $kerja->nama ? 'selected' : null ?>> <?= $kerja->nama; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="pengawas">pengawas</label>
                                <select name="pengawas" id="pengawas" class="form-control">
                                    <option value="" hidden>--Pilih--</option>
                                    <?php foreach ($pengawas as $value) : ?>
                                        <option value="<?= $value->nama; ?>" <?= $hbk->pengawas == $value->nama ? 'selected' : null ?>> <?= $value->nama; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tukang">Tim Lapangan</label>
                                <select name="tukang" id="tukang" class="form-control">
                                    <option value="" hidden>--Pilih--</option>
                                    <?php foreach ($daftar_tukang as $tukang) : ?>
                                        <option value="<?= $tukang->nama; ?>" <?= $hbk->tukang == $tukang->nama ? 'selected' : null ?>> <?= $tukang->nama; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama">Dafar Pemasangan</label>
                                <select name="id_pasang" id="id_pasang" class="form-control">
                                    <?php foreach ($daftar_pasang as $pasang) : ?>
                                        <option value="<?= $pasang->id_pasang; ?>" <?= $hbk->id_pasang == $pasang->id_pasang ? 'selected' : null ?>> <?= $pasang->nama; ?> - <?= $pasang->invoice; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="total_hbk">Total HBK</label>
                                <input type="number" name="total_hbk" id="total_hbk" class="form-control" value="<?= $hbk->total_hbk; ?>" required>
                            </div>
                            <input type="number" name="total_hbk" id="total_hbk" class="form-control" value="<?= $hbk->total_hbk; ?>" hidden>
                            <input type="text" name="id_pasang" id="id_pasang" class="form-control" value="<?= $hbk->id_pasang; ?>" hidden>
                            <div class=" mb-3">
                                <label for="gambar">Upload Gambar Kerja</label>
                                <input type="file" name="gambar" id="gambar" class="form-control">
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

    <?= $this->endSection() ?>
    <?= $this->Section('script') ?>
    <?= $this->endSection() ?>