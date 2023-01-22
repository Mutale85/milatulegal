<?php 
include("../../includes/db.php");
if (isset($_POST['client_id'])) {
	$client_id = preg_replace("#[^0-9+]#", "", $_POST['client_id']);
      
    $query = $connect->prepare("SELECT * FROM table_members WHERE phonenumber = ?");
    $query->execute([$client_id]);
    $row = $query->fetch();
    if($row){
        extract($row);
        
        
        if($photo == null){
            $src = get_gravatar($email);
        }
        ?>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <img src="<?php echo $src ?>" class="img-fluid rounded-circle" alt="userImage" style="width: 100px;height: 100px; border-radius: 50%;">
                </div>
                <div class="col-md-6 mb-3">
                    <ul class="list-group">
                    <li class="list-group-item text-dark"><?php echo $firstname?> <?php echo $lastname?></li>
                    <li class="list-group-item text-dark"><?php echo $phonenumber?></li> 
                    <li class="list-group-item text-dark"><?php echo $email?></li> 
                    </ul>
                </div>
            </div>
                
    <?php
    }	
}
?>