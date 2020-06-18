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
	
	$sql_min_item = "select min(id) min_prod_id from products where status='1'";
								
	$arr_min_prod_id = array();		
	$results_min_prod_id = mysqli_query($conn, $sql_min_item); 	
	
	while($line = mysqli_fetch_assoc($results_min_prod_id)){
		$arr_min_prod_id[] = $line;
	}	
	
	
	// item id
	//
	if (!$_GET["i"]) 
	{
		$i =  $arr_min_prod_id[0]['min_prod_id'];
	}
	else
	{				
		$i = $_GET['i'];
				
		if (is_numeric($i))
		{				
			if (round($i, 0) == $i)
			{
				// Ok
				// increase number of views for this product in the db
				
				$sqlu = "update products set nviews=nviews+1 where id = ".$i;

				if ($conn->query($sqlu) === TRUE) {
					// Ok
				} else {
					// Not Ok
				}				
				
				//
			}
			else
			{
				$i = $arr_min_prod_id[0]['min_prod_id'];
			}
		}
		else
		{				
			$i = $arr_min_prod_id[0]['min_prod_id'];
		}
	}				
			
	$sql = "select * from products where id = ".$i;
	
	$result = $conn->query($sql);
	
	$n_of_rows = $result->num_rows;
	
	$row = $result->fetch_assoc();
		
	if ($n_of_rows==1)
	{
			// Ok
	}
	else
	{
		$i = $arr_min_prod_id[0]['min_prod_id'];
		
		$sql = "select * from products where id = ".$i;
	
		$result = $conn->query($sql);			
		
		$row = $result->fetch_assoc();
			
	}
	 
	 
	$sql_get_cat_subcat = "select sc.id the_subcat_id, ca.id the_cat_id, sc.name the_subcat, ca.name the_cat from sub_category sc, main_category ca where ca.id=sc.main_category and sc.id = ".$row["category"];
	
	$result_get_cat_subcat = $conn -> query($sql_get_cat_subcat);
	
	$row_get_cat_subcat = $result_get_cat_subcat->fetch_assoc();
	
	
	$sql_get_the_metall = "select name from metall where id = ".$row['metall'];
		
	$result_get_the_metall = $conn -> query($sql_get_the_metall);
	
	$row_get_the_metall = $result_get_the_metall->fetch_assoc();
	
	
	//$sql_get_the_stones = "select group_concat(name separator ', ') names from stones where id in (select stone_id from product_stone_link where product_id = ".$row["id"].")";
			
	$sql_get_the_stones = "select group_concat(s.name separator ', ') names from stones s, products p where  s.id in ( p.stone1 , p.stone2, p.stone3) and p.id = ".$row["id"];
	
	$result_get_the_stones = $conn -> query($sql_get_the_stones);
	
	$row_get_the_stones = $result_get_the_stones->fetch_assoc();	
	

	// $sql_get_the_sizes = "select group_concat(name separator ', ') the_sizes from sizes where id in (select size_id from product_size_link where product_id = ".$row["id"].")";

	$sql_get_the_sizes = "select group_concat(s.name separator ', ') the_sizes from sizes s, products p where  s.id in ( p.size1 , p.size2, p.size3) and p.id = ".$row["id"];
		
	$result_get_the_sizes = $conn -> query($sql_get_the_sizes);
	
	$row_get_the_sizes = $result_get_the_sizes->fetch_assoc();	
	
	
	// $sql_get_the_colors = "select group_concat(name separator ', ') the_colors from color where id in (select color_id from product_color_link where product_id = ".$row["id"].")";
		
	$sql_get_the_colors = "select group_concat(s.name separator ', ') the_colors from color s, products p where  s.id in ( p.color1 , p.color2, p.color3) and p.id = ".$row["id"];
	
	$result_get_the_colors = $conn -> query($sql_get_the_colors);
	
	$row_get_the_colors = $result_get_the_colors->fetch_assoc();	
	  
	  
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

	
	$sql_is_to_show_product_views = "select * from app_properties where prop_name='is_to_show_product_views' ";
								
	$arr_is_to_show_product_views = array();		
	$results_is_to_show_product_views = mysqli_query($conn, $sql_is_to_show_product_views); 	
	
	while($line = mysqli_fetch_assoc($results_is_to_show_product_views)){
		$arr_is_to_show_product_views[] = $line;
	}		
	
	$is_to_show_product_views = $arr_is_to_show_product_views[0]['prop_value'];	
		
	
	$sql_templates_to_share_on_facebook = "select * from share_facebook_templates where status='A' order by modify_dt";
								
	$arr_templates_to_share_on_facebook = array();		
	$results_templates_to_share_on_facebook = mysqli_query($conn, $sql_templates_to_share_on_facebook); 	
	
	while($line = mysqli_fetch_assoc($results_templates_to_share_on_facebook)){
		$arr_templates_to_share_on_facebook[] = $line;
	}		

	
	$sql_we_recommend = "select * from products where status='1' and show_price = '1' order by modifydate desc";
								
	$arr_we_recommend = array();		
	$results_we_recommend = mysqli_query($conn, $sql_we_recommend); 	
	
	while($line = mysqli_fetch_assoc($results_we_recommend)){
		$arr_we_recommend[] = $line;
	}	
	
	
	$sql_items_recommended_to_show = "select * from app_properties where prop_name='n_items_recommended_to_show' ";
								
	$arr_items_recommended_to_show = array();		
	$results_items_recommended_to_show = mysqli_query($conn, $sql_items_recommended_to_show); 	
	
	while($line = mysqli_fetch_assoc($results_items_recommended_to_show)){
		$arr_items_recommended_to_show[] = $line;
	}		
	
	$n_items_recommended_to_show = $arr_items_recommended_to_show[0]['prop_value'];	
	
	?>		
	
    <title>магазин "Crystal Sky" - <?php echo $row["title"]; ?></title>

    <meta name="keywords" content="<?php echo $row["title"]; ?> - Crystal Sky, Нацерет-Илит, Израиль, Раско, ювелирные, серебро, 925, позолота, камни, выбор, рубин, топаз, сапфир, аметист" />
	<meta name="description" content="<?php echo $row["title"]; ?> - <?php echo $row["short_desc"]; ?> - магазин Crystal Sky - Нацерет-Илит, Мерказ Раско, Ацмон 18, Израиль" />
	
	<!-- Start Facebook OG -->
	
	<meta property="og:title" content="<?php echo $row["title"]; ?> - магазин Crystal Sky - серебряные украшения, натуральные камни, позолота" />
	<meta property="og:url" content="https://www.facebook.com/sharer/sharer.php?u=http://www.crystalsky.co.il/item.php?i=<?php echo $i; ?>" />
	<meta property="og:image" content="<?php echo $row["photo1"]; ?>" />
	<meta property="og:description" content="<?php echo $row["title"]; ?> - <?php echo $row["short_desc"]; ?> - Cеребряные украшения, натуральные камни, позолота. Самые изысканные украшения для Вас! Нацерет-Илит, Мерказ Раско, улица Ацмон 18, www.crystalsky.co.il" />
	<meta property="og:type" content="website" />
	
	<!-- End Facebook -->
	
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
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="jquery.min.js"></script>	
	
	<style>
	#likebox-wrapper * {
	   width: 100% !important;
	}	
	</style>
	
	<script>
	
	$(document).ready(function () {

		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('.scrollup').fadeIn();
			} else {
				$('.scrollup').fadeOut();
			}
		});

		$('.scrollup').click(function () {
			$("html, body").animate({
				scrollTop: 0
			}, 600);
			return false;
		});

	}); 	
	
	function ILikeIt()
	{			
		var nErrors =0;
		
		if (document.getElementById("like_firstname").value==null || document.getElementById("like_firstname").value=="")
		{
						
			document.getElementById("like_firstname").style.borderColor = "red";
			document.getElementById("like_firstname").style.boxShadow = "3px 3px 3px lightgray";				
			nErrors++;
		}			
		else 
		{
			document.getElementById("like_firstname").style.borderColor = "#e3e3e3";
			document.getElementById("like_firstname").style.boxShadow = "none";	
		}			
		
		if (document.getElementById("like_email").value==null || document.getElementById("like_email").value=="")
		{
						
			document.getElementById("like_email").style.borderColor = "red";
			document.getElementById("like_email").style.boxShadow = "3px 3px 3px lightgray";				
			nErrors++;
		}	
		else if (!validateEmail(document.getElementById("like_email").value))
		{							
			document.getElementById("like_email").style.borderColor = "red";
			document.getElementById("like_email").style.boxShadow = "3px 3px 3px lightgray";							
			nErrors++;			
		}		
		else 
		{
			document.getElementById("like_email").style.borderColor = "#e3e3e3";
			document.getElementById("like_email").style.boxShadow = "none";	
		}			
					
		if (nErrors==0)
		{
		
			var url = "i_like_it.php";
		
			var oData = new FormData(document.forms.namedItem("LikeForm"));
			
			var oReq = new XMLHttpRequest();
			  oReq.open("POST", url, true);
			  oReq.onload = function(oEvent) {
			  
				if (oReq.status == 200) 
				{								
					$('#myDoLike').modal('hide');	
					location.reload(true);
					return;					
				} else {
				  alert("Error: " + oReq.status);
				}
			  };
			oReq.send(oData); 

		}			
	}    	
	
	function doLike(n,t)
	{			
		document.getElementById("like_firstname").style.borderColor = "#e3e3e3";
		document.getElementById("like_firstname").style.boxShadow = "none";			
		
		document.getElementById("like_email").style.borderColor = "#e3e3e3";
		document.getElementById("like_email").style.boxShadow = "none";	

		document.getElementById("like_city").style.borderColor = "#e3e3e3";
		document.getElementById("like_city").style.boxShadow = "none";			
	
		document.getElementById("like_phone").style.borderColor = "#e3e3e3";
		document.getElementById("like_phone").style.boxShadow = "none";	
	
		document.getElementById("theItemName").innerHTML = t;
		
		document.getElementById("like_product_id").value = n;
		document.getElementById("like_product_name").value = t;
		
		$("#myDoLike").modal('show');
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
	
	function qlik_img(n)
	{
		if (n==1)
		{
			document.getElementById('the_main_img').src='<?php echo $row["photo1"]; ?>';
		}
		
		if (n==2)
		{
			document.getElementById('the_main_img').src='<?php echo $row["photo2"]; ?>';
		}
		
		if (n==3)
		{
			document.getElementById('the_main_img').src='<?php echo $row["photo3"]; ?>';
		}
	
	}
	
	
	function validateEmail(email) {
		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	}	
		
	function isEmpty(myObject) {
		for(var key in myObject) {
			if (myObject.hasOwnProperty(key)) {
				return false;
			}
		}

		return true;
	}	
	
	
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
			var url = "send_your_order.php";
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
												
					 //alert('return_data= '+return_data);
										
					document.getElementById("txtreply").style.display='block';
					document.getElementById("contact_status").style.display='none';
					document.getElementById("txtreply").scrollIntoView(true);
										
					var the_order_details = JSON.parse(return_data);
					
					document.getElementById("pp_item_number_1").value = the_order_details[0].product_mkt;
					document.getElementById("pp_item_name_1").value = the_order_details[0].product_name;
					document.getElementById("pp_quantity_1").value = the_order_details[0].product_qty;
					document.getElementById("pp_amount_1").value = the_order_details[0].product_cost_cur;
					
					document.getElementById("pp_shipping_1").value = the_order_details[0].delivery_cost_cur;
					
					document.getElementById("pp_first_name").value = the_order_details[0].first_name;
					document.getElementById("pp_last_name").value = the_order_details[0].last_name;
					document.getElementById("pp_city").value = the_order_details[0].city;
					document.getElementById("pp_address1").value = the_order_details[0].address;
					document.getElementById("pp_zip").value = the_order_details[0].zipcode;
					document.getElementById("pp_country").value = the_order_details[0].country;
					
					document.getElementById("pp_email").value = the_order_details[0].email;
					
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
	
	function addItemToCard(n)
	{
			
		if (<?php echo $n_items_in_the_basket; ?> > 9)
		{					
			$("#myModal2").modal('show');
			return;
		}
			
		// Create our XMLHttpRequest object
		var hr = new XMLHttpRequest();
		// Create some variables we need to send to our PHP file
		var url = "add_item_to_cart.php";
		var it = '<?php echo $i; ?>';
		var ph = '<?php echo $row["photo1"]; ?>';
		var tt = '<?php echo $row["title"]; ?>';
		var mt = '<?php echo $row["makat"]; ?>';
		var pr = '<?php echo $row["price"]; ?>';
		var id = '<?php echo $row["is_discount"]; ?>';
		
		var vars = "it="+it+"&ph="+ph+"&tt="+tt+"&mt="+mt+"&pr="+pr+"&id="+id;
		hr.open("POST", url, true);
		// Set content type header information for sending url encoded variables in the request
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		// Access the onreadystatechange event for the XMLHttpRequest object
		hr.onreadystatechange = function() {
			if(hr.readyState == 4 && hr.status == 200) {
				var return_data = hr.responseText;
											
				//alert('return_data= '+Number(return_data));
				$("#myModal").modal('show');
				document.getElementById("num_el_in_basket").innerHTML=Number(return_data);
			}
		}
		// Send the data to PHP now... and wait for response to update the status div			
		hr.send(vars); // Actually execute the request						
		return true;
	}
	
	function currencyChanged(n,s,r,p,d,cn)
	{
		// alert('n='+n);
		 
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
				
				window.location.reload(true);
			}
		}
		http.send(params);		 
		 
	}	
	
	</script>
		
  </head>
  <body>
  
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>  
  
  <!-- start google analytics -->
  <?php include_once("analyticstracking.php") ?>
  <!-- end google analytics --> 
  
	<!-- start header -->
	
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

	<!-- end header -->		
	
	<div class="clearfix" style="margin-bottom:50px;"></div>
	
	<!-- start slider -->	
	 
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
	
	<!-- end slider -->
	
	<div id="come_here"></div>
	
	<div class="clearfix" style="margin-bottom:30px;"></div>
	
	<div id="content"> 		<!-- start content -->
	<div class="container"> <!-- start container -->
		<?php
		
			$the_main_cat_ref = "";
			
			for($idx=0; $idx<sizeof($arr_cat_subcat); $idx++)
			{
					if($arr_cat_subcat[$idx]["id"] == $row_get_cat_subcat["the_subcat_id"])
					{
						$the_main_cat_ref = $arr_cat_subcat[$idx]["main"];
					}					
			}
			
		?>
		<!-- breadcrumb with navigation details -->
		<div class="col-md-12" >
			<ul class="breadcrumb" style="background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;">
				<li><a href="index.php">Главная</a>
				<li><a href="catalog.php?r=<?php echo $the_main_cat_ref; ?>"><?php echo $row_get_cat_subcat["the_cat"]; ?></a>
				</li>
				<li><a href="catalog.php?r=<?php echo $row_get_cat_subcat["the_subcat_id"]; ?>"><?php echo $row_get_cat_subcat["the_subcat"]; ?></a>
				</li>				
				<li><?php echo $row["title"]; ?></li>
			</ul>
		</div>
		<!-- the end of breadcrumb -->		
		
		
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
				<center>
				<a href="#">
					<img src="assets/images/banner_a_02.jpg" alt="магазин ювелирных украшений Crystal Sky" class="img-responsive" style="border-radius: 15px; box-shadow: 2px 2px 3px #888888;">
				</a>
				</center>
			</div>	

			<br/>
			
			<div class="banner">
				<center>
				<a href="#">
					<img src="assets/images/banner_a_03.jpg" alt="магазин ювелирных украшений Crystal Sky" class="img-responsive" style="border-radius: 15px; box-shadow: 2px 2px 3px #888888;">
				</a>
				</center>
			</div>				

			<div class="hidden-lg hidden-md">&nbsp;</div>			
			
		</div>
		
		<!-- end left menu categories -->
					
                <div class="col-md-9">
				
					<div class="row" id="productMain">
                        <div class="col-sm-6">							
                            <div id="mainImage" style="padding:10px; background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888; ">								
                                <img id="the_main_img" src="<?php echo $row["photo1"]; ?>" alt="<?php echo $row["title"]; ?>" class="img-responsive" style="display: block; margin: 0 auto;" width="380" height="380" >
								  <?php
								  if ($row["is_discount"] == 1)
								  {						  
								  ?>
									<div class="ribbon_red" style="margin-left:15px;"><span>скидка</span></div>
								  <?php
								  }
								  else if ($row["is_new"] == 1)
								  {
								  ?>
									<div class="ribbon_green" style="margin-left:15px;"><span>новинка</span></div>
								  <?php
								  }
								  
								  // show price - 0 - the product is out of stock...
								  if ($row["show_price"] == 0)
								  {
								  ?>
									<div class="ribbon_blue" style="margin-left:15px;"><span>продано</span></div>
								  <?php
								  }						  
								  ?>
                            </div>
                        </div>
						
						
												
                        <div class="col-sm-6">
						
						<div class="hidden-lg hidden-md">&nbsp;</div>
						
                            <div class="box_item" style="padding:10px; background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;">
                                <h3 class="text-center"><?php echo $row["title"]; ?></h3>								
                                <p class="price">
									<?php 
										if ($row["show_price"]==1) 
										{ 
											if ($_SESSION['sign_place'] == 'r')
											{												
												echo money_format('%i', ceil($row["price"]/$_SESSION['rate']) ).$_SESSION['the_curr_sign']; 
											}
											else
											{
												echo $_SESSION['the_curr_sign'].money_format('%i', ceil($row["price"]/$_SESSION['rate']) ); 
											}											
										} 
									?>
								</p>	
								
									<?php
										//
										// in case no price - no placement to card, only quick order
										//
										
										if ($row["show_price"]==1) 
										{
									?>
									<div class="row" style="text-align:center; margin-left:auto; margin-right:auto">
										<div class="col-sm-6 col-md-6" style="margin-left:auto; margin-right:auto">
										<form action="item.php?i=<?php echo $i; ?>#do_the_order" method="post"><div class="text-center" style="margin-left:auto; margin-right:auto; margin-top:20px; margin-bottom:20px"><button type="submit" class="btn btn-success">Быстрый Заказ</button></div></form>
										</div>
										<div class="col-sm-6 col-md-6"  style="margin-left:auto; margin-right:auto">
										<form action="javascript:void(0);" method="post" onsubmit="return addItemToCard(<?php echo $i; ?>);"><div class="text-center" style="margin-left:auto; margin-right:auto; margin-top:20px; margin-bottom:20px"><button type="submit" class="btn btn-success">В Корзину <span class="glyphicon glyphicon-shopping-cart"></span></button></div></form>
										</div>									
									</div>							 
									<?php
										}
										else
										{
											if ($row["show_price"] == 0)
											{										
									?>
									
											<div class="row" style="text-align:center; margin-left:auto; margin-right:auto">
												<div class="col-sm-12 col-md-12" style="margin-left:auto; margin-right:auto">
												<form action="item.php?i=<?php echo $i; ?>#do_the_order" method="post"><div class="text-center" style="margin-left:auto; margin-right:auto; margin-top:20px; margin-bottom:20px"><button type="submit" class="btn btn-success">Оставить Заявку</button></div></form>
												</div>									
											</div>										
									
									<?php
											}
											else
											{
									?>
									
												<div class="row" style="text-align:center; margin-left:auto; margin-right:auto">
													<div class="col-sm-12 col-md-12" style="margin-left:auto; margin-right:auto">
													<form action="item.php?i=<?php echo $i; ?>#do_the_order" method="post"><div class="text-center" style="margin-left:auto; margin-right:auto; margin-top:20px; margin-bottom:20px"><button type="submit" class="btn btn-success">Быстрый Заказ</button></div></form>
													</div>									
												</div>									
									
									<?php
											}
									
										}
									?>
									
                            </div>

							<div class="row" >
									<div class="col-xs-4">
										<a href="#" onClick="qlik_img(1); return false;">
											<img src="<?php echo $row["photo1"]; ?>" alt="<?php echo $row["title"]; ?>" class="img-responsive" width="115" height="115" style="padding:10px; background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;">
										</a>
									</div>
									<div class="col-xs-4">										
										<?php
											if ($row["photo2"])
											{
										?>
												<a href="#" onClick="qlik_img(2); return false;">
													<img src="<?php echo $row["photo2"]; ?>" alt="<?php echo $row["title"]; ?>" class="img-responsive" width="115" height="115" style="padding:10px; background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;">
												</a>
										<?php		
											}
											else
											{
										?>
												<a href="#" onClick="qlik_img(1); return false;">
													<img src="<?php echo $row["photo1"]; ?>" alt="<?php echo $row["title"]; ?>" class="img-responsive" width="115" height="115" style="padding:10px; background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;">
												</a>
										<?php
											}
										?>										 
									</div>
									<div class="col-xs-4">										
										<?php
											if ($row["photo3"])
											{
										?>		
												<a href="#" onClick="qlik_img(3); return false;">
													<img src="<?php echo $row["photo3"]; ?>" alt="<?php echo $row["title"]; ?>" class="img-responsive" width="115" height="115" style="padding:10px; background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;">
												</a>
										<?php		
											}
											else
											{
										?>
												<a href="#" onClick="qlik_img(1); return false;">
													<img src="<?php echo $row["photo1"]; ?>" alt="<?php echo $row["title"]; ?>" class="img-responsive" width="115" height="115" style="padding:10px; background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;">
												</a>
										<?php
											}
										?>																					
									</div>
							 </div>

						  </div>
						 
                    </div>
					
					<div class="box_item" id="details" style="padding:30px; background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;">
                       
                            <h4>Описание</h4>
                            <p><?php echo $row["long_desc"]; ?></p>

							<br/>
							<h4>Характеристики</h4>
							  <table class="table table-striped">
								<tbody>
								  <tr>
									<td>Артикул</td>
									<td><?php echo $row["makat"]; ?></td>									
								  </tr>
								  <tr>
									<td>Металл</td>
									<td><?php echo $row_get_the_metall["name"]; ?></td>									
								  </tr>
								  <tr>
									<td>Камни</td>
									<td><?php echo $row_get_the_stones["names"]; ?></td>									
								  </tr>
								  <tr>
									<td>Цвета</td>
									<td><?php echo $row_get_the_colors["the_colors"]; ?></td>									
								  </tr>								  								  
								  <tr>
									<td>Размеры</td>
									<td><?php echo $row_get_the_sizes["the_sizes"]; ?></td>									
								  </tr>	
								  <tr>
									<td>Количество</td>
									<td><?php echo $row["quantity"]; ?></td>									
								  </tr>								  
								</tbody>
							  </table>
						 						
							<?php
							if ($row["remark"] != "")
							{
							?>
                            <blockquote>
                                <p><em><?php echo $row["remark"]; ?></em>
                                </p>
                            </blockquote>							
							<hr>
							<?php
							}					
							?>
                         

						<?php
						// generate twitter message
						
							$myArr = array();
							$myArr[]="украшения";
							$myArr[]="ювелирные";
							$myArr[]="камни";
							$myArr[]="серебро";
							$myArr[]="Нацрат";
							$myArr[]="Илит";
							$myArr[]="мерказ";
							$myArr[]="раско";
							$myArr[]="подарки";
							$myArr[]="сувениры";
							$myArr[]="Афула";
							$myArr[]="Израиль";
							$myArr[]="север";
							$myArr[]="центр";
							$myArr[]="ok.ru/crystalsky";
							$myArr[]="туризм";
							$myArr[]="интернет-магазин";
							$myArr[]="изысканный";
							$myArr[]="стиль";
							$myArr[]="красота";
							$myArr[]="дамы";
							$myArr[]="молодые";
							$myArr[]="сексуальный";
							$myArr[]="элегантный";
							$myArr[]="богема";
							$myArr[]="гламур";
							$myArr[]="ашдод";
							$myArr[]="ашкелон";
							$myArr[]="нетания";
							$myArr[]="герцлия";
							$myArr[]="иерусалим";
							
							$pieces_names = explode(",",$row_get_the_stones["names"]);
							
							for($idx=0; $idx<count($pieces_names); $idx++)
							{
								if (strlen($pieces_names[$idx])>4)
								{
									$myArr[]=trim($pieces_names[$idx]);
								}
							}
							
							$pieces_names2 = $row_get_the_colors["the_colors"];
							
							for($idx=0; $idx<count($pieces_names2); $idx++)
							{
								if (strlen($pieces_names2[$idx])>4)
								{
									$myArr[]=trim($pieces_names2[$idx]);
								}
							}
							
							$pieces_names3 = $row_get_the_metall["name"];	

							for($idx=0; $idx<count($pieces_names3); $idx++)
							{
								if (strlen($pieces_names3[$idx])>4)
								{
									$myArr[]=trim($pieces_names3[$idx]);
								}
							}							
							
							$rand_keys = array_rand($myArr, 8);
							
							$end_part_of_message = $myArr[$rand_keys[0]].",".$myArr[$rand_keys[1]].",".$myArr[$rand_keys[2]].",".$myArr[$rand_keys[3]].",".
													$myArr[$rand_keys[4]].",".$myArr[$rand_keys[5]].",".$myArr[$rand_keys[6]].",".$myArr[$rand_keys[7]];
													
							$proposed_string = $row["title"]." - магазин Crystal Sky - украшения из серебра, позолота, камни&url=http://www.crystalsky.co.il/item.php?i=".$i."&hashtags=".$end_part_of_message;							
							if (strlen($proposed_string) > 138)
							{
								$end_part_of_message = substr($end_part_of_message, 0, strrpos( $end_part_of_message, ',') );
							}

							$proposed_string = $row["title"]." - магазин Crystal Sky - украшения из серебра, позолота, камни&url=http://www.crystalsky.co.il/item.php?i=".$i."&hashtags=".$end_part_of_message;
							if (strlen($proposed_string) > 138)
							{
								$end_part_of_message = substr($end_part_of_message, 0, strrpos( $end_part_of_message, ',') );
							}							
						
							$proposed_string = $row["title"]." - магазин Crystal Sky - украшения из серебра, позолота, камни&url=http://www.crystalsky.co.il/item.php?i=".$i."&hashtags=".$end_part_of_message;
							if (strlen($proposed_string) > 138)
							{
								$end_part_of_message = substr($end_part_of_message, 0, strrpos( $end_part_of_message, ',') );
							}	
							
							$proposed_string = $row["title"]." - магазин Crystal Sky - украшения из серебра, позолота, камни&url=http://www.crystalsky.co.il/item.php?i=".$i."&hashtags=".$end_part_of_message;
							if (strlen($proposed_string) > 138)
							{
								$end_part_of_message = substr($end_part_of_message, 0, strrpos( $end_part_of_message, ',') );
							}	

							$proposed_string = $row["title"]." - магазин Crystal Sky - украшения из серебра, позолота, камни&url=http://www.crystalsky.co.il/item.php?i=".$i."&hashtags=".$end_part_of_message;
							if (strlen($proposed_string) > 138)
							{
								$end_part_of_message = substr($end_part_of_message, 0, strrpos( $end_part_of_message, ',') );
							}								
							
						?>
						 
                            <div class="social">
                                <h4>Поделиться с Другом</h4>								
								
								<?php
								
								$ok_link_share ='https://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st.comments=магазин Crystal Sky - серебряные украшения, натуральные камни, позолота. Самые изысканные украшения для Вас! Богатые стилистические решения – от классики до авангарда. Наш адрес: город Нацерет-Илит, Мерказ Раско, улица Ацмон 18. Приглашаем Вас за покупками!&st._surl=http://www.crystalsky.co.il/item.php?i='.$i;
								
								$encoded_url = urlencode("http://www.crystalsky.co.il/item.php?i=".$i);
								
								$encoded_picture = "http://www.crystalsky.co.il/".$row["photo1"];
								
								$the_title =  $row["title"]." - магазин Crystal Sky - серебряные украшения, натуральные камни, позолота";
								
								
								$n_elements_in_arr_templates_to_share_on_facebook = count($arr_templates_to_share_on_facebook);
																								
								if ($n_elements_in_arr_templates_to_share_on_facebook == 0)
								{
										$the_quote = "Украшения магазина Crystal Sky - город Тверия, ул. Апрахим 18 (Шук Ирони) и город Нацерет-Илит, ул. Ацмон 18 (Мерказ Раско) - отличаются утонченным и изысканным внешним видом. Они прекрасно дополнят как вечерний наряд, так и повседневные джинсы и футболку. Серебряные сережки, цепочки, кольца, подвески и браслеты могут стать прекрасным подарком. В ассортименте магазина Crystal Sky большой выбор украшений из серебра на любой вкус! Приглашаем Вас за покупками в магазин Crystal Sky!";
								}
								else
								{									
										$the_random_element_idx = rand(0, $n_elements_in_arr_templates_to_share_on_facebook);
										$the_quote = $arr_templates_to_share_on_facebook[$the_random_element_idx]['template_txt'];
								}
								
								$the_description = $row["title"]." - ".$row["short_desc"]." - Cеребряные украшения, натуральные камни, позолота. Самые изысканные украшения для Вас! город Тверия, улица АПрахим 18, Шук Ирони и город Нацерет-Илит, улица Ацмон 18, Мерказ Раско. Сайт Магазина Crystal Sky: www.crystalsky.co.il";
								
								?>
								
								<div id="tell_a_friend">
								<p class="social">
									<a href="<? echo $ok_link_share; ?>" target='_blank' class="odnoklassniki external" data-animate-hover="shake"><i class="fa fa-odnoklassniki"></i></a>
									
									<?php
									/* 
										This version worked not reliable, so I replaced it by parameterized version
										<a href="https://www.facebook.com/sharer/sharer.php?u=<? echo $encoded_url; ?>" target='_blank' class="facebook external" data-animate-hover="shake" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-facebook"></i></a> 
									*/
									?>
									
									<a href="https://www.facebook.com/sharer/sharer.php?u=<? echo $encoded_url; ?>&picture=<? echo $encoded_picture; ?>&title=<? echo $the_title; ?>&quote=<? echo $the_quote; ?>&description=<? echo $the_description; ?>" target='_blank' class="facebook external" data-animate-hover="shake" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-facebook"></i></a>
									
									<a href="http://twitter.com/share?text=<?php echo $row["title"]; ?> - магазин Crystal Sky - украшения из серебра, позолота, камни&url=http://www.crystalsky.co.il/item.php?i=<?php echo $i; ?>&hashtags=<?php echo $end_part_of_message; ?>" target='_blank' class="twitter external" data-animate-hover="shake"><i class="fa fa-twitter"></i></a>
									
									<a href="https://www.instagram.com/crystal_sky_jewelry/" target='_blank' class="instagram external" data-animate-hover="shake"><i class="fa fa-instagram"></i></a>
									<a href="#" class="gplus external" data-animate-hover="shake"><i class="fa fa-google-plus"></i></a>
									<a href="mailto: info@crystalsky.co.il?Subject=contact from website CrystalSky.co.il" class="email external" data-animate-hover="shake"><i class="fa fa-envelope"></i></a>							
							   </p>
							   </div>
							  
                            </div>
                    </div>	

					
					<div class="box_item" id="details" style="padding:30px; background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;">
							
						<h4>Порекомендуйте нас всем своим друзьям и знакомым!</h4>
						<br/>
						   
						  <div class="caption likes">
							<?php
							if ($is_to_show_product_views == '1')
							{
							?>
								<p><i class="fa fa-eye" style="margin-left:7px;"></i> <span id='nOfViews'><?php echo $row["nviews"]; ?></span> | <a href="#" onclick="return false;">Просмотров изделия "<?php echo $row["title"]; ?>"</a></p>
							<?
							}
							?>
								<p><i class="fa fa-thumbs-up" style="margin-left:7px;"></i> <span id='nOfLikes'><?php echo $row["likes"]; ?></span> | <a href="#" onClick="doLike(<?php echo $row["id"]; ?>,'<?php echo $row["title"]; ?>'); return false;">Вам нравится "<?php echo $row["title"]; ?>"? Ставьте Лайк!</a></p>								
								<p><i class="fa fa-odnoklassniki" style="margin-left:7px;"></i> | <a href="http://ok.ru/crystalsky" target="_blank">Приглашаем Вас в клуб магазина "Crystal Sky" в "Одноклассниках"! Присоединяйтесь!</a></p>
								<p><i class="fa fa-facebook" style="margin-left:7px;"></i> | <a href="http://facebook.com/crystalsky.jewelry" target="_blank">Приглашаем Вас в клуб магазина "Crystal Sky" в "Фейсбуке"! Присоединяйтесь!</a></p>
								<p><i class="fa fa-youtube" style="margin-left:7px;"></i> | <a href="https://www.youtube.com/channel/UCeiNKvNYTd4sTA-h3VlyrBg" target="_blank">Приглашаем Вас на видеоканал магазина "Crystal Sky" на "YouTube"! Присоединяйтесь!</a></p>
								<p><i class="fa fa-twitter" style="margin-left:7px;"></i> | <a href="https://twitter.com/CrystalSky925" target="_blank">Приглашаем Вас в клуб магазина "Crystal Sky" в "Твиттере"! Присоединяйтесь!</a></p>
						  </div>
						  
					</div>
					
					<?php
					
						$n_elements_arr_we_recommend = count($arr_we_recommend);
						
						$n_elements_recommend_to_show = $n_items_recommended_to_show; // should be divided by 4
						
						$arr_elements_recommend_to_show = array();	
						
						for($idr=0; $idr<$n_elements_recommend_to_show; $idr++)
						{
							$orig_element_rnd =rand(0, $n_elements_arr_we_recommend);
							$arr_elements_recommend_to_show[$idr]['title'] = $arr_we_recommend[$orig_element_rnd]['title'];
							$arr_elements_recommend_to_show[$idr]['photo1'] = $arr_we_recommend[$orig_element_rnd]['photo1'];
							$arr_elements_recommend_to_show[$idr]['id'] = $arr_we_recommend[$orig_element_rnd]['id'];
						}
					
					?>
					
					<div class="box_item" id="we_recommend" style="padding:30px; background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;">
							
						<h4>Мы рекомендуем</h4>
		 				<br/>
						
						<div class="row">
							<?php
							for($idr=0; $idr<$n_elements_recommend_to_show; $idr++)
							{
							?>
							<div class="col-md-3">
								<center><a href="https://crystalsky.co.il/item.php?i=<?php echo $arr_elements_recommend_to_show[$idr]['id']; ?>" target='_blank'><img src="<?php echo $arr_elements_recommend_to_show[$idr]['photo1']; ?>" alt="<?php echo $arr_elements_recommend_to_show[$idr]['title']; ?>" class="img-responsive" style="padding:10px; background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;"></a></center>
								<br/>
								<center><a href="https://crystalsky.co.il/item.php?i=<?php echo $arr_elements_recommend_to_show[$idr]['id']; ?>" target='_blank'><?php echo $arr_elements_recommend_to_show[$idr]['title']; ?></a></center>
								<br/>
							</div>							
							<?php
							}
							?>					
						</div>						

					</div>					

					<div id="do_the_order" class="panel panel-default" style="padding:30px; background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;">
				 
					<div class="panel-body">
					
					<!--- start form -->
	
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
								<?php
									if ($row["show_price"] == 0)
									{
								?>
								
										<div class="text-center"><button type="submit" class="btn btn-success" onclick="ajax_post(); return false;">Оставить Заявку</button></div>
									
								<?php
									}
									else
									{
								?>
								
										<div class="text-center"><button type="submit" class="btn btn-success" onclick="ajax_post(); return false;">Заказать</button></div>
								
								<?php
									}
								?>
								</div>							
														
							</div> <!-- row -->
						
						</form>	
						
						
						<?php 
													
						/*
						$sql_get_recent_order_details = "select * from orders where id = '$the_order_id'";
								
						$arr_order_details = array();		
						$results_order_details = mysqli_query($conn, $sql_get_recent_order_details); 	
						
						while($line = mysqli_fetch_assoc($results_order_details)){
							$arr_order_details[] = $line;
						} 
						*/
						
						if ($row["show_price"]==1)
						{
						
						?>
						
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
									<input type="hidden" name="item_number_1" id="pp_item_number_1" value="">
									<input type="hidden" name="item_name_1" id="pp_item_name_1" value="">									
									<input type="hidden" name="quantity_1" id="pp_quantity_1" value="">
									<input type="hidden" name="amount_1" id="pp_amount_1" value="">	

									<input type="hidden" name="shipping_1" id="pp_shipping_1" value="">											

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
						
						<?
						}
						else
						{
						?>
							<div class="jumbotron" id='txtreply' style='display:none'>
								<h2 style='text-align:center'>Спасибо за Ваш заказ!</h2>
								<p style='text-align:center'>Наш менеджер свяжется с Вами в ближайшее время!</p>
								<p style='text-align:center'><a class="btn btn-primary btn-lg" href="#" onclick="reload_page();" role="button">Ок</a></p>
							</div>												
						<?
						}
						?>
																					
						<!-- address panel -->
						
					<!--  end form -->									

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
                            <a href="mailto: info@crystalsky.co.il?Subject=contact from website CrystalSky.co.il" class="email external" data-animate-hover="shake"><i class="fa fa-envelope"></i></a>							
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
			
	<a href="#" class="scrollup"></a>		
	
	<!-- End Footer -->		
	

	<!--- start modal window -->
	
	<div id="myModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Изделие добавлено в корзину!</h4>
				</div>
				<div class="modal-body">
					<p>Изделие "<?php echo $row["title"]; ?>" успешно добавлено в корзину!</p>
					<p class="text-warning"><small>Вы можете оформить заказ, нажав на изображение корзины <a href='basket.php'><span class="glyphicon glyphicon-shopping-cart"></span></a> или продолжить покупки. Спасибо Вам за то, что являетесь клиентом магазина "Crystal Sky"! Магазин "Crystal Sky" - серебряные украшения, натуральные камни, позолота. Самые изысканные изделия для Вас! Добро пожаловать в магазин ювелирных украшений "Crystal Sky" - город Нацерет-Илит, ул. Ацмон 18, мерказ Раско!</small></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Ок</button>					
				</div>
			</div>
		</div>
	</div>	
	
	<div id="myModal2" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Изделие не добавлено в корзину!</h4>
				</div>
				<div class="modal-body">
					<p>Изделие "<?php echo $row["title"]; ?>" не добавлено в корзину покупок.</p>
					<p class="text-warning"><small>Корзина покупок имеет ограничение на максимальное количество товаров, которое может быть помещено. Не расстраивайтесь! Пожалуйста, свяжитесь с нами через контактную форму на сайте. Наши менеджеры помогут Вам оформить заказ. Спасибо Вам за то, что являетесь клиентом магазина "Crystal Sky"! Магазин "Crystal Sky" - серебряные украшения, натуральные камни, позолота. Самые изысканные изделия для Вас! Добро пожаловать в магазин ювелирных украшений "Crystal Sky" - город Нацерет-Илит, ул. Ацмон 18, мерказ Раско!</small></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Ок</button>					
				</div>
			</div>
		</div>
	</div>		
	
	<!--- end modal window -->
	
	<?php
	// close db connection
	$conn->close();	
	
	require_once('trace_login_businesslog.php');
	?>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
	
	
	<script>
	
		$('.dropdown-menu a').on('click', function(){    
			$(this).parent().parent().prev().html($(this).html() + '<span class="caret"></span>');    
		})

	</script>	
	
<!-- image presenter -->

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

<!-- image presenter -->	

<div class="modal fade" tabindex="-1" role="dialog" id="myDoLike" name="myDoLike">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Поставить Лайк</h4>
      </div>
      <div class="modal-body" style="margin-left:20px; margin-right:20px; text-align:center">       
		Вам нравится изделие: "<span id="theItemName"></span>", и Вы ставите Лайк! Приглашаем Вас за покупками в наш магазин "Crystal Sky"! Порекомендуйте нас всем своим друзьям и знакомым! Спасибо! 
		
				<br/>
				<br/>
				<form data-toggle="validator" role="form" id="LikeForm">
					<div class="row" id="contact_status">
						<div class="col-sm-6">
							<div id="inp_like_first_name" class="form-group">
								<label for="like_firstname">Ваше Имя</label>
								<input type="text" class="form-control" name="like_firstname" id="like_firstname">
							</div>
						</div>                               
						<div class="col-sm-6">
							<div id="inp_like_email" class="form-group">
								<label for="like_email">Ваш Емайл</label>
								<input type="text" class="form-control" name="like_email" id="like_email">
							</div>
						</div> 
						<div class="col-sm-6">
							<div id="inp_like_city" class="form-group">
								<label for="like_city">Ваш Город</label>
								<input type="text" class="form-control" name="like_city" id="like_city">
							</div>
						</div>                               
						<div class="col-sm-6">
							<div id="inp_like_phone" class="form-group">
								<label for="like_phone">Ваш Телефон</label>
								<input type="text" class="form-control" name="like_phone" id="like_phone">
							</div>
						</div> 						
					</div>
					<input type="hidden" name="like_product_id" id="like_product_id">
					<input type="hidden" name="like_product_name" id="like_product_name">
					<!-- /.row -->													
				</form>	
				
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="ILikeIt(); return false;">Ok</button>        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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