<style>
    #map,
    html,
    body {
        padding: 0;
        margin: 0;
        height: 100%;
    }

    #panel {
        width: 200px;
        font-family: Arial, sans-serif;
        font-size: 13px;
        float: right;
        margin: 10px;
    }

    #color-palette {
        clear: both;
    }

    .color-button {
        width: 14px;
        height: 14px;
        font-size: 0;
        margin: 2px;
        float: left;
        cursor: pointer;
    }
</style>
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-1"></div>
</div>

<div class="card-body">
    <!-- <div class="googlemaps" id="googlemaps"></div> -->
    <!-- <script>initMap(); </script> -->
    <!-- <div id="legend"></div> -->
    <!-- <script>
        $('#legend').hide();
        getLegend();
    </script> -->

    <div id="legend">

    </div>

    <div id="panel">
        <div id="color-palette"></div>
        <div>
            <br />
            <button class="btn btn-danger" id="delete-button"><i class="fa-solid fa-draw-polygon"></i></button>
            <button class="btn btn-danger" id="delete-map" onclick="initialize()"><i class="fa-solid fa-layer-group"></i></button>

        </div>


    </div>

    <div class="googlemaps" id="googlemaps"></div>
</div>