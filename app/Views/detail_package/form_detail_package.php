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
                            <h3><?= $content; ?> Detail Package</h3>
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
                                    <label for="varchar">Activity Type</label>
                                    <input type="text" class="form-control" autocomplete="off" name="activity_type" id="activity_type" placeholder="Activity Type" value="<?php echo $data[0]->activity_type; ?>" />
                                </div>
                                <div class="form-group">

                                    <input style="display: none;" type="text" class="form-control" autocomplete="off" name="activity" id="activity" placeholder="Activity" value="<?php echo $data[0]->activity; ?>" />
                                </div>

                                <div class="form-group">
                                    <label for="varchar">ID Object</label>
                                    <select name="id_object" class="form-control">
                                        <?php

                                        $i = 0;
                                        $count = count($tourism_object['features']);
                                        $count = $count - 1;
                                        while ($i <= $count) {
                                            if ($tourism_object['features'][$i]['properties']['id'] == $data[0]->id_object) {
                                        ?>
                                                <option selected="selected" value="<?php echo $tourism_object['features'][$i]['properties']['id'] ?>"> [Tourism Object] <?php echo $tourism_object['features'][$i]['properties']['name'] ?> </option>
                                            <?php

                                            } else {
                                            ?>
                                                <option value="<?php echo $tourism_object['features'][$i]['properties']['id'] ?>"> [Tourism Object] <?php echo $tourism_object['features'][$i]['properties']['name'] ?> </option>
                                            <?php
                                            }
                                            ?>


                                        <?php
                                            $i++;
                                        }
                                        ?>

                                        <?php

                                        $i = 0;
                                        $count = count($culinary['features']);
                                        $count = $count - 1;
                                        while ($i <= $count) {

                                            if ($culinary['features'][$i]['properties']['id'] == $data[0]->id_object) {
                                        ?>
                                                <option selected="selected" value="<?php echo $culinary['features'][$i]['properties']['id'] ?>"> [Culinary] <?php echo $culinary['features'][$i]['properties']['name'] ?></option>
                                            <?php

                                            } else {
                                            ?>
                                                <option value="<?php echo $culinary['features'][$i]['properties']['id'] ?>"> [Culinary] <?php echo $culinary['features'][$i]['properties']['name'] ?></option>
                                            <?php
                                            }
                                            ?>


                                        <?php
                                            $i++;
                                        }
                                        ?> <?php

                                            $i = 0;
                                            $count = count($event['features']);
                                            $count = $count - 1;
                                            while ($i <= $count) {
                                                if ($event['features'][$i]['properties']['id'] == $data[0]->id_object) {
                                            ?>
                                                <option selected="selected" value="<?php echo $event['features'][$i]['properties']['id'] ?>"> [Event] <?php echo $event['features'][$i]['properties']['name'] ?></option>


                                            <?php

                                                } else {
                                            ?>
                                                <option value="<?php echo $event['features'][$i]['properties']['id'] ?>"> [Event] <?php echo $event['features'][$i]['properties']['name'] ?></option>
                                            <?php
                                                }
                                            ?>


                                        <?php
                                                $i++;
                                            }
                                        ?> <?php

                                            $i = 0;
                                            $count = count($homestay['features']);
                                            $count = $count - 1;
                                            while ($i <= $count) {
                                                if ($homestay['features'][$i]['properties']['id'] == $data[0]->id_object) {
                                            ?>

                                                <option selected="selected" value="<?php echo $homestay['features'][$i]['properties']['id'] ?>"> [Homestay] <?php echo $homestay['features'][$i]['properties']['name'] ?></option>
                                            <?php

                                                } else {
                                            ?>

                                                <option value="<?php echo $homestay['features'][$i]['properties']['id'] ?>"> [Homestay] <?php echo $homestay['features'][$i]['properties']['name'] ?></option>

                                            <?php
                                                }
                                            ?>

                                        <?php
                                                $i++;
                                            }
                                        ?> <?php

                                            $i = 0;
                                            $count = count($souvenir['features']);
                                            $count = $count - 1;
                                            while ($i <= $count) {
                                                if ($souvenir['features'][$i]['properties']['id'] == $data[0]->id_object) {
                                            ?>

                                                <option selected="selected" value="<?php echo $souvenir['features'][$i]['properties']['id'] ?>"> [Souvenir] <?php echo $souvenir['features'][$i]['properties']['name'] ?></option>
                                            <?php

                                                } else {
                                            ?>
                                                <option value="<?php echo $souvenir['features'][$i]['properties']['id'] ?>"> [Souvenir] <?php echo $souvenir['features'][$i]['properties']['name'] ?></option>
                                            <?php

                                                }
                                            ?>


                                        <?php
                                                $i++;
                                            }
                                        ?> <?php

                                            $i = 0;
                                            $count = count($worship['features']);
                                            $count = $count - 1;
                                            while ($i <= $count) {
                                                if ($worship['features'][$i]['properties']['id'] == $data[0]->id_object) {
                                            ?>
                                                <option selected="selected" value="<?php echo $worship['features'][$i]['properties']['id'] ?>"> [Worship] <?php echo $worship['features'][$i]['properties']['name'] ?></option>

                                            <?php

                                                } else {
                                            ?>
                                                <option value="<?php echo $worship['features'][$i]['properties']['id'] ?>"> [Worship] <?php echo $worship['features'][$i]['properties']['name'] ?></option>


                                            <?php
                                                }
                                            ?>

                                        <?php
                                                $i++;
                                            }
                                        ?>
                                    </select>

                                </div>
                                <div class="form-group">

                                    <input style="display: none;" type="text" class="form-control" autocomplete="off" name="id_package" id="id_object" placeholder="Id Object" value="<?php echo $data[0]->id_package; ?>" />
                                </div>
                                <div class="form-group">

                                    <input style="display: none;" type="text" class="form-control" autocomplete="off" name="day" id="id_object" placeholder="Id Object" value="<?php echo $data[0]->day; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="3" name="description" id="description" placeholder="Description"><?php echo $data[0]->description; ?></textarea>
                                </div>
                                <input id="id_package" class="form-control" type="text" name="id_package" style="display:none;" value="<?= $data[0]->id_package ?>">



                            <?php
                            } else {
                            ?>

                                <div class="form-group">
                                    <label for="varchar">Select Package</label>
                                    <select name="id-double" class=" form-control">
                                        <?php

                                        $i = 0;
                                        $count = count($package_day['features']);
                                        $count = $count - 1;
                                        while ($i <= $count) {
                                        ?>
                                            <option value="<?php echo $package_day['features'][$i]['properties']['id_package'] ?>-<?php echo $package_day['features'][$i]['properties']['day'] ?>">Paket : <?php echo $package_day['features'][$i]['properties']['id_package'] ?> [Hari <?php echo $package_day['features'][$i]['properties']['day'] ?>]</option>

                                        <?php
                                            $i++;
                                        }
                                        ?>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="varchar">Activity</label>
                                    <input type="text" class="form-control" autocomplete="off" name="activity" id="activity" placeholder="Activity" value="" />
                                </div>

                                <div class="form-group">
                                    <label for="varchar">Activity Type</label>
                                    <input type="text" class="form-control" autocomplete="off" name="activity_type" id="activity_type" placeholder="Activity Type" value="" />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">ID Object</label>
                                    <select name="id_object" class="form-control">
                                        <?php

                                        $i = 0;
                                        $count = count($tourism_object['features']);
                                        $count = $count - 1;
                                        while ($i <= $count) {
                                        ?>
                                            <option value="<?php echo $tourism_object['features'][$i]['properties']['id'] ?>"> [Tourism Object] <?php echo $tourism_object['features'][$i]['properties']['name'] ?> </option>

                                        <?php
                                            $i++;
                                        }
                                        ?>

                                        <?php

                                        $i = 0;
                                        $count = count($culinary['features']);
                                        $count = $count - 1;
                                        while ($i <= $count) {
                                        ?>
                                            <option value="<?php echo $culinary['features'][$i]['properties']['id'] ?>"> [Culinary] <?php echo $culinary['features'][$i]['properties']['name'] ?></option>

                                        <?php
                                            $i++;
                                        }
                                        ?> <?php

                                            $i = 0;
                                            $count = count($event['features']);
                                            $count = $count - 1;
                                            while ($i <= $count) {
                                            ?>
                                            <option value="<?php echo $event['features'][$i]['properties']['id'] ?>"> [Event] <?php echo $event['features'][$i]['properties']['name'] ?></option>

                                        <?php
                                                $i++;
                                            }
                                        ?> <?php

                                            $i = 0;
                                            $count = count($homestay['features']);
                                            $count = $count - 1;
                                            while ($i <= $count) {
                                            ?>
                                            <option value="<?php echo $homestay['features'][$i]['properties']['id'] ?>"> [Homestay] <?php echo $homestay['features'][$i]['properties']['name'] ?></option>

                                        <?php
                                                $i++;
                                            }
                                        ?> <?php

                                            $i = 0;
                                            $count = count($souvenir['features']);
                                            $count = $count - 1;
                                            while ($i <= $count) {
                                            ?>
                                            <option value="<?php echo $souvenir['features'][$i]['properties']['id'] ?>"> [Souvenir] <?php echo $souvenir['features'][$i]['properties']['name'] ?></option>

                                        <?php
                                                $i++;
                                            }
                                        ?> <?php

                                            $i = 0;
                                            $count = count($worship['features']);
                                            $count = $count - 1;
                                            while ($i <= $count) {
                                            ?>
                                            <option value="<?php echo $worship['features'][$i]['properties']['id'] ?>"> [Worship] <?php echo $worship['features'][$i]['properties']['name'] ?></option>

                                        <?php
                                                $i++;
                                            }
                                        ?>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="3" name="description" id="description" placeholder="Description"></textarea>
                                </div>
                                <input id="id_package" class="form-control" type="text" name="id_package" style="display:none;" value="">

                            <?php
                            }
                            ?>
                            <div class="d-flex p-2 bd-highlight">
                                <div class="form-group">
                                    <a class="btn btn-sm btn-danger" href="<?= base_url('package') ?>">Cancel</a>
                                    <button class="btn btn-sm btn-primary" type="submit">SAVE</button>
                                </div>
                            </div>
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