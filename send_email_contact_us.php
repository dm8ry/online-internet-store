<?php

	include_once('db_connect.php');
	include_once('admin_email.php');
	
	function isValidEmail($email){ 
		return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
	}
	
	if(isset($_POST['em']) && isset($_POST['fn']) && isset($_POST['ln']) && isset($_POST['sb']) && isset($_POST['ms']))
	{
	
		//Email information
		$admin_email = $admin_email_address;
		$subject = "A new contact message from Crystalsky.co.il";
		$email = htmlspecialchars (substr($_POST['em'], 0, 50));
		$first_name = htmlspecialchars (substr($_POST['fn'], 0 , 50));
		$last_name = htmlspecialchars (substr($_POST['ln'], 0, 50));
		$subj = htmlspecialchars (substr($_POST['sb'],0, 70));
		$msg = htmlspecialchars (substr($_POST['ms'],0, 600));	

		$email=str_replace('"', "", $email);
		$email = str_replace("'", "", $email);
		$email = stripslashes($email);
		
		$first_name=str_replace('"', "", $first_name);
		$first_name = str_replace("'", "", $first_name);
		$first_name = stripslashes($first_name);
		
		$last_name=str_replace('"', "", $last_name);
		$last_name = str_replace("'", "", $last_name);
		$last_name = stripslashes($last_name);		
		
		$subj=str_replace('"', "", $subj);
		$subj = str_replace("'", "", $subj);	
		$subj = stripslashes($subj);
		
		$msg=str_replace('"', "", $msg);
		$msg = str_replace("'", "", $msg);	
		$msg = stripslashes($msg);		
		
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
		  
			$message = '<html><body>Здравствуйте, Crystalsky!' . '<br/><br/>' .
						 'Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!' . '<br/><br/>' .
						 'Дата отправки сообщения: <b>' . $cur_dt . '</b><br/>' .
						 'Имя отправителя сообщения: <b>' . $first_name . '</b><br/>' .
						 'Фамилия отправителя сообщения: <b>' . $last_name . '</b><br/>' .
						 'Email отправителя сообщения: <b>' . $email . '</b><br/>' .
						 'Тема сообщения: <b>' . $subj . '</b><br/>' .
						 'Сообщение: <b>' . $msg . '</b><br/><br/>' .
						 'С уважением, ' . ' <br/>' .
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
				VALUES ('$db_cur_dt', 'SEND_CONTACT_MSG', '$ip_addr', '$email', '$message' )";

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