<?php

	//
	// delete the product
	//

	include_once('./../db_connect.php');
	include_once('./../admin_email.php');
		 
	
	function isValidEmail($email){ 
		return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
	}

	if (isset($_POST['erowid']) )
	{
			 
		//Email information
		$admin_email = $admin_email_address;
		$subject = "Post from blog was deleted from Crystalsky.co.il";	

		$postId = $_POST['erowid'];
			
		$date = new DateTime("now", new DateTimeZone('Asia/Jerusalem') );
		$cur_dt =  $date->format('d-m-Y H:i:s');  
		$db_cur_dt = $date->format('Y-m-d H:i:s'); // same format as NOW()	
		
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		
		$headers = "From: " . strip_tags($admin_email) . "\r\n";
		$headers .= "Reply-To: ". strip_tags($admin_email) . "\r\n";		
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";		
		  
		$message = '<html><body>Здравствуйте, Crystalsky!' . '<br/><br/> ' ."\n" .
					 'Удаление поста из блога сайта с панели управления Crystalsky.co.il!' . '<br/><br/> ' ."\n" .
					 'Дата удаления поста: <b>' . $cur_dt . '</b><br/> ' ."\n" .
					 'Номер поста: <b>' . $postId . '</b><br/>' ."\n" .				 
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
				VALUES ('$db_cur_dt', 'POST_DELETED', '$ip_addr', '$admin_email', '$message' )";

				if ($conn->query($sql) === TRUE) {
					//  echo "1 New record created successfully";
				} else {
					// echo "Error1: " . $sql . "<br>" . $conn->error;
				}
				
				$sql2 = "DELETE FROM posts where id = $postId";

				if ($conn->query($sql2) === TRUE) {
					  // echo "2  record deleted successfully";
				} else {
					  // echo "Error2: " . $sql . "<br>" . $conn->error;
				}				
				
				$conn->close();				
		 	} 
					
		
	}	
	
	
?>