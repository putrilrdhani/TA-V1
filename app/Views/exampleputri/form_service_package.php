<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<div class="row content">
    <h1><?= $content; ?></h1>
</div>
<h4 style="margin-top:0px">Service_package <?php echo $content; ?></h4>
<form action="<?= base_url($action) ?>" method="post">
	 <div class="form-group">
                        <label for="varchar">Name
                            <?php echo ('name') ?></label>
                        <input type="text" class="form-control" autocomplete="off" name="name" id="name"
                            placeholder="Name" value="<?php echo $data['name']; ?>" />
                    </div>
	 <input id="id_service_package" class="form-control" type="text" name="id_service_package" style="display:none;" value="<?= $data['id_service_package'] ?>"> 
	
    <div class="d-flex p-2 bd-highlight">
    <div class="form-group">
        <a class="btn btn-sm btn-danger" href="<?= base_url('exampleputri') ?>">Cancel</a>
        <button class="btn btn-sm btn-primary" type="submit">SAVE</button>
    </div>
    </div>
</form>



<?= $this->endSection(); ?>