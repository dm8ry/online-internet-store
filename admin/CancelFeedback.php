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

		$sql = "update feedbacks set status=0 where id = '".$_POST['recn']."'";
		$result = $conn->query($sql); 
		
		$admin_email = $admin_email_address;
		$subject = "A deactivated feedback from Crystalsky.co.il";		
		
		$date = new DateTime("now", new DateTimeZone('Asia/Jerusalem') );
		$cur_dt =  $date->format('d-m-Y H:i:s');  
		$db_cur_dt = $date->format('Y-m-d H:i:s'); // same format as NOW()	
		
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		
		$headers = "From: " . strip_tags($admin_email) . "\r\n";
		$headers .= "Reply-To: ". strip_tags($admin_email) . "\r\n";		
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";		
		  
		$message = '<html><body>Здравствуйте, Crystalsky!' . '<br/><br/> ' ."\n" .
					 'Отзыв был деактивирован с панели управления Crystalsky.co.il!' . '<br/><br/> ' ."\n" .
					 'Этот отзыв был активным, и эта операция сделала его неактивным!' . '<br/>' ."\n" .
					 'Посетители магазина <u>не</u> смогут его теперь видеть.' . '<br/>' ."\n" .					 
					 'Дата операции: <b>' . $cur_dt . '</b><br/> ' ."\n" .
					 'Номер отзыва: <b>' . $_POST['id'] . '</b><br/> ' ."\n" .
					 'Заголовок отзыва: <b>' . $_POST['ft'] . '</b><br/> ' ."\n" .
					 'Имя пользователя, оставившего отзыв: <b>' . $_POST['un'] . '</b><br/>' ."\n" .
					 'Город пользователя, оставившего отзыв: <b>' . $_POST['uc'] . '</b><br/><br/>' ."\n" .
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
			VALUES ('$db_cur_dt', 'DEACTIV_FEEDBACK', '$ip_addr', '$admin_email', '$message' )";

			if ($conn->query($sql) === TRUE) {
				// echo "New record created successfully";
			} else {
				// echo "Error: " . $sql . "<br>" . $conn->error;
			}
		} 
 
		$conn->close();
		
	}
?>