<?php
$uri = service('uri')->getSegments();
$uri1 = $uri[1] ?? 'index';
$uri2 = $uri[2] ?? '';
$uri3 = $uri[3] ?? '';
?>

<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <!-- Sidebar Header -->
        <?= $this->include('web/layouts/sidebar_header'); ?>

        <!-- Sidebar -->
        <div class="sidebar-menu">
            <div class="d-flex flex-column">
                <div class="d-flex justify-content-center avatar avatar-xl me-3" id="avatar-sidebar">
                    <img src="<?= base_url('media/photos/pesona_sumpu.png'); ?>" alt="" srcset="">
                </div>
                <div class="p-2 d-flex justify-content-center">Hello, Visitor</div>
                <ul class="menu">

                    <li class="sidebar-item <?= ($uri1 == 'index') ? 'active' : '' ?>">
                        <a href="/web" class="sidebar-link">
                            <i class="fa-solid fa-house"></i><span>Home</span>
                        </a>
                    </li>

                    <!-- Object -->
                    <li class="sidebar-item <?= ($uri1 == 'object1') ? 'active' : '' ?> has-sub">
                        <a href="" class="sidebar-link">
                            <i class="fa-solid fa-mountain-sun"></i><span>Agrowisata Batu Patah Payo</span>
                        </a>

                        <ul class="submenu <?= ($uri1 == 'object1') ? 'active' : '' ?>">
                            <!-- List Object -->
                            <li class="submenu-item" id="rg-list">
                                <a href="<?= base_url('/web/object'); ?>"><i class="fa-solid fa-list me-3"></i>List</a>
                            </li>

                            <!-- Object Around You -->
                            <li class="submenu-item" id="rg-around-you">
                                <a data-bs-toggle="collapse" href="#searchRadiusRG" role="button" aria-expanded="false" aria-controls="searchRadiusRG"><i class="fa-solid fa-compass me-3"></i>Around You</a>
                                <div class="collapse mb-3" id="searchRadiusRG">
                                    <label for="inputRadiusRG" class="form-label">Radius: </label>
                                    <label id="radiusValueRG" class="form-label">0 m</label>
                                    <input type="range" class="form-range" min="0" max="20" value="0" id="inputRadiusRG" name="inputRadius" onchange="updateRadius('RG');">
                                </div>
                            </li>

                            <!-- Object Search -->
                            <li class="submenu-item has-sub" id="rg-search">
                                <a data-bs-toggle="collapse" href="#subsubmenu" role="button" aria-expanded="false" aria-controls="subsubmenu" class="collapse"><i class="fa-solid fa-magnifying-glass me-3"></i>Search</a>
                                <ul class="subsubmenu collapse" id="subsubmenu">
                                    <!-- Seach by Name -->
                                    <li class="submenu-item submenu-marker" id="rg-by-name">
                                        <a data-bs-toggle="collapse" href="#searchNameRG" role="button" aria-expanded="false" aria-controls="searchNameRG"><i class="fa-solid fa-arrow-down-a-z me-3"></i>By Name</a>
                                        <div class="collapse mb-3" id="searchNameRG">
                                            <div class="d-grid gap-2">
                                                <input type="text" name="nameRG" id="nameRG" class="form-control" placeholder="Name" aria-label="Recipient's username" aria-describedby="button-addon2">
                                                <button class="btn btn-outline-primary" type="submit" id="button-addon2">
                                                    <span class="material-icons" style="font-size: 1.5rem; vertical-align: bottom">search</span>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item <?= ($uri1 == 'object2') ? 'active' : '' ?> has-sub">
                        <a href="" class="sidebar-link">
                            <i class="fa-solid fa-tree"></i><span>Other Tourism Object</span>
                        </a>

                        <ul class="submenu <?= ($uri1 == 'object1') ? 'active' : '' ?>">
                            <!-- List Object -->
                            <li class="submenu-item" id="rg-list">
                                <a href="<?= base_url('/web/object'); ?>"><i class="fa-solid fa-list me-3"></i>List</a>
                            </li>

                            <!-- Object Around You -->
                            <li class="submenu-item" id="rg-around-you">
                                <a data-bs-toggle="collapse" href="#searchRadiusRG" role="button" aria-expanded="false" aria-controls="searchRadiusRG"><i class="fa-solid fa-compass me-3"></i>Around You</a>
                                <div class="collapse mb-3" id="searchRadiusRG">
                                    <label for="inputRadiusRG" class="form-label">Radius: </label>
                                    <label id="radiusValueRG" class="form-label">0 m</label>
                                    <input type="range" class="form-range" min="0" max="20" value="0" id="inputRadiusRG" name="inputRadius" onchange="updateRadius('RG');">
                                </div>
                            </li>

                            <!-- Object Search -->
                            <li class="submenu-item has-sub" id="rg-search">
                                <a data-bs-toggle="collapse" href="#subsubmenu" role="button" aria-expanded="false" aria-controls="subsubmenu" class="collapse"><i class="fa-solid fa-magnifying-glass me-3"></i>Search</a>
                                <ul class="subsubmenu collapse" id="subsubmenu">
                                    <!-- Seach by Name -->
                                    <li class="submenu-item submenu-marker" id="rg-by-name">
                                        <a data-bs-toggle="collapse" href="#searchNameRG" role="button" aria-expanded="false" aria-controls="searchNameRG"><i class="fa-solid fa-arrow-down-a-z me-3"></i>By Name</a>
                                        <div class="collapse mb-3" id="searchNameRG">
                                            <div class="d-grid gap-2">
                                                <input type="text" name="nameRG" id="nameRG" class="form-control" placeholder="Name" aria-label="Recipient's username" aria-describedby="button-addon2">
                                                <button class="btn btn-outline-primary" type="submit" id="button-addon2">
                                                    <span class="material-icons" style="font-size: 1.5rem; vertical-align: bottom">search</span>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
            </div>
        </div>
    </div>
</div>