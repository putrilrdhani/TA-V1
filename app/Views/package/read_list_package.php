<?= $this->extend('web/layouts/main_admin'); ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="row">
        <!--map-->
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <!-- Javascript untuk  memuat peta -->
                    <?= $this->include('web/layouts/jsLoad'); ?>

                    <?= $this->include('web/layouts/map-body'); ?>
                    <!-- Isi Disini -->
                    <?php

                    // var_dump($finalArray);
                    ?>

                    <div class="row content">
                        <h3><small><?= $data[0]->name ?></small></h3>
                    </div>
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th width="15%">Name</th>
                                <td>: <?php echo $data[0]->name; ?></td>
                            </tr>
                            <tr>
                                <th width="15%">Min Capaity</th>
                                <td>: <?php echo $data[0]->min_capaity; ?></td>
                            </tr>
                            <tr>
                                <th width="15%">Contact Person</th>
                                <td>: <?php echo $data[0]->contact_person; ?></td>
                            </tr>
                            <tr>
                                <th width="15%">Description</th>
                                <td>: <?php echo $data[0]->description; ?></td>
                            </tr>
                            <tr>
                                <th width="15%">Brosur Url</th>
                                <td>: <?php echo $data[0]->brosur_url; ?></td>
                            </tr>
                            <tr>
                                <th width="15%">Price</th>
                                <td>: <?php echo $data[0]->price; ?></td>
                            </tr>
                            <?php

                            $count_day = count($package_day['features']);
                            $count_detail = count($detail_package['features']);
                            $count_detail_service = count($detail_service_package['features']);

                            $i = 0;

                            while ($i < $count_day) {
                            ?>
                                <tr>

                                    <th width="15%" style="text-align: left;">Hari <?= $package_day['features'][$i]['properties']['day']; ?></th>
                                    <td><button class="btn btn-outline-primary" onclick="routeDayShow('<?= $package_day['features'][$i]['properties']['id_package']; ?>',<?= $package_day['features'][$i]['properties']['day']; ?>)">Show Route</button></td>
                                </tr>
                                <tr>
                                    <th width="15%">Activity</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>
                                        <?php
                                        $j = 0;

                                        while ($j < $count_detail) {

                                            if ($package_day['features'][$i]['properties']['day'] == $detail_package['features'][$j]['properties']['day']) {
                                                echo $detail_package['features'][$j]['properties']['description'] ?><br />



                                    <?php
                                            }
                                            $j++;
                                        }
                                        $i++;
                                    }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="15%">Service</th>
                                    <td>: </td>
                                </tr>

                                <tr>
                                    <th width="15%"></th>
                                    <td><?php
                                        $j = 0;

                                        while ($j < $count_detail_service) {


                                            echo $detail_service_package['features'][$j]['properties']['name'] ?><br />

                                        <?php
                                            $j++;
                                        }
                                        ?></td>
                                </tr>

                        </tbody>
                    </table>

                    <!-- Disini tabel informasinya -->
                    <!-- Buat day dulu -->
                    <!--  -->


                    <div class="d-flex p-2 bd-highlight">
                        <a class="btn btn-sm btn-danger" href="<?= \base_url('package') ?>">back</a>
                    </div>



                </div>
            </div>
        </div>
        <!-- <div class="col-md-4">

			<div class="card">

				<div class="table-responsive">
					<table id="panelRenderX" class="table table-hover mb-0 table-lg">
						<thead>
							<tr>
								<th>Distance (m)</th>
								<th>Steps</th>
							</tr>
						</thead>
						<tbody id="table-direction">

						</tbody>
					</table>
				</div>
			</div> -->
    </div>
    </div>

</section>

<?php
// var_dump($finalArray);

$count = count($finalArray['bulk']);
// echo $count;
$i = 0;
while ($i < $count) {
    // Setiap dua kali maka data dari koordinat diambil
    $j = $i + 1;
    $k = $count;


    $x = $finalArray['bulk'][$i]['properties']['x'];
    $y = $finalArray['bulk'][$i]['properties']['y'];

?>
    <?php echo "<script> dirrectionManual( " . $x . ", " . $y . "); </script>" ?>

<?php


    $i++;
}

?>

<script>
    $("#color-palette").prop("hidden", true);
    $("#delete-button").prop("hidden", true);
    $("#delete-map").prop("hidden", true);
</script>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $('#direction-row').hide();
    $('#check-nearby-col').hide();
    $('#coorAdmin').hide();
    $('#result-nearby-col').hide();
</script>
<script>
    const myTimeout = setTimeout(routeWayPoints, 2000);
</script>
<?= $this->endSection() ?>