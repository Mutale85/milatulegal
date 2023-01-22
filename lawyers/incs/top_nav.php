<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa bi-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="bi bi-search bi-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-search bi-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                            placeholder="Search for..." aria-label="Search"
                            aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="bi bi-search bi-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Nav Item - Alerts-->
        <?php 
            $query = $connect->prepare("SELECT * FROM `table_legal_requests` WHERE hire_status = 'looking' ");
            $query->execute();
            $count = $query->rowCount();
            $result = $query->fetchAll();
        ?>
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-person-workspace bi-fw"></i> 
                 Jobs 
                <span class="badge badge-danger badge-counter"><?php echo $count?></span>
            </a>

            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Job Center
                </h6>
                <?php 
                   foreach($result as $row){
                    extract($row);   
                   
                ?>
                <a class="dropdown-item d-flex align-items-center" href="case-search-cases">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="bi bi-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500"><?php echo time_elapsed_string($datetime, true); ?></div>
                        <span class="font-weight-bold"><?php echo $case_title?></span>
                    </div>
                </a>
                <?php }?>
            </div>
        </li>
        
        <?php 
            $query = $connect->prepare("SELECT * FROM table_messages WHERE receiver_id = ? AND receiver_delete = '0' AND receiver_opened = '0' ");
            $query->execute([$_SESSION['phonenumber']]);
            $count = $query->rowCount();
                        
        ?>
        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-envelope bi-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter"><?php echo $count?></span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                    Message Center
                </h6>
                <?php 
                    if($count > 0){
                        foreach($query->fetchAll() as $row){    
                            extract($row);
                    
                ?>
                    <a class="dropdown-item d-flex align-items-center" href="read?mid=<?php echo $id?>">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                alt="...">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div class="font-weight-bold">
                            <div class="text-truncate"><?php echo $subject?></div>
                            <div class="small text-gray-500"><?php echo getUserByPhoneNumber($connect, $sender_id)?>  <?php echo time_ago_check($message_date); ?></div>
                        </div>
                    </a>
                    
                <?php
                        } 
                    }else{

                }
                ?>
                <a class="dropdown-item text-center small text-gray-500" href="received-messages">Read All Messages</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['firstname']?></span>
                <img class="img-profile rounded-circle"
                    src="img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile">
                    <i class="bi bi-person bi-sm bi-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="subscription">
                    <i class="bi bi-wallet bi-sm bi-fw mr-2 text-gray-400"></i>
                    Subscription
                </a>
                <!-- <a class="dropdown-item" href="#">
                    <i class="bi bi-list bi-sm bi-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="bi bi-arrow-right bi-sm bi-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>