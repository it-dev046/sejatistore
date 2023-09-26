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
                            Daftar User Sejati Store
                        </div>

                        <div class="card-body">
                            <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                <i class="fas fa-plus"></i> Register User
                            </button>

                            <!-- Notifikasi Berhasil -->
                            <?php if (session()->getFlashdata('success')) { ?>
                                <div class="alert alert-success">
                                    <?php echo session()->getFlashdata('success'); ?>
                                </div>
                            <?php } ?>
                            <?php if (session()->getFlashdata('error')) { ?>
                                <div class="alert alert-danger">
                                    <?php foreach (session()->getFlashdata('error') as $field => $error) : ?>
                                        <p><?= $error ?></p>
                                    <?php endforeach ?>
                                </div>
                            <?php } ?>

                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama user</th>
                                        <th>Email</th>
                                        <th>Level</th>
                                        <th>Aksi</th>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($daftar_user as $user) : ?>
                                        <!-- html... -->
                                        <tr>
                                            <td> <?= $no++; ?> </td>
                                            <td> <?= $user['name'] ?> </td>
                                            <td> <?= $user['email'] ?> </td>
                                            <?php if ($user['level'] == "2") { ?>
                                                <td>Admin</td>
                                            <?php } elseif ($user['level'] == "4") { ?>
                                                <td>Surveyor</td>
                                            <?php } elseif ($user['level'] == "3") { ?>
                                                <td>Drafter</td>
                                            <?php } else { ?>
                                                <td>Kasir</td>
                                            <?php } ?>
                                            <?php if ($user['id'] == "1") { ?>
                                                <td></td>
                                            <?php } else { ?>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $user['id'] ?>">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <?php ?>
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $user['id']; ?>">
                                                        <i class="fas fa-trash-alt"></i> Hapus
                                                    </button>
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

    <!-- Modal -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Register User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('user/tambah') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="nama_user">Nama user</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Password (Minimal 8 Karakter)</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="level">Jabatan</label>
                            <select name="level" id="level" class="form-control">
                                <option value="1">Kasir</option>
                                <option value="2">Admin</option>
                                <option value="3">Drafter</option>
                                <option value="4">Surveyor</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary btn-sm">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($daftar_user as $user) : ?>
        <div class="modal fade" id="ubahModal<?= $user['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah user</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=" <?= base_url('user/ubah/' . $user['id']) ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <input type="hidden" name="_method" value="PUT">
                                <label for="email">email</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?= $user['email'] ?>" required>
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

<?php foreach ($daftar_user as $user) : ?>
    <div class="modal fade" id="hapusModal<?= $user['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Hapus user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" <?= base_url('user/hapus/' . $user['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <p>
                            Yakin Data user : <?= $user['name'] ?>, akan dihapus ?
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