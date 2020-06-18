<?php
	
	include_once('db_connect.php');
	include_once('admin_email.php');
	
	function isValidEmail($email){ 
		return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
	}
	
	if(isset($_POST['nn']) && isset($_POST['em']) && isset($_POST['cm']) && isset($_POST['ct']))
	{
	
		//Email information
		$admin_email = $admin_email_address;
		$subject = "A new feedback from Crystalsky.co.il";
		$email = htmlspecialchars (substr($_POST['em'], 0, 50));
		$the_name = htmlspecialchars (substr($_POST['nn'], 0 , 50));		
		$city = htmlspecialchars (substr($_POST['ct'], 0 , 50));
		$msg = htmlspecialchars (substr($_POST['cm'],0, 2000));	

		$email=str_replace('"', "", $email);
		$email = str_replace("'", "", $email);
		$email = stripslashes($email);
		
		$city=str_replace('"', "", $city);
		$city = str_replace("'", "", $city);
		$city = stripslashes($city);		
		
		$the_name=str_replace('"', "", $the_name);
		$the_name = str_replace("'", "", $the_name);
		$the_name = stripslashes($the_name);
									
		$msg=str_replace('"', "", $msg);
		$msg = str_replace("'", "", $msg);	
		$msg = stripslashes($msg);	

		$pieces = explode(" ", $msg);
		$subj = implode(" ", array_splice($pieces, 0, 5));
		
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		
		$headers = "From: " . strip_tags($admin_email) . "\r\n";
		$headers .= "Reply-To: ". strip_tags($email) . "\r\n";		
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";		
		
		if (isValidEmail($email))
		{

			$date = new DateTime("now", new DateTimeZone('Asia/Jerusalem') );
			$cur_dt =  $date->format('d-m-Y H:i:s');  
			$db_cur_dt = $date->format('Y-m-d H:i:s'); // same format as NOW()			
		  
			$message = '<html><body>Здравствуйте, Crystalsky!' . '<br/><br/>' ."\n" .
						 'Вам отправлен отзыв пользователя/покупателя сайта Crystalsky.co.il!' . '<br/><br/>' ."\n" .
						 'Дата отправки отзыва: <b>' . $cur_dt . '</b><br/>' ."\n" .
						 'Имя отправителя отзыва: <b>' . $the_name . '</b><br/>' ."\n" .					
						 'Email отправителя отзыва: <b>' . $email . '</b><br/>' ."\n" .
						 'Город отправителя отзыва: <b>' . $city . '</b><br/>' ."\n" .
						 'Тема отзыва: <b>' . $subj . '</b><br/>' ."\n" .
						 'Отзыв: <b>' . $msg . '</b><br/>' ."\n" .
						 'Отзыв будет опубликован на сайте после проверки администратором.</b><br/><br/>' ."\n" .
						 'С уважением, ' . ' <br/>' ."\n" .
						 'Администрация.</body></html>';
			
		 	if (!mail($admin_email, "$subject", $message, $headers)) 
			{
			   // something wrong...
			} else
			{  
				// everything is good...
				
				// log into businesslog
				
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 

				$conn->query("set names 'utf8'");
				
				$sql = "INSERT INTO businesslog (datex, alert_type, ip_addr, email, the_info) 
				VALUES ('$db_cur_dt', 'SEND_FEEDBACK_MSG', '$ip_addr', '$email', '$message' )";

				if ($conn->query($sql) === TRUE) {
					// echo "New record created successfully";
				} else {
					// echo "Error: " . $sql . "<br>" . $conn->error;
				}
				
				$sql = "INSERT INTO feedbacks (datex, email, user_name, user_city, feedback_title, feedback_msg, status, lang) 
				VALUES ('$db_cur_dt', '$email', '$the_name', '$city', '$subj', '$msg', '0', 'ru')";

				if ($conn->query($sql) === TRUE) {
					// echo "New record created successfully";
				} else {
					// echo "Error: " . $sql . "<br>" . $conn->error;
				}				

				$conn->close();				
		 	} 
			
		}
	}
  
?>