<?= $this->extend('web/layouts/main_admin'); ?>
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
                                                <td width="80px" style="word-break: break-all;"><?php
                                                                                                echo ++$start ?></td>
                                                <td style="word-break: break-all;"><?= $data[$i]->purchase_date ?></td>
                                                <td style="word-break: break-all;"><?= $data[$i]->purchase_time ?></td>
                                                <td style="word-break: break-all;"><?= $data[$i]->booking_date ?></td>
                                                <td style="word-break: break-all;"><?= $data[$i]->total_member ?></td>
                                                <td style="word-break: break-all;">
                                                    <?php
                                                    if ($data[$i]->status == "1") {
                                                        echo "Confirmed";
                                                    } else if ($data[$i]->status == "2") {
                                                        echo "Unavailable";
                                                    } else {
                                                        echo "Pending";
                                                    } ?></td>
                                                <td style="word-break: break-all;"><?= $data[$i]->comment ?></td>
                                                <td style="width: 80px; word-break:break-all">
                                                    <span class="float-right">
                                                        <a class="btn btn-primary" href="<?= base_url('booking/read/' . $data[$i]->id_user . '/' . $data[$i]->booking_date . '/' . $data[$i]->id_package) ?>"><i class="fa-solid fa-eye"></i></a>
                                                        <!-- <a href="<?= base_url('booking/update/' . $data[$i]->id_user . $data[$i]->booking_date . $data[$i]->id_package) ?>"><i style="color:chocolate" class="fas fa-edit"></i></a> -->
                                                        <!-- <a class="deleteStyle" href="<?= base_url('booking/delete/' . $data[$i]->id_user . '/' . $data[$i]->booking_date . '/' . $data[$i]->id_package) ?>"><i style="color:red" class="fa fa-trash" aria-hidden="true"></i></a> -->
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