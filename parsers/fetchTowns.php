<?php 

	require '../includes/db.php';

	if (isset($_POST['province'])) {
		echo "<option value=''>All Towns</option>";
		$query = $connect->prepare("SELECT * FROM `towns` WHERE `state_id` = ? ");
		$query->execute([$_POST['province']]);
		foreach ($query->fetchAll() as $row) {
			extract($row);
		
		?>
			<option value="<?php echo $id?>"><?php echo $name;?></option>
		<?php 
		} 
	}
?>