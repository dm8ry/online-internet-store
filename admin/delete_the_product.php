<?php

	//
	// delete the product
	//

	include_once('./../db_connect.php');
	include_once('./../admin_email.php');
		 
	
	function isValidEmail($email){ 
		return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
	}

	if (isset($_POST['makat']) )
	{
			 
		//Email information
		$admin_email = $admin_email_address;
		$subject = "Product was deleted from Crystalsky.co.il";	

		$makat = htmlspecialchars (substr($_POST['makat'], 0, 15));
	
		$makat=str_replace('"', "", $makat);
		$makat = str_replace("'", "", $makat);
		$makat = stripslashes($makat);	
			
		$date = new DateTime("now", new DateTimeZone('Asia/Jerusalem') );
		$cur_dt =  $date->format('d-m-Y H:i:s');  
		$db_cur_dt = $date->format('Y-m-d H:i:s'); // same format as NOW()	
		
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		
		$headers = "From: " . strip_tags($admin_email) . "\r\n";
		$headers .= "Reply-To: ". strip_tags($admin_email) . "\r\n";		
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";		
		  
		$message = '<html><body>Здравствуйте, Crystalsky!' . '<br/><br/> ' ."\n" .
					 'Удаление продукта с панели управления Crystalsky.co.il!' . '<br/><br/> ' ."\n" .
					 'Дата удаления: <b>' . $cur_dt . '</b><br/> ' ."\n" .
					 'Макат товара: <b>' . $makat . '</b><br/>' ."\n" .				 
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
				VALUES ('$db_cur_dt', 'DELETED_PRODUCT', '$ip_addr', '$admin_email', '$message' )";

				if ($conn->query($sql) === TRUE) {
					//  echo "1 New record created successfully";
				} else {
					// echo "Error1: " . $sql . "<br>" . $conn->error;
				}
				
				$sql2 = "DELETE FROM products where makat = '$makat'";

				if ($conn->query($sql2) === TRUE) {
					  // echo "2  record deleted successfully";
				} else {
					  // echo "Error2: " . $sql . "<br>" . $conn->error;
				}				
				
				$sql30 = "update sub_category  sc
						set sc.qty= (select count(1) from products  p where p.status = 1 and p.category = sc.id)";

				if ($conn->query($sql30) === TRUE) {
					//  echo "2 New record created successfully";
				} else {
					//  echo "Error2: " . $sql . "<br>" . $conn->error;
				}				
				
				$conn->close();				
		 	} 
					
		
	}	
	
	
?>