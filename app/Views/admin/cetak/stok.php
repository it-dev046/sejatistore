<?= $this->extend('admin/layout/template_stok')  ?>
<?= $this->Section('content');  ?>
<main>
    <div class="container-fluid">
        <div class="row justify-content-md-center mt-4">
            <div class="col col-lg-3">
                <img src="<?= base_url('cetak/logo.png') ?>" width="220px" height="120px" class="rounded float-left mt-4" alt="...">
            </div>
            <div class="col col-lg-4 mt-4">
                <figure class="text-center">
                    <br>
                    <blockquote class="blockquote">
                        <p class="h1">Stok Produk</p>
                        <?= $tanggal; ?>
                    </blockquote>
                </figure>
            </div>
            <div class="col col-lg-4 mt-4">
                <figure class="text-end">
                    <br>
                    <blockquote class="blockquote">
                        <p class="h3">PT Anugerah Sejati Nusantara</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        Jl. Sultan Sulaiman Depan Pelita 4 Sambutan Samarinda
                        <br>
                        <cite title="Source Title">Telp. 0811 5567 17 / 0811 5587 17</cite>
                    </figcaption>
                </figure>
            </div>
        </div>
        <div class="row row-col mt-3">
            <table id="table3" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar Produk</th>
                        <th>Nama Produk</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                <tbody>
                    <?php $no = 1;
                    foreach ($produk as $key => $value) { ?>
                        <!-- html... -->
                        <tr>
                            <td> <?= $no++; ?> </td>
                            <td> <img src="<?= base_url('foto/' . $value['gambar_produk']) ?>" class="card-img-top" alt="..." width="100px" height="100px"> </td>
                            <td> <?= $value['nama_produk'] ?> (<?= $value['singkatan'] ?>) </td>
                            <td> <?= $value['stok'] ?> <?= $value['nama_satuan'] ?> </td>
                            <td> <?= number_to_currency($value['harga'], 'IDR', 'id_ID',) ?> / <?= $value['nama_satuan'] ?> </td>
                            <td> ( <?= $value['nama_kategori'] ?> <?= $value['nama_subkate'] ?> ) <?= $value['deskripsi'] ?> </td>
                        </tr>
                    <?php } ?>
                </tbody>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</main>
<?= $this->endSection()  ?>
<?= $this->Section('script') ?>
<script>
    $(document).ready(function() {
        var table = $('#table3').DataTable({
            buttons: ['copy', 'csv', 'print', 'excel', 'pdf', 'colvis'],
            dom: "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row'<'col-md-5'i><'col-md-7'p>>",
            lengthMenu: [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ]
        });

        table3.buttons().container()
            .appendTo('#table_wrapper .col-md-5:eq(0)');
    });
</script>
<?= $this->endSection() ?>