<?php
include("../includes/db.php");

if (isset($_POST['vehicle_reg_number'])) {

	$user_id 			= $_SESSION['user_id'];
	$vehicle_brand 		= filter_var($_POST['vehicle_brand'], FILTER_SANITIZE_STRING);
	$vehicle_number 	= filter_var($_POST['vehicle_reg_number'], FILTER_SANITIZE_STRING);
	$currency 			= filter_var($_POST['currency'], FILTER_SANITIZE_STRING);
	$carprice 			= filter_var($_POST['rent_price'], FILTER_SANITIZE_STRING);
	$per_rate 			= filter_var($_POST['per_rate'], FILTER_SANITIZE_STRING);
	$millage 			= filter_var($_POST['millage'], FILTER_SANITIZE_STRING);
	$fuel_type 			= filter_var($_POST['fuel_type'], FILTER_SANITIZE_STRING);
	$transmission 		= filter_var($_POST['transmission'], FILTER_SANITIZE_STRING);
	$passengers 		= filter_var($_POST['passengers'], FILTER_SANITIZE_STRING);
	$cargo_hold 		= filter_var($_POST['cargo_hold'], FILTER_SANITIZE_STRING);
	$cd_player 			= filter_var($_POST['cd_player'], FILTER_SANITIZE_STRING);
	$fm_radio 			= filter_var($_POST['fm_radio'], FILTER_SANITIZE_STRING);
	$air_conditioning 	= filter_var($_POST['air_conditioning'], FILTER_SANITIZE_STRING);
	// $ownership 			= filter_var($_POST['ownership'], FILTER_SANITIZE_STRING);
	
	// if ($ownership == "classic owned") {
	// 	$name_of_owner 	= "Classic Car Hires";
	// 	$owner_phone 	= "0974-72-46-86";
	// }else if ($ownership == "others") {
	// 	$name_of_owner 	= filter_var($_POST['name_of_owner'], FILTER_SANITIZE_STRING);
	// 	$owner_phone 	= filter_var($_POST['owner_phone'], FILTER_SANITIZE_STRING);
	// }

	$name_of_owner = "";

	// $query = $connect->prepare("SELECT vehicle_reg_number FROM vehicles WHERE vehicle_reg_number = ? ");
	// $query->execute(array($vehicle_number));
	// $count = $query->rowCount();
	// if ($count > 0) {
	// 	echo "You have already added vehicle with registration number: " . $vehicle_number;
	// 	exit();
	// }

	//  INSERING AN IMAGE TO THE DATABASE ----
	$fileName 		= $_FILES["vehicle_image"]["name"]; // The file name
	$fileTmpLoc 	= $_FILES["vehicle_image"]["tmp_name"]; // File in the PHP tmp folder
	$fileType 		= $_FILES["vehicle_image"]["type"]; // The type of file it is
	$fileSize 		= $_FILES["vehicle_image"]["size"]; // File size in bytes
	$fileErrorMsg 	= $_FILES["vehicle_image"]["error"]; // 0 for false... and 1 for true
	$kaboom 		= explode(".", $fileName); // Split file name into an array using the dot
	$fileExt 		= end($kaboom); // Now target the last array element to get the file extension
	$destination 	= "../uploads/".basename($fileName); // File destination
	// START PHP Image Upload Error Handling --------------------------------------------------
	if (!$fileTmpLoc) { // if file not chosen
	    echo "ERROR: Please browse for a file before clicking the upload button.";
	    exit();
	} else if($fileSize > 5242880) { // if file size is larger than 5 Megabytes
	    echo "ERROR: Your file was larger than 5 Megabytes in size.";
	    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
	    exit();
	} else if (!preg_match("/.(jpg|png|jpeg)$/i", $fileName) ) {
	     // This condition is only if you wish to allow uploading of specific file types    
	     echo "ERROR: Your image was not .jpeg, .jpg, or .png.";
	     unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
	     exit();
	} else if ($fileErrorMsg == 1) { // if file upload error key is equal to 1
	    echo "ERROR: An error occured while processing the file. Try again.";
	    exit();
	}
	
	$moveResult = move_uploaded_file($fileTmpLoc, $destination);

	if ($moveResult != true) {
	    echo "ERROR: File not uploaded. Try again.";
	    unlink($fileTmpLoc);
	    exit();
	}
	
	$target_file = "../uploads/$fileName";
	$resizeName = "resized_".$fileName;
	$resized_file = "../uploads/resized_$fileName";
	$wmax = 200;
	$hmax = 150;
	reduceFileSize($target_file, $resized_file, $wmax, $hmax, $fileExt);	
	$image = "resized_".$fileName;
	if ($vehicle_brand == "") {
		echo "<span class='text-danger'>Please Select Vehicle Type!</span>";
		exit();
	}

	// We Insert The vehicle details in the database --------
	
	$sql = $connect->prepare("INSERT INTO vehicles (vehicle_reg_number, vehicle_brand, currency, carprice, per_rate, transmission, passengers, fuel_type, millage, cargo_hold, image, cd_player, fm_radio, air_conditioning, vehicle_owner, owner_phone_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$execute = $sql->execute([
		$vehicle_number, $vehicle_brand, $currency, $carprice, $per_rate, $transmission, $passengers, $fuel_type, $millage, $cargo_hold, $image, $cd_player, $fm_radio, $air_conditioning, $name_of_owner, $owner_phone
	]);

	if ($execute ) {
		if (move_uploaded_file($resizeName, $destination)) {
		}
		echo "Vehicle with registration number ".$vehicle_number." added";

	}else{
		echo "Errors";
	}
}
?>