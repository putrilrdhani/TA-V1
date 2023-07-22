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
                        <section class="section">
                            <div class="row">
                                <!--map-->
                                <div class="col-md-12 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row align-items-center">

                                                <div class="col-md-auto">
                                                    <h5 class="card-title">Users</h5>
                                                    <div class="row">
                                                        <h1><?= $content; ?></h1>
                                                    </div>
                                                    <div class="row">
                                                        <div class="d-flex p-2 bd-highlight">
                                                            <a href="<?= base_url('tourism_video/create') ?>" class="btn btn-sm btn-primary">CREATE</a>
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
                                                                    <th>Url</th>
                                                                    <th>Duration</th>
                                                                    <th>View</th>
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
                                                                    <td><?= $value['url'] ?></td>
                                                                    <td><?= $value['duration'] ?></td>
                                                                    <td><?= $value['view'] ?></td>
                                                                    <td>
                                                                        <span class="float-right">
                                                                            <a type="button" class="btn btn-sm btn-primary" href="<?= base_url('tourism_video/read/' . $value['id']) ?>">READ</a>
                                                                            <a type="button" class="btn btn-sm btn-warning" href="<?= base_url('tourism_video/update/' . $value['id']) ?>">EDIT</a>
                                                                            <a type="button" class="btn btn-sm btn-danger" href="<?= base_url('tourism_video/delete/' . $value['id']) ?>" onclick="javascript: return confirm('Delete \nAre You Sure ?')">DELETE</a>
                                                                        </span>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                                </tbody>
                                                        </table>
                                                        <!-- pagination -->
                                                        <?php echo $pager->links('paging', 'ligatcode_pagination') ?>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                </div>



                            </div>
                            <!-- Direction section -->
                            <?= $this->include('web/layouts/direction'); ?>
                        </section>


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