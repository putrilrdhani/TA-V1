<!doctype html>
<?php $uri = service('uri')->getSegments(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Wisata | Admin</title>


    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/main/app.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/main/app-dark.css'); ?>">


    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('css/web.css'); ?>">
    <?= $this->renderSection('styles') ?>
    <link rel="shortcut icon" href="<?= base_url('media/icon/favicon.svg'); ?>" type="image/x-icon">

    <!-- Third Party CSS and JS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/shared/iconly.css'); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,200,0,0" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= base_url('assets/js/extensions/sweetalert2.js'); ?>"></script>
    <script src="https://kit.fontawesome.com/de7d18ea4d.js" crossorigin="anonymous"></script>

    <!-- Google Maps API and Custom JS -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8B04MTIk7abJDVESr6SUF6f3Hgt1DPAY&libraries=drawing&callback=initialize"></script>
    <script src="<?= base_url('js/web.js'); ?>"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
        #modalContainer {
            background-color: rgba(0, 0, 0, 0.3);
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0px;
            left: 0px;
            z-index: 10000;
            background-image: url(tp.png);
            /* required by MSIE to prevent actions on lower z-index elements */
        }

        #alertBox {
            position: relative;
            width: 300px;
            min-height: 100px;
            margin-top: 50px;
            border: 1px solid #666;
            background-color: #fff;
            background-repeat: no-repeat;
            background-position: 20px 30px;
        }

        #modalContainer>#alertBox {
            position: fixed;
        }

        #alertBox h1 {
            margin: 0;
            font: bold 0.9em verdana, arial;
            background-color: #3073BB;
            color: #FFF;
            border-bottom: 1px solid #000;
            padding: 2px 0 2px 5px;
        }

        #alertBox p {
            font: 0.7em verdana, arial;
            height: 50px;
            padding-left: 5px;
            margin-left: 55px;
        }

        #alertBox #closeBtn {
            display: block;
            position: relative;
            margin: 5px auto;
            padding: 7px;
            border: 0 none;
            width: 70px;
            font: 0.7em verdana, arial;
            text-transform: uppercase;
            text-align: center;
            color: #FFF;
            background-color: #357EBD;
            border-radius: 3px;
            text-decoration: none;
        }

        /* unrelated styles */

        #mContainer {
            position: relative;
            width: 600px;
            margin: auto;
            padding: 5px;
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
            font: 0.7em verdana, arial;
        }

        h1,
        h2 {
            margin: 0;
            padding: 4px;
            font: bold 1.5em verdana;
            border-bottom: 1px solid #000;
        }

        code {
            font-size: 1.2em;
            color: #069;
        }

        #credits {
            position: relative;
            margin: 25px auto 0px auto;
            width: 350px;
            font: 0.7em verdana;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            height: 90px;
            padding-top: 4px;
        }

        #credits img {
            float: left;
            margin: 5px 10px 5px 0px;
            border: 1px solid #000000;
            width: 80px;
            height: 79px;
        }

        .important {
            background-color: #F5FCC8;
            padding: 2px;
        }

        code span {
            color: green;
        }
    </style>
</head>

<body>
    <div id="app">

        <!-- Sidebar -->
        <?php if (isset($data) && array_key_exists('id', $data)) : ?>
            <?= $this->include('web/layouts/sidebar_detail'); ?>
        <?php else : ?>
            <?= $this->include('web/layouts/sidebar'); ?>
        <?php endif; ?>
        <!-- End Sidebar -->

        <!-- Main -->
        <div id="main">
            <?= $this->include('web/layouts/header'); ?>
            <!-- Content -->
            <?= $this->renderSection('content') ?>
            <!-- End Content -->

            <!-- Footer -->
            <?= $this->include('web/layouts/footer') ?>
            <!-- End Footer -->
        </div>
        <!-- End Main -->

    </div>

    <!-- Template CSS -->
    <script src="<?= base_url('assets/js/app.js'); ?>"></script>

    <!-- Custom JS -->
    <?= $this->renderSection('javascript') ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        }, false);

        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-3d'
        });
        $('#datepickerVH').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-3d'
        });
    </script>
</body>

</html>

<script>
    $('#title').hide();
</script>