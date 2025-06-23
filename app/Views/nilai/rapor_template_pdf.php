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

        td,
        th {
            border: 1px solid black;
            padding: 6px;
        }

        .no-border td {
            border: none;
        }
    </style>
</head>

<body>

    <h3 style="text-align: center;">LAPORAN HASIL BELAJAR (RAPOR)</h3>

    <table class="no-border">
        <tr>
            <td>Nama Peserta Didik</td>
            <td>: <?= $siswa['nama'] ?></td>
            <td>Kelas</td>
            <td>: <?= $kelas ?></td>
        </tr>
        <tr>
            <td>NISN/NIS</td>
            <td>: <?= $siswa['nisn'] ?></td>
        </tr>
        <tr>
            <td>Nama Sekolah</td>
            <td>: <?= $nama_sekolah ?></td>
            <td>Semester</td>
            <td>: <?= $semester ?></td>
        </tr>
        <tr>
            <td>Alamat Sekolah</td>
            <td>: <?= $alamat_sekolah ?></td>
            <td>Tahun Pelajaran</td>
            <td>: <?= $tahun_pelajaran ?></td>
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
            foreach ($nilaiList as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama_mapel'] ?></td>
                    <td><?= $row['nilai_raport'] ?></td>
                    <td>
                        <?= $row['capaian_kompetensi'] ?><br>
                        <?= $row['capaian_kompetensi2'] ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br><br>

    <!-- Tambahan: Ekstrakurikuler -->
    <table>
        <tr>
            <th colspan="2">Ekstrakurikuler</th>
            <th colspan="4">Keterangan</th>
        </tr>
        <?php
        if (!empty($ekstrakurikulerList)) {
            $no = 1;
            foreach ($ekstrakurikulerList as $ekstra): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $ekstra['nama_ekskul'] ?></td>
                    <td colspan="4"><?= $ekstra['keterangan'] ?></td>
                </tr>
            <?php endforeach;
        } else { ?>
            <tr>
                <td>1</td>
                <td>.....................</td>
                <td colspan="4">.....................</td>
            </tr>
        <?php } ?>
    </table>

    <br>

    <!-- Tambahan: Catatan Guru -->
    <table>
        <tr>
            <th>Catatan Guru</th>
        </tr>
        <tr>
            <td>
                <?= !empty($catatan_guru) ? $catatan_guru : 'Ananda selalu berperilaku baik dan semangat belajar tinggi.' ?>
            </td>
        </tr>
    </table>

    <br>

    <!-- Tambahan: Ketidakhadiran -->
    <table>
        <tr>
            <th colspan="2">Ketidakhadiran</th>
        </tr>
        <tr>
            <td>Sakit</td>
            <td><?= $sakit ?? 0 ?> hari</td>
        </tr>
        <tr>
            <td>Izin</td>
            <td><?= $izin ?? 0 ?> hari</td>
        </tr>
        <tr>
            <td>Tanpa Keterangan</td>
            <td><?= $tanpa_keterangan ?? 0 ?> hari</td>
        </tr>
    </table>

</body>

</html>