<?= $this->extend('web/layouts/main_admin'); ?>

<?= $this->section('content') ?>

<section class="section">
	<div class="row">
		<!--map-->
		<div class="col">
			<div class="card">
				<div class="card-header">
					<div class="row align-items-center">
						<!-- Javascript untuk  memuat peta -->
						<?= $this->include('web/layouts/jsLoad'); ?>

						<div class="row content">
							<div class="col">

								<h3><small>Book <?= $data[0]->id_user . $data[0]->booking_date . $data[0]->id_package ?></small></h3>
							</div>
							<div class="col col-md-2">
							</div>
						</div>

					</div>
					<table class="table table-borderless">
						<tbody>
							<tr>
								<th width="15%" style="text-align: left;">User</th>
								<td>: <?php echo $data[0]->username; ?></td>
							</tr>
							<tr>
								<th width="15%" style="text-align: left;">Contact Person</th>
								<td>: </td>
							</tr>
							<tr>
								<th width="15%" style="text-align: left;">Purchase Date</th>
								<td>: <?php echo $data[0]->purchase_date; ?></td>
							</tr>
							<tr>
								<th width="15%" style="text-align: left;">Purchase Time</th>
								<td>: <?php echo $data[0]->purchase_time; ?></td>
							</tr>
							<tr>
								<th width="15%" style="text-align: left;">Date</th>
								<td>: <?php echo $data[0]->booking_date; ?></td>
							</tr>
							<tr>
								<th width="15%" style="text-align: left;">Total Member</th>
								<td>: <?php echo $data[0]->total_member; ?></td>
							</tr>
							<tr>
								<th width="15%" style="text-align: left;">Comment</th>
								<td>: <?php echo $data[0]->comment; ?></td>
							</tr>
							<?php
							if ($data[0]->status == "0") {
							?>
								<tr class="alert alert-warning">
									<th width="15%" style="text-align: left;">Status</th>
									<td>: Pending</td>
								</tr>
							<?php
							} else if ($data[0]->status == "1") {
							?>
								<tr class="alert alert-success">
									<th width="15%" style="text-align: left;">Status</th>
									<td>: Confirmed</td>
								</tr>
							<?php
							} else if ($data[0]->status == "2") {
							?>
								<tr class="alert alert-danger">
									<th width="15%" style="text-align: left;">Status</th>
									<td>: Decline</td>
								</tr>

							<?php
							} else {
							?>
								<tr class="alert alert-secondary">
									<th width="15%" style="text-align: left;">Status</th>
									<td>: Canceled</td>
								</tr>
							<?php
							}

							?>
						</tbody>
					</table>

					<input required type="text" class="form-control" autocomplete="off" name="comment" id="comment" placeholder="Comment" value="" />
					<div class="d-flex p-2 bd-highlight">
						<a class="btn btn-secondary" href="<?= base_url('booking') ?>">back</a> &nbsp;

						<a href="#" onclick="confirm_booking('<?php echo $data[0]->booking_date ?>','<?php echo $data[0]->id_user ?>','<?php echo $data[0]->id_package ?>')" class="btn btn-success">confirm</i></a> &nbsp;
						<a href="#" onclick="decline_booking('<?php echo $data[0]->booking_date ?>','<?php echo $data[0]->id_user ?>','<?php echo $data[0]->id_package ?>')" class="btn btn-danger">decline</i></a>&nbsp;
						<a href="#" onclick="detail_booking('<?php echo $data[0]->id_package ?>')" class="btn btn-info">detail</i></a>

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
	$('#coorAdmin').hide();
	$('#legend').hide();
	$('#check-nearby-col').hide();
	$('#result-nearby-col').hide();
</script>
<?= $this->endSection() ?>