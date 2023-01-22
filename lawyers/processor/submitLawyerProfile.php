<?php 
	include("../../includes/db.php");
	if(isset($_POST['firstname'])){
		$firstname = Clean(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
		$lastname = Clean(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));
		$email = Clean(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS));
		$phonenumber = Clean(filter_input(INPUT_POST, 'phonenumber', FILTER_SANITIZE_SPECIAL_CHARS));
		$currency = Clean(filter_input(INPUT_POST, 'currency', FILTER_SANITIZE_SPECIAL_CHARS));
		$hourly_rate = Clean(filter_input(INPUT_POST, 'hourly_rate', FILTER_SANITIZE_SPECIAL_CHARS));
		$fixed_rate = Clean(filter_input(INPUT_POST, 'fixed_rate', FILTER_SANITIZE_SPECIAL_CHARS));
		$consultation_rate = Clean(filter_input(INPUT_POST, 'consultation_rate', FILTER_SANITIZE_SPECIAL_CHARS));
		$about_me = Clean(filter_input(INPUT_POST, 'about_me', FILTER_SANITIZE_SPECIAL_CHARS));
		$area_of_law = Clean(filter_input(INPUT_POST, 'area_of_law', FILTER_SANITIZE_SPECIAL_CHARS));
		$practice = Clean(filter_input(INPUT_POST, 'practice', FILTER_SANITIZE_SPECIAL_CHARS));
		$jurisdiction = Clean(filter_input(INPUT_POST, 'jurisdiction', FILTER_SANITIZE_SPECIAL_CHARS));
		$firm = Clean(filter_input(INPUT_POST, 'firm', FILTER_SANITIZE_SPECIAL_CHARS));
		$period_of_work = Clean(filter_input(INPUT_POST, 'period_of_work', FILTER_SANITIZE_SPECIAL_CHARS));
		$roles = Clean(filter_input(INPUT_POST, 'roles', FILTER_SANITIZE_SPECIAL_CHARS));
		$qualification = Clean(filter_input(INPUT_POST, 'qualification', FILTER_SANITIZE_SPECIAL_CHARS));
		$institution = Clean(filter_input(INPUT_POST, 'institution', FILTER_SANITIZE_SPECIAL_CHARS));
		$graduation_date = date("Y-m-d", strtotime($_POST['graduation_date']));
		$lawyer_id = preg_replace("#[^0-9]#", "", filter_input(INPUT_POST, 'lawyer_id', FILTER_SANITIZE_SPECIAL_CHARS));
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "invalid email format";
			exit();
		}

		$query = $connect->prepare("SELECT * FROM `table_3_lawyer_profile` WHERE `lawyer_id` = ? ");
		$query->execute([$lawyer_id]);
		$count = $query->rowCount();
		if($count > 0){
			$update = $connect->prepare("UPDATE `table_3_lawyer_profile` SET email = ?, phonenumber = ?, `firstname` = ?, `lastname` = ?, currency = ?, `hourly_rate` = ?, `fixed_rate` = ?, `consultation_rate` = ?, `about_me` = ?, `area_of_law` = ?, `practice` = ?, `jurisdiction` = ?, `firm` = ?, `period_of_work` = ?, `roles` = ?, `qualification` = ?, `institution` = ?, `graduation_date` = ? WHERE `lawyer_id` = ? ");
			$ex = $update->execute([$email, $phonenumber, $firstname, $lastname, $currency, $hourly_rate, $fixed_rate, $consultation_rate, $about_me, $area_of_law, $practice, $jurisdiction, $firm, $period_of_work, $roles, $qualification, $institution, $graduation_date, $lawyer_id]);
			$update = $connect->prepare("UPDATE `table_members` SET `firstname` = ?, lastname = ?, phonenumber = ?, email = ? WHERE id = ? ");
			$update->execute([$firstname, $lastname, $phonenumber, $email, $lawyer_id ]);
			if ($ex) {
				echo "Your details have been updated";
				$_SESSION['firstname'] = $firstname;
				$_SESSION['lastname'] = $lastname;
			}
		}else{
			$sql = $connect->prepare("INSERT INTO `table_3_lawyer_profile`(`lawyer_id`, `email`, `phonenumber`, `firstname`, `lastname`, `currency`, `hourly_rate`, `fixed_rate`, `consultation_rate`, `about_me`, `area_of_law`, `practice`, `jurisdiction`, `firm`, `period_of_work`, `roles`, `qualification`, `institution`, `graduation_date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

			$ex = $sql->execute([$lawyer_id, $email, $phonenumber, $firstname, $lastname, $currency, $hourly_rate, $fixed_rate, $consultation_rate, $about_me, $area_of_law, $practice, $jurisdiction, $firm, $period_of_work, $roles, $qualification, $institution, $graduation_date]);
			$update = $connect->prepare("UPDATE `table_members` SET `firstname` = ?, lastname = ?, phonenumber = ?, email = ? WHERE id = ? ");
			$update->execute([$firstname, $lastname, $phonenumber, $email, $lawyer_id ]);
			$_SESSION['firstname'] = $firstname;
			$_SESSION['lastname'] = $lastname;
			if ($ex) {
				echo "Your details have been updated";
			}
		}
	}
?>