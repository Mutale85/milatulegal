<?php include("../includes/db.php")?>
<?php include("../includes/base.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php 
    include("addons/header.php");
    $phonenumber = $_SESSION['phonenumber'];
    $client_id =  $_SESSION['userId'];
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
                <div class="col-md-12 mb-4">
                    <div class="card shadow mb-5">
                        <div class="card-header">
                            <h4><?php echo getUserByPhoneNumber($connect, $phonenumber) ?>' Profile</h4>
                        </div>
                        <div class="card-body">
                            <div id="profileView"></div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> Edit Profile</button>
                        </div>
                    </div>
                </div>
                <?php 
                    $query = $connect->prepare("SELECT * FROM table_legal_requests WHERE phonenumber = ?");
                    $query->execute([$phonenumber]);
                    $count = $query->rowCount();
                ?>
                <div class="col-xl-4 col-md-6 mb-4 clickable" id="legal-requests">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Posted Jobs</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-person-workspace fa-2x text-primary-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    $query = $connect->prepare("SELECT * FROM table_legal_requests WHERE phonenumber = ? AND hire_status = 'hired'");
                    $query->execute([$phonenumber]);
                    $count = $query->rowCount();
                ?>
                <div class="col-xl-4 col-md-6 mb-4 clickable" id="my-hired-request">
                    <div class="card border-bottom-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Active Jobs</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-hdd-network fa-2x text-success-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php 
                    $query = $connect->prepare("SELECT * FROM table_members WHERE user_type = 'lawyer'");
                    $query->execute();
                    $count = $query->rowCount();
                ?>
                <div class="col-xl-4 col-md-6 mb-4 clickable" id="find-a-lawyer">
                    <div class="card border-bottom-secondary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                        Available Lawyers</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-pc-display fa-2x text-secondary-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <?php 
                        $query = $connect->prepare("SELECT * FROM table_members WHERE phonenumber = ?");
                        $query->execute([$phonenumber]);
                        $row = $query->fetch();
                        extract($row);
                        if($photo == null){
                            $src = get_gravatar($email);
                        }else{
                            $src = get_gravatar($email);
                        }
                    ?>
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><?php echo $firstname?>'s Profile</h5>
                                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">X</button>
                            </div>
                            <div class="modal-body">
                                <form method="post" id="clientsForm" enctype="multipart/form-data">
                                    <div class="form-group mb-3">
                                        
                                        <img src="<?php echo $src ?>" style="width: 120px;height: 120px;border-radius: 50%;" alt="profile" id="output_image">
                                    </div>
                                    <input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id;?>">
                                    <div class="form-group">
                                        <label>First name:</label>
                                        <input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo $firstname?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Last name</label>
                                        <input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo $lastname?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" id="email" class="form-control" value="<?php echo $email?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phonenumber" id="phonenumber" class="form-control" value="<?php echo $phonenumber?>">
                                    </div>
                                    
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit" id="submitBtn" onclick="submitclientProfile(event)">Update Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            </div>
        </section>
      
    </div>
    
    <?php include("addons/footer.php")?>
    
  </div>
  <?php include("addons/footerjs.php")?>
    <script>
        function profileView(){
            var client_id = '<?php echo $client_id?>';
            $.ajax({
                url:"clients/processor/fetchclientsProfile",
                method:'POST',
                data: {client_id:client_id},
                success:function(data){
                   $("#profileView").html(data);
                }
            });
        }
        profileView();


        function editclientsProfile(client_id){
            $.ajax({
                url:"clients/processor/editclientsProfile",
                method:"post",
                data:{client_id:client_id},
                dataType:"JSON",
                
                success:function(data){
                    $("#firstname").val(data.firstname);
                    $("#lastname").val(data.lastname);
                    $("#email").val(data.email);
                    $("#phonenumber").val(data.phonenumber);
                    
                }
            })
        }
        editclientsProfile("<?php echo $client_id?>");

        submitclientProfile = function() {
            event.preventDefault();
            var xhr = new XMLHttpRequest();
            var url = 'clients/processor/submitclientProfile';
            var clientsForm = document.getElementById('clientsForm');
            xhr.open("POST", url, true);
            var firstname = document.getElementById('firstname');
            var lastname = document.getElementById('lastname');
            var email = document.getElementById('email');
            var phonenumber = document.getElementById('phonenumber');
            var data = new FormData(clientsForm);
            if(firstname.value == ""){
                errorToast("Please your first name cannot be empty");
                firstname.focus();
                return false;
            }

            if(lastname.value == ""){
                errorToast("Please your last name cannot be empty");
                lastname.focus();
                return false;
            }

            if(email.value == ""){
                errorToast("Please your email cannot be empty");
                email.focus();
                return false;
            }

            if(phonenumber.value == ""){
                errorToast("Please your phones number cannot be empty");
                phonenumber.focus();
                return false;
            }
            xhr.onreadystatechange = function(){
                if (xhr.readyState == 4 && xhr.status == 200) {
                    if (xhr.responseText === 'done') {
                        successToast(xhr.responseText);
                        editclientsProfile("<?php echo $client_id?>");
                        profileView("<?php echo $client_id?>");
                        // $("#clientsForm")[0].reset();
                        document.getElementById("submitBtn").innerHTML = 'Update profile';
                    }else{
                        errorToast(xhr.responseText);
                        document.getElementById("submitBtn").innerHTML = 'Update Profile';
                        editclientsProfile("<?php echo $client_id?>");
                        profileView("<?php echo $client_id?>");
                        return false;
                    }
                    
                }
            }
            xhr.send(data);
            document.getElementById("submitBtn").innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing...';
        }
        
        $(document).on("click", ".clickable", function(e){
            var link = $(this).attr("id");
            window.location = "clients/"+link;
        })
    </script>
</body>
</html>
