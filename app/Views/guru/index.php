<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12 mb-3">
            <!-- card menambahkan data user -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mt-3">Tambah Guru</h4>
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
                    <form action="/proses_guru" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="nip">NIP</label>
                                    <input type="number" name="nip" id="nip" class="form-control"
                                        value="<?= old('nip') ?>">
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
                                    <label for="id_jabatan">Jabatan</label>
                                    <select name="id_jabatan" id="id_jabatan" class="form-control">
                                        <option value="">Pilih Jabatan</option>
                                        <?php foreach ($jabatan as $row): ?>
                                            <option value="<?= $row['id_jabatan'] ?>"><?= $row['nama_jabatan'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Mapel 1 -->
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="id_mapel_1">Mata Pelajaran 1</label>
                                    <select name="id_mapel1" id="id_mapel_1" class="form-control">
                                        <option value="">Pilih Mata Pelajaran</option>
                                        <?php foreach ($mapel as $row): ?>
                                            <option value="<?= $row['id_mapel'] ?>"><?= $row['nama_mapel'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Mapel 2 -->
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="id_mapel_2">Mata Pelajaran 2</label>
                                    <select name="id_mapel2" id="id_mapel_2" class="form-control">
                                        <option value="">Pilih Mata Pelajaran</option>
                                        <?php foreach ($mapel as $row): ?>
                                            <option value="<?= $row['id_mapel'] ?>"><?= $row['nama_mapel'] ?></option>
                                        <?php endforeach ?>
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
                                        document.getElementById('foto').addEventListener('change', function () {
                                            const file = this.files[0];
                                            if (file) {
                                                const reader = new FileReader();
                                                reader.onload = function (e) {
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
                    <h4 class="card-title mt-3">Kelola Guru</h4>
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

                    <!-- Input Pencarian -->
                    <div class="form-group">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari Nama atau NIP...">
                    </div>
                    <div class="table-responsive">
                        <table id="order-listing" class="table">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Mapel 1</th>
                                    <th>Mapel 2</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($guru as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nip'] ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['nama_mapel1'] ?></td>
                                        <td><?= $row['nama_mapel2'] ?></td>
                                        <td><img src="/foto_guru/<?= $row['foto'] ?>" alt="foto" width="100"></td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#edit<?= $row['id_guru'] ?>"><i
                                                    class="fas fa-edit"></i></button>
                                            <a href="/hapus_guru/<?= $row['id_guru'] ?>" class="btn btn-danger btn-sm"
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
<!-- jQuery untuk filter pencarian -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $("#searchInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#example1 tbody tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<!-- modal edit -->
<?php foreach ($guru as $row): ?>
    <div class="modal fade" id="edit<?= $row['id_guru'] ?>" tabindex="-1" aria-labelledby="edit<?= $row['id_guru'] ?>"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit<?= $row['id_guru'] ?>">Edit Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/update_guru" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_guru" value="<?= $row['id_guru'] ?>">
                        <input type="hidden" name="foto_lama" value="<?= $row['foto'] ?>">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="nip">NIP</label>
                                    <input type="number" name="nip" id="nip" class="form-control"
                                        value="<?= $row['nip'] ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control"
                                        value="<?= $row['nama'] ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="id_jabatan">Jabatan</label>
                                    <select name="id_jabatan" id="id_jabatan" class="form-control">
                                        <option value="">Pilih Jabatan</option>
                                        <?php foreach ($jabatan as $jab): ?>
                                            <option value="<?= $jab['id_jabatan'] ?>" <?= $jab['id_jabatan'] == $row['id_jabatan'] ? 'selected' : '' ?>>
                                                <?= $jab['nama_jabatan'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Mapel 1 -->
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="id_mapel_1">Mata Pelajaran 1</label>
                                    <select name="id_mapel1" id="id_mapel_1" class="form-control">
                                        <?php if (!empty($row['id_mapel1'])): ?>
                                            <option value="<?= $row['id_mapel1'] ?>" selected><?= $row['nama_mapel1'] ?>
                                            </option>
                                        <?php else: ?>
                                            <option value="" selected>-- Pilih Mata Pelajaran 1 --</option>
                                        <?php endif ?>
                                        <?php foreach ($mapel as $mp): ?>
                                            <option value="<?= $mp['id_mapel'] ?>"><?= $mp['nama_mapel'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Mapel 2 -->
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="id_mapel_2">Mata Pelajaran 2</label>
                                    <select name="id_mapel2" id="id_mapel_2" class="form-control">
                                        <?php if (!empty($row['id_mapel2'])): ?>
                                            <option value="<?= $row['id_mapel2'] ?>" selected><?= $row['nama_mapel2'] ?>
                                            </option>
                                        <?php else: ?>
                                            <option value="" selected>-- Pilih Mata Pelajaran 2 --</option>
                                        <?php endif ?>
                                        <?php foreach ($mapel as $mp): ?>
                                            <option value="<?= $mp['id_mapel'] ?>"><?= $mp['nama_mapel'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="foto">Foto</label>
                                    <input type="file" name="foto" id="foto<?= $row['id_guru'] ?>" class="form-control">
                                    <small class="text-muted">Max. 3MB</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="preview">Preview</label>
                                    <img src="foto_guru/<?= $row['foto'] ?>" alt="foto" width="250"
                                        id="preview<?= $row['id_guru'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                    <script>
                        document.getElementById('foto<?= $row['id_guru'] ?>').addEventListener('change', function () {
                            const file = this.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function (e) {
                                    document.getElementById('preview<?= $row['id_guru'] ?>').src = e.target.result;
                                }
                                reader.readAsDataURL(file);
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<?= $this->endSection() ?>