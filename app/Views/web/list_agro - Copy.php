<?= $this->extend('web/layouts/main_user'); ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="row">
        <!--map-->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">



                        <!-- Tambahkan ini -->
                        <?= $this->include('web/layouts/map-body'); ?>

                        <!-- Javascript untuk  memuat peta -->
                        <?= $this->include('web/layouts/jsUser'); ?>

                        <!-- Isi Disini -->
                        <div class="row content">

                        </div>

                        <div class="col-sm-2"></div>
                    </div>
                    <div class="d-flex p-2 bd-highlight">

                    </div>

                    <script>
                        // $("#delete-button").prop("disabled", true);
                        // $("#delete-map").prop("disabled", true);
                        $("#delete-button").hide();
                        $("#delete-map").hide();
                    </script>

                </div>
            </div>


        </div>
        <div class="col-md-4">
            <div class="card">
                <div style="margin: 15px;">
                    <div>


                    </div>
                    <table class="table">
                        <thead>

                            <?php

                            $count = count($data);
                            $i = 0;
                            while ($i < $count) {
                            ?>
                                <tr>
                                    <th style="width: 4cm;">Batu Patah Payo</th>
                                    <th><button onclick="mapRoute('<?= $data[$i]->id_true; ?>')" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Route"><i class="fa-solid fa-route"></i></button></th>
                                    <!-- <th><button onclick="mapView('<?= $data[$i]->id_true; ?>')" style="margin-left:5px;" class="btn btn-info"><i class="fa-solid fa-eye"></i></button></th> -->

                                </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3">
                                    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                        </ol>
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img class="d-block w-100" src="<?= base_url('media/photos/payo/Agrowisata1.jpg') ?>" alt="First slide">
                                                <div class="carousel-caption d-none d-md-block">
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block w-100" src="<?= base_url('media/photos/payo/Agrowisata3.jpg') ?>" alt="Second slide">
                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block w-100" src="<?= base_url('media/photos/payo/Agrowisata2.jpg') ?>" alt="Third slide">
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">Batu Patah Payo merupakan jenis agrowisata yang ada di Kota Solok. Batu Patah Payo merupakan kawasan budidaya bunga krisan. Batu Patah Payo juga memiliki wisata taman bermain anak dengan beberapa spot foto yang instagramable.</td>

                            <tr>
                                <td>Address </td>
                                <td colspan="2"><?= $data[$i]->address; ?></td>
                            </tr>
                            <tr>
                                <td>Type of Tourism</td>
                                <td colspan="2">Wisata dan Edukasi</td>
                            </tr>
                            <tr>
                                <td>Open </td>
                                <td colspan="2"><?= $data[$i]->open; ?></td>
                            </tr>
                            <tr>
                                <td>Close </td>
                                <td colspan="2"><?= $data[$i]->close; ?></td>
                            </tr>
                            <tr>
                                <td>Ticket Price </td>
                                <td colspan="2"><?= $data[$i]->ticket_price; ?></td>
                            </tr>

                        <?php


                                $i++;
                            }


                        ?>


                        </tbody>
                    </table>
                </div>
            </div>



        </div>


    </div>



    </div>

    <?= $this->endSection() ?>

    <?= $this->section('javascript') ?>
    <script>
        $('#direction-row').hide();
        $('#check-nearby-col').hide();
        $('#result-nearby-col').hide();
    </script>
    <?= $this->endSection() ?>