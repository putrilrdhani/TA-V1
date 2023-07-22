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
                            <button onclick=" radiusGPS()" data-toggle="tooltip" data-placement="bottom" title="Current Location" style="width:auto;float:left;margin:5px;" class="btn btn-info"><i class="fas fa-location"></i></button>
                            <button onclick="radiusManual()" data-toggle="tooltip" data-placement="bottom" title="Manual Location" style="width:auto;float:left;margin:5px;" class="btn btn-info"><i class="fas fa-map-marker-alt"></i></button>
                            <div class="col-sm-5"> <input onchange="radiusChange()" type="range" min="0" max="10000" value="0" class="form-range" id="customRadius" style="margin-top: 10px;"></div>
                            <div class="col-sm-4"> <input onchange="radiusChangeType()" id="typeRadius" type="number" max="10000" class="form-control" placeholder="Meter"></div>

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
                        $("#delete-button").hide();
                        $("#delete-map").hide();
                    </script>

                </div>
            </div>


        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <table id="makeTable" class="table">
                            <thead>
                                <tr>
                                    <th>Around You</th>
                                    <th></th>
                                    <th></th>



                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>


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

            </div>
        </div>
    </div>
</section>


<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $('#direction-row').hide();
    $("#dinamisDistance").hide();
    $('#check-nearby-col').hide();
    $('#result-nearby-col').hide();
</script>
<?= $this->endSection() ?>