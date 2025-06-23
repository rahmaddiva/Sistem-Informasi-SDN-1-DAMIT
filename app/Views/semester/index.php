<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12 mb-3">
            <!-- card menambahkan data user -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mt-3"><?= $title ?></h4>
                    <?php if (session()->has('validation')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php $validation = session()->getFlashdata('validation'); ?>
                            <?php foreach ($validation->getErrors() as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </div>
                    <?php endif; ?>
                    <!-- notifikasi sukses -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <?= csrf_field() ?>
                    <form action="/proses" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="nama_semester">Nama Semester</label>
                                    <input type="number" name="nama_semester" id="nama_semester" class="form-control"
                                        value="<?= old('nama_semester') ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="tahun_ajaran">Tahun Ajaran</label>
                                    <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="form-control"
                                        value="<?= old('tahun_ajaran') ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
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
                        <table id="order-listing" class="table">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Semester</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($semester as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nama_semester'] ?></td>
                                        <td><?= $row['tahun_ajaran'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#edit<?= $row['id_semester'] ?>"><i
                                                    class="fas fa-edit"></i></button>
                                            <a href="/hapus_semester/<?= $row['id_semester'] ?>" class="btn btn-danger btn-sm"
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
<?php foreach ($semester as $row): ?>
    <div class="modal fade" id="edit<?= $row['id_semester'] ?>" tabindex="-1" aria-labelledby="edit<?= $row['id_semester'] ?>"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit<?= $row['id_semester'] ?>">Edit Semester</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/proses" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_semester" value="<?= $row['id_semester'] ?>">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="nama_semester">Nama Semester</label>
                                    <input type="text" name="nama_semester" id="nama_semester" class="form-control"
                                        value="<?= $row['nama_semester'] ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="tahun_ajaran">Tahun Ajaran</label>
                                    <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="form-control"
                                        value="<?= $row['tahun_ajaran'] ?>">
                                </div>
                            </div>

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