<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        include ("incFiles/control_header.php");

        if (isset($_GET['mid'])) {
            $mid = preg_replace("#[^0-9]#", "", $_GET['mid']);

        }
    ?>
    
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include("incFiles/side_nav.php")?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include 'incFiles/top_nav.php';?>
                <!-- End of Topbar -->
                 
                <!-- Begin Page Content -->
                
                <div class="container-fluid">
                    <?php

                        $query = $connect->prepare("SELECT * FROM table_messages WHERE id = ? AND sender_id = ? AND sender_delete = '0' ");
                        $query->execute([$mid, $_SESSION['phonenumber']]);
                        $row = $query->fetch();
                        extract($row);
                            
                    ?>
                    
                        
                                     
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Sent Message</h4>
                                    
                                </div>
                                <div class="card-body">
                                    <h5 class="">To <?php echo getUserByPhoneNumber($connect, $receiver_id)?> (<?php echo $subject?>)</h5>
                                    <hr>
                                    <p><?php echo htmlspecialchars_decode($message)?></p>
                                </div>
                                <div class="card-footer">
                                    <p> <?php echo time_ago_check($message_date)?> | <a href="<?php echo $id?>" class="btn btn-danger btn-sm delete_message"><i class="bi bi-trash"></i></a></p>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'incFiles/footer.php';?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    <!-- Logout Modal-->
    <?php include 'incFiles/modal.php';?>

    <script>
        $(document).ready(function () {
            $('#messageTable').DataTable();
        });
        $(function(){
            $(document).on("click", ".delete_message", function(e){
                e.preventDefault();
                var message_id = $(this).attr("href");
                if(confirm("You wish to delete the message you sent.")){
                    $.ajax({
                        url:"processor/senderDeleteMessage",
                        method:"post",
                        data:{message_id:message_id},
                        
                        success:function(data){
                            alert(data);
                            window.reload();
                        }
                    })
                }else{
                    return false;
                }
            });

            $(document).on("click", ".see_message", function(e){
                e.preventDefault();
                var message_id = $(this).attr("href");
                

                $("#messageModal").modal("show");

                $.ajax({
                    url:"processor/seeMessage",
                    method:"post",
                    data:{message_id:message_id},
                    
                    success:function(data){
                        $("#messageSpan").html(data);
                    }
                })
            })
    
        })
    </script>

</body>

</html>