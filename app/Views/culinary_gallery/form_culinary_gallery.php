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
                        <h4 style="margin-top:0px">Culinary_gallery <?php echo $content; ?></h4>
                        <form action="<?= base_url($action) ?>" method="post">
                            <div class="form-group">
                                <label for="varchar">Url</label>
                                <input type="text" class="form-control" autocomplete="off" name="url" id="url" placeholder="Url" value="<?php echo $data['url']; ?>" />
                            </div>
                            <input id="id" class="form-control" type="text" name="id" style="display:none;" value="<?= $data['id'] ?>">

                            <div class="d-flex p-2 bd-highlight">
                                <div class="form-group">
                                    <a class="btn btn-sm btn-danger" href="<?= base_url('culinary_gallery') ?>">Cancel</a>
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