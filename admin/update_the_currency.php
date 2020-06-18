<?php

	//
	// update the product
	//

	include_once('./../db_connect.php');
	include_once('./../admin_email.php');
	
	mb_internal_encoding("UTF-8");
	
	$flg_photo1 = false;
	 
	$uploadOk = 1;
	 
	
	function isValidEmail($email){ 
		return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
	}

	if (isset($_POST['curr_rowid']) && isset($_POST['rate']) && isset($_POST['curr_sign']) && isset($_POST['curr_desc']) && isset($_POST['curr_name']) )
	{
		 
		//Email information
		$admin_email = $admin_email_address;
		$subject = "Currency Update on Crystalsky.co.il";	

		$rowid = $_POST['curr_rowid'];
		
		$curr_name = $_POST['curr_name'];
		$curr_desc = $_POST['curr_desc'];
		$curr_sign = $_POST['curr_sign'];
		$curr_orig_rate = $_POST['curr_orig_rate'];
		$rate = $_POST['rate'];		
	
		$date = new DateTime("now", new DateTimeZone('Asia/Jerusalem') );
		$cur_dt =  $date->format('d-m-Y H:i:s');  
		$db_cur_dt = $date->format('Y-m-d H:i:s'); // same format as NOW()	
		
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		
		$headers = "From: " . strip_tags($admin_email) . "\r\n";
		$headers .= "Reply-To: ". strip_tags($admin_email) . "\r\n";		
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";		
		  
		$message = '<html><body>Здравствуйте, Crystalsky!' . '<br/><br/> ' ."\n" .
					 'Курс валюты <b>'.$curr_sign.'</b> был изменен на Crystalsky.co.il!' . '<br/><br/> ' ."\n" .
					 'Дата изменения: <b>' . $cur_dt . '</b><br/> ' ."\n" .					
					 'Название валюты: <b>' . $curr_name . '</b><br/> ' ."\n" .
					 'Описание валюты: <b>' . $curr_desc . '</b><br/> ' ."\n" .
					 'Знак валюты: <b>' . $curr_sign . '</b><br/> ' ."\n" .
					 'Изначальный курс валюты: <b>' . money_format('%i', $curr_orig_rate ). '</b><br/> ' ."\n" .
					 'Измененный курс валюты: <b>' . money_format('%i', $rate ). '</b><br/> ' ."\n" .
					 '<br/>С уважением, ' . ' <br/> ' ."\n" .
					 'Администрация.</body></html>';		
		
		 	if (!mail($admin_email, "$subject", $message, $headers)) 
			{
			   // something wrong...
			   // echo "something wrong ";
			   
			} else
			{  				
				// everything is good...
				// echo "everything is good ";
				
				// log into businesslog
				
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 

				$conn->query("set names 'utf8'");
				
				$sql = "INSERT INTO businesslog (datex, alert_type, ip_addr, email, the_info) 
				VALUES ('$db_cur_dt', 'CURRENCY_RATE_CHANGED', '$ip_addr', '$admin_email', '$message' )";

				if ($conn->query($sql) === TRUE) {
					//  echo "1 New record created successfully";
				} else {
					// echo "Error1: " . $sql . "<br>" . $conn->error;
				}

				$sql2 = " update currencies 
							set 
								modify_dt = '$db_cur_dt',
								rate = $rate
							where id = ".$rowid;
				
				if ($conn->query($sql2) === TRUE) {
					 // echo "2 Record created successfully";
				} else {
					 // echo "Error2: " . $sql2 . "<br>" . $conn->error;
				}
				
				$conn->close();				
		 	} 
					
		
	}	
	
	
?>