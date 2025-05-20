<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>
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
    <link rel="shortcut icon" href="<?= base_url('landingpage/') ?>assets/img/tutwuri.png" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />


    <link rel="stylesheet" href="<?= base_url('assets/src/') ?>assets/vendors/jquery-toast-plugin/jquery.toast.min.css">
  
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">

    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
    <style>
        .table-responsive {
            overflow-x: auto;
        }

        .table thead th {
            position: -webkit-sticky;
            /* Safari */
            position: sticky;
            top: 0;
            background-color: #fff;
            z-index: 1;
        }

        .table img {
            max-width: 100%;
            height: auto;
        }

        @media (max-width: 768px) {
            .table-responsive table {
                display: block;
                width: 100%;
                overflow-x: auto;
                white-space: nowrap;
            }

            .table-responsive .table thead,
            .table-responsive .table tbody,
            .table-responsive .table th,
            .table-responsive .table td,
            .table-responsive .table tr {
                display: block;
            }

            .table-responsive .table thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            .table-responsive .table tr {
                border: 1px solid #ccc;
            }

            .table-responsive .table td {
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
                white-space: normal;
                text-align: left;
            }

            .table-responsive .table td:before {
                position: absolute;
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                content: attr(data-title);
                font-weight: bold;
            }
        }
    </style>



</head>

<body class="with-welcome-text">
    <div class="container-scroller">

        <?= $this->include('templates/navbar') ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial -->
            <?= $this->include('templates/sidebar') ?>
            <!-- partial -->
            <div class="main-panel">
                <?= $this->renderSection('content') ?>
                <!-- content-wrapper ends -->
                <?= $this->include('templates/footer') ?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const subMenuLinks = document.querySelectorAll('#ui-basic .nav-link');
            const collapseElement = document.getElementById('ui-basic');

            subMenuLinks.forEach(link => {
                link.addEventListener('click', function () {
                    collapseElement.classList.add('show');
                });
            });
        });
    </script>


    <script src="<?= base_url('assets/src/') ?>assets/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>

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
    <!-- Plugin js for this page-->
    <script src="<?= base_url('assets/src/') ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?= base_url('assets/src/') ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
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
    <script src="<?= base_url('assets/src/') ?>assets/js/data-table.js"></script>


</body>

</html>