
<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <h1><?= $content; ?></h1>
</div>
<div class="row">
<div class="d-flex p-2 bd-highlight">
    <a href="<?= base_url('detail_package/create') ?>" class="btn btn-sm btn-primary">CREATE</a>
</div>
</div>

<?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-info" role="alert">
        <?= session()->getFlashdata('message') ?>
    </div>   
<?php endif; ?>

<div class="row">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>No</th>
		<th>Activity Type</th>
		<th>Id</th>
		<th>Description</th>
		<th>Action</th>
        </tr>
        <tr>
        </thead><?php foreach ($data as $value): ?>
        <tr>
			<td width="80px"><?php $start=0; echo ++$start ?></td>
			<td><?= $value['activity_type'] ?></td>
			<td><?= $value['id'] ?></td>
			<td><?= $value['description'] ?></td><td>
            <span class="float-right">
                <a type="button" class="btn btn-sm btn-primary" href="<?= base_url('detail_package/read/'.$value['id_package'] )?>">READ</a>
                <a type="button" class="btn btn-sm btn-warning" href="<?= base_url('detail_package/update/'.$value['id_package'] )?>">EDITE</a>
                <a type="button" class="btn btn-sm btn-danger" href="<?= base_url('detail_package/delete/'.$value['id_package'] )?>" onclick="javascript: return confirm('Delete \nAre You Sure ?')">DELETE</a>
            </span>
            </td>
            <?php  endforeach; ?>
        </tbody>
    </table>
    <!-- pagination -->
    <?php echo $pager->links('paging', 'ligatcode_pagination') ?>
</div>
<?= $this->endSection(); ?>