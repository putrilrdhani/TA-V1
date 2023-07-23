<?= $this->extend('web/layouts/main_admin'); ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="row">
        <!--map-->
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">

                        <!-- Isi Disini -->


                        <div class="row content">
                            <h1><?= $content; ?> Event</h1>
                        </div>
                        <?php
                        // echo $data['status']


                        if ($status == "Not Visible") {

                            echo $this->include('web/layouts/noJsLoad');
                        } else {
                            // Load file jsLoad disini
                            echo $this->include('web/layouts/jsLoad');
                        }


                        ?>

                        <form action="<?= base_url($action) ?>" method="post" enctype="multipart/form-data">

                            <?php

                            if (isset($data[0]->id_true)) {
                            ?>
                                <div class="form-group">
                                    <label for="varchar">Name</label>
                                    <input type="text" class="form-control" autocomplete="off" name="name" id="name" placeholder="Name" value="<?php echo $data[0]->name; ?>" required />
                                </div>


                                <div class="form-group">

                                    <label for="varchar">Category</label>
                                    <select class="form-control" name="category" id="category">

                                        <?php

                                        $count = count($category);
                                        $i = 0;
                                        while ($i < $count) {

                                            echo "<option value='" . $category[$i]['id_category'] . "'>" . $category[$i]['name'] . "</option>";
                                            $i++;
                                        }
                                        ?>

                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="date">Date Start</label>
                                    <input type="date" class="form-control" autocomplete="off" name="date_start" id="date_start" placeholder="Date Start" value="<?php echo $data[0]->date_start; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="date">Date End</label>
                                    <input type="date" class="form-control" autocomplete="off" name="date_end" id="date_end" placeholder="Date End" value="<?php echo $data[0]->date_end; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="3" name="description" id="description" placeholder="Description"><?php echo $data[0]->description; ?></textarea>"
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" autocomplete="off" name="geom" id="geom" placeholder="Geom" value="" style="display: none;" required />
                                </div>
                                <div class="form-group">
                                    <label for="int">Ticket Price</label>
                                    <input type="text" class="form-control" autocomplete="off" name="ticket_price" id="ticket_price" placeholder="Ticket Price" value="<?php echo $data[0]->ticket_price; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Contact Person</label>
                                    <input type="text" class="form-control" autocomplete="off" name="contact_person" id="contact_person" placeholder="Contact Person" value="<?php echo $data[0]->contact_person; ?>" />
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

                                                <!-- Mulai dari sini -->
                                                <?php

                                                if ($data[$image_i]->id_gallery == NULL) {
                                                } else {
                                                ?>
                                                    <div class="showSlide">
                                                        <img class="img img-fluid" src="<?php echo base_url("upload/" . $data[$image_i]->url); ?>" />
                                                        <div class="contentx"><?php echo $data[$image_i]->name; ?></div>
                                                        <a style="float:right" onclick="deleteImageEvent('<?php echo $data[$image_i]->id_gallery; ?>')"><i style="color:red" class="fa fa-trash" aria-hidden="true"></i> </a>
                                                    </div>
                                                <?php
                                                }
                                                ?>

                                                <?php

                                                if ($data[$image_i]->id_video == NULL) {
                                                } else {
                                                ?>
                                                    <div class="showSlide">

                                                        <video width="100%" height="100%" controls>
                                                            <source src="<?php echo base_url("upload/" . $data[$image_i]->url_video); ?>" type="video/mp4">

                                                            Your browser does not support the video tag.
                                                        </video>
                                                        <div class="contentx"><?php echo $data[$image_i]->name; ?></div>
                                                        <a style="float:right" onclick="deleteVideoEvent('<?php echo $data[$image_i]->id_video; ?>')"><i style="color:red" class="fa fa-trash" aria-hidden="true"></i> </a>
                                                    </div>
                                                <?php
                                                }
                                                ?>

                                                <!-- Akhir disini -->

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
                                <input id="id" class="form-control" type="text" name="id" style="display:none;" value="<?= $data[0]->id_true ?>">
                            <?php
                            } else {
                            ?>
                                <div class="form-group">
                                    <label for="varchar">Name</label>
                                    <input type="text" class="form-control" autocomplete="off" name="name" id="name" placeholder="Name" value="" required />
                                </div>

                                <div class="form-group">

                                    <label for="varchar">Category</label>
                                    <select class="form-control" name="category" id="category">

                                        <?php

                                        $count = count($category);
                                        $i = 0;
                                        while ($i < $count) {

                                            echo "<option value='" . $category[$i]['id_category'] . "'>" . $category[$i]['name'] . "</option>";
                                            $i++;
                                        }
                                        ?>

                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="date">Date Start</label>
                                    <input type="date" class="form-control" autocomplete="off" name="date_start" id="date_start" placeholder="Date Start" value="" />
                                </div>
                                <div class="form-group">
                                    <label for="date">Date End</label>
                                    <input type="date" class="form-control" autocomplete="off" name="date_end" id="date_end" placeholder="Date End" value="" />
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="3" name="description" id="description" placeholder="Description"></textarea>"
                                </div>
                                <div class="form-group">
                                    <label for="int">Ticket Price</label>
                                    <input type="text" class="form-control" autocomplete="off" name="ticket_price" id="ticket_price" placeholder="Ticket Price" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" autocomplete="off" name="geom" id="geom" placeholder="Geom" value="" style="display: none;" required />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Contact Person</label>
                                    <input type="text" class="form-control" autocomplete="off" name="contact_person" id="contact_person" placeholder="Contact Person" value="" />
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
                                    <a class="btn btn-sm btn-danger" href="<?= base_url('event') ?>">Cancel</a>
                                    <button class="btn btn-sm btn-primary" type="submit">SAVE</button>
                                </div>
                            </div>
                        </form>



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
    $('#direction-row').hide();
    $('#legend').hide();
    $('#check-nearby-col').hide();
    $('#result-nearby-col').hide();
</script>
<?= $this->endSection() ?>