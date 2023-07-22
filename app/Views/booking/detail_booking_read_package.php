<?= $this->extend('web/layouts/main_user'); ?>

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


                    <div class="row content">
                        <div class="col">


                            <h3><small><?= $data[0]->name ?></small></h3>
                        </div>
                    </div>
                </div>
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th width="15%" style="text-align: left;">Name</th>
                            <td>: <?php echo $data[0]->name; ?></td>
                        </tr>

                        <tr>
                            <th width="15%" style="text-align: left;">Min Capaity</th>
                            <td>: <?php echo $data[0]->min_capaity; ?></td>
                        </tr>
                        <tr>
                            <th width="15%" style="text-align: left;">Contact Person</th>
                            <td>: <?php echo $data[0]->contact_person; ?></td>
                        </tr>
                        <tr>
                            <th width="15%" style="text-align: left;">Description</th>
                            <td>: <?php echo $data[0]->description; ?></td>
                        </tr>
                        <tr>
                            <th width="15%" style="text-align: left;">Day</th>
                            <td>: <?php if (isset($package_day['features'][0]['properties']['day'])) {
                                        echo $package_day['features'][0]['properties']['day'];
                                    } ?></td>
                        </tr>
                        <tr>
                            <th width="15%" style="text-align: left;">Brosur Url</th>
                            <td>: <?php echo $data[0]->brosur_url; ?></td>
                        </tr>
                        <tr>
                            <th width="15%" style="text-align: left;">Price</th>
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
                                <td></td>
                            </tr>
                            <tr>
                                <th width="15%" style="text-align: left;">Activity</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <?php
                                    $j = 0;

                                    while ($j < $count_detail) {

                                        if ($package_day['features'][$i]['properties']['day'] == $detail_package['features'][$j]['properties']['day']) {
                                            echo  $detail_package['features'][$j]['properties']['description'] ?><br />



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
                                <th width="15%" style="text-align: left;">Service</th>
                                <td>: </td>
                            </tr>

                            <tr>
                                <th width="15%"></th>
                                <td><?php
                                    $j = 0;

                                    while ($j < $count_detail_service) {


                                        echo $j + 1, ". ", $detail_service_package['features'][$j]['properties']['name'] ?><br />

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
                    <a class="btn btn-sm btn-danger" href="<?= \base_url('booking') ?>">back</a>
                </div>
                <!-- <div>
                    <a href="#" onclick="print()" target="_blank" class="btn btn-success"><i class="fa fa-file-pdf-o"></i>&nbsp; Print</a>
                </div> -->


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
    $description = $finalArray['bulk'][$i]['properties']['description'];

?>
    <?php echo "<script> dirrectionManual_User( " . $x . ", " . $y . ",'" . $description . "'); </script>" ?>

<?php


    $i++;
}

?>


<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $('#direction-row').hide();
    $('#panel').hide();
    $('#legend').hide();
    $('#check-nearby-col').hide();
    $('#result-nearby-col').hide();
</script>
<script>
    const myTimeout = setTimeout(routeWayPoints_User, 2000);
</script>
<?= $this->endSection() ?>