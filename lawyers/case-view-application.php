<!DOCTYPE html>
<html lang="en">

<head>

    <?php include 'incs/header.php';?>
    <style>
        .letter {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding: 30px;
            margin: 20px;
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            font-size: 20px;
            margin: 0;
        }
        .header h2 {
            font-size: 16px;
            margin: 0;
            color: #666;
        }
        .body {
            margin-top: 20px;
        }
        @media (max-width: 600px) {
            .letter {
                box-shadow: none;
                padding: 15px;
            }
            .header h1 {
                font-size: 18px;
            }
            .header h2 {
                font-size: 14px;
            }
        }
    </style>
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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Welcome <?php echo $_SESSION['firstname'];?></h1>
                    </div>

                    <!-- Content Row -->
                    <?php
                        if (isset($_GET['apid'])) {
                            $apid = preg_replace("#[^0-9+]#", "", $_GET['apid']);

                        }
                        $update = $connect->prepare("UPDATE table_applications SET seen_status = '1' WHERE id = ? ");
                        $update->execute([$apid]);

                        $query = $connect->prepare("SELECT * FROM table_applications WHERE id = ? ");
                        $query->execute([$apid]);
                        $row = $query->fetch();
                        extract($row);
                         

                        if($offer_job == '0'){
                            $btn = '<a href="'.$id.'" class="btn btn-primary withdraw_application" data-client_id="'.$client_id.'"  data-lawyer_id="'.$lawyer_id.'">Withdraw Application</a>';
                        }else{
                            $btn = '<a href="'.$id.'" class="btn btn-primary withdraw_application" data-client_id="'.$client_id.'"  data-lawyer_id="'.$lawyer_id.'">Withdraw Application</a>';
                        }   
                    ?>               
                    <div class="row">
                        <div class="col-md-12">
                            <div class="letter">
                                <div class="header">
                                    <h1>Dear <?php echo getUserByPhoneNumber($connect, $client_id)?>,</h1>
                                    
                                </div>
                                <div class="body">
                                    <p><?php echo htmlspecialchars_decode($introduction) ?></p>
                                    <p><?php echo htmlspecialchars_decode($costing) ?></p>
                                    
                                    <p>Thank you for considering my offer of legal representation. I look forward to the opportunity to work with you and help you achieve a favorable resolution to your case.</p>
                                    <p>Sincerely,<br><?php echo getUserByPhoneNumber($connect, $lawyer_id)?></p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <?php echo $btn?>
                            </div>
                        </div>
                    </div>
                
                

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
    <!-- End of Page Wrapper -->


    <!-- Logout Modal-->
    <?php include 'incs/modal.php';?>

</body>

</html>