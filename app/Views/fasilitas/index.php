<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12 mb-3">
            <!-- card menambahkan data user -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mt-3">Tambah Fasilitas</h4>
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
                    <form action="/proses_fasilitas" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
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
                    <h4 class="card-title mt-3">Kelola Fasilitas</h4>
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
                                    <th>Keterangan</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($fasilitas as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['keterangan'] ?></td>
                                        <td><img src="/foto_fasilitas/<?= $row['foto'] ?>" alt="foto" width="100"></td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#edit<?= $row['id_fasilitas'] ?>"><i
                                                    class="fas fa-edit"></i></button>
                                            <a href="/hapus_fasilitas/<?= $row['id_fasilitas'] ?>"
                                                class="btn btn-danger btn-sm"
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
<?php foreach ($fasilitas as $row): ?>
    <div class="modal fade" id="edit<?= $row['id_fasilitas'] ?>" tabindex="-1"
        aria-labelledby="edit<?= $row['id_fasilitas'] ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit<?= $row['id_fasilitas'] ?>">Edit Fasilitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/update_fasilitas" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_fasilitas" value="<?= $row['id_fasilitas'] ?>">
                        <input type="hidden" name="foto_lama" value="<?= $row['foto'] ?>">
                        <div class="form-group mt-3">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control"
                                rows="5"><?= $row['keterangan'] ?></textarea>
                        </div>

                        <div class="form-group mt-3">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" id="foto" class="form-control">
                            <small class="text-muted">Max. 3MB</small>
                        </div>
                        <!-- preview foto -->
                        <div class="form-group mt-3">
                            <label for="preview">Preview</label>
                            <img src="foto_fasilitas/<?= $row['foto'] ?>" alt="foto" width="250" id="preview">
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

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
<!-- Tambahkan script CKEditor -->

<?= $this->endSection() ?>