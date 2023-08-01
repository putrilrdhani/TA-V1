<?= $this->extend('web/layouts/main_admin'); ?>

<?= $this->section('content') ?>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<section class="section">
    <div class="row">
        <!--map-->
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <?php
                        if ($status == "Not Visible") {
                            echo $this->include('web/layouts/noJsLoad');
                        } else {
                            // Load file jsLoad disini
                            echo $this->include('web/layouts/jsLoad');
                        }
                        ?>
                        <div class="row content">
                            <h3><small><?= $content; ?> Worship Place</small></h3>
                        </div>
                        <form action="<?= base_url($action) ?>" method="post" enctype="multipart/form-data">
                            <?php
                            if (isset($data[0]->id_true)) {
                            ?>
                                <div class="form-group">
                                    <input type="text" class="form-control" autocomplete="off" name="geom" id="geom" placeholder="Geom" value="" required />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Name</label>
                                    <input type="text" class="form-control" autocomplete="off" name="name" id="name" placeholder="Name" value="<?php echo $data[0]->name; ?>" required />
                                </div>
                                <div class="form-group">
                                    <label for="int">Address</label>
                                    <input type="text" class="form-control" autocomplete="off" name="address" id="address" placeholder="Address" value="<?php echo $data[0]->address; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="int">Capacity</label>
                                    <input type="number" class="form-control" min="1" autocomplete="off" name="capacity" id="capacity" placeholder="Capacity" value="<?php echo $data[0]->capacity; ?>" />
                                </div>
                                <!-- Uji Slider -->

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
                                                    <div class="contentx"><?php echo $data[$image_i]->name; ?></div>
                                                    <a style="float:right" onclick="deleteImageWorship('<?php echo $data[$image_i]->id_gallery; ?>')"><i style="color:red" class="fa fa-trash" aria-hidden="true"></i> </a>
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
                                <!-- End Uji Slider -->
                                <div class="form-group">
                                    <label for="varchar">Image</label>
                                    <input type="file" class="form-control" autocomplete="off" name="url" id="url" placeholder="Url" value="<?php echo $data[0]->url; ?>" />
                                </div>

                                <input id="id" class="form-control" type="hidden" name="id" style="display:none;" value="<?= $data[0]->id_true ?>">
                            <?php
                            } else {
                            ?>
                                <div class="form-group">
                                    <input type="text" class="form-control" autocomplete="off" name="geom" id="geom" placeholder="Geom" value="" required />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Name</label>
                                    <input type="text" class="form-control" autocomplete="off" name="name" id="name" placeholder="Name" value="" required />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Address</label>
                                    <input type="text" class="form-control" autocomplete="off" name="address" id="address" placeholder="Address" value="" />
                                </div>
                                <div class="form-group">
                                    <label for="int">Capacity</label>
                                    <input type="number" class="form-control" autocomplete="off" name="capacity" id="capacity" placeholder="Capacity" value="" />
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
                                    <a class="btn btn-sm btn-danger" href="<?= base_url('worship_place') ?>">Cancel</a>
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
    $('#check-nearby-col').hide();
    $('#result-nearby-col').hide();
    $('#legend').hide();
</script>
<?= $this->endSection() ?>