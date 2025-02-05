<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('landingpage/') ?>assets/img/favicon.png" rel="icon">
    <link href="<?= base_url('landingpage/') ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('landingpage/') ?>assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url('landingpage/') ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('landingpage/') ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('landingpage/') ?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url('landingpage/') ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url('landingpage/') ?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url('landingpage/') ?>assets/css/style.css" rel="stylesheet">

    <style>
        /* Tambahkan CSS untuk tata letak yang diinginkan */
        .portfolio-details-container {
            display: flex;
        }

        .portfolio-details-container .left {
            flex: 2;
        }

        .portfolio-details-container .right {
            flex: 1;
            margin-left: 20px;
        }

        .right .other-activities {
            list-style: none;
            padding: 0;
        }

        .right .other-activities li {
            margin-bottom: 10px;
        }
    </style>

    <style>
        .portfolio-details {
            padding: 30px 0;
        }

        .portfolio-details-container {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 30px;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
        }

        .portfolio-details-container .left,
        .portfolio-details-container .right {
            flex: 1 1 50%;
            padding: 10px;
        }

        .portfolio-details-container .left img {
            max-width: 500px;
            /* Ukuran maksimum untuk gambar */
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .portfolio-details-container .right {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .portfolio-details-container .right h2 {
            margin-top: 0;
            font-size: 24px;
        }

        .portfolio-details-container .right p {
            font-size: 16px;
            line-height: 1.5;
        }

        .portfolio-details-container .other-activities {
            list-style: none;
            padding: 0;
        }

        .portfolio-details-container .other-activities li {
            font-size: 16px;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .portfolio-details-container {
                flex-direction: column;
                text-align: center;
            }

            .portfolio-details-container .left,
            .portfolio-details-container .right {
                flex: 1 1 100%;
            }

            .portfolio-details-container .right h2 {
                font-size: 20px;
            }

            .portfolio-details-container .right p,
            .portfolio-details-container .other-activities li {
                font-size: 14px;
            }
        }
    </style>

    <!-- =======================================================
  * Template Name: FlexStart
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="/" class="logo d-flex align-items-center">
                <img src="<?= base_url('landingpage/') ?>assets/img/tutwuri.png" alt="">
                <span>UPTD SD NEGERI 1 DAMIT</span>
            </a>
        </div>
    </header><!-- End Header -->
    <main id="main">
        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>
                        <?= $title ?>
                    </h2>
                    <ol>
                        <li><a href="<?= base_url('/') ?>">Home</a></li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->
        <!-- ======= Portfolio Details Section ======= -->
        <section id="portfolio-details" class="portfolio-details">
            <div class="container">
                <!-- Card Karya -->
                <?php foreach ($karya as $k): ?>
                    <div class="portfolio-details-container">
                        <div class="left">
                            <img src="<?= base_url('foto_karya/' . $k['foto']) ?>" class="img-fluid" alt="">
                        </div>

                        <div class="right">
                            <h2><?= $k['nama_karya'] ?></h2>
                            <p><?= $k['deskripsi'] ?></p>
                            <ul class="other-activities">
                                <li><strong>Nama Siswa:</strong> <?= $k['nama'] ?></li>
                                <li><strong>Nama Guru:</strong> <?= $k['nama_pembimbing'] ?></li>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main><!-- End #main -->



    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Vendor JS Files -->
    <script src="<?= base_url('landingpage/') ?>assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="<?= base_url('landingpage/') ?>assets/vendor/aos/aos.js"></script>
    <script src="<?= base_url('landingpage/') ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('landingpage/') ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= base_url('landingpage/') ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?= base_url('landingpage/') ?>assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?= base_url('landingpage/') ?>assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url('landingpage/') ?>assets/js/main.js"></script>

</body>

</html>