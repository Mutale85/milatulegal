<?php 

	include '../includes/db.php';

	if (isset($_POST['otp'])) {
		$otp = $_POST['otp'];
		$otp_phone = $_POST['otp_phone'];
		$query = $connect->prepare("SELECT * FROM `table_2_lawyers` WHERE `otp` = ? AND `phonenumber` = ? ");
		$query->execute([$otp, $otp_phone]);
		if ($query->rowCount() == 1) {
			//activate account
			$update = $connect->prepare("UPDATE `table_2_lawyers` SET `otp` = '', `activate` = '1' WHERE `phonenumber` = ? ");
			if($update->execute([ $otp_phone])){
				echo "You account has been activated. You can log in";

				$api_key = API_KEY;

				$sender_id = SENDER_ID;
				$otp = random_int(10000,99999);
				$message = 'Your mitatulegal.com account is activated';
				
				$update = $connect->prepare("UPDATE `table_2_lawyers` SET otp = ? WHERE email = ?  ");
	        	$update->execute(array($otp, $email));	
				
		        
				$url = 'https://bulksms.zamtel.co.zm/api/v2.1/action/send/api_key/'.$api_key.'/contacts/'.$otp_phone.'/senderId/'.$sender_id.'/message/'.$message.'';
				

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
			}
		} 
	}
?>