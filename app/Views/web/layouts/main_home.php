<!doctype html>
<?php $uri = service('uri')->getSegments(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Wisata | Home</title>

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


    <script src="<?= base_url('js/user.js'); ?>"></script>


    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style type="text/css">
        .showSlide {
            display: none
        }

        .showSlide img {
            width: 100%;
        }

        .slidercontainer {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        .left,
        .right {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
        }

        .right {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .left:hover,
        .right:hover {
            background-color: rgba(115, 115, 115, 0.8);
        }

        .contentx {
            color: #eff5d4;
            font-size: 30px;
            padding: 8px 12px;
            position: absolute;
            top: 10px;
            width: 100%;
            text-align: center;
        }



        /* Fading animation */
        .fade {
            -webkit-animation-name: fade;
            -webkit-animation-duration: 1.5s;
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @-webkit-keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }
    </style>

</head>

<body>
    <div id="app">

        <!-- Sidebar -->
        <?php if (isset($data) && array_key_exists('id', $data)) : ?>
            <?= $this->include('web/layouts/sidebar_detail'); ?>
        <?php else : ?>
            <?= $this->include('web/layouts/sidebar_user'); ?>
        <?php endif; ?>
        <!-- End Sidebar -->

        <!-- Main -->
        <div id="main">

            <?= $this->include('web/layouts/header'); ?>
            <!-- Content -->
            <?= $this->renderSection('content') ?>
            <!-- End Content -->

            <!-- Footer -->

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