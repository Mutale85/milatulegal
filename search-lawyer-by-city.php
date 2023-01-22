<base href="http://localhost/milatu.com/">
<?php 
     if(isset($_GET['city-name'])){
        $town = $_GET['city-name'];
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Seaarch lawyer by location - Milatu.co</title>
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
                        $townID = coverttownToId($connect, $town);
                        $query = $connect->prepare("SELECT * FROM table_members WHERE user_type = 'lawyer' AND town = ? ");
                        $query->execute([$townID]);
                        if($query->rowCount() > 0){
                            foreach($query->fetchAll() as $row){
                                extract($row);
                                if($photo == null){
                                    $src = get_gravatar($email);
                                }else{
                                    $src = 'lawyers/uploads/'.$photo;
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
                                                <li class="list-group-item"><?php echo $firstname?> <?php echo $lastname?></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-8 mb-3">
                                            <h4>Bio:</h4>
                                            <?php 
                                                $query = $connect->prepare("SELECT * FROM table_3_lawyer_profile WHERE lawyer_id = ?");
                                                $query->execute([$id]);
                                                $rows = $query->fetch();
                                                if($query->rowCount() > 0){
                                                    extract($rows);
                                            ?>
                                                    <p><?php echo $about_me ?></p>
                                                    <h4>Area of Law and Practice:</h4>
                                                    <p><b><?php echo $area_of_law?></b></p>
                                                    <p><?php echo $practice?></p>
                                            <?php }else{?>
                                                    <p>Client has not yet updated their profile</p>
                                            <?php }?>
                                            <a href="lawyer-profile/<?php echo base64_encode($phonenumber)?>" class="btn btn-outline-dark m-1 py-2 px-4 rounded-pill">View profile</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php    
                            }

                        }else{
                        ?>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5>No lawyers found in <?php echo getTown($connect, $townID)?> </h5>   
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