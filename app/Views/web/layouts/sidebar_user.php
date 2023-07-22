<?php
$uri = service('uri')->getSegments();
$uri1 = $uri[1] ?? 'index';
$uri2 = $uri[2] ?? '';
$uri3 = $uri[3] ?? '';
?>

<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <!-- Sidebar Header -->
        <?= $this->include('web/layouts/sidebar_header'); ?>

        <!-- Sidebar -->
        <div class="sidebar-menu">
            <div class="d-flex flex-column">
                <div class="d-flex justify-content-center avatar avatar-xl me-3" id="avatar-sidebar">
                    <img src="<?= base_url('media/photos/pesona_sumpu.png'); ?>" alt="" srcset="">
                </div>
                <div class="p-2 d-flex justify-content-center">Hello, Visitor</div>
                <ul class="menu">

                    <!-- 
                    <li class="sidebar-item <?= ($uri1 == '') ? 'active' : '' ?>">
                        <a href="<?= base_url('web/detail/TO3'); ?>" class="sidebar-link">
                            <i class="fa-solid fas fa-mountain-sun"></i><span>Batu Patah Payo</span>
                        </a>
                    </li> -->



                    <li class="sidebar-item" id="rg-list">
                        <a href="<?= base_url('web'); ?>" class="sidebar-link">
                            <i class="fa-solid fa-home"></i><span>Home</span>
                        </a>
                    </li>
                    <li class="sidebar-item" id="rg-list">
                        <a href="<?= base_url('web/list_agro'); ?>" class="sidebar-link">
                            <i class="fa-solid fa-mountain-sun"></i><span>Batu Patah Payo</span>
                        </a>
                    </li>
                    <!-- <li class="sidebar-item <?= ($uri1 == 'object1') ? 'active' : '' ?> has-sub">
                        <a href="" class="sidebar-link">
                            <i class="fa-solid fas fa-mountain-sun"></i><span>Agrotourism</span>
                        </a>

                        <ul class="submenu <?= ($uri1 == 'object1') ? 'active' : '' ?>">
                            
                            <li class="submenu-item" id="rg-list">
                                <a href="<?= base_url('web/list_agro'); ?>"><i class="fa-solid fas fa-list me-3"></i>Batu Patah Payo</a>
                            </li>
                            <li class="submenu-item" id="rg-list">
                                <a href="<?= base_url('web/radius_agro'); ?>"><i class="fa-solid fas fa-satellite-dish me-3"></i>Around You</a>
                            </li>
                            <li class="submenu-item" id="rg-list">
                                <a href="<?= base_url('web/search_agro'); ?>"><i class="fa-solid fas fa-magnifying-glass me-3"></i>Search</a>
                            </li> 




                </ul>
                </li> -->




                    <li class="sidebar-item <?= ($uri1 == 'object5') ? 'active' : '' ?> has-sub">
                        <a href="" class="sidebar-link">
                            <i class="fa-solid fa-tree"></i><span>Payo Tourism</span>
                        </a>

                        <ul class="submenu <?= ($uri1 == 'object5') ? 'active' : '' ?>">
                            <!-- List Object -->
                            <li class="submenu-item" id="rg-list">
                                <a href="<?= base_url('web/list_tourism'); ?>" class="sidebar-link">
                                    <span><i class="fa-solid fa-list"></i></span><span>List</span></a>
                            </li>
                            <li class="submenu-item" id="rg-list">
                                <a href="<?= base_url('web/radius_tourism'); ?>" class="sidebar-link">
                                    <span> <i class="fa-solid fa-satellite-dish"></i></span><span>Around You</span></a>
                            </li>
                            <!-- <li class="submenu-item" id="rg-list">
                                <a href="<?= base_url('web/search_tourism'); ?>"><i class="fa-solid fa-magnifying-glass me-3"></i>Search</a>
                            </li> -->
                            <li class="sidebar-item <?= ($uri1 == 'object5') ? 'active' : '' ?> has-sub">
                                <a href="" class="sidebar-link">
                                    <i class="fa-solid fa-a"></i><span>Search by Name</span>
                                </a>
                                <ul class="submenu <?= ($uri1 == 'object5') ? 'active' : '' ?>">
                                    <!-- List Object -->
                                    <li class="submenu-item" id="rg-list">
                                        <span><input id="search-name" class="form-control" type="text"></input></span>

                                        <button style="margin-top:10px;" onclick='searchByName()' class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-item <?= ($uri1 == 'object5') ? 'active' : '' ?> has-sub">
                                <a href="" class="sidebar-link">
                                    <i class="fa-solid fa-utensils me-3"></i><span>Search by Facility</span>
                                </a>
                                <ul class="submenu <?= ($uri1 == 'object5') ? 'active' : '' ?>">
                                    <li class="submenu-item" id="rg-list">
                                        <span>
                                            <div id="checkBoxFacility"></div>
                                        </span>

                                        <button style="margin-top:10px;" onclick='searchByFacilityCheck()' class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </li>
                                </ul>
                            </li>
                            <script>
                                $.get(urlAplikasi + "web/select_selected/", function(data) {

                                    let facility_list = JSON.parse(data);
                                    console.log(facility_list);

                                    let f_length = facility_list.features.length;
                                    let m = 0;
                                    while (m < f_length) {
                                        // $('#select-name').append($('<option>', {
                                        //     value: facility_list.features[m].properties.id_facility,
                                        //     text: facility_list.features[m].properties.name
                                        // }));

                                        $('#checkBoxFacility').append('<input id="secret_' + facility_list.features[m].properties.id_facility + '" type="checkbox" name="' + facility_list.features[m].properties.name + '" value="' + facility_list.features[m].properties.id_facility + '"/> ' + facility_list.features[m].properties.name + '<br />');

                                        m++;
                                    }
                                });
                            </script>

                        </ul>
                    </li>
                    <li class="sidebar-item <?= ($uri1 == 'object7') ? 'active' : '' ?>">
                        <a href="<?= base_url('web/list_package'); ?>" class="sidebar-link">
                            <i class="fa-solid fa-clipboard-list"></i><span>Package</span>
                        </a>
                    </li>
                    <li class="sidebar-item" id="rg-list">
                        <a href="<?= base_url('web/search_all/search_all'); ?>" class="sidebar-link">
                            <i class="fa-solid fa-map-location-dot"></i><span>Explore Payo</span>
                        </a>
                    </li>



                    <?php if ($log == "login") {

                    ?>
                        <li class="sidebar-item" id="rg-list">
                            <a href="<?= base_url('web/detail_booking'); ?>" class="sidebar-link">
                                <i class="fa-solid fa-basket-shopping"></i><span>My Booking</span>
                            </a>
                        </li>
                        <li class="sidebar-item" id="rg-list">
                            <a href="<?= base_url('logout'); ?>" class="sidebar-link">Logout &nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></a>
                        </li>
                    <?php
                    } else {


                    ?>
                        <li class="sidebar-item" id="rg-list">
                            <a href="<?= base_url('login'); ?>" class="sidebar-link">Login &nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></a>
                        </li>
                    <?php
                    } ?>
                    <!-- <li class="sidebar-item <?= ($uri1 == 'object5') ? 'active' : '' ?> has-sub">
                        <a href="" class="sidebar-link">
                            <i class="fa-solid fa-magnifying-glass"></i><span>Search</span>
                        </a>

                        <ul class="submenu <?= ($uri1 == 'object5') ? 'active' : '' ?>">
                            
                            <li class="submenu-item" id="rg-list">
                                <a href="<?= base_url('web/search_all/search_all'); ?>" class="sidebar-link">
                                    <span><i class="fa-solid fa-magnifying-glass"></i></span><span>Facility in Payo</span>
                                </a>
                            </li>
                            <li class="sidebar-item <?= ($uri1 == 'object5') ? 'active' : '' ?> has-sub">
                                <a href="" class="sidebar-link">
                                    <i class="fa-solid fa-a"></i><span>Search by Name</span>
                                </a>
                                <ul class="submenu <?= ($uri1 == 'object5') ? 'active' : '' ?>">
                                    
                                    <li class="submenu-item" id="rg-list">
                                        <span><input id="search-name" class="form-control" type="text"></input></span>

                                        <button style="margin-top:10px;" onclick='searchByName()' class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-item <?= ($uri1 == 'object5') ? 'active' : '' ?> has-sub">
                                <a href="" class="sidebar-link">
                                    <i class="fa-solid fa-utensils"></i><span>Search by Facility</span>
                                </a>
                                <ul class="submenu <?= ($uri1 == 'object5') ? 'active' : '' ?>">
                                    <li class="submenu-item" id="rg-list">
                                        <span>
                                            <div id="checkBoxFacility"></div>
                                        </span>

                                        <button style="margin-top:10px;" onclick='searchByFacilityCheck()' class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </li>
                                </ul>
                            </li>
                            <script>
                                $.get(urlAplikasi + "web/select_selected/", function(data) {

                                    let facility_list = JSON.parse(data);
                                    console.log(facility_list);

                                    let f_length = facility_list.features.length;
                                    let m = 0;
                                    while (m < f_length) {
                                        // $('#select-name').append($('<option>', {
                                        //     value: facility_list.features[m].properties.id_facility,
                                        //     text: facility_list.features[m].properties.name
                                        // }));

                                        $('#checkBoxFacility').append('<input id="secret_' + facility_list.features[m].properties.id_facility + '" type="checkbox" name="' + facility_list.features[m].properties.name + '" value="' + facility_list.features[m].properties.id_facility + '"/> ' + facility_list.features[m].properties.name + '<br />');

                                        m++;
                                    }
                                });
                            </script>



                        </ul>
                    </li> -->




                    <br />
                    <div class=" d-grid gap-2 d-md-flex justify-content-md-center">
                        <button type=" button" class="btn btn-outline-light btn-sm">
                            <a href="https://www.instagram.com/kampung_wisata_payo/" style="color:#8896dd">
                                <i class="fab fa-instagram me-1"></i>Instagram</a></button>
                        <button type="button" class="btn btn-outline-light btn-sm">
                            <a href="https://www.instagram.com/kampung_wisata_payo/" style="color:#8896dd">
                                <i class="fab fa-tiktok me-1"></i>Tiktok</a></button>
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
                url: "search_name_only_all/" + $(this).val(),
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
            url: "search_name_all/" + keyword,
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