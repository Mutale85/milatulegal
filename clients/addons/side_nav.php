<aside class="main-sidebar sidebar-light-primary elevation-4" style="background-color: #6499cd!important;">
<!-- Brand Logo -->
    <a href="clients/" class="brand-link">
        <img src="dist_old/images/MilatuIcon.png" alt="MilatuIcon.png" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light text-white">Milatulegal 2</span>
    </a>

<!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="clients/" class="d-block text-white"><?php echo getUserByPhoneNumber($connect, $_SESSION['phonenumber']) ?></a>
        </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
                </div>
            </div>
        </div>

            <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="clients/" class="nav-link active">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                        Home
                        <!-- <i class="right fas fa-angle-left"></i> -->
                        </p>
                    </a>
                </li>
            
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                        Legal Menu
                        <i class="fas fa-angle-left right"></i>
                        <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="clients/received-applications" class="nav-link text-white">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Received Applications</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="clients/find-a-lawyer" class="nav-link text-white">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Find a Lawyer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="clients/post-a-case" class="nav-link text-white">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Post a Job</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="clients/report-lawyer" class="nav-link text-white">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Report Lawyer</p>
                            </a>
                        </li>
                    </ul>
                </li>
            
            
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                        Mailbox
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="clients/received-messages" class="nav-link text-white">
                                <i class="bi bi-envelope-check nav-icon"></i>
                                <p>Inbox</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="clients/sent-messages" class="nav-link text-white">
                                <i class="bi bi-reply nav-icon"></i>
                                <p>Outbox </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <i class="nav-icon bi bi-sliders"></i>
                        <p>
                        Settings
                        <i class="bi bi-gear right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="client/" class="nav-link text-white">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="logout" class="nav-link text-white">
                                <i class="bi bi-arrow-return-left nav-icon"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                        
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
<!-- /.sidebar -->
</aside>