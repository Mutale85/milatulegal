<?php
	function time_ago_check($time){
		date_default_timezone_set("Africa/Lusaka");
		$time_ago 	= strtotime($time);
		$current_time = time();
		$time_difference = $current_time - $time_ago;
		$seconds = $time_difference;
		//lets make tround thes into actual time.
		$minutes 	= round($seconds / 60);
		$hours		= round($seconds / 3600);
		$days 		= round($seconds / 86400);
		$weeks   	= round($seconds / 604800); // 7*24*60*60;  
		$months  	= round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60  
		$years   	= round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60

		if ($seconds <= 60) {
			return "$seconds Seconds Ago";
		}else if ($minutes <= 60) {

			if ($minutes == 1) {
				return "1 minute Ago";
			}else{
				return "$minutes minutes ago";
			}
			
		}else if ($hours <= 24) {
			if ($hours == 1) {
				return "1 hour ago";
			}else{
				return "$hours hrs ago";
			}
		}else if ($days <= 7) {
			if ($days == 1) {
				return "1 day ago";
			}else{
				return "$days days ago";
			}
		}else if ($weeks < 7) {
			if ($weeks == 1) {
			
				return "1 week ago";
			}else{
				return "$weeks Weeks ago";
			}
		}else if ($months <= 12) {
			if ($months == 1) {
				return "1 month ago";
			}else{
				return "$months Months ago";
			}
		}else {
			if ($years == 1) {
				return "One year ago";
			}else{
				return "$years years ago";
			}
		}
	}
	
	// time lapsed created by chatGPT
	// function time_elapsed_string($datetime, $full = false) {
    //     $now = new DateTime;
    //     $ago = new DateTime($datetime);
    //     $diff = $now->diff($ago);
    
    //     $diff->w = floor($diff->d / 7);
    //     $diff->d -= $diff->w * 7;
    
    //     $string = array(
    //         'y' => 'year',
    //         'm' => 'month',
    //         'w' => 'week',
    //         'd' => 'day',
    //         'h' => 'hour',
    //         'i' => 'minute',
    //         's' => 'second',
    //     );
    //     foreach ($string as $k => &$v) {
    //         if ($diff->$k) {
    //             $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
    //         } else {
    //             unset($string[$k]);
    //         }
    //     }
    
    //     if (!$full) $string = array_slice($string, 0, 1);
    //     return $string ? implode(', ', $string) . ' ago' : 'just now';
    // }

	
	
	function Clean($string){
		return htmlspecialchars($string);
		return trim($string);
	}

	function get_gravatar( $email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array() ) {
		$url = 'https://www.gravatar.com/avatar/';
		$url .= md5( strtolower( trim( $email ) ) );
		$url .= "?s=$s&d=$d&r=$r";
		if ( $img ) {
			$url = '<img src="' . $url . '"';
			foreach ( $atts as $key => $val )
				$url .= ' ' . $key . '="' . $val . '"';
			$url .= ' />';
		}
		return $url;
	}

	function getProvince($connect, $province){
		$query = $connect->prepare("SELECT * FROM `provinces` WHERE id = ?");
		$query->execute([$province]);
		$row = $query->fetch();
		return htmlspecialchars_decode($row['name']);
	}

	function getTown($connect, $town){
		$query = $connect->prepare("SELECT * FROM `towns` WHERE id = ?");
		$query->execute([$town]);
		$row = $query->fetch();
		if($row){
			return htmlspecialchars_decode($row['name']);
		}
	}

	function getLawyersBio($connect, $lawyer_id){
		$query = $connect->prepare("SELECT * FROM table_3_lawyer_profile WHERE lawyer_id = ?");
	    $query->execute([$lawyer_id]);
	    $row = $query->fetch();
	    extract($row);
		if($row){
	    	return htmlspecialchars_decode($about_me);
		}
	}

	function fetchClientPhoneBYCaseId($connect, $case_id){
		$query = $connect->prepare("SELECT * FROM table_legal_requests WHERE id = ? ");
		$query->execute([$case_id]);
		$row = $query->fetch();
		extract($row);
		return $phonenumber;
	}

	function getUserByPhoneNumber($connect, $phonenumber){
		$query = $connect->prepare("SELECT * FROM table_members WHERE phonenumber = ? ");
		$query->execute([$phonenumber]);
		$row = $query->fetch();
		if($row){
			extract($row);
			return htmlspecialchars_decode($firstname .' '.$lastname);
		}
	}

	function checkEngamentStatus($connect, $client_id, $lawyer_id){
		$output = '';
		$query = $connect->prepare("SELECT * FROM table_applications WHERE client_id = ? AND lawyer_id = ? AND offer_Job = '1' ");
		$query->execute([$client_id, $lawyer_id]);
		if($query->rowCount() > 0 ){
			$row = $query->fetch();
			$id = $row['id'];
			$output =  '<a href="'.$id.'" class="engaged"> Enganged </a>';
		}else{
			$output =  '<small>Not Engaged</small>';
		}

		return $output;
	}

	function getJobOfferDetails1($connect, $applicationId){
		$output = '';
		$query = $connect->prepare("SELECT * FROM table_job_offers WHERE job_id = ?  ");
		$query->execute([$applicationId]);
		$row = $query->fetch();
		extract($row);
		if($row){
			$output =  '<p>Date offered: '.date("j F Y", strtotime($date_offered)).'</p>';
		}
		return $output;
	}

	function getJobOfferDetails2($connect, $applicationId){
		$output = '';
		$query = $connect->prepare("SELECT * FROM table_applications WHERE id = ? AND offer_Job = '1' ");
		$query->execute([$applicationId]);
		
		$row = $query->fetch();
		extract($row);
		$output = '	<p>'.htmlspecialchars_decode($introduction).'</p>
                    <p>'.htmlspecialchars_decode($costing).'</p>
                    <hr>
                    <p>Application Date: '.date("j F Y", strtotime($date_applied)).'</p>
                    '.getJobOfferDetails1($connect, $applicationId).'
                    ';


		
		return $output;
	}


	function checkLawyerEngagementStatus($connect, $client_id, $lawyer_id){
		$output = '';
		$query = $connect->prepare("SELECT * FROM table_job_offers WHERE client_id = ? AND lawyer_id = ? ");
		$query->execute([$client_id, $lawyer_id]);
		if($query->rowCount() > 0 ){
			
			$output =  '<span class="text-success"> Engaged </a>';
		}else{
			$output =  '<span class="text-secondary"> ---- </a>';
		}

		return $output;
	}


	function getLawyerSpeciality($connect, $phonenumber){
		$output = "";
		$query = $connect->prepare("SELECT * FROM `table_3_lawyer_profile` WHERE phonenumber = ?");
		$query->execute([$phonenumber]);
		if($query->rowCount() > 0){
			$row = $query->fetch();
			$output = $row['area_of_law'];
		}else{
			$output = 'Not yet added';
		}
		return $output;
	}

	function covertprovinceToId($connect, $province) {
		$query = $connect->prepare("SELECT * FROM `provinces` WHERE name = ?");
		$query->execute([$province]);
		$row = $query->fetch();
		return $row['id'];
	}

	function coverttownToId($connect, $town) {
		$query = $connect->prepare("SELECT * FROM `towns` WHERE name = ?");
		$query->execute([$town]);
		$row = $query->fetch();
		return $row['id'];
	}
	function lawyersProfile($connect, $lawyer_id){
		$output = '';
		$query = $connect->prepare("SELECT * FROM table_3_lawyer_profile WHERE lawyer_id = ?");
	    $query->execute([$lawyer_id]);
	    $rows = $query->fetch();
	    if($query->rowCount() > 0){
		    extract($rows);
		$output = '
            <p>'. $about_me .'</p>
            <h4>Area of Law and Practice:</h4>
			<p><b>'. $area_of_law.'</b></p>
			<p>'. $practice.'</p>
			<p><small>Consultation Fee: '. $currency.' '. $consultation_rate .'</small></p>
			<p><small>Hourly Rate: '. $currency.' '. $hourly_rate .'</small></p>
			<p><small>Fixed Rate: '. $currency.' '. $fixed_rate .'</small></p>

			<p><a href="'.base64_encode($phonenumber).'" data-consultation="'.$consultation_rate.'" data-currency="'.$currency.'" class="btn btn-outline-dark m-1 py-2 px-4 rounded-pill consult">Consult Lawyer</a></p>
		';
	 
		}else{
			$output ='<p>Lawyers profile not complete</p>';
		}

		return $output;
	}



	function sendSMS( $to, $content, $from){
		$username = 'rqwn2845';
		$password = 'B4DERIny';

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://rest-api.d7networks.com/secure/send",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS =>"{\n\t\"to\":\"".$to."\",\n\t\"content\":\"".$content."\",\n\t\"from\":\"".$from."\",\n\t\"dlr\":\"yes\",\n\t\"dlr-method\":\"GET\", \n\t\"dlr-level\":\"2\", \n\t\"dlr-url\":\"http://yourcustompostbackurl.com\"\n}",
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/x-www-form-urlencoded",
				"Authorization: Basic cnF3bjI4NDU6QjRERVJJbnk="
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		return $response;
	}

	function SMSNOW($to, $message, $api_key, $sender_id){
        $url = 'https://bulksms.zamtel.co.zm/api/v2.1/action/send/api_key/'.$api_key.'/contacts/'.$to.'/senderId/'.$sender_id.'/message/'.$message.'';

        $gateway_url = $url;

        try {
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $gateway_url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_HTTPGET, 1);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
          $output = curl_exec($ch);

          if (curl_errno($ch)) {
            $output = curl_error($ch);
          }
          curl_close($ch);

          //var_dump($output);

        }catch (Exception $exception){
          echo $exception->getMessage();
        } 
    }

	function getHiredLawyer($connect, $job_id){
		$query = $connect->prepare("SELECT * FROM table_job_offers WHERE job_id = ?");
		$query->execute([$job_id]);
		$row = $query->fetch();
		if($row){
			return $row['lawyer_id'];
		}
	}

	function getLegalRequestName($connect, $case_id){
     	$query = $connect->prepare("SELECT * FROM table_legal_requests WHERE id = ? ");
		$query->execute([$case_id]);
		$row = $query->fetch();
		extract($row);
      	if($row){
			return $case_title;
        }
    }
?>


