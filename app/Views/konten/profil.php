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
                    <?= csrf_field() ?>
                    <?php foreach ($profil as $p): ?>
                        <form action="/update_profil" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id_profil" value="<?= $p['id_profil'] ?>">
                            <div class="form-group">
                                <label for="nama_sekolah">Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control"
                                    value="<?= $p['nama_sekolah'] ?>">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="akreditasi">Akreditasi</label>
                                    <input type="text" name="akreditasi" id="akreditasi" class="form-control"
                                        value="<?= $p['akreditasi'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="npsn">NPSN</label>
                                    <input type="number" name="npsn" id="npsn" class="form-control"
                                        value="<?= $p['npsn'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="nss">NSS</label>
                                    <input type="number" name="nss" id="nss" class="form-control" value="<?= $p['nss'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="bentuk_pendidikan">Bentuk Pendidikan</label>
                                    <input type="text" name="bentuk_pendidikan" id="bentuk_pendidikan" class="form-control"
                                        value="<?= $p['bentuk_pendidikan'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="status">Status</label>
                                    <input type="text" name="status" id="status" class="form-control"
                                        value="<?= $p['status'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="kabupaten">Kabupaten</label>
                                    <input type="text" name="kabupaten" id="kabupaten" class="form-control"
                                        value="<?= $p['kabupaten'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="kelurahan">Kelurahan</label>
                                    <input type="text" name="kelurahan" id="kelurahan" class="form-control"
                                        value="<?= $p['kelurahan'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="text" name="kecamatan" id="kecamatan" class="form-control"
                                        value="<?= $p['kecamatan'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control"
                                        rows="3"><?= $p['alamat'] ?></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    <?php endforeach ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>