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
                            Daftar Rekening Perusahaan
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
                                        <th>Perusahaan</th>
                                        <th>Rekening</th>
                                        <th>Atas Nama</th>
                                        <th>Bank</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($daftar_rekening as $value) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= $value->usaha; ?> </td>
                                            <td> <?= $value->rek; ?> </td>
                                            <td> <?= $value->AN; ?> </td>
                                            <td> <?= $value->bank; ?> </td>
                                            <td class="text-canter">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $value->id_rekening; ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $value->id_rekening; ?>">
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
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Rekening Perusahaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('rekening/tambah') ?>" method="post">
                        <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="usaha">Perusahaan</label>
                            <input type="text" name="usaha" id="usaha" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="rek">Nomor Rekening</label>
                            <input type="text" name="rek" id="rek" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="AN">Atas Nama</label>
                            <input type="text" name="AN" id="AN" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="bank">Bank</label>
                            <input type="text" name="bank" id="bank" class="form-control" required>
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

    <?php foreach ($daftar_rekening as $rekening) : ?>
        <div class="modal fade" id="ubahModal<?= $rekening->id_rekening; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Rekening Perusahaan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('rekening/ubah/' . $rekening->id_rekening) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId; ?>" hidden>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="mb-3">
                                <label for="usaha">Perusahaan</label>
                                <input type="text" name="usaha" id="usaha" class="form-control" value="<?= $rekening->usaha; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="rek">Nomor Rekening</label>
                                <input type="text" name="rek" id="rek" class="form-control" value="<?= $rekening->rek; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="AN">Atas Nama</label>
                                <input type="text" name="AN" id="AN" class="form-control" value="<?= $rekening->AN; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="bank">Bank</label>
                                <input type="text" name="bank" id="bank" class="form-control" value="<?= $rekening->bank; ?>" required>
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

<?php foreach ($daftar_rekening as $rekening) : ?>
    <div class="modal fade" id="hapusModal<?= $rekening->id_rekening; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus rekening</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('rekening/hapus/' . $rekening->id_rekening) ?>" method="post">
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
                                    <td scope="row" width="150px">Perusahaan</td>
                                    <td> : <strong><?= $rekening->usaha ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Rekeing</td>
                                    <td> : <strong><?= $rekening->rek; ?></strong></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="100px">Atas Nama</td>
                                    <td> : <strong><?= $rekening->AN; ?></strong></td>
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