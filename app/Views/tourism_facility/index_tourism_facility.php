<?= $this->extend('web/layouts/main_admin'); ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="row">
        <!--map-->
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">

                        <div class="row">
                            <h3><small><?= $content; ?></small></h3>
                        </div>
                        <div class="row">
                            <div class="d-flex p-2 bd-highlight">
                                <a href="<?= base_url('tourism_facility/create') ?>" class="btn btn-sm btn-primary">CREATE</a>
                            </div>
                        </div>

                        <?php if (session()->getFlashdata('message')) : ?>
                            <div class="alert alert-info" role="alert">
                                <?= session()->getFlashdata('message') ?>
                            </div>
                        <?php endif; ?>

                        <div class="row">
                            <table id="showDataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody><?php
                                        $start = 0;
                                        foreach ($data as $value) : ?>
                                        <tr>
                                            <td width="80px"><?php
                                                                echo ++$start ?></td>
                                            <td><?= $value['name'] ?></td>
                                            <td>
                                                <span class="float-right">
                                                    <a href="<?= base_url('tourism_facility/update/' . $value['id_facility']) ?>"><i style="color:goldenrod" class="fas fa-edit"></i></a>
                                                    <a class="deleteStyle" href="<?= base_url('tourism_facility/delete/' . $value['id_facility']) ?>"><i style="color:red" class="fa fa-trash" aria-hidden="true"></i></a>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- pagination -->
                        </div>


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