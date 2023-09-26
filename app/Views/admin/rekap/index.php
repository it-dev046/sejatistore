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
                            Daftar Pemasangan
                        </div>

                        <div class="card-body">
                            <!-- Notifikasi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>


                            <form action="<?= base_url('rekap/tambah') ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <input type="hidden" name="biaya" id="biaya" class="form-control" value="0" required>
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="pengukur">
                                            <h6>Daftar Survei</h6>
                                        </label>
                                        <select id="id_survei" name="id_survei" class="form-control">
                                            <option value="">-- Pilih survei --</option>
                                            <?php foreach ($daftar_survei as $survei) : ?>
                                                <option value="<?= $survei->id_survei; ?>"><?= date('d/m/Y', strtotime($survei->tanggal)); ?> -- <?= $survei->pelanggan; ?> -- <?= $survei->telepon; ?> -- <?= $survei->alamat; ?> -- <?= $survei->volume; ?> m2 -- Surveyor (<?= $survei->pengukur; ?>) -- Drafter (<?= $survei->drafter; ?>) </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="kerja">
                                            <h6>Pekerjaan</h6>
                                        </label>
                                        <select name="kerja" id="kerja" class="form-control">
                                            <option value="" hidden>--Pilih--</option>
                                            <!-- panggil data kategori -->
                                            <?php foreach ($kerja as $value) : ?>
                                                <option value="<?= $value->nama; ?>"> <?= $value->nama; ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-1">
                                        <label for="volume">
                                            <h6>Volume</h6>
                                        </label>
                                        <input type="number" min="1" step="0.01" name="volume" id="volume" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="gambar">
                                            <h6>Gambar Kerja</h6>
                                        </label>
                                        <input type="file" name="gambar" id="gambar" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" cols="15" rows="3" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                            </form>
                            <hr>

                            <table id="table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No RBP</th>
                                        <th>Pemasangan</th>
                                        <th>Pekerjaan</th>
                                        <th>Volume</th>
                                        <th>Total</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($daftar_pasang as $pasang) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= $pasang->no_rbp; ?> </td>
                                            <td> <?= $pasang->nama; ?> ( <?= $pasang->alamat; ?> ) </td>
                                            <td> <?= $pasang->kerja; ?> </td>
                                            <td> <?= $pasang->volume; ?> m2</td>
                                            <td> <?= number_to_currency($pasang->biaya, 'IDR', 'id_ID') ?> </td>
                                            <td>
                                                <a href="<?= base_url('rekap/gambar/' . $pasang->id_pasang) ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-download"></i>
                                                    Unduh
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('rekap/detail/' . $pasang->id_pasang) ?>" class="btn btn-dark btn-sm">
                                                    <i class="fas fa-list"></i> Detail
                                                </a>
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $pasang->id_pasang; ?>">
                                                    <i class="fas fa-edit"></i> Edit
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
    <?php foreach ($daftar_pasang as $pasang) : ?>
        <div class="modal fade" id="ubahModal<?= $pasang->id_pasang; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Pemasangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('rekap/ubah/' . $pasang->id_pasang) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="rbp" value="<?= $pasang->no_rbp; ?>">
                                <input type="hidden" name="gambarLama" value="<?= $pasang->gambar; ?>">
                                <label for="alamat">Pekerjaan</label>
                                <select name="kerja" id="kerja" class="form-control">
                                    <option value="<?= $pasang->kerja; ?>"> -- <?= $pasang->kerja; ?> -- </option>
                                    <!-- panggil data kategori -->
                                    <?php foreach ($kerja as $value) : ?>
                                        <option value="<?= $value->nama; ?>"> <?= $value->nama; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="volume">Volume</label>
                                <input type="number" name="volume" id="volume" class="form-control" value="<?= $pasang->volume; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="biaya">Deal Harga</label>
                                <input type="number" name="biaya" id="biaya" class="form-control" value="<?= $pasang->biaya; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="biaya">Gambar Kerja</label>
                                <input type="file" name="gambar" id="gambar" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="biaya">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" cols="15" rows="3" class="form-control" required><?= $pasang->keterangan; ?></textarea>
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