<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="row content">
    <h1><?= $content; ?></h1>
</div>
<table class="table table-light table-striped">
    <tbody>
	    <tr><th width="15%">Description</th><td>: 	<?php echo $data['description']; ?></td></tr>
</tbody>
</table>
    <div class="d-flex p-2 bd-highlight">
        <a class="btn btn-sm btn-danger" href="<?= \base_url('exampleputri') ?>">back</a>
    </div>
<?= $this->endSection(); ?>