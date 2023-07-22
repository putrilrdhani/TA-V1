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
                                <a href="<?= base_url('tourism_object/create') ?>" class="btn btn-sm btn-primary">CREATE</a>
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
                                        <th>Open</th>
                                        <th>Close</th>
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
                                            <td style="word-break: break-all;"><?= $data[$i]->name ?></td>
                                            <td style="word-break: break-all;"><?= $data[$i]->open ?></td>
                                            <td style="word-break: break-all;"><?= $data[$i]->close ?></td>
                                            <td style="word-break: break-all;"><?= $data[$i]->ticket_price ?></td>
                                            <td style="word-break: break-all;"><?= $data[$i]->contact_person ?></td>
                                            <td style="width:80px; word-break:break-all">
                                                <span class="float-right">
                                                    <a href="<?php echo base_url('tourism_object/read/' . $data[$i]->id_true) ?>"><i class="fa-solid fa-bars"></i></a>
                                                    <a href="<?= base_url('tourism_object/update/' . $data[$i]->id_true) ?>"><i style="color:chocolate" class="fas fa-edit"></i></a>
                                                    <a class="deleteStyle" href="<?= base_url('tourism_object/delete/' . $data[$i]->id_true) ?>"><i style="color:red" class="fa fa-trash" aria-hidden="true"></i></a>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <script>

                    </script>


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