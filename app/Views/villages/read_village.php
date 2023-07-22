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
                            <!-- <h1><?= $content; ?></h1> -->

                        </div>
                        <table class="table table-light table-striped">
                            <tbody>
                                <tr>
                                    <th width="15%">Name</th>
                                    <td>: <?php echo $data['name']; ?></td>
                                </tr>
                                <tr>
                                    <th width="15%">District</th>
                                    <td>: <?php echo $data['district']; ?></td>
                                </tr>
                                <tr>
                                    <!-- Tambahkan ini -->

                                    <?= $this->include('web/layouts/map-body'); ?>



                                    <!-- Javascript untuk  memuat peta -->
                                    <!-- Ganti Semua Script Dengan Ini -->
                                    <?= $this->include('web/layouts/jsLoad'); ?>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex p-2 bd-highlight">
                            <a class="btn btn-sm btn-danger" href="<?= \base_url('villages') ?>">back</a>
                        </div>

                        <script>
                            $("#delete-button").prop("disabled", true);
                            $("#delete-map").prop("disabled", true);
                        </script>

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