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
                                <a href="<?= base_url('event/create') ?>" class="btn btn-sm btn-primary">CREATE</a>
                            </div>
                        </div>

                        <?php if (session()->getFlashdata('message')) : ?>
                            <div class="alert alert-info" role="alert">
                                <?= session()->getFlashdata('message') ?>
                            </div>
                        <?php endif; ?>

                        <div class="row" style="overflow-x: scroll;">
                            <table id="showDataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Date Start</th>
                                        <th>Date End</th>
                                        <th>Description</th>
                                        <th>Ticket Price</th>
                                        <th>Contact Person</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $count = count($data);
                                    $count = $count - 1;
                                    $start = 0;
                                    while ($count >= $i) {
                                    ?>
                                        <tr>
                                            <td width="80px"><?php
                                                                echo ++$start ?></td>
                                            <td><?= $data[$i]->name ?></td>
                                            <td><?= $data[$i]->date_start ?></td>
                                            <td><?= $data[$i]->date_end ?></td>
                                            <td><?= $data[$i]->description ?></td>
                                            <td><?= $data[$i]->ticket_price ?></td>
                                            <td><?= $data[$i]->contact_person ?></td>
                                            <td style="width: 80px;">
                                                <span class="float-right">
                                                    <a href="<?= base_url('event/read/' . $data[$i]->id_true) ?>"><i class="fa-solid fa-bars"></i></a>
                                                    <a href="<?= base_url('event/update/' . $data[$i]->id_true) ?>"><i style="color:chocolate" class="fas fa-edit"></i></a>
                                                    <a href="<?= base_url('event/delete/' . $data[$i]->id_true) ?>" onclick="javascript: return confirm('Delete \nAre You Sure ?')"><i style="color:red" class="fa fa-trash" aria-hidden="true"></i></a>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php

                                        $i++;
                                    } ?>
                                </tbody>
                            </table>
                            <!-- pagination -->

                        </div>
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