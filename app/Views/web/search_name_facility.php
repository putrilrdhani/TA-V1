<?= $this->extend('web/layouts/main_user'); ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="row">
        <!--map-->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="row align-items-center">
                            <div class="col d-flex" style="align-items: center;">
                                <h4>Google Maps With Location</h4>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col d-flex">
                                        <button onclick="radiusGPS_NR()" data-toggle="tooltip" data-placement="bottom" title="Current Location" style="width:auto;float:left;margin:5px;" class="btn btn-primary"><i class="fas fa-location"></i></button>
                                        <button onclick="radiusManual_NR()" data-toggle="tooltip" data-placement="bottom" title="Manual Location" style="width:auto;float:left;margin:5px;" class="btn btn-primary"><i class="fas fa-map-marker-alt"></i></button>

                                        <button onclick="hideElement()" data-toggle="tooltip" data-placement="bottom" title="Manual Location" style="width:auto;float:left;margin:5px;" class="btn btn-primary"><i class="fas fa-eye"></i></button>
                                        <button onclick="showHover()" disabled id="info_hover" data-toggle="tooltip" data-placement="bottom" title="Manual Location" style="width:auto;float:left;margin:5px;" class="btn btn-primary"><i class="fa-solid fa-circle-info"></i></button>
                                    </div>
                                    <div class="col d-flex"><input onchange="radiusChangeTypeTourism()" id="typeRadius" type="number" max="10000" class="form-control" placeholder="Meter">
                                    </div>
                                </div>
                                <div class="row">
                                    <input onchange="radiusChangeTourism()" type="range" min="0" max="10000" value="0" class="form-range" id="customRadius" style="margin-top: 10px;">
                                </div>

                            </div>
                        </div>
                        <!-- <div class="row">
                            <div style="text-align:center" class="col-sm-12" id="valueMeter"></div>
                        </div> -->

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
                        $("#legend").hide();
                        $("#panel").hide();
                        $("#delete-button").hide();
                        $("#delete-map").hide();
                    </script>

                </div>
            </div>


        </div>
        <div class="col-md-4">
            <div class="card">

                <div style="margin: 20px;">
                    <table id="makeTable" class="table">
                        <thead>
                            <tr>
                                <th colspan="3">Result</th>



                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
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


    </div>

</section>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $('#direction-row').hide();
    $('#check-nearby-col').hide();
    $('#coorAdmin').hide();
    $('#result-nearby-col').hide();
    $('#dinamisDistance').hide();
</script>
<?= $this->endSection() ?>