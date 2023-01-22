<?php 
	include '../includes/db.php';
	include '../includes/conf.php';

	if (isset($_POST['phonenumber'])) {
		
		$phonenumber = Clean(filter_input(INPUT_POST, 'phonenumber', FILTER_SANITIZE_SPECIAL_CHARS));

		$query = $connect->prepare("SELECT * FROM table_members WHERE phonenumber = ?");
		$query->execute([$phonenumber]);
		if($query->rowCount() > 0){

			$api_key = API_KEY;

			$sender_id = SENDER_ID;
			$otp = random_int(10000,99999);
			$message = 'Reset milatulegal OPT is: '.$otp;
// 			$phonenumber = "260976330092";
			$to = preg_replace("#[^0-9]#", "", $phonenumber);
// 			$from = 'Milatu';
// 			echo sendSMS( $to, $message, $from);
			$update = $connect->prepare("UPDATE `table_members` SET otp = ? WHERE phonenumber = ?  ");
        	if($update->execute([$otp, $phonenumber])){	
        		setcookie("phonenumber", $phonenumber, time()+60*60*24*30, '/');
			
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

				    // var_dump($output);
				    echo "A new verification code has been sent to your phone";

				}catch (Exception $exception){
				    echo $exception->getMessage();
				}
			}
		}else{
			echo "Error, contact admin @ 0976330092";
		}

	}
?>