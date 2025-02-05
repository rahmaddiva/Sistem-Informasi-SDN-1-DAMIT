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
                    <?php foreach ($wilayah as $p): ?>
                        <form action="/update_wilayah" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id_wilayah" value="<?= $p['id_wilayah'] ?>">
                            <div class="form-group">
                                <label for="nama_wilayah">Nama Wilayah</label>
                                <input type="text" name="nama_wilayah" id="nama_wilayah" class="form-control"
                                    value="<?= $p['nama_wilayah'] ?>">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="latitude">Latitude</label>
                                    <input type="number" name="latitude" id="latitude" class="form-control"
                                        value="<?= $p['latitude'] ?>" step="any">
                                </div>
                                <div class="col-md-6">
                                    <label for="longitude">Longitude</label>
                                    <input type="number" name="longitude" id="longitude" class="form-control"
                                        value="<?= $p['longitude'] ?>" step="any">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control"
                                    value="<?= $p['keterangan'] ?>">
                            </div>

                            <div id="map"></div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    <?php endforeach ?>
                </div>

                <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', (event) => {
                        var initialLat = <?= $p['latitude'] ?>;
                        var initialLng = <?= $p['longitude'] ?>;
                        var map = L.map('map').setView([initialLat, initialLng], 13);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);

                        var marker = L.marker([initialLat, initialLng], {
                            draggable: true
                        }).addTo(map);

                        marker.on('dragend', function (e) {
                            var position = marker.getLatLng();
                            document.getElementById('latitude').value = position.lat;
                            document.getElementById('longitude').value = position.lng;
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>