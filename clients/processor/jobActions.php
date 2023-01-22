<?php 
	require("../../includes/db.php");
	include '../../includes/conf.php';
	$api_key = API_KEY;
	$sender_id = SENDER_ID;
	if (isset($_POST['client_id'])) {
		$client_id = preg_replace("#[^0-9+]#", "", $_POST['client_id']);
		$lawyer_id = preg_replace("#[^0-9+]#", "", $_POST['lawyer_id']);
		$job_id = preg_replace("#[^0-9+]#", "", $_POST['job_id']);
		$query = $connect->prepare("SELECT * FROM table_job_offers WHERE job_id = ? ");
		$query->execute([$job_id]);
		if($query->rowCount() > 0){
			echo "This job has been offered to a legal reresentative";
			exit();
		}
		$sql = $connect->prepare("INSERT INTO `table_job_offers`(`job_id`, `client_id`, `lawyer_id`) VALUES (?, ?, ?)");
		$ex = $sql->execute([$job_id, $client_id, $lawyer_id]);
		$update = $connect->prepare("UPDATE `table_legal_requests` SET hire_status = 'hired' WHERE id = ? ");
		$update->execute([$job_id]);
		if($ex){

			echo "You have offered the legal job to ".getUserByPhoneNumber($connect, $lawyer_id);
			$lawyername = getUserByPhoneNumber($connect, $lawyer_id); 
          	//message lawyer
          	$message = 'Your job request on milatulegal.com has been accepted';
			echo SMSNOW($lawyer_id, $message, $api_key, $sender_id);
            
          	// send message to client too
            $message = "You have offered the legal job to ".$lawyername;
            
            echo SMSNOW($client_id, $message, $api_key, $sender_id);
			$update = $connect->prepare("UPDATE table_applications SET offer_job = '1' WHERE id = ? ");
            $update->execute([$job_id]);
		}
		
	}
?>