<?php 
	include("../../includes/db.php");
	if(isset($_FILES['photo']['name'])){
		
		$photo 			= $_FILES['photo']['name'];
		$filename 		= $_FILES['photo']['tmp_name'];
		$destination    = 'lawyers/uploads/'.basename($photo);
		$lawyer_id 		= $_POST['lawyer_id'];

		$update = $connect->prepare("UPDATE `table_members` SET photo = ? WHERE id = ? ");
		$ex = $update->execute([$photo, $lawyer_id]);
		if($ex){
			move_uploaded_file($filename, $destination);
		}

	}
?>