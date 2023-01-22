<?php 
	require("../../includes/db.php");
	if (isset($_POST['client_id'])) {
		$client_id = preg_replace("#[^0-9]#", "", $_POST['client_id']);
		$output = "";
		$query = $connect->prepare("SELECT * FROM table_members WHERE id = ? ");
		$query->execute(array($client_id));
		$row = $query->fetch();
		if ($row) {
			$output = json_encode($row);
		}
		echo $output;
	}
?>