<?= $this->extend('web/layouts/main_admin'); ?>
<?= $this->section('content'); ?>


<!-- Isi Disini -->
<section class="section">
    <div class="row">
        <!--map-->
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="row">
                            <h3><small><?= $content; ?> ALL</small></h3>
                        </div>
                        <div class="row">
                            <div class="d-flex p-2 bd-highlight">
                                <a href="<?= base_url('package/create_all') ?>" class="btn btn-sm btn-primary">CREATE PACKAGE</a>
                            </div>
                        </div>
                        <div class="row" style="overflow-x: scroll;">
                            <table id="showDataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Min Capaity</th>
                                        <th>Contact Person</th>
                                        <th>Description</th>

                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $count = count($data);
                                    $count = $count - 1;
                                    $start = 0;
                                    while ($count >= $i) {
                                    ?>
                                        <tr>
                                            <td width="80px" style="word-break: break-all;"><?php
                                                                                            echo ++$start ?></td>
                                            <td style="word-break: break-all;"><?= $data[$i]->name ?></td>
                                            <td style="word-break: break-all;"><?= $data[$i]->min_capaity ?></td>
                                            <td style="word-break: break-all;"><?= $data[$i]->contact_person ?></td>
                                            <td style="word-break: break-all;"><?= $data[$i]->description ?></td>

                                            <td style="word-break: break-all;"><?= $data[$i]->price ?></td>
                                            <td style="width: 80px; word-break:break-all">
                                                <span class="float-right">
                                                    <a href="<?= base_url('package/read/' . $data[$i]->id_package) ?>"><i class="fa-solid fa-bars"></i></a>
                                                    <a href="<?= base_url('package/update/' . $data[$i]->id_package) ?>"><i style="color:chocolate" class="fas fa-edit"></i></a>
                                                    <a class="deleteStyle" href="<?= base_url('package/delete/' . $data[$i]->id_package) ?>"><i style="color:red" class="fa fa-trash" aria-hidden="true"></i></a>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php

                                        $i++;
                                    } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="row">
                            <h3><small>Package Day</small></h3>
                        </div>
                        <div class="row">
                            <table class="showDataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <!-- <th>Id Package</th> -->
                                        <th>Day</th>
                                        <th>Description</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $count = count($package_day['features']);
                                    $count = $count - 1;
                                    $start = 0;
                                    while ($count >= $i) {
                                    ?>
                                        <tr>
                                            <td width="80px"><?php
                                                                echo ++$start ?></td>
                                            <!-- <td><?= $package_day['features'][$i]['properties']['id_package'] ?></td> -->
                                            <td><?= $package_day['features'][$i]['properties']['day'] ?></td>
                                            <td><?= $package_day['features'][$i]['properties']['description'] ?></td>



                                            <td style="width: 80px;">
                                                <span class="float-right">
                                                    <!-- <a href="<?= base_url('package_day/read/' . $package_day['features'][$i]['properties']['id_package'] . "/" . $package_day['features'][$i]['properties']['day']) ?>"><i class="fa-solid fa-bars"></i></a> -->
                                                    <a href="<?= base_url('package_day/update/' . $package_day['features'][$i]['properties']['id_package'] . "/" . $package_day['features'][$i]['properties']['day']) ?>"><i style="color:chocolate" class="fas fa-edit"></i></a>
                                                    <a class="deleteStyle" href="<?= base_url('package_day/delete/' . $package_day['features'][$i]['properties']['id_package'] . "/" . $package_day['features'][$i]['properties']['day']) ?>"><i style="color:red" class="fa fa-trash" aria-hidden="true"></i></a>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php

                                        $i++;
                                    } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="row">
                            <h3><small>Service Package</small></h3>
                        </div>
                        <div class="row">
                            <div class="d-flex p-2 bd-highlight">
                                <a href="<?= base_url('service_package/create') ?>" class="btn btn-sm btn-primary"> CREATE SERVICE PACKAGE</a>
                            </div>
                        </div>
                        <div class="row">
                            <table class="showDataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <!-- <th>Id Service Package</th> -->
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $count = count($service_package['features']);
                                    $count = $count - 1;
                                    $start = 0;
                                    while ($count >= $i) {
                                    ?>

                                        <tr>
                                            <td width="80px"><?php
                                                                echo ++$start ?></td>
                                            <!-- <td><?= $service_package['features'][$i]['properties']['id_service_package'] ?></td> -->
                                            <td><?= $service_package['features'][$i]['properties']['name'] ?></td>



                                            <td style="width: 80px;">
                                                <span class="float-right">
                                                    <!-- <a href="<?= base_url('service_package/read/' . $service_package['features'][$i]['properties']['id_service_package']) ?>"><i class="fa-solid fa-bars"></i></a> -->
                                                    <a href="<?= base_url('service_package/update/' . $service_package['features'][$i]['properties']['id_service_package']) ?>"><i style="color:chocolate" class="fas fa-edit"></i></a>
                                                    <a class="deleteStyle" href="<?= base_url('service_package/delete/' . $service_package['features'][$i]['properties']['id_service_package']) ?>"><i style="color:red" class="fa fa-trash" aria-hidden="true"></i></a>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php

                                        $i++;
                                    } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="row">
                            <h3><small>Detail Package</small></h3>
                        </div>
                        <div class="row">
                            <table class="showDataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <!-- <th>Id Package</th> -->
                                        <th>Ativity</th>
                                        <th>Id</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $count = count($detail_package['features']);
                                    $count = $count - 1;
                                    $start = 0;
                                    while ($count >= $i) {
                                    ?>

                                        <tr>
                                            <td width="80px"><?php
                                                                echo ++$start ?></td>
                                            <!-- <td><?= $detail_package['features'][$i]['properties']['id_package'] ?></td> -->
                                            <td><?= $detail_package['features'][$i]['properties']['activity'] ?></td>
                                            <td><?= $detail_package['features'][$i]['properties']['id_object'] ?></td>
                                            <td><?= $detail_package['features'][$i]['properties']['description'] ?></td>



                                            <td style="width: 80px;">
                                                <span class="float-right">
                                                    <!-- <a href="<?= base_url('detail_package/read/' . $detail_package['features'][$i]['properties']['id_package'] . "/" . $detail_package['features'][$i]['properties']['day']) ?>"><i class="fa-solid fa-bars"></i></a> -->
                                                    <a href="<?= base_url('detail_package/update/' . $detail_package['features'][$i]['properties']['id_package'] . "/" . $detail_package['features'][$i]['properties']['day']) ?>"><i style="color:chocolate" class="fas fa-edit"></i></a>
                                                    <!-- <a href="<?= base_url('detail_package/delete/' . $detail_package['features'][$i]['properties']['id_package'] . "/" . $detail_package['features'][$i]['properties']['day']) ?>" ><i style="color:red" class="fa fa-trash" aria-hidden="true"></i></a> -->
                                                </span>
                                            </td>
                                        </tr>
                                    <?php

                                        $i++;
                                    } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>




    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $('#direction-row').hide();
    $('#check-nearby-col').hide();
    $('#result-nearby-col').hide();
    $('#legend').hide();
</script>
<?= $this->endSection() ?>