<?= $this->extend('web/layouts/main_user'); ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="row">
        <!--map-->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">

                        <div>Search</div>
                        <div class="form form-control">
                            <input type="text" id="search-box" class="form-control" placeholder="Place" />
                            <div id="suggesstion-box"></div>
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
                        $("#searchresult").hide();
                        $("#delete-map").hide();
                    </script>

                </div>
            </div>


        </div>
        <div class="col-md-4" id="search-result">
            <table id="makeTable" class=" table">
                <thead>
                    <tr>
                        <th>Worship</th>
                        <th></th>
                        <th></th>



                    </tr>
                </thead>
                <tbody>



                </tbody>
            </table>
            <br />
            <table id="makeSouvenir" class=" table">
                <thead>
                    <tr>
                        <th>Souvenir</th>
                        <th></th>
                        <th></th>



                    </tr>
                </thead>
                <tbody>



                </tbody>
            </table>
            <br />
            <table id="makeEvent" class=" table">
                <thead>
                    <tr>
                        <th>Event</th>
                        <th></th>
                        <th></th>



                    </tr>
                </thead>
                <tbody>



                </tbody>
            </table>
            <br />
            <table id="makeCulinary" class=" table">
                <thead>
                    <tr>
                        <th>Culinary</th>
                        <th></th>
                        <th></th>



                    </tr>
                </thead>
                <tbody>



                </tbody>
            </table>

            <br />
            <table id="makeHomestay" class=" table">
                <thead>
                    <tr>
                        <th>Homestay</th>
                        <th></th>
                        <th></th>



                    </tr>
                </thead>
                <tbody>



                </tbody>
            </table>


            <div class="row">
                <div class="col-sm-12">
                    <table>
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

                                    <td><input onchange="facilityMapAgro()" type="checkbox" value="F-<?php echo $facility[$i]->id_facility; ?>"> &nbsp &nbsp <?php echo $facility[$i]->name; ?></td>



                                </tr>
                            <?php
                                $i++;
                            }
                            ?>


                        </tbody>

                    </table>
                    <br />

                    <table>
                        <thead>
                            <th>Option</th>


                        </thead>
                        <tbody>
                            <tr>
                                <td><input disabled onchange="facilityMapAgro()" id="worship" type="checkbox" value="O-worship"> &nbsp &nbsp Worship</td>
                            </tr>
                            <tr>
                                <td><input disabled onchange="facilityMapAgro()" id="souvenir" type="checkbox" value="O-souvenir"> &nbsp &nbsp Souvenir</td>
                            </tr>
                            <tr>
                                <td><input disabled onchange="facilityMapAgro()" id="event" type="checkbox" value="O-event"> &nbsp &nbsp Event</td>
                            </tr>
                            <tr>
                                <td><input disabled onchange="facilityMapAgro()" id="culinary" type="checkbox" value="O-culinary"> &nbsp &nbsp Culinary</td>
                            </tr>
                            <tr>
                                <td><input disabled onchange="facilityMapAgro()" id="homestay" type="checkbox" value="O-homestay"> &nbsp &nbsp Homestay</td>
                            </tr>






                        </tbody>

                    </table>

                    <br />
                    <br />
                    <input disabled onchange="facilityMapAgro()" type="range" class="form-range" id="radiusRange" value="0" min="0" max="20000">

                    <br />
                    <!-- <div class=" d-flex justify-content-center">
                        <button onclick="radiusWorship()" style="margin:2px; float:left;" class="btn btn-success"><i class="fa-solid fa-person-praying"></i></button>
                        <button onclick="radiusCulinary()" style="margin:2px; float:left;" class="btn btn-success"><i class="fas fa-utensils"></i></button>
                        <button onclick="radiusGift()" style="margin:2px; float:left;" class="btn btn-success"><i class="fa-solid fa-gift"></i></button>
                        <button onclick="radiusEvent()" style="margin:2px; float:left;" class="btn btn-success"><i class="fa fa-calendar" aria-hidden="true"></i>
                        </button>
                    </div> -->


                </div>




            </div>
            <br />
            <br />
            <div class="d-flex justify-content-center">


            </div>




            <div class="panel panel-danger">
                <div class="panel-head">
                    <div id="panelRender">

                    </div>
                </div>

            </div>



        </div>


    </div>

    <script>
        $(document).ready(function() {


            $("#search-box").keyup(function() {
                $.ajax({
                    type: "GET",
                    url: "search_name_only/" + $(this).val(),
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

        function fillResult(keyword) {
            console.log(keyword);
            console.log("Test");
            console.log(keyword);

            $("#search-box").val(keyword);
            $("#suggesstion-box").hide();

            // Panggil AJAX Data yg sesuai dan ubah di maps

            $.ajax({
                type: "GET",
                url: "search_name/" + keyword,
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



    </div>

    <?= $this->endSection() ?>

    <?= $this->section('javascript') ?>
    <script>
        $('#direction-row').hide();
        $('#check-nearby-col').hide();
        $('#result-nearby-col').hide();
    </script>
    <?= $this->endSection() ?>