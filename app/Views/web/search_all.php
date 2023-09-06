<?= $this->extend('web/layouts/main_user'); ?>

<?= $this->section('content') ?>

<?php
if (isset($search)) {
    $search = str_replace("NAME_", "", $search);
}
?>

<section class="section">
    <div class="row">
        <!--map-->
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">

                        <!-- <div>Search</div>
                        <div>
                            <input type="text" id="search-box" class="form-control" placeholder="Search by Name" />
                            <div id="suggesstion-box"></div>
                        </div> -->

                        <div class="row" style="margin-left: 10px">
                            <div class="col d-flex" style="align-items: center;">
                                <h4>Google Maps With Location</h4>
                            </div>
                            <div class="col">

                                <button onclick=" radiusGPS_List()" data-toggle="tooltip" data-placement="bottom" title="Current Location" style="width:auto;float:left;margin:5px;" class="btn btn-primary"><i class="fas fa-location"></i></button>
                                <button onclick="radiusManual_List()" data-toggle="tooltip" data-placement="bottom" title="Manual Location" style="width:auto;float:left;margin:5px;" class="btn btn-primary"><i class="fas fa-map-marker-alt"></i></button>
                                <button onclick="hideElement()" data-toggle="tooltip" data-placement="bottom" title="Legend" style="width:auto;float:left;margin:5px;" class="btn btn-primary"><i class="fas fa-eye"></i></button>
                                <button onclick="showHover()" disabled id="info_hover" data-toggle="tooltip" data-placement="bottom" title="Manual Location" style="width:auto;float:left;margin:5px;" class="btn btn-primary"><i class="fa-solid fa-circle-info"></i></button>
                            </div>
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


            <div id="dinamisDistance" class="card">
                <div class="table-responsive" style="margin: 20px;">
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

            <script>
                $("#dinamisDistance").hide();
            </script>

        </div>

        <div class="col-md-4">
            <div class="card" id="search-object">
                <div class="card-header">
                    <div>
                        <table class="table">
                            <thead>
                                <th style="width: 80%;">Name</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 80%;"><i class="fas fa-person-praying" style="color: green;"></i>&nbsp; &nbsp; <b>Worship</b></td>
                                    <td>
                                        <button onclick="showWorship_All()" data-toggle="tooltip" data-placement="bottom" title="Manual Location" style="width:auto;float:left;margin:5px;" class="btn btn-primary"><i id="worship-eye" class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 80%;"><i class="fas fa-gift" style="color:palevioletred;"></i>&nbsp; &nbsp; <b>Souvenir</b></td>
                                    <td>
                                        <button onclick="showSouvenir_All()" data-toggle="tooltip" data-placement="bottom" title="Manual Location" style="width:auto;float:left;margin:5px;" class="btn btn-primary"><i id="souvenir-eye" class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 80%;"><i class="fas fa-bullhorn" style="color: aqua;"></i>&nbsp; &nbsp; <b>Event</b></td>
                                    <td>
                                        <button onclick="showEvent_All()" data-toggle="tooltip" data-placement="bottom" title="Manual Location" style="width:auto;float:left;margin:5px;" class="btn btn-primary"><i id="event-eye" class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 80%;"><i class="fas fa-utensils" style="color: red;"></i>&nbsp; &nbsp; <b>Culinary</b></td>
                                    <td>
                                        <button onclick="showCulinary_All()" data-toggle="tooltip" data-placement="bottom" title="Manual Location" style="width:auto;float:left;margin:5px;" class="btn btn-primary"><i id="culinary-eye" class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 80%;"><i class="fas fa-home" style="color: orange;"></i>&nbsp; &nbsp; <b>Homestay</b></td>
                                    <td>
                                        <button onclick="showHomestay_All()" data-toggle="tooltip" data-placement="bottom" title="Manual Location" style="width:auto;float:left;margin:5px;" class="btn btn-primary"><i id="homestay-eye" class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <br />
                    <div class="d-flex justify-content-center">
                        <button onclick="hideSearchAll()" data-toggle="tooltip" data-placement="bottom" title="Search" style="width:auto;float:left;margin:5px;" class="btn btn-outline-primary"><b>Search By Radius</b></button>

                    </div>
                    <div class="d-flex justify-content-center">


                    </div>
                </div>
            </div>
            <div class="card" id="search_object">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- <table class="col-sm-12">
                                <thead>
                                    <th>Facility</th>

                                </thead>
                                <tbody>
                                    <?php
                                    $length = count($facility);
                                    $i = 0;
                                    while ($i < $length) {

                                    ?>
                                        <tr>

                                            <td><input class="tourism" onchange="facilityMapAll()" type="checkbox" value="F-<?php echo $facility[$i]->id_facility; ?>"> &nbsp &nbsp <?php echo $facility[$i]->f_name; ?></td>



                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>


                                </tbody>

                            </table>-->

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input disabled onchange="facilityMapAll()" id="worship" type="checkbox" value="O-worship"> &nbsp &nbsp Worship</td>
                                    </tr>
                                    <tr>
                                        <td><input disabled onchange="facilityMapAll()" id="souvenir" type="checkbox" value="O-souvenir"> &nbsp &nbsp Souvenir</td>
                                    </tr>
                                    <tr>
                                        <td><input disabled onchange="facilityMapAll()" id="event" type="checkbox" value="O-event"> &nbsp &nbsp Event</td>
                                    </tr>
                                    <tr>
                                        <td><input disabled onchange="facilityMapAll()" id="culinary" type="checkbox" value="O-culinary"> &nbsp &nbsp Culinary</td>
                                    </tr>
                                    <tr>
                                        <td><input disabled onchange="facilityMapAll()" id="homestay" type="checkbox" value="O-homestay"> &nbsp &nbsp Homestay</td>
                                    </tr>

                                </tbody>

                            </table>
                            <input disabled onchange="facilityMapAll()" type="range" class="form-range" id="radiusRange" value="0" min="0" max="20000">

                            <br />

                            <div class="d-flex justify-content-center">
                                <button onclick="hideSearchAll()" data-toggle="tooltip" data-placement="bottom" title="Search" style="width:auto;float:left;margin:5px;" class="btn btn-outline-primary"><b>Show All</b></button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div style="height:400px;overflow-y:scroll;" class="scrollbar" id="search-result">
                        <br />
                        <table id="makeTable" class=" table">
                            <thead>
                                <tr>
                                    <th colspan="2">Worship</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>


                        <br />
                        <table id="makeSouvenir" class=" table">
                            <thead>
                                <tr>
                                    <th colspan="2">Souvenir</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <br />
                        <table id="makeEvent" class=" table">
                            <thead>
                                <tr>
                                    <th colspan="2">Event</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <br />
                        <table id="makeCulinary" class=" table">
                            <thead>
                                <tr>
                                    <th colspan="2">Culinary</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                        <br />
                        <table id="makeHomestay" class=" table">
                            <thead>
                                <tr>
                                    <th colspan="2">Homestay</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                    <br />
                    <div class="d-flex justify-content-center">


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {


        $("#search-box").keyup(function() {
            $.ajax({
                type: "GET",
                url: urlAplikasi + "web/search_name_only_all/" + $(this).val(),
                // data: 'keyword=' + $(this).val(),
                beforeSend: function() {
                    // $("#search-box").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
                },
                success: function(data) {

                    console.log("SEARCH BOX");
                    console.log(data);

                    console.log("SEARCH BOX");


                    data = JSON.parse(data);
                    // console.log(data);
                    $("#suggesstion-box").show();
                    let length = data.features.length;
                    let i = 0;
                    $("#suggesstion-box").empty();
                    while (i < length) {
                        $("#suggesstion-box").append("<div onclick='fillResult(" + '"' + data.features[i].properties.name + '"' + ")'>" + data.features[i].properties.name + "</div>");



                        i++;
                    }

                    $("#search-box").css("background", "#FFF");
                }
            });
        });
    });
    //To select a country name
    function selectCountry(val) {
        $("#search-box").val(val);
        $("#suggesstion-box").hide();
    }

    function fillResultName(keyword) {
        console.log(keyword);
        console.log("Test");
        console.log(keyword);

        $("#search-box").val(keyword);
        $("#suggesstion-box").hide();

        // Panggil AJAX Data yg sesuai dan ubah di maps

        $.ajax({
            type: "GET",
            url: urlAplikasi + "web/search_name_all/" + keyword,
            // data: 'keyword=' + $(this).val(),
            beforeSend: function() {
                // $("#search-box").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data) {
                console.log("99999")
                console.log(data)


                data = JSON.parse(data);
                console.log(data);
                geom_data = data;
                // dataVillage.setMap(null);
                // dataTourism.setMap(null);
                setMapOnAll(null);
                map.data.forEach(function(feature) {
                    // filter...
                    map.data.remove(feature);
                });
                callAfterPut();
                if (countClick == 0) {

                } else {
                    markerA.setMap(null);
                    markerB.setMap(null);
                    directionsRenderer1.setMap(null);
                    directionsRenderer2.setMap(null);
                    $("#panelRender").empty();
                }

            }
        });
    }

    function fillResult(keyword) {
        console.log(keyword);
        console.log("Test");
        console.log(keyword);

        $("#search-box").val(keyword);
        $("#suggesstion-box").hide();

        // Panggil AJAX Data yg sesuai dan ubah di maps

        $.ajax({
            type: "GET",
            url: urlAplikasi + "web/search_name_all/" + keyword,
            // data: 'keyword=' + $(this).val(),
            beforeSend: function() {
                // $("#search-box").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data) {


                data = JSON.parse(data);
                // console.log(data);
                geom_data = data;
                // dataVillage.setMap(null);
                // dataTourism.setMap(null);
                setMapOnAll(null);
                map.data.forEach(function(feature) {
                    // filter...
                    map.data.remove(feature);
                });
                callAfterPut();
                if (countClick == 0) {

                } else {
                    markerA.setMap(null);
                    markerB.setMap(null);
                    directionsRenderer1.setMap(null);
                    directionsRenderer2.setMap(null);
                    $("#panelRender").empty();
                }

            }
        });
    }
</script>

<?php
if (isset($search)) {
    if (strpos($search, "NAME_") !== false) {
?>
        <input type="hidden" id="hiddenID" value="<?php echo $search; ?>">
        <script>
            let sendData = $("#hiddenID").val();
            console.log("HHHHHH")
            console.log(sendData);
            fillResultName(sendData);
        </script>

<?php
    }
}
?>

</div>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $('#direction-row').hide();
    $('#check-nearby-col').hide();
    $('#coorAdmin').hide();
    $('#result-nearby-col').hide();
    $('#search_object').hide();
</script>
<?= $this->endSection() ?>