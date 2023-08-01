<style>
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


    <div class="row" id="coorAdmin">

        <div class="col-sm-4">

            <div id="panel">

                <div id="color-palette"></div>
                <div>
                    <br />
                    <button class="btn btn-danger" id="delete-button"><i class="fa-solid fa-draw-polygon"></i></button>
                    <button class="btn btn-danger" id="delete-map" onclick="initialize()"><i class="fa-solid fa-layer-group"></i></button>

                </div>


            </div>
        </div>

        <div class="col-sm-8">
            <div class="row">

                <div class="col-sm-5">
                    <div>
                        <input id="lat_admin" class="form form-control" type="text" name="lat_admin" placeholder="Latitude">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div>
                        <input id="lng_admin" class="form form-control" type="text" name="lng_admin" placeholder="Longitude">
                    </div>
                </div>

                <div class="col-sm-2">
                    <button onclick="setPositionAdmin()" class="btn btn-info">Set</button>
                </div>
            </div>
            <br />


        </div>


    </div>

    <div class="googlemaps" id="googlemaps"></div>
</div>