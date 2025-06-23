<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="../index.html">
                <img src="<?= base_url('landingpage/') ?>assets/img/tutwuri.png" alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="index.html">
                <img src="<?= base_url('landingpage/') ?>assets/img/tutwuri.png" alt="logo" />
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                <h1 class="welcome-text">Selamat Datang,

                    <?php if (session()->get('level') === 'siswa'): ?>
                        <a href="<?= base_url('/profil_siswa') ?>">
                            <span class="text-black fw-bold"><?= session()->get('nama') ?></span>
                        </a>
                    <?php else: ?>
                        <span class="text-black fw-bold"><?= session()->get('nama') ?></span>
                    <?php endif; ?>


            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item d-none d-lg-block">
                <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                    <span class="input-group-addon input-group-prepend border-right">
                        <span class="icon-calendar input-group-text calendar-icon"></span>
                    </span>
                    <input type="text" class="form-control">
                </div>
            </li>

            <a href="/pengaturan" class="btn btn-light btn-sm float-end">
                <i class="mdi mdi-cog-outline"></i> Pengaturan
            </a>

        </ul>


    </div>
</nav>