<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="row content">
    <h1><?= $content; ?></h1>
</div>
<table class="table table-light table-striped">
    <tbody>
	    <tr><th width="15%">Name</th><td>: 	<?php echo $data['name']; ?></td></tr>
	    <tr><th width="15%">Date</th><td>: 	<?php echo $data['date']; ?></td></tr>
	    <tr><th width="15%">Min Capaity</th><td>: 	<?php echo $data['min_capaity']; ?></td></tr>
	    <tr><th width="15%">Contact Person</th><td>: 	<?php echo $data['contact_person']; ?></td></tr>
	    <tr><th width="15%">Description</th><td>: 	<?php echo $data['description']; ?></td></tr>
	    <tr><th width="15%">Brosur Url</th><td>: 	<?php echo $data['brosur_url']; ?></td></tr>
	    <tr><th width="15%">Price</th><td>: 	<?php echo $data['price']; ?></td></tr>
</tbody>
</table>
    <div class="d-flex p-2 bd-highlight">
        <a class="btn btn-sm btn-danger" href="<?= \base_url('exampleputri') ?>">back</a>
    </div>
<?= $this->endSection(); ?>