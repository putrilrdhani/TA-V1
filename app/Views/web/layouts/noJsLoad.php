<?php
if (isset($data[0]->geom)) {
?>
    <script>
        let digitasiDB;
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