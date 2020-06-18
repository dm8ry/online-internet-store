<?php session_start(); ?>

<?
	include_once('db_connect.php');
	include_once('admin_email.php');
	
	function isValidEmail($email){ 
		return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
	}
	
	if(isset($_POST['fn']) && isset($_POST['ln']) && isset($_POST['ln']) && isset($_POST['pn']) && isset($_POST['em']) && isset($_POST['it']))
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
		
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		
		$headers = "From: " . strip_tags($admin_email) . "\r\n";
		$headers .= "Reply-To: ". strip_tags($email) . "\r\n";		
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";		
		
		$the_order_details = "";
		$the_order_details2 = "";
				
		$the_order_details = $the_order_details."<br/><table border=\"1\">"	."\n" .
											"<thead>" ."\n" .
											"<tr>" ."\n" .
                                            "<th colspan=\"2\">Товар</th> " ."\n" .
                                            "<th>Кол-во</th>" ."\n" .
                                            "<th>Цена</th>" ."\n" .                                            
                                            "<th colspan=\"2\">Итого</th>" ."\n" .
											"</tr>" ."\n" .
											"</thead>" ."\n" .
											"<tbody>" ."\n";
				
		$the_order_details2 = $the_order_details2."<br/><table border=\"1\">"	."\n" .
											"<thead>" ."\n" .
											"<tr>" ."\n" .
                                            "<th colspan=\"2\">Товар</th> " ."\n" .
                                            "<th>Кол-во</th>" ."\n" .
                                            "<th>Цена</th>" ."\n" .                                            
                                            "<th colspan=\"2\">Итого</th>" ."\n" .
											"</tr>" ."\n" .
											"</thead>" ."\n" .
											"<tbody>" ."\n";
				
								 
			// $n_items_in_the_basket
			
			$total_sum = 0;
			
			$total_sum2 = 0;
			
			$tot_sum_for_coupon = 0;
			
			$tot_sum_for_coupon2 = 0;
			
			$keys = array_keys($_SESSION['cart_items']);
			for($i = 0; $i < count($_SESSION['cart_items']); $i++) 
			{
			
				if ($_SESSION['cart_items'][$keys[$i]]['is_discount'] == 1)
				{
				
					$is_disc = '<span style="color:red"><b>*</b><i>(по скидке)</i></span>';
				}
				else
				{
					$is_disc='';
				}
		 
				$the_order_details = $the_order_details."<tr>"."\n" .			
												"<td style=\"vertical-align: middle\">"."\n" .				
												"<a href=\"http://crystalsky.co.il/item.php?i=".$keys[$i]."#come_here\" target=\"_blank\">"."\n" .				
												"<img border=\"0\" src=\"http://crystalsky.co.il/".$_SESSION['cart_items'][$keys[$i]]['photo']."\" alt=\"".$_SESSION['cart_items'][$keys[$i]]['title']."\" width=\"50\">"."\n" .		
												"</a>"."\n" .
												"</td>"."\n" .
												"<td style=\"vertical-align: middle\"><a href=\"http://crystalsky.co.il/item.php?i=".$keys[$i]."\" target=\"_blank\">".$_SESSION['cart_items'][$keys[$i]]['title'].$is_disc."; [makat=".$_SESSION['cart_items'][$keys[$i]]['makat']."]</a>"."\n" .	
												"</td>"."\n" .
												"<td style=\"vertical-align: middle\">"."\n" .
												"<input name=\"".$i."\" id=\"".$i."\" value=\"".$_SESSION['cart_items'][$keys[$i]]['qty']."\" class=\"form-control\" style=\"width: 50px; text-align: right;\">"."\n" .	
												"</td>"."\n" .
												"<td style=\"vertical-align: middle; text-align:right\">".number_format($_SESSION['cart_items'][$keys[$i]]['price'], 2, '.', '')." шек.</td> "."\n" .
												"<td colspan=\"2\" style=\"vertical-align: middle; text-align:right\">".number_format($_SESSION['cart_items'][$keys[$i]]['price'] * $_SESSION['cart_items'][$keys[$i]]['qty'], 2, '.', '')." шек.</td>"."\n" .												
												"</tr>"."\n";
		 
				$the_order_details2 = $the_order_details2."<tr>"."\n" .			
												"<td style=\"vertical-align: middle\">"."\n" .				
												"<a href=\"http://crystalsky.co.il/item.php?i=".$keys[$i]."#come_here\" target=\"_blank\">"."\n" .				
												"<img border=\"0\" src=\"http://crystalsky.co.il/".$_SESSION['cart_items'][$keys[$i]]['photo']."\" alt=\"".$_SESSION['cart_items'][$keys[$i]]['title']."\" width=\"50\">"."\n" .		
												"</a>"."\n" .
												"</td>"."\n" .
												"<td style=\"vertical-align: middle\"><a href=\"http://crystalsky.co.il/item.php?i=".$keys[$i]."\" target=\"_blank\">".$_SESSION['cart_items'][$keys[$i]]['title'].$is_disc."; [makat=".$_SESSION['cart_items'][$keys[$i]]['makat']."]</a>"."\n" .	
												"</td>"."\n" .
												"<td style=\"vertical-align: middle\">"."\n" .
												"<input name=\"".$i."\" id=\"".$i."\" value=\"".$_SESSION['cart_items'][$keys[$i]]['qty']."\" class=\"form-control\" style=\"width: 50px; text-align: right;\">"."\n" .	
												"</td>"."\n" .
												"<td style=\"vertical-align: middle; text-align:right\">".number_format($_SESSION['cart_items'][$keys[$i]]['price'] / $_SESSION['rate'], 2, '.', '')." ".$_SESSION['the_curr_sign']."</td> "."\n" .
												"<td colspan=\"2\" style=\"vertical-align: middle; text-align:right\">".number_format($_SESSION['cart_items'][$keys[$i]]['price'] * $_SESSION['cart_items'][$keys[$i]]['qty'] / $_SESSION['rate'] , 2, '.', '')." ".$_SESSION['the_curr_sign']."</td>"."\n" .												
												"</tr>"."\n";		 
		 
		
				$total_sum=$total_sum + $_SESSION['cart_items'][$keys[$i]]['price'] * $_SESSION['cart_items'][$keys[$i]]['qty'];
				
				$total_sum2=$total_sum2 + $_SESSION['cart_items'][$keys[$i]]['price'] * $_SESSION['cart_items'][$keys[$i]]['qty'] / $_SESSION['rate'];
				
				if ($_SESSION['cart_items'][$keys[$i]]['is_discount'] == 0)
				{
					$tot_sum_for_coupon=$tot_sum_for_coupon + $_SESSION['cart_items'][$keys[$i]]['price'] * $_SESSION['cart_items'][$keys[$i]]['qty'];
					
					$tot_sum_for_coupon2=$tot_sum_for_coupon2 + $_SESSION['cart_items'][$keys[$i]]['price'] * $_SESSION['cart_items'][$keys[$i]]['qty'] / $_SESSION['rate'];
				}
				
			}
		 
				if ($_SESSION['bonus_coupon']['bonus_type'] ==  1)
				{
					if ($tot_sum_for_coupon > $the_disk_sum)
					{
						$the_disk_sum = $_SESSION['bonus_coupon']['bonus_par1'];
						$total_sum = $total_sum - $the_disk_sum;
						
						$the_disk_sum2 = $_SESSION['bonus_coupon']['bonus_par1']/ $_SESSION['rate'];
						$total_sum2 = $total_sum2 - $the_disk_sum2;					
					}					
				}
				
				if ($_SESSION['bonus_coupon']['bonus_type'] ==  2)
				{
					$the_disk_sum = $tot_sum_for_coupon * $_SESSION['bonus_coupon']['bonus_par1'] / 100;
					$total_sum = $total_sum - $the_disk_sum;

					$the_disk_sum2 = $tot_sum_for_coupon2 * $_SESSION['bonus_coupon']['bonus_par1'] / 100;
					$total_sum2 = $total_sum2 - $the_disk_sum2;					
				}
				
				if ($_SESSION['bonus_coupon']['bonus_type'] ==  3)
				{				
					if ($tot_sum_for_coupon >  $_SESSION['bonus_coupon']['bonus_par2'])
					{
						
					$the_disk_sum = $_SESSION['bonus_coupon']['bonus_par1'];
					$total_sum = $total_sum - $the_disk_sum;

					$the_disk_sum2 = $_SESSION['bonus_coupon']['bonus_par1']/ $_SESSION['rate'];
					$total_sum2 = $total_sum2 - $the_disk_sum2;					
						
					}				
				}				
				
				if ($_SESSION['bonus_coupon']['bonus_type'] ==  4)
				{
					if ($tot_sum_for_coupon >  $_SESSION['bonus_coupon']['bonus_par2'])
					{
						
					$the_disk_sum = $tot_sum_for_coupon * $_SESSION['bonus_coupon']['bonus_par1'] / 100;
					$total_sum = $total_sum - $the_disk_sum;

					$the_disk_sum2 = $tot_sum_for_coupon2 * $_SESSION['bonus_coupon']['bonus_par1'] / 100;
					$total_sum2 = $total_sum2 - $the_disk_sum2;					
						
					}				
				
				}				
							
				$the_order_details = $the_order_details."<tr>"."\n" .	
											"<td style=\"vertical-align: middle\">"."\n" .	
											"Купон"."\n" .
											"</td>"."\n" .
											"<td colspan=\"3\" style=\"vertical-align: middle\">"."\n" .
											"<table>"."\n" .
											"<tr>"."\n" .
											"<td>"."\n" .
											$_SESSION['bonus_coupon']['bonus_name']."\n" .
											"</td>"."\n" .
											"<td style=\"padding:10px; width:350px\">"."\n" .
											"<small>".$_SESSION['bonus_coupon']['bonus_display_name']."</small>"."\n" .
											"</td>"."\n" .
											"<tr>"."\n" .
											"</table>"."\n" .
											"</td>"."\n" .										
											"<td colspan=\"2\" style=\"vertical-align: middle; text-align:right\"><span style=\"color:green\">- ".number_format($the_disk_sum, 2, '.', '')." шек.</span></td>"."\n" .											
											"</tr>"."\n" .						
											"</tbody>"."\n" .	
											"<tfoot>"."\n" .
											"<tr>"."\n" .	
											"<th colspan=\"4\">Итого</th>"."\n" .
											"<th colspan=\"2\" style=\"text-align:right\">".number_format($total_sum, 2, '.', '')." шек.</th>"."\n" .
											"</tr>"."\n" .
											"</tfoot>"."\n" .
											"</table><br/>"."\n";	

				$the_order_details2 = $the_order_details2."<tr>"."\n" .	
											"<td style=\"vertical-align: middle\">"."\n" .	
											"Купон"."\n" .
											"</td>"."\n" .
											"<td colspan=\"3\" style=\"vertical-align: middle\">"."\n" .
											"<table>"."\n" .
											"<tr>"."\n" .
											"<td>"."\n" .
											$_SESSION['bonus_coupon']['bonus_name']."\n" .
											"</td>"."\n" .
											"<td style=\"padding:10px; width:350px\">"."\n" .
											"<small>".$_SESSION['bonus_coupon']['bonus_display_name']."</small>"."\n" .
											"</td>"."\n" .
											"<tr>"."\n" .
											"</table>"."\n" .
											"</td>"."\n" .										
											"<td colspan=\"2\" style=\"vertical-align: middle; text-align:right\"><span style=\"color:green\">- ".number_format($the_disk_sum2, 2, '.', '')." ".$_SESSION['the_curr_sign']."</span></td>"."\n" .											
											"</tr>"."\n" .						
											"</tbody>"."\n" .	
											"<tfoot>"."\n" .
											"<tr>"."\n" .	
											"<th colspan=\"4\">Итого</th>"."\n" .
											"<th colspan=\"2\" style=\"text-align:right\">".number_format($total_sum2, 2, '.', '')." ".$_SESSION['the_curr_sign']."</th>"."\n" .
											"</tr>"."\n" .
											"</tfoot>"."\n" .
											"</table><br/>"."\n";
											
		
		if (isValidEmail($email))
		{

			$date = new DateTime("now", new DateTimeZone('Asia/Jerusalem') );
			$cur_dt =  $date->format('d-m-Y H:i:s');  
			$db_cur_dt = $date->format('Y-m-d H:i:s'); // same format as NOW()			
		  
			$message = '<html><head><title>Новый заказ с сайта Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!' . '<br/><br/> ' ."\n" .
						 'Новый заказ с сайта Crystalsky.co.il!' . '<br/><br/> ' ."\n" .
						 'Дата заказа: <b>' . $cur_dt . '</b><br/> ' ."\n" .
						 'Валюта Заказа: <b>' . $_SESSION['curr_desc'] . '</b><br/> ' ."\n" .
						 'Курс Валюты на Момент Заказа: <b>' . $_SESSION['rate'] . '</b><br/><br/> ' ."\n" .
						 'Заказ, расчитанный в <b>Шекелях</b>: <br/> ' ."\n" .$the_order_details."\n" .
						 'Заказ, расчитанный в Валюте Заказа (<b>'. $_SESSION['the_curr_sign'] .' - '.$_SESSION['curr_desc'].'</b>): <br/> ' ."\n" .$the_order_details2."\n" .
						 'Имя заказчика: <b>' . $first_name . '</b><br/> ' ."\n" .
						 'Фамилия заказчика: <b>' . $last_name . '</b><br/> ' ."\n" .
						 'Email заказчика: <b>' . $email . '</b><br/> ' ."\n" .
						 'Страна заказчика: <b>' . $country . '</b><br/> ' ."\n" .
						 'Город заказчика: <b>' . $city . '</b><br/> ' ."\n" .
						 'Адрес заказчика: <b>' . $address . '</b><br/> ' ."\n" .
						 'Почтовый индекс заказчика: <b>' . $zipcode . '</b><br/> ' ."\n" .
						 'Телефон заказчика: <b>' . $phone . '</b><br/> ' ."\n" .
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
					//echo "Error: " . $sql . "<br>" . $conn->error;					
				}

				$the_order_id = uniqid();
								 												
				$coupon_name =$_SESSION['bonus_coupon']['bonus_name'];
				$coupon_type = $_SESSION['bonus_coupon']['bonus_type'];
				
				$disc_in_nis = number_format($the_disk_sum, 2, '.', '');
				$disc_in_cur = number_format($the_disk_sum2, 2, '.', '');
				
				$delivery_cost_curr = money_format('%i', ceil($delivery_cost/$rate));
				
				$keys = array_keys($_SESSION['cart_items']);
				for($i = 0; $i < count($_SESSION['cart_items']); $i++) 
				{
				
					$prod_name = $_SESSION['cart_items'][$keys[$i]]['title'];
					$prod_photo = 'https://crystalsky.co.il/'.$_SESSION['cart_items'][$keys[$i]]['photo'];
					$prod_makat = $_SESSION['cart_items'][$keys[$i]]['makat'];
					$prod_price_nis = number_format($_SESSION['cart_items'][$keys[$i]]['price'], 2, '.', '');
					$ord_currency = $curr_desc;
					$ord_cur_rate = $rate;
					$prod_cost_in_currency = number_format($_SESSION['cart_items'][$keys[$i]]['price'] * $_SESSION['cart_items'][$keys[$i]]['qty'] / $_SESSION['rate'], 2, '.', '');
					$product_qty = $_SESSION['cart_items'][$keys[$i]]['qty'];
					$product_cost_nis  = number_format($_SESSION['cart_items'][$keys[$i]]['price'] * $_SESSION['cart_items'][$keys[$i]]['qty'] , 2, '.', '');
					
					$item_order = $i + 1;
					
					$sql2 = "INSERT INTO orders (id, order_dt, email, country, city, address, zipcode, first_name, last_name, phone, info, product_name, product_photo, product_mkt, product_price_nis, order_currency, order_cur_rate, product_qty, product_cost_nis, product_cost_cur , ip_addr, delivery, delivery_cost, delivery_cost_cur, is_sent_paypal_request, item_order, coupon_name, coupon_type, discount_in_nis, discount_in_cur) 
					VALUES ('$the_order_id', '$db_cur_dt', '$email', '$country', '$city', '$address', '$zipcode',  '$first_name', '$last_name', '$phone', '$rem', '$prod_name', '$prod_photo', '$prod_makat', $prod_price_nis, '$ord_currency', $ord_cur_rate, $product_qty, $product_cost_nis, $prod_cost_in_currency, '$ip_addr', '$delivery_desc', $delivery_cost, $delivery_cost_curr, '0', $item_order, '$coupon_name', '$coupon_type', '$disc_in_nis', '$disc_in_cur' )";

					if ($conn->query($sql2) === TRUE) {
						// echo "New record created successfully";					
					} else {
						//
					}						
					
				} // for $i
				
				$conn->close();	

				/// retrieve order details to js 
				
				$conn2 = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn2->connect_error) {
					die("Connection failed: " . $conn2->connect_error);
				} 

				$conn2->query("set names 'utf8'");	
				
				$query_order_details = "select * from orders where id = '$the_order_id' order by item_order ";
					
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