<?php 
include("../../includes/db.php");
if (isset($_POST['lawyer_id'])) {
	$lawyer_id = preg_replace("#[^0-9+]#", "", $_POST['lawyer_id']);
      
    $query = $connect->prepare("SELECT * FROM table_3_lawyer_profile WHERE lawyer_id = ?");
    $query->execute([$lawyer_id]);
    
    if($query->rowCount() > 0){
        $row = $query->fetch();
        if($row){
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
                <div class="col-md-12 card mb-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <img src="<?php echo $src ?>" class="img-fluid rounded-circle" alt="userImage" style="width: 150px;height: 150px; border-radius: 50%;">
                            </div>
                            <div class="col-md-4 mb-3">
                                <ul class="list-group-unstyled">
                                <li class="list-group-item"><?php echo $firstname?> <?php echo $lastname?></li>
                                <li class="list-group-item"><?php echo $phonenumber?></li> 
                                <li class="list-group-item"><?php echo $email?></li> 
                                </ul>
                            </div>
                            <div class="col-md-4 mb-3">
                                <h4>Rates </h4>
                                <p><small>Hourly Rate: <?php echo $currency?> <?php echo $hourly_rate?></small></p>
                                <p><small>Fixed Rate: <?php echo $currency?> <?php echo $fixed_rate?></small></p>
                                <p class="text-success"><small>Consultation Rate: <?php echo $currency?> <?php echo $consultation_rate ?></small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <h4>About Me:</h4>
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
        }
    }else{
        echo "Please create profile to attract clients";
    }
}
?>