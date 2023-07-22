<?= $this->extend('web/layouts/main_admin'); ?>

<?= $this->section('content') ?>

<section class="section">
	<div class="row">
		<!--map-->
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="row align-items-center">
						<!-- Javascript untuk  memuat peta -->
						<?= $this->include('web/layouts/jsLoad'); ?>


						<!-- Isi Disini -->

						<div class="row content">
							<h3><small><?= $data[0]->name ?></small></h3>
						</div>
						<table class="table table-borderless">
							<tbody>
								<tr>
									<th width="15%">Name</th>
									<td>: <?php echo $data[0]->name; ?></td>
								</tr>
								<tr>
									<th width="15%">Date</th>
									<td>: <?php echo $data[0]->date; ?></td>
								</tr>
								<tr>
									<th width="15%">Min Capaity</th>
									<td>: <?php echo $data[0]->min_capaity; ?></td>
								</tr>
								<tr>
									<th width="15%">Contact Person</th>
									<td>: <?php echo $data[0]->contact_person; ?></td>
								</tr>
								<tr>
									<th width="15%">Description</th>
									<td>: <?php echo $data[0]->description; ?></td>
								</tr>
								<tr>
									<th width="15%">Brosur Url</th>
									<td>: <?php echo $data[0]->brosur_url; ?></td>
								</tr>
								<tr>
									<th width="15%">Price</th>
									<td>: <?php echo $data[0]->price; ?></td>
								</tr>
							</tbody>
						</table>
						<div class="d-flex p-2 bd-highlight">
							<a class="btn btn-sm btn-danger" href="<?= \base_url('package') ?>">back</a>
						</div>



					</div>
				</div>
			</div>
		</div>
	</div>

</section>



<script>
	$("#color-palette").prop("hidden", true);
	$("#delete-button").prop("hidden", true);
	$("#delete-map").prop("hidden", true);
</script>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
	$('#direction-row').hide();
	$('#legend').hide();
	$('#check-nearby-col').hide();
	$('#result-nearby-col').hide();
</script>
<?= $this->endSection() ?>