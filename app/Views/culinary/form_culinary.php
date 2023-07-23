<?= $this->extend('web/layouts/main_admin'); ?>

<?= $this->section('content') ?>

<!-- Isi Disini -->
<section class="section">
    <div class="row">
        <!--map-->
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <?php
                        // echo $data['status']


                        if ($status == "Not Visible") {

                            echo $this->include('web/layouts/noJsLoad');
                        } else {
                            // Load file jsLoad disini
                            echo $this->include('web/layouts/jsLoad');
                        }


                        ?>
                        <script>
                            $("#legend").hide();
                        </script>

                        <div class="row content">
                            <h1><?= $content; ?></h1>

                        </div>
                        <form action="<?= base_url($action) ?>" method="post" enctype="multipart/form-data">
                            <?php

                            if (isset($data[0]->id_true)) {
                            ?>
                                <!-- Ini Untuk Edit -->
                                <div class="form-group">
                                    <label for="varchar">Name</label>
                                    <input type="text" class="form-control" autocomplete="off" name="name" id="name" placeholder="Name" value="<?php echo $data[0]->name; ?>" required />
                                </div>
                                <div class="form-group">
                                    <label for="int">Capacity</label>
                                    <input type="number" class="form-control" autocomplete="off" name="capacity" id="capacity" placeholder="Capacity" value="<?php echo $data[0]->capacity; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="time">Open</label>
                                    <input type="time" class="form-control" autocomplete="off" name="open" id="open" placeholder="Open" value="<?php echo $data[0]->open; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="time">Close</label>
                                    <input type="time" class="form-control" autocomplete="off" name="close" id="close" placeholder="Close" value="<?php echo $data[0]->close; ?>" />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control hide" autocomplete="off" name="geom" id="geom" placeholder="Geom" value="" style="display: none;" required />
                                </div>

                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-8">



                                        <div class="slidercontainer">

                                            <?php
                                            $countImage = count($data);
                                            $image_i = 0;
                                            while ($image_i < $countImage) {
                                            ?>
                                                <div class="showSlide">
                                                    <img class="img img-fluid" src="<?php echo base_url("upload/" . $data[$image_i]->url); ?>" />
                                                    <div><br /></div>
                                                    <!-- tambah ini di form yg memiliki image -->
                                                    <a style="float:right" onclick="deleteImageCulinary('<?php echo $data[$image_i]->id_gallery; ?>')"><i style="color:red" class="fa fa-trash" aria-hidden="true"></i> </a>


                                                </div>

                                            <?php
                                                $image_i++;
                                            }
                                            ?>

                                            <!-- Navigation arrows -->
                                            <a class="left" onclick="nextSlide(-1)"><i class="fa-solid fa-backward"></i>| </a>

                                            <a class="right" onclick="nextSlide(1)"> |<i class="fa-solid fa-forward"></i></a>

                                        </div>

                                        <script type="text/javascript">
                                            var slide_index = 1;
                                            displaySlides(slide_index);

                                            function nextSlide(n) {
                                                displaySlides(slide_index += n);
                                            }

                                            function currentSlide(n) {
                                                displaySlides(slide_index = n);
                                            }

                                            function displaySlides(n) {
                                                var i;
                                                var slides = document.getElementsByClassName("showSlide");
                                                if (n > slides.length) {
                                                    slide_index = 1
                                                }
                                                if (n < 1) {
                                                    slide_index = slides.length
                                                }
                                                for (i = 0; i < slides.length; i++) {
                                                    slides[i].style.display = "none";
                                                }
                                                slides[slide_index - 1].style.display = "block";
                                            }
                                        </script>
                                    </div>
                                    <div class="col-sm-2"></div>
                                </div>

                                <div class="form-group">
                                    <label for="varchar">Image</label>
                                    <input type="file" class="form-control" autocomplete="off" name="url" id="url" placeholder="Url" value="<?php echo $data[0]->url; ?>" />
                                </div>


                                <input id="id" class="form-control" type="hidden" name="id" style="display:none;" value="<?= $data[0]->id_true ?>">





                            <?php
                            } else {
                            ?>
                                <!-- Ini untuk create -->

                                <div class="form-group">
                                    <label for="varchar">Name</label>
                                    <input type="text" class="form-control" autocomplete="off" name="name" id="name" placeholder="Name" value="" required />
                                </div>
                                <div class="form-group">
                                    <label for="int">Capacity</label>
                                    <input type="number" class="form-control" autocomplete="off" name="capacity" id="capacity" placeholder="Capacity" value="" />
                                </div>
                                <div class="form-group">
                                    <label for="time">Open</label>
                                    <input type="time" class="form-control" autocomplete="off" name="open" id="open" placeholder="Open" value="" />
                                </div>
                                <div class="form-group">
                                    <label for="time">Close</label>
                                    <input type="time" class="form-control" autocomplete="off" name="close" id="close" placeholder="Close" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" autocomplete="off" name="geom" id="geom" placeholder="Geom" value="" style="display: none;" required />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Image</label>
                                    <input type="file" class="form-control" autocomplete="off" name="url" id="url" placeholder="Url" value="" />
                                </div>
                                <input id="id" class="form-control" type="hidden" name="id" value="">



                            <?php

                            }

                            ?>
                            <div class="d-flex p-2 bd-highlight">
                                <div class="form-group">
                                    <a class="btn btn-sm btn-danger" href="<?= base_url('culinary') ?>">Cancel</a>
                                    <button class="btn btn-sm btn-primary" type="submit">SAVE</button>
                                </div>
                            </div>
                        </form>

                        <!-- Data tambah fasilitas disini -->
                        <!-- <?php
                                if (isset($dataFacility)) {
                                ?>
                            <div class="row">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Add Facility
                                </button>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>

                                            <th>Facility</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            $i = 0;
                                            $count = count($dataFacility);
                                            $count = $count - 1;
                                            $start = 0;
                                            while ($count >= $i) {
                                            ?>
                                                <td width="80px"><?php
                                                                    echo ++$start ?></td>

                                                <td><?= $dataFacility[$i]['name']; ?></td>
                                                <td style="width: 80px;">
                                                    <span class="float-right">

                                                        <a onclick="deleteCulinaryFacility('<?= $dataFacility[$i]['id']; ?>','<?= $dataFacility[$i]['id_facility']; ?>')"><i style="color:red" class="fa fa-trash" aria-hidden="true"></i></a>
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

                        <?php
                                } else {
                                }

                        ?>


                    </div> -->
                    </div>

                </div>
            </div>



        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">

                        <?= $this->include('web/layouts/map-body'); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $("#legend").hide();

    $('#direction-row').hide();
    $('#check-nearby-col').hide();
    $('#result-nearby-col').hide();
</script>
<?= $this->endSection() ?>