<?= $this->extend('web/layouts/main_admin'); ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="row">
        <!--map-->
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">



                        <!-- Tambahkan ini -->





                        <!-- Javascript untuk  memuat peta -->

                        <!-- Ganti Semua Script Dengan Ini -->



                        <!-- Isi Disini -->
                        <div class="row content">
                            <h1><?= $content; ?></h1>
                        </div>
                        <form action="<?= base_url($action) ?>" method="post">
                            <div class="form-group">
                                <label for="varchar">Name</label>
                                <input type="text" class="form-control" autocomplete="off" name="name" id="name" placeholder="Name" value="<?php echo $data['name']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="varchar">District</label>
                                <input type="text" class="form-control" autocomplete="off" name="district" id="district" placeholder="District" value="<?php echo $data['district']; ?>" />
                            </div>

                            <input id="id" class="form-control" type="hidden" name="id" value="<?= $data['id'] ?>">

                            <div class="d-flex p-2 bd-highlight">
                                <div class="form-group">
                                    <a class="btn btn-sm btn-danger" href="<?= base_url('villages') ?>">Cancel</a>
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

</section>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $('#direction-row').hide();
    $('#check-nearby-col').hide();
    $('#result-nearby-col').hide();
</script>
<?= $this->endSection() ?>