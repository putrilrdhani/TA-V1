<?= $this->extend('web/layouts/main'); ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="row">
        <script>
            currentUrl = '<?= current_url(); ?>';
        </script>

        <!-- Object Detail Information -->
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Object Information</h4>
                    <div class="text-center">
                        <span class="material-symbols-outlined rating-color">star</span>
                        <span class="material-symbols-outlined rating-color">star</span>
                        <span class="material-symbols-outlined rating-color">star</span>
                        <span class="material-symbols-outlined rating-color">star</span>
                        <span class="material-symbols-outlined">star</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">Name</td>
                                        <td>Object Name</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Address</td>
                                        <td>Object Address</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Open</td>
                                        <td>12:00 WIB</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Close</td>
                                        <td>15:00 WIB</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Ticket Price</td>
                                        <td>Rp 20.000</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Contact Person</td>
                                        <td>08123456789</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="fw-bold">Description</p>
                            <p>Assumenda expedita suscipit nulla ut voluptate fuga. Voluptatem officiis accusantium aliquam deleniti odio. Sit delectus in temporibus ut omnis. Hic assumenda nam rem non. Aliquid illo consectetur odit est ullam corporis. Animi cum culpa enim ad explicabo eveniet vero. Quia maxime nobis reiciendis odit. Et ea animi quas dolor earum. Aut facilis placeat ipsa sint reiciendis ad est.
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="fw-bold">Facilities</p>
                            <p>1. Kolam Renang</p>
                            <p>2. Wifi</p>
                            <p>3. Selfie Aare</p>
                        </div>
                    </div>
                </div>
            </div>

            <!--Rating and Review Section-->
            <?= $this->include('web/layouts/review'); ?>
        </div>

        <div class="col-md-6 col-12">
            <!-- Object Location on Map -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Google Maps</h5>
                </div>

                <?= $this->include('web/layouts/map-body'); ?>
                <script>
                    initMap()
                </script>
            </div>

            <!-- Object Media -->
            <?= $this->include('web/layouts/gallery_video'); ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    const myModal = document.getElementById('videoModal');
    const videoSrc = document.getElementById('video-play').getAttribute('data-src');

    myModal.addEventListener('shown.bs.modal', () => {
        console.log(videoSrc);
        document.getElementById('video').setAttribute('src', videoSrc);
    });
    myModal.addEventListener('hide.bs.modal', () => {
        document.getElementById('video').setAttribute('src', '');
    });
</script>
<?= $this->endSection() ?>