<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="row">
        <!-- cdn Calendar -->
        <div class="col-sm-12">
            <div class="tab-content tab-content-basic">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="statistics-details d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="statistics-title">Jumlah Siswa</p>
                                    <h3 class="rate-percentage"><?php echo $siswa; ?></h3>

                                </div>
                                <div>
                                    <p class="statistics-title">Jumlah Kelas</p>
                                    <h3 class="rate-percentage"><?php echo $kelas; ?></h3>

                                </div>
                                <div>
                                    <p class="statistics-title">Jumlah Guru</p>
                                    <h3 class="rate-percentage"><?php echo $guru; ?></h3>

                                </div>
                                <div class="d-none d-md-block">
                                    <p class="statistics-title">Jumlah Kegiatan</p>
                                    <h3 class="rate-percentage"><?php echo $kegiatan; ?></h3>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div id='calendar'></div>
            <!-- cdn jquery -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        events: <?php echo json_encode($tanggal_kegiatan); ?>,
                        eventClick: function (info) {
                            Swal.fire({
                                title: 'Detail Kegiatan',
                                html: '<strong>Judul:</strong> ' + info.event.title + '<br><strong>Tanggal:</strong> ' + info.event.start.toDateString() + '<br><strong>Deskripsi:</strong> ' + info.event.extendedProps.description,
                                icon: 'info',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                    calendar.render();
                });
            </script>
        </div>
    </div>
</div>
<?= $this->endSection() ?>