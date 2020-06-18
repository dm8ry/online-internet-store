<?php
	
	include_once('db_connect.php');
	include_once('admin_email.php');	
	
	if(isset($_POST['postId']))
	{
		$ip_addr=$_SERVER['REMOTE_ADDR'];
	
		// Create connection
		$conn0 = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn0->connect_error) {
			die("Connection failed: " . $conn0->connect_error);
		} 

		$conn0->query("set names 'utf8'");	
		
		$sql0 = "SELECT likes FROM posts where last_like_ip='".$ip_addr."' and id = ".$_POST['postId']." ";
		
		$result0 = $conn0->query($sql0);

		if ($result0->num_rows == 1) 
		{    
			// echo "Ошибка! Существующий Лайк!";
			
			$row = $result0->fetch_assoc();
			echo $row['likes'];
			exit();	    
		} 
		else 
		{
			// Ok
		}
		
		$conn0->close();	
	
		//Email information
		$admin_email = $admin_email_address;
		$subject = "A new post like from Crystalsky.co.il";
				
		//$ip_addr=$_SERVER['REMOTE_ADDR'];
		
		$headers = "From: " . strip_tags($admin_email) . "\r\n";
		$headers .= "Reply-To: ". strip_tags($email) . "\r\n";		
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";		
		
 
		$date = new DateTime("now", new DateTimeZone('Asia/Jerusalem') );
		$cur_dt =  $date->format('d-m-Y H:i:s');  
		$db_cur_dt = $date->format('Y-m-d H:i:s'); // same format as NOW()			
	  
		$message = '<html><body>Здравствуйте, Crystalsky!' . '<br/><br/>' .
					 'Сообщение блога понравилось посетителю Crystalsky.co.il!' . '<br/><br/>' .
					 'Дата Лайка: <b>' . $cur_dt . '</b><br/>' .					
					 'Понравившееся Сообщение: <b><a href="http://crystalsky.co.il/post.php?i='.$_POST['postId'].'#come_here" target="_blank">' . $_POST['postTitle'] . '</a></b><br/>' .
					 'IP адрес посетителя: <a href="http://www.geoplugin.net/json.gp?ip='.$ip_addr.'" target="_blank"><b>'.$ip_addr.'</b></a><br/><br/> ' ."\n" .
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
			VALUES ('$db_cur_dt', 'LIKE_POST', '$ip_addr', '$email', '$message' )";

			if ($conn->query($sql) === TRUE) {
				// echo "New record created successfully";
			} else {
				// echo "Error: " . $sql . "<br>" . $conn->error;
			}
			
			$sql = "update posts set likes=likes+1, last_like_ip='".$ip_addr."' where last_like_ip!='".$ip_addr."' and id=".$_POST['postId']." ";

			if ($conn->query($sql) === TRUE) {
				//  echo "Record updated successfully";
			} else {
				//  echo "Error: " . $sql . "<br>" . $conn->error;
			}						

			$sql = "select likes from posts where id=".$_POST['postId']." ";
			
			$result = $conn->query($sql);
			
			$n_of_rows = $result->num_rows;
			
			$row = $result->fetch_assoc();
			
			echo $row['likes'];
			
			$conn->close();				
		} 
		
		 
	}
  
?>