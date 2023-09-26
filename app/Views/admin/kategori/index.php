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
              Daftar Kategori
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
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($daftar_kategori as $kategori) : ?>
                    <!-- html... -->
                    <tr>
                      <td> <?= $no++; ?> </td>
                      <td> <?= $kategori->nama_kategori; ?> </td>
                      <td width="30%" class="text-canter">
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $kategori->id_kategori; ?>">
                          <i class="fas fa-edit"></i> Edit
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $kategori->id_kategori; ?>">
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
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Kategori Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('kategori/tambah') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
              <label for="nama_kategori">Nama Kategori</label>
              <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>
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
</div>

<?php foreach ($daftar_kategori as $kategori) : ?>
  <div class="modal fade" id="ubahModal<?= $kategori->id_kategori; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Kategori Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action=" <?= base_url('kategori/ubah/' . $kategori->id_kategori) ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
              <input type="hidden" name="_method" value="PUT">
              <label for="nama_kategori">Nama Kategori</label>
              <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" value="<?= $kategori->nama_kategori; ?>" required>
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

<?php foreach ($daftar_kategori as $kategori) : ?>
  <div class="modal fade" id="hapusModal<?= $kategori->id_kategori; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Kategori Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action=" <?= base_url('kategori/hapus/' . $kategori->id_kategori) ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="DELETE">
            <p>
              Yakin Data Kategori Produk : <?= $kategori->nama_kategori; ?>, akan dihapus ?
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
<?= $this->endSection() ?>