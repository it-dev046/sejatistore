<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> <?= $title; ?> </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard-admin') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item"><a href=" <?= base_url('bulanan') ?> ">Daftar Pembayaran Pembayaran Bulanan Perusahaan</a></li>
                <li class="breadcrumb-item active"> <?= $title; ?> </li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Pembayaran Pembayaran Bulanan Perusahaan
                        </div>
                        <div class="card-body">
                            <!-- Notifi Berhasil -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>
                            <form action="<?= base_url('bulanan/uraian/tambah') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="number" name="id_bulanan" id="id_bulanan" class="form-control" value="<?= $bulanan->id_bulanan ?>" hidden>
                                <div class="row">
                                    <div class="mb-3 col-2">
                                        <label for="tanggal">
                                            <h6>Tanggal</h6>
                                        </label>
                                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="bayar">
                                            <h6>Pembayaran</h6>
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
                                        <th>Keterangan</th>
                                        <th>Pembayaran</th>
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
                                            <td>
                                                <?= number_to_currency($value['bayar'], 'IDR', 'id_ID',) ?>
                                            </td>
                                            <td> <?= $value['keterangan'] ?> </td>
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
                            Data Pembayaran Bulanan
                        </div>
                        <div class="card-body">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Nama Pembayaran</div>
                                    <?= $bulanan->nama; ?>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">ID Pembayaran</div>
                                    <?= $bulanan->nomor; ?>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Per Tanggal Pembayaran</div>
                                    <?= $bulanan->tempo; ?>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Keterangan</div>
                                    <?= $bulanan->keterangan; ?>
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
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Pembayaran Bulanan Perusahaan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('bulanan/uraian/hapus/' . $value['id']) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="number" name="id_bulanan" id="id_bulanan" class="form-control" value="<?= $bulanan->id_bulanan ?>" hidden>
                            <input type="hidden" name="_method" value="DELETE">
                            <p>
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <tr>
                                        <td colspan="2" scope="row">Yakin Pembayaran Bulanan Perusahaan</td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="100px">Tanggal</td>
                                        <td> : <strong><?= date('d M Y', strtotime($value['tanggal'])); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="100px">uraian</td>
                                        <td> : <strong><?= $value['keterangan']; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="100px">Pembayaran</td>
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