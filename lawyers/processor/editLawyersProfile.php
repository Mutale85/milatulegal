<?php 
	include("../../includes/db.php");
	if (isset($_POST['lawyer_id'])) {
		$lawyer_id = preg_replace("#[^0-9]#", "", $_POST['lawyer_id']);
		$output = "";
		$query = $connect->prepare("SELECT * FROM table_3_lawyer_profile WHERE lawyer_id = ? ");
		$query->execute(array($lawyer_id));
		$row = $query->fetch();
		if ($row) {
			$output = json_encode($row);
		}
		echo $output;
	}
?>