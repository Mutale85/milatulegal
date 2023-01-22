<?php include("../includes/db.php")?>
<?php include("../includes/base.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php 
    include("addons/header.php");
    $phonenumber = $_SESSION['phonenumber'];
    $lawyer_id =  $_SESSION['userId'];
    $lawyer_email = $_SESSION['userEmail'];
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
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-md-12">
                            <?php

                                $query = $connect->prepare("SELECT * FROM table_legal_requests WHERE hire_status = 'looking' ");
                                $query->execute();
                                foreach ($query->fetchAll() as $row) {
                                    extract($row);
                            ?>
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="card-title "><?php echo $case_title?></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            
                                            <div class="col-md-8">
                                                <table class="table">
                                                    <tr>
                                                        <th>Date Posted: </th>
                                                        <td><?php echo date("j F Y: H:i:s", strtotime($date_created))?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Project Location</th>
                                                        <td><?php echo getTown($connect, $town)?>, <?php echo getProvince($connect, $province);?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Payment Preference</th>
                                                        <td><?php echo $payment_mode?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Lawyer Type</th>
                                                        <td><?php echo $lawyer_type?></td>
                                                    </tr>
                                                </table>
                                                <h4 class="text-primary">Project Details</h4>
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <th>Project Description</th>
                                                        <td><?php echo htmlspecialchars_decode($description)?></td>
                                                    </tr>
                                                    
                                                </table>
                                            </div>
                                            <div class="col-md-4">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <?php 
                                                            // $query = $connect->prepare("SELECT * FROM `table_subscriptions` WHERE phonenumber = ? AND payment_status = '1'");
                                                            // $query->execute([$phonenumber]);
                                                            // $check = $query->rowCount();
                                                            // if($check > 0){
                                                            //     //paid up member
                                                                
                                                            
                                                        ?>
                                                            <td><a href="<?php echo $phonenumber?>" id="<?php echo $id?>" data-client_id="<?php echo $phonenumber?>" data-lawyer_id="<?php echo $_SESSION['phonenumber']?>" class="btn btn-primary apply_now">Apply Now</a></td>
                                                        <?php 
                                                        // }else{
                                                        ?>
                                                                <!--<td>-->
                                                                <!--    <button id="<?php echo $id?>" data-lawyer_id="<?php echo $_SESSION['phonenumber']?>" class="btn btn-primary " disabled>Apply Now</button><br>-->
                                                                <!--    <i>Subscribe to apply</i>-->
                                                                <!--</td>-->
                                                        <?php 
                                            
                                                        // }
                                                        ?>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer"></div>
                                </div>
                                
                            <?php 
                                }
                            ?>
                        </div>
                    </div>
                    <!-- Message Modal -->
                    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Message Potential Client</h5>
                                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">x</button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" id="messageForm">
                                        <div class="form-group">
                                            <label>Subject</label>
                                            <input type="text" name="subject" id="subject" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Message</label>
                                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                            <input type="hidden" name="sender_id" id="sender_id">
                                            <input type="hidden" name="receiver_id" id="receiver_id">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="sendBtn">Send Message</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Message Modal -->

                    <!-- Apply for the Job -->
                    <div class="modal fade" id="applicationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form method="post" id="clientsForm">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Apply Now</h5>
                                        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">x</button>
                                    </div>
                                    <div class="modal-body">
                                    
                                        <div class="row">
                                            <label class="col-md-4">Introduction</label>
                                            <div class="form-group col-md-8">
                                                <textarea class="form-control" id="introduction" name="introduction" rows="5" placeholder="Introduce yourself and what you can do" required></textarea>
                                                <input type="hidden" name="case_id" id="case_id">
                                                <input type="hidden" name="client_id" id="client_id">
                                                <input type="hidden" name="lawyer_id" id="lawyer_id">

                                            </div>
                                            <label class="col-md-4 mb-3">Costings</label>
                                            <div class="form-group col-md-8">
                                                <textarea class="form-control" id="costing" name="costing" rows="5" placeholder="State how much will this job cost"></textarea>
                                            </div>
                                            <label class="col-md-4">Attachment</label>
                                            
                                            <div class="form-group col-md-8">
                                                <input type="file" name="attachment" id="attachment" class="form-control">
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success" id="applyBtn">Submit Application</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End of Application -->
                </div>
            </section>
        </div>
        <?php include("addons/footer.php")?>
    
    </div>
    <?php include("addons/footerjs.php")?>
    <script>
        $(function(){
            $(document).on("click", ".message_client", function(e){
                e.preventDefault();
                var receiver_id = $(this).attr("href");
                var sender_id = $(this).attr("id");
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
                        url:"clients/processor/messageClient",
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
            });

            $(document).on("click", ".apply_now", function(e){
                e.preventDefault();
                $("#applicationModal").modal("show");
                var case_id = $(this).attr("id");
                var client_id = $(this).attr("href");
                var lawyer_id = $(this).data("lawyer_id");
                document.getElementById('lawyer_id').value = lawyer_id;
                document.getElementById('case_id').value = case_id;
                document.getElementById('client_id').value = client_id;
                $("#clientsForm").submit(function(e){
                    
                    e.preventDefault();
                    var clientsForm = document.getElementById('clientsForm');
                    var data = new FormData(clientsForm);
                    // var url = 'includes/customerSubmit';

                    $.ajax({
                        url:"clients/processor/applyNow",
                        method:"post",
                        data:data,
                        cache : false,
                        processData: false,
                        contentType: false,
                        beforeSend:function(){
                            $("#applyBtn").html("<span class='spinner-grow spinner-grow-sm'></span> Sending...");
                        },
                        success:function(data){
                            successNow(data);
                            $("#applyBtn").html("Submit Application");
                        }
                    })
                })
                
            })
        })
    </script>

</body>

</html>