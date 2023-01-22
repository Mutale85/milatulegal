<?php include("addons/body_top.php")?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <?php 
                        if(isset($_GET['lawyer-apid'])){
                            $lawyer_id = base64_decode($_GET['lawyer-apid']);
                    ?>
                        <div class="card-header">
                            <h4 class="card-title"><?php echo getUserByPhoneNumber($connect, $lawyer_id)?>'s Profile</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            
                            
                                $query = $connect->prepare("SELECT * FROM table_3_lawyer_profile WHERE phonenumber = ?");
                                $query->execute([$lawyer_id]);
                                if($query->rowCount() > 0){
                                    $row = $query->fetch();
                                    extract($row);
                                    
                                    $query = $connect->prepare("SELECT * FROM table_members WHERE email = ?");
                                    $query->execute([$email]);
                                    $rows = $query->fetch();
                                    
                                    if($rows['photo'] == null){
                                        $src = get_gravatar($email);
                                    }else{
                                        $src = 'lawyers/uploads/'.$rows['photo'];
                                    }
                                    ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <img src="<?php echo $src ?>" class="img-fluid rounded-circle" alt="userImage" style="width: 120px;height: 120px; border-radius: 50%;">

                                                            </div>
                                                            <div class="col-md-5 mb-3">
                                                                <ul class="list-group">
                                                                    <li class="list-group-item"><?php echo $firstname?> <?php echo $lastname?></li>
                                                                    <li class="list-group-item"><?php echo $phonenumber?></li> 
                                                                    <li class="list-group-item"><?php echo $email?></li> 
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <h4>Rates </h4>
                                                                <p><small>Hourly Rate: <?php echo $currency?> <?php echo $hourly_rate?></small></p>
                                                                <p><small>Fixed Rate: <?php echo $currency?> <?php echo $fixed_rate?></small></p>
                                                                <p><small>Consultation Rate: <?php echo $currency?> <?php echo $consultation_rate ?></small></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <h4>About:</h4>
                                                <p><?php echo $about_me?></p>
                                            </div>
                                            
                                            <div class="col-md-12 mb-5">
                                                <h4>Area of Law and Practice:</h4>
                                                <p><b><?php echo $area_of_law?></b></p>
                                                <p><?php echo $practice?></p>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <h4>Jurisdiction</h4>
                                                <p><?php echo $jurisdiction?></p>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <h4>Employment History </h4>
                                                <p>Firm: <?php echo $firm?></p>
                                                <p>Period: <?php echo $period_of_work?></p>
                                                <p>Roles: </p>
                                                <p><?php echo $roles?></p>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <h4>Education History </h4>
                                                <p>Qualification: <?php echo $qualification?></p>
                                                <p>School: <?php echo $institution?></p>
                                                <p>Year of graduation: <?php echo date("j F Y", strtotime($graduation_date))?></p>
                                            </div>
                                        </div>
                                    <?php       
                                }else{
                        ?>
                                <p>The lawyer has not yet added there profile</p>
                        <?php }
                            }else{
                                header("location:clients/");
                            }
                        ?>
                        
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo $phonenumber?>" data-client_id="<?php echo $_SESSION['phonenumber']?>" class="btn btn-secondary message_lawyer">Message Lawyer</a> 
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
                    <h5 class="modal-title" id="exampleModalLabel">Message Lawyer</h5>
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
                        <!-- <div class="form-group">
                            <label>Attachments</label>
                            <input type="file" name="attachements" id="attachments" class="form-control">
                        </div> -->
                        <div class="form-group">
                            <label for="exampleInputFile">Attach Document</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="attachements[]" multiple id="attachments" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            
                            </div>
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
<?php include("addons/body_bottom.php")?>
    <script>
        $(function(){
            $(document).on("click", ".message_lawyer", function(e){
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
                        url:"clients/processor/messageLawyer",
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

        })
    </script>
</body>

</html>