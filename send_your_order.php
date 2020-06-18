<?php

	include_once('db_connect.php');
	include_once('admin_email.php');
	
	function isValidEmail($email){ 
		return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
	}
	
	if(isset($_POST['fn']) && isset($_POST['ln']) && isset($_POST['ln']) && isset($_POST['pn']) && isset($_POST['em']) && isset($_POST['it']) )
	{
	
		
		// Create connection
		$conn0 = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn0->connect_error) {
			die("Connection failed: " . $conn0->connect_error);
		} 

		$conn0->query("set names 'utf8'");	
		
		$sql0 = "select * from delivery where id = ".$_POST['de'];
		
		$result0 = $conn0->query($sql0);

		$delivery_cost = 0.00;
		$delivery_desc = "";
		
		if ($result0->num_rows == 1) 
		{    
			$row = $result0->fetch_assoc();
			$delivery_cost = $row["delivery_cost_nis"];
			$delivery_desc = $row["delivery_desc"];
			
		} 
		else 
		{
			// Nothing to do...
			
		}
		
		$conn0->close();
	
	
		//Email information
		$admin_email = $admin_email_address;
		$subject = "A new order from Crystalsky.co.il";
		
		$country = htmlspecialchars (substr($_POST['cn'], 0, 50));
		$first_name = htmlspecialchars (substr($_POST['fn'], 0 , 50));
		$last_name = htmlspecialchars (substr($_POST['ln'], 0, 50));		
		$address = htmlspecialchars (substr($_POST['ad'], 0, 100));		
		$zipcode = htmlspecialchars (substr($_POST['zp'], 0, 20));
		$phone = htmlspecialchars (substr($_POST['pn'], 0, 50));			
		$email = htmlspecialchars (substr($_POST['em'], 0, 50));		
		$rem = htmlspecialchars (substr($_POST['rem'], 0, 1000));
		$city = htmlspecialchars (substr($_POST['ct'], 0, 50));		 

		$curr_desc = $_POST['curr_desc'];
		$rate = $_POST['rate'];
		$the_curr_sign = $_POST['the_curr_sign'];
		
		$country=str_replace('"', "", $country);
		$country = str_replace("'", "", $country);
		$country = stripslashes($country);
		
		$first_name=str_replace('"', "", $first_name);
		$first_name = str_replace("'", "", $first_name);
		$first_name = stripslashes($first_name);
		
		$last_name=str_replace('"', "", $last_name);
		$last_name = str_replace("'", "", $last_name);
		$last_name = stripslashes($last_name);		

		$address=str_replace('"', "", $address);
		$address = str_replace("'", "", $address);
		$address = stripslashes($address);	

		$zipcode=str_replace('"', "", $zipcode);
		$zipcode = str_replace("'", "", $zipcode);
		$zipcode = stripslashes($zipcode);	
		
		$phone=str_replace('"', "", $phone);
		$phone = str_replace("'", "", $phone);
		$phone = stripslashes($phone);	

		$email=str_replace('"', "", $email);
		$email = str_replace("'", "", $email);
		$email = stripslashes($email);		
	
		$rem=str_replace('"', "", $rem);
		$rem = str_replace("'", "", $rem);
		$rem = stripslashes($rem);	
		
		$city=str_replace('"', "", $city);
		$city = str_replace("'", "", $city);
		$city = stripslashes($city);		
		
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
		  
			$message = '<html><body>Здравствуйте, Crystalsky!' . '<br/><br/> ' ."\n" .
						 'Новый заказ с сайта Crystalsky.co.il!' . '<br/><br/> ' ."\n" .
						 'Дата заказа: <b>' . $cur_dt . '</b><br/> ' ."\n" .
						 'Наименование товара: <b>' . $_POST['tt'] . '</b><br/>' ."\n" .
						 'Изображение товара: <b> <img src="http://crystalsky.co.il/'.$_POST['ph'].'" width=300 ></b><br/>' .
						 'Артикул товара: <b>' . $_POST['mt'] . '</b><br/> ' ."\n" .
						 'Цена товара в Шекелях: <b>' . $_POST['pr'] . '</b><br/> ' ."\n" .
						 'Валюта заказа: <b>' . $curr_desc . '</b><br/> ' ."\n" .
						 'Курс валюты на момент заказа: <b>' . $rate . '</b><br/> ' ."\n" .
						 'Цена товара в Валюте заказа ('.$the_curr_sign.'): <b>' . money_format('%i', ceil($_POST['pr']/$rate)) . '</b><br/> ' ."\n" .
						 'Имя заказчика: <b>' . $first_name . '</b><br/> ' ."\n" .
						 'Фамилия заказчика: <b>' . $last_name . '</b><br/> ' ."\n" .
						 'Email заказчика: <b>' . $email . '</b><br/> ' ."\n" .
						 'Страна заказчика: <b>' . $country . '</b><br/> ' ."\n" .
						 'Город заказчика: <b>' . $city . '</b><br/> ' ."\n" .
						 'Адрес заказчика: <b>' . $address . '</b><br/> ' ."\n" .
						 'Почтовый индекс заказчика: <b>' . $zipcode . '</b><br/> ' ."\n" .
						 'Телефон заказчика: <b>' . $phone . '</b><br/> ' ."\n" .
						 'Доставка заказа: <b>' . $delivery_desc . '</b><br/> ' ."\n" .
						 'Стоимость доставки заказа в Шекелях: <b>' . $delivery_cost . '</b><br/> ' ."\n" .
						 'Стоимость доставки заказа в Валюте заказа: <b>' . money_format('%i', ceil($delivery_cost/$rate)) . '</b><br/> ' ."\n" .						 
						 'Примечание к заказу: <b>' . $rem . '</b><br/><br/> ' ."\n" .
						 'С уважением, ' . ' <br/> ' ."\n" .
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
				VALUES ('$db_cur_dt', 'ORDER_FROM_SITE', '$ip_addr', '$email', '$message' )";

				if ($conn->query($sql) === TRUE) {
					// echo "New record created successfully";
				} else {
					// echo "Error: " . $sql . "<br>" . $conn->error;
				}
				
				$the_order_id = uniqid();
				$prod_name = $_POST['tt'];
				$prod_photo = 'http://crystalsky.co.il/'.$_POST['ph'];
				$prod_makat = $_POST['mt'];
				$prod_price_nis = $_POST['pr'];
				$ord_currency = $curr_desc;
				$ord_cur_rate = $rate;
				$prod_price_in_currency = money_format('%i', ceil($_POST['pr']/$rate));
				$delivery_cost_curr = money_format('%i', ceil($delivery_cost/$rate));
				
				$sql2 = "INSERT INTO orders (id, order_dt, email, country, city, address, zipcode, first_name, last_name, phone, info, product_name, product_photo, product_mkt, product_price_nis, order_currency, order_cur_rate, product_qty, product_cost_nis, product_cost_cur , ip_addr, delivery, delivery_cost, delivery_cost_cur, is_sent_paypal_request, item_order, coupon_name, coupon_type, discount_in_nis, discount_in_cur) 
				VALUES ('$the_order_id', '$db_cur_dt', '$email', '$country', '$city', '$address', '$zipcode',  '$first_name', '$last_name', '$phone', '$rem', '$prod_name', '$prod_photo', '$prod_makat', $prod_price_nis, '$ord_currency', $ord_cur_rate, 1, $prod_price_nis, '$prod_price_in_currency', '$ip_addr', '$delivery_desc', $delivery_cost, $delivery_cost_curr, '0', 1, '', '', 0.00, 0.00 )";

				if ($conn->query($sql2) === TRUE) {
					// echo "New record created successfully";					
				} else {
					//
				}				
				
				$conn->close();
									
				$conn2 = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn2->connect_error) {
					die("Connection failed: " . $conn2->connect_error);
				} 

				$conn2->query("set names 'utf8'");	
				
				$query_order_details = "select * from orders where id = '$the_order_id'";
					
				$arr_order_details = array();		
				$results_order_details = mysqli_query($conn2, $query_order_details); 	
				
				while($line = mysqli_fetch_assoc($results_order_details)){
					$arr_order_details[] = $line;
				}	

				$conn2->close();
									
				echo json_encode($arr_order_details);
				
		 	} 
			
		}
	}
  
?>