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
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow card-secondary">
                                <div class="card-header">
                                    
                                     <?php echo getUserByPhoneNumber($connect, $phonenumber) ?>' Profile</button>
                                </div>
                                <div class="card-body">
                                    <div id="profileView"></div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal"> Edit Profile</button>
                                </div>

                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <?php 
                                        $query = $connect->prepare("SELECT * FROM table_members WHERE email = ?");
                                        $query->execute([$lawyer_email]);
                                        $row = $query->fetch();
                                        extract($row);
                                        if($photo == null){
                                            $src = get_gravatar($email);
                                        }else{
                                            $src = 'lawyers/uploads/'.$photo;
                                        }
                                    ?>
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><?php echo $firstname?>'s Profile</h5>
                                                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">x</button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" id="lawyersForm" enctype="multipart/form-data">
                                                    <div class="form-group mb-3">
                                                        
                                                        <button class="btn btn-secondary mb-2" type="button" id="selectImage">Change Picture <i class="bi bi-file-person"></i></button>
                                                        <br>
                                                        <input type="file" name="photo" id="photo" class="form-control" onchange="preview_admin_image(event)" style="display: none;">
                                                        <img src="<?php echo $src ?>" style="width: 120px;height: 120px;border-radius: 50%;" alt="profile" id="output_image">
                                                    </div>
                                                    <input type="hidden" name="lawyer_id" id="lawyer_id" value="<?php echo $lawyer_id;?>">
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
                                                    <div class="form-group">
                                                        <label>Work Currency</label>
                                                        <select name="currency" id="currency" class="form-control" >
                                                            <option value="">Select Currency</option>
                                                            <option value="ZMW">ZMW</option>
                                                            <option value="USD">USD</option>
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Hourly rate:</label>
                                                        <input type="number" name="hourly_rate" id="hourly_rate" class="form-control" step="any" min="0">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Fixed rate:</label>
                                                        <input type="number" name="fixed_rate" id="fixed_rate" class="form-control" step="any" min="0">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Consultation Fee</label>
                                                        <input type="number" name="consultation_rate" id="consultation_rate" class="form-control" step="any" min="0">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>About Me</label>
                                                        <textarea name="about_me" id="about_me" class="form-control" rows="6" placeholder="Talk about your expertise and what valued you offer "></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Area of Law</label> 
                                                        <div class="input-group">
                                                            <input type="text" name="area_of_law" id="area_of_law" class="form-control" placeholder="e.g, Family Law, Human Rights, Civil Cases ">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Practice</label>
                                                        <textarea name="practice" id="practice" placeholder="Adoptions, Agency Adoptions, Alimony, Annulment, Assisted Reproductive Technology, Child Abduction, Child Abuse and Neglect, Child Advocacy" class="form-control" rows="6">
                                                        Adoptions, Agency Adoptions, Alimony, Annulment, Assisted Reproductive Technology, Child Abduction, Child Abuse and Neglect, Child Advocacy
                                                        </textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Jurisdiction</label>
                                                        <input type="text" name="jurisdiction" id="jurisdiction" class="form-control" placeholder="Area where you can practice law, eg. Zambia">
                                                    </div>
                                                    <h4>Employment History</h4>
                                                    <div class="form-group">
                                                        <label>Last / Current Firm</label> 
                                                        <input type="text" name="firm" id="firm" class="form-control" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Period</label> 
                                                        <input type="text" name="period_of_work" id="period_of_work" class="form-control" placeholder="E.g 3 Years 5 months">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Roles & Responsibility</label> 
                                                        <textarea name="roles" id="roles" class="form-control" placeholder="State roles that you work or worked before" rows="5"></textarea>
                                                    </div>

                                                    <h4>Education History</h4>
                                                    <div class="form-group">
                                                        <label>Qualification</label> 
                                                        <input type="text" name="qualification" id="qualification" class="form-control" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Institution</label> 
                                                        <input type="text" name="institution" id="institution" class="form-control" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Graduation Date</label> 
                                                        <input type="text" name="graduation_date" id="graduation_date" class="form-control" placeholder="YYYY-mm-dd" value="2020-07-09">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                <button class="btn btn-primary" type="submit" id="submitBtn" onclick="submitLawyerProfile(event)">Update Profile</button>
                                            </div>
                                        </div>
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
        var selectImage = document.getElementById('selectImage');
        var fileInput = document.getElementById('photo');
        selectImage.addEventListener("click", (e) => {
            $('#photo').click();
        });

        function profileView(){
            var lawyer_id = '<?php echo $lawyer_id?>';
            $.ajax({
                url:"lawyers/processor/fetchLawyersProfile",
                method:'POST',
                data: {lawyer_id:lawyer_id},
                success:function(data){
                   $("#profileView").html(data);
                }
            });
        }
        profileView();

        function preview_admin_image(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('output_image');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
            var data = document.getElementById('lawyersForm');
            var formData = new FormData(data);
            $.ajax({
                url:"lawyers/processor/updatePhoto",
                method:'POST',
                data: formData,
                cache : false,
                processData: false,
                contentType: false,
                
                success:function(data){
                   
                }
            })
        }

        function editLawyersProfile(lawyer_id){
            $.ajax({
                url:"lawyers/processor/editLawyersProfile",
                method:"post",
                data:{lawyer_id:lawyer_id},
                dataType:"JSON",
                
                success:function(data){
                    $("#firstname").val(data.firstname);
                    $("#lastname").val(data.lastname);
                    $("#email").val(data.email);
                    $("#phonenumber").val(data.phonenumber);
                     $("#currency").val(data.currency);
                    $("#hourly_rate").val(data.hourly_rate);
                    $("#fixed_rate").val(data.fixed_rate);
                    $("#consultation_rate").val(data.consultation_rate);
                    $("#about_me").val(data.about_me);
                    $("#area_of_law").val(data.area_of_law);
                    $("#jurisdiction").val(data.jurisdiction);
                    $("#practice").val(data.practice);
                    $("#firm").val(data.firm);
                    $("#period_of_work").val(data.period_of_work);
                    $("#roles").val(data.roles);
                    $("#qualification").val(data.qualification);
                    $("#institution").val(data.institution);
                    $("#graduation_date").val(data.graduation_date);
                }
            })
        }
        editLawyersProfile("<?php echo $lawyer_id?>");

        submitLawyerProfile = function() {
            event.preventDefault();
            var xhr = new XMLHttpRequest();
            var url = 'lawyers/processor/submitLawyerProfile';
            var lawyersForm = document.getElementById('lawyersForm');
            xhr.open("POST", url, true);
            var firstname = document.getElementById('firstname');
            var lastname = document.getElementById('lastname');
            var email = document.getElementById('email');
            var about_me = document.getElementById('about_me');
            var data = new FormData(lawyersForm);
            if(firstname.value == ""){
                alert("Please your first name cannot be empty");
                firstname.focus();
                return false;
            }

            if(lastname.value == ""){
                alert("Please your last name cannot be empty");
                lastname.focus();
                return false;
            }

            if(email.value == ""){
                alert("Please your email cannot be empty");
                email.focus();
                return false;
            }

            if(about_me.value == ""){
                alert("Please your about me cannot be empty");
                about_me.focus();
                return false;
            }
            xhr.onreadystatechange = function(){
                if (xhr.readyState == 4 && xhr.status == 200) {
                    if (xhr.responseText === 'done') {
                        alert(xhr.responseText);
                        editLawyersProfile("<?php echo $lawyer_id?>");
                        profileView("<?php echo $lawyer_id?>");
                        // $("#lawyersForm")[0].reset();
                        document.getElementById("submitBtn").innerHTML = 'Update profile';
                    }else{
                        alert(xhr.responseText);
                        document.getElementById("submitBtn").innerHTML = 'Update Profile';
                        editLawyersProfile("<?php echo $lawyer_id?>");
                        profileView("<?php echo $lawyer_id?>");
                        return false;
                    }
                    
                }
            }
            xhr.send(data);
            document.getElementById("submitBtn").innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing...';
        }

    </script>

</body>
</html>