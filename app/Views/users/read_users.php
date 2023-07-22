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
							<h3><small><?= $data['username'] ?></small></h3>
						</div>
						<table class="table table-borderless">
							<tbody>
								<tr>
									<th width="15%">Email</th>
									<td>: <?php echo $data['email']; ?></td>
								</tr>
								<tr>
									<th width="15%">Username</th>
									<td>: <?php echo $data['username']; ?></td>
								</tr>
								<tr>
									<th width="15%">Reset At</th>
									<td>: <?php echo $data['reset_at']; ?></td>
								</tr>
								<tr>
									<th width="15%">Status</th>
									<td>: <?php echo $data['status']; ?></td>
								</tr>
								<tr>
									<th width="15%">Status Message</th>
									<td>: <?php echo $data['status_message']; ?></td>
								</tr>
								<tr>
									<th width="15%">Active</th>
									<td>: <?php echo $data['active']; ?></td>
								</tr>
								<tr>
									<th width="15%">Created At</th>
									<td>: <?php echo $data['created_at']; ?></td>
								</tr>
								<tr>
									<th width="15%">Updated At</th>
									<td>: <?php echo $data['updated_at']; ?></td>
								</tr>
								<tr>
									<th width="15%">Deleted At</th>
									<td>: <?php echo $data['deleted_at']; ?></td>
								</tr>
							</tbody>
						</table>
						<div class="d-flex p-2 bd-highlight">
							<a class="btn btn-sm btn-danger" href="<?= \base_url('users') ?>">back</a>
						</div>


					</div>
				</div>

			</div>
		</div>



	</div>
	<!-- Direction section -->
	<?= $this->include('web/layouts/direction'); ?>
</section>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
	$('#direction-row').hide();
	$('#check-nearby-col').hide();
	$('#result-nearby-col').hide();
</script>
<?= $this->endSection() ?>