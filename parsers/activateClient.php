<?php 

	include '../includes/db.php';
	include '../includes/conf.php';

	if (isset($_POST['otp'])) {
		$otp = $_POST['otp'];
		$otp_phone = $_POST['otp_phone'];
		$query = $connect->prepare("SELECT * FROM `table_members` WHERE `otp` = ? AND `phonenumber` = ? ");
		$query->execute([$otp, $otp_phone]);
		if ($query->rowCount() == 1) {
			//activate account
			$update = $connect->prepare("UPDATE `table_members` SET `otp` = '', `activate` = '1' WHERE `phonenumber` = ? ");
			$ex = $update->execute([ $otp_phone]);
			if($ex ){
				echo "You account has been activated. You can log in";

				$api_key = API_KEY;

				$sender_id = SENDER_ID;
				
				$message = 'Your mitatulegal.com account is activated.';
	        
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
		}else{
			echo "OPT not recognised. Contact admin at 0976330092";
		} 
	}
?>