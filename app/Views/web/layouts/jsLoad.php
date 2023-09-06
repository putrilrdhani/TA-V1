<script>
    $("#legend").hide();
</script>
<?php
if (isset($data[0]->geom)) {
?>
    <script>
        let digitasiDB;
        console.log("JS LOAD BERHASIL")

        function callAfterPut() {
            console.log("INI BENAR-BENAR DIPANGGIL");
            let geom = <?php echo json_encode($geometry); ?>;


            let geomUpdate = JSON.stringify(geom.features[0].geometry.coordinates);
            let geomType = JSON.stringify(geom.features[0].geometry.type);
            geomType = geomType.replaceAll('"', "");
            geomType = geomType.toUpperCase();
            geomUpdate = geomUpdate.replaceAll("[", "");
            geomUpdate = geomUpdate.replaceAll("]", "");
            console.log(geomUpdate);
            console.log(geomType);
            let geomUpdateText = "";
            if (geomType == "POINT") {
                geomUpdate = geomUpdate.replaceAll(",", " ");
                geomUpdateText = geomType + "(" + geomUpdate + ")";
            } else {

                console.log(geomUpdate);
                geomUpdate = geomUpdate.split(",");
                let length = geomUpdate.length;
                console.log(length);
                // Bentuk ulang datanya
                let x = 1;
                let rajutText = "";
                while (x <= length) {
                    if (x % 2 == 0) {

                        if (x == length) {
                            rajutText = rajutText + geomUpdate[x - 1];
                        } else {
                            rajutText = rajutText + geomUpdate[x - 1] + ",";
                        }
                    } else {
                        rajutText = rajutText + geomUpdate[x - 1] + " ";
                    }

                    x++;
                }
                console.log(rajutText);
                geomUpdateText = geomType + "((" + rajutText + "))";

            }

            console.log(geomUpdateText);
            console.log(geomType);
            $("#geom").val(geomUpdateText);

            // Load geojson ke google map
            digitasiDB = map.data.addGeoJson(
                geom
            );


            if (typeView == "SOUVENIR") {
                map.data.setStyle({
                    clickable: false,
                    fillColor: 'red',
                    strokeWeight: 1
                });
            } else if (typeView == "CULINARY") {
                map.data.setStyle({
                    clickable: false,
                    fillColor: '#8C001A',
                    strokeWeight: 1
                });
            } else if (typeView == "EVENT") {
                map.data.setStyle({
                    clickable: false,
                    fillColor: 'red',
                    strokeWeight: 1
                });
            } else if (typeView == "WORSHIP") {
                map.data.setStyle({
                    clickable: false,
                    fillColor: 'green',
                    strokeWeight: 1
                });
            } else if (typeView == "HOMESTAY") {
                map.data.setStyle({
                    clickable: false,
                    fillColor: 'orange',
                    strokeWeight: 1
                });
            }


            console.log(geom['features'][0].properties.x);
            if (geom['features'][0].properties.x != "") {
                let x = parseFloat(geom['features'][0].properties.x);
                let y = parseFloat(geom['features'][0].properties.y);
                console.log("ATAS");

                map.setCenter(new google.maps.LatLng(y, x));
                map.setZoom(20);
                console.log(geom);
                console.log("BAWAH")

                console.log(x);

                // map.setCenter(x, y, 23)
            }


            putCounter = 1;
        }
    </script>
    <?php
} else {
    if (isset($data['geom'])) {
    ?>
        <script>
            let digitasiDB;
            let typeView = "";
            console.log("JS LOAD BERHASIL")

            function callAfterPut() {
                let geom = <?php echo json_encode($geometry); ?>;

                let geomUpdate = JSON.stringify(geom.features[0].geometry.coordinates);
                let geomType = JSON.stringify(geom.features[0].geometry.type);
                geomType = geomType.replaceAll('"', "");
                geomType = geomType.toUpperCase();
                geomUpdate = geomUpdate.replaceAll("[", "");
                geomUpdate = geomUpdate.replaceAll("]", "");
                console.log(geomUpdate);
                console.log(geomType);
                let geomUpdateText = "";
                if (geomType == "POINT") {
                    geomUpdate = geomUpdate.replaceAll(",", " ");
                    geomUpdateText = geomType + "(" + geomUpdate + ")";
                } else {

                    console.log(geomUpdate);
                    geomUpdate = geomUpdate.split(",");
                    let length = geomUpdate.length;
                    console.log(length);
                    // Bentuk ulang datanya
                    let x = 1;
                    let rajutText = "";
                    while (x <= length) {
                        if (x % 2 == 0) {

                            if (x == length) {
                                rajutText = rajutText + geomUpdate[x - 1];
                            } else {
                                rajutText = rajutText + geomUpdate[x - 1] + ",";
                            }
                        } else {
                            rajutText = rajutText + geomUpdate[x - 1] + " ";
                        }

                        x++;
                    }
                    console.log(rajutText);
                    geomUpdateText = geomType + "((" + rajutText + "))";

                }

                console.log(geomUpdateText);
                console.log(geomType);
                $("#geom").val(geomUpdateText);

                // Load geojson ke google map
                digitasiDB = map.data.addGeoJson(
                    geom
                );



                putCounter = 1;

            }
        </script>

    <?php
    } else {
    ?>

        <script>
            function callAfterPut() {
                console.log("data kosong");

            }
        </script>

    <?php
    }
    ?>

<?php
}
?>

<?php

if (isset($type)) {
?>
    <script>
        typeView = "<?php echo $type ?>";
    </script>

<?php
}

?>