<?php

include("../api/dbcon.php");
include("../api/auth.php");
$role = $_SESSION["role"];

?>
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./" class="text-nowrap logo-img p-3">
                <img src="./static/images/logos/logo.png" width="100" alt="IDBS Logo" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Main Menu</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./index.php" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./donor-profile.php" aria-expanded="false">
                        <span>
                            <i class="ti ti-user-plus"></i>
                        </span>
                        <span class="hide-menu">Donor's Profile</span>
                    </a>
                </li>
                 <li class="sidebar-item">
                    <a class="sidebar-link" href="./student-profile.php" aria-expanded="false">
                        <span>
                            <i class="ti ti-user-plus"></i>
                        </span>
                        <span class="hide-menu">Student's Profile</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="./donation-options.php" aria-expanded="false">
                        <span>
                            <i class="ti ti-paper-bag-off"></i>
                        </span>
                        <span class="hide-menu">Donation Options</span>
                    </a>
                </li>


                 <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">REPORT</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./items.php" aria-expanded="false">
                        <span>
                            <i class="ti ti-bookmark"></i>
                        </span>
                        <span class="hide-menu">Items</span>
                    </a>
                </li>

                <?php
                    if ($role == "1") {
                    ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./students-list.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="hide-menu">Student's Directory</span>
                            </a>
                        </li>
                    <?php
                    }
                ?>

                 <?php
                    if ($role == "1") {
                    ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./donors-list.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="hide-menu">Donor's Directory</span>
                            </a>
                        </li>
                    <?php
                    }
                ?>


                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Valuables</span>
                </li>
                 <?php
                    if ($role == "0") {
                    ?>
                         <li class="sidebar-item">
                            <a class="sidebar-link" href="./item-reg.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-git-pull-request"></i>
                                </span>
                                <span class="hide-menu">Register Item</span>
                            </a>
                        </li>
                    <?php
                    }
                ?>

                <?php
                    if ($role == "1") {
                    ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./checkin.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-paper-bag"></i>
                                </span>
                                <span class="hide-menu">Item Check-in</span>
                            </a>
                        </li>
                    <?php
                    }
                ?>
                
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>