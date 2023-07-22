<?= $this->extend('web/layouts/main_admin'); ?>

<?= $this->section('content') ?>

<!-- Isi Disini -->
<section class="section">
    <div class="row">
        <!--map-->
        <div class="col-md-12 col-12">
            <div class="card" style="width:100%">
                <div class="card-header">
                    <div class="row align-items-center">

                        <div class="col-md-auto">
                            <div class="row">
                                <h3>Add Facility</h3>
                            </div>

                            <div class="row">
                                <div class="d-flex p-2 bd-highlight">

                                </div>
                            </div>

                            <?php if (session()->getFlashdata('message')) : ?>
                                <div class="alert alert-info" role="alert">
                                    <?= session()->getFlashdata('message') ?>
                                </div>
                            <?php endif; ?>

                            <div class="row">


                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>



    </div>

    <?= $this->endSection() ?>

    <?= $this->section('javascript') ?>
    <script>
        $('#direction-row').hide();
        $('#check-nearby-col').hide();
        $('#result-nearby-col').hide();
    </script>
    <?= $this->endSection() ?>