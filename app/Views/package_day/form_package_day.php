<?= $this->extend('web/layouts/main_admin'); ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="row">
        <!--map-->
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">


                        <!-- Isi Disini -->


                        <div class="row content">
                            <h3><?= $content; ?> Package Day</h3>
                        </div>


                        <?php
                        // echo $data['status']


                        if ($status == "Not Visible") {

                            echo $this->include('web/layouts/noJsLoad');
                        } else {
                            // Load file jsLoad disini
                            echo $this->include('web/layouts/jsLoad');
                        }


                        ?>

                        <form action="<?= base_url($action) ?>" method="post" enctype="multipart/form-data">

                            <?php

                            if (isset($data[0]->id_package)) {
                            ?>
                                <div class="form-group">

                                    <label for="package">Package</label>
                                    <input class="form-control" disabled type="text" name="" id="" value="<?php echo  $data[0]->id_package; ?>">
                                    <select style="display:none;" class="form-control" name="id_package">
                                        <?php
                                        $count_package = count($package['features']);
                                        $i = 0;
                                        while ($i < $count_package) {
                                            if ($package['features'][$i]['properties']['id_package'] == $data[0]->id_package) {
                                        ?>
                                                <option selected="selected" value="<?php echo $package['features'][$i]['properties']['id_package'] ?>"><?php echo $package['features'][$i]['properties']['name'] ?></option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="<?php echo $package['features'][$i]['properties']['id_package'] ?>"><?php echo $package['features'][$i]['properties']['name'] ?></option>
                                        <?php
                                            }
                                            $i++;
                                        }
                                        ?>
                                    </select>
                                    <label for="package-day">Package Day</label>
                                    <input class="form-control" disabled type="text" name="" id="" value="<?php echo  $data[0]->day; ?>">
                                    <select style="display:none;" class="form-control" name="day">
                                        <?php
                                        $i = 0;
                                        while ($i < 5) {
                                            $ii = $i + 1;
                                            if ($ii == $data[0]->day) {
                                        ?>
                                                <option selected="selected" value="<?php echo $i + 1; ?>">Day <?php echo $i + 1; ?></option>
                                            <?php
                                            } else {

                                            ?>
                                                <option value="<?php echo $i + 1; ?>">Day <?php echo $i + 1; ?></option>

                                        <?php
                                            }
                                            $i++;
                                        }
                                        ?>


                                    </select>

                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="3" name="description" id="description" placeholder="Description"><?php echo $data[0]->description; ?></textarea>
                                </div>


                                <div class="d-flex p-2 bd-highlight">
                                    <div class="form-group">
                                        <a class="btn btn-sm btn-danger" href="<?= base_url('package') ?>">Cancel</a>
                                        <button class="btn btn-sm btn-primary" type="submit">SAVE</button>
                                    </div>
                                </div>


                            <?php
                            } else {
                            ?>

                                <div class="form-group">
                                    <label for="package">Package</label>
                                    <select class="form-control" name="id_package">
                                        <?php
                                        $count_package = count($package['features']);
                                        $i = 0;
                                        while ($i < $count_package) {
                                        ?>
                                            <option value="<?php echo $package['features'][$i]['properties']['id_package'] ?>"><?php echo $package['features'][$i]['properties']['name'] ?></option>
                                        <?php
                                            $i++;
                                        }
                                        ?>
                                    </select>
                                    <label for="package-day">Package Day</label>
                                    <select class="form-control" name="day">
                                        <option value="1">Day 1</option>
                                        <option value="2">Day 2</option>
                                        <option value="3">Day 3</option>
                                        <option value="4">Day 4</option>
                                        <option value="5">Day 5</option>
                                    </select>

                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="3" name="description" id="description" placeholder="Description"></textarea>
                                </div>
                                <!-- <input id="id_package" class="form-control" type="text" name="id_package" style="display:none;" value=""> -->

                                <div class="d-flex p-2 bd-highlight">
                                    <div class="form-group">
                                        <a class="btn btn-sm btn-danger" href="<?= base_url('package') ?>">Cancel</a>
                                        <button class="btn btn-sm btn-primary" type="submit">SAVE</button>
                                    </div>
                                </div>



                            <?php
                            }
                            ?>
                        </form>



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
</script>
<?= $this->endSection() ?>