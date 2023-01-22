<base href="http://localhost/milatu.com/lawyer-profile">
<!DOCTYPE html>
<html>
<head>
	<?php 
		require 'supports/header.php';
		$phonenumber = basename($_SERVER['REQUEST_URI']);
		$phonenumber = base64_decode($phonenumber);
	?>
	
</head>
<body>
	<?php require 'supports/nav.php';?>
	<div class="container">
		<br><br>
		<div class="coverDiv">
			<div class="row">
				<div class="col-md-12 mb-5">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4 class="card-title"><?php echo getUserByPhoneNumber($connect, $phonenumber)?>'s Profile</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            
                                $query = $connect->prepare("SELECT * FROM table_3_lawyer_profile WHERE phonenumber = ?");
                                $query->execute([$phonenumber]);
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
                                        <div class="col-md-4 mb-3">
                                            <img src="<?php echo $src ?>" class="img-fluid rounded-circle" alt="userImage" style="width: 120px;height: 120px; border-radius: 50%;">
                                            <p class="mt-4"><b><?php echo $email?></b></p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <!-- <ul class="list-group">
                                               <li class="list-group-item"><?php echo $firstname?> <?php echo $lastname?></li>
                                               <li class="list-group-item"><?php echo $email?></li> 
                                            </ul> -->
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <h4>Rates </h4>
                                            <p><small>Hourly Rate: <?php echo $currency?> <?php echo $hourly_rate?></small></p>
                                            <p><small>Fixed Rate: <?php echo $currency?> <?php echo $fixed_rate?></small></p>
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
                            <?php }else{?>
                                    <p>He hasn't yet set up a profile.</p>
                            <?php }?>
                            
                        </div>
                        <div class="card-footer">
                            <a href="access/login" class="btn btn-outline-dark m-1 py-3 px-4 rounded-pill message_lawyer">Login to Message Lawyer</a> 
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
	<?php include("supports/footer.php");?>	
</body>
</html>