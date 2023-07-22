<?= $this->extend('web/layouts/main_admin'); ?>

<?= $this->section('content') ?>


<!-- Isi Disini -->
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
                                <a href="<?= base_url('homestay_facility/create') ?>" class="btn btn-sm btn-primary">CREATE</a>
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
                                </thead><?php foreach ($data as $value) : ?>
                                    <tr>
                                        <td width="80px"><?php $start = 0;
                                                            echo ++$start ?></td>
                                        <td><?= $value['name'] ?></td>
                                        <td>
                                            <span class="float-right">
                                                <a href="<?= base_url('homestay_facility/read/' . $value['id_facility']) ?>"><i class="fa-solid fa-bars"></i></a>
                                                <a href="<?= base_url('homestay_facility/update/' . $value['id_facility']) ?>"><i style="color:chocolate" class="fas fa-edit"></i></a>
                                                <a href="<?= base_url('homestay_facility/delete/' . $value['id_facility']) ?>" onclick="javascript: return confirm('Delete \nAre You Sure ?')"><i style="color:red" class="fa fa-trash" aria-hidden="true"></i></a>
                                            </span>
                                        </td>
                                    <?php endforeach; ?>
                                    </tbody>
                            </table>
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