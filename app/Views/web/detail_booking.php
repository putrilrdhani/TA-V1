<?= $this->extend('web/layouts/main_user'); ?>
<?= $this->section('content'); ?>


<!-- Isi Disini -->
<section class="section">
    <div class="row">
        <!--map-->
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">

                        <div class="col-md-auto">
                            <div class="row">
                                <h3><small><?= $content; ?> </small></h3>
                            </div>
                            <div class="row" style="overflow-x: scroll;">
                                <table id="showDataTable" class="table table-hover" style="table-layout: fixed;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Purchase Date</th>
                                            <th>Purchase Time</th>
                                            <th>Date</th>
                                            <th>Total Member</th>
                                            <th>Status</th>
                                            <th>Comment</th>
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
                                                <td><?= $data[$i]->purchase_date ?></td>
                                                <td><?= $data[$i]->purchase_time ?></td>
                                                <td><?= $data[$i]->date ?></td>
                                                <td><?= $data[$i]->total_member ?></td>
                                                <td><?php
                                                    if ($data[$i]->status == "1") {
                                                        echo "Confirmed";
                                                    } else if ($data[$i]->status == "2") {
                                                        echo "Unavailable";
                                                    } else if ($data[$i]->status == "0") {
                                                        echo "Pending";
                                                    } else if ($data[$i]->status == "3") {
                                                        echo "Canceled";
                                                    }
                                                    ?> </td>
                                                <td><?= $data[$i]->comment ?></td>
                                                <td style="width:80px; word-break:break-all">
                                                    <span class="float-right">

                                                        <?php
                                                        if ($data[$i]->status == "0") {
                                                        ?>
                                                            <a class="btn btn-danger" href="#" onclick="cancel_booking('<?php echo $data[$i]->date ?>','<?php echo $data[$i]->id ?>','<?php echo $data[$i]->id_package ?>')"><i class="fa-solid fa-ban"></i></a>
                                                            <a href="#" onclick="detail_booking('<?php echo $data[$i]->id_package ?>')" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                                        <?php } else {
                                                        ?>

                                                            <a href="#" onclick="detail_booking('<?php echo $data[$i]->id_package ?>')" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                                        <?php
                                                        } ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php

                                            $i++;
                                        } ?>
                                    </tbody>
                                </table>

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
    $('#legend').hide();
</script>
<?= $this->endSection() ?>