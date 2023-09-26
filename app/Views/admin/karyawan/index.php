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
                            Daftar Karyawan
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

                            <table id="table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Data Diri</th>
                                        <th>Rekening</th>
                                        <th>Keterangan</th>
                                        <th>Bergabung</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($daftar_karyawan as $value) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= $value->nama; ?> </td>
                                            <td>
                                                <?= $value->alamat; ?> <br>
                                                Posisi : <?= $value->posisi; ?> <br>
                                                KTP : <?= $value->ktp; ?> <br>
                                            </td>
                                            <td> <?= $value->rekening; ?> <br> (<?= $value->bank; ?>) </td>
                                            <td>
                                                Gapok : <?= number_to_currency($value->gapok, 'IDR', 'id_ID',) ?><br>
                                                OP : <?= number_to_currency($value->op, 'IDR', 'id_ID',) ?><br>
                                                UM : <?= number_to_currency($value->um, 'IDR', 'id_ID',) ?><br>
                                                Bonus : <?= number_to_currency($value->bonus, 'IDR', 'id_ID',) ?><br>
                                            </td>
                                            <td> <?= date('d M Y', strtotime($value->tanggal)) ?></td>
                                            <td class="text-canter">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $value->id_karyawan; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $value->id_karyawan; ?>">
                                                    <i class="fas fa-trash-alt"></i>
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('karyawan/tambah') ?>" method="post">
                        <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="gapok">Gaji Pokok</label>
                            <input type="number" name="gapok" id="gapok" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="um">Uang Makan</label>
                            <input type="number" name="um" id="um" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="op">Operasional</label>
                            <input type="number" name="op" id="op" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="bonus">Bonus</label>
                            <input type="number" name="bonus" id="bonus" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="rekening">Rekening</label>
                            <input type="text" name="rekening" id="rekening" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="bank">Bank</label>
                            <input type="text" name="bank" id="bank" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="ktp">KTP</label>
                            <input type="text" name="ktp" id="ktp" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="posisi">Posisi</label>
                            <select name="posisi" id="posisi" class="form-control">
                                <option value="Kasir">Kasir</option>
                                <option value="Admin">Admin</option>
                                <option value="Drafter">Drafter</option>
                                <option value="IT">Staff IT</option>
                                <option value="Logistik">Staff Logistik</option>
                                <option value="Driver">Driver</option>
                                <option value="Surveyor">Surveyor</option>
                            </select>
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

    <?php foreach ($daftar_karyawan as $karyawan) : ?>
        <div class="modal fade" id="ubahModal<?= $karyawan->id_karyawan; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Karyawan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('karyawan/ubah/' . $karyawan->id_karyawan) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="<?= $karyawan->nama; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" value="<?= $karyawan->alamat; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="gapok">Gaji Pokok</label>
                                <input type="text" name="gapok" id="gapok" class="form-control" value="<?= $karyawan->gapok; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="um">Uang Makan</label>
                                <input type="text" name="um" id="um" class="form-control" value="<?= $karyawan->um; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="op">Operasional</label>
                                <input type="text" name="op" id="op" class="form-control" value="<?= $karyawan->op; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="bonus">Bonus</label>
                                <input type="text" name="bonus" id="bonus" class="form-control" value="<?= $karyawan->bonus; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="rekening">Rekening</label>
                                <input type="text" name="rekening" id="rekening" class="form-control" value="<?= $karyawan->rekening; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="bank">Bank</label>
                                <input type="text" name="bank" id="bank" class="form-control" value="<?= $karyawan->bank; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="ktp">KTP</label>
                                <input type="text" name="ktp" id="ktp" class="form-control" value="<?= $karyawan->ktp; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="posisi">Posisi</label>
                                <select name="posisi" id="posisi" class="form-control">
                                    <option value="<?= $karyawan->posisi; ?>">-- <?= $karyawan->posisi; ?> --</option>
                                    <option value="Kasir">Kasir</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Drafter">Drafter</option>
                                    <option value="IT">Staff IT</option>
                                    <option value="Logistik">Staff Logistik</option>
                                    <option value="Driver">Driver</option>
                                    <option value="Surveyor">Surveyor</option>
                                </select>
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

<?php foreach ($daftar_karyawan as $karyawan) : ?>
    <div class="modal fade" id="hapusModal<?= $karyawan->id_karyawan; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('karyawan/hapus/' . $karyawan->id_karyawan) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                        <input type="hidden" name="_method" value="DELETE">
                        <p>
                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td colspan="2" scope="row">Yakin Data Detail Order</td>
                                </tr>
                                <tr>
                                    <td scope="row" width="150px">Nama Karyawan</td>
                                    <td> : <strong><?= $karyawan->nama ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Posisi</td>
                                    <td> : <strong><?= $karyawan->posisi; ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Alamat</td>
                                    <td> : <strong><?= $karyawan->alamat; ?></strong></td>
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
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#table').DataTable({
            buttons: ['copy', 'csv', 'print', 'excel', 'pdf', 'colvis'],
            dom: "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row'<'col-md-5'i><'col-md-7'p>>",
            lengthMenu: [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ]
        });

        table.buttons().container()
            .appendTo('#table_wrapper .col-md-5:eq(0)');
    });
</script>
<?= $this->endSection() ?>