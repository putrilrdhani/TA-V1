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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="3">List</th>



                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $count = count($data);
                                $i = 0;
                                while ($i < $count) {
                                ?>

                                    <tr>
                                        <td><?= $data[$i]->name; ?></td>

                                        <td><button onclick="mapView('<?= $data[$i]->id_true; ?>')" style="margin-left:5px;" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="bottom" title="Show Marker"><i class="fa-solid fa-eye"></i></button></td>

                                    </tr>
                                <?php


                                    $i++;
                                }


                                ?>


                            </tbody>
                        </table>

                        <div id="dinamisDistance" class="card">
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
    $('#panel').hide();
    $('#legend').hide();
    $("#dinamisDistance").hide();
    $('#check-nearby-col').hide();
    $('#result-nearby-col').hide();
    $('#coorAdmin').hide();
</script>
<?= $this->endSection() ?>