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
                        <table class="table table-light table-striped">
                            <tbody>
                                <tr>
                                    <th width="15%">Name</th>
                                    <td>: <?php echo $data['name']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex p-2 bd-highlight">
                            <a class="btn btn-sm btn-danger" href="<?= \base_url('worship_category') ?>">back</a>
                        </div>


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