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
              Daftar Survei Lapangan
            </div>

            <div class="card-body">
              <!-- Notifikasi Berhasil -->
              <?php if (session('success')) : ?>
                <div class="alert alert-success" role="alert">
                  <?= session('success'); ?>
                </div>
              <?php endif; ?>

              <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahModal">
                <i class="fas fa-plus"></i> Tambah
              </button>
              <hr>
              <table id="datatablesSimple">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th>Keterangan</th>
                    <th>Pekerja</th>
                    <th>Drafter</th>
                    <th>Sketsa</th>
                    <th>Pengajuan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($daftar_survei as $survei) : ?>
                    <!-- html... -->
                    <tr>
                      <td> <?= $no++; ?> </td>
                      <td> <?= date('d M Y', strtotime($survei->tanggal)); ?></td>
                      <td> <?= $survei->alamat; ?> <br>
                        (<strong><?= $survei->pelanggan; ?></strong>)
                      </td>
                      <td> <?= $survei->keterangan; ?><br>
                        (<strong><?= $survei->pengukur; ?></strong>)
                      </td>
                      <td>
                        <?php if (empty($survei->status)) { ?>
                          <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#dealModal<?= $survei->id_survei; ?>">
                            Belum
                          </button>
                        <?php } else { ?>
                          <?= $survei->tukang; ?>
                        <?php } ?>
                      </td>
                      <td> <?= $survei->drafter; ?> </td>
                      <td>
                        <a href="<?= base_url('survei/sketsa/' . $survei->id_survei) ?>" class="btn btn-info btn-sm">
                          <i class="fas fa-download"></i> Gambar
                        </a>
                      </td>
                      <td>
                        <a href="<?= base_url('survei/uraian/' . $survei->id_survei) ?>" class="btn btn-secondary btn-sm">
                          <i class="fas fa-list"></i> Detail
                        </a>
                      </td>
                      <td>
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $survei->id_survei; ?>">
                          <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $survei->id_survei; ?>">
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
    </div>
  </main>

  <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Tambah Survei Lapangan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('survei/tambah') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="mb-3">
              <label for="tanggal">Tanggal Survei</label>
              <input type="date" name="tanggal" id="tanggal" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="pelanggan">Nama Pelanggan</label>
              <input type="text" name="pelanggan" id="pelanggan" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="alamat">Lokasi</label>
              <input type="text" name="alamat" id="alamat" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="telepon">Telepon / WA</label>
              <input type="text" name="telepon" id="telepon" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="pengukur">Surveyor</label>
              <select name="pengukur" id="pengukur" class="form-control">
                <option value="" hidden>--Pilih--</option>
                <!-- panggil data kategori -->
                <?php foreach ($pengukur as $value) : ?>
                  <option value="<?= $value->nama; ?>"> <?= $value->nama; ?> </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="drafter">Drafter</label>
              <select name="drafter" id="drafter" class="form-control">
                <option value="" hidden>--Pilih--</option>
                <!-- panggil data kategori -->
                <?php foreach ($drafter as $value) : ?>
                  <option value="<?= $value->nama; ?>"> <?= $value->nama; ?> </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="keterangan">Keterangan</label>
              <textarea name="keterangan" id="keterangan" cols="15" rows="2" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
              <label for="sketsa">Upload sketsa</label>
              <input type="file" name="sketsa" id="sketsa" class="form-control" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success btn-sm">Tambah</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal -->

  <?php foreach ($daftar_survei as $survei) : ?>
    <div class="modal fade" id="ubahModal<?= $survei->id_survei; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Survei Lapangan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action=" <?= base_url('survei/ubah/' . $survei->id_survei) ?>" method="post" enctype="multipart/form-data">
              <?= csrf_field() ?>
              <div class="mb-3">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="gambarLama" value="<?= $survei->sketsa; ?>">
                <label for="tanggal">tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= $survei->tanggal; ?>" required>
              </div>
              <div class="mb-3">
                <label for="pelanggan">pelanggan</label>
                <input type="text" name="pelanggan" id="pelanggan" class="form-control" value="<?= $survei->pelanggan; ?>" required>
              </div>
              <div class="mb-3">
                <label for="alamat">Lokasi</label>
                <input type="text" name="alamat" id="alamat" class="form-control" value="<?= $survei->alamat; ?>" required>
              </div>
              <div class="mb-3">
                <label for="telepon">Telepon / WA</label>
                <input type="text" name="telepon" id="telepon" class="form-control" value="<?= $survei->telepon; ?>" required>
              </div>
              <div class="mb-3">
                <label for="pengukur">Surveyor</label>
                <input type="text" name="pengukur" id="pengukur" class="form-control" value="<?= $survei->pengukur; ?>" required>
              </div>
              <div class="mb-3">
                <label for="drafter">Drafter</label>
                <input type="text" name="drafter" id="drafter" class="form-control" value="<?= $survei->drafter; ?>" required>
              </div>
              <div class="mb-3">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" cols="15" rows="3" class="form-control" required><?= $survei->keterangan; ?></textarea>
              </div>
              <div class="mb-3">
                <label for="sketsa">Upload sketsa</label>
                <input type="file" name="sketsa" id="sketsa" class="form-control">
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

<?php foreach ($daftar_survei as $survei) : ?>
  <div class="modal fade" id="dealModal<?= $survei->id_survei; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Deal Pemasangan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('survei/deal/' . $survei->id_survei) ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="text" name="status" id="status" class="form-control" value="1" hidden>
            <div class="mb-3">
              <label for="biaya">Total Deal</label>
              <input type="text" name="biaya" id="biaya" class="form-control" value="<?= $survei->biaya; ?>" required>
            </div>
            <div class="mb-3">
              <label for="alamat">Tim Lapangan</label>
              <select name="tukang" id="tukang" class="form-control" required>
                <option value="" hidden>--Pilih--</option>
                <?php foreach ($daftar_tukang as $value) : ?>
                  <option value="<?= $value->nama; ?>"> <?= $value->nama; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-warning btn-sm">Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  </div>
<?php endforeach; ?>

<?php foreach ($daftar_survei as $survei) : ?>
  <div class="modal fade" id="hapusModal<?= $survei->id_survei; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus Survei Lapangan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action=" <?= base_url('survei/hapus/' . $survei->id_survei) ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="sketsa" value="<?= $survei->sketsa; ?>">
            <p>
            <table class="table table-borderless table-sm">
              <tbody>
                <tr>
                  <td colspan="2" scope="row">Yakin Data pembayaran HBK</td>
                </tr>
                <tr>
                  <td scope="row" width="100px">Pelanggan</td>
                  <td> : <strong><?= $survei->pelanggan; ?></strong></td>
                </tr>
                <tr>
                  <td scope="row" width="100px">alamat</td>
                  <td> : <strong><?= $survei->alamat; ?></strong></td>
                </tr>
                <tr>
                  <td scope="row" width="100px">keterangan</td>
                  <td> : <strong><?= $survei->keterangan; ?></strong></td>
                </tr>
                <tr>
                  <td scope="row" width="100px">Surveyor</td>
                  <td> : <strong><?= $survei->pengukur; ?></strong></td>
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
<?= $this->endSection() ?>