<script>
    let dataVillage;
    let dataTourism;
    let geom_data = <?php echo json_encode($geometry); ?>;
    let geom_village = <?php echo json_encode($village); ?>;

    <?php
    if (isset($special)) {

    ?>

        let geom_worship = <?php echo json_encode($worship_geom); ?>;
        let geom_souvenir = <?php echo json_encode($souvenir_geom); ?>;
        let geom_event = <?php echo json_encode($event_geom); ?>;
        let geom_culinary = <?php echo json_encode($culinary_geom); ?>;
        let geom_homestay = <?php echo json_encode($homestay_geom); ?>;

        // Fungsi Khusus [Spesial]
    <?php
    }

    ?>
    let markerArray = new Array();
    let markerWorship_All = new Array();
    let markerSouvenir_All = new Array();
    let markerEvent_All = new Array();
    let markerCulinary_All = new Array();
    let markerHomestay_All = new Array();
    let infowindow;
    let contentString;
    let clickCountDelete = 0;
    let click_homestay = 0;
    let click_worship = 0;
    let click_culinary = 0;
    let click_souvenir = 0;
    let click_event = 0;

    // let infowindow;

    function allHide() {
        if (click_homestay == 2 || click_culinary == 2 || click_event == 2 || click_souvenir == 2 || click_worship == 2)

        {

            click_homestay = 0;
            click_worship = 0;
            click_culinary = 0;
            click_souvenir = 0;
            click_event = 0;
            for (let i = 0; i < markerWorship_All.length; i++) {
                markerWorship_All[i].setMap(null);
            }

            for (let i = 0; i < markerSouvenir_All.length; i++) {
                markerSouvenir_All[i].setMap(null);
            }

            for (let i = 0; i < markerEvent_All.length; i++) {
                markerEvent_All[i].setMap(null);
            }

            for (let i = 0; i < markerCulinary_All.length; i++) {
                markerCulinary_All[i].setMap(null);
            }
            for (let i = 0; i < markerHomestay_All.length; i++) {
                markerHomestay_All[i].setMap(null);
            }
        } else {


        }


        if (typeof directionsRenderer1 === 'undefined' || typeof directionsRenderer2 === 'undefined') {

        } else {
            directionsRenderer1.setMap(null);
            directionsRenderer2.setMap(null);


        }

        if (typeof markerRouteStart === 'undefined') {} else

        {
            markerRouteStart.setMap(null);
        }

        if (typeof markerB === 'undefined') {} else

        {
            markerB.setMap(null);
        }

        if (typeof markerB === 'undefined') {} else

        {
            markerA.setMap(null);
        }


    }


    function allHide_UserJS() {



        for (let i = 0; i < markerWorship_All.length; i++) {
            markerWorship_All[i].setMap(null);
        }

        for (let i = 0; i < markerSouvenir_All.length; i++) {
            markerSouvenir_All[i].setMap(null);
        }

        for (let i = 0; i < markerEvent_All.length; i++) {
            markerEvent_All[i].setMap(null);
        }

        for (let i = 0; i < markerCulinary_All.length; i++) {
            markerCulinary_All[i].setMap(null);
        }
        for (let i = 0; i < markerHomestay_All.length; i++) {
            markerHomestay_All[i].setMap(null);
        }



        if (typeof directionsRenderer1 === 'undefined' || typeof directionsRenderer2 === 'undefined') {

        } else {
            directionsRenderer1.setMap(null);
            directionsRenderer2.setMap(null);


        }

        if (typeof markerRouteStart === 'undefined') {} else

        {
            markerRouteStart.setMap(null);
        }

        if (typeof markerA === 'undefined') {} else

        {
            markerA.setMap(null);
        }


    }

    function showHomestay_All() {

        click_homestay++;
        if (click_homestay == 2) {
            allHide();
        } else {

            allHide();

            // [SHOW-ALL]
            // Show All Worship

            // dataVillage = map.data.addGeoJson(
            //     geom_worship
            // );

            let i = 0;
            let length = geom_homestay.features.length;
            while (i < length) {

                let x = geom_homestay.features[i].properties['x'];
                let y = geom_homestay.features[i].properties['y'];
                let posData = {
                    lat: parseFloat(y),
                    lng: parseFloat(x)
                };
                contentString =
                    '<table class="table">' +
                    '<thead>' +
                    '  <tr>' +
                    '    <th class="tg-0lax">' + geom_homestay.features[i].properties['name'] + '</th>' +
                    // '    <th class="tg-0lax">Info</th>' +
                    '  </tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '  <tr>' +
                    '    <td class="tg-0lax" style ="text-align:center"><i class="fa-solid fa-mountain-sun"></i>&nbsp Tourism Object</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['name'] + '</td>' +
                    '  </tr>' +
                    // '  <tr>' +
                    // '    <td class="tg-0lax">Address</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['address'] + '</td>' +
                    // '  </tr>' +
                    // '  <tr>' +
                    // '    <td class="tg-0lax">Open</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['open'] + '</td>' +
                    // '  </tr>' +
                    // '  <tr>' +
                    // '    <td class="tg-0lax">Close</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['close'] + '</td>' +
                    // '  </tr>' +
                    // '  <tr>' +
                    // '    <td class="tg-0lax">Ticket Price</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['ticket_price'] + '</td>' +
                    // '  </tr>' +

                    '</tbody>' +
                    '</table>';
                markerHomestay_All[i] = new google.maps.Marker({
                    position: posData,
                    map,
                    title: "Tourism Object",
                    info: contentString,
                    icon: urlAplikasi + "media/icon/marker_hs.png",
                });


                infowindow = new google.maps.InfoWindow({
                    content: contentString,
                    ariaLabel: "Uluru",
                });

                // markerArray[i].addListener("click", () => {
                //     infowindow.open({
                //         anchor: markerArray[i],
                //         map,
                //     });
                // });



                google.maps.event.addListener(markerHomestay_All[i], 'click', function() {

                    infowindow.setContent(this.info);
                    infowindow.open(map, this);
                    // console.log(this.getPosition().lat());
                    // console.log(this.getPosition().lng());


                });
                i++;
            }
        }





        // alert("TEST");
    }

    function showCulinary_All() {
        click_culinary++;
        if (click_culinary == 2) {
            allHide();

        } else {
            allHide();
            // [SHOW-ALL]
            // Show All Worship

            // dataVillage = map.data.addGeoJson(
            //     geom_worship
            // );

            let i = 0;
            let length = geom_culinary.features.length;
            while (i < length) {

                let x = geom_culinary.features[i].properties['x'];
                let y = geom_culinary.features[i].properties['y'];
                let posData = {
                    lat: parseFloat(y),
                    lng: parseFloat(x)
                };
                contentString =
                    '<table class="table">' +
                    '<thead>' +
                    '  <tr>' +
                    '    <th class="tg-0lax">' + geom_culinary.features[i].properties['name'] + '</th>' +
                    // '    <th class="tg-0lax">Info</th>' +
                    '  </tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '  <tr>' +
                    '    <td class="tg-0lax" style ="text-align:center"><i class="fa-solid fa-mountain-sun"></i>&nbsp Tourism Object</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['name'] + '</td>' +
                    '  </tr>' +
                    // '  <tr>' +
                    // '    <td class="tg-0lax">Address</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['address'] + '</td>' +
                    // '  </tr>' +
                    // '  <tr>' +
                    // '    <td class="tg-0lax">Open</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['open'] + '</td>' +
                    // '  </tr>' +
                    // '  <tr>' +
                    // '    <td class="tg-0lax">Close</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['close'] + '</td>' +
                    // '  </tr>' +
                    // '  <tr>' +
                    // '    <td class="tg-0lax">Ticket Price</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['ticket_price'] + '</td>' +
                    // '  </tr>' +

                    '</tbody>' +
                    '</table>';
                markerCulinary_All[i] = new google.maps.Marker({
                    position: posData,
                    map,
                    title: "Tourism Object",
                    info: contentString,
                    icon: urlAplikasi + "media/icon/marker_cp.png",
                });


                infowindow = new google.maps.InfoWindow({
                    content: contentString,
                    ariaLabel: "Uluru",
                });

                // markerArray[i].addListener("click", () => {
                //     infowindow.open({
                //         anchor: markerArray[i],
                //         map,
                //     });
                // });



                google.maps.event.addListener(markerCulinary_All[i], 'click', function() {

                    infowindow.setContent(this.info);
                    infowindow.open(map, this);
                    // console.log(this.getPosition().lat());
                    // console.log(this.getPosition().lng());


                });
                i++;
            }
        }




        // alert("TEST");
    }

    function showEvent_All() {
        click_event++;

        if (click_event == 2) {
            allHide();
        } else {
            allHide();
            // [SHOW-ALL]
            // Show All Worship

            // dataVillage = map.data.addGeoJson(
            //     geom_worship
            // );

            let i = 0;
            let length = geom_event.features.length;
            while (i < length) {

                let x = geom_event.features[i].properties['x'];
                let y = geom_event.features[i].properties['y'];
                let posData = {
                    lat: parseFloat(y),
                    lng: parseFloat(x)
                };
                contentString =
                    '<table class="table">' +
                    '<thead>' +
                    '  <tr>' +
                    '    <th class="tg-0lax">' + geom_event.features[i].properties['name'] + '</th>' +
                    // '    <th class="tg-0lax">Info</th>' +
                    '  </tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '  <tr>' +
                    '    <td class="tg-0lax" style ="text-align:center"><i class="fa-solid fa-mountain-sun"></i>&nbsp Tourism Object</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['name'] + '</td>' +
                    '  </tr>' +
                    // '  <tr>' +
                    // '    <td class="tg-0lax">Address</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['address'] + '</td>' +
                    // '  </tr>' +
                    // '  <tr>' +
                    // '    <td class="tg-0lax">Open</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['open'] + '</td>' +
                    // '  </tr>' +
                    // '  <tr>' +
                    // '    <td class="tg-0lax">Close</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['close'] + '</td>' +
                    // '  </tr>' +
                    // '  <tr>' +
                    // '    <td class="tg-0lax">Ticket Price</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['ticket_price'] + '</td>' +
                    // '  </tr>' +

                    '</tbody>' +
                    '</table>';
                markerEvent_All[i] = new google.maps.Marker({
                    position: posData,
                    map,
                    title: "Tourism Object",
                    info: contentString,
                    icon: urlAplikasi + "media/icon/marker_ev.png",
                });


                infowindow = new google.maps.InfoWindow({
                    content: contentString,
                    ariaLabel: "Uluru",
                });

                // markerArray[i].addListener("click", () => {
                //     infowindow.open({
                //         anchor: markerArray[i],
                //         map,
                //     });
                // });



                google.maps.event.addListener(markerEvent_All[i], 'click', function() {

                    infowindow.setContent(this.info);
                    infowindow.open(map, this);
                    // console.log(this.getPosition().lat());
                    // console.log(this.getPosition().lng());


                });
                i++;
            }
        }


        // alert("TEST");
    }

    function showWorship_All() {
        click_worship++;
        if (click_worship == 2) {
            allHide();
        } else {

            allHide();
            // [SHOW-ALL]
            // Show All Worship

            // dataVillage = map.data.addGeoJson(
            //     geom_worship
            // );

            let i = 0;
            let length = geom_worship.features.length;
            while (i < length) {

                let x = geom_worship.features[i].properties['x'];
                let y = geom_worship.features[i].properties['y'];
                let posData = {
                    lat: parseFloat(y),
                    lng: parseFloat(x)
                };
                contentString =
                    '<table class="table">' +
                    '<thead>' +
                    '  <tr>' +
                    '    <th class="tg-0lax">' + geom_worship.features[i].properties['name'] + '</th>' +
                    // '    <th class="tg-0lax">Info</th>' +
                    '  </tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '  <tr>' +
                    '    <td class="tg-0lax" style ="text-align:center"><i class="fa-solid fa-mountain-sun"></i>&nbsp Tourism Object</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['name'] + '</td>' +
                    '  </tr>' +
                    // '  <tr>' +
                    // '    <td class="tg-0lax">Address</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['address'] + '</td>' +
                    // '  </tr>' +
                    // '  <tr>' +
                    // '    <td class="tg-0lax">Open</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['open'] + '</td>' +
                    // '  </tr>' +
                    // '  <tr>' +
                    // '    <td class="tg-0lax">Close</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['close'] + '</td>' +
                    // '  </tr>' +
                    // '  <tr>' +
                    // '    <td class="tg-0lax">Ticket Price</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['ticket_price'] + '</td>' +
                    // '  </tr>' +

                    '</tbody>' +
                    '</table>';
                markerWorship_All[i] = new google.maps.Marker({
                    position: posData,
                    map,
                    title: "Tourism Object",
                    info: contentString,
                    icon: urlAplikasi + "media/icon/marker_wp.png",
                });


                infowindow = new google.maps.InfoWindow({
                    content: contentString,
                    ariaLabel: "Uluru",
                });

                // markerArray[i].addListener("click", () => {
                //     infowindow.open({
                //         anchor: markerArray[i],
                //         map,
                //     });
                // });



                google.maps.event.addListener(markerWorship_All[i], 'click', function() {

                    infowindow.setContent(this.info);
                    infowindow.open(map, this);
                    // console.log(this.getPosition().lat());
                    // console.log(this.getPosition().lng());


                });
                i++;
            }
        }


        // alert("TEST");
    }

    function showSouvenir_All() {

        click_souvenir++;
        if (click_souvenir == 2) {
            allHide();

        } else {

            allHide();

            // [SHOW-ALL]
            // Show All Worship

            // dataVillage = map.data.addGeoJson(
            //     geom_worship
            // );

            let i = 0;
            let length = geom_souvenir.features.length;
            while (i < length) {

                let x = geom_souvenir.features[i].properties['x'];
                let y = geom_souvenir.features[i].properties['y'];
                let posData = {
                    lat: parseFloat(y),
                    lng: parseFloat(x)
                };
                contentString =
                    '<table class="table">' +
                    '<thead>' +
                    '  <tr>' +
                    '    <th class="tg-0lax">' + geom_souvenir.features[i].properties['name'] + '</th>' +
                    // '    <th class="tg-0lax">Info</th>' +
                    '  </tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '  <tr>' +
                    '    <td class="tg-0lax" style ="text-align:center"><i class="fa-solid fa-mountain-sun"></i>&nbsp Tourism Object</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['name'] + '</td>' +
                    '  </tr>' +
                    // '  <tr>' +
                    // '    <td class="tg-0lax">Address</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['address'] + '</td>' +
                    // '  </tr>' +
                    // '  <tr>' +
                    // '    <td class="tg-0lax">Open</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['open'] + '</td>' +
                    // '  </tr>' +
                    // '  <tr>' +
                    // '    <td class="tg-0lax">Close</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['close'] + '</td>' +
                    // '  </tr>' +
                    // '  <tr>' +
                    // '    <td class="tg-0lax">Ticket Price</td>' +
                    // '    <td class="tg-0lax">' + geom_data.features[i].properties['ticket_price'] + '</td>' +
                    // '  </tr>' +

                    '</tbody>' +
                    '</table>';
                markerSouvenir_All[i] = new google.maps.Marker({
                    position: posData,
                    map,
                    title: "Tourism Object",
                    info: contentString,
                    icon: urlAplikasi + "media/icon/marker_sp.png",
                });


                infowindow = new google.maps.InfoWindow({
                    content: contentString,
                    ariaLabel: "Uluru",
                });

                // markerArray[i].addListener("click", () => {
                //     infowindow.open({
                //         anchor: markerArray[i],
                //         map,
                //     });
                // });



                google.maps.event.addListener(markerSouvenir_All[i], 'click', function() {

                    infowindow.setContent(this.info);
                    infowindow.open(map, this);
                    // console.log(this.getPosition().lat());
                    // console.log(this.getPosition().lng());


                });
                i++;
            }
        }


        // alert("TEST");
    }



    function callAfterPut() {
        dataVillage = map.data.addGeoJson(
            geom_village
        );
        dataTourism = map.data.addGeoJson(
            geom_data
        );
        map.data.setStyle({
            clickable: false
        });


        // console.log(dataTourism);

        // console.log(geom_data.features.length);
        let i = 0;
        let length = geom_data.features.length;
        while (i < length) {
            console.log(geom_data.features[i].properties['x']);
            console.log(geom_data.features[i].properties['y']);
            let x = geom_data.features[i].properties['x'];
            let y = geom_data.features[i].properties['y'];
            let posData = {
                lat: parseFloat(y),
                lng: parseFloat(x)
            };
            contentString =
                '<table class="table">' +
                '<thead>' +
                '  <tr>' +
                '    <th class="tg-0lax">' + geom_data.features[i].properties['name'] + '</th>' +
                // '    <th class="tg-0lax">Info</th>' +
                '  </tr>' +
                '</thead>' +
                '<tbody>' +
                '  <tr>' +
                '    <td class="tg-0lax" style ="text-align:center"><i class="fa-solid fa-mountain-sun"></i>&nbsp Tourism Object</td>' +
                // '    <td class="tg-0lax">' + geom_data.features[i].properties['name'] + '</td>' +
                '  </tr>' +
                // '  <tr>' +
                // '    <td class="tg-0lax">Address</td>' +
                // '    <td class="tg-0lax">' + geom_data.features[i].properties['address'] + '</td>' +
                // '  </tr>' +
                // '  <tr>' +
                // '    <td class="tg-0lax">Open</td>' +
                // '    <td class="tg-0lax">' + geom_data.features[i].properties['open'] + '</td>' +
                // '  </tr>' +
                // '  <tr>' +
                // '    <td class="tg-0lax">Close</td>' +
                // '    <td class="tg-0lax">' + geom_data.features[i].properties['close'] + '</td>' +
                // '  </tr>' +
                // '  <tr>' +
                // '    <td class="tg-0lax">Ticket Price</td>' +
                // '    <td class="tg-0lax">' + geom_data.features[i].properties['ticket_price'] + '</td>' +
                // '  </tr>' +

                '</tbody>' +
                '</table>' + "<div class='d-flex justify-content-center'><button style='margin:5px;' onclick='infoDetail(" + '"' + geom_data.features[0].properties['id'] + '"' + ")' class='btn btn-outline-primary'><i class='fa fa-info-circle' aria-hidden='true'></i> </button><button style='margin:5px;' onclick='dirrectionPointTemp(" + x + "," + y + ")' class='btn btn-outline-primary'><i class='fa-solid fa-route'></i></button > </div>";
            markerArray[i] = new google.maps.Marker({
                position: posData,
                map,
                title: "Tourism Object",
                info: contentString,
                icon: urlAplikasi + "media/icon/marker_to.png",
            });


            infowindow = new google.maps.InfoWindow({
                content: contentString,
                ariaLabel: "Uluru",
            });

            // markerArray[i].addListener("click", () => {
            //     infowindow.open({
            //         anchor: markerArray[i],
            //         map,
            //     });
            // });



            google.maps.event.addListener(markerArray[i], 'click', function() {

                infowindow.setContent(this.info);
                infowindow.open(map, this);
                // console.log(this.getPosition().lat());
                // console.log(this.getPosition().lng());
                latDetail = this.getPosition().lat();
                lngDetail = this.getPosition().lng();

                let posData = {
                    lat: parseFloat(latDetail),
                    lng: parseFloat(lngDetail)
                };
                GPSLocation = {
                    lat: parseFloat(latDetail),
                    lng: parseFloat(lngDetail)
                };
                // setMapOnAll(null);
                // markerArray = [];

                $("#radiusRange").prop('disabled', false);
                $("#worship").prop('disabled', false);
                $("#culinary").prop('disabled', false);
                $("#event").prop('disabled', false);
                $("#souvenir").prop('disabled', false);
                $("#homestay").prop('disabled', false);


                console.log(posData);
                // markerArray[0] = new google.maps.Marker({
                //     position: posData,
                //     map,
                //     title: "Hello World!",
                //     info: contentString
                // });

            });
            i++;
        }




        console.log(markerArray[0])
    }
</script>