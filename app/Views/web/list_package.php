<?= $this->extend('web/layouts/main_user'); ?>

<?= $this->section('content') ?>



<section class="section">
    <div class="row">
        <!--map-->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">



                        <!-- Tambahkan ini -->
                        <?= $this->include('web/layouts/map-body'); ?>

                        <!-- Javascript untuk  memuat peta -->
                        <?= $this->include('web/layouts/jsPackage'); ?>

                        <!-- Isi Disini -->
                        <div class="row content">

                        </div>

                        <div class="col-sm-2"></div>
                    </div>
                    <div class="d-flex p-2 bd-highlight">

                    </div>

                    <script>
                        // $("#delete-button").prop("disabled", true);
                        // $("#delete-map").prop("disabled", true);
                        $("#delete-button").hide();
                        $("#delete-map").hide();
                    </script>

                </div>
            </div>


        </div>


        <div class="col-md-4">
            <div class="card">
                <div style="margin: 15px; overflow-x:scroll">
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="4">List</th>



                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $count = count($data);
                                $i = 0;
                                while ($i < $count) {
                                ?>

                                    <tr>
                                        <td><?= $data[$i]->name; ?></td>
                                        <td><button onclick="packageRoute('<?= $data[$i]->id_package; ?>')" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="bottom" title="Route"><i class="fa-solid fa-route"></i></button></td>
                                        <td><button onclick="packageView('<?= $data[$i]->id_package; ?>')" style="margin-left:5px;" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="bottom" title="Info"><i class="fa-solid fa-info-circle"></i></button></td>
                                        <td><button onclick="buyPackage('<?= $data[$i]->id_package; ?>')" style="margin-left:5px;" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="bottom" title="Book Package"><i class="fa-solid fa-cart-shopping"></i></button></td>

                                    </tr>
                                <?php


                                    $i++;
                                }


                                ?>


                            </tbody>
                        </table>




                    </div>


                </div>


            </div>


            <div class="card" id="userOrder">
                <!-- Test -->
            </div>

            <div class="card">
                <div style="margin: 15px;">
                    <div style="text-align: center; margin-bottom: 20px;">
                        <br />
                        <h4><b>Custom Order</b></h4>
                    </div>

                    <div>
                        <form id="dynamicForm" action="<?= base_url("web/custom_order") ?>" method="post" enctype="multipart/form-data">

                            <h5>Package</h5>
                            <div class="form-group">
                                <label for="date">Booking Date</label>
                                <input type="date" class="form-control" autocomplete="off" name="date" id="date" placeholder="Date" value="" />
                            </div>
                            <div class="form-group">
                                <label for="total_member">Total Member</label>
                                <input type="number" min="1" class="form-control" autocomplete="off" name="total_member" id="total_member" placeholder="Total member" value="" />
                            </div>
                            <div class="form-group">
                                <label for="comment">Comment</label>
                                <input type="text" class="form-control" autocomplete="off" name="comment" id="comment" placeholder="Comment" value="" />
                            </div>
                            <h5>Package Day</h5>
                            <div onclick="showPackageDay()" class="btn btn-info">Add Day</div>
                            <div id="detail_day">

                            </div>
                            <br />
                            <h5>Service Package</h5>


                            <?php



                            $count = count($service_package['features']);
                            $i = 0;
                            while ($i < $count) {
                            ?>
                                <input name="checkbox_service_package_<?php echo $service_package['features'][$i]['properties']['id_service_package'] ?>" type="checkbox" class="radioServicePackage" value="<?php echo $service_package['features'][$i]['properties']['id_service_package'] ?>">
                                <label for="vehicle1"> <?php echo $service_package['features'][$i]['properties']['name'] ?> </label><br>

                            <?php
                                $i++;
                            }

                            ?>
                            <br />





                            <br />
                            <input type="hidden" id="nameHidden" name="nameHidden"></input>
                            <div onclick="getNameField()" class="btn btn-info">Lock</div>
                            <div class="d-flex p-2 bd-highlight">
                                <div class="form-group">
                                    <a class="btn btn-sm btn-danger" href="<?= base_url('package') ?>">Cancel</a>
                                    <button id="submitName" disabled class="btn btn-sm btn-primary" type="submit">SAVE</button>
                                </div>
                            </div>
                        </form>


                    </div>


                </div>



            </div>
        </div>
</section>
</div>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $('#direction-row').hide();
    $("#panel").hide();
    $("#legend").hide();
    $('#check-nearby-col').hide();
    $('#result-nearby-col').hide();
</script>
<?= $this->endSection() ?>