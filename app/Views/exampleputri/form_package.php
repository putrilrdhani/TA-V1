<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<div class="row content">
    <h1><?= $content; ?></h1>
</div>
<h4 style="margin-top:0px">Package <?php echo $content; ?></h4>
<form action="<?= base_url($action) ?>" method="post">
	 <div class="form-group">
                        <label for="varchar">Name
                            <?php echo ('name') ?></label>
                        <input type="text" class="form-control" autocomplete="off" name="name" id="name"
                            placeholder="Name" value="<?php echo $data['name']; ?>" />
                    </div>
	 <div class="form-group">
                        <label for="date">Date
                            <?php echo ('date') ?></label>
                        <input type="text" class="form-control" autocomplete="off" name="date" id="date"
                            placeholder="Date" value="<?php echo $data['date']; ?>" />
                    </div>
	 <div class="form-group">
                        <label for="int">Min Capaity
                            <?php echo ('min_capaity') ?></label>
                        <input type="text" class="form-control" autocomplete="off" name="min_capaity" id="min_capaity"
                            placeholder="Min Capaity" value="<?php echo $data['min_capaity']; ?>" />
                    </div>
	 <div class="form-group">
                        <label for="varchar">Contact Person
                            <?php echo ('contact_person') ?></label>
                        <input type="text" class="form-control" autocomplete="off" name="contact_person" id="contact_person"
                            placeholder="Contact Person" value="<?php echo $data['contact_person']; ?>" />
                    </div>
	 <div class="form-group">
                        <label for="description">Description
                            <?php echo ('description') ?></label>
                        <textarea class="form-control" rows="3" name="description" id="description"
                            placeholder="Description"><?php echo $data['description; ?></textarea>
                    </div>
	 <div class="form-group">
                        <label for="char">Brosur Url
                            <?php echo ('brosur_url') ?></label>
                        <input type="text" class="form-control" autocomplete="off" name="brosur_url" id="brosur_url"
                            placeholder="Brosur Url" value="<?php echo $data['brosur_url']; ?>" />
                    </div>
	 <div class="form-group">
                        <label for="int">Price
                            <?php echo ('price') ?></label>
                        <input type="text" class="form-control" autocomplete="off" name="price" id="price"
                            placeholder="Price" value="<?php echo $data['price']; ?>" />
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