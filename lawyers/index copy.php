<!DOCTYPE html>
<html lang="en">

<head>

    <?php include 'incs/header.php';?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'incs/side_nav.php';?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'incs/top_nav.php';?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->


                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Earnings (Monthly)
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <!-- $40,000 -->
                                                <?php
                                                    $query = $connect->prepare("SELECT * FROM table_consultation_payment WHERE lawyer_id = ?");
                                                    $query->execute([$_SESSION['phonenumber']]);
                                                    if($query->rowCount() > 0){
                                                        $query = $connect->prepare("SELECT *, SUM(amount) AS monthly_earning FROM table_consultation_payment WHERE lawyer_id = ? AND payment_date = ?");
                                                        $query->execute([$_SESSION['phonenumber'], date("m")]);
                                                    
                                                        $row = $query->fetch();
                                                        extract($row);
                                                        $earning = $currency.' '.$monthly_earning;
                                                    }else{
                                                        $earning = 'ZMW 0.00';
                                                    }
                                                    echo $earning;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings (Annual)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php 
                                                    $total_earnings = 0;  // initialize total earnings to 0
                                                    $query = $connect->prepare("SELECT * FROM table_consultation_payment WHERE lawyer_id = ?");
                                                    $query->execute([$_SESSION['phonenumber']]);
                                                    if($query->rowCount() > 0){
                                                        // loop through the months
                                                        for ($month = 1; $month <= 12; $month++) {
                                                            $stmt = $db->prepare("SELECT *, SUM(amount) FROM table_consultation_payment WHERE lawyer_id = ? AND month = :month AND payment_date = ?");
                                                            $stmt->execute([$_SESSION['phonenumber'], date('Y')]);
                                                            // fetch the result and add it to the total
                                                            $earnings = $stmt->fetchColumn();
                                                            $total_earnings += $earnings;
                                                        }
                                                    }else{
                                                        $total_earnings = 'ZMW 0.00';
                                                    }
                                                    echo $total_earnings;

                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-wallet fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-bottom-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                Available Jobs</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php 
                                                    $query = $connect->prepare("SELECT * FROM table_legal_requests WHERE hire_status = 'hired' ");
                                                    $query->execute();
                                                    $count = $query->rowCount();
                                                    echo $count;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas bi-person-workspace fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-bottom-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Applied to Jobs</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php 
                                                    $query = $connect->prepare("SELECT * FROM table_applications WHERE lawyer_id = ? AND offer_job = '0' ");;
                                                    $query->execute([$_SESSION['phonenumber']]);
                                                    $count = $query->rowCount();
                                                    echo $count;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas bi-person-vcard fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      	
                       <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-bottom-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Current Jobs</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php 
                                                    $query = $connect->prepare("SELECT * FROM table_job_offers WHERE lawyer_id = ? ");;
                                                    $query->execute([$_SESSION['phonenumber']]);
                                                    $count = $query->rowCount();
                                                    echo $count;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas bi-person-vcard fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-bottom-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Milatu Membership</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php 
                                                    $query = $connect->prepare("SELECT * FROM table_subscriptions WHERE phonenumber = ? AND payment_status = '1'");
                                                    $query->execute([$_SESSION['phonenumber']]);
                                                    $paid = $query->rowCount();
                                                    if ($paid > 0) {
                                                        echo '<span class="text-success">Verified Member</span>';
                                                    } else {
                                                        echo '<span class="text-danger">Limited Member</span>';
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas bi-person-vcard fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'incs/footer.php';?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
    </div>
    
    <!-- Logout Modal-->
    <?php include 'incs/modal.php';?>
</body>

</html>