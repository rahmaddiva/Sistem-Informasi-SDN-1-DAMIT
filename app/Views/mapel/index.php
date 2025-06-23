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

                    <!-- button tambah modal -->
                    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal"
                        data-bs-target="#tambahMapelModal">
                        Tambah Mata Pelajaran
                    </button>

                    <!-- modal tambah mapel -->
                    <div class="modal fade" id="tambahMapelModal" tabindex="-1" aria-labelledby="tambahMapelModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tambahMapelModalLabel">Tambah Mata Pelajaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="<?= base_url('mapel/proses') ?>" method="post">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nama_mapel" class="form-label">Nama Mata Pelajaran</label>
                                            <select class="form-control" id="nama_mapel" name="nama_mapel" required>
                                                <option value="">Pilih Mata Pelajaran</option>
                                                <option value="Matematika">Matematika</option>
                                                <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                                                <option value="Bahasa Inggris">Bahasa Inggris</option>
                                                <option value="Ilmu Pengetahuan Alam & Sosial">Ilmu Pengetahuan Alam
                                                </option>
                                                <option value="Pendidikan Agama & Budi Pekerti">Pendidikan Agama & Budi
                                                    Pekerti</option>
                                                <option value="Pendidikan Pancasila">Pendidikan Pancasila</option>
                                                <option value="Seni Rupa">Seni Rupa</option>
                                                <option value="Seni Musik">Seni Musik</option>
                                                <option value="Pendidikan Al-Quran">Pendidikan Al-Quran</option>
                                                <option value="Seni Tari">Seni Tari</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="id_guru" class="form-label">Guru Pengajar</label>
                                            <select class="form-select" id="id_guru" name="id_guru" required>
                                                <option value="">Pilih Guru</option>
                                                <?php foreach ($guru as $guruItem): ?>
                                                    <option value="<?= $guruItem['id_guru'] ?>">
                                                        <?= $guruItem['nama'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table id="order-listing" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mata Pelajaran</th>
                                    <th>Guru Pengajar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($mapel as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nama_mapel'] ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td>
                                            <!-- button edit modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editMapelModal<?= $row['id_mapel'] ?>">
                                                Edit
                                            </button>
                                            <!-- modal edit mapel  -->
                                            <div class="modal fade" id="editMapelModal<?= $row['id_mapel'] ?>" tabindex="-1"
                                                aria-labelledby="editMapelModalLabel<?= $row['id_mapel'] ?>"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editMapelModalLabel<?= $row['id_mapel'] ?>">Edit
                                                                Mata Pelajaran</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="<?= base_url('mapel/proses') ?>" method="post">
                                                            <input type="hidden" name="id_mapel"
                                                                value="<?= $row['id_mapel'] ?>">
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="nama_mapel" class="form-label">Nama Mata
                                                                        Pelajaran</label>
                                                                    <select class="form-control" id="nama_mapel"
                                                                        name="nama_mapel" required>
                                                                        <option value="">Pilih Mata Pelajaran</option>
                                                                        <option value="Matematika"
                                                                            <?= ($row['nama_mapel'] == 'Matematika') ? 'selected' : '' ?>>
                                                                            Matematika</option>
                                                                        <option value="Bahasa Indonesia"
                                                                            <?= ($row['nama_mapel'] == 'Bahasa Indonesia') ? 'selected' : '' ?>>
                                                                            Bahasa Indonesia</option>
                                                                        <option value="Bahasa Inggris"
                                                                            <?= ($row['nama_mapel'] == 'Bahasa Inggris') ? 'selected' : '' ?>>
                                                                            Bahasa Inggris</option>
                                                                        <option value="Ilmu Pengetahuan Alam & Sosial"
                                                                            <?= ($row['nama_mapel'] == 'Ilmu Pengetahuan Alam & Sosial') ? 'selected' : '' ?>>
                                                                            Ilmu Pengetahuan Alam & Sosial</option>
                                                                        <option value="Pendidikan Agama & Budi Pekerti"
                                                                            <?= ($row['nama_mapel'] == 'Pendidikan Agama & Budi Pekerti') ? 'selected' : '' ?>>
                                                                            Pendidikan Agama & Budi Pekerti</option>
                                                                        <option value="Pendidikan Pancasila"
                                                                            <?= ($row['nama_mapel'] == 'Pendidikan Pancasila') ? 'selected' : '' ?>>
                                                                            Pendidikan Pancasila</option>
                                                                        <option value="Seni Rupa"
                                                                            <?= ($row['nama_mapel'] == 'Seni Rupa') ? 'selected' : '' ?>>
                                                                            Seni Rupa</option>
                                                                        <option value="Seni Musik"
                                                                            <?= ($row['nama_mapel'] == 'Seni Musik') ? 'selected' : '' ?>>
                                                                            Seni Musik</option>
                                                                        <option value="Pendidikan Al-Quran"
                                                                            <?= ($row['nama_mapel'] == 'Pendidikan Al-Quran') ? 'selected' : '' ?>>
                                                                            Pendidikan Al-Quran</option>
                                                                        <option value="Seni Tari"
                                                                            <?= ($row['nama_mapel'] == 'Seni Tari') ? 'selected' : '' ?>>
                                                                            Seni Tari</option>
                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        Silakan pilih mata pelajaran.
                                                                    </div>

                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="id_guru" class="form-label">Guru
                                                                        Pengajar</label>
                                                                    <select class="form-select" id="id_guru" name="id_guru"
                                                                        required>
                                                                        <?php foreach ($guru as $guruItem): ?>
                                                                            <option value="<?= $guruItem['id_guru'] ?>"
                                                                                <?= ($guruItem['id_guru'] == $row['id_guru']) ? 'selected' : '' ?>>
                                                                                <?= $guruItem['nama'] ?>
                                                                            </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-primary">Simpan
                                                                    Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>


                                            <a href="<?= base_url('mapel/hapus/' . $row['id_mapel']) ?>"
                                                class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                                Hapus
                                            </a>
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
</div>

<?= $this->endSection() ?>