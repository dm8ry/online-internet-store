<?php
require_once("./../db_connect.php");
include_once('./../admin_email.php');

	if(isset($_POST['recn']))
	{

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$conn->query("set names 'utf8'");

		$sql = "update coupons set status=1 where name = '".$_POST['recn']."'";
		$result = $conn->query($sql); 
		
		$admin_email = $admin_email_address;
		$subject = "A re-activated coupon from Crystalsky.co.il";		
		
		$date = new DateTime("now", new DateTimeZone('Asia/Jerusalem') );
		$cur_dt =  $date->format('d-m-Y H:i:s');  
		$db_cur_dt = $date->format('Y-m-d H:i:s'); // same format as NOW()	
		
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		
		$headers = "From: " . strip_tags($admin_email) . "\r\n";
		$headers .= "Reply-To: ". strip_tags($admin_email) . "\r\n";		
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";		
		  
		$message = '<html><body>Здравствуйте, Crystalsky!' . '<br/><br/> ' ."\n" .
					 'Купон был реактивирован с панели управления Crystalsky.co.il!' . '<br/><br/> ' ."\n" .
					 'Этот купон был неактивным, и эта операция сделала его активным!' . '<br/>' ."\n" .
					 'Посетители магазина смогут его теперь применять.' . '<br/>' ."\n" .
					 'Дата операции: <b>' . $cur_dt . '</b><br/> ' ."\n" .
					 'Название купона: <b>' . $_POST['recn'] . '</b><br/><br/>' ."\n" .					 
					 'С уважением, ' . ' <br/> ' ."\n" .
					 'Администрация.</body></html>';
			
			
			
		if (!mail($admin_email, "$subject", $message, $headers)) 
		{
		   // something wrong...
		} 
		else
		{  
			// everything is good...			
			// log into businesslog		
			
			$sql = "INSERT INTO businesslog (datex, alert_type, ip_addr, email, the_info) 
			VALUES ('$db_cur_dt', 'REACTIV_COUPON', '$ip_addr', '$admin_email', '$message' )";

			if ($conn->query($sql) === TRUE) {
				// echo "New record created successfully";
			} else {
				// echo "Error: " . $sql . "<br>" . $conn->error;
			}
		} 
 
		$conn->close();
		
	}
?>