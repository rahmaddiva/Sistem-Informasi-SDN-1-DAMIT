<!DOCTYPE html>
<html>

<head>
    <title>Rekap Nilai Siswa</title>
    <style>
        @page {
            size: A4;
            margin: 15mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            margin: 0;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .header p {
            margin: 5px 0;
            font-size: 12px;
        }

        .student-section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }

        .student-info {
            background-color: #f5f5f5;
            padding: 8px 12px;
            border: 1px solid #ccc;
            margin-bottom: 8px;
            border-radius: 3px;
        }

        .student-info h3 {
            margin: 0;
            font-size: 14px;
            color: #2c3e50;
        }

        .student-details {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
            font-size: 11px;
        }

        .mapel-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .mapel-table th {
            background-color: #34495e;
            color: white;
            padding: 8px 6px;
            text-align: center;
            font-weight: bold;
            font-size: 10px;
        }

        .mapel-table td {
            padding: 6px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 10px;
        }

        .mapel-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .mapel-table tbody tr:hover {
            background-color: #e8f4f8;
        }

        .nilai-bagus {
            background-color: #d4edda;
            color: #155724;
            font-weight: bold;
        }

        .nilai-sedang {
            background-color: #fff3cd;
            color: #856404;
        }

        .nilai-kurang {
            background-color: #f8d7da;
            color: #721c24;
            font-weight: bold;
        }

        .summary-row {
            background-color: #e9ecef;
            font-weight: bold;
            border-top: 2px solid #6c757d;
        }

        .page-break {
            page-break-before: always;
        }

        .footer {
            position: fixed;
            bottom: 10mm;
            right: 15mm;
            font-size: 9px;
            color: #666;
        }

        .no-data {
            text-align: center;
            color: #6c757d;
            font-style: italic;
            padding: 20px;
        }

        @media print {
            .student-section {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>REKAPITULASI NILAI SISWA</h2>
        <p><?= $nilai[0]['nama_semester'] ?> - <?= $nilai[0]['tahun_ajaran'] ?></p>
        <p>Tanggal Cetak: <?= date('d F Y') ?> </p>
    </div>

    <?php
    // Mengelompokkan data berdasarkan siswa
    $grouped_nilai = [];
    foreach ($nilai as $n) {
        $key = $n['nama_siswa'] . '_' . $n['nama_kelas'];
        if (!isset($grouped_nilai[$key])) {
            $grouped_nilai[$key] = [
                'siswa_info' => [
                    'nama' => $n['nama_siswa'],
                    'kelas' => $n['nama_kelas'],
                    'nis' => $n['nisn'] ?? '-'
                ],
                'mapel' => []
            ];
        }
        $grouped_nilai[$key]['mapel'][] = $n;
    }

    $student_count = 0;
    foreach ($grouped_nilai as $student_data):
        $student_count++;

        // Hitung statistik untuk siswa ini
        $total_mapel = count($student_data['mapel']);
        $total_nilai_raport = array_sum(array_column($student_data['mapel'], 'nilai_raport'));
        $rata_rata_raport = $total_mapel > 0 ? round($total_nilai_raport / $total_mapel, 2) : 0;

        // Page break setiap 3 siswa
        if ($student_count > 1 && ($student_count - 1) % 3 == 0): ?>
            <div class="page-break"></div>
        <?php endif; ?>

        <div class="student-section">
            <div class="student-info">
                <h3><?= htmlspecialchars($student_data['siswa_info']['nama']) ?></h3>
                <div class="student-details">
                    <span><strong>Kelas:</strong> <?= htmlspecialchars($student_data['siswa_info']['kelas']) ?></span>
                    <span><strong>NIS:</strong> <?= htmlspecialchars($student_data['siswa_info']['nis']) ?></span>
                    <span><strong>Jumlah Mapel:</strong> <?= $total_mapel ?></span>
                    <span><strong>Rata-rata Raport:</strong> <?= $rata_rata_raport ?></span>
                </div>
            </div>

            <?php if (count($student_data['mapel']) > 0): ?>
                <table class="mapel-table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 25%;">Mata Pelajaran</th>
                            <th style="width: 20%;">Guru Pengajar</th>
                            <th style="width: 12%;">Nilai Raport</th>
                            <th style="width: 12%;">Rata Formatif</th>
                            <th style="width: 12%;">Rata Sumatif</th>
                            <th style="width: 14%;">Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($student_data['mapel'] as $mapel):
                            // Tentukan kategori nilai
                            $nilai_raport = (float) $mapel['nilai_raport'];
                            $kategori = '';
                            $class_nilai = '';

                            if ($nilai_raport >= 85) {
                                $kategori = 'Sangat Baik';
                                $class_nilai = 'nilai-bagus';
                            } elseif ($nilai_raport >= 75) {
                                $kategori = 'Baik';
                                $class_nilai = 'nilai-sedang';
                            } elseif ($nilai_raport >= 65) {
                                $kategori = 'Cukup';
                                $class_nilai = 'nilai-sedang';
                            } else {
                                $kategori = 'Perlu Perbaikan';
                                $class_nilai = 'nilai-kurang';
                            }
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td style="text-align: left; padding-left: 8px;">
                                    <?= htmlspecialchars($mapel['nama_mapel']) ?>
                                </td>
                                <td style="text-align: left; padding-left: 8px;">
                                    <?= htmlspecialchars($mapel['nama']) ?>
                                </td>
                                <td class="<?= $class_nilai ?>">
                                    <?= number_format($mapel['nilai_raport'], 1) ?>
                                </td>
                                <td><?= number_format($mapel['rata_formatif'], 1) ?></td>
                                <td><?= number_format($mapel['rata_sumatif'], 1) ?></td>
                                <td class="<?= $class_nilai ?>">
                                    <?= $kategori ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <!-- Baris ringkasan -->
                        <tr class="summary-row">
                            <td colspan="3" style="text-align: right; padding-right: 10px;">
                                <strong>RATA-RATA KESELURUHAN:</strong>
                            </td>
                            <td><strong><?= number_format($rata_rata_raport, 1) ?></strong></td>
                            <td><strong><?= number_format(array_sum(array_column($student_data['mapel'], 'rata_formatif')) / $total_mapel, 1) ?></strong>
                            </td>
                            <td><strong><?= number_format(array_sum(array_column($student_data['mapel'], 'rata_sumatif')) / $total_mapel, 1) ?></strong>
                            </td>
                            <td><strong>
                                    <?php
                                    if ($rata_rata_raport >= 85)
                                        echo 'Sangat Baik';
                                    elseif ($rata_rata_raport >= 75)
                                        echo 'Baik';
                                    elseif ($rata_rata_raport >= 65)
                                        echo 'Cukup';
                                    else
                                        echo 'Perlu Perbaikan';
                                    ?>
                                </strong></td>
                        </tr>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="no-data">
                    Tidak ada data nilai untuk siswa ini.
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <?php if (empty($grouped_nilai)): ?>
        <div class="no-data">
            <h3>Tidak ada data nilai yang tersedia</h3>
            <p>Silakan periksa kembali data siswa dan nilai.</p>
        </div>
    <?php endif; ?>

    <div class="footer">
        Halaman <?= $student_count ? ceil($student_count / 3) : 1 ?> - Dicetak pada <?= date('d/m/Y H:i') ?>
    </div>
</body>

</html>