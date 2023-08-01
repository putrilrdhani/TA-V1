<?= $this->extend('web/layouts/main_user'); ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="row">
        <!--map-->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">


                        <div class="row" style="margin-left: 10px">
                            <div class="col d-flex" style="align-items: center;">
                                <h4>Google Maps With Location</h4>
                            </div>
                            <div class="col">

                                <button onclick=" radiusGPS_List()" data-toggle="tooltip" data-placement="bottom" title="Current Location" style="width:auto;float:left;margin:5px;" class="btn btn-primary"><i class="fas fa-location"></i></button>
                                <button onclick="radiusManual_List()" data-toggle="tooltip" data-placement="bottom" title="Manual Location" style="width:auto;float:left;margin:5px;" class="btn btn-primary"><i class="fas fa-map-marker-alt"></i></button>
                                <button onclick="hideElement()" data-toggle="tooltip" data-placement="bottom" title="Manual Location" style="width:auto;float:left;margin:5px;" class="btn btn-primary"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>

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
                        $("#panel").hide();
                        $("#delete-button").hide();
                        $("#delete-map").hide();
                    </script>
                </div>
            </div>
            <div class="card" id="dinamisDistance">
                <div class="table-responsive">
                    <table id="panelRenderX" class="table table-hover mb-0 table-lg">
                        <thead>
                            <tr>
                                <th>Distance (m)</th>
                                <th>Steps</th>
                            </tr>
                        </thead>
                        <tbody id="table-direction">

                        </tbody>
                    </table>
                </div>
            </div>


        </div>
        <div class="col-md-4">
            <div class="card">
                <div style="margin: 15px;">
                    <div>

                        <table class="table">
                            <thead>
                                <thead>
                                    <tr>
                                        <th colspan="2" style="text-align: center;">Batu Patah Payo</th>

                                    </tr>
                                </thead>
                            <tbody>
                                <tr>
                                    <!-- <td colspan="3">
                                        <button onclick="mapView('T3')" data-toggle="tooltip" data-placement="bottom" title="Show Marker" class="btn btn-primary">Show on Map</button>
                                    </td> -->
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
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
                                                    <img class="d-block w-100" src="<?= base_url('media/photos/payo/Agrowisata4.jpg') ?>" alt="Third slide">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="<?= base_url('media/photos/payo/Agrowisata5.jpg') ?>" alt="Fourth slide">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="<?= base_url('media/photos/payo/Agrowisata6.jpg') ?>" alt="Fifth slide">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="<?= base_url('media/photos/payo/Agrowisata7.jpg') ?>" alt="Sixth slide">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="<?= base_url('media/photos/payo/Agrowisata8.jpg') ?>" alt="Seventh slide">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="<?= base_url('media/photos/payo/Agrowisata9.jpg') ?>" alt="Eight slide">
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

                                    <td>Address </td>
                                    <td colspan="2"><?= $data[0]->address; ?></td>
                                </tr>
                                <tr>
                                    <td>Type of Tourism</td>
                                    <td colspan="2"><?= $data[0]->c_name; ?></td>
                                </tr>
                                <tr>
                                    <td>Open </td>
                                    <td colspan="2"><?= $data[0]->open; ?></td>
                                </tr>
                                <tr>
                                    <td>Close </td>
                                    <td colspan="2"><?= $data[0]->close; ?></td>
                                </tr>
                                <tr>
                                    <td>Ticket Price </td>
                                    <td colspan="2"><?= $data[0]->ticket_price; ?></td>
                                </tr>
                                <tr>
                                    <td>Facility</td>
                                    <td colspan="2">
                                        <?php
                                        $count = count($data_facility);
                                        $count = $count - 1;
                                        $j = 0;
                                        while ($j < $count) {
                                        ?>
                                            <br />
                                            <?php echo $data_facility[$j]->name; ?>
                                        <?php
                                            $j++;
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="row align-items-center">
                            <button type="button" id="video-play" class="btn-play btn btn-outline-primary" data-bs-toggle="modal" data-src="<?= base_url('upload/' . $data[0]->url_video)  ?>" data-bs-target="#videoModal">
                                <span class="material-icons" style="font-size: 1.5rem; vertical-align: bottom"></span> Play Video
                            </button>
                        </div>


                        <div class="modal fade text-left" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel17">Video</h4>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="ratio ratio-16x9">
                                            <video src="<?= base_url('upload/' . $data[0]->url_video)  ?>" class="embed-responsive-item" id="video" controls>Sorry, your browser doesn't support embedded videos</video>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Close</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $('#direction-row').hide();
    $('#check-nearby-col').hide();
    $('#result-nearby-col').hide();
    $('#dinamisDistance').hide();
    $('#coorAdmin').hide();
</script>
<?= $this->endSection() ?>