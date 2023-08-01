<?= $this->extend('web/layouts/main_admin'); ?>

<?= $this->section('content') ?>

<section class="section">
	<div class="row">
		<!--map-->
		<div class="col-md-5">
			<div class="row">
				<div class="card">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="row content">
								<h3><small><?= $data[0]->name; ?></small></h3>
							</div>
							<table class="table table-borderless">
								<tbody>
									<tr>
										<th width="15%" style="text-align: left;">Name</th>
										<td>: <?php echo $data[0]->name; ?></td>
									</tr>
									<tr>
										<th width="15%" style="text-align: left;">Contact Person</th>
										<td>: <?php echo $data[0]->contact_person; ?></td>
									</tr>
									<tr>
										<th width="15%" style="text-align: left;">Open</th>
										<td>: <?php echo $data[0]->open; ?></td>
									</tr>
									<tr>
										<th width="15%" style="text-align: left;">Close</th>
										<td>: <?php echo $data[0]->close; ?></td>
									</tr>
								</tbody>
							</table>
							<div class="d-flex p-2 bd-highlight">
								<a class="btn btn-sm btn-danger" href="<?= \base_url('souvenir_place') ?>">back</a>
							</div>

							<!-- Script Mendisable tombol -->
							<!-- Gunakan ini jika ingin mendisable tombol delete dan remove -->
							<script>
								$("#delete-button").prop("disabled", true);
								$("#delete-map").prop("disabled", true);
							</script>


						</div>
					</div>

				</div>
			</div>
			<div class="row">
				<div class="card">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="row">
								<div class="col-sm-2"></div>
								<div>
									<div class="slidercontainer">

										<?php
										$countImage = count($data);
										$image_i = 0;
										while ($image_i < $countImage) {
										?>
											<div class="showSlide">
												<img class="img img-fluid" src="<?php echo base_url("upload/" . $data[$image_i]->url); ?>" />

											</div>

										<?php
											$image_i++;
										}
										?>

										<!-- Navigation arrows -->
										<div class="row">
											<div class="col">
												<a class="left" onclick="nextSlide(-1)"><i class="fa-solid fa-backward"></i>| </a>
											</div>
											<div class="col justify-content-right">
												<a class="right" onclick="nextSlide(1)"> |<i class="fa-solid fa-forward"></i></a>
											</div>
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
				</div>
			</div>
		</div>
		<div class="col-md-7">
			<div class="card">
				<div class="card-header">
					<div class="row align-items-center">


						<?= $this->include('web/layouts/map-body'); ?>

						<?= $this->include('web/layouts/jsLoad'); ?>
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
	$('#panel').hide();
	$('#direction-row').hide();
	$('#check-nearby-col').hide();
	$('#legend').hide();
	$('#result-nearby-col').hide();
</script>
<?= $this->endSection() ?>