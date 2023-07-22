<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<div class="row content">
    <h1><?= $content; ?></h1>
</div>
<h4 style="margin-top:0px">Package_day <?php echo $content; ?></h4>
<form action="<?= base_url($action) ?>" method="post">
	 <div class="form-group">
                        <label for="description">Description
                            <?php echo ('description') ?></label>
                        <textarea class="form-control" rows="3" name="description" id="description"
                            placeholder="Description"><?php echo $data['description; ?></textarea>
                    </div>
	 <input id="id_package" class="form-control" type="text" name="id_package" style="display:none;" value="<?= $data['id_package'] ?>"> 
	
    <div class="d-flex p-2 bd-highlight">
    <div class="form-group">
        <a class="btn btn-sm btn-danger" href="<?= base_url('exampleputri') ?>">Cancel</a>
        <button class="btn btn-sm btn-primary" type="submit">SAVE</button>
    </div>
    </div>
</form>



<?= $this->endSection(); ?>