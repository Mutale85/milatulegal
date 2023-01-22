<?php

	include("../includes/db.php");
	if (isset($_POST['phone'])) {
		$phone = Clean(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS));
		$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
		
		
		if ($phone == "") {
			echo "phone is empty";
			exit();
		}

		if ($password == "") {
			echo "password is empty";
			exit();
		}
		
		$query = $connect->prepare("SELECT * FROM table_members WHERE phonenumber = ? ");
		$query->execute(array($phone));
		if ($query->rowCount() > 0) {
			foreach ($query->fetchAll() as $row) {
				
				if (password_verify($password, $row['password'])) {
					$_SESSION['phonenumber'] 	= $row['phonenumber'];
					$_SESSION['userEmail'] 		= $row['email'];
				    $_SESSION['userId'] 		= $row['id'];
				    $_SESSION['firstname'] 		= $row['firstname'];
				    $_SESSION['lastname'] 		= $row['lastname'];
				    $_SESSION['userType'] 		= $row['user_type'];

				    setcookie("MilatuLogin", base64_encode($_SESSION['userEmail']. password_hash($_SESSION['userEmail'], PASSWORD_DEFAULT)), time()+60*60*24*30, '/');
					setcookie("MilatuLoginAccount", $row['user_type'], time()+60*60*24*30, '/');
				    				    
				    echo "Redirecting you in 1 Second";


				}else{
					echo "Incorrect login credentials";
					exit();
				}
			}
		}else{
			echo 'User not found';
			exit();
		}

	}
?>