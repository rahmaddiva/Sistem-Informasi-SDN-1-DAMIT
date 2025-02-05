<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin2 </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url('assets/src/') ?>assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url('assets/src/') ?>assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/src/') ?>assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/src/') ?>assets/vendors/typicons/typicons.css">
    <link rel="stylesheet"
        href="<?= base_url('assets/src/') ?>assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/src/') ?>assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url('assets/src/') ?>assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url('assets/src/') ?>assets/images/favicon.png" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">


    <style>
        body {
            background-color: #f0f0f0;
            /* Warna abu-abu muda */
        }

        .auth .auth-form-light {
            background-color: #fff;
            /* Warna putih untuk form login agar tetap terlihat kontras */
            border-radius: 8px;
            /* Tambahkan border-radius jika diperlukan */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            /* Tambahkan shadow untuk efek depth */
        }
    </style>

</head>

<body>
    <div class="container-scroller">
        <div class=container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="<?= base_url('assets/src/') ?>assets/images/logo.svg" alt="logo">
                            </div>
                            <?php if (session()->has('validation')): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php $validation = session()->getFlashdata('validation'); ?>
                                    <?php foreach ($validation->getErrors() as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach ?>
                                </div>
                            <?php endif; ?>
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session()->getFlashdata('error') ?>
                                </div>
                            <?php endif ?>

                            <h4>Selamat Datang</h4>
                            <h6 class="fw-light">Silahkan Login, Untuk Melanjutkan.</h6>
                            <form class="pt-3" action="/proses_login" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="username"
                                        id="exampleInputEmail1" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg"
                                        id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-block btn-danger btn-lg font-weight-medium auth-form-btn">LOGIN</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- font awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <!-- plugins:js -->
    <script src="<?= base_url('assets/src/') ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <script
        src="<?= base_url('assets/src/') ?>assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url('assets/src/') ?>assets/vendors/chart.js/Chart.min.js"></script>
    <script src="<?= base_url('assets/src/') ?>assets/vendors/progressbar.js/progressbar.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url('assets/src/') ?>assets/js/off-canvas.js"></script>
    <script src="<?= base_url('assets/src/') ?>assets/js/hoverable-collapse.js"></script>
    <script src="<?= base_url('assets/src/') ?>assets/js/template.js"></script>
    <script src="<?= base_url('assets/src/') ?>assets/js/settings.js"></script>
    <script src="<?= base_url('assets/src/') ?>assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?= base_url('assets/src/') ?>assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- <script src="<?= base_url('assets/src/') ?><?= base_url('assets/src/') ?>assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- endinject -->
</body>

</html>