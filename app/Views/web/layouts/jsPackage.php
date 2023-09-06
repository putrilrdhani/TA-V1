<script>
    let dataVillage;
    let dataTourism;

    let geom_village = <?php echo json_encode($village); ?>;
    let markerArray = new Array();
    let infowindow;
    let contentString;
    let temp_iw;
    let temp_m;
    let data_layer;
    let data_layer_2;
    let data_layer_3;
    // let infowindow;


    function callAfterPut() {
        dataVillage = map.data.addGeoJson(
            geom_village
        );

        map.data.setStyle({
            clickable: false
        });
        map.data.setStyle({
            clickable: false,
            fillColor: 'blue',
            strokeWeight: 1,
            strokeColor: "red"
        });

        data_layer = new google.maps.Data({
            map: map
        });
        data_layer_2 = new google.maps.Data({
            map: map
        });
        data_layer_3 = new google.maps.Data({
            map: map
        });
        data_layer.loadGeoJson(
            urlAplikasi + "js/sumbar.geojson"
        );
        data_layer_3.loadGeoJson(
            urlAplikasi + "js/kelsolok.geojson"
        );

        var ced = google.maps.event.addListener(data_layer_3, 'click', function(event) {

            if (typeof temp_m === 'undefined') {} else

            {
                temp_m.setMap(null);
            }
            console.log("test click");
            console.log(event.feature.getProperty('DESA'))
            // alert("Koordinat:lat: " + event.latLng.lat() + ", lng: " + event.latLng.lng());
            // alert(event.feature.getProperty('DESA'));

            let only_name = event.feature.getProperty('DESA');
            temp_iw = new google.maps.InfoWindow({
                content: only_name,
                ariaLabel: event.feature.getProperty('DESA'),
            });
            let posData = {
                lat: parseFloat(event.latLng.lat()),
                lng: parseFloat(event.latLng.lng()),
            };
            temp_m = new google.maps.Marker({
                position: posData,
                map,
                title: event.feature.getProperty('DESA'),
            });

            temp_m.setVisible(false);

            temp_iw.open({
                anchor: temp_m,
                map,
            });


        });
        data_layer_2.loadGeoJson(
            urlAplikasi + "js/solok.geojson"
        );
        data_layer.setStyle({
            clickable: false,
            fillColor: 'green',
            strokeWeight: 1,
            strokeColor: "green"
        });
        data_layer_2.setStyle({
            clickable: false,
            fillColor: 'white',
            strokeWeight: 1,
            strokeColor: "red"
        });
        data_layer_3.setStyle({

            fillColor: 'yellow',
            strokeWeight: 1,
            strokeColor: "blue"
        });


        // console.log(dataTourism);






        console.log(markerArray[0])
    }
</script>