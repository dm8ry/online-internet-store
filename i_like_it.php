<?php
	
	include_once('db_connect.php');
	include_once('admin_email.php');
	
	function isValidEmail($email){ 
		return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
	}
	
	if(isset($_POST['like_email']))
	{
	
		//Email information
		$admin_email = $admin_email_address;
		$subject = "A new Like from Crystalsky.co.il";
		
		$email = htmlspecialchars (substr($_POST['like_email'], 0, 50));

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
						 'Новый Лайк на сайте Crystalsky.co.il!' . '<br/><br/>' . "\r\n".
						 'Дата Лайка: <b>' . $cur_dt . '</b><br/>' . "\r\n".					
						 'Имя пользователя, поставившего Лайк: <b>' . $_POST['like_firstname'] . '</b><br/>' . "\r\n".
						 'Емайл пользователя, поставившего Лайк: <b>' . $email . '</b><br/>' . "\r\n".
						 'Город пользователя, поставившего Лайк: <b>' . $_POST['like_city'] . '</b><br/>' . "\r\n".
						 'Телефон пользователя, поставившего Лайк: <b>' . $_POST['like_phone'] . '</b><br/>' . "\r\n".
						 'Лайк поставлен за: <a href="https://www.crystalsky.co.il/item.php?i='.$_POST['like_product_id'].'#come_here" target="_blank"><b>"' . $_POST['like_product_name'] . '"</b></a>.<br/><br/>' . "\r\n".
 						 'Этот пользователь проявил интерес к товару, и он оставил свои имя, емайл, город, телефон. <br/>' . "\r\n".
						 'Попробуйте с ним/с ней связаться и предложить ему/ей изделие, которое ему/ей понравилось. <br/>' . "\r\n".
						 'Расскажите ему/ей о скидках и мероприятиях Вашего магазина. <br/>' . "\r\n".
						 'Возможно, это Ваш будущий покупатель/покупательница!<br/><br/>' . "\r\n".						 
						 'С уважением, ' . ' <br/>' . "\r\n".
						 'Администрация.</body></html>';
			
		 	if (!mail($admin_email, "$subject", $message, $headers)) 
			{
			   // something wrong...
			} 
			else
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
				
				$n_recs = 0;
				
				$sql = "SELECT count(1) n_recs FROM likeslog where ip_addr='".$ip_addr."' and prod_id = ".$_POST['like_product_id']." ";
		
				$result = $conn->query($sql);

				if ($result->num_rows == 1) 
				{    					
					$row = $result->fetch_assoc();
					$n_recs =  $row['n_recs'];					  
				} 
				else 
				{
					$n_recs = -1;
				}
				
				if ($n_recs == 0)
				{
				
					$sql = "INSERT INTO businesslog (datex, alert_type, ip_addr, email, the_info) 
					VALUES ('$db_cur_dt', 'LIKE', '$ip_addr', '$email', '$message' )";

					if ($conn->query($sql) === TRUE) {
						// echo "New record created successfully";
					} else {
						// echo "Error: " . $sql . "<br>" . $conn->error;
					}
								
					$like_firstname = $_POST['like_firstname'];
					$like_city = $_POST['like_city'];
					$like_phone = $_POST['like_phone'];
					$like_product_id = $_POST['like_product_id'];
					$like_product_name = $_POST['like_product_name'];
								
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
							('$like_firstname','','$db_cur_dt','$db_cur_dt','$ip_addr','$email','','$like_city','$like_phone', 0, '$like_product_id', 'Посетитель поставил Лайк! Ему понравился $like_product_name. Емайл пользователя: $email. Имя пользователя: $like_firstname. Телефон пользователя: $like_phone. Возможно ему интересны товары магазина, и он - потенциальный покупатель!')";

					if ($conn->query($sql) === TRUE) {
						// echo "New record created successfully";
					} else {
						// echo "Error: " . $sql . "<br>" . $conn->error;
					}				

					
					$sql = "update products
							set likes = likes + 1
							where id = $like_product_id ";						

					if ($conn->query($sql) === TRUE) {
						// echo "Update run successfully";
					} else {
						// echo "Error: " . $sql . "<br>" . $conn->error;
					}					
					
					
								
					$sql = "INSERT INTO likeslog
							(ip_addr, prod_id, like_dt) 
							VALUES 
							('$ip_addr', $like_product_id, '$db_cur_dt')";

					if ($conn->query($sql) === TRUE) {
						// echo "New record created successfully";
					} else {
						// echo "Error: " . $sql . "<br>" . $conn->error;
					}					
				
				}
								
				$conn->close();				
		 	} 
			
		}
	}
  
?>