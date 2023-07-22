<?php
$uri = service('uri')->getSegments();
$uri1 = $uri[1] ?? 'index';
$uri2 = $uri[2] ?? '';
$uri3 = $uri[3] ?? '';
?>

<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <?= $this->include('web/layouts/sidebar_header'); ?>
        <div class="sidebar-menu">
            <div class="d-flex flex-column">
                <div class="d-flex justify-content-center avatar avatar-xl me-3" id="avatar-sidebar">
                    <img src="<?= base_url('media/photos/dwpayo.png'); ?>" alt="" srcset="">
                </div>
                <div class="p-2 d-flex justify-content-center">Hello, Visitor</div>
                <ul class="menu">
                    <li class="sidebar-item">
                        <a class="btn btn-danger" href="<?php echo site_url('logout') ?>">Log out</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>