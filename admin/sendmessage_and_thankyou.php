<?php
session_start();
include_once('./../admin_email.php');
include_once('./../db_connect.php');

function isValidEmail($email){ 
	return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}


if(isset($_POST['form-first-name']) && isset($_POST['form-email']) && isset($_POST['form-about-yourself']))
	{
	
		$admin_email = $admin_email_address;
		$subject = "A new admin contact message from Crystalsky.co.il Admin Panel";

		$firstname = htmlspecialchars (substr($_POST['form-first-name'], 0, 50));
		$email = htmlspecialchars (substr($_POST['form-email'], 0, 50));
		$about = htmlspecialchars (substr($_POST['form-about-yourself'], 0, 500));
		
		$firstname=str_replace('"', "", $firstname);
		$firstname = str_replace("'", "", $firstname);
		$firstname = stripslashes($firstname);	
		
		$email=str_replace('"', "", $email);
		$email = str_replace("'", "", $email);
		$email = stripslashes($email);	

		$about=str_replace('"', "", $about);
		$about = str_replace("'", "", $about);
		$about = stripslashes($about);

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
						 'Вам отправлено сообщение со страницы управления сайтом Crystalsky.co.il!' . '<br/><br/>' .
						 'Дата отправки сообщения: <b>' . $cur_dt . '</b><br/>' .
						 'Имя отправителя сообщения: <b>' . $firstname . '</b><br/>' .
						 'Email отправителя сообщения: <b>' . $email . '</b><br/>' .						
						 'Сообщение: <b>' . $about . '</b><br/><br/>' .
						 'С уважением, ' . ' <br/>' .
						 'Администрация.</body></html>';
			
		 	if (!mail($admin_email, "$subject", $message, $headers)) 
			{			
				// everything is good...
			}
			else
			{
				// log into businesslog
				
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 

				$conn->query("set names 'utf8'");
				
				$sql = "INSERT INTO businesslog (datex, alert_type, ip_addr, email, the_info) 
				VALUES ('$db_cur_dt', 'SEND_ADMIN_CONTACT_MSG', '$ip_addr', '$email', '$message' )";

				if ($conn->query($sql) === TRUE) {
					// echo "New record created successfully";
				} else {
					// echo "Error: " . $sql . "<br>" . $conn->error;
				}

				$conn->close();		
			}
		
		}		
	
	}

	header("Location: contactus_thankyou.php"); 
?>