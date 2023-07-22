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
                            <h3><?= $content; ?>Detail Service Package</h3>
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
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Status</label>
                                    <input type="text" class="form-control" autocomplete="off" name="status" id="status" placeholder="Status" value="<?php echo $data[0]->status; ?>" />
                                </div>
                                <input id="id_service_package" class="form-control" type="text" name="id_service_package" style="display:none;" value="<?= $data[0]->id_service_package ?>">


                            <?php
                            } else {
                            ?>

                                <div class="form-group">
                                    <label for="varchar">Id Service Package</label>
                                    <select id="id_service_package" name="id_service_package" class=" form-control">
                                        <?php

                                        $i = 0;
                                        $count = count($service_package['features']);
                                        $count = $count - 1;
                                        while ($i <= $count) {
                                        ?>
                                            <option value="<?php echo $service_package['features'][$i]['properties']['id_service_package'] ?>"><?php echo $service_package['features'][$i]['properties']['name'] ?></option>

                                        <?php
                                            $i++;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Id Package</label>
                                    <select name="id_package" class=" form-control">
                                        <?php

                                        $i = 0;
                                        $count = count($package['features']);
                                        $count = $count - 1;
                                        while ($i <= $count) {
                                        ?>
                                            <option value="<?php echo $package['features'][$i]['properties']['id_package'] ?>"><?php echo $package['features'][$i]['properties']['name'] ?></option>

                                        <?php
                                            $i++;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Status</label>
                                    <input type="text" class="form-control" autocomplete="off" name="status" id="status" placeholder="Status" value="" />
                                </div>


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