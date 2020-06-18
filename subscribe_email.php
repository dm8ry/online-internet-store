<?php
	
	include_once('db_connect.php');
	include_once('admin_email.php');
	
	function isValidEmail($email){ 
		return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
	}
	
	if(isset($_POST['subscr_email']))
	{
	
		//Email information
		$admin_email = $admin_email_address;
		$subject = "A new email subscriber from Crystalsky.co.il";
		
		$email = htmlspecialchars (substr($_POST['subscr_email'], 0, 50));

		$email=str_replace('"', "", $email);
		$email = str_replace("'", "", $email);
		$email = stripslashes($email);			
		
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
		  
			$message = '<html><body>Здравствуйте, Crystalsky!' . '<br/><br/>' . "\r\n".
						 'Новый подписчик на сайте Crystalsky.co.il!' . '<br/><br/>' . "\r\n".
						 'Дата подписки: <b>' . $cur_dt . '</b><br/>' . "\r\n".				
						 'Емайл подписчика: <b>' . $email . '</b><br/><br/>' . "\r\n".	
						 'Возможно, этот человек заинтересовался магазином и представленными товарами.<br/>' . "\r\n".
						 'Расскажите ему/ей о новинках, популярных товарах и мероприятиях.<br/><br/>' . "\r\n".						 
						 'С уважением, ' . ' <br/>' . "\r\n".
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
				VALUES ('$db_cur_dt', 'EMAIL_SUBSCRIBER', '$ip_addr', '$email', '$message' )";

				if ($conn->query($sql) === TRUE) {
					// echo "New record created successfully";
				} else {
					// echo "Error: " . $sql . "<br>" . $conn->error;
				}
				
				$sql = "INSERT INTO email_subscr (datex, email, status) 
				VALUES ('$db_cur_dt', '$email', '1')";

				if ($conn->query($sql) === TRUE) {
					// echo "New record created successfully";
				} else {
					// echo "Error: " . $sql . "<br>" . $conn->error;
				}				

				
				$sql = "INSERT INTO customerlead
						(`lead_fname`, 
						`lead_lname`, 
						`lead_createdt`, 
						`lead_modifydt`, 
						`lead_ip`, 
						`lead_email`, 
						`lead_country`, 
						`lead_city`, 
						`lead_phone`,
						`lead_status_id`,
						`lead_product_id`,
						`lead_comments`) 
						VALUES 
						('No','No','$db_cur_dt','$db_cur_dt','$ip_addr','$email','','','', 0, '', 'Посетитель оставил свой емайл, чтобы быть в курсе всех новостей и мероприятий магазина *Crystal Sky*. Возможно - это потенциальный клиент, потенциальный покупатель!')";

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