<ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="profile">
        <div class="sidebar-brand-icon ">
            <!-- <i class="bi bi-hdd-stack"></i> -->
            <img src="../dist/images/MilatuIcon.png" class="Icon img-fluid shadow" alt="Icon" width="40">
        </div>
        <div class="sidebar-brand-text mx-3">Milatu <sup>1</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="profile">
            <i class="bi bi-fw bi-tachometer-alt"></i>
            <span>Client's Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="bi bi-fw bi-person" style="font-size: 1.2rem;"></i>
            <span>Profile</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Your Profile:</h6>
                <a class="collapse-item" href="profile">My Profile</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="bi bi-fw bi-folder" style="font-size: 1.2rem;"></i>
            <span>Legal Menu</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Your Choice:</h6> -->
                <a class="collapse-item" href="find-a-lawyer">Find a Lawyer</a>
                <a class="collapse-item" href="post-a-case">Post a Job</a>
                <a class="collapse-item" href="complaints-lawyer">Complaints</a>
                <!-- <a class="collapse-item" href="saved-lawyers">Lawyers Saved </a> -->
                <a class="collapse-item" href="received-applications">Received Applications</a>
                <!-- <a class="collapse-item" href="saved-lawyers">Shared Files </a> -->
            </div>
        </div>
    </li>
   
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseComms"
            aria-expanded="true" aria-controls="collapseComms">
            <i class="bi bi-fw bi-envelope" style="font-size: 1.2rem;"></i>
            <span>Mail Box</span>
        </a>
        <div id="collapseComms" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Comms:</h6>
                <a class="collapse-item" href="received-messages">Inbox</a>
                <a class="collapse-item" href="sent-messages">Outbox</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="bi bi-fw bi-sliders" style="font-size: 1.2rem;"></i>
            <span>Settings</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Settings:</h6>
                
                <a class="collapse-item" href="../logout">Logout</a>
                
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>