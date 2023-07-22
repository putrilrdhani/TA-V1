<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="row content">
    <h1><?= $content; ?></h1>
</div>
<table class="table table-light table-striped">
    <tbody>
	    <tr><th width="15%">Name</th><td>: 	<?php echo $data['name']; ?></td></tr>
	    <tr><th width="15%">Url</th><td>: 	<?php echo $data['url']; ?></td></tr>
	    <tr><th width="15%">Duration</th><td>: 	<?php echo $data['duration']; ?></td></tr>
	    <tr><th width="15%">View</th><td>: 	<?php echo $data['view']; ?></td></tr>
</tbody>
</table>
    <div class="d-flex p-2 bd-highlight">
        <a class="btn btn-sm btn-danger" href="<?= \base_url('tourism_video') ?>">back</a>
    </div>
<?= $this->endSection(); ?>