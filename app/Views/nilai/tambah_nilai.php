<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">

    <!-- Notifikasi -->
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


    <div class="row">
        <!-- Informasi Siswa -->
        <div class="card col-lg-12 mb-4">
            <div class="card-body">
                <h5 class="font-weight-bold">Nama Peserta Didik: <?= $siswa['nama'] ?></h5>
                <h5 class="font-weight-bold">NISN/NIS: <?= $siswa['nisn'] ?></h5>
                <h5 class="font-weight-bold">Kelas: <?= $siswa['nama_kelas'] ?></h5>
                <h5 class="font-weight-bold">Semester: <?= $siswa['nama_semester'] ?></h5>
                <h5 class="font-weight-bold">Tahun Ajaran: <?= $siswa['tahun_ajaran'] ?></h5>
            </div>
        </div>

        <!-- Card: Tambah Nilai Mapel -->
        <div class="card col-lg-6 mb-4">
            <form action="<?= base_url('nilai/simpanMapel') ?>" method="post">
                <?= csrf_field() ?>
                <div class="card-header bg-primary text-white">
                    <strong>Input Nilai Mata Pelajaran</strong>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="id_mapel">Mata Pelajaran</label>
                        <select name="id_mapel" id="id_mapel" class="form-control" required>
                            <option value="">-- Pilih Mata Pelajaran --</option>
                            <?php foreach ($mapel as $m): ?>
                                <option value="<?= $m['id_mapel'] ?>"><?= $m['nama_mapel'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nilai_akhir">Nilai Akhir</label>
                        <input type="number" name="nilai_akhir" id="nilai_akhir" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="capaian_kompetensi">Capaian Kompetensi</label>
                        <textarea name="capaian_kompetensi" id="capaian_kompetensi" class="form-control" rows="3"
                            required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="capaian_kompetensi2">Saran</label>
                        <textarea name="capaian_kompetensi2" id="capaian_kompetensi2" class="form-control" rows="3"
                            required></textarea>
                    </div>
                    <input type="hidden" name="id_siswa" value="<?= $siswa['id_siswa'] ?>">
                    <input type="hidden" name="id_semester" value="<?= $siswa['id_semester'] ?>">
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Simpan Nilai Mapel</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Card: Ekstrakurikuler & Lain-lain -->
        <div class="card col-lg-6 mb-4">
            <form action="<?= base_url('nilai/simpanEkstra') ?>" method="post">
                <?= csrf_field() ?>
                <div class="card-header bg-success text-white">
                    <strong>Ekstrakurikuler, Ketidakhadiran & Catatan Guru</strong>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_ekskul">Ekstrakurikuler</label>
                        <select name="nama_ekskul" id="nama_ekskul" class="form-control">
                            <option value="">-- Pilih Ekstrakurikuler --</option>
                            <option value="1">Pramuka</option>
                            <option value="2">Paskibra</option>
                            <option value="3">PMR</option>
                            <option value="4">Seni Musik</option>
                            <option value="5">Seni Tari</option>
                            <option value="6">Olahraga</option>
                            <option value="7">Kesenian</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan Ekstrakurikuler</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="sakit">Sakit</label>
                        <input type="number" name="sakit" id="sakit" class="form-control" value="0">
                    </div>

                    <div class="form-group">
                        <label for="izin">Izin</label>
                        <input type="number" name="izin" id="izin" class="form-control" value="0">
                    </div>

                    <div class="form-group">
                        <label for="tanpa_keterangan">Tanpa Keterangan</label>
                        <input type="number" name="tanpa_keterangan" id="tanpa_keterangan" class="form-control"
                            value="0">
                    </div>

                    <div class="form-group">
                        <label for="catatan">Catatan Guru</label>
                        <textarea name="catatan" id="catatan" class="form-control" rows="3"></textarea>
                    </div>

                    <input type="hidden" name="id_siswa" value="<?= $siswa['id_siswa'] ?>">
                    <input type="hidden" name="id_semester" value="<?= $siswa['id_semester'] ?>">

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Simpan Ekstrakurikuler</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tabel Nilai Mapel -->
        <div class="card col-lg-12 mb-4">
            <div class="card-header bg-success text-white">
                <strong>Daftar Nilai Mata Pelajaran</strong>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai Akhir</th>
                            <th>Capaian Kompetensi</th>
                            <th>Guru yang memberi nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($nilai_mapel)): ?>
                            <?php $no = 1;
                            foreach ($nilai_mapel as $n): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $n['nama_mapel'] ?></td>
                                    <td><?= $n['nilai_akhir'] ?></td>
                                    <td><?= $n['capaian_kompetensi'] ?></td>
                                    <td><?= $n['nama'] ?></td>
                                    <td>
                                        <a href="<?= base_url('nilai/edit/' . $n['id_nilai']) ?>"
                                            class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Belum ada nilai yang dimasukkan.</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>



    </div>
</div>

<?= $this->endSection() ?>