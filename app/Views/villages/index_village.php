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
                        <div class="row">
                            <h3><?= $content; ?></h3>
                        </div>
                        <div class="row">
                            <div class="d-flex p-2 bd-highlight">
                                <!-- <a href="<?= base_url('villages/create') ?>" class="btn btn-sm btn-primary">CREATE</a> -->
                            </div>
                        </div>

                        <?php if (session()->getFlashdata('message')) : ?>
                            <div class="alert alert-info" role="alert">
                                <?= session()->getFlashdata('message') ?>
                            </div>
                        <?php endif; ?>

                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>District</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                </thead><?php
                                        $start = 0;
                                        foreach ($data as $value) : ?>
                                    <tr>
                                        <td width="80px"><?php
                                                            echo ++$start ?></td>
                                        <td><?= $value['name'] ?></td>
                                        <td><?= $value['district'] ?></td>

                                        <td>
                                            <span class="float-right">
                                                <a href="<?= base_url('villages/read/' . $value['id']) ?>"><i class="fa-solid fa-bars"></i></a>
                                                <a href="<?= base_url('villages/update/' . $value['id']) ?>"><i style="color:chocolate" class="fas fa-edit"></i></a>
                                                <a href="<?= base_url('villages/delete/' . $value['id']) ?>" onclick="javascript: return confirm('Delete \nAre You Sure ?')"><i style="color:red" class="fa fa-trash" aria-hidden="true"></i></a>
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