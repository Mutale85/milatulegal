<?php 
	include("../../includes/db.php");
	include("../../includes/conf.php");
	if (isset($_POST['introduction'])) {
		$introduction = Clean(filter_input(INPUT_POST, 'introduction', FILTER_SANITIZE_SPECIAL_CHARS));
		$costing = Clean(filter_input(INPUT_POST, 'costing', FILTER_SANITIZE_SPECIAL_CHARS));
		$case_id = preg_replace("#[^0-9]#", "", $_POST['case_id']);
		$lawyer_id = preg_replace("#[^0-9+]#", "", $_POST['lawyer_id']);
		$client_id = preg_replace("#[^0-9+]#", "", $_POST['client_id']);

		// add files -------->
		$attachment = $_FILES['attachment']['name'];
		$filename   = $_FILES['attachment']['tmp_name'];
		$file_size  = $_FILES['attachment']['size'];

		$destination = "uploads/".basename($attachment);
		if($file_size > 5000000){
			echo "Your file should not be larger than 5MB";
			exit();
		}
		$query = $connect->prepare("SELECT * FROM table_applications WHERE case_id = ? AND lawyer_id = ?");
		$query->execute([$case_id, $lawyer_id]);
		if($query->rowCount() > 0){
			echo "You have already applied on this case";
			exit();
		}
		$sql = $connect->prepare("INSERT INTO `table_applications`(`case_id`, `client_id`, `lawyer_id`, `introduction`, `costing`, `attachment`, `date_applied`) VALUES (?, ?, ?, ?, ?, ?, ?) ");
		$date_applied = date("Y-m-d");

		$ex = $sql->execute([$case_id,$client_id, $lawyer_id, $introduction, $costing, $attachment, $date_applied]);
		if($ex){
			move_uploaded_file($filename, $destination);
			// send an sms to client that they have a application in 
			$phonenumber = fetchClientPhoneBYCaseId($connect, $case_id);
			$api_key = API_KEY;
			$sender_id = SENDER_ID;
			$message = 'You have a new application in milatulegal.com';
			echo SMSNOW($client_id, $message, $api_key, $sender_id);
			
			echo "Application Sent.";
			
			// send an sms to laywer that they have applied to a case.
			$message = 'Your application on milatulegal.com has been sent to the client for review';
			echo SMSNOW($lawyer_id, $message, $api_key, $sender_id);
		}
	}
?>