<?php 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require '../PHPMailer/src/Exception.php';
	require '../PHPMailer/src/PHPMailer.php';
	require '../PHPMailer/src/SMTP.php';
	include '../includes/db.php';
	include '../includes/conf.php';

	if (isset($_POST['firstname'])) {
		$firstname = Clean(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
		$lastname = Clean(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));
		$phonenumber = Clean(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS));
		$email = Clean(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS));
		$username = Clean(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS));
		$password = Clean(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS));
		$passcode = Clean(base64_encode($password));
		$province = Clean(filter_input(INPUT_POST, 'location_province', FILTER_SANITIZE_SPECIAL_CHARS));
		$town = Clean(filter_input(INPUT_POST, 'location_town', FILTER_SANITIZE_SPECIAL_CHARS));
		$user_type = 'lawyer';

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "Invalid Email";
			exit();
		}
		
		$query = $connect->prepare("SELECT * FROM `table_members` WHERE `email` = ? ");
		$query->execute(array($email));
		if ($query->rowCount() > 0) {
			echo "Lawyer with email ". $email . ' is already registerd';
		}else{
			$password = password_hash($password, PASSWORD_DEFAULT);
			$sql = $connect->prepare("INSERT INTO `table_members`(`firstname`, `lastname`, `phonenumber`, `email`, `username`, `password`, `passcode`, `user_type`, `province`, `town`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)  ");
			$ex = $sql->execute([$firstname, $lastname, $phonenumber, $email, $username, $password, $passcode, $user_type, $province, $town]);
			if($ex){
				// send a confirmation text to admins and also to the lawyer
				echo "Your account has been created. You can log in to start accepting clients";

				$api_key = API_KEY;

				$sender_id = SENDER_ID;
				$otp = random_int(100000,999999);
				$message = 'Your Milatu OPT is: '.$otp;
				
				$update = $connect->prepare("UPDATE `table_members` SET otp = ? WHERE email = ?  ");
	        	$update->execute(array($otp, $email));	
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

				    //var_dump($output);

				}catch (Exception $exception){
				    echo $exception->getMessage();
				}
			}
		}
		
		
	}
?>