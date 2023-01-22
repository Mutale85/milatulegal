<?php
    include("../includes/db.php"); 
    if(empty($_SESSION['adminEmail'])){
        header("location:../logout"); 
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include ("addons/head.php");?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'addons/side_nav.php' ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'addons/top_nav.php';?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Lawyers table</h1>
                    <p class="mb-4"> All lawyers who have created their accounts</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of lawyers</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Username</th>
                                            <th>Start date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Username</th>
                                            <th>Start date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                            $query = $connect->prepare("SELECT * FROM table_members WHERE user_type = 'lawyer' ");
                                            $query->execute();
                                            if($query->rowCount() > 0):
                                            foreach($query->fetchAll() as $row){
                                                extract($row);
                                                if($photo == null){
                                                    $src = get_gravatar($email);
                                                }else{
                                                    $src = 'lawyers/uploads/'.$photo;
                                                }

                                                if($email === null){
                                                    $mail = "";
                                                }else{
                                                    $mail = $email;
                                                }
                                        ?>
                                        <tr>
                                            <td><a href="lawyerprofile?"> <?php echo getUserByPhoneNumber($connect, $phonenumber) ?></a></td>
                                            <td><?php echo $email?></td>
                                            <td><?php echo $mail?></td>
                                            <td><?php echo $phonenumber ?></td>
                                            <td><?php echo time_ago_check($date_created) ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="<?php echo $phonenumber?>" class="btn btn-danger ban_lawyer">Ban</a>
                                                    <a href="<?php echo $phonenumber?>" class="btn btn-warning ban_lawyer">remove</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                            } 
                                            else:
                                            ?>

                                        <?php endif;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include 'addons/footer.php';?>

</body>

</html>