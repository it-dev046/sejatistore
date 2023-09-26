<?= $this->extend('admin/layout/template')  ?>
<?= $this->Section('content');  ?>
<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"> <?= $title; ?> </h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href=" <?= base_url('dashboard') ?> ">Dashboard</a></li>
        <li class="breadcrumb-item active"> <?= $title; ?> </li>
      </ol>
      <div class="card mb-4">
        <div class="card-body">
          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              Daftar Bahan Pemasangan
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

              <table id="datatablesSimple">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Pemasangan</th>
                    <th>Alamat</th>
                    <th>Surat Jalan</th>
                    <th>Aksi</th>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($daftar_pasang as $pasang) : ?>
                    <!-- html... -->
                    <tr>
                      <td> <?= $no++; ?> </td>
                      <td> <?= date('d M Y', strtotime($pasang->tanggal)); ?></td>
                      <td> <?= $pasang->nama_pasang; ?> </td>
                      <td> <?= $pasang->alamat; ?> </td>
                      <td>
                        <a href="<?= base_url('cetak/bahan/suratjalan/' . $pasang->id_pasang) ?>" class="btn btn-warning btn-sm">
                          <i class="fas fa-print"></i> Cetak
                        </a>
                      </td>
                      <td>
                        <a href="<?= base_url('bahan/' . $pasang->id_pasang . '/preview') ?>" class="btn btn-dark btn-sm">
                          <i class="fas fa-list"></i> Bahan
                        </a>
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $pasang->id_pasang; ?>">
                          <i class="fas fa-edit"></i> Edit
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $pasang->id_pasang; ?>">
                          <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                      </td>
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

  <!-- Modal -->
  <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Bahan Pemasangan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('bahan/tambah') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
              <label for="tanggal">Tanggal Pemasangan</label>
              <input type="text" name="tanggal" id="tgl_pembuatan" class="form-control" value="<?= date('m/d/Y'); ?>" required>
            </div>
            <div class=" mb-3">
              <label for="nama_pasang">Pemasangan</label>
              <input type="text" name="nama_pasang" id="nama_pasang" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="alamat">Alamat</label>
              <input type="text" name="alamat" id="alamat" class="form-control" required>
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

  <?php foreach ($daftar_pasang as $pasang) : ?>
    <div class="modal fade" id="ubahModal<?= $pasang->id_pasang; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Bahan Pemasangan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action=" <?= base_url('bahan/ubah/' . $pasang->id_pasang) ?>" method="post">
              <?= csrf_field() ?>
              <div class="mb-3">
                <label for="tanggal">Tanggal Pemasangan</label>
                <input type="text" name="tanggal" id="tgl_ubah<?= $pasang->id_pasang; ?>" class="form-control" value="<?= date('m/d/Y', strtotime($pasang->tanggal)); ?>" required>
              </div>
              <div class="mb-3">
                <input type="hidden" name="_method" value="PUT">
                <label for="nama_pasang">Pemasangan</label>
                <input type="text" name="nama_pasang" id="nama_pasang" class="form-control" value="<?= $pasang->nama_pasang; ?>" required>
              </div>
              <div class="mb-3">
                <input type="hidden" name="_method" value="PUT">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" value="<?= $pasang->alamat; ?>" required>
              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btn-sm">Ubah</button>
          </div>
          </form>
        </div>
      </div>
    </div>
</div>
<?php endforeach; ?>

<?php foreach ($daftar_pasang as $pasang) : ?>
  <div class="modal fade" id="hapusModal<?= $pasang->id_pasang; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Bahan Pemasangan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action=" <?= base_url('bahan/hapus/' . $pasang->id_pasang) ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="DELETE">
            <p>
              Yakin Data Bahan Pemasangan : <?= $pasang->nama_pasang; ?>, akan dihapus ?
            </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary btn-sm">Hapus</button>
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
  $(function() {
    $(document).ready(function() {
      $('#tgl_pembuatan').datepicker({
        format: 'mm/dd/yyyy',
        todayHighlight: true,

        language: "id",
        locale: "id",
      });
    });
  });
</script>
<?php foreach ($daftar_pasang as $pasang) : ?>
  <script type="text/javascript">
    $(function() {
      $(document).ready(function() {
        $('#tgl_ubah<?= $pasang->id_pasang; ?>').datepicker({
          format: 'mm/dd/yyyy',
          todayHighlight: true,

          language: "id",
          locale: "id",
        });
      });
    });
  </script>

<?php endforeach; ?>
<?= $this->endSection() ?>