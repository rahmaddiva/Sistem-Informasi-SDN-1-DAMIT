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
                    <?php foreach ($kontak as $p): ?>
                        <form action="/update_kontak" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id_kontak" value="<?= $p['id_kontak'] ?>">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control" value="<?= $p['email'] ?>">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="no_telp">Nomer Telepon</label>
                                    <input type="number" name="no_telp" id="no_telp" class="form-control"
                                        value="<?= $p['no_telp'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="text" name="lokasi" id="lokasi" class="form-control"
                                        value="<?= $p['lokasi'] ?>">
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