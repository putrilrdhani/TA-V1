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
                            <h3><?= $content; ?> Service Package</h3>
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

                            if (isset($data['id_service_package'])) {
                            ?>


                                <div class="form-group">
                                    <label for="varchar" style="display: none;">ID Service Package</label>
                                    <input id="id_service_package" class="form-control" type="hidden" name="id_service_package" value="<?= $data['id_service_package'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for=" varchar">Name</label>
                                    <input type="text" class="form-control" autocomplete="off" name="name" id="name" placeholder="Name" value="<?php echo $data['name']; ?>" />
                                </div>

                            <?php
                            } else {
                            ?>

                                <div class="form-group">
                                    <label for="varchar">Name</label>
                                    <input type="text" class="form-control" autocomplete="off" name="name" id="name" placeholder="Name" value="" />
                                </div>
                                <input id="id_service_package" class="form-control" type="text" name="id_service_package" style="display:none;" value="">

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
    $('#legend').hide();
</script>
<?= $this->endSection() ?>