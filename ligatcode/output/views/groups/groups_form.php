<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
<style>
body {
    padding: 15px;
}
</style>
</head>

<body>
    <h2 style="margin-top:0px">Groups <?php echo $button ?></h2>
    <form action="<?php echo $action; ?>" method="post">
	 <div class="form-group">
            <label for="varchar">Name
                <?php echo form_error('name') ?></label>
            <input type="text" class="form-control" name="name" id="name"
                placeholder="Name" value="<?php echo $name; ?>" />
        </div>
	 <div class="form-group">
            <label for="varchar">Description
                <?php echo form_error('description') ?></label>
            <input type="text" class="form-control" name="description" id="description"
                placeholder="Description" value="<?php echo $description; ?>" />
        </div>
	 <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	 <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	 <a href="<?php echo site_url('groups') ?>" class="btn btn-default">Cancel</a>
	</form>
</body>

</html>