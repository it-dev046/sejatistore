<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> <?= $title; ?> </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard-admin') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item"><a href=" <?= base_url('hutang') ?> ">Daftar Hutang Perusahaan</a></li>
                <li class="breadcrumb-item active"> <?= $title; ?> </li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Uraian Data Hutang Perusahaan
                        </div>
                        <div class="card-body">
                            <!-- Notifi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>
                            <form action="<?= base_url('hutang/uraian/tambah') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="number" name="id_hutang" id="id_hutang" class="form-control" value="<?= $hutang->id_hutang ?>" hidden>
                                <div class="row">
                                    <div class="mb-3 col-2">
                                        <label for="tanggal">
                                            <h6>Tanggal</h6>
                                        </label>
                                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="sumber">
                                            <h6>Sumber</h6>
                                        </label>
                                        <input type="text" name="sumber" id="sumber" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="tujuan">
                                            <h6>Tujuan</h6>
                                        </label>
                                        <input type="text" name="tujuan" id="tujuan" class="form-control" value="<?= $hutang->usaha ?> ( <?= $hutang->rek ?> )" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="bayar">
                                            <h6>Nominal</h6>
                                        </label>
                                        <input type="number" name="bayar" id="bayar" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="keterangan">
                                            <h6>Keterangan</h6>
                                        </label>
                                        <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3 col-3 mt-5">
                                        <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <table id="table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Uraian</th>
                                        <th>Sumber</th>
                                        <th>Tujuan</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($daftar_uraian as $key => $value) { ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= date('d-m-Y', strtotime($value['tanggal'])); ?></td>
                                            <td> <?= $value['keterangan'] ?> </td>
                                            <td> <?= $value['sumber'] ?> </td>
                                            <td> <?= $value['tujuan'] ?> </td>
                                            <td>
                                                <?= number_to_currency($value['bayar'], 'IDR', 'id_ID',) ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $value['id'] ?>">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php }  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Data Hutang Perusahaan
                        </div>
                        <div class="card-body">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Perusahaan</div>
                                    <?= $hutang->usaha; ?>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Alamat</div>
                                    <?= $hutang->alamat; ?>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Keterangan</div>
                                    <?= $hutang->keterangan; ?>
                                </div>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Detail Perbulan
                        </div>
                        <div class="card-body">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Total Hutang</div>
                                    <?php if ($hutang->total > 0) { ?>
                                        <?= number_to_currency($hutang->total, 'IDR', 'id_ID',) ?>
                                    <?php } else { ?>
                                        0
                                    <?php } ?>
                                </div>
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Terbayar</div>
                                    <?php if ($totalbayar > 0) { ?>
                                        <?= number_to_currency($totalbayar, 'IDR', 'id_ID',) ?>
                                    <?php } else { ?>
                                        0
                                    <?php } ?>
                                </div>
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Sisa Hutang</div>
                                    <?php if ($sisa <> 0) { ?>
                                        <?= number_to_currency($sisa, 'IDR', 'id_ID',) ?>
                                    <?php } elseif ($totalbayar == $hutang->total) { ?>
                                        Lunas
                                    <?php } else { ?>
                                        0
                                    <?php } ?>
                                </div>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->

    <?php foreach ($daftar_uraian as $key => $value) { ?>
        <div class="modal fade" id="hapusModal<?= $value['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Detail Data Hutang Perusahaan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('hutang/uraian/hapus/' . $value['id']) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="number" name="id_hutang" id="id_hutang" class="form-control" value="<?= $hutang->id_hutang ?>" hidden>
                            <input type="hidden" name="_method" value="DELETE">
                            <p>
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <tr>
                                        <td colspan="2" scope="row">Yakin Uraian Data Hutang Perusahaan</td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="100px">Tanggal</td>
                                        <td> : <strong><?= date('d M Y', strtotime($value['tanggal'])); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="100px">Sumber</td>
                                        <td> : <strong><?= $value['sumber']; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="100px">Tujuan</td>
                                        <td> : <strong><?= $value['tujuan']; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="100px">uraian</td>
                                        <td> : <strong><?= $value['keterangan']; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="100px">Nilai</td>
                                        <?php if (!empty($value['bayar'])) { ?>
                                            <td> : <strong> <?= number_to_currency($value['bayar'], 'IDR', 'id_ID',) ?></strong></td>
                                        <?php } else { ?>
                                            <td> : <strong> 0 </strong></td>
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
    <?php } ?>
    <?= $this->endSection() ?>
    <?= $this->Section('script') ?>
    <script type="text/javascript">
        // Fungsi untuk membuat combobox searchable
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