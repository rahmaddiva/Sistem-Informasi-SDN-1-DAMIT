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
        <div class="col-lg-12 mb-4">
            <div class="card">
                <form action="<?= base_url('nilai/simpanMapel') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="card-header bg-primary text-white">
                        <strong>Input Nilai Mata Pelajaran</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Mata Pelajaran & Semester -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="id_mapel">Mata Pelajaran <span class="text-danger">*</span></label>
                                    <input type="hidden" name="id_semester" value="<?= $siswa['id_semester'] ?>">
                                    <select name="id_mapel" id="id_mapel" class="form-control" required>
                                        <option value="">-- Pilih Mata Pelajaran --</option>
                                        <?php foreach ($mapel as $m): ?>
                                            <option value="<?= $m['id_mapel'] ?>"><?= $m['nama_mapel'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Nilai Formatif (TP 1-20) -->
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-primary mb-3"><i class="fas fa-edit"></i> Nilai Formatif (Tujuan
                                    Pembelajaran)</h6>
                                <div class="row">
                                    <?php for ($i = 1; $i <= 20; $i++): ?>
                                        <div class="col-md-3 col-sm-6 mb-2">
                                            <label for="tp<?= $i ?>" class="form-label">TP <?= $i ?></label>
                                            <input type="number" name="tp<?= $i ?>" id="tp<?= $i ?>"
                                                class="form-control form-control-sm" min="0" max="100" step="0.01"
                                                placeholder="0-100">
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Nilai Sumatif Per Bab -->
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-success mb-3"><i class="fas fa-book"></i> Nilai Sumatif Per Bab</h6>
                                <div class="row">
                                    <?php for ($i = 1; $i <= 6; $i++): ?>
                                        <div class="col-md-4 col-sm-6 mb-3">
                                            <label for="sumatif_lingkup_bab<?= $i ?>" class="form-label">Sumatif Bab
                                                <?= $i ?></label>
                                            <input type="number" name="sumatif_lingkup_bab<?= $i ?>"
                                                id="sumatif_lingkup_bab<?= $i ?>" class="form-control" min="0" max="100"
                                                step="0.01" placeholder="0-100">
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Nilai Sumatif Semester -->
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-warning mb-3"><i class="fas fa-calendar"></i> Nilai Sumatif Semester
                                </h6>
                                <div class="row">
                                    <?php for ($i = 1; $i <= 6; $i++): ?>
                                        <div class="col-md-4 col-sm-6 mb-3">
                                            <label for="sumatif_semester_bab<?= $i ?>" class="form-label">Sumatif Semester
                                                Bab <?= $i ?></label>
                                            <input type="number" name="sumatif_semester_bab<?= $i ?>"
                                                id="sumatif_semester_bab<?= $i ?>" class="form-control" min="0" max="100"
                                                step="0.01" placeholder="0-100">
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Nilai Rata-rata dan Akhir -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="rata_formatif">Rata-rata Formatif</label>
                                    <input type="number" name="rata_formatif" id="rata_formatif" class="form-control"
                                        min="0" max="100" step="0.01" placeholder="0-100">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="rata_sumatif">Rata-rata Sumatif</label>
                                    <input type="number" name="rata_sumatif" id="rata_sumatif" class="form-control"
                                        min="0" max="100" step="0.01" placeholder="0-100">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="nilai_akhir">Nilai Akhir</label>
                                    <input type="number" name="nilai_akhir" id="nilai_akhir" class="form-control"
                                        min="0" max="100" step="0.01" placeholder="0-100" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="nilai_raport">Nilai Raport</label>
                                    <input type="number" name="nilai_raport" id="nilai_raport" class="form-control"
                                        min="0" max="100" step="0.01" placeholder="0-100">
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">
                        <!-- Capaian Kompetensi -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="capaian_kompetensi">Capaian Kompetensi</label>
                                    <textarea name="capaian_kompetensi" id="capaian_kompetensi" class="form-control"
                                        rows="4" placeholder="Deskripsikan capaian kompetensi siswa..."></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="capaian_kompetensi2">Saran Perbaikan</label>
                                    <textarea name="capaian_kompetensi2" id="capaian_kompetensi2" class="form-control"
                                        rows="4" placeholder="Berikan saran untuk perbaikan pembelajaran..."></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Hidden Fields -->
                        <input type="hidden" name="id_siswa" value="<?= $siswa['id_siswa'] ?>">
                        <!-- Action Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <div class="text-end">
                                    <a href="<?= base_url('kelola_nilai') ?>" class="btn btn-secondary me-2">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                    <script>
                                        // Fungsi untuk menghitung rata-rata otomatis
                                        function hitungRataRata() {
                                            // Hitung rata-rata formatif (TP 1-20)
                                            let totalFormatif = 0;
                                            let countFormatif = 0;

                                            for (let i = 1; i <= 20; i++) {
                                                let nilai = parseFloat(document.getElementById('tp' + i).value) || 0;
                                                if (nilai > 0) {
                                                    totalFormatif += nilai;
                                                    countFormatif++;
                                                }
                                            }

                                            let rataFormatif = countFormatif > 0 ? Math.round(totalFormatif / countFormatif) : 0;
                                            document.getElementById('rata_formatif').value = rataFormatif;

                                            // Hitung rata-rata sumatif (Gabungan Bab + Semester)
                                            let totalSumatif = 0;
                                            let countSumatif = 0;

                                            // Sumatif per bab
                                            for (let i = 1; i <= 6; i++) {
                                                let nilai = parseFloat(document.getElementById('sumatif_lingkup_bab' + i).value) || 0;
                                                if (nilai > 0) {
                                                    totalSumatif += nilai;
                                                    countSumatif++;
                                                }
                                            }

                                            // Sumatif semester
                                            for (let i = 1; i <= 6; i++) {
                                                let nilai = parseFloat(document.getElementById('sumatif_semester_bab' + i).value) || 0;
                                                if (nilai > 0) {
                                                    totalSumatif += nilai;
                                                    countSumatif++;
                                                }
                                            }

                                            let rataSumatif = countSumatif > 0 ? Math.round(totalSumatif / countSumatif) : 0;
                                            document.getElementById('rata_sumatif').value = rataSumatif;

                                            // Hitung nilai akhir (50% formatif + 50% sumatif)
                                            let nilaiAkhir = 0;
                                            if (rataFormatif > 0 && rataSumatif > 0) {
                                                nilaiAkhir = Math.round((rataFormatif + rataSumatif) / 2);
                                            } else if (rataFormatif > 0) {
                                                nilaiAkhir = rataFormatif;
                                            } else if (rataSumatif > 0) {
                                                nilaiAkhir = rataSumatif;
                                            }

                                            document.getElementById('nilai_akhir').value = nilaiAkhir;
                                            document.getElementById('nilai_raport').value = nilaiAkhir;

                                            // Tampilkan hasil perhitungan
                                            console.log('Hasil Perhitungan:');
                                            console.log('Rata-rata Formatif: ' + rataFormatif);
                                            console.log('Rata-rata Sumatif: ' + rataSumatif);
                                            console.log('Nilai Akhir: ' + nilaiAkhir);
                                        }

                                        // Auto calculate saat input berubah (real-time)
                                        function autoCalculateOnChange() {
                                            // Hitung rata-rata formatif (TP 1-20)
                                            let totalFormatif = 0;
                                            let countFormatif = 0;

                                            for (let i = 1; i <= 20; i++) {
                                                let nilai = parseFloat(document.getElementById('tp' + i).value) || 0;
                                                if (nilai > 0) {
                                                    totalFormatif += nilai;
                                                    countFormatif++;
                                                }
                                            }

                                            let rataFormatif = countFormatif > 0 ? Math.round(totalFormatif / countFormatif) : 0;
                                            document.getElementById('rata_formatif').value = rataFormatif;

                                            // Hitung rata-rata sumatif (Gabungan Bab + Semester)
                                            let totalSumatif = 0;
                                            let countSumatif = 0;

                                            // Sumatif per bab
                                            for (let i = 1; i <= 6; i++) {
                                                let nilai = parseFloat(document.getElementById('sumatif_lingkup_bab' + i).value) || 0;
                                                if (nilai > 0) {
                                                    totalSumatif += nilai;
                                                    countSumatif++;
                                                }
                                            }

                                            // Sumatif semester
                                            for (let i = 1; i <= 6; i++) {
                                                let nilai = parseFloat(document.getElementById('sumatif_semester_bab' + i).value) || 0;
                                                if (nilai > 0) {
                                                    totalSumatif += nilai;
                                                    countSumatif++;
                                                }
                                            }

                                            let rataSumatif = countSumatif > 0 ? Math.round(totalSumatif / countSumatif) : 0;
                                            document.getElementById('rata_sumatif').value = rataSumatif;

                                            // Hitung nilai akhir (50% formatif + 50% sumatif)
                                            let nilaiAkhir = 0;
                                            if (rataFormatif > 0 && rataSumatif > 0) {
                                                nilaiAkhir = Math.round((rataFormatif + rataSumatif) / 2);
                                            } else if (rataFormatif > 0) {
                                                nilaiAkhir = rataFormatif;
                                            } else if (rataSumatif > 0) {
                                                nilaiAkhir = rataSumatif;
                                            }

                                            document.getElementById('nilai_akhir').value = nilaiAkhir;
                                            document.getElementById('nilai_raport').value = nilaiAkhir;
                                        }

                                        // Event listeners untuk auto calculate saat input berubah
                                        document.addEventListener('DOMContentLoaded', function () {
                                            const inputs = document.querySelectorAll('input[type="number"]');
                                            inputs.forEach(input => {
                                                if (input.name.startsWith('tp') || input.name.startsWith('sumatif')) {
                                                    // Auto calculate saat user mengetik (dengan debounce)
                                                    input.addEventListener('input', function () {
                                                        clearTimeout(this.calculateTimeout);
                                                        this.calculateTimeout = setTimeout(autoCalculateOnChange, 500);
                                                    });

                                                    // Auto calculate saat focus keluar dari input
                                                    input.addEventListener('blur', autoCalculateOnChange);
                                                }
                                            });
                                        });
                                    </script>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> Simpan Nilai
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php if (session()->get('level') == 'wali_kelas'): ?>
            <div class="card col-lg-6 mb-4">
                <form action="<?= base_url('nilai/simpanEkstra') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="card-header bg-warning text-white">
                        <strong>Ekstrakurikuler, Ketidakhadiran & Catatan Guru</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_ekskul">Ekstrakurikuler</label>
                            <select name="nama_ekskul" id="nama_ekskul" class="form-control">
                                <option value="">-- Pilih Ekstrakurikuler --</option>
                                <option value="Pramuka">Pramuka</option>
                                <option value="Paskibra">Paskibra</option>
                                <option value="PMR">PMR</option>
                                <option value="Seni Musik">Seni Musik</option>
                                <option value="Seni Tari">Seni Tari</option>
                                <option value="Olahraga">Olahraga</option>
                                <option value="Kesenian">Kesenian</option>
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
        <?php endif; ?>

        <!-- Tabel Nilai Mapel -->
        <div class="card col-lg-12 mb-4">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <strong><i class="fas fa-table"></i> Daftar Nilai Mata Pelajaran</strong>
                <div>
                    <button class="btn btn-light btn-sm" onclick="toggleDetailView()">
                        <i class="fas fa-eye" id="toggleIcon"></i> <span id="toggleText">Detail</span>
                    </button>
                    <button class="btn btn-light btn-sm" onclick="exportToExcel()">
                        <i class="fas fa-file-excel"></i> Export
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- View Ringkas (Default) -->
                <div id="simpleView">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="tableNilai">
                            <thead class="table-dark">
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th width="20%">Mata Pelajaran</th>
                            <th class="text-center" width="10%">Semester</th>
                            <th class="text-center" width="12%">Rata Formatif</th>
                            <th class="text-center" width="12%">Rata Sumatif</th>
                            <th class="text-center" width="10%">Nilai Akhir</th>
                            <th class="text-center" width="10%">Nilai Raport</th>
                            <th width="15%">Guru</th>
                            <th class="text-center" width="8%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($nilai_mapel)): ?>
                                <?php $no = 1;
                                foreach ($nilai_mapel as $n): ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td>
                                                <strong><?= $n['nama_mapel'] ?></strong>
                                                <br><small class="text-muted">Kode: <?= $n['kode_mapel'] ?? '-' ?></small>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-primary">Semester <?= $n['nama_semester'] ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-info"><?= $n['rata_formatif'] ?? '-' ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-warning"><?= $n['rata_sumatif'] ?? '-' ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-success"><?= $n['nilai_raport'] ?? '-' ?></span>
                                            </td>
                                            <td>
                                                <small><?= $n['nama_guru'] ?? $n['nama'] ?? '-' ?></small>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-info btn-sm" 
                                                            onclick="showDetail(<?= $n['id_nilai'] ?>)" 
                                                            title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <a href="<?= base_url('nilai/edit/' . $n['id_nilai']) ?>" 
                                                       class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm" 
                                                            onclick="deleteNilai(<?= $n['id_nilai'] ?>)" 
                                                            title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                <?php endforeach ?>
                        <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <br><strong>Belum ada nilai yang dimasukkan.</strong>
                                        <br><small class="text-muted">Mulai tambahkan nilai untuk siswa ini.</small>
                                    </td>
                                </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- View Detail (Hidden by default) -->
        <div id="detailView" style="display: none;">
            <?php if (!empty($nilai_mapel)): ?>
                    <?php foreach ($nilai_mapel as $index => $n): ?>
                            <div class="card mb-3 border-primary">
                                <div class="card-header bg-primary text-white">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <h6 class="mb-0">
                                                <i class="fas fa-book"></i> <?= $n['nama_mapel'] ?>
                                                <span class="badge bg-light text-dark ms-2">Semester <?= $n['nama_semester'] ?></span>
                                            </h6>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <span class="badge bg-warning fs-6">Nilai Raport: <?= $n['nilai_raport'] ?? '-' ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Nilai Formatif -->
                                        <div class="col-md-6 mb-3">
                                            <h6 class="text-primary"><i class="fas fa-edit"></i> Nilai Formatif (TP)</h6>
                                            <div class="row">
                                                <?php for ($i = 1; $i <= 20; $i++): ?>
                                                        <?php if (!empty($n["tp{$i}"])): ?>
                                                                <div class="col-md-3 col-sm-4 col-6 mb-1">
                                                                    <small>TP<?= $i ?>: <span class="badge bg-info"><?= $n["tp{$i}"] ?></span></small>
                                                                </div>
                                                        <?php endif; ?>
                                                <?php endfor; ?>
                                            </div>
                                            <div class="mt-2">
                                                <strong>Rata-rata Formatif: <span class="text-primary"><?= $n['rata_formatif'] ?? '-' ?></span></strong>
                                            </div>
                                        </div>

                                        <!-- Nilai Sumatif -->
                                        <div class="col-md-6 mb-3">
                                            <h6 class="text-success"><i class="fas fa-book-open"></i> Nilai Sumatif</h6>
                                    
                                            <!-- Sumatif Per Bab -->
                                            <div class="mb-2">
                                                <small class="fw-bold">Per Bab:</small>
                                                <div class="row">
                                                    <?php for ($i = 1; $i <= 6; $i++): ?>
                                                            <?php if (!empty($n["sumatif_bab{$i}"])): ?>
                                                                    <div class="col-md-4 col-6 mb-1">
                                                                        <small>Bab<?= $i ?>: <span class="badge bg-success"><?= $n["sumatif_bab{$i}"] ?></span></small>
                                                                    </div>
                                                            <?php endif; ?>
                                                    <?php endfor; ?>
                                                </div>
                                            </div>

                                            <!-- Sumatif Semester -->
                                            <div class="mb-2">
                                                <small class="fw-bold">Semester:</small>
                                                <div class="row">
                                                    <?php for ($i = 1; $i <= 6; $i++): ?>
                                                            <?php if (!empty($n["sumatif_semester_bab{$i}"])): ?>
                                                                    <div class="col-md-4 col-6 mb-1">
                                                                        <small>Sem Bab<?= $i ?>: <span class="badge bg-warning"><?= $n["sumatif_semester_bab{$i}"] ?></span></small>
                                                                    </div>
                                                            <?php endif; ?>
                                                    <?php endfor; ?>
                                                </div>
                                            </div>

                                            <div class="mt-2">
                                                <strong>Rata-rata Sumatif: <span class="text-success"><?= $n['rata_sumatif'] ?? '-' ?></span></strong>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Nilai Akhir dan Capaian -->
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <h4 class="text-primary mb-1"><?= $n['nilai_raport'] ?? '-' ?></h4>
                                                <small class="text-muted">Nilai Raport</small>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6 class="text-info">Capaian Kompetensi:</h6>
                                                    <p class="small"><?= $n['capaian_kompetensi'] ?? 'Belum ada capaian kompetensi' ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 class="text-warning">Saran:</h6>
                                                    <p class="small"><?= $n['capaian_kompetensi2'] ?? 'Belum ada saran' ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Info Guru dan Aksi -->
                                    <hr>
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <small class="text-muted">
                                                <i class="fas fa-user"></i> Guru: <?= $n['nama_guru'] ?? $n['nama'] ?? '-' ?>
                                            </small>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <a href="<?= base_url('nilai/edit/' . $n['id_nilai']) ?>" 
                                               class="btn btn-warning btn-sm me-1">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" 
                                                    onclick="deleteNilai(<?= $n['id_nilai'] ?>)">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php endforeach; ?>
            <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                        <h5>Belum ada nilai yang dimasukkan</h5>
                        <p class="text-muted">Mulai tambahkan nilai untuk siswa ini.</p>
                    </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal Detail Nilai -->
<div class="modal fade" id="modalDetailNilai" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Detail Nilai</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalDetailContent">
                <!-- Content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
// Toggle antara view simple dan detail
function toggleDetailView() {
    const simpleView = document.getElementById('simpleView');
    const detailView = document.getElementById('detailView');
    const toggleIcon = document.getElementById('toggleIcon');
    const toggleText = document.getElementById('toggleText');
    
    if (simpleView.style.display === 'none') {
        simpleView.style.display = 'block';
        detailView.style.display = 'none';
        toggleIcon.className = 'fas fa-eye';
        toggleText.textContent = 'Detail';
    } else {
        simpleView.style.display = 'none';
        detailView.style.display = 'block';
        toggleIcon.className = 'fas fa-table';
        toggleText.textContent = 'Tabel';
    }
}

// Show detail dalam modal
function showDetail(idNilai) {
    // Implementation untuk load detail via AJAX
    // atau bisa langsung scroll ke detail view
    toggleDetailView();
}

// Delete nilai dengan konfirmasi
function deleteNilai(idNilai) {
    if (confirm('Apakah Anda yakin ingin menghapus nilai ini?')) {
        window.location.href = '<?= base_url('nilai/delete/') ?>' + idNilai;
    }
}

// Export ke Excel
function exportToExcel() {
    const table = document.getElementById('tableNilai');
    const wb = XLSX.utils.table_to_book(table);
    XLSX.writeFile(wb, 'nilai_siswa.xlsx');
}

// Initialize DataTable jika menggunakan DataTables
$(document).ready(function() {
    $('#tableNilai').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        },
        "pageLength": 10,
        "responsive": true,
        "dom": 'Bfrtip',
        "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});
</script>

<style>
.badge {
    font-size: 0.75em;
}

.card-header .btn-light {
    color: #000;
    border-color: rgba(255,255,255,0.3);
}

.card-header .btn-light:hover {
    background-color: rgba(255,255,255,0.2);
    color: #fff;
}

.table th {
    vertical-align: middle;
    text-align: center;
}

.btn-group .btn {
    margin: 0 1px;
}

@media (max-width: 768px) {
    .btn-group {
        flex-direction: column;
    }
    
    .btn-group .btn {
        margin: 1px 0;
    }
}
</style>



        <?php if (session()->get('level') == 'wali_kelas'): ?>
            <!-- Lihat catatan, ekstrakurikuler dan absensi menggunakan tabel -->
            <div class="card col-lg-12 mb-4">
                <div class="card-header bg-info text-white">
                    <strong>Catatan, Ekstrakurikuler dan Absensi</strong>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Ekstrakurikuler</th>
                                <th>Keterangan</th>
                                <th>Sakit</th>
                                <th>Izin</th>
                                <th>Tanpa Keterangan</th>
                                <th>Catatan Guru</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($catatan)): ?>
                                    <?php $no = 1;
                                    foreach ($catatan as $s): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $s['nama_ekskul'] ?></td>
                                                <td><?= $s['keterangan_ekskul'] ?></td>
                                                <td><?= $s['sakit'] ?></td>
                                                <td><?= $s['izin'] ?></td>
                                                <td><?= $s['tanpa_keterangan'] ?></td>
                                                <td><?= $s['catatan'] ?></td>
                                            </tr>
                                    <?php endforeach ?>
                            <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada catatan yang dimasukkan.</td>
                                    </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>



    </div>
</div>

<?= $this->endSection() ?>