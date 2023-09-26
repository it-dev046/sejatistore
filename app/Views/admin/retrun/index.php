<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Daftra Barang Kembali</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item active"> <?= $title; ?> </li>
            </ol>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Barang Kembali
                    </div>
                    <div class="card-body">
                        <a class="btn btn-primary btn-sm mb-2" href="retrun/pilih/">
                            <i class="fas fa-plus"></i> Barang Retrun
                        </a>

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
                                    <th>Nama Produk</th>
                                    <th>Jumlah Kembali</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Tanggal Input</th>
                                    <th>No Faktur</th>
                                    <th>Keterangan</th>
                                    <th>Hapus</th>
                            <tbody>
                                <?php $no = 1;
                                foreach ($daftar_kembali as $key => $value) { ?>
                                    <!-- html... -->
                                    <tr>
                                        <td> <?= $no++; ?> </td>
                                        <td> <?= $value->nama_produk; ?> </td>
                                        <td> <?= $value->jumlah_kembali; ?> </td>
                                        <td> <?= $value->penerima; ?> </td>
                                        <td> <?= date('d/m/Y', strtotime($value->tanggal_input)); ?> </td>
                                        <td> <?= $value->id_trans; ?> </td>
                                        <td> <?= $value->keterangan; ?> </td>
                                        <td width="10%" class="text-canter">
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $value->id_kembali ?>">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php foreach ($daftar_kembali as $key => $value) { ?>
        <div class="modal fade" id="hapusModal<?= $value->id_kembali; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash-alt"></i> Hapus Retrun Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('retrun/hapus/' . $value->id_kembali) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <p>
                                Yakin Membatalkan Retrun Barang : <?= $value->id_trans; ?> <br>
                                Produk : <?= $value->nama_produk; ?>, akan dihapus ?
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
    </d <?= $this->endSection()  ?>