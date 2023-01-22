<?php
	include 'includes/db.php';
	setcookie("legallinkLogin", "", time() - 36000, "/");
	setcookie("legallinkLoginAccount", "", time() - 36000, "/");
	unset($_SESSION['userEmail']);
	unset($_SESSION['userId']);
	unset($_SESSION['firstname']);
	unset($_SESSION['lastname']);
	unset($_SESSION['userType']);
	session_unset();
	session_destroy();
	header("location:access/login");
?>