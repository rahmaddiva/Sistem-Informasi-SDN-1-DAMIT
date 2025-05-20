<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <!-- card menampilkan data user -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mt-3"><?= $title ?></h4>
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
                        <!-- button tambah modal -->
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                            data-bs-target="#tambahJabatan">Tambah Jabatan</button>

                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($jabatan as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nama_jabatan'] ?></td>

                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#edit<?= $row['id_jabatan'] ?>"><i
                                                    class="fas fa-edit"></i></button>
                                            <a href="/hapus_jabatan/<?= $row['id_jabatan'] ?>" class="btn btn-danger btn-sm"
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
<!-- tambah modal -->
<div class="modal fade" id="tambahJabatan" tabindex="-1" aria-labelledby="tambahJabatan" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahJabatan">Tambah Jabatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/proses_jabatan" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="form-group mt-3">
                        <label for="nama_jabatan">Nama Jabatan</label>
                        <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan">
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- modal edit -->
<?php foreach ($jabatan as $row): ?>
    <div class="modal fade" id="edit<?= $row['id_jabatan'] ?>" tabindex="-1" aria-labelledby="edit<?= $row['id_jabatan'] ?>"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit<?= $row['id_jabatan'] ?>">Edit Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/update_jabatan" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_jabatan" value="<?= $row['id_jabatan'] ?>">
                        <div class="form-group mt-3">
                            <label for="nama_jabatan">Nama Jabatan</label>
                            <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan"
                                value="<?= $row['nama_jabatan'] ?>">
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