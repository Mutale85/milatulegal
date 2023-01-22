<?php

	include("../includes/db.php");
	if (isset($_POST['email'])) {
		$email = Clean(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS));
		$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "email is invalid";
			exit();
		}

		if ($password == "") {
			echo "password is empty";
			exit();
		}
		
		$query = $connect->prepare("SELECT * FROM admins WHERE email = ? ");
		$query->execute(array($email));
		if ($query->rowCount() > 0) {
			foreach ($query->fetchAll() as $row) {
				if($access = '1'){
					if (password_verify($password, $row['password'])) {
						$_SESSION['adminEmail'] 	= $row['email'];
					    $_SESSION['username'] 		= $row['username'];
					    $_SESSION['access_level'] 	= $row['access_level'];

					    setcookie("MilatuLoginAdmin", base64_encode($_SESSION['adminEmail']. password_hash($_SESSION['adminEmail'], PASSWORD_DEFAULT)), time()+60*60*24*30, '/');
						setcookie("MilatuLoginAdminAccount", $row['access_level'], time()+60*60*24*30, '/');
					    				    
					    echo "Redirecting you in 1 Second";


					}else{
						echo "Incorrect login credentials";
						exit();
					}
				}else{
					echo "You are not althorised beyound this stage";
					exit();
				}
			}
		}else{
			echo 'User not found';
			exit();
		}

	}
?>