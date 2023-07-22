<?php $uri = service('uri')->getSegments(); ?>

<!-- Object Rating and Review -->
<div class="card">
    <div class="card-header text-center">
        <h4 class="card-title">Rating and Review</h4>
            <form class="form form-vertical" onsubmit="checkStar(event);">
                <div class="form-body">
                    <div class="star-containter mb-3">
                        <i class="fa-solid fa-star fs-4" id="star-1" onclick="setStar('star-1');"></i>
                        <i class="fa-solid fa-star fs-4" id="star-2" onclick="setStar('star-2');"></i>
                        <i class="fa-solid fa-star fs-4" id="star-3" onclick="setStar('star-3');"></i>
                        <i class="fa-solid fa-star fs-4" id="star-4" onclick="setStar('star-4');"></i>
                        <i class="fa-solid fa-star fs-4" id="star-5" onclick="setStar('star-5');"></i>
                        <input type="hidden" id="star-rating" value="0" name="rating">
                        <input type="hidden" value="<?= $uri[2]; ?>" name="object_id">
                    </div>
                    <div class="col-12 mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here"
                                      id="floatingTextarea" style="height: 150px;" name="comment"></textarea>
                            <label for="floatingTextarea">Leave a comment here</label>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end mb-3">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                    </div>
                </div>
            </form>
            <p class="card-text">Please login as User to give rating and review</p>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="reviews">
                <tbody>
                    <tr>
                        <td>
                            <p class="mb-0">
                                <span class="material-symbols-outlined rating-color">star</span>
                                <span class="material-symbols-outlined rating-color">star</span>
                                <span class="material-symbols-outlined rating-color">star</span>
                                <span class="material-symbols-outlined">star</span>
                                <span class="material-symbols-outlined">star</span>
                            </p>
                            <p class="mb-0">Nama Akun</p>
                            <p class="fw-light">2022-07-12</p>
                            <p class="fw-bold">Rerum sed consectetur.</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="mb-0">
                                <span class="material-symbols-outlined rating-color">star</span>
                                <span class="material-symbols-outlined rating-color">star</span>
                                <span class="material-symbols-outlined rating-color">star</span>
                                <span class="material-symbols-outlined rating-color">star</span>
                                <span class="material-symbols-outlined">star</span>
                            </p>
                            <p class="mb-0">Nama Akun 2</p>
                            <p class="fw-light">2022-07-12</p>
                            <p class="fw-bold">Rerum sed consectetur.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>