<?php 
	include("../../includes/db.php");
	include("../../includes/conf.php");
	if (isset($_POST['sender_id'])) {
		$sender_id = preg_replace("#[^0-9+]#", "", $_POST['sender_id']);
		$receiver_id = preg_replace("#[^0-9+]#", "", $_POST['receiver_id']);
		$subject = Clean(filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_SPECIAL_CHARS));
		$message = Clean(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS));
		$sql = $connect->prepare("INSERT INTO `table_messages`(`sender_id`, `receiver_id`, `subject`, `message`) VALUES (?, ?, ?, ?) ");
		$ex = $sql->execute([$sender_id, $receiver_id, $subject, $message]);
		$parent_id = $connect->lastInsertId();
		$update = $connect->prepare("UPDATE table_messages SET parent_id = ? WHERE sender_id = ? AND receiver_id = ?");
		$update->execute([$parent_id, $sender_id, $receiver_id]);
		if($ex){
			// send an sms to client that they have a message in 
			echo "Message sent";
			$phonenumber = $receiver_id;
			$api_key = API_KEY;
			$sender_id = SENDER_ID;
			$message = 'You have a new message in milatu.com';
			
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
?>