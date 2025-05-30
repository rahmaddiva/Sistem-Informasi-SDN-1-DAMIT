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
                                    <select name="id_mapel" id="id_mapel" class="form-control" required>
                                        <option value="">-- Pilih Mata Pelajaran --</option>
                                        <?php foreach ($mapel as $m): ?>
                                            <option value="<?= $m['id_mapel'] ?>"><?= $m['nama_mapel'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="id_semester">Semester <span class="text-danger">*</span></label>
                                    <select name="id_semester" id="id_semester" class="form-control" required>
                                        <option value="">-- Pilih Semester --</option>
                                        <option value="1">Semester 1</option>
                                        <option value="2">Semester 2</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Nilai Formatif (TP 1-20) -->
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-primary mb-3"><i class="fas fa-edit"></i> Nilai Formatif (Tujuan Pembelajaran)</h6>
                                <div class="row">
                                    <?php for ($i = 1; $i <= 20; $i++): ?>
                                        <div class="col-md-3 col-sm-6 mb-2">
                                            <label for="tp<?= $i ?>" class="form-label">TP <?= $i ?></label>
                                            <input type="number" name="tp<?= $i ?>" id="tp<?= $i ?>" 
                                                   class="form-control form-control-sm" 
                                                   min="0" max="100" step="0.01" 
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
                                            <label for="sumatif_bab<?= $i ?>" class="form-label">Sumatif Bab <?= $i ?></label>
                                            <input type="number" name="sumatif_bab<?= $i ?>" id="sumatif_bab<?= $i ?>" 
                                                   class="form-control" 
                                                   min="0" max="100" step="0.01" 
                                                   placeholder="0-100">
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Nilai Sumatif Semester -->
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-warning mb-3"><i class="fas fa-calendar"></i> Nilai Sumatif Semester</h6>
                                <div class="row">
                                    <?php for ($i = 1; $i <= 6; $i++): ?>
                                        <div class="col-md-4 col-sm-6 mb-3">
                                            <label for="sumatif_semester_bab<?= $i ?>" class="form-label">Sumatif Semester Bab <?= $i ?></label>
                                            <input type="number" name="sumatif_semester_bab<?= $i ?>" id="sumatif_semester_bab<?= $i ?>" 
                                                   class="form-control" 
                                                   min="0" max="100" step="0.01" 
                                                   placeholder="0-100">
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
                                    <input type="number" name="rata_formatif" id="rata_formatif" 
                                           class="form-control" min="0" max="100" step="0.01" 
                                           placeholder="0-100">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="rata_sumatif">Rata-rata Sumatif</label>
                                    <input type="number" name="rata_sumatif" id="rata_sumatif" 
                                           class="form-control" min="0" max="100" step="0.01" 
                                           placeholder="0-100">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="nilai_akhir">Nilai Akhir</label>
                                    <input type="number" name="nilai_akhir" id="nilai_akhir" 
                                           class="form-control" min="0" max="100" step="0.01" 
                                           placeholder="0-100" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="nilai_raport">Nilai Raport</label>
                                    <input type="number" name="nilai_raport" id="nilai_raport" 
                                           class="form-control" min="0" max="100" step="0.01" 
                                           placeholder="0-100">
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">
                        <!-- Capaian Kompetensi -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="capaian_kompetensi">Capaian Kompetensi</label>
                                    <textarea name="capaian_kompetensi" id="capaian_kompetensi" 
                                              class="form-control" rows="4" 
                                              placeholder="Deskripsikan capaian kompetensi siswa..."></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="capaian_kompetensi2">Saran Perbaikan</label>
                                    <textarea name="capaian_kompetensi2" id="capaian_kompetensi2" 
                                              class="form-control" rows="4" 
                                              placeholder="Berikan saran untuk perbaikan pembelajaran..."></textarea>
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
                                                let nilai = parseFloat(document.getElementById('sumatif_bab' + i).value) || 0;
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
                                                let nilai = parseFloat(document.getElementById('sumatif_bab' + i).value) || 0;
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
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const inputs = document.querySelectorAll('input[type="number"]');
                                            inputs.forEach(input => {
                                                if (input.name.startsWith('tp') || input.name.startsWith('sumatif')) {
                                                    // Auto calculate saat user mengetik (dengan debounce)
                                                    input.addEventListener('input', function() {
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
     
        <?php if(session()->get('level') == 'wali_kelas'): ?>
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

        <?php if(session()->get('level') == 'wali_kelas'): ?>
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