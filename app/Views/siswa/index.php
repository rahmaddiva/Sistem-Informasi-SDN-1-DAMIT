<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12 mb-3">
            <!-- card menambahkan data user -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mt-3">Tambah Siswa</h4>
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
                    <form action="/proses_siswa" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="nisn">NISN</label>
                                    <input type="number" name="nisn" id="nisn" class="form-control"
                                        value="<?= old('nisn') ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control"
                                        value="<?= old('nama') ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="id_kelas">Kelas</label>
                                    <select name="id_kelas" id="id_kelas" class="form-control">
                                        <option value="">Pilih Kelas</option>
                                        <?php foreach ($kelas as $kel): ?>
                                            <option value="<?= $kel['id_kelas'] ?>"><?= $kel['nama_kelas'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="id_guru">Semester</label>
                                    <select name="id_semester" id="id_semester" class="form-control">
                                        <option value="">Pilih Semester</option>
                                        <?php foreach ($semester as $sem): ?>
                                            <option value="<?= $sem['id_semester'] ?>"><?= $sem['nama_semester'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="id_guru">Wali Kelas</label>
                                    <select name="id_guru" id="id_guru" class="form-control">
                                        <option value="">Pilih Wali Kelas</option>
                                        <?php foreach ($guru as $gur): ?>
                                            <option value="<?= $gur['id_guru'] ?>"><?= $gur['nama'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="foto">Foto</label>
                                    <input type="file" name="foto" id="foto" class="form-control">
                                    <small class="text-muted">Max. 3MB</small>
                                </div>
                            </div>
                            <!-- preview foto -->
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="preview">Preview</label>
                                    <img src="/uploads/default.png" alt="default.jpg" width="250" id="preview">
                                    <!-- jquery -->
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    <script>
                                        document.getElementById('foto').addEventListener('change', function() {
                                            const file = this.files[0];
                                            if (file) {
                                                const reader = new FileReader();
                                                reader.onload = function(e) {
                                                    document.getElementById('preview').src = e.target.result;
                                                }
                                                reader.readAsDataURL(file);
                                            }
                                        });
                                    </script>
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
                                <th>No</th>
                                <th>NISN</th>
                                <th>Kelas</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($siswa as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nisn'] ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['nama_kelas'] ?></td>
                                        <td><?= $row['jenis_kelamin'] ?></td>
                                        <td><img src="/foto_siswa/<?= $row['foto'] ?>" alt="foto" width="100"></td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#edit<?= $row['id_siswa'] ?>"><i
                                                    class="fas fa-edit"></i></button>
                                            <a href="/hapus_siswa/<?= $row['id_siswa'] ?>" class="btn btn-danger btn-sm"
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
<?php foreach ($siswa as $row): ?>
    <div class="modal fade" id="edit<?= $row['id_siswa'] ?>" tabindex="-1" aria-labelledby="edit<?= $row['id_siswa'] ?>"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit<?= $row['id_siswa'] ?>">Edit Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/update_siswa" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_siswa" value="<?= $row['id_siswa'] ?>">
                        <input type="hidden" name="foto_lama" value="<?= $row['foto'] ?>">

                        <div class="form-group mt-3">
                            <label for="nisn">NISN</label>
                            <input type="number" name="nisn" id="nisn" class="form-control" value="<?= $row['nisn'] ?>">
                        </div>

                        <div class="form-group mt-3">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $row['nama'] ?>">
                        </div>

                        <div class="form-group mt-3">
                            <label for="id_kelas">Kelas</label>
                            <select name="id_kelas" id="id_kelas" class="form-control">
                                <option value="">Pilih Kelas</option>
                                <?php foreach ($kelas as $kel): ?>
                                    <option value="<?= $kel['id_kelas'] ?>" <?= $kel['id_kelas'] == $row['id_kelas'] ? 'selected' : '' ?>><?= $kel['nama_kelas'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="id_semester">Semester</label>
                            <select name="id_semester" id="id_semester" class="form-control">
                                <option value="">Pilih Semester</option>
                                <?php foreach ($semester as $sem): ?>
                                    <option value="<?= $sem['id_semester'] ?>" <?= $sem['id_semester'] == $row['id_semester'] ? 'selected' : '' ?>><?= $sem['nama_semester'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="id_guru">Wali Kelas</label>
                            <select name="id_guru" id="id_guru" class="form-control">
                                <option value="">Pilih Wali Kelas</option>
                                <?php foreach ($guru as $gur): ?>
                                    <option value="<?= $gur['id_guru'] ?>" <?= $gur['id_guru'] == $row['id_guru'] ? 'selected' : '' ?>><?= $gur['nama'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                <option value="<?= $row['jenis_kelamin'] ?>"><?= $row['jenis_kelamin'] ?></option>
                                <option value="Laki-laki" <?= $row['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>
                                    Laki-laki</option>
                                <option value="Perempuan" <?= $row['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>
                                    Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" id="foto" class="form-control">
                            <small class="text-muted">Max. 3MB</small>
                        </div>
                        <!-- preview foto -->
                        <div class="form-group mt-3">
                            <label for="preview">Preview</label>
                            <img src="foto_siswa/<?= $row['foto'] ?>" alt="foto" width="250" id="preview">
                            <!-- jquery -->
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script>
                                document.getElementById('foto').addEventListener('change', function() {
                                    const file = this.files[0];
                                    if (file) {
                                        const reader = new FileReader();
                                        reader.onload = function(e) {
                                            document.getElementById('preview').src = e.target.result;
                                        }
                                        reader.readAsDataURL(file);
                                    }
                                });
                            </script>
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