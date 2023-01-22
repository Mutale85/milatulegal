<base href="http://localhost/milatu.com/">
<?php 
     if(isset($_GET['area-of-law'])){
        $area_of_law = $_GET['area-of-law'];
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Search lawyers by practice - Milatu.co</title>
	<?php include("supports/header.php");?>
</head>
<body>
	<?php include("supports/nav.php")?>
	<div class="container">
		<br><br>
		<div class="coverDiv">
			<div class="row">
				<div class="col-md-12">
    				<?php 
                  
                  $query = $connect->prepare("SELECT * FROM table_3_lawyer_profile WHERE area_of_law = ?");
                  $query->execute([$area_of_law]);
                  if($query->rowCount() > 0){
                     foreach($query->fetchAll() as $row){
                        extract($row);
                        $query2 = $connect->prepare("SELECT * FROM table_members WHERE user_type = 'lawyer' AND phonenumber = ? ");
                  		$query2->execute($phonenumber);
                  		$rows = $query2->fetch();
                        if($rows['photo'] == null){
                           $src = get_gravatar($rows['email']);
                        }else{
                           $src = 'lawyers/uploads/'.$rows['photo'];
                        }
                  ?>
                      <div class="card mb-4">
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-4 mb-3">
                                      <ul class="list-group clickable" data-id="<?php echo $phonenumber?>">
                                          <li class="list-group-item">
                                              <img src="<?php echo $src ?>" class="img-fluid rounded-circle" alt="userImage" style="width: 100px;height: 100px; border-radius: 50%;">
                                          </li>
                                          <li class="list-group-item"><?php echo $rows['firstname']?> <?php echo $rows['lastname']?></li>
                                      </ul>
                                  </div>
                                  <div class="col-md-8 mb-3">
                                      <h4>Bio:</h4>
                                      
	                                    <p><?php echo $about_me ?></p>
	                                    <h4>Area of Law and Practice:</h4>
	                                    <p><b><?php echo $area_of_law?></b></p>
	                                    <p><?php echo $practice?></p>
                                      
                                      <a href="lawyer-profile/<?php echo base64_encode($phonenumber)?>" class="btn btn-outline-dark m-1 py-2 px-4 rounded-pill">View profile</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  <?php } 
                  	}else{
                  ?>
             
                  <div class="card mb-4">
                      <div class="card-body text-center text-warnings">
                          <h5>No lawyers found in <?php echo $area_of_law?> Practice</h5>   
                      </div>
                  </div>
                  <?php       
                  }
              ?>
            </div>
			</div>
		</div>
	</div>
	<?php include("supports/footer.php")?>
</body>
</html>