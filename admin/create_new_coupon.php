<?php

	include_once('./../db_connect.php');
	include_once('./../admin_email.php');
	
	function isValidEmail($email){ 
		return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
	}
	
	if(isset($_POST['cn']) && isset($_POST['cp']) && isset($_POST['ct']))
	{
	
		//Email information
		$admin_email = $admin_email_address;
		$subject = "A new coupon from Crystalsky.co.il";
		
		$coupon_name = htmlspecialchars (substr($_POST['cn'], 0, 50));
	
		$coupon_name=str_replace('"', "", $coupon_name);
		$coupon_name = str_replace("'", "", $coupon_name);
		$coupon_name = stripslashes($coupon_name);
		
		$coupon_type = $_POST['ct'];
		
		$display_name = "";
		$par1 = "";
		$par2 = "";
		$coupon_type_to_db = "";
		
		switch ($coupon_type) {
			case "t1_10":
				$display_name = "Подарок 10 шекелей";
				$par1 = 10;
				$par2 = "";
				$coupon_type_to_db = "1";
				break;
				
			case "t1_20":
				$display_name = "Подарок 20 шекелей";
				$par1 = 20;
				$par2 = "";
				$coupon_type_to_db = "1";
				break;				
			
			case "t1_50":
				$display_name = "Подарок 50 шекелей";
				$par1 = 50;
				$par2 = "";
				$coupon_type_to_db = "1";
				break;	

			case "t1_75":
				$display_name = "Подарок 75 шекелей";
				$par1 = 75;
				$par2 = "";
				$coupon_type_to_db = "1";
				break;

			case "t1_100":
				$display_name = "Подарок 100 шекелей";
				$par1 = 100;
				$par2 = "";
				$coupon_type_to_db = "1";
				break;						
	
			case "t2_5":
				$display_name = "Скидка 5%";
				$par1 = 5;
				$par2 = "";
				$coupon_type_to_db = "2";
				break;	
	
			case "t2_10":
				$display_name = "Скидка 10%";
				$par1 = 10;
				$par2 = "";
				$coupon_type_to_db = "2";
				break;		
	
			case "t2_15":
				$display_name = "Скидка 15%";
				$par1 = 15;
				$par2 = "";
				$coupon_type_to_db = "2";
				break;	
	
			case "t2_20":
				$display_name = "Скидка 20%";
				$par1 = 20;
				$par2 = "";
				$coupon_type_to_db = "2";
				break;		
	
			case "t2_25":
				$display_name = "Скидка 25%";
				$par1 = 25;
				$par2 = "";
				$coupon_type_to_db = "2";
				break;	
	
			case "t2_30":
				$display_name = "Скидка 30%";
				$par1 = 30;
				$par2 = "";
				$coupon_type_to_db = "2";
				break;	
				
			case "t2_50":
				$display_name = "Скидка 50%";
				$par1 = 50;
				$par2 = "";
				$coupon_type_to_db = "2";
				break;				
				
			case "t3_10_100":
				$display_name = "Бонус 10 шек. при покупке на сумму более 100 шек.";
				$par1 = 10;
				$par2 = 100;
				$coupon_type_to_db = "3";
				break;						
				
			case "t3_20_100":
				$display_name = "Бонус 20 шек. при покупке на сумму более 100 шек.";
				$par1 = 20;
				$par2 = 100;
				$coupon_type_to_db = "3";
				break;	

			case "t3_20_200":
				$display_name = "Бонус 20 шек. при покупке на сумму более 200 шек.";
				$par1 = 20;
				$par2 = 200;
				$coupon_type_to_db = "3";
				break;					
		
			case "t3_30_200":
				$display_name = "Бонус 30 шек. при покупке на сумму более 200 шек.";
				$par1 = 30;
				$par2 = 200;
				$coupon_type_to_db = "3";
				break;

			case "t3_30_300":
				$display_name = "Бонус 30 шек. при покупке на сумму более 300 шек.";
				$par1 = 30;
				$par2 = 300;
				$coupon_type_to_db = "3";
				break;

			case "t3_40_300":
				$display_name = "Бонус 40 шек. при покупке на сумму более 300 шек.";
				$par1 = 40;
				$par2 = 300;
				$coupon_type_to_db = "3";
				break;
			
			case "t3_50_300":
				$display_name = "Бонус 50 шек. при покупке на сумму более 300 шек.";
				$par1 = 50;
				$par2 = 300;
				$coupon_type_to_db = "3";
				break;
			
			case "t4_5_100":
				$display_name = "Скидка 5% на покупку более 100 шекелей";
				$par1 = 5;
				$par2 = 100;
				$coupon_type_to_db = "4";
				break;			
			
			case "t4_10_100":
				$display_name = "Скидка 10% на покупку более 100 шекелей";
				$par1 = 10;
				$par2 = 100;
				$coupon_type_to_db = "4";
				break;			
	
			case "t4_15_100":
				$display_name = "Скидка 15% на покупку более 100 шекелей";
				$par1 = 15;
				$par2 = 100;
				$coupon_type_to_db = "4";
				break;
			
			case "t4_5_200":
				$display_name = "Скидка 5% на покупку более 200 шекелей";
				$par1 = 5;
				$par2 = 200;
				$coupon_type_to_db = "4";
				break;
			
			case "t4_10_200":
				$display_name = "Скидка 10% на покупку более 200 шекелей";
				$par1 = 10;
				$par2 = 200;
				$coupon_type_to_db = "4";
				break;

			case "t4_15_200":
				$display_name = "Скидка 15% на покупку более 200 шекелей";
				$par1 = 15;
				$par2 = 200;
				$coupon_type_to_db = "4";
				break;

			case "t4_20_200":
				$display_name = "Скидка 20% на покупку более 200 шекелей";
				$par1 = 20;
				$par2 = 200;
				$coupon_type_to_db = "4";
				break;

			case "t4_10_300":
				$display_name = "Скидка 10% на покупку более 300 шекелей";
				$par1 = 10;
				$par2 = 300;
				$coupon_type_to_db = "4";
				break;
				
			case "t4_15_300":
				$display_name = "Скидка 15% на покупку более 300 шекелей";
				$par1 = 15;
				$par2 = 300;
				$coupon_type_to_db = "4";
				break;				
		
			case "t4_20_300":
				$display_name = "Скидка 20% на покупку более 300 шекелей";
				$par1 = 20;
				$par2 = 300;
				$coupon_type_to_db = "4";
				break;	
				
			default:
				$display_name = "Unknown";
				$par1 = "";
				$par2 = "";			
				$coupon_type_to_db = "";
		}
		
		$coupon_period = $_POST['cp'];
		$period_start = "";
		$period_end = "";
		
		$date = new DateTime("now", new DateTimeZone('Asia/Jerusalem') );
		$cur_dt =  $date->format('d-m-Y H:i:s');  
		$db_cur_dt = $date->format('Y-m-d H:i:s'); // same format as NOW()	

		$date7 = new DateTime("now", new DateTimeZone('Asia/Jerusalem') );
		$one_week_in_feature_tmp = $date7->modify('+1 week');
		$one_week_in_feature = $one_week_in_feature_tmp->format('d-m-Y H:i:s'); 
		$db_one_week_in_feature = $one_week_in_feature_tmp->format('Y-m-d H:i:s'); 
		
		$date30 = new DateTime("now", new DateTimeZone('Asia/Jerusalem') );
		$one_month_in_feature_tmp = $date30->modify('+1 month');
		$one_month_in_feature = $one_month_in_feature_tmp->format('d-m-Y H:i:s'); 		
		$db_one_month_in_feature = $one_month_in_feature_tmp->format('Y-m-d H:i:s');				
		
		switch ($coupon_period) {
			case "stdt_1":
				$period_start = $cur_dt;
				$period_end = 'NULL';
				$db_period_start = $db_cur_dt;
				$db_period_end = 'NULL';				
				break;
				
			case "stdt_2":
				$period_start = $cur_dt;
				$period_end = $one_week_in_feature;
				$db_period_start = $db_cur_dt;
				$db_period_end = $db_one_week_in_feature;			
				break;				
			
			case "stdt_3":
				$period_start = $cur_dt;
				$period_end = $one_month_in_feature;
				$db_period_start = $db_cur_dt;
				$db_period_end = $db_one_month_in_feature;				
				break;
				
			default:
				$period_start = $cur_dt;
				$period_end = 'NULL';
				$db_period_start = $db_cur_dt;
				$db_period_end = 'NULL';				
		}		
			
			
			
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		
		$headers = "From: " . strip_tags($admin_email) . "\r\n";
		$headers .= "Reply-To: ". strip_tags($admin_email) . "\r\n";		
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";		
		  
		$message = '<html><body>Здравствуйте, Crystalsky!' . '<br/><br/> ' ."\n" .
					 'Новый купон был добавлен с панели управления Crystalsky.co.il!' . '<br/><br/> ' ."\n" .
					 'Дата добавления: <b>' . $cur_dt . '</b><br/> ' ."\n" .
					 'Наименование купона: <b>' . $coupon_name . '</b><br/>' ."\n" .
					 'Описание купона: <b>' . $display_name . '</b><br/>' ."\n" .
					 'Начало действия купона: <b>' . $period_start . '</b><br/>' ."\n" .
					 'Конец действия купона: <b>' . $period_end . '</b><br/><br/>' ."\n" .					 
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
				VALUES ('$db_cur_dt', 'NEW_COUPON_CREATED', '$ip_addr', '$admin_email', '$message' )";

				if ($conn->query($sql) === TRUE) {
					// echo "New record created successfully";
				} else {
					// echo "Error: " . $sql . "<br>" . $conn->error;
				}

				
				$sql2 = "INSERT INTO coupons (name, type, par1, par2, display_name, start_dt, exp_dt, status) 
				VALUES ('$coupon_name', '$coupon_type_to_db', '$par1', '$par2', '$display_name', '$db_period_start', '$db_period_end', 1)";

				if ($conn->query($sql2) === TRUE) {
					// echo "New record created successfully";
				} else {
					// echo "Error: " . $sql . "<br>" . $conn->error;
				}
				
				
				$conn->close();				
		 	} 
			
		 
	}
  
?>