<?php 
	require("../../includes/db.php"); 
	if (isset($_POST['applicationId'])) {
		$applicationId = $_POST['applicationId'];
		echo getJobOfferDetails2($connect, $applicationId);
	}
?>