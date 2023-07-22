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


                        <div class="row content">

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


                        <form id="dynamicForm" action="<?= base_url($action) ?>" method="post" enctype="multipart/form-data">

                            <?php

                            if (isset($data[0]->id_package)) {
                            ?>
                                <div class="form-group">
                                    <label for="varchar">Name</label>
                                    <input type="text" class="form-control" autocomplete="off" name="name" id="name" placeholder="Name" value="<?php echo $data[0]->name; ?>" required />
                                </div>
                                <div class="form-group">
                                    <label for="int">Capaity</label>
                                    <input type="text" class="form-control" autocomplete="off" name="min_capacity" id="min_capaity" placeholder="Min Capaity" value="<?php echo $data[0]->min_capaity; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Contact Person</label>
                                    <input type="text" class="form-control" autocomplete="off" name="contact_person" id="contact_person" placeholder="Contact Person" value="<?php echo $data[0]->contact_person; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="3" name="description" id="description" placeholder="Description"><?php echo $data[0]->description; ?></textarea>
                                </div>

                                <div class="slidercontainer">

                                    <?php
                                    $countImage = count($data);
                                    $image_i = 0;
                                    while ($image_i < $countImage) {
                                    ?>

                                        <!-- Mulai dari sini -->
                                        <?php

                                        if ($data[$image_i]->brosur_url == NULL) {
                                        } else {
                                        ?>
                                            <div class="showSlide">
                                                <img class="img img-fluid" src="<?php echo base_url("upload/" . $data[$image_i]->brosur_url); ?>" />
                                                <div class="contentx"><?php echo $data[$image_i]->name; ?></div>
                                                <a style="float:right" onclick="deleteImageEvent('<?php echo $data[$image_i]->brosur_url ?>')"><i style="color:red" class="fa fa-trash" aria-hidden="true"></i> </a>
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
                                <!-- <div class="form-group">
                                    <label for="char">Brosur Url</label>
                                    <input type="file" class="form-control" autocomplete="off" name="brosur_url" id="brosur_url" placeholder="Brosur Url" />
                                </div> -->
                                <div class="form-group">
                                    <label for="int">Price</label>
                                    <input type="text" class="form-control" autocomplete="off" name="price" id="price" placeholder="Price" value="<?php echo $data[0]->price; ?>" />
                                </div>
                                <input id="id_package" class="form-control" type="text" name="id_package" style="display:none;" value="<?= $data[0]->id_package; ?>">

                            <?php
                            } else {
                            ?>
                                <h5><b>Package</b></h5>
                                <div class="form-group">
                                    <label for="varchar">Name
                                    </label>
                                    <input type="text" class="form-control" autocomplete="off" name="name" id="name" placeholder="Name" value="" required />
                                </div>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control" autocomplete="off" name="date" id="date" placeholder="Date" value="" />
                                </div>
                                <div class="form-group">
                                    <label for="int">Min Capaity</label>
                                    <input type="text" class="form-control" autocomplete="off" name="min_capacity" id="min_capacity" placeholder="Min Capaity" value="" />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Contact Person</label>
                                    <input type="text" class="form-control" autocomplete="off" name="contact_person" id="contact_person" placeholder="Contact Person" value="" />
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="3" name="description" id="description" placeholder="Description"></textarea>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="char">Brosur Url</label>
                                    <input type="text" class="form-control" autocomplete="off" name="brosur_url" id="brosur_url" placeholder="Brosur Url" value="" />
                                </div> -->
                                <div class="form-group">
                                    <label for="int">Price</label>
                                    <input type="text" class="form-control" autocomplete="off" name="price" id="price" placeholder="Price" value="" />
                                </div>

                                <h5><b>Package Day</b></h5>
                                <div onclick="showPackageDay()" class="btn btn-info">Add Day</div>
                                <div id="detail_day">

                                </div>
                                <br />
                                <h5><b>Service Package</b></h5>


                                <?php



                                $count = count($service_package['features']);
                                $i = 0;
                                while ($i < $count) {
                                ?>
                                    <input name="checkbox_service_package_<?php echo $service_package['features'][$i]['properties']['id_service_package'] ?>" type="checkbox" class="radioServicePackage" value="<?php echo $service_package['features'][$i]['properties']['id_service_package'] ?>">
                                    <label for="vehicle1"> <?php echo $service_package['features'][$i]['properties']['name'] ?> </label><br>

                                <?php
                                    $i++;
                                }

                                ?>
                                <br />
                                <h5><b>Image</b></h5>
                                <input type="file" name="imageFile" class="form form-control"></input>


                            <?php
                            }
                            ?>

                            <br />
                            <input type="hidden" id="nameHidden" name="nameHidden"></input>
                            <div onclick="getNameField()" class="btn btn-info">Lock</div>
                            <div class="d-flex p-2 bd-highlight">
                                <div class="form-group">
                                    <a class="btn btn-sm btn-danger" href="<?= base_url('package') ?>">Cancel</a>
                                    <button id="submitName" disabled class="btn btn-sm btn-primary" type="submit">SAVE</button>
                                </div>
                            </div>
                        </form>



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