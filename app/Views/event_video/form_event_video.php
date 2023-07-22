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
                            <h1><?= $content; ?></h1>
                        </div>
                        <h4 style="margin-top:0px">Event_video <?php echo $content; ?></h4>
                        <form action="<?= base_url($action) ?>" method="post">
                            <div class="form-group">
                                <label for="varchar">Url
                                    <?php echo ('url') ?></label>
                                <input type="text" class="form-control" autocomplete="off" name="url" id="url" placeholder="Url" value="<?php echo $data['url']; ?>" />
                            </div>
                            <!-- <div class="form-group">
                                <label for="time">Duration
                                    <?php echo ('duration') ?></label>
                                <input type="text" class="form-control" autocomplete="off" name="duration" id="duration" placeholder="Duration" value="<?php echo $data['duration']; ?>" />
                            </div> -->
                            <!-- <div class="form-group">
                                <label for="int">View
                                    <?php echo ('view') ?></label>
                                <input type="text" class="form-control" autocomplete="off" name="view" id="view" placeholder="View" value="<?php echo $data['view']; ?>" />
                            </div> -->
                            <input id="id" class="form-control" type="text" name="id" style="display:none;" value="<?= $data['id'] ?>">

                            <div class="d-flex p-2 bd-highlight">
                                <div class="form-group">
                                    <a class="btn btn-sm btn-danger" href="<?= base_url('event_video') ?>">Cancel</a>
                                    <button class="btn btn-sm btn-primary" type="submit">SAVE</button>
                                </div>
                            </div>
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