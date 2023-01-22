<ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../">
        <div class="sidebar-brand-icon ">
             <img src="../dist/images/MilatuIcon.png" class="Icon img-fluid shadow" alt="Icon" width="40">
        </div>
        <div class="sidebar-brand-text mx-3">Milatu <sup>1</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="./">
            <i class="bi bi-fw bi-tachometer-alt"></i>
            <span>Dashboard</span></a>
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
                <h6 class="collapse-header">Custom Profile:</h6>
                <a class="collapse-item" href="profile">Profile</a>
                <!-- <a class="collapse-item" href="cards.html">Cards</a> -->
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMessages"
            aria-expanded="true" aria-controls="collapseMessages">
            <i class="bi bi-fw bi-envelope" style="font-size: 1.2rem;"></i>
            <span>Mailbox</span>
        </a>
        <div id="collapseMessages" class="collapse" aria-labelledby="headingMessages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">All Messages</h6>
                <a class="collapse-item" href="received-messages">Inbox</a>
                <a class="collapse-item" href="sent-messages">Outbox</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="bi bi-fw bi-folder" style="font-size: 1.2rem;"></i>
            <span>Legalities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Cases:</h6>
                <a class="collapse-item" href="case-search-cases">Available Cases</a>
                <a class="collapse-item" href="case-applied-to">Applications</a>
                <a class="collapse-item" href="case-active-cases">Active Cases</a>
                <!-- <a class="collapse-item" href="case-completed-cases">Completed Cases</a> -->
                <!-- <a class="collapse-item" href="case-pending-cases">Pending Cases</a> -->
                
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="bi bi-gear bi-arrow-left-circle" style="font-size: 1.2rem;"></i>
            <span>Settings</span>
        </a>
        
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Login Screens:</h6> -->
                <a class="collapse-item" href="subscription">Subscription</a>
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