<?php
	include("../../includes/db.php");
	if (isset($_POST['message_id'])) {
		$query = $connect->prepare("SELECT * FROM table_messages WHERE id = ? ");
        $query->execute([$_POST['message_id']]);
        $row = $query->fetch();
        extract($row);
        $update = $connect->prepare("UPDATE table_messages SET message_status = '1' WHERE id = ?");
        $query->execute([$_POST['message_id']]);
        echo htmlspecialchars_decode($message);
	}
?>