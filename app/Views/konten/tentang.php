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
                    <?php foreach ($tentang as $t): ?>
                        <form action="/update_tentang" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id_tentang" value="<?= $t['id_tentang'] ?>">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="tentang">Tentang</label>
                                        <textarea name="tentang" id="tentang"
                                            class="form-control"><?= $t['tentang'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="visi">Visi</label>
                                        <textarea name="visi" id="visi" class="form-control"><?= $t['visi'] ?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="misi">Misi</label>
                                        <textarea name="misi" id="misi" class="form-control"><?= $t['misi'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    <?php endforeach ?>

                    <!-- Tambahkan script CKEditor -->
                    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
                    <script>
                        CKEDITOR.replace('tentang');
                        CKEDITOR.replace('visi');
                        CKEDITOR.replace('misi');
                    </script>


                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>