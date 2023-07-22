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
                            <h3><small><?= $content; ?></small></h3>
                        </div>
                        <form action="<?= base_url($action) ?>" method="post">
                            <div class="form-group">
                                <label for="varchar">Email
                                    <?php echo ('email') ?></label>
                                <input type="text" class="form-control" autocomplete="off" name="email" id="email" placeholder="Email" value="<?php echo $data['email']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="varchar">Username
                                    <?php echo ('username') ?></label>
                                <input type="text" class="form-control" autocomplete="off" name="username" id="username" placeholder="Username" value="<?php echo $data['username']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="varchar">Password Hash
                                    <?php echo ('password_hash') ?></label>
                                <input type="text" class="form-control" autocomplete="off" name="password_hash" id="password_hash" placeholder="Password Hash" value="<?php echo $data['password_hash']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="varchar">Reset Hash
                                    <?php echo ('reset_hash') ?></label>
                                <input type="text" class="form-control" autocomplete="off" name="reset_hash" id="reset_hash" placeholder="Reset Hash" value="<?php echo $data['reset_hash']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="datetime">Reset At
                                    <?php echo ('reset_at') ?></label>
                                <input type="text" class="form-control" autocomplete="off" name="reset_at" id="reset_at" placeholder="Reset At" value="<?php echo $data['reset_at']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="datetime">Reset Expires
                                    <?php echo ('reset_expires') ?></label>
                                <input type="text" class="form-control" autocomplete="off" name="reset_expires" id="reset_expires" placeholder="Reset Expires" value="<?php echo $data['reset_expires']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="varchar">Activate Hash
                                    <?php echo ('activate_hash') ?></label>
                                <input type="text" class="form-control" autocomplete="off" name="activate_hash" id="activate_hash" placeholder="Activate Hash" value="<?php echo $data['activate_hash']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="varchar">Status
                                    <?php echo ('status') ?></label>
                                <input type="text" class="form-control" autocomplete="off" name="status" id="status" placeholder="Status" value="<?php echo $data['status']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="varchar">Status Message
                                    <?php echo ('status_message') ?></label>
                                <input type="text" class="form-control" autocomplete="off" name="status_message" id="status_message" placeholder="Status Message" value="<?php echo $data['status_message']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="tinyint">Active
                                    <?php echo ('active') ?></label>
                                <input type="text" class="form-control" autocomplete="off" name="active" id="active" placeholder="Active" value="<?php echo $data['active']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="tinyint">Force Pass Reset
                                    <?php echo ('force_pass_reset') ?></label>
                                <input type="text" class="form-control" autocomplete="off" name="force_pass_reset" id="force_pass_reset" placeholder="Force Pass Reset" value="<?php echo $data['force_pass_reset']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="datetime">Created At
                                    <?php echo ('created_at') ?></label>
                                <input type="text" class="form-control" autocomplete="off" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $data['created_at']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="datetime">Updated At
                                    <?php echo ('updated_at') ?></label>
                                <input type="text" class="form-control" autocomplete="off" name="updated_at" id="updated_at" placeholder="Updated At" value="<?php echo $data['updated_at']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="datetime">Deleted At
                                    <?php echo ('deleted_at') ?></label>
                                <input type="text" class="form-control" autocomplete="off" name="deleted_at" id="deleted_at" placeholder="Deleted At" value="<?php echo $data['deleted_at']; ?>" />
                            </div>
                            <input id="id" class="form-control" type="text" name="id" style="display:none;" value="<?= $data['id'] ?>">

                            <div class="d-flex p-2 bd-highlight">
                                <div class="form-group">
                                    <a class="btn btn-sm btn-danger" href="<?= base_url('users') ?>">Cancel</a>
                                    <button class="btn btn-sm btn-primary" type="submit">SAVE</button>
                                </div>
                            </div>
                        </form>


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