<?php 

	include '../includes/db.php';
	include '../includes/conf.php';

	if (isset($_POST['firstname'])) {
		$firstname = Clean(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
		$lastname = Clean(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));
		$phonenumber = Clean(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS));
		$email = Clean(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS));
		$province = Clean(filter_input(INPUT_POST, 'province', FILTER_SANITIZE_SPECIAL_CHARS));
		$town = Clean(filter_input(INPUT_POST, 'town', FILTER_SANITIZE_SPECIAL_CHARS));
		$lawyer_type = Clean(filter_input(INPUT_POST, 'lawyer_type', FILTER_SANITIZE_SPECIAL_CHARS));
		$case_title = Clean(filter_input(INPUT_POST, 'case_title', FILTER_SANITIZE_SPECIAL_CHARS));
		$description = Clean(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS));
		$payment_mode = Clean(filter_input(INPUT_POST, 'payment_mode', FILTER_SANITIZE_SPECIAL_CHARS));

		$sql = $connect->prepare("INSERT INTO `table_legal_requests`(`firstname`, `lastname`, `phonenumber`, `email`, `province`, `town`, `lawyer_type`, `case_title`, `description`, `payment_mode`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
		$ex = $sql->execute([$firstname, $lastname, $phonenumber, $email, $province, $town, $lawyer_type, $case_title, $description, $payment_mode]);
		if ($ex) {
			//select lawyers who are in the category requested for and send them Emails

			$api_key = API_KEY;

			$sender_id = SENDER_ID;
			
			$message = 'Your request on legal-link has been posted';
        
			$url = 'https://bulksms.zamtel.co.zm/api/v2.1/action/send/api_key/'.$api_key.'/contacts/'.$phonenumber.'/senderId/'.$sender_id.'/message/'.$message.'';
			

			$gateway_url = $url;

			try {
			    $ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, $gateway_url);
			    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			    curl_setopt($ch, CURLOPT_HTTPGET, 1);
			    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			    $output = curl_exec($ch);

			    if (curl_errno($ch)) {
			        $output = curl_error($ch);
			    }
			    curl_close($ch);

			    //var_dump($output);

			}catch (Exception $exception){
			    echo $exception->getMessage();
			}
			echo  $message;
		} 
	}
?>