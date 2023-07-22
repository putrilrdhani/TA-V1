<?= $this->extend('web/layouts/main_admin'); ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="row">
        <!--map-->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <!-- Javascript untuk  memuat peta -->
                        <?= $this->include('web/layouts/jsLoad'); ?>


                        <!-- Isi Disini -->

                        <div class="row content">
                            <h3><small> Detail Service Package</small></h3>
                        </div>

                        <table class="table table-light table-striped">
                            <tbody>
                                <tr>
                                    <th width="15%">Id Package</th>
                                    <td>: <?php echo $data[0]->id_package; ?></td>
                                </tr>
                                <tr>
                                    <th width="15%">Status</th>
                                    <td>: <?php echo $data[0]->status; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex p-2 bd-highlight">
                            <a class="btn btn-sm btn-danger" href="<?= \base_url('package') ?>">back</a>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>

</section>



<script>
    $("#color-palette").prop("hidden", true);
    $("#delete-button").prop("hidden", true);
    $("#delete-map").prop("hidden", true);
</script>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $('#direction-row').hide();
    $('#check-nearby-col').hide();
    $('#result-nearby-col').hide();
</script>
<?= $this->endSection() ?>