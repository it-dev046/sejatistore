<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> <?= $title; ?> </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href=" <?= base_url('dashboard') ?> ">Dashboard</a></li>
                <li class="breadcrumb-item"><a href=" <?= base_url('retrun') ?> ">Daftar Retrun</a></li>
                <li class="breadcrumb-item active"> <?= $title; ?> </li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Pilih Faktur Yang Ingin di Retrun
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
                                        <th>No Faktur</th>
                                        <th>Pelanggan</th>
                                        <th>Nama Produk</th>
                                        <th>Spek</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($daftar_detail as $detail) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= $detail->id_trans; ?> </td>
                                            <td> <?= $detail->penerima; ?> </td>
                                            <td> <?= $detail->nama_produk; ?> </td>
                                            <td> <?= $detail->singkatan; ?> </td>
                                            <td> <?= $detail->jumlah_produk; ?> <?= $detail->nama_satuan; ?> </td>
                                            <td> <?= number_to_currency($detail->subtotal, 'IDR', 'id_ID', 2) ?> </td>

                                            <?php if (empty($detail->jumlah_produk)) { ?>
                                                <td></td>
                                            <?php } else { ?>
                                                <td width="30%" class="text-canter">
                                                    <a class="btn btn-success btn-sm" href="<?= base_url('retrun/' . $detail->id_detail . '/preview') ?>">
                                                        <i class="fas fa-check"></i> Pilih
                                                    </a>
                                                </td>
                                            <?php } ?>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?= $this->endSection() ?>
    <?= $this->Section('script') ?>
    <?= $this->endSection() ?>