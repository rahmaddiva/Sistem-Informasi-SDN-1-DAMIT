<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<style>
    .profile-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        overflow: hidden;
    }

    .profile-header {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        padding: 30px;
        text-align: center;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border: 4px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    .profile-info {
        background: rgba(255, 255, 255, 0.05);
        padding: 25px 30px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        opacity: 0.9;
    }

    .info-value {
        font-weight: 500;
        color: #fff;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-active {
        background: #28a745;
        color: white;
    }

    .grades-section {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .grades-header {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
        padding: 20px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .grades-stats {
        display: flex;
        gap: 20px;
        font-size: 14px;
    }

    .stat-item {
        text-align: center;
    }

    .stat-value {
        font-size: 18px;
        font-weight: bold;
        display: block;
    }

    .grades-table {
        margin: 0;
    }

    .grades-table thead th {
        background: #f8f9fa;
        border: none;
        padding: 15px 20px;
        font-weight: 600;
        color: #495057;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
    }

    .grades-table tbody td {
        padding: 15px 20px;
        border: none;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
    }

    .grades-table tbody tr:hover {
        background: #f8f9fa;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .grade-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 14px;
        min-width: 60px;
        text-align: center;
    }

    .grade-excellent {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .grade-good {
        background: #d1ecf1;
        color: #0c5460;
        border: 1px solid #bee5eb;
    }

    .grade-average {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #faeeba;
    }

    .grade-poor {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f1b0b7;
    }

    .subject-name {
        font-weight: 500;
        color: #2c3e50;
    }

    .no-data {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
    }

    .no-data i {
        font-size: 48px;
        margin-bottom: 15px;
        opacity: 0.5;
    }

    .summary-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 25px;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 20px;
        margin-top: 15px;
    }

    .summary-item {
        text-align: center;
        padding: 15px;
        border-radius: 10px;
        background: #f8f9fa;
    }

    .summary-number {
        font-size: 24px;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .summary-label {
        font-size: 12px;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>

<div class="content-wrapper">
    <!-- Profile Section -->
    <div class="row justify-content-center mb-4">
        <div class="col-lg-8">
            <div class="card profile-card">
                <div class="profile-header">
                    <?php if (!empty($siswa['foto']) && file_exists(FCPATH . 'foto_siswa/' . $siswa['foto'])) : ?>
                        <img src="<?= base_url('foto_siswa/' . $siswa['foto']) ?>" alt="Foto Siswa" class="profile-avatar rounded-circle mb-3" />
                    <?php else : ?>
                        <img src="<?= base_url('assets/img/default-user.png') ?>" alt="Foto Default" class="profile-avatar rounded-circle mb-3" />
                    <?php endif; ?>

                    <h2 class="mb-2"><?= esc($siswa['nama']) ?></h2>
                    <p class="mb-0 opacity-75">Siswa - <?= esc($siswa['nama_kelas']) ?></p>
                </div>

                <div class="profile-info">
                    <div class="info-item">
                        <span class="info-label">
                            <i class="mdi mdi-card-account-details-outline me-2"></i>
                            Nomor Induk Siswa
                        </span>
                        <span class="info-value"><?= esc($siswa['nisn']) ?></span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">
                            <i class="mdi mdi-google-classroom me-2"></i>
                            Kelas
                        </span>
                        <span class="info-value"><?= esc($siswa['nama_kelas']) ?></span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">
                            <i class="mdi mdi-account-tie me-2"></i>
                            Wali Kelas
                        </span>
                        <span class="info-value"><?= esc($siswa['nama_guru']) ?></span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">
                            <i class="mdi mdi-calendar-range me-2"></i>
                            Semester
                        </span>
                        <span class="info-value"><?= esc($siswa['nama_semester']) ?> (<?= esc($siswa['tahun_ajaran']) ?>)</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">
                            <i class="mdi mdi-check-circle-outline me-2"></i>
                            Status
                        </span>
                        <span class="status-badge status-active">Aktif</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Statistics -->
    <?php if (!empty($nilai)) :
        $total_mapel = count($nilai);
        $total_nilai = array_sum(array_column($nilai, 'nilai_raport'));
        $rata_rata = $total_mapel > 0 ? round($total_nilai / $total_mapel, 2) : 0;

        // Hitung distribusi nilai
        $excellent = count(array_filter($nilai, function ($n) {
            return $n['nilai_raport'] >= 85;
        }));
        $good = count(array_filter($nilai, function ($n) {
            return $n['nilai_raport'] >= 75 && $n['nilai_raport'] < 85;
        }));
        $average = count(array_filter($nilai, function ($n) {
            return $n['nilai_raport'] >= 65 && $n['nilai_raport'] < 75;
        }));
        $poor = count(array_filter($nilai, function ($n) {
            return $n['nilai_raport'] < 65;
        }));
    ?>
        <div class="row">
            <div class="col-12">
                <div class="summary-card">
                    <h5 class="mb-0">
                        <i class="mdi mdi-chart-line text-primary me-2"></i>
                        Ringkasan Akademik
                    </h5>
                    <div class="summary-grid">
                        <div class="summary-item">
                            <div class="summary-number text-primary"><?= $total_mapel ?></div>
                            <div class="summary-label">Total Mata Pelajaran</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-number text-success"><?= number_format($rata_rata, 1) ?></div>
                            <div class="summary-label">Rata-rata Nilai</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-number text-info"><?= $excellent ?></div>
                            <div class="summary-label">Nilai Sangat Baik</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-number text-warning"><?= $good ?></div>
                            <div class="summary-label">Nilai Baik</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Grades Section -->
    <div class="row">
        <div class="col-12">
            <div class="grades-section">
                <div class="grades-header">
                    <div>
                        <h4 class="mb-0">
                            <i class="mdi mdi-book-open-page-variant me-2"></i>
                            Daftar Nilai Mata Pelajaran
                        </h4>
                        <small class="opacity-75">Semester <?= esc($siswa['nama_semester']) ?> - <?= esc($siswa['tahun_ajaran']) ?></small>
                    </div>

                    <?php if (!empty($nilai)) : ?>
                        <div class="grades-stats">
                            <div class="stat-item">
                                <span class="stat-value"><?= $total_mapel ?></span>
                                <span>Mapel</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value"><?= number_format($rata_rata, 1) ?></span>
                                <span>Rata-rata</span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="table-responsive">
                    <table class="table grades-table">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="40%">Mata Pelajaran</th>
                                <th width="20%">Guru Pengajar</th>
                                <th width="15%">Nilai Raport</th>
                                <th width="20%">Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($nilai)) : ?>
                                <?php foreach ($nilai as $index => $n) :
                                    $nilai_raport = (float)$n['nilai_raport'];
                                    $grade_class = '';
                                    $kategori = '';

                                    if ($nilai_raport >= 85) {
                                        $grade_class = 'grade-excellent';
                                        $kategori = 'Sangat Baik';
                                    } elseif ($nilai_raport >= 75) {
                                        $grade_class = 'grade-good';
                                        $kategori = 'Baik';
                                    } elseif ($nilai_raport >= 65) {
                                        $grade_class = 'grade-average';
                                        $kategori = 'Cukup';
                                    } else {
                                        $grade_class = 'grade-poor';
                                        $kategori = 'Perlu Perbaikan';
                                    }
                                ?>
                                    <tr>
                                        <td class="text-muted"><?= $index + 1 ?></td>
                                        <td>
                                            <div class="subject-name"><?= esc($n['nama_mapel']) ?></div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-account-circle text-muted me-2"></i>
                                                <?= esc($n['nama_guru'] ?? 'Belum ditentukan') ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="grade-badge <?= $grade_class ?>">
                                                <?= number_format($nilai_raport, 0) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge <?= $grade_class ?>"><?= $kategori ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5">
                                        <div class="no-data">
                                            <i class="mdi mdi-book-open-outline"></i>
                                            <h6>Belum Ada Nilai</h6>
                                            <p class="text-muted mb-0">Data nilai untuk siswa ini belum tersedia.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>