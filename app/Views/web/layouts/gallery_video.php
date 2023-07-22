<div class="card">
    <div class="card-body">
        <div class="d-grid gap-2">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#gallery">
                <span class="material-icons" style="font-size: 1.5rem; vertical-align: bottom">image</span> Open Gallery
            </button>
            <button type="button" id="video-play" class="btn-play btn btn-outline-primary" data-bs-toggle="modal" data-src="<?= base_url('media/videos'); ?>/RGA.mp4" data-bs-target="#videoModal">
                <span class="material-icons" style="font-size: 1.5rem; vertical-align: bottom">play_circle</span> Play Video
            </button>

            <div class="modal fade text-left" id="gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel17">Gallery</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></li>
                                    <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" class=""></li>
                                    <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" class=""></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="<?= base_url('media/photos'); ?>/payo1.jpg" class="d-block w-100" alt="">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="<?= base_url('media/photos'); ?>/payo2.jpg" class="d-block w-100" alt="">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="<?= base_url('media/photos'); ?>/payo3.jpg" class="d-block w-100" alt=""">
                                    </div>
                                </div>
                                <a class=" carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade text-left" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel17">Video</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="ratio ratio-16x9">
                                        <video src="" class="embed-responsive-item" id="video" controls>Sorry, your browser doesn't support embedded videos</video>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>