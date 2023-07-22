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
                        </div>
                        <h3 style="margin-top:0px"><small>Edit Culinary Facility</small></h3>
                        <form action="<?= base_url($action) ?>" method="post">
                            <?php
                            if (isset($data)) {

                            ?>
                                <div class="form-group">
                                    <label for="varchar">Name</label>
                                    <input type="text" class="form-control" autocomplete="off" name="name" id="name" placeholder="Name" value="<?php echo $data['name']; ?>" />
                                </div>


                                <input id="id_facility" style="display:none;" class="form-control" type="text" name="id_facility" value="<?= $data['id_facility'] ?>">
                            <?php
                            } else {
                            ?>
                                <div class="form-group">
                                    <label for="varchar">Name</label>
                                    <input type="text" class="form-control" autocomplete="off" name="name" id="name" placeholder="Name" value="" />
                                </div>
                                <label for=" varchar">ID</label>
                                <input id="id_facility" class="form-control" type="text" name="id_facility" value="">
                            <?php
                            }
                            ?>
                            <div class="d-flex p-2 bd-highlight">
                                <div class="form-group">
                                    <a class="btn btn-sm btn-danger" href="<?= base_url('culinary_facility') ?>">Cancel</a>
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