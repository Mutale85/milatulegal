<?php 
	include("../../includes/db.php");
	if(isset($_POST['firstname'])){
		$firstname = Clean(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
		$lastname = Clean(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));
		$email = Clean(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS));
		$phonenumber = Clean(filter_input(INPUT_POST, 'phonenumber', FILTER_SANITIZE_SPECIAL_CHARS));
		
		$client_id = preg_replace("#[^0-9]#", "", filter_input(INPUT_POST, 'client_id', FILTER_SANITIZE_SPECIAL_CHARS));
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "invalid email format";
			exit();
		}

		$query = $connect->prepare("SELECT * FROM `table_members` WHERE `id` = ? ");
		$query->execute([$client_id]);
		$count = $query->rowCount();
		if($count > 0){
			
			$update = $connect->prepare("UPDATE `table_members` SET firstname = ?, lastname = ?, phonenumber = ?, email = ? WHERE id = ? ");
			$ex = $update->execute([$firstname, $lastname, $phonenumber, $email, $client_id ]);
			if ($ex) {
				echo "Your details have been updated";
				$_SESSION['firstname'] = $firstname;
				$_SESSION['lastname'] = $lastname;
			}
		}
	}
?>