<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-secondary d-md-none rounded-circle mr-3">
        <i class="bi bi-list"></i>
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

        <!-- Nav Item - Messages -->
        <?php 
            $query = $connect->prepare("SELECT * FROM table_applications WHERE client_id = ? AND client_opened = '0' ");
            $query->execute([$_SESSION['phonenumber']]);
            $count = $query->rowCount();
            $result = $query->fetchAll();
        ?>
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="received-applications" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-bell bi-fw"></i>
                 Job - Alerts 
                <span class="badge badge-danger badge-counter"><?php echo $count?></span>
            </a>

            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Alerts Center
                </h6>
                <?php 
                    foreach($result as $row){
                      extract($row);
                ?>
                <a class="dropdown-item d-flex align-items-center" href="application?apid=<?php echo $id?>">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="bi bi-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500"><?php echo date("j F Y", strtotime($date_applied))?></div>
                        <span class="font-weight-bold"><?php echo getLegalRequestName($connect, $case_id)?></span>
                    </div>
                </a>
                <?php }?>
                
                <a class="dropdown-item text-center small text-gray-500" href="received-applications">Show Job Application Alerts</a>
            </div>
        </li>
        <?php 
            function getReceiverIdByPhone($connect, $phonenumber){
                $query = $connect->prepare("SELECT * FROM table_legal_requests WHERE phonenumber = ? ");
                $query->execute([$phonenumber]);
                $row = $query->fetch();
                extract($row);
                return $id;
            }
            $query = $connect->prepare("SELECT * FROM `table_messages` WHERE receiver_id = ? AND receiver_opened = '0' ");
            $receiver_id = getReceiverIdByPhone($connect, $_SESSION['phonenumber']);
            $query->execute([$_SESSION['phonenumber']]);
            $count = $query->rowCount();
            $result = $query->fetchAll();
        ?>
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
                    foreach($result as $row){
                        extract($row);
                        $sender = getUserByPhoneNumber($connect, $sender_id);
                ?>
                    <a class="dropdown-item d-flex align-items-center" href="read?mid=<?php echo $id?>">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                alt="...">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div class="font-weight-bold">
                            <div class="text-truncate"><?php echo $subject ?></div>
                            <div class="small text-gray-500"><?php echo $sender?> · <?php echo time_ago_check($message_date)?></div>
                        </div>
                    </a>
                <?php }?>
                <a class="dropdown-item text-center small text-gray-500" href="received-messages">Read More Messages</a>
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
                <!-- <a class="dropdown-item" href="#">
                    <i class="bi bi-cogs bi-sm bi-fw mr-2 text-gray-400"></i>
                    Settings
                </a> -->
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