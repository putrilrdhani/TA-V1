<?= $this->extend('web/layouts/main'); ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="row">
        <!--map-->
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">

                        <div class="col-md-auto">
                            <h5 class="card-title">Google Maps with Location</h5>


                        </div>
                        <?= $this->include('web/layouts/map-head'); ?>

                    </div>
                </div>
                <?= $this->include('web/layouts/map-body'); ?>
            </div>
        </div>

        <script>
            let geodata = <?php echo json_encode($geom); ?>;
            // geodata = JSON.parse(geodata);
            console.log(geodata);
            map.data.addGeoJson(
                geodata
            );
            const drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.MARKER,
                drawingControl: true,
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: [
                        google.maps.drawing.OverlayType.MARKER,
                        google.maps.drawing.OverlayType.CIRCLE,
                        google.maps.drawing.OverlayType.POLYGON,
                        google.maps.drawing.OverlayType.POLYLINE,
                        google.maps.drawing.OverlayType.RECTANGLE,
                    ],
                },
                markerOptions: {
                    icon: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
                },
                circleOptions: {
                    fillColor: "#ffff00",
                    fillOpacity: 1,
                    strokeWeight: 5,
                    clickable: false,
                    editable: true,
                    zIndex: 1,
                },
            });

            drawingManager.setMap(map);
        </script>

    </div>
    <!-- Direction section -->
    <?= $this->include('web/layouts/direction'); ?>
</section>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $('#direction-row').hide();
    $('#check-nearby-col').hide();
    $('#result-nearby-col').hide();
</script>
<?= $this->endSection() ?>