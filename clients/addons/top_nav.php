<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist_old/images/MilatuIcon.png" alt="MilatuIcon" height="60" width="60">
</div>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
<!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="clients/" class="nav-link">Home</a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
            <form class="form-inline">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                </button>
                </div>
            </div>
            </form>
        </div>
        </li>

        <!-- Messages Dropdown Menu -->
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
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge"><?php echo $count?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <?php 
                    foreach($result as $row){
                        extract($row);
                        $sender = getUserByPhoneNumber($connect, $sender_id);
                ?>
                    <a href="clients/read?mid=<?php echo $id?>" class="dropdown-item">
                    <!-- Message Start -->
                        <div class="media">
                            <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                            <h3 class="dropdown-item-title">
                                <?php echo $sender?>
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm"><?php echo $subject ?></p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?php echo time_ago_check($message_date)?></p>
                            </div>
                        </div>
                    <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                <?php }?>
                <a href="clients/received-messages" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <?php 
            $query = $connect->prepare("SELECT * FROM table_applications WHERE client_id = ? AND client_opened = '0' ");
            $query->execute([$_SESSION['phonenumber']]);
            $count = $query->rowCount();
            $result = $query->fetchAll();
        ?>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge"><?php echo $count?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header"><?php echo $count?> Notifications</span>
                <?php 
                    foreach($result as $row){
                      extract($row);
                ?>
                    <div class="dropdown-divider"></div>
                        <a href="clients/application?apid=<?php echo $id?>" class="dropdown-item">
                            <?php echo getLegalRequestName($connect, $case_id)?>
                            <span class="float-right text-muted text-sm"><?php echo time_ago_check($date_applied)?></span>
                        </a>
                        
                    <div class="dropdown-divider"></div>
                <?php }?>
                
                <div class="dropdown-divider"></div>
                <a href="clients/received-applications" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>