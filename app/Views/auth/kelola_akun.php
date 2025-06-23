<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12 mt-3">
            <!-- card menambahkan data user -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mt-3">Tambah Akun</h4>
                    <?php if (session()->has('validation')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php $validation = session()->getFlashdata('validation'); ?>
                            <?php foreach ($validation->getErrors() as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </div>
                    <?php endif; ?>


                </div>
                <div class="card-body">
                    <?= csrf_field() ?>
                    <form action="/proses_akun" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control"
                                        value="<?= old('nama') ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mt-3">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" class="form-control"
                                        value="<?= old('username') ?>">
                                </div>
                            </div>
                            <!-- guru  -->
                            <div class="col-md-3">
                                <div class="form-group mt-3">
                                    <label for="id_guru">Guru</label>
                                    <select name="id_guru" id="id_guru" class="form-control">
                                        <option value="">Pilih Guru</option>
                                        <?php foreach ($guru as $g): ?>
                                            <option value="<?= $g['id_guru'] ?>"><?= $g['nama'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mt-3">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mt-3">
                                    <label for="level">Level</label>
                                    <select name="level" id="level" class="form-control">
                                        <option value="">Pilih Level</option>
                                        <option value="admin">Admin</option>
                                        <option value="guru">Guru</option>
                                        <option value="wali_kelas">Wali Kelas</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <!-- card menampilkan data user -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mt-3">Kelola Akun</h4>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif ?>
                    <div class="table-responsive">
                        <table id="order-listing" class="table table-bordered table-striped">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($user as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['username'] ?></td>
                                        <td><?= $row['level'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#edit<?= $row['id_user'] ?>"><i
                                                    class="fas fa-edit"></i></button>
                                            <a href="hapus/<?= $row['id_user'] ?>" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><i
                                                    class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- modal edit -->
<?php foreach ($user as $row): ?>
    <div class="modal fade" id="edit<?= $row['id_user'] ?>" tabindex="-1" aria-labelledby="edit<?= $row['id_user'] ?>"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit<?= $row['id_user'] ?>">Edit Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/update_akun" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $row['nama'] ?>">
                        </div>
                        <div class="form-group mt-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control"
                                value="<?= $row['username'] ?>">
                        </div>
                        <div class="form-group mt-3">
                            <label for="password">Password</label>
                            <input type="hidden" name="password_lama" id="password_lama" class="form-control"
                                value="<?= $row['password'] ?>">
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group mt-3">
                            <label for="level">Level</label>
                            <select name="level" id="level" class="form-control">
                                <option value="">Pilih Level</option>
                                <option value="admin" <?= $row['level'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                <option value="guru" <?= $row['level'] == 'guru' ? 'selected' : '' ?>>Guru</option>
                                <option value="wali_kelas" <?= $row['level'] == 'wali_kelas' ? 'selected' : '' ?>>Wali
                                    Kelas</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
<?= $this->endSection() ?>