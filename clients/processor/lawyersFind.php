<?php 

	include '../../includes/db.php';

	if (isset($_POST['find'])) {
		$query = $connect->prepare("SELECT * FROM table_members WHERE user_type = 'lawyer' ");
		$query->execute();
		foreach($query->fetchAll() as $row){
			extract($row);
			if($photo == null){
		        $src = get_gravatar($email);
		    }else{
		        $src = 'lawyers/uploads/'.$photo;
		    }

		?>
        
		<div class="col-16 col-sm-16 col-md-16 d-flex align-items-stretch flex-column">
			<div class="card bg-light d-flex flex-fill">
			<div class="card-header text-muted border-bottom-0">
				<?php echo getLawyerSpeciality($connect, $phonenumber)?>
			</div>
			<div class="card-body pt-0">
				<div class="row">
				<div class="col-7">
					<h2 class="lead"><b><?php echo $firstname?> <?php echo $lastname?></b></h2>
					<p class="text-muted text-sm"><b>About: </b> <?php echo lawyersProfile($connect, $id)?> </p>
				</div>
				<div class="col-5 text-center">
					<img src="<?php echo $src ?>" alt="user-avatar" class="img-circle img-fluid" style="width:80px; height: 80px; border-radius 50%;">
				</div>
				</div>
			</div>
			<div class="card-footer">
				<div class="text-right">
				
				<a href="clients/lawyerprofile?lawyer-apid=<?php echo base64_encode($phonenumber)?>" class="btn btn-sm btn-primary">
					<i class="fas fa-user"></i> View Profile
				</a>
				</div>
			</div>
			</div>
		</div>
   <?php	
		}
	}
?>