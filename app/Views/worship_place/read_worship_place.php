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
							<!-- Isi Disini -->
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
										<th width="15%" style="text-align: left;">Capacity</th>
										<td>: <?php echo $data[0]->capacity; ?></td>
									</tr>
									<tr>
									</tr>
								</tbody>
							</table>
							<div class="d-flex p-2 bd-highlight">
								<a class="btn btn-sm btn-danger" href="<?= \base_url('worship_place') ?>">back</a>
							</div>
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
							<div class="col-sm-2"></div>
							<div>
								<div class="slidercontainer">
									<div class="row" style="text-align: center;">
										<h5>Gallery</h5>
									</div>
									<?php
									$countImage = count($data);
									$image_i = 0;
									while ($image_i < $countImage) {
									?>
										<div class="showSlide">
											<img class="img img-fluid" src="<?php echo base_url("upload/" . $data[$image_i]->url); ?>" />
											<div><br /></div>


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
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-7">

			<div class="card">
				<div class="card-header">
					<div class="row align-items-center">


						<!-- Tambahkan ini -->
						<?= $this->include('web/layouts/map-body'); ?>


						<?= $this->include('web/layouts/jsLoad'); ?>
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
	$('#coorAdmin').hide();
	$('#result-nearby-col').hide();
</script>
<?= $this->endSection() ?>