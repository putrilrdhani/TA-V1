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
                            <h3><small><?= $content; ?> Tourism Facility</small></h3>
                        </div>

                        <form action="<?= base_url($action) ?>" method="post">
                            <?php
                            if (isset($data['id_facility']) && $data['id_facility'] != "") {
                            ?>
                                <div class="form-group">
                                    <label for="varchar">Name</label>
                                    <input type="text" class="form-control" autocomplete="off" name="name" id="name" placeholder="Name" value="<?php echo $data['name']; ?>" required />
                                </div>
                                <input id="id_facility" class="form-control" type="text" name="id_facility" style="display:none;" value="<?= $data['id_facility'] ?>">

                                <div class="d-flex p-2 bd-highlight">
                                    <div class="form-group">
                                        <a class="btn btn-sm btn-danger" href="<?= base_url('tourism_facility') ?>">Cancel</a>
                                        <button class="btn btn-sm btn-primary" type="submit">SAVE</button>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="form-group">
                                    <label for="varchar">Name</label>
                                    <input type="text" class="form-control" autocomplete="off" name="name" id="name" placeholder="Name" value="" />
                                </div>

                                <input id="id_facility" class="form-control" type="hidden" name="id_facility" value="">

                                <div class=" d-flex p-2 bd-highlight">
                                    <div class="form-group">
                                        <a class="btn btn-sm btn-danger" href="<?= base_url('tourism_facility') ?>">Cancel</a>
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