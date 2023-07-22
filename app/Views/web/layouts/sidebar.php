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
                <div class="p-2 d-flex justify-content-center">Hello, Admin</div>
                <ul class="menu">

                    <!-- <li class="sidebar-item <?= ($uri1 == '') ? 'active' : '' ?>">
                        <a href="/villages" class="sidebar-link">
                            <i class="fa-solid fa-house"></i><span>Village</span>
                        </a>
                    </li> -->
                    <!-- 
                    <li class="sidebar-item <?= ($uri1 == '') ? 'active' : '' ?>">
                        <a href="/web" class="sidebar-link">
                            <i class="fa-solid fa-door-open"></i><span>Explore</span>
                        </a>
                    </li> -->
                    <li class="sidebar-item <?= ($uri1 == 'object5') ? 'active' : '' ?> has-sub">
                        <a href="" class="sidebar-link">
                            <i class="fa-solid fa-mountain-sun"></i><span>Tourism</span>
                        </a>

                        <ul class="submenu <?= ($uri1 == 'object5') ? 'active' : '' ?>">
                            <!-- List Object -->
                            <li class="submenu-item" id="rg-list">
                                <a href="<?= base_url('/tourism_object'); ?>"><i class="fa-solid fa-tree me-3"></i>Tourism Object</a>
                            </li>
                            <li class="submenu-item" id="rg-list">
                                <a href="<?= base_url('/tourism_facility'); ?>"><i class="fa-solid fa-list me-3"></i>Tourism Facility</a>
                            </li>


                        </ul>
                    </li>
                    <li class="sidebar-item" id="rg-list">
                        <a href="<?= base_url('/worship_place'); ?>" class="sidebar-link">
                            <i class="fa-solid fas fa-place-of-worship"></i><span>Worship</span>
                        </a>
                    </li>
                    <li class="sidebar-item" id="rg-list">
                        <a href="<?= base_url('/culinary'); ?>" class="sidebar-link">
                            <i class="fa-solid fas fa-hamburger"></i><span>Culinary</span>
                        </a>
                    </li>


                    <!-- <li class="sidebar-item <?= ($uri1 == 'object1') ? 'active' : '' ?> has-sub">
                        <a href="" class="sidebar-link">
                            <i class="fa-solid fas fa-utensils"></i><span>Culinary</span>
                        </a>

                        <ul class="submenu <?= ($uri1 == 'object1') ? 'active' : '' ?>">
                            List Object -->
                    <!-- <li class="submenu-item" id="rg-list">
                                <a href="<?= base_url('/culinary'); ?>"><i class="fa-solid fas fa-hamburger me-3"></i>Culinary</a>
                            </li>
                            <li class="submenu-item" id="rg-list">
                                <a href="<?= base_url('/culinary_facility'); ?>"><i class="fa-solid fas fa-list me-3"></i>Culinary Facility</a>
                            </li>

                        </ul>
                    </li> -->

                    <li class="sidebar-item <?= ($uri1 == 'object3') ? 'active' : '' ?> has-sub">
                        <a href="" class="sidebar-link">
                            <i class="fa-solid fa-bullhorn"></i><span>Event</span>
                        </a>

                        <ul class="submenu <?= ($uri1 == 'object3') ? 'active' : '' ?>">
                            <!-- List Object -->
                            <li class="submenu-item" id="rg-list">
                                <a href="<?= base_url('/event'); ?>"><i class="fa-solid fa-certificate me-3"></i>Event</a>
                            </li>
                            <li class="submenu-item" id="rg-list">
                                <a href="<?= base_url('/event_category'); ?>"><i class="fa-solid fa-list me-3"></i>Event Category</a>
                            </li>




                        </ul>
                    </li>


                    <li class="sidebar-item" id="rg-list">
                        <a href="<?= base_url('/souvenir_place'); ?>" class="sidebar-link">
                            <i class="fa-solid fa-gift "></i><span>Souvenir Place</span></a>
                    </li>


                    <!-- <li class="sidebar-item <?= ($uri1 == 'object6') ? 'active' : '' ?> has-sub">
                        <a href="" class="sidebar-link">
                            <i class="fa-solid fa-gifts"></i><span>Souvenir</span>
                        </a>

                        <ul class="submenu <?= ($uri1 == 'object6') ? 'active' : '' ?>">
                            
                            <li class="submenu-item" id="rg-list">
                                <a href="<?= base_url('/souvenir_place'); ?>"><i class="fa-solid fa-gift me-3"></i>Souvenir Place</a>
                            </li>

                            <li class="submenu-item" id="rg-list">
                                <a href="<?= base_url('/souvenir_facility'); ?>"><i class="fa-solid fa-list me-3"></i>Souvenir Facility</a>
                            </li>

                        </ul>
                    </li> -->

                    <li class="sidebar-item <?= ($uri1 == 'object6') ? 'active' : '' ?> has-sub">
                        <a href="" class="sidebar-link">
                            <i class="fa-solid fa-bed"></i><span>Homestay</span>
                        </a>

                        <ul class="submenu <?= ($uri1 == 'object6') ? 'active' : '' ?>">
                            <!-- List Object -->
                            <li class="submenu-item" id="rg-list">
                                <a href="<?= base_url('/homestay'); ?>"><i class="fa-solid fa-house-flag me-3"></i>Homestay</a>
                            </li>

                            <li class="submenu-item" id="rg-list">
                                <a href="<?= base_url('/homestay_facility'); ?>"><i class="fa-solid fa-list me-3"></i>Homestay Facility</a>
                            </li>




                        </ul>
                    </li>
                    <li class="sidebar-item <?= ($uri1 == '') ? 'active' : '' ?>">
                        <a href="/package" class="sidebar-link">
                            <i class="fa-solid fa-clipboard-list"></i><span>Package</span>
                        </a>
                    </li>

                    <li class="sidebar-item <?= ($uri1 == '') ? 'active' : '' ?>">
                        <a href="/booking" class="sidebar-link">
                            <i class="fa-solid fa-cart-arrow-down"></i><span>Book Package</span>
                        </a>
                    </li>




                    <!-- <li class="sidebar-item <?= ($uri1 == 'object6') ? 'active' : '' ?> has-sub">
                        <a href="" class="sidebar-link">
                            <i class="fa-solid fa-bed"></i><span>Package Pages</span>
                        </a>

                        <ul class="submenu <?= ($uri1 == 'object6') ? 'active' : '' ?>">
                            
                    <li class="submenu-item" id="rg-list">
                        <a href="<?= base_url('/package/create_all'); ?>"><i class="fa-solid fa-house-flag me-3"></i>Create</a>
                    </li>

                    <li class="submenu-item" id="rg-list">
                        <a href="<?= base_url('/package'); ?>"><i class="fa-solid fa-list me-3"></i>Edit</a>
                    </li>

                </ul>
                </li> -->


                    <!-- <li class="sidebar-item <?= ($uri1 == 'object7') ? 'active' : '' ?>">
                        <a href="<?= base_url('/users'); ?>" class="sidebar-link">
                            <i class="fa-solid fa-user-alt"></i><span>User</span>
                        </a>
                    </li> -->

                    <!-- <li class="sidebar-item <?= ($uri1 == 'object2') ? 'active' : '' ?> has-sub">
                        <a href="" class="sidebar-link">
                            <i class="fa-solid fa-tree"></i><span>Other Tourism Object</span>
                        </a>

                        <ul class="submenu <?= ($uri1 == 'object1') ? 'active' : '' ?>">
                        
                            <li class="submenu-item" id="rg-list">
                                <a href="<?= base_url('/web/object'); ?>"><i class="fa-solid fa-list me-3"></i>List</a>
                            </li>

                            
                            <li class="submenu-item" id="rg-around-you">
                                <a data-bs-toggle="collapse" href="#searchRadiusRG" role="button" aria-expanded="false" aria-controls="searchRadiusRG"><i class="fa-solid fa-compass me-3"></i>Around You</a>
                                <div class="collapse mb-3" id="searchRadiusRG">
                                    <label for="inputRadiusRG" class="form-label">Radius: </label>
                                    <label id="radiusValueRG" class="form-label">0 m</label>
                                    <input type="range" class="form-range" min="0" max="20" value="0" id="inputRadiusRG" name="inputRadius" onchange="updateRadius('RG');">
                                </div>
                            </li>

                            
                            
                            <li class="submenu-item has-sub" id="rg-search">
                                <a data-bs-toggle="collapse" href="#subsubmenu" role="button" aria-expanded="false" aria-controls="subsubmenu" class="collapse"><i class="fa-solid fa-magnifying-glass me-3"></i>Search</a>
                                <ul class="subsubmenu collapse" id="subsubmenu">
                                    

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
                    </li> -->
                    <li class="sidebar-item">
                        <a href="/logout" class="sidebar-link">
                            <i class="fa-solid fa-sign-out"></i><span>Logout</span>

                        </a>
                    </li>
            </div>
        </div>
    </div>
</div>