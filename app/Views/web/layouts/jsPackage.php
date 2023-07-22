<script>
    let dataVillage;
    let dataTourism;

    let geom_village = <?php echo json_encode($village); ?>;
    let markerArray = new Array();
    let infowindow;
    let contentString;
    // let infowindow;


    function callAfterPut() {
        dataVillage = map.data.addGeoJson(
            geom_village
        );

        map.data.setStyle({
            clickable: false
        });


        // console.log(dataTourism);






        console.log(markerArray[0])
    }
</script>