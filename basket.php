<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<?php
		
	// start calculate num items in the basket

	$n_items_in_the_basket = 0;

	if(!isset($_SESSION['cart_items'])){
		$n_items_in_the_basket = 0;
	}				
	else
	{
		$n_items_in_the_basket = count($_SESSION['cart_items']);			
	}

	// end calculate num items in the basket
		
	// some reCaptcha :)
	$a = rand(3, 15);
	$b = rand(2, 10);	
			
	// conn db parameters
	require_once('db_connect.php');
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$conn->query("set names 'utf8'");

	$sql_cat_subcat = "select M.main, sc.id, sc.name sc_name, sc.main_category, mc.name mc_name, sc.qty 
						from sub_category sc
						join (select sc2.main_category, group_concat(sc2.id separator ',') main 
								 from sub_category  sc2
								 group by sc2.main_category) M on M.main_category= sc.main_category
						join main_category mc on mc.id= sc.main_category";
								
	$arr_cat_subcat = array();		
	$results_cat_subcat = mysqli_query($conn, $sql_cat_subcat); 	
	
	while($line = mysqli_fetch_assoc($results_cat_subcat)){
		$arr_cat_subcat[] = $line;
	}	  	
	
	$sql_currencies = "select * from currencies where status='1' order by id";
								
	$arr_currencies = array();		
	$results_currencies = mysqli_query($conn, $sql_currencies); 	
	
	while($line = mysqli_fetch_assoc($results_currencies)){
		$arr_currencies[] = $line;
	}

	if(!isset($_SESSION['the_curr'])){
		$_SESSION['the_curr'] = 1;
		$_SESSION['the_curr_sign'] = '₪';
		$_SESSION['rate'] = 1.00;
		$_SESSION['sign_place'] = 'r';
		$_SESSION['curr_desc'] = 'Новый Израильский Шекель';
		$_SESSION['curr_name'] = 'ILS';
	}

	$sql_delivery = "select * from delivery where delivery_option_status='1' order by delivery_ord";
								
	$arr_delivery = array();		
	$results_delivery = mysqli_query($conn, $sql_delivery); 	
	
	while($line = mysqli_fetch_assoc($results_delivery)){
		$arr_delivery[] = $line;
	}

	$sql_paypal_email = "select prop_value from app_properties where prop_name='paypal_email' ";
								
	$arr_paypal = array();		
	$results_paypal = mysqli_query($conn, $sql_paypal_email); 	
	
	while($line = mysqli_fetch_assoc($results_paypal)){
		$arr_paypal[] = $line;
	}	
	
	$sql_paypal_sandbox = "select prop_value from app_properties where prop_name='is_paypal_sandbox' ";
								
	$arr_paypal_sandbox = array();		
	$results_paypal_sandbox = mysqli_query($conn, $sql_paypal_sandbox); 	
	
	while($line = mysqli_fetch_assoc($results_paypal_sandbox)){
		$arr_paypal_sandbox[] = $line;
	}			
	
	
	
	
	?>		
	
    <title>магазин "Crystal Sky" - корзина покупок</title>

    <meta name="keywords" content="магазин Crystal Sky, приглашаем, покупки, подарки, стиль, образ, Crystal, Sky, Нацерет-Илит, Израиль, Раско, ювелирные, серебро, 925, позолота, камни, выбор, рубин, топаз, сапфир, аметист" />
	<meta name="description" content="Приглашаем Вас в магазин Crystal Sky! Серебро 925, камни, ювелирные украшения, подарки, сувениры, туризм. Адрес: Нацерет-Илит, Мерказ Раско, Ацмон 18, Израиль" />	
	
	<!-- Fonts -->
    <link href='assets/css/fonts.css' rel='stylesheet' type='text/css'>		
		
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
	
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->			
	
	<link href="assets/css/animate.min.css" rel="stylesheet">
	<link href="assets/css/font-awesome.css" rel="stylesheet">	
	<link href="assets/css/crystalsky.css" rel="stylesheet">
						
	<!-- icons -->
	
	<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/manifest.json">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-TileImage" content="/mstile-144x144.png">
	<meta name="theme-color" content="#ffffff">
	
	<!-- icons -->	
	
	<script>	
	
	
	function subscribeEmail()
	{			
		var nErrors =0;
		
		if (document.getElementById("subscr_email").value==null || document.getElementById("subscr_email").value=="")
		{
						
			document.getElementById("subscr_email").style.borderColor = "red";
			document.getElementById("subscr_email").style.boxShadow = "3px 3px 3px lightgray";				
			nErrors++;
		}	
		else if (!validateEmail(document.getElementById("subscr_email").value))
		{							
			document.getElementById("subscr_email").style.borderColor = "red";
			document.getElementById("subscr_email").style.boxShadow = "3px 3px 3px lightgray";							
			nErrors++;			
		}		
		else 
		{
			document.getElementById("subscr_email").style.borderColor = "#e3e3e3";
			document.getElementById("subscr_email").style.boxShadow = "none";	
		}				
					
		if (nErrors==0)
		{
		
			var url = "subscribe_email.php";
		
			var oData = new FormData(document.forms.namedItem("SubscribeEmail"));
			
			var oReq = new XMLHttpRequest();
			  oReq.open("POST", url, true);
			  oReq.onload = function(oEvent) {
			  
				if (oReq.status == 200) 
				{			
					$('#myModalOk').modal('show');																																			
					return;					
				} else {
				  alert("Error: " + oReq.status);
				}
			  };
			oReq.send(oData); 

		}			
	}  		
	
	function acceptTermsAndConditions()
	{
		var chck_state = document.getElementById("elAcceptTermsAndConditions").checked;
		if (chck_state == true)
		{			
			document.getElementById("submitPaypalBtn").disabled = false;
			document.getElementById("submitPaypalBtn").className = "btn btn-primary btn-lg";
		}
		else
		{
			document.getElementById("submitPaypalBtn").disabled = true;
			document.getElementById("submitPaypalBtn").className = "btn btn-primary btn-lg disabled";
		}
	}
	
	function paymentDone()
	{				
		window.location.replace("https://crystalsky.co.il/success_order.php");
	}	
	
	function currencyChanged(n,s,r,p,d,cn)
	{
		 //alert('n='+n);
		 
		var http = new XMLHttpRequest();
		var url = "set_currency.php";
		var params = "the_curr="+n+"&the_curr_sign="+s+"&rate="+r+"&sign_place="+p+"&curr_desc="+d+"&curr_name="+cn;
		http.open("POST", url, true);

		//Send the proper header information along with the request
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		http.onreadystatechange = function() {//Call a function when the state changes.
			if(http.readyState == 4 && http.status == 200) {
				// alert(http.responseText);
				// refresh the page to update currencies
				
				// window.location.replace("http://crystalsky.co.il/index.php");
				
				window.location.reload(true);
			}
		}
		http.send(params);		 
		 
	}
	
	function validateEmail(email) {
		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	}	
	
	
	function ajax_post()
	{
		var nErrors =0;
				
		if (document.getElementById("country").value==null || document.getElementById("country").value=="")
		{
		
			document.getElementById("inp_country").className = "form-group has-error";
			nErrors++;
		}
		else
		{
			document.getElementById("inp_country").className = "form-group";
		}		
		
		if (document.getElementById("city").value==null || document.getElementById("city").value=="")
		{
		
			document.getElementById("inp_city").className = "form-group has-error";
			nErrors++;
		}
		else
		{
			document.getElementById("inp_city").className = "form-group";
		}

		if (document.getElementById("address").value==null || document.getElementById("address").value=="")
		{
		
			document.getElementById("inp_address").className = "form-group has-error";
			nErrors++;
		}
		else
		{
			document.getElementById("inp_address").className = "form-group";
		}	

		if (document.getElementById("zipcode").value==null || document.getElementById("zipcode").value=="")
		{
		
			document.getElementById("inp_zipcode").className = "form-group has-error";
			nErrors++;
		}
		else
		{
			document.getElementById("inp_zipcode").className = "form-group";
		}				
		
		if (document.getElementById("firstname").value==null || document.getElementById("firstname").value=="")
		{
		
			document.getElementById("inp_first_name").className = "form-group has-error";
			nErrors++;
		}
		else
		{
			document.getElementById("inp_first_name").className = "form-group";
		}
		
		if (document.getElementById("lastname").value==null || document.getElementById("lastname").value=="")
		{
		
			document.getElementById("inp_last_name").className = "form-group has-error";
			nErrors++;
		}	
		else
		{
			document.getElementById("inp_last_name").className = "form-group";
		}
		
		if (document.getElementById("email").value==null || document.getElementById("email").value=="")
		{
		
			document.getElementById("inp_email").className = "form-group has-error";
			nErrors++;
		}	
		else if (!validateEmail(document.getElementById("email").value))
		{			
			document.getElementById("inp_email").className = "form-group has-error";
			nErrors++;			
		}		
		else 
		{
			document.getElementById("inp_email").className = "form-group";
		}				
		
		if (document.getElementById("phone").value==null || document.getElementById("phone").value=="")
		{
		
			document.getElementById("inp_phone").className = "form-group has-error";
			nErrors++;
		}	
		else
		{
			document.getElementById("inp_phone").className = "form-group";
		}		

		if (document.getElementById("captcha").value==null || document.getElementById("captcha").value=="")
		{
		
			document.getElementById("inp_captcha").className = "form-group has-error";
			nErrors++;
		}	
		else if (document.getElementById("captcha").value!=<?php echo $a+$b; ?>)
		{
			document.getElementById("inp_captcha").className = "form-group has-error";
			nErrors++;			
		}
		else
		{
			document.getElementById("inp_captcha").className = "form-group";
		}	

			
		
		if (nErrors==0)
		{
			
			// Create our XMLHttpRequest object
			var hr = new XMLHttpRequest();
			// Create some variables we need to send to our PHP file
			var url = "send_your_basket_order.php";
			
			var cn = document.getElementById("country").value;
			var fn = document.getElementById("firstname").value;
			var ln = document.getElementById("lastname").value;
			var ad = document.getElementById("address").value;
			var zp = document.getElementById("zipcode").value;
			var pn = document.getElementById("phone").value;
			var em = document.getElementById("email").value;
			var rem = document.getElementById("remark").value;
			var ct = document.getElementById("city").value;
			var de = document.getElementById("delivery").value;			
			var it = '<?php echo $i; ?>';
			var ph = '<?php echo $row["photo1"]; ?>';
			var tt = '<?php echo $row["title"]; ?>';
			var mt = '<?php echo $row["makat"]; ?>';
			var pr = '<?php echo $row["price"]; ?>';
			
			var curr_desc = '<?php echo  $_SESSION['curr_desc']; ?>';
			var rate = '<?php echo  $_SESSION['rate']; ?>';
			var the_curr_sign = '<?php echo  $_SESSION['the_curr_sign']; ?>';			
			
			var vars = "cn="+cn+"&fn="+fn+"&ln="+ln+"&ad="+ad+"&zp="+zp+"&pn="+pn+"&em="+em+"&rem="+rem+"&it="+it+"&ph="+ph+"&tt="+tt+"&mt="+mt+"&pr="+pr+"&ct="+ct+"&de="+de+"&curr_desc="+curr_desc+"&rate="+rate+"&the_curr_sign="+the_curr_sign;
			hr.open("POST", url, true);
			// Set content type header information for sending url encoded variables in the request
			hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			// Access the onreadystatechange event for the XMLHttpRequest object
			hr.onreadystatechange = function() {
				if(hr.readyState == 4 && hr.status == 200) {
					var return_data = hr.responseText;
												
					// for debug purpose
				    // alert('return_data= '+return_data);
					
					//document.getElementById("dbg").innerHTML=return_data;
					
					document.getElementById("txtreply").style.display='block';
					document.getElementById("contact_status").style.display='none';
					document.getElementById("txtreply").scrollIntoView(true);
					 
					var the_order_details = JSON.parse(return_data);
					
					/*
					document.getElementById("pp_item_number_1").value = the_order_details[0].product_mkt;
					document.getElementById("pp_item_name_1").value = the_order_details[0].product_name;
					document.getElementById("pp_quantity_1").value = the_order_details[0].product_qty;
					document.getElementById("pp_amount_1").value = the_order_details[0].product_cost_cur;
					*/
					
					document.getElementById("pp_shipping_1").value = the_order_details[0].delivery_cost_cur;
					
					document.getElementById("pp_discount_amount_cart").value = the_order_details[0].discount_in_cur;
					
					document.getElementById("pp_first_name").value = the_order_details[0].first_name;
					document.getElementById("pp_last_name").value = the_order_details[0].last_name;
					document.getElementById("pp_city").value = the_order_details[0].city;
					document.getElementById("pp_address1").value = the_order_details[0].address;
					document.getElementById("pp_zip").value = the_order_details[0].zipcode;
					document.getElementById("pp_country").value = the_order_details[0].country;
					
					document.getElementById("pp_email").value = the_order_details[0].email;	

					for (idx = 0; idx < the_order_details.length; idx++)
					{
						the_id_value = idx + 1;
					
						var el1 = document.createElement("input");
						el1.setAttribute("type", "hidden");
						el1.setAttribute("id", "pp_item_number_"+the_id_value);
						el1.setAttribute("name", "item_number_"+the_id_value);
						el1.setAttribute("value", the_order_details[idx].product_mkt);					
						document.getElementById("form_paypal_payment").appendChild(el1);
						
						var el2 = document.createElement("input");
						el2.setAttribute("type", "hidden");
						el2.setAttribute("id", "pp_item_name_"+the_id_value);
						el2.setAttribute("name", "item_name_"+the_id_value);
						el2.setAttribute("value", the_order_details[idx].product_name);					
						document.getElementById("form_paypal_payment").appendChild(el2);					
				
						var el3 = document.createElement("input");
						el3.setAttribute("type", "hidden");
						el3.setAttribute("id", "pp_quantity_"+the_id_value);
						el3.setAttribute("name", "quantity_"+the_id_value);
						el3.setAttribute("value", the_order_details[idx].product_qty);					
						document.getElementById("form_paypal_payment").appendChild(el3);

						var el4 = document.createElement("input");
						el4.setAttribute("type", "hidden");
						el4.setAttribute("id", "pp_amount_"+the_id_value);
						el4.setAttribute("name", "amount_"+the_id_value);
						el4.setAttribute("value", the_order_details[idx].product_cost_cur);					
						document.getElementById("form_paypal_payment").appendChild(el4);	
						
					} // idx					 
				}
			}
			// Send the data to PHP now... and wait for response to update the status div			
			hr.send(vars); // Actually execute the request						
		}
	}	
	
	function reload_page()
	{		
		location.reload(true);
	}	
	
	function qty_changed(el_name, el_val)
	{
	
		if (el_val)
		{ 
			// Ok
		}
		else
		{
			document.getElementById(el_name).value = 1;
		}		
		
		if ((el_val == 1) || (el_val == 2) || (el_val == 3) || (el_val == 4) || (el_val == 5))
		{ 
			// Ok
		}
		else
		{
			document.getElementById(el_name).value = 1;
		}		
		
		tot_sum = 0;
		
		for(idx=0; idx<<?php echo $n_items_in_the_basket; ?>; idx++)
		{
			var n1 = idx.toString();
			var n2 = n1+'a';
			var n3 = n1+'b';
			
			qty = document.getElementById(n1).value;
			prc = document.getElementById(n2).innerHTML;
			cost = qty * prc; 
			document.getElementById(n3).innerHTML = cost.toFixed(2);
			
			tot_sum = tot_sum + cost;
		}
		
		document.getElementById('tot').innerHTML = tot_sum.toFixed(2);
		
		approveCoupon();
		
		// Create our XMLHttpRequest object
		var hr = new XMLHttpRequest();
		// Create some variables we need to send to our PHP file
		var url = "update_qty_cart_ajax.php";
		var en = el_name;
		var ev = document.getElementById(el_name).value;
		
		var vars = "en="+en+"&ev="+ev;	
		
		hr.open("POST", url, true);
		// Set content type header information for sending url encoded variables in the request
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		// Access the onreadystatechange event for the XMLHttpRequest object
		hr.onreadystatechange = function() {
			if(hr.readyState == 4 && hr.status == 200) {
				var return_data = hr.responseText;
				
				//alert('return_data = '+return_data);
			}
		}
		// Send the data to PHP now... and wait for response to update the status div			
		hr.send(vars); // Actually execute the request								
		
	}
	

	function removeCartItem(n)
	{
		document.getElementById("idCartItemToDelete").innerHTML = n;
		$("#myModal").modal('show');				
	}	
	
	function processRemoveCartItem()
	{
	
		n = document.getElementById("idCartItemToDelete").innerHTML;		
	
		// Create our XMLHttpRequest object
		var hr = new XMLHttpRequest();
		// Create some variables we need to send to our PHP file
		var url = "remove_cart_item_ajax.php";
		
		var vars = "itmtodel="+n;	
		
		hr.open("POST", url, true);
		// Set content type header information for sending url encoded variables in the request
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		// Access the onreadystatechange event for the XMLHttpRequest object
		hr.onreadystatechange = function() {
			if(hr.readyState == 4 && hr.status == 200) {
				var return_data = hr.responseText;
				
				location.reload(true);
				
				//alert('return_data = '+return_data);
			}
		}
		// Send the data to PHP now... and wait for response to update the status div			
		hr.send(vars); // Actually execute the request					
	
	}
	
	function approveCoupon()
	{
	
		bonus_coupon = '<?php echo $_SESSION['coupon']; ?>';
		//bonus_coupon = document.getElementById("coupon_val").innerHTML;
		
		if (bonus_coupon=='')
		{
			bonus_coupon = document.getElementById("coupon").value;	
		}
	 		
		// Create our XMLHttpRequest object
		var hr = new XMLHttpRequest();
		// Create some variables we need to send to our PHP file
		var url = "chk_bc.php";
				
		var vars = "bc="+bonus_coupon;
				
		hr.open("POST", url, true);
		// Set content type header information for sending url encoded variables in the request
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		// Access the onreadystatechange event for the XMLHttpRequest object
		hr.onreadystatechange = function() {
			if(hr.readyState == 4 && hr.status == 200) {
				var return_data = hr.responseText;
						
				// alert('return_data = '+ return_data);
				if (return_data == 'NOT_FOUND')
				{

					document.getElementById("coupon").value = '';
					document.getElementById("bc_desc").innerHTML='';
								
					tot_sum = 0;
					
					for(idx=0; idx<<?php echo $n_items_in_the_basket; ?>; idx++)
					{
						var n1 = idx.toString();
						var n2 = n1+'a';
						var n3 = n1+'b';
						
						qty = document.getElementById(n1).value;
						prc = document.getElementById(n2).innerHTML;
						cost = qty * prc; 
						document.getElementById(n3).innerHTML = cost.toFixed(2);
						
						tot_sum = tot_sum + cost;
					}
					
					document.getElementById('tot').innerHTML = tot_sum.toFixed(2);	
					
				}
				else
				{		
					
					var myObj = JSON.parse(return_data);
										
					document.getElementById("coupon_val").innerHTML = myObj.bonus_display_name;
					
					document.getElementById("the_coupon_button").innerHTML = "<button type=\"button\" class=\"btn btn-default btn-xs\" onClick=\"removeCoupon();\"><i class=\"fa fa-remove\"></i></button>";
					
					document.getElementById("coupon").readOnly = true;
					document.getElementById("bc_desc").innerHTML=myObj.bonus_display_name;					
					
					tot_sum = 0;
					
					tot_sum_for_coupon = 0;
					
					for(idx=0; idx<<?php echo $n_items_in_the_basket; ?>; idx++)
					{
						var n1 = idx.toString();
						var n2 = n1+'a';
						var n3 = n1+'b';
						
						var d0 =  n1+"d";
						var is_disc = 0;
						
						if (document.getElementById(d0).innerHTML.indexOf('*') > 0)
						{
							is_disc = 1;
						}
												
						qty = document.getElementById(n1).value;
						prc = document.getElementById(n2).innerHTML;
						cost = qty * prc; 
						document.getElementById(n3).innerHTML = cost.toFixed(2);
						
						tot_sum = tot_sum + cost;
						
						if (is_disc == 0)
						{
							tot_sum_for_coupon = tot_sum_for_coupon + cost;
						}
					}
					
					if (myObj.bonus_type == 1)
					{						
						if (tot_sum_for_coupon > myObj.bonus_par1 / <? echo $_SESSION['rate']; ?>)
						{
							<?
							if ($_SESSION['sign_place'] == 'r')
							{
							?>
								document.getElementById("s_disc").innerHTML='-'+Number(myObj.bonus_par1/<? echo $_SESSION['rate']; ?>).toFixed(2)+'<? echo $_SESSION['the_curr_sign']; ?>';
							<?
							}
							else
							{
							?>
								document.getElementById("s_disc").innerHTML='-'+'<? echo $_SESSION['the_curr_sign']; ?>'+Number(myObj.bonus_par1/<? echo $_SESSION['rate']; ?>).toFixed(2);
							<?
							}
							?>
							tot_sum = tot_sum - myObj.bonus_par1 / <? echo $_SESSION['rate']; ?>;
							if (tot_sum<0) { tot_sum = 0; }	
						}
					}
					
					if (myObj.bonus_type == 2)
					{
						sum_of_disc = tot_sum_for_coupon * Number(myObj.bonus_par1)/100;
						
						<?
						if ($_SESSION['sign_place'] == 'r')
						{
						?>						
							document.getElementById("s_disc").innerHTML='-'+sum_of_disc.toFixed(2)+'<? echo $_SESSION['the_curr_sign']; ?>';
						<?
						}
						else
						{
						?>
							document.getElementById("s_disc").innerHTML='-'+'<? echo $_SESSION['the_curr_sign']; ?>'+sum_of_disc.toFixed(2);
						<?
						}
						?>						
						tot_sum = tot_sum - sum_of_disc;
						if (tot_sum<0) { tot_sum = 0; }						
					}

					if (myObj.bonus_type == 3)
					{
						if (tot_sum_for_coupon>Number(myObj.bonus_par2/<? echo $_SESSION['rate']; ?>))
						{
							<?
							if ($_SESSION['sign_place'] == 'r')
							{
							?>													
								document.getElementById("s_disc").innerHTML='-'+Number(myObj.bonus_par1/<? echo $_SESSION['rate']; ?>).toFixed(2)+'<? echo $_SESSION['the_curr_sign']; ?>';
							<?
							}
							else
							{
							?>
								document.getElementById("s_disc").innerHTML='-'+'<? echo $_SESSION['the_curr_sign']; ?>'+Number(myObj.bonus_par1/<? echo $_SESSION['rate']; ?>).toFixed(2);							
							<?
							}
							?>
							tot_sum = tot_sum - myObj.bonus_par1/<? echo $_SESSION['rate']; ?>;
							if (tot_sum<0) { tot_sum = 0; }													
						}
					}					
					
					if (myObj.bonus_type == 4)
					{						
						if (tot_sum_for_coupon>Number(myObj.bonus_par2/<? echo $_SESSION['rate']; ?>))
						{
							sum_of_disc = tot_sum_for_coupon * Number(myObj.bonus_par1)/100;
							
							<?
							if ($_SESSION['sign_place'] == 'r')
							{
							?>							
								document.getElementById("s_disc").innerHTML='-'+sum_of_disc.toFixed(2)+'<? echo $_SESSION['the_curr_sign']; ?>';
							<?
							}
							else
							{
							?>
								document.getElementById("s_disc").innerHTML='-'+'<? echo $_SESSION['the_curr_sign']; ?>'+sum_of_disc.toFixed(2);
							<?
							}
							?>
							
							tot_sum = tot_sum - sum_of_disc;
							if (tot_sum<0) { tot_sum = 0; }													
						}
					}					
					
					document.getElementById('tot').innerHTML = tot_sum.toFixed(2);					
									
				}
				
				return;
			}
		}
		// Send the data to PHP now... and wait for response to update the status div			
		hr.send(vars); // Actually execute the request				
		
	}
	
	
	function removeCoupon()
	{
		
		// Create our XMLHttpRequest object
		var hr = new XMLHttpRequest();
		// Create some variables we need to send to our PHP file
		var url = "reset_bc.php";
				
		vars="a=25";
		
		hr.open("POST", url, true);
		// Set content type header information for sending url encoded variables in the request
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		// Access the onreadystatechange event for the XMLHttpRequest object
		hr.onreadystatechange = function() {
			if(hr.readyState == 4 && hr.status == 200) {
				var return_data = hr.responseText;
											
				document.getElementById("coupon").readOnly = false;
				document.getElementById("coupon").value='';
				document.getElementById("bc_desc").innerHTML='';
				document.getElementById("s_disc").innerHTML='';	
				document.getElementById("coupon_val").innerHTML='';
				document.getElementById("the_coupon_button").innerHTML='<button type="button" class="btn btn-success btn-xs" onClick="approveCoupon();"><i class="fa fa-check"></i></button>';
						
				tot_sum = 0;
				
				for(idx=0; idx<<?php echo $n_items_in_the_basket; ?>; idx++)
				{
					var n1 = idx.toString();
					var n2 = n1+'a';
					var n3 = n1+'b';
					
					qty = document.getElementById(n1).value;
					prc = document.getElementById(n2).innerHTML;
					cost = qty * prc; 
					document.getElementById(n3).innerHTML = cost.toFixed(2);
					
					tot_sum = tot_sum + cost;
				}
				
				document.getElementById('tot').innerHTML = tot_sum.toFixed(2);						
				
				location.reload(true);
			}
		}
		// Send the data to PHP now... and wait for response to update the status div			
		hr.send(vars); // Actually execute the request						
		
	}	
	
	</script>
		
  </head>
  <body>
  <!-- start google analytics -->
  <?php include_once("analyticstracking.php") ?>
  <!-- end google analytics --> 
  
	<!--- start header --->
	
	   <div class="navbar-wrapper" style="margin-top:0;">
	   
		   <div class="container">
			   
				<div class="navbar navbar-static-top" style="margin-bottom:0">
				
					<div class="container" style="font-size:16px;">
					
							<button class ="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">		
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>		
							</button>
														
							<div class="collapse navbar-collapse navHeaderCollapse">
							
								<ul class="nav navbar-nav navbar-left">
									<li><a style="color:#5a5a5a;" href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
									<li><a href="about_us.php" style="color:#5a5a5a;">О нас<span class="sr-only">(current)</span></a></li>				
									<li class="dropdown">
									  <a href="#" style="color:#5a5a5a;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Каталог<span class="caret"></span></a>
									  <ul class="dropdown-menu" style="border-radius:12px">
										<li><a style="color:#5a5a5a; font-size:16px;" href="catalog.php?r=1,2,3,4,5,6,7,21">Изделия из серебра</a></li>
										<li><a style="color:#5a5a5a; font-size:16px;" href="catalog.php?r=8,9,10,11,12,13,14,22">Изделия из позолоты</a></li>
										<li><a style="color:#5a5a5a; font-size:16px;" href="catalog.php?r=15,16">Изделия из камней</a></li>					
										<li><a style="color:#5a5a5a; font-size:16px;" href="catalog.php?r=17,18,19,20">Модные украшения</a></li>
										<li><a style="color:#5a5a5a; font-size:16px;" href="new.php">Новинки</a></li>
										<li><a style="color:#5a5a5a; font-size:16px;" href="popular.php">Популярные</a></li>
										<li><a style="color:#5a5a5a; font-size:16px;" href="discounts.php">Скидки</a></li>
									  </ul>
									</li>
									 
									<li><a style="color:#5a5a5a;" href="blog.php">Блог</a></li>
									<li><a style="color:#5a5a5a;" href="contact_us.php">Контакты</a></li>
									 
								  </ul>	

								  <div class="hidden-sm">
									  <ul class="nav navbar-nav navbar-right">
									
										<li class="dropdown">
										  <a style="color:#5a5a5a;" href="#" title="Выберите Валюту" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span id="currency_selection" class="currency_selection" style="color:#EB6B56; font-weight: bold;"><? echo $_SESSION['the_curr_sign']; ?></span><span class="caret"></span></a>
										  <ul class="dropdown-menu" style="border-radius:12px">
											<?php
												for($idc=0; $idc<sizeof($arr_currencies); $idc++)
												{
											?>
													<li><a style="color:#5a5a5a;" href="#" title="<? echo $arr_currencies[$idc]['curr_desc']; ?>" onclick="currencyChanged(<? echo $arr_currencies[$idc]['id']; ?>, '<? echo $arr_currencies[$idc]['curr_sign']; ?>', <? echo $arr_currencies[$idc]['rate']; ?> , '<? echo $arr_currencies[$idc]['sign_place']; ?>', '<? echo $arr_currencies[$idc]['curr_desc']; ?>', '<? echo $arr_currencies[$idc]['curr_name']; ?>' );"><span style="color:#EB6B56; font-weight: bold;"><? echo $arr_currencies[$idc]['curr_sign']; ?></span></a></li>
											<?
												}
											?>
											
										  </ul>
										</li>
										
									  </ul>
								  </div>
								  
								  <div class="hidden-sm">
									  <form class="navbar-form navbar-right" role="search" action="search_result.php" method="get">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Поиск" id="q" name="q" style="border-radius:30px">
										</div>
										<button type="submit" class="btn btn-default" style="border-radius:30px"><span class="glyphicon glyphicon-search"></span></button>
									  </form>
								  </div>
								  
								 <form action="basket.php" class="navbar-form navbar-right" role="basket">				
									<button type="submit" class="btn btn-default" style="border-radius:15px"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;<span class="badge" id="num_el_in_basket"><?php echo $n_items_in_the_basket; ?></span></button>
								 </form>						  
									  							
							</div> <!-- collapse navbar-collapse navHeaderCollapse -->
					
					</div> <!-- container font-size 16px -->
							
				</div> <!-- navbar navbar-static-top -->
			   
		   </div> <!-- container -->
	   
	   </div> <!-- navbar-wrapper -->

	<!--- end header --->		
	
	<div class="clearfix" style="margin-bottom:50px;"></div>
	
	<!--- start slider ---->	
	 
	<div class="slider-block">
		<div class="inner-bg">
			<div class="container">
				<div class="row">
					<div class="span12">
						<h2>магазин украшений "Crystal Sky"</h2>
						<p>Cеребряные украшения, натуральные камни, позолота. Самые изысканные украшения для Вас! Богатые стилистические решения – от классики до авангарда. Наши адреса: город Нацерет-Илит, Мерказ Раско, улица Ацмон 18; город Тверия, Шук Ирони, улица Апрахим 18. Приглашаем Вас за покупками!</p>
					</div>				
				</div>
			</div>
		</div>
	</div>	
	
	<!--- end slider ---->
	
	<div id="come_here"></div>
	
	<div class="clearfix" style="margin-bottom:30px;"></div>
	
	<div id="content"> 		<!-- start content -->
	<div class="container"> <!-- start container -->
	    
		<!-- breadcrumb with navigation details -->
		<div class="col-md-12" >
			<ul class="breadcrumb" style="background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;">
				<li><a href="index.php">Главная</a></li>
				<li>Корзина покупок</li>
			</ul>
		</div>
		<!-- the end of breadcrumb --->		
		
		
		<!-- start left menu categories -->
		
		<div class="col-md-3">
			<div class="panel panel-default sidebar-menu" style="padding:10px; background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;">			
				
				<div class="panel-body" style="margin-bottom:-13px; margin-top:-10px;">										
					<ul class="nav nav-pills nav-stacked" >
						
						<?php		
						
						$main_cat_prev = "";
						
						for ($idx=0; $idx<sizeof($arr_cat_subcat); $idx++)
						{
						
							if ($arr_cat_subcat[$idx]["mc_name"]==$main_cat_prev)
							{
								// do nothing
							}
							else
							{
						?>
						
							<li><a href="catalog.php?r=<?php echo $arr_cat_subcat[$idx]["main"]; ?>"><strong><?php echo $arr_cat_subcat[$idx]["mc_name"]; ?></strong></a></li>
						
						<?php
								$main_cat_prev = $arr_cat_subcat[$idx]["mc_name"];
							}
						?>
																					
							<li <?php if ( $row["category"] == $arr_cat_subcat[$idx]["id"] ) {  echo "class=\"active\""; } ?> style="margin-left:10px;"><a href="catalog.php?r=<?php echo $arr_cat_subcat[$idx]["id"]; ?>"> <?php echo $arr_cat_subcat[$idx]["sc_name"]; ?> (<?php echo $arr_cat_subcat[$idx]["qty"]; ?>)</a></li>							
						
						<?php
						} // for idx					
						?>
												
					</ul>
					</div>				
			</div>

			<div class="banner">
				<a href="#">
					<img src="assets/images/banner_a_02.jpg" alt="магазин ювелирных украшений Crystal Sky" class="img-responsive" style="border-radius: 15px; box-shadow: 2px 2px 3px #888888;">
				</a>
			</div>			

			<br/>
			
			<div class="banner">
				<a href="#">
					<img src="assets/images/banner_a_03.jpg" alt="магазин ювелирных украшений Crystal Sky" class="img-responsive" style="border-radius: 15px; box-shadow: 2px 2px 3px #888888;">
				</a>
			</div>				
			
			<div class="hidden-lg hidden-md">&nbsp;</div>			
			
		</div>
		
		<!-- end left menu categories -->
					
                <div class="col-md-9" >
				
				<!-- start basket place -->

                    <div class="box" style="padding:30px; background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;">

                        <form method="post" action="basket.php#do_the_order">

                            
							
							<?php
							if ($n_items_in_the_basket == 0)
							{
							?>
							
							<h1>Ваша корзина покупок пуста</h1>
							 							 
							<div class="row">

                            <div class="box-footer" style="padding:30px; ">
                                <div class="pull-left">
                                    <a href="catalog.php" class="btn btn-default"><i class="fa fa-chevron-left"></i> Продолжить покупки</a>
                                </div>                                
                            </div>	

							</div> <!-- row -->
							 
							<?php
							}
							else
							{							
							
								$the_words = "<strong>".$n_items_in_the_basket."</strong> наименований товаров";
								
								if ($n_items_in_the_basket == 1) 
								{
									$the_words = "<strong>одно</strong> наименование товара";
								}
								
								if ($n_items_in_the_basket == 2) 
								{
									$the_words = "<strong>два</strong> наименования товаров";
								}								
								
								if ($n_items_in_the_basket == 3) 
								{
									$the_words = "<strong>три</strong> наименования товаров";
								}
								
								if ($n_items_in_the_basket == 4) 
								{
									$the_words = "<strong>четыре</strong> наименования товаров";
								}	

								if ($n_items_in_the_basket == 5) 
								{
									$the_words = "<strong>пять</strong> наименований товаров";
								}	

								if ($n_items_in_the_basket == 6) 
								{
									$the_words = "<strong>шесть</strong> наименований товаров";
								}

								if ($n_items_in_the_basket == 7) 
								{
									$the_words = "<strong>семь</strong> наименований товаров";
								}

								if ($n_items_in_the_basket == 8) 
								{
									$the_words = "<strong>восемь</strong> наименований товаров";
								}

								if ($n_items_in_the_basket == 9) 
								{
									$the_words = "<strong>девять</strong> наименований товаров";
								}								

								if ($n_items_in_the_basket == 10) 
								{
									$the_words = "<strong>десять</strong> наименований товаров";
								}

								if ($n_items_in_the_basket == 11) 
								{
									$the_words = "<strong>одиннадцать</strong> наименований товаров";
								}	

								if ($n_items_in_the_basket == 12) 
								{
									$the_words = "<strong>двенадцать</strong> наименований товаров";
								}

								if ($n_items_in_the_basket == 13) 
								{
									$the_words = "<strong>тринадцать</strong> наименований товаров";
								}

								if ($n_items_in_the_basket == 14) 
								{
									$the_words = "<strong>четырнадцать</strong> наименований товаров";
								}

								if ($n_items_in_the_basket == 15) 
								{
									$the_words = "<strong>пятнадцать</strong> наименований товаров";
								}								
							
							?>
							
							
							
							<h1>Ваша корзина покупок</h1>
                            <p class="text-muted" style="margin-left:4px">сейчас в Вашей корзине <?php echo $the_words; ?></p>
							
							<div class="row">
                            <div class="table-responsive" style="padding:30px;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Товар</th>
                                            <th>Кол-во</th>
                                            <th>Цена</th>                                            
                                            <th colspan="2">Итого</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										// $n_items_in_the_basket
										
										$total_sum = 0;
										
										$keys = array_keys($_SESSION['cart_items']);
										for($i = 0; $i < count($_SESSION['cart_items']); $i++) 
										{
										
									?>
                                        <tr>
                                            <td style="vertical-align: middle">
                                                <a href="item.php?i=<?php echo $keys[$i]; ?>" target='_blank'>
                                                    <img src="<?php echo $_SESSION['cart_items'][$keys[$i]]['photo']; ?>" alt="<?php echo $_SESSION['cart_items'][$keys[$i]]['title']; ?>" width="50">
                                                </a>
                                            </td>
                                            <td style="vertical-align: middle"><a href="item.php?i=<?php echo $keys[$i]; ?>" target='_blank'><?php echo $_SESSION['cart_items'][$keys[$i]]['title']; ?></a><span style="color:red" name="<?php echo $i."d"; ?>" id="<?php echo $i."d"; ?>" ><?php if ($_SESSION['cart_items'][$keys[$i]]['is_discount'] == 1) echo "<b>*</b> <i>по скидке</i>" ?></span>
                                            </td>
                                            <td style="vertical-align: middle">
                                                <input name="<?php echo $i; ?>" id="<?php echo $i; ?>" onchange="qty_changed(this.name, this.value)" type="number" value="<?php echo $_SESSION['cart_items'][$keys[$i]]['qty']; ?>" class="form-control" style="width: 50px; text-align: right;">
                                            </td>
                                            <td style="vertical-align: middle">
											<?php
												if ($_SESSION['sign_place'] == 'r')
												{
											?>
												<span name="<?php echo $i."a"; ?>" id="<?php echo $i."a"; ?>" ><?php  echo number_format($_SESSION['cart_items'][$keys[$i]]['price'] / $_SESSION['rate'], 2, '.', ''); ?></span><? echo $_SESSION['the_curr_sign']; ?>
											<?
												}
												else
												{
											?>
												<? echo $_SESSION['the_curr_sign']; ?><span name="<?php echo $i."a"; ?>" id="<?php echo $i."a"; ?>" ><?php  echo number_format($_SESSION['cart_items'][$keys[$i]]['price'] / $_SESSION['rate'], 2, '.', ''); ?></span> 											
											<?
												}
											?>
											</td>                                            
                                            <td style="vertical-align: middle">
											<?php
											if ($_SESSION['sign_place'] == 'r')
											{											
											?>
												<span name="<?php echo $i."b"; ?>" id="<?php echo $i."b"; ?>" ><?php echo number_format($_SESSION['cart_items'][$keys[$i]]['price'] * $_SESSION['cart_items'][$keys[$i]]['qty'] / $_SESSION['rate'], 2, '.', ''); ?></span><? echo $_SESSION['the_curr_sign']; ?>
											<?
											}
											else
											{
											?>
												<? echo $_SESSION['the_curr_sign']; ?><span name="<?php echo $i."b"; ?>" id="<?php echo $i."b"; ?>" ><?php echo number_format($_SESSION['cart_items'][$keys[$i]]['price'] * $_SESSION['cart_items'][$keys[$i]]['qty'] / $_SESSION['rate'], 2, '.', ''); ?></span>
											
											<?
											}
											?>
											</td>
                                            <td style="vertical-align: middle"><a href="javascript:void(0)" onclick="removeCartItem(<?php echo $keys[$i]; ?>)"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
									<?php
									
											$total_sum=$total_sum + ($_SESSION['cart_items'][$keys[$i]]['price']  / $_SESSION['rate'] )* $_SESSION['cart_items'][$keys[$i]]['qty'];
										}
									?>
									
                                        <tr>
                                            <td style="vertical-align: middle">
                                               Купон<div id='coupon_val' style="display: none;"><?php echo $_SESSION['coupon']; ?></div>
                                            </td>
                                            <td colspan="3" style="vertical-align: middle">
												<table border='0'>
													<tr style="vertical-align: middle">
														<td style="vertical-align: middle"> 
															<input name="coupon" id="coupon" value="<?php echo $_SESSION['coupon']; ?>" class="form-control input-sm" style="width: 150px; text-align: left;">											
														</td>
														<td style="vertical-align: middle; padding:10px;"> 
															<span id="the_coupon_button"><button type="button" class="btn btn-success btn-xs" onClick="approveCoupon();"><i class="fa fa-check"></i></button></span>
														</td>														
														<td style="vertical-align: middle; padding:10px; width:340px;"> 
															<small><span id='bc_desc'></span></small>															
														</td>
													</tr>
												</table>
                                            </td>											
                                            <td style="vertical-align: middle"><span style="color:green" id="s_disc"></span></td>
                                            <td style="vertical-align: middle"></td>
                                        </tr>						
						
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4"><span style="font-weight:bold; font-size:18px"><b>Итого</b></span></th>
                                            <th colspan="2" style="text-align:left">
												<? 
													if ($_SESSION['sign_place']=='r')
													{
												?>
													<span name="tot" id="tot" style="font-weight:bold; font-size:18px"><?php echo number_format($total_sum, 2, '.', ''); ?></span><? echo $_SESSION['the_curr_sign']; ?>
												<?
													}
													else
													{
												?>
													<? echo $_SESSION['the_curr_sign']; ?><span name="tot" id="tot" style="font-weight:bold; font-size:18px"><?php echo number_format($total_sum, 2, '.', ''); ?></span>												
												<?
													}
												?>
											</th>
                                        </tr>
                                    </tfoot>
                                </table>

								<div class="box-footer" style="padding:30px; ">
									<div class="pull-left">
										<a href="catalog.php" class="btn btn-default"><i class="fa fa-chevron-left"></i> Продолжить Покупки</a>
									</div>
									<div class="pull-right">          																											
										<button type="submit" class="btn btn-success">Оформить Заказ <i class="fa fa-chevron-right"></i></button>                                    
									</div>
								</div>								
								
                            </div>
                            <!-- /.table-responsive -->
					
							</div> <!-- row -->
							
							<?php
							}
							?>

                        </form>

                    </div>					
							
				<!-- end basket place -->	
				
				
					<div class="clearfix" style="margin-bottom:20px;"></div>
				

					<div id="do_the_order" class="panel panel-default" style="padding:30px; background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;">
				 
						<div class="panel-body">
					
							<!--- start form --->
	
							<!--- address panel -->
							<form data-toggle="validator" role="form" id="OrderForm" autocomplete="off">
							
								<div class="row" id="contact_status">
								
									<div class='col-md-12 col-sm-12 col-xs-12'>
									  <div id="inp_country" class="form-group">
										<label>Ваша Страна</label>
										<input type="text" class="form-control" id="country" name="country">
									  </div>
									</div>
									
									<div class='col-md-12 col-sm-12 col-xs-12'>
									  <div id="inp_city" class="form-group">
										<label>Ваш Город</label>
										<input type="text" class="form-control" id="city" name="city">
									  </div>
									</div>										

									<div class='col-md-6 col-sm-6 col-xs-12'>
									  <div id="inp_first_name" class="form-group">
										<label>Ваше Имя</label>
										<input type="text" class="form-control" id="firstname" name="firstname">
									  </div>
									</div>
									
									<div class='col-md-6 col-sm-6 col-xs-12'>
									  <div id="inp_last_name" class="form-group">
										<label>Ваше Фамилия</label>
										<input type="text" class="form-control" id="lastname" name="lastname">
									  </div>
									</div>								


									<div class='col-md-12 col-sm-12 col-xs-12'>
									  <div id="inp_address" class="form-group">
										<label>Ваш Адрес</label>
										<input type="text" class="form-control" id="address" name="address">
									  </div>
									</div>
							
								
									<div class='col-md-12 col-sm-12 col-xs-12'>
									  <div id="inp_zipcode" class="form-group">
										<label>Ваш Почтовый Индекс</label>
										<input type="text" class="form-control" id="zipcode" name="zipcode">
									  </div>
									</div>
		
									<div class='col-md-12 col-sm-12 col-xs-12'>
									  <div id="inp_phone" class="form-group">
										<label>Ваш Телефон</label>
										<input type="text" class="form-control" id="phone" name="phone">
									  </div>
									</div>
									
								
									<div class='col-md-12 col-sm-12 col-xs-12'>
									  <div id="inp_email" class="form-group">
										<label>Ваш Емайл</label>
										<input type="email" class="form-control" id="email" name="phone">
									  </div>
									</div>
									
									<div class='col-md-12 col-sm-12 col-xs-12'>
									  
										<div id="inp_delivery" class="form-group" >
											<label >Доставка</label>
											<div >
												<select class="form-control" id="delivery" name="delivery">
													<?php
													for($idx=0; $idx<sizeof($arr_delivery); $idx++)
													{
														$delivery_cost_in_currency = money_format('%i', ceil($arr_delivery[$idx]['delivery_cost_nis']/$_SESSION['rate']));
														if ($_SESSION['sign_place'] == 'r')
														{													
															$delivery_suffix = $delivery_cost_in_currency.$_SESSION['the_curr_sign'];
														}
														else
														{
															$delivery_suffix = $_SESSION['the_curr_sign'].$delivery_cost_in_currency;
														}
													?>													
														<option value="<?php echo $arr_delivery[$idx]['id']; ?>"><?php echo $arr_delivery[$idx]['delivery_desc']." (".$delivery_suffix.")"; ?></option>
													<?php
													}
													?>
												</select>
											</div>
										</div>								  
									  
									</div>											

									<div class='col-md-12 col-sm-12 col-xs-12'>							
										<div  id="inp_remark" class="form-group">
											<label for="message">Примечания к заказу</label>
											<textarea id="remark" class="form-control" name="remark"></textarea>
										</div>	
									</div>								

									<div class='col-md-4 col-sm-4 col-xs-12'>
										<div id="inp_captcha" class="form-group">
											<label for="captcha">Сколько будет <?php echo $a; ?> + <?php echo $b; ?> = ?</label>
											<input type="text" class="form-control" name="captcha" id="captcha">
										</div>
									</div>								
									
									<div class="col-sm-12 col-md-12 col-xs-12 text-center">
										<div class="text-center"><button type="submit" class="btn btn-success" onclick="ajax_post(); return false;">Заказать</button></div>
									</div>							
								
								</div> <!--- row --->
														
							</form>	
							<!--- address panel -->
							
							
							<div class="jumbotron" id='txtreply' style='display:none'>
								<h2 style='text-align:center'>Спасибо за Ваш заказ!</h2>
								
								<p style='text-align:center'>Произвести оплату заказа в системе PayPal.</p>								
								<p style='text-align:center'><img class="img-responsive center-block" src='assets/images/paypal-icon-2.png' border='0' title='Произведите Оплату в Системе PayPal'></p>
								
								<p style='text-align:center'>
								<div class="checkbox" style='text-align:center'>
									<label><input type="checkbox" id="elAcceptTermsAndConditions" onClick="acceptTermsAndConditions();"> Вы принимаете <a href="payment_conditions.php" target='_blank'>Условия заказа и оплаты</a>.</label>
								</div>
								</p>	
								
								<form name="form_paypal_payment" id="form_paypal_payment" action="<?php if ($arr_paypal_sandbox[0]['prop_value'] == 'no') echo 'https://www.paypal.com/cgi-bin/webscr';  else echo 'https://www.sandbox.paypal.com/cgi-bin/webscr'; ?>" method="post" target="_blank">
																	
								 	<input type="hidden" name="cmd" value="_cart"> 
									<input type="hidden" name="upload" value="1">
									<input TYPE="hidden" name="charset" value="utf-8">
									<input type="hidden" name="business" value="<?php echo $arr_paypal[0]['prop_value']; ?>">
									<input type="hidden" name="currency_code" value="<? echo $_SESSION['curr_name']; ?>">

									<input TYPE="hidden" name="email" id="pp_email" value="">
									<!-- <input type="hidden" name="item_number_1" id="pp_item_number_1" value=""> -->
									<!-- <input type="hidden" name="item_name_1" id="pp_item_name_1" value=""> -->								
									<!-- <input type="hidden" name="quantity_1" id="pp_quantity_1" value=""> -->
									<!-- <input type="hidden" name="amount_1" id="pp_amount_1" value=""> -->	 

									<input type="hidden" name="shipping_1" id="pp_shipping_1" value="">																		
									<input type="hidden" name="discount_amount_cart" id="pp_discount_amount_cart" value="" >

									<!--<input type="hidden" name="address_override" value="1">-->

									<input type="hidden" name="first_name" id="pp_first_name" value="">
									<input type="hidden" name="last_name" id="pp_last_name" value="">
									<input type="hidden" name="address1" id="pp_address1" value="">
									<input type="hidden" name="city" id="pp_city" value="">
									<input type="hidden" name="state" value="">
									<input type="hidden" name="zip" id="pp_zip" value="">
									<input type="hidden" name="country" id="pp_country" value="">

									<p style='text-align:center'><button type="submit" id="submitPaypalBtn" name="submit_paypal" class="btn btn-primary btn-lg disabled" disabled>Оплатить</button></p>
									
								</form>							
														
							</div>							
							
						<!---  end form --->									
						</div>	
						
					</div>
				
				</div> <!-- /.col-md-9 -->

	</div> <!-- end container -->
	</div> <!-- end content -->
		
	<div class="clearfix" style="margin-bottom:30px;"></div>
	
		<!-- Pre footer -->
	
        <div id="footer" data-animate="fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <h4>Страницы</h4>

                        <ul>
                            <li><a href="index.php">Главная</a>
                            </li>						
                            <li><a href="about_us.php">О нас</a>
                            </li>
							<li><a href="catalog.php">Каталог</a>
                            </li>
							<li><a href="new.php">Новинки</a>
                            </li>
							<li><a href="popular.php">Популярные</a>
                            </li>								
							<li><a href="discounts.php">Скидки</a>
                            </li>														
                            <li><a href="feedbacks.php">Отзывы покупателей</a>
                            </li>
                            <li><a href="blog.php">Блог</a>
                            </li>
                            <li><a href="contact_us.php">Контакты</a>
                            </li>
                        </ul>

                        <hr>

                        <h4>Мероприятия</h4>

                        <ul>
                            <li><a href="events.php#ev1">"Пригласите Друзей!"</a>
                            </li>
                            <li><a href="events.php#ev2">"Наш Баннер"</a>
                            </li>
                        </ul>

                        <hr class="hidden-md hidden-lg hidden-sm">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Каталог</h4>
 					 
                        <ul>
                            <li><a href="catalog.php?r=1,2,3,4,5,6,7,21">Ювелирные украшения из серебра</a>
                            </li>
                            <li><a href="catalog.php?r=8,9,10,11,12,13,14,22">Ювелирные украшения из позолоты</a>
                            </li>
                            <li><a href="catalog.php?r=15,16">Ювелирные украшения из камней</a>							
                            </li>
                            <li><a href="catalog.php?r=17,18,19,20">Модные украшения</a>							
                            </li>
                            <li><a href="catalog.php?r=1">Наборы из серебра</a>
                            </li>
                            <li><a href="catalog.php?r=16">Браслеты из камней</a>
                            </li>
                            <li><a href="catalog.php?r=15">Ожерелья из камней</a>							
                            </li>
                            <li><a href="catalog.php?r=20">Часы</a>							
                            </li>
                            <li><a href="catalog.php?r=19">Серьги из стекла</a>
                            </li>
                            <li><a href="catalog.php?r=18">Ожерелья из стекла</a>
                            </li>
                            <li><a href="catalog.php?r=17">Кулоны из стекла</a>							
                            </li>	
                        </ul>
						
                        <hr>

                        <h4>Карта Сайта</h4>

                        <ul>
                            <li><a href="map.php">Карта Сайта</a>
                            </li>                            
                        </ul>						

                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Наши адреса</h4>

                        <p><strong>магазин "Crystal Sky"</strong>
                            <br>улица Ацмон 18
                            <br>Мерказ Раско
                            <br>город Нацерет-Илит
                            <br>Северный Округ
                            <br>
                            <strong>Израиль</strong>
                        </p>

                        <p><strong>магазин "Crystal Sky"</strong>
                            <br>улица Апрахим 18
                            <br>Шук Ирони
                            <br>город Тверия
                            <br>Северный Округ
                            <br>
                            <strong>Израиль</strong>
                        </p>

                        <a href="contact_us.php">Связаться с нами</a>

                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->



                    <div class="col-md-3 col-sm-6">

                        <h4>Подпишитесь на новости</h4>

                        <p class="text-muted">Введите свой емайл и будьте в курсе всех новостей и мероприятий магазина "Crystal Sky"! Подпишитесь сейчас и получайте скидки!</p>

                        <form  enctype="multipart/form-data" method="post" name="SubscribeEmail" autocomplete="off" onsubmit="subscribeEmail()">
                            <div class="input-group">
								
                                <input type="text" class="form-control" name="subscr_email" id="subscr_email">

                                <span class="input-group-btn">

									<button class="btn btn-default" type="submit" onclick="subscribeEmail(); return false;">Подписаться!</button>

								</span>

                            </div>
                            <!-- /input-group -->
                        </form>

                        <hr>

                        <h5>Присоединяйтесь к нам! Подписывайтесь на наши страницы в социальных сетях!</h5>

						
                        <p class="social">
							<a href="http://ok.ru/crystalsky" target='_blank' class="odnoklassniki external" data-animate-hover="shake"><i class="fa fa-odnoklassniki"></i></a>
                            <a href="http://facebook.com/crystalsky.jewelry" target='_blank' class="facebook external" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>
                            <a href="https://twitter.com/CrystalSky925" target='_blank' class="twitter external" data-animate-hover="shake"><i class="fa fa-twitter"></i></a>							
                            <a href="https://www.instagram.com/crystal_sky_jewelry/" target='_blank' class="instagram external" data-animate-hover="shake"><i class="fa fa-instagram"></i></a>
							<a href="https://www.youtube.com/channel/UCeiNKvNYTd4sTA-h3VlyrBg/videos" target='_blank' class="youtube external" data-animate-hover="shake"><i class="fa fa-youtube"></i></a>
                            <a href="http://crystalsky925.blogspot.com/" target='_blank' class="feed external" data-animate-hover="shake"><i class="fa fa-feed"></i></a>
					   </p>
						


                    </div>
                    <!-- /.col-md-3 -->

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#footer -->	
	
	<!-- End Pre Footer -->
	
	
	<!-- Footer -->
		
	<div id="copyright">
		<div class="container">
			<div class="col-md-8">
				<p class="pull-left">© 2016 Магазин "Crystal Sky"<div class="hidden-sm hidden-xs"> - украшения из серебра, натуральные камни, позолота</div></p>
			</div>
			<div class="col-md-4">
				<p class="pull-right"><a href="#">Back To Top</a></p>
			</div>
		</div>
	</div>	
			
	<!-- End Footer -->	


	<!-- modal window -->		
	
	<div id="myModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Вы уверены?</h4>
				</div>
				<div class="modal-body">
					<p>Вы уверены, что хотите удалить товар из корзины покупок?</p>
					<p class="text-warning"><small>У Вас есть вопрос? Вы не уверены, какое украшение подходит именно Вам? Наши менеджеры будут рады ответить на Ваши вопросы! Мы дорожим нашей репутацией и стремимся делать всё, чтобы наши клиенты оставались всегда довольны! Спасибо Вам за то, что являетесь клиентом магазина "Crystal Sky"! Магазин "Crystal Sky" - серебряные украшения, натуральные камни, позолота. Самые изысканные изделия для Вас!</small></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Нет, я передумал(а). Не удалять!</button>
					<button type="button" onClick="processRemoveCartItem();" class="btn btn-primary">Да!</button>
				</div>
				<div id="idCartItemToDelete" style="display: none;"></div>
			</div>
		</div>
	</div>		
	
	<!-- modal window -->
	
	<?php
		
	// close db connection
	$conn->close();	
	
	?>
	
	<script>
	
		/// initialize coupon on page reload 
		/// start
		
		bonus_coupon = '<?php echo $_SESSION['coupon']; ?>';
		
		if (bonus_coupon!='')
		{
			approveCoupon();
		} 

		/// end	
		
	</script>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
	
	<script>
	
	$('.dropdown-menu a').on('click', function(){    
		$(this).parent().parent().prev().html($(this).html() + '<span class="caret"></span>');    
	})	
	
	</script>
	
	<?php require_once('trace_login_businesslog.php'); ?>
	
<!--- image presenter --->

<div class="modal fade" tabindex="-1" role="dialog" id="myModalOk" name="myModalOk">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="imgPresenterTitle">Подпишитесь на новости</h4>
      </div>
      <div class="modal-body" id="imgPresenterBody" name="imgPresenterBody" style="margin-left:auto; margin-right:auto; text-align:center">       
	  Спасибо! Ваш емайл успешно занесен в нашу базу данных! <br/>Вы будьте в курсе всех новостей и мероприятий магазина "Crystal Sky"! 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--- image presenter --->		

   <script src="assets/js/jquery.backstretch.min.js"></script>
   <script>
		jQuery(document).ready(function() {
			$('.slider-block').backstretch([
			  "assets/images/backgrounds/e1.jpg"
			, "assets/images/backgrounds/e2.jpg"
			, "assets/images/backgrounds/e3.jpg"
			], {duration: 3000, fade: 750});
		});     
   </script>

	
  </body>
</html>