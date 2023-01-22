   <!DOCTYPE html>
<html lang="en">

<head>

    <?php include 'incs/header.php';
        if (isset($_GET['mid'])) {
            $mid = preg_replace("#[^0-9]#", "", $_GET['mid']);

        }
    ?>
    
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
                    <?php
                        $update = $connect->prepare("UPDATE table_messages SET receiver_opened = '1' WHERE id = ? AND receiver_id = ?");
                        $update->execute([$mid, $_SESSION['phonenumber']]);
                        $query = $connect->prepare("SELECT * FROM table_messages WHERE id = ? AND receiver_id = ? AND receiver_delete = '0' ");
                        $query->execute([$mid, $_SESSION['phonenumber']]);
                        $row = $query->fetch();
                        extract($row);

                            
                    ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Inbox</h4>
                                </div>
                                <div class="card-body">
                                    <h4 class="">From: <?php echo getUserByPhoneNumber($connect, $sender_id)?> (<?php echo $subject?>)</h4>
                                    <hr>
                                    <p><?php echo htmlspecialchars_decode($message)?></p>
                                </div>
                                <div class="card-footer">
                                    <p> <?php echo time_ago_check($message_date)?></p>
                                    <div class="btn-group">
                                        <a href="<?php echo $sender_id?>" data-client_id="<?php echo $_SESSION['phonenumber']?>" class="btn btn-primary reply_message" title="Reply to the message"><i class="bi bi-reply-all"></i></a>
                                        <a href="<?php echo $id?>" class="btn btn-danger btn-sm delete_message" title="Delete message"><i class="bi bi-trash"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Message Modal -->
                <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Reply</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" id="messageForm">
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <input type="text" name="subject" id="subject" class="form-control" required value="<?php echo $subject?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Message</label>
                                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                        <input type="hidden" name="sender_id" id="sender_id">
                                        <input type="hidden" name="receiver_id" id="receiver_id">
                                        <input type="hidden" name="parent_id" id="parent_id" value="<?php echo $id?>">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="sendBtn">Send Message</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Message Modal -->
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

            $(document).on("click", ".reply_message", function(e){
                e.preventDefault();
                var receiver_id = $(this).attr("href");
                var sender_id = $(this).data("client_id");
                document.getElementById('sender_id').value = sender_id;
                document.getElementById('receiver_id').value = receiver_id;

                $("#messageModal").modal("show");

                $("#sendBtn").click(function(){
                    var message = document.getElementById('message');
                    const subject = document.getElementById('subject');
                    if(subject.value === ""){
                        alert("Pleaser write your subject");
                        subject.focus();
                        return false;
                    }
                    if(message.value === ""){
                        alert("Pleaser write your message");
                        message.focus();
                        return false;
                    }
                    var messageForm = document.getElementById(messageForm);
                    var data = $("#messageForm").serialize();
                    $.ajax({
                        url:"processor/replyMessage",
                        method:"post",
                        data:data,
                        beforeSend:function(){
                            $("#sendBtn").html("<span class='spinner-grow spinner-grow-sm'></span> Sending...");
                        },
                        success:function(data){
                            alert(data);
                            $("#messageForm")[0].reset();
                            $("#sendBtn").html("Send Message");
                        }
                    })
                })
            })
    
        })
    </script>

</body>

</html>