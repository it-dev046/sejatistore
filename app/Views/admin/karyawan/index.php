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
                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>
                            <form action="<?= base_url('karyawan/tambah') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                                <div class="row">
                                    <div class="mb-3 col-2">
                                        <label for="nilai">
                                            <h6>Tanggal</h6>
                                        </label>
                                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="nama">
                                            <h6>Nama</h6>
                                        </label>
                                        <input type="text" name="nama" id="nama" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="ktp">KTP</label>
                                        <input type="text" name="ktp" id="ktp" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="posisi">Posisi</label>
                                        <select name="posisi" id="posisi" class="form-control">
                                            <option value="" hidden>--Pilih--</option>
                                            <!-- panggil data Sumber -->
                                            <?php foreach ($daftar_posisi as $key => $posisi) { ?>
                                                <option value="<?= $posisi->nama ?>"><?= $posisi->nama ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="rekening">Rekening</label>
                                        <select name="id_rekening" id="id_select" class="form-control" required>
                                            <option value="" hidden>--Pilih--</option>
                                            <!-- panggil data Sumber -->
                                            <?php foreach ($daftar_rekening as $key => $rekening) { ?>
                                                <option value="<?= $rekening->id_rekening ?>"><?= $rekening->AN ?> (<?= $rekening->bank ?>)</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="gapok">Gaji Pokok</label>
                                        <input type="number" name="gapok" id="gapok" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="um">Uang Makan</label>
                                        <input type="number" name="um" id="um" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="op">Operasional</label>
                                        <input type="number" name="op" id="op" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="bonus">Bonus</label>
                                        <input type="number" name="bonus" id="bonus" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="alamat">
                                            <h6>Alamat</h6>
                                        </label>
                                        <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3 col-1 mt-4">
                                        <label for="alamat">
                                            <h6></h6>
                                        </label>
                                        <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                                    </div>
                                </div>
                            </form>
                            <hr>

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
                                            <td> <?= $value->rek; ?> <br> (<?= $value->bank; ?>) </td>
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
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Posisi Karyawan
                </div>
                <div class="card-body">
                    <form action="<?= base_url('karyawan/posisi/tambah') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                        <div class="row">
                            <div class="mb-3 col-4">
                                <label for="posisi">
                                    <h6>Nama Posisi</h6>
                                </label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                            <div class="mb-3 col-1 mt-4">
                                <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <table id="table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Posisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($daftar_posisi as $value) : ?>
                                <!-- html... -->
                                <tr>
                                    <td> <?= $no++; ?> </td>
                                    <td> <?= $value->nama; ?> </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubah2Modal<?= $value->id_posisi; ?>">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus2Modal2<?= $value->id_posisi; ?>">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
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
                                <label for="nilai">
                                    <h6>Tanggal</h6>
                                </label>
                                <input type="date" name="tanggal" id="tanggal" value="<?= $karyawan->tanggal; ?>" class="form-control" required>
                            </div>
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
                                <select name="id_rekening" id="id_rekening" class="form-control">
                                    <option value="" hidden>--Pilih--</option>
                                    <?php foreach ($daftar_rekening as $rekening) : ?>
                                        <option value="<?= $rekening->id_rekening; ?>" <?= $karyawan->id_rekening == $rekening->id_rekening ? 'selected' : null ?>> <?= $rekening->AN; ?> (<?= $rekening->rek; ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="ktp">KTP</label>
                                <input type="text" name="ktp" id="ktp" class="form-control" value="<?= $karyawan->ktp; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="posisi">Posisi</label>
                                <select name="posisi" id="posisi" class="form-control">
                                    <option value="" hidden>--Pilih--</option>
                                    <?php foreach ($daftar_posisi as $posisi) : ?>
                                        <option value="<?= $posisi->nama; ?>" <?= $karyawan->posisi == $posisi->nama ? 'selected' : null ?>> <?= $posisi->nama; ?></option>
                                    <?php endforeach; ?>
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
    <?php endforeach; ?>

    <?php foreach ($daftar_posisi as $posisi) : ?>
        <div class="modal fade" id="ubah2Modal<?= $posisi->id_posisi; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Nama Posisi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('karyawan/posisi/ubah/' . $posisi->id_posisi) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="mb-3">
                                <label for="posisi">
                                    <h6>Posisi</h6>
                                </label>
                                <input type="text" name="nama" id="nama" class="form-control" value="<?= $posisi->nama; ?>" required>
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

    <?php foreach ($daftar_posisi as $posisi) : ?>
        <div class="modal fade" id="hapus2Modal<?= $posisi->id_posisi; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Keterangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('karyawan/posisi/hapus/' . $posisi->id_posisi) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                            <input type="hidden" name="_method" value="DELETE">
                            <p>
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <tr>
                                        <td colspan="2" scope="row">Yakin Posisi Karyawan</td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="150px">Nama Posisi</td>
                                        <td> : <strong><?= $posisi->nama ?></strong></td>
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

    <?= $this->endSection() ?>
    <?= $this->Section('script') ?>
    <script type="text/javascript">
        // Fungsi untuk membuat combobox searchable
        $(document).ready(function() {
            $("#id_select").select2({
                placeholder: "-- Pilih --",
                allowClear: true,
            });
        });
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