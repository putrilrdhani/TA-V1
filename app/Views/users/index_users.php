<?= $this->extend('web/layouts/main_admin'); ?>

<?= $this->section('content') ?>



<!-- Isi Disini -->
<section class="section">
	<div class="row">
		<!--map-->
		<div class="col-md-12 col-12">
			<div class="card">
				<div class="card-header">
					<div class="row align-items-center">

						<div class="col-md-auto">

							<div class="row">
								<h3><small><?= $content; ?></small></h3>
							</div>
							<div class="row">
								<div class="d-flex p-2 bd-highlight">

								</div>
							</div>

							<?php if (session()->getFlashdata('message')) : ?>
								<div class="alert alert-info" role="alert">
									<?= session()->getFlashdata('message') ?>
								</div>
							<?php endif; ?>

							<div class="row">
								<table id="showDataTable" class="table table-hover">
									<thead>
										<tr>
											<th>No</th>
											<th>Email</th>
											<th>Username</th>
											<th>Active</th>
											<th>Created At</th>
											<th>Updated At</th>
											<th>Deleted At</th>
											<th>Action</th>
										</tr>
									</thead><?php foreach ($data as $value) : ?>
										<tr>
											<td width="80px"><?php $start = 0;
																echo ++$start ?></td>
											<td><?= $value['email'] ?></td>
											<td><?= $value['username'] ?></td>
											<td><?= $value['active'] ?></td>
											<td><?= $value['created_at'] ?></td>
											<td><?= $value['updated_at'] ?></td>
											<td><?= $value['deleted_at'] ?></td>
											<td style="width: 80px;">
												<span class="float-right">
													<a href="<?= base_url('users/read/' . $value['id']) ?>"><i class="fa-solid fa-bars"></i></a>
													<a href="<?= base_url('users/update/' . $value['id']) ?>"><i style="color:chocolate" class="fas fa-edit"></i></a>
													<a href="<?= base_url('users/delete/' . $value['id']) ?>" onclick="javascript: return confirm('Delete \nAre You Sure ?')"><i style="color:red" class="fa fa-trash" aria-hidden="true"></i></a>
												</span>
											</td>
										<?php endforeach; ?>
										</tbody>
								</table>
								<!-- pagination -->
							</div>
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
	$('#direction-row').hide();
	$('#check-nearby-col').hide();
	$('#result-nearby-col').hide();
</script>
<?= $this->endSection() ?>