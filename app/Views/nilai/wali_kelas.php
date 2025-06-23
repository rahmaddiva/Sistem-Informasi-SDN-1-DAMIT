<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <!-- card menampilkan data user -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mt-3">Kelola Nilai</h4>
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
                    <div class="table-responsive">
                        <?php if (in_array(session()->get('level'), ['admin', 'wali_kelas'])): ?>
                            <div class="row mb-3">
                                <div class="col-auto">
                                    <a href="<?= base_url('kelola_nilai/rekapPdf') ?>" class="btn btn-danger">
                                        <i class="fa fa-file-pdf"></i> Rekap Nilai (PDF)
                                    </a>
                                    <a href="<?= base_url('cetak-rapor-semua') ?>" target="_blank" class="btn btn-primary">
                                        <i class="fa fa-print"></i> Cetak Rapor Semua Siswa
                                    </a>
                                    <!-- eksport excel -->
                                    <a href="<?= base_url('kelola_nilai/exportExcel') ?>" class="btn btn-success">
                                        <i class="fa fa-file-excel"></i> Export Nilai ke Excel
                                    </a>    
                                </div>

                                
                            </div>
                        <?php endif; ?>

                        <table id="order-listing" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Wali Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($siswa as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['nama_kelas'] ?></td>
                                        <td><?= $row['nama_guru'] ?></td>
                                        <td>
                                            <!-- icon dropdown -->
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Aksi
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li>
                                                        <a class="dropdown-item" href="kelola_nilai/tambah/<?= $row['id_siswa'] ?>">
                                                            Tambah Nilai
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="<?= base_url('kelola_nilai/cetakRapor/' . $row['id_siswa']) ?>" target="_blank">
                                                            Cetak Rapor
                                                        </a>
                                                    </li>
                                                </ul>

                                            </div>
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