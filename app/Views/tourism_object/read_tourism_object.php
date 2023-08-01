<?= $this->extend('web/layouts/main_admin'); ?>

<?= $this->section('content') ?>
<section class="section">
	<div class="row">
		<!--map-->

		<div class="col-md-5">
			<div class="card">
				<div class="card-header">

					<div class="row align-items-center">
						<div class="row content">
							<h3><small><?= $data[0]->name ?></small></h3>
						</div>
						<table class="table table-borderless">
							<tbody>
								<tr>
									<th width="15%" style="text-align: left;">Name</th>
									<td>: <?php echo $data[0]->name; ?></td>
								</tr>
								<tr>
									<th width="15%" style="text-align: left;">Address</th>
									<td>: <?php echo $data[0]->address; ?></td>
								</tr>
								<tr>
									<th width="15%" style="text-align: left;">Open</th>
									<td>: <?php echo $data[0]->open; ?></td>
								</tr>
								<tr>
									<th width="15%" style="text-align: left;">Close</th>
									<td>: <?php echo $data[0]->close; ?></td>
								</tr>
								<tr>
									<th width="15%" style="text-align: left;">Ticket Price</th>
									<td>: <?php echo $data[0]->ticket_price; ?></td>
								</tr>
								<tr>
									<th width="15%" style="text-align: left;">Contact Person</th>
									<td>: <?php echo $data[0]->contact_person; ?></td>
								</tr>
								<tr>
									<th width="15%" style="text-align: left;">Facility</th>
									<td>:
										<?php
										$count = count($data_facility);
										$count = $count - 1;
										$i = 0;
										while ($i < $count) {
										?>
											<br />
											<?php echo $data_facility[$i]->name; ?>
										<?php
											$i++;
										}
										?>
									</td>
								</tr>
							</tbody>
						</table>
						<br />
						<div class="d-flex justify-content-center">
							<button onclick="openModal()" type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal">
								Show gallery
							</button>
							<script>
								function openModal() {
									$('#myModal').modal('show');
								}

								function closeModal() {
									$('#myModal').modal('hide');
								}
								$("#delete-button").prop("disabled", true);
								$("#delete-map").prop("disabled", true);
							</script>
						</div>

						<div class="d-flex p-2 bd-highlight">
							<a class="btn btn-danger" href="<?= \base_url('tourism_object') ?>">Back</a>
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="col-md-7">
			<div class="card">
				<div class="card-header">
					<?= $this->include('web/layouts/map-body'); ?>

					<!-- Javascript untuk  memuat peta -->

					<?= $this->include('web/layouts/jsLoad'); ?>
				</div>
			</div>
		</div>
		<div class="modal" style="width: 100%; height:90hv" id="myModal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-body">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h5 style="text-align: center;">Gallery</h5>
									<div class="row align-items-center">
										<div class="col-sm-2"></div>
										<div class="outerLayer">
											<div class="slidercontainer ">

												<?php
												$countImage = count($data);
												$image_i = 0;
												while ($image_i < $countImage) {
												?>
													<?php

													if ($data[$image_i]->id_gallery == NULL) {
													} else {
													?>
														<div class="showSlide">
															<div class="d-flex justify-content-center">
																<img class="img img-fluid" style="max-height: 90vh;" src="<?php echo base_url("upload/" . $data[$image_i]->url); ?>" />

															</div>

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

														</div>
													<?php
													}
													?>

												<?php
													$image_i++;
												}
												?>

												<!-- Navigation arrows -->
												<a class="left" onclick="nextSlide(-1)"><i class="fa-solid fa-chevron-left" style="color: grey;"></i></a>
												<a class="right" onclick="nextSlide(1)"><i class="fa-solid fa-chevron-right" style="color: grey;"></i></a>

											</div>
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
							</div>
						</div>

						<button onclick="closeModal()" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


					</div>

					<style>
						.outerLayer {
							position: relative;
							height: 100%;
						}

						.outerLayer a {
							position: absolute;
							top: calc(50% - 0.5em);
						}

						.outerLayer a.right {
							right: 0;
						}

						.outerLayer a.left {
							left: 0;
						}

						a {
							text-decoration: none;
							display: inline-block;
							padding: 8px 16px;
						}

						.right:hover {
							background-color: #ddd;
							color: black;
						}

						.left:hover {
							background-color: #ddd;
							color: black;
						}

						.left {
							color: black;
						}

						.right {
							color: black;
						}

						.round {
							border-radius: 50%;
						}
					</style>



				</div>
			</div>
		</div>




	</div>
</section>

<script>
	$("#delete-button").prop("hidden", true);
	$("#delete-map").prop("hidden", true);
</script>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
	$('#direction-row').hide();
	$('#coorAdmin').hide();
	$('#panel').hide();
	$('#check-nearby-col').hide();
	$('#result-nearby-col').hide();
</script>
<?= $this->endSection() ?>