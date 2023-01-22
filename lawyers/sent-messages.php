<?php include("../includes/db.php")?>
<?php include("../includes/base.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php 
    include("addons/header.php");
  ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include("addons/top_nav.php")?>

        <?php include("addons/side_nav.php")?>

        <div class="content-wrapper">
            <?php include("addons/content_head.php")?>
        
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h1 class="h4 mb-0 text-black-800 text-centers">Sent Messages</h1>
                                </div>
                                <div class="card-body">
                                    
                                    <div class="table table-responsiv">
                                        <table class="table table-bordered" id="messageTable" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                    $query = $connect->prepare("SELECT * FROM table_messages WHERE sender_id = ? AND sender_delete = '0' ");
                                                    $query->execute([$_SESSION['phonenumber']]);
                                                    foreach ($query->fetchAll() as $row) {
                                                        extract($row);
                                                        if($message_status == 0){
                                                            $message_status = '<span class="btn btn-warning"><i class="bi bi-envelope"></i></span>  <a href="'.$id.'" class="btn btn-primary btn-sm see_message"> Read</a> ';
                                                        }else{
                                                            $message_status = '<span class="text-success btn btn-success"><i class="bi bi-envelope-open"></i></span>  <a href="'.$id.'" class="btn btn-primary btn-sm see_message"> Read</a> ';
                                                        }
                                                ?>
                                                <tr>
                                                    
                                                    <td><?php echo getUserByPhoneNumber($connect, $receiver_id)?></td>
                                                    <th><a href="read?mid=<?php echo $id?>"><?php echo $subject?></a></th>
                                                    <td><?php echo time_ago_check($message_date)?></td>
                                                    <td><a href="<?php echo $id?>" class="btn btn-danger btn-sm delete_message"><i class="bi bi-trash"></i></a></td>
                                                </tr> 
                                                <?php 
                                                    }

                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Message Modal -->
                    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Message Potential Client</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <span id="messageSpan"></span>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Message Modal -->

                </div>
            </section>
        </div>
        <?php include("addons/footer.php")?>
    
    </div>
    <?php include("addons/footerjs.php")?>
    <script>
        $(function(){
            $(document).on("click", ".delete_message", function(e){
                e.preventDefault();
                var message_id = $(this).attr("href");
                if(confirm("You wish to delete the message you sent.")){
                    $.ajax({
                        url:"lawyers/processor/senderDeleteMessage",
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
                    url:"lawyers/processor/seeMessage",
                    method:"post",
                    data:{message_id:message_id},
                    
                    success:function(data){
                        $("#messageSpan").html(data);
                    }
                })
            })
    
        })

        $(document).ready(function () {
            $('#messageTable').DataTable();
        });
    </script>

</body>

</html>