<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
        }

        .no-border td {
            border: none;
        }
    </style>
</head>

<body>

    <?php foreach ($dataRapor as $rapor): ?>
        <h3 style="text-align:center;">LAPORAN HASIL BELAJAR (RAPOR)</h3>

        <table class="no-border">
            <tr>
                <td>Nama Peserta Didik</td>
                <td>: <?= $rapor['siswa']['nama'] ?></td>
                <td>Kelas</td>
                <td>: <?= $rapor['kelas'] ?></td>
            </tr>
            <tr>
                <td>NISN/NIS</td>
                <td>: <?= $rapor['siswa']['nisn'] ?></td>
            </tr>
            <tr>
                <td>Nama Sekolah</td>
                <td>: <?= $nama_sekolah ?></td>
                <td>Semester</td>
                <td>: <?= $rapor['semester'] ?></td>
            </tr>
            <tr>
                <td>Alamat Sekolah</td>
                <td>: <?= $alamat_sekolah ?></td>
                <td>Tahun Pelajaran</td>
                <td>: <?= $rapor['tahun_pelajaran'] ?></td>
            </tr>
        </table>

        <br>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mata Pelajaran</th>
                    <th>Nilai Akhir</th>
                    <th>Capaian Kompetensi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($rapor['nilaiList'] as $nilai): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $nilai['nama_mapel'] ?></td>
                        <td><?= $nilai['nilai_raport'] ?></td>
                        <td><?= $nilai['capaian_kompetensi'] ?><br><?= $nilai['capaian_kompetensi2'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <br>

        <!-- Catatan Guru -->
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>Catatan Guru</th>
            </tr>
            <tr>
                <td><?= $rapor['catatan'] ?></td>
            </tr>
        </table>

        <br>

        <!-- Ketidakhadiran -->
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th colspan="2">Ketidakhadiran</th>
            </tr>
            <tr>
                <td>Sakit</td>
                <td><?= $rapor['absensi']['sakit'] ?? 0 ?> hari</td>
            </tr>
            <tr>
                <td>Izin</td>
                <td><?= $rapor['absensi']['izin'] ?? 0 ?> hari</td>
            </tr>
            <tr>
                <td>Tanpa Keterangan</td>
                <td><?= $rapor['absensi']['tanpa_keterangan'] ?? 0 ?> hari</td>
            </tr>
        </table>

        <br>

        <!-- Ekstrakurikuler -->
        <table>
            <tr>
                <th colspan="2">Ekstrakurikuler</th>
                <th colspan="4">Keterangan</th>
            </tr>
            <?php if (!empty($rapor['ekskul'])):
                $no = 1;
                foreach ($rapor['ekskul'] as $ekstra): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $ekstra['nama_ekskul'] ?></td>
                        <td colspan="4"><?= $ekstra['keterangan'] ?></td>
                    </tr>
                <?php endforeach;
            else: ?>
                <tr>
                    <td>1</td>
                    <td>.....................</td>
                    <td colspan="4">.....................</td>
                </tr>
            <?php endif; ?>
        </table>

        <hr><br><br>
    <?php endforeach; ?>


</body>

</html>