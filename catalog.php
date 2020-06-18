<?php session_start(); ?>
<!DOCTYPE html>
<?php
	
	// max_items_per_page 
	$max_items_per_page = 21;
	
	// page number
	//
	if (!$_GET["p"]) 
	{
		$p = 1;
	}
	else
	{				
		$p = $_GET['p'];
					
		if (($p == "1") || ($p == "2") || ($p == "3") || ($p == "4") || ($p == "5") || ($p == "6") || ($p == "7") || ($p == "8") || ($p == "9")
			|| ($p == "10") || ($p == "11") || ($p == "12") || ($p == "13") || ($p == "14") || ($p == "15") || ($p == "16") || ($p == "17")
			|| ($p == "18") || ($p == "19") || ($p == "20"))
		{							 
			// Ok			 
		}
		else
		{				
			$p = 1;
		}
	}		

	if (isset($_POST['sort-by-1']))
	{
		$_SESSION['sort-by-1'] = $_POST['sort-by-1'];
	}
	else
	{
		if (isset($_SESSION['sort-by-1']))
		{
			$_POST['sort-by-1'] = $_SESSION['sort-by-1'];
		}
		else
		{
			// nothing to do
		}
	}
	
	if (isset($_POST['sort-by-2']))
	{
		$_SESSION['sort-by-2'] = $_POST['sort-by-2'];
	}
	else
	{
		if (isset($_SESSION['sort-by-2']))
		{
			$_POST['sort-by-2'] = $_SESSION['sort-by-2'];
		}
		else
		{
			// nothing to do
		}
	}
	
	if (isset($_POST['Sizes']))
	{
		$_SESSION['Sizes'] = $_POST['Sizes'];
	}
	else
	{
		if (isset($_SESSION['Sizes']))
		{
			$_POST['Sizes'] = $_SESSION['Sizes'];
		}
		else
		{
			// nothing to do
		}
	}
	
	if (isset($_POST['Stones']))
	{
		$_SESSION['Stones'] = $_POST['Stones'];
	}
	else
	{
		if (isset($_SESSION['Stones']))
		{
			$_POST['Stones'] = $_SESSION['Stones'];
		}
		else
		{
			// nothing to do
		}
	}

	if (isset($_POST['Colors']))
	{
		$_SESSION['Colors'] = $_POST['Colors'];
	}
	else
	{
		if (isset($_SESSION['Colors']))
		{
			$_POST['Colors'] = $_SESSION['Colors'];
		}
		else
		{
			// nothing to do
		}
	}


	if (isset($_POST['Metalls']))
	{
		$_SESSION['Metalls'] = $_POST['Metalls'];
	}
	else
	{
		if (isset($_SESSION['Metalls']))
		{
			$_POST['Metalls'] = $_SESSION['Metalls'];
		}
		else
		{
			// nothing to do
		}
	}		
	
?>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>магазин "Crystal Sky" - каталог ювелирных изделий</title>

    <meta name="keywords" content="приглашаем, покупки, подарки, стиль, образ, Crystal, Sky, Нацерет-Илит, Израиль, Раско, ювелирные, серебро, 925, позолота, камни, выбор, рубин, топаз, сапфир, аметист" />
	<meta name="description" content="Каталог ювелирных изделий магазина Crystal Sky! Серебро 925, камни, ювелирные украшения, подарки, сувениры, туризм. Адрес: Нацерет-Илит, Мерказ Раско, Ацмон 18, Израиль / Тверия, Шук Ирони, Апрахим 18" />
		
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
	
	</style>	
	
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
	
	  <script>
	  
			// all thumbnails the same size
			
			 $(document).ready(function() {

					var maxHeight = 0;          
					$(".equalize").each(function(){
					  if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
					});         
					$(".equalize").height(maxHeight);	
				
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
							return;					
						} else {
						  alert("Error: " + oReq.status);
						}
					  };
					oReq.send(oData); 

				}			
			}    		  
		  
		  
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
			  
				function validateEmail(email) {
					var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
					return re.test(email);
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
			  
			 function UnSetSizes()
			 {
				var the_sizes = document.forms['frmSizes']['Sizes[]'];
				
				for (var i = 0; i < the_sizes.length; i++) 
				{
					the_sizes[i].checked = false;
				}
				
				var url = "unset_sizes.php";
			
				var oData = new FormData(document.forms.namedItem("frmSizes"));
				
				var oReq = new XMLHttpRequest();
				  oReq.open("POST", url, true);
				  oReq.onload = function(oEvent) {
				  
					if (oReq.status == 200) 
					{			
						return;					
					} else {
					  alert("Error: " + oReq.status);
					}
				  };
				oReq.send(oData); 					
								
			 }
			 
			 function SizesChanged()
			 {
			 
				var the_sizes = document.forms['frmSizes']['Sizes[]'];
				
				var nFlag = 0;
				for (var i = 0; i < the_sizes.length; i++) 
				{
					if (the_sizes[i].checked == true)
						nFlag++;
				}
				
				if (nFlag == 0)
				{
				
					var url = "unset_sizes.php";
				
					var oData = new FormData(document.forms.namedItem("frmSizes"));
					
					var oReq = new XMLHttpRequest();
					  oReq.open("POST", url, true);
					  oReq.onload = function(oEvent) {
					  
						if (oReq.status == 200) 
						{			
							return;					
						} else {
						  alert("Error: " + oReq.status);
						}
					  };
					oReq.send(oData); 

				}
											 
			 }			 			 
			 
			 function UnSetStones()
			 {
				var the_stones = document.forms['frmStones']['Stones[]'];
				
				for (var i = 0; i < the_stones.length; i++) 
				{
					the_stones[i].checked = false;
				}		

				var url = "unset_stones.php";
			
				var oData = new FormData(document.forms.namedItem("frmStones"));
				
				var oReq = new XMLHttpRequest();
				  oReq.open("POST", url, true);
				  oReq.onload = function(oEvent) {
				  
					if (oReq.status == 200) 
					{			
						return;					
					} else {
					  alert("Error: " + oReq.status);
					}
				  };
				oReq.send(oData); 
				
			 }
			 
			 function StonesChanged()
			 {
			 
				var the_stones = document.forms['frmStones']['Stones[]'];
				
				var nFlag = 0;
				for (var i = 0; i < the_stones.length; i++) 
				{
					if (the_stones[i].checked == true)
						nFlag++;
				}
				
				if (nFlag == 0)
				{
				
					var url = "unset_stones.php";
				
					var oData = new FormData(document.forms.namedItem("frmStones"));
					
					var oReq = new XMLHttpRequest();
					  oReq.open("POST", url, true);
					  oReq.onload = function(oEvent) {
					  
						if (oReq.status == 200) 
						{			
							return;					
						} else {
						  alert("Error: " + oReq.status);
						}
					  };
					oReq.send(oData); 

				}
											 
			 }			 
			 
			 function UnSetColors()
			 {
				var the_colors = document.forms['frmColors']['Colors[]'];
				
				for (var i = 0; i < the_colors.length; i++) 
				{
					the_colors[i].checked = false;
				}	
				
				var url = "unset_colors.php";
			
				var oData = new FormData(document.forms.namedItem("frmColors"));
				
				var oReq = new XMLHttpRequest();
				  oReq.open("POST", url, true);
				  oReq.onload = function(oEvent) {
				  
					if (oReq.status == 200) 
					{			
						return;					
					} else {
					  alert("Error: " + oReq.status);
					}
				  };
				oReq.send(oData);				
				
			 }	

			 function ColorsChanged()
			 {
			 
				var the_colors = document.forms['frmColors']['Colors[]'];
				
				var nFlag = 0;
				for (var i = 0; i < the_colors.length; i++) 
				{
					if (the_colors[i].checked == true)
						nFlag++;
				}
				
				if (nFlag == 0)
				{
				
					var url = "unset_colors.php";
				
					var oData = new FormData(document.forms.namedItem("frmColors"));
					
					var oReq = new XMLHttpRequest();
					  oReq.open("POST", url, true);
					  oReq.onload = function(oEvent) {
					  
						if (oReq.status == 200) 
						{			
							return;					
						} else {
						  alert("Error: " + oReq.status);
						}
					  };
					oReq.send(oData); 
				}
											 
			 }				 
	  
			 function UnSetMetalls()
			 {
				var the_metalls = document.forms['frmMetalls']['Metalls[]'];
				
				for (var i = 0; i < the_metalls.length; i++) 
				{
					the_metalls[i].checked = false;
				}	
				
				var url = "unset_metalls.php";
			
				var oData = new FormData(document.forms.namedItem("frmMetalls"));
				
				var oReq = new XMLHttpRequest();
				  oReq.open("POST", url, true);
				  oReq.onload = function(oEvent) {
				  
					if (oReq.status == 200) 
					{			
						return;					
					} else {
					  alert("Error: " + oReq.status);
					}
				  };
				oReq.send(oData);								
			 }	

			 function MetallsChanged()
			 {			 
				var the_metalls = document.forms['frmMetalls']['Metalls[]'];
				
				var nFlag = 0;
				for (var i = 0; i < the_metalls.length; i++) 
				{
					if (the_metalls[i].checked == true)
						nFlag++;
				}
				
				if (nFlag == 0)
				{
				
					var url = "unset_metalls.php";
				
					var oData = new FormData(document.forms.namedItem("frmMetalls"));
					
					var oReq = new XMLHttpRequest();
					  oReq.open("POST", url, true);
					  oReq.onload = function(oEvent) {
					  
						if (oReq.status == 200) 
						{			
							return;					
						} else {
						  alert("Error: " + oReq.status);
						}
					  };
					oReq.send(oData); 
				}
											 
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
						window.location.reload(true);
					}
				}
				http.send(params);		 
				 
			}			 
	  
	  </script>
	  
  </head>
  <body>
  <!-- start google analytics -->
  <?php include_once("analyticstracking.php") ?>
  <!-- end google analytics --> 
  
  
  <?php
  
	// conn db parameters
	require_once('db_connect.php');
  			
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$conn->query("set names 'utf8'");			
				    
	// start calculate num items in the basket
	$n_items_in_the_basket = 0;

	if(!isset($_SESSION['cart_items'])){
		$n_items_in_the_basket = 0;
	}				
	else
	{
		$n_items_in_the_basket = count($_SESSION['cart_items']);			
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
	
	$nFlag =0;
	
	for($idx=0; $idx<sizeof($arr_cat_subcat); $idx++)
	{	
		if (($_GET['r'] == $arr_cat_subcat[$idx]["id"]) || ($_GET['r'] == $arr_cat_subcat[$idx]["main"])) $nFlag++;
	}
	
  if ($_GET['r'])
  {	 
	  $rr = $_GET['r'];
	  
	  if ( $nFlag > 0)
	  {
			// Ok
	  }
	  else
	  {
		  $rr = '';
		  $_GET['r'] = '';
	  }
  }		
  
	$sql_is_to_show_product_views = "select * from app_properties where prop_name='is_to_show_product_views' ";
								
	$arr_is_to_show_product_views = array();		
	$results_is_to_show_product_views = mysqli_query($conn, $sql_is_to_show_product_views); 	
	
	while($line = mysqli_fetch_assoc($results_is_to_show_product_views)){
		$arr_is_to_show_product_views[] = $line;
	}		
	
	$is_to_show_product_views = $arr_is_to_show_product_views[0]['prop_value'];		

  
  ?>
 
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
									<li class="dropdown active">
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
									<button type="submit" class="btn btn-default" style="border-radius:15px"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;<span class="badge"><?php echo $n_items_in_the_basket; ?></span></button>
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
	
	<!--- end slider ---->
	
	<div id="come_here"></div>
	
	<div class="clearfix" style="margin-bottom:30px;"></div>
	
	<div id="content"> 		<!-- start content -->
	<div class="container"> <!-- start container -->
	    
		<!-- breadcrumb with navigation details -->
		<div class="col-md-12" >
			<ul class="breadcrumb" style="background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;">
				<li><a href="index.php">Главная</a>
				</li>
				<li><a href="catalog.php">Каталог</a></li>
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
						
							<li <?php if ( $_GET['r'] == $arr_cat_subcat[$idx]["main"] ) {  echo "class=\"active\""; } ?> ><a href="catalog.php?r=<?php echo $arr_cat_subcat[$idx]["main"]; ?>"><strong><?php echo $arr_cat_subcat[$idx]["mc_name"]; ?></strong></a></li>
						
						<?php
								$main_cat_prev = $arr_cat_subcat[$idx]["mc_name"];
							}
						?>
																					
							<li <?php if ( $_GET['r'] == $arr_cat_subcat[$idx]["id"] ) {  echo "class=\"active\""; } ?> style="margin-left:10px;"><a href="catalog.php?r=<?php echo $arr_cat_subcat[$idx]["id"]; ?>"> <?php echo $arr_cat_subcat[$idx]["sc_name"]; ?> (<?php echo $arr_cat_subcat[$idx]["qty"]; ?>)</a></li>							
						
						<?php
						} // for idx					
						?>						
												
					</ul>
					</div>				
			</div>
			
			<div class="panel panel-default sidebar-menu" style="padding:10px; background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;">

				<div class="panel-heading" style="border-radius:15px; margin-bottom:-15px;">
					<h3 class="panel-title">Материал <a class="btn btn-xs btn-danger pull-right" href="#" onClick="UnSetMetalls(); return false;" ><i class="fa fa-times-circle"></i></a></h3>
				</div>

				<div class="panel-body" style="margin-bottom:-13px;">

					<form action="catalog.php?r=<?php echo $rr; ?>" id="frmMetalls" name="frmMetalls" method="POST">
						<div class="form-group" style="margin-bottom:-2px;" >
			
						<?php
						
							$sql = "select id, name from metall order by ord";
							
							$result = $conn->query($sql);

							if ($result->num_rows > 0) 
							{			
								while($row = $result->fetch_assoc()) 
								{					
						
						?>
						
							<div class="checkbox">
								<label>
									<input type="checkbox"  name="Metalls[]"  onChange='MetallsChanged();' value="<?php echo $row["id"]; ?>" <?php if(isset($_POST['Metalls']) && is_array($_POST['Metalls']) && in_array($row["id"], $_POST['Metalls'])) echo 'checked="checked"'; ?> > <span class="colour"></span> <?php echo $row["name"]; ?>
								</label>
							</div>							
						
						<?php
						
								}
							}
						
						?>
							
						</div>

						<button class="btn btn-default btn-sm btn-primary"><i class="fa fa-pencil"></i>Применить</button>

					</form>

				</div>
			</div>	

			<div class="panel panel-default sidebar-menu" style="padding:10px; background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;">

				<div class="panel-heading" style="border-radius:15px; margin-bottom:-15px;">
					<h3 class="panel-title">Цвет <a class="btn btn-xs btn-danger pull-right" href="#" onClick="UnSetColors(); return false;"><i class="fa fa-times-circle"></i></a></h3>
				</div>

				<div class="panel-body" style="margin-bottom:-13px;">

					<form action="catalog.php?r=<?php echo $rr; ?>" name="frmColors" id="frmColors" method="POST">
						<div class="form-group" style="margin-bottom:-2px;" >
						
						
						<?php
						
							$sql = "select id, name from color order by name";
							
							$result = $conn->query($sql);

							if ($result->num_rows > 0) 
							{			
								while($row = $result->fetch_assoc()) 
								{					
						
						?>						
						
							<div class="checkbox">
								<label>
									<input type="checkbox" name="Colors[]" onChange='ColorsChanged();' value="<?php echo $row["id"]; ?>"  <?php if(isset($_POST['Colors']) && is_array($_POST['Colors']) && in_array($row["id"], $_POST['Colors'])) echo 'checked="checked"'; ?>  > <span class="colour white"></span> <?php echo $row["name"]; ?>
								</label>
							</div>
							
						<?php
						
								}
							}
						
						?>
							
						</div>

						<button class="btn btn-default btn-sm btn-primary"><i class="fa fa-pencil"></i>Применить</button>

					</form>

				</div>
			</div>	

			<div class="panel panel-default sidebar-menu" style="padding:10px; background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;">

				
			
				<div class="panel-heading" style="border-radius:15px; margin-bottom:-15px;">
					<h3 class="panel-title">Камень <a class="btn btn-xs btn-danger pull-right" href="#" onClick="UnSetStones(); return false;" ><i class="fa fa-times-circle"></i></a></h3>
				</div>

				<div class="panel-body" style="margin-bottom:-13px;">
					
					<form action="catalog.php?r=<?php echo $rr; ?>" id="frmStones" name="frmStones" method="POST">
					
						<div class="form-group" style="margin-bottom:-2px;" >
						
						<?php
						
							$sql = "select id, name from stones order by name";
							
							$result = $conn->query($sql);

							if ($result->num_rows > 0) 
							{			
								while($row = $result->fetch_assoc()) 
								{					
						
						?>							
						
							<div class="checkbox">
								<label>
									<input type="checkbox" name="Stones[]" onChange='StonesChanged();' value="<?php echo $row["id"]; ?>"  <?php if(isset($_POST['Stones']) && is_array($_POST['Stones']) && in_array($row["id"], $_POST['Stones'])) echo 'checked="checked"'; ?>  > <span class="colour white"></span> <?php echo $row["name"]; ?>
								</label>
							</div>	

						<?php
						
								}
							}
						
						?>							
							
						</div>

						<button class="btn btn-default btn-sm btn-primary"><i class="fa fa-pencil"></i>Применить</button>

					</form>

				</div>
			</div>	

			<div class="panel panel-default sidebar-menu" style="padding:10px; background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;">

				<div class="panel-heading" style="border-radius:15px; margin-bottom:-15px;">
					<h3 class="panel-title">Размер <a class="btn btn-xs btn-danger pull-right" href="#" onClick="UnSetSizes(); return false;"><i class="fa fa-times-circle"></i></a></h3>
				</div>

				<div class="panel-body" style="margin-bottom:-13px;">

					<form action="catalog.php?r=<?php echo $rr; ?>" id="frmSizes" name="frmSizes" method="POST">
						<div class="form-group" style="margin-bottom:-2px;" >
						
						<?php
						
							$sql = "select id, name from sizes order by name";
							
							$result = $conn->query($sql);

							if ($result->num_rows > 0) 
							{			
								while($row = $result->fetch_assoc()) 
								{					
						
						?>							
						
							<div class="checkbox">
								<label>
									<input type="checkbox" name="Sizes[]" onChange='SizesChanged();' value="<?php echo $row["id"]; ?>"  <?php if(isset($_POST['Sizes']) && is_array($_POST['Sizes']) && in_array($row["id"], $_POST['Sizes'])) echo 'checked="checked"'; ?> > <span class="colour white"></span> <?php echo $row["name"]; ?>
								</label>
							</div>	

						<?php
						
								}
							}
						
						?>							
							
						</div>

						 <button class="btn btn-default btn-sm btn-primary"><i class="fa fa-pencil"></i>Применить</button>

					</form>

				</div>
			</div>				
			
			<div class="hidden-lg hidden-md">&nbsp;</div>			
			
		</div>
		
		<!-- end left menu categories -->
				
                <div class="col-md-9">
				
                    <div class="panel panel-default sidebar-menu" style="padding:20px; border-radius: 15px; box-shadow: 2px 2px 3px #888888;">
					
                        <div class="row">
                            <div class="col-sm-12 col-md-12 products-number-sort">
                                <div class="row" style='text-align:center'>
								
                                    <form class="form-inline" action="catalog.php?r=<?php echo $rr; ?>" name="frmSortBy" id="frmSortBy" method="POST">
										<div class="products-sort-by">
											Сортировать по &nbsp;
											<select name="sort-by-1" class="form-control" style="border-radius: 7px;">
												<option value="modifydate" <?php if ( $_POST["sort-by-1"] == "modifydate") echo 'selected'; ?> >дате добавления</option>
												<option value="price" <?php if ( $_POST["sort-by-1"] == "price") echo 'selected'; ?>>цене</option>
												<option value="title" <?php if ( $_POST["sort-by-1"] == "title") echo 'selected'; ?> >названию</option>
											</select>
											&nbsp;в&nbsp;
											<select name="sort-by-2" class="form-control" style="border-radius: 7px;">
												<option value="desc" <?php if ( $_POST["sort-by-2"] == "desc") echo 'selected'; ?>>убывающем</option> 
												<option value="asc" <?php if ( $_POST["sort-by-2"] == "asc") echo 'selected'; ?>>возрастающем</option>
											</select>
											&nbsp;порядке&nbsp;&nbsp;&nbsp;
											<button class="btn btn-primary">Применить</button>
										</div>
                                    </form>
									
                                </div>
                            </div>
							
                        </div>
                    </div>
					
				<!----- items ----->

				  <?php
				  				  
				  
				  // where clause handling

				  $where = array();
				  				  
				   if(isset($_POST['Sizes'])){
					 $data = implode(',',$_POST['Sizes']);  
					 $where[] = " ((size1 IN ($data)) or (size2 IN ($data)) or (size3 IN ($data))) ";
				   }				  

				   if(isset($_POST['Stones'])){
					 $data = implode(',',$_POST['Stones']);  
					 $where[] = " ((stone1 IN ($data)) or (stone2 IN ($data)) or (stone3 IN ($data))) ";
				   }

				   if(isset($_POST['Colors'])){
					 $data = implode(',',$_POST['Colors']);  
					 $where[] = " ((color1 IN ($data)) or (color2 IN ($data)) or (color3 IN ($data))) ";
				   }				   
				  
				   if(isset($_POST['Metalls'])){
					 $data = implode(',',$_POST['Metalls']);  
					 $where[] = " (metall IN ($data)) ";
				   }				  
				  
				  $where_s = $where[0];
				  
				  for($idx=1; $idx<sizeof($where); $idx++)
				  {
					$where_s= $where_s.' and '.$where[$idx];
				  }
				  
				  // echo "where_s=".$where_s."<br/>";	
				  				  
				  $sql = "select count(1) n_recs from products where status = 1 ";
				  
				  if ($where_s)
				  {
					$sql = $sql." and ".$where_s;
				  }
				  
				  // echo 'rr=|'.$rr."|";
				  
				  if ($rr)
				  {
					$sql = $sql." and category in (".$rr.") ";
				  }	

				  // order by part				 				
					$orderby = '';
				 
					if(isset($_POST['sort-by-1']) && isset($_POST['sort-by-2'])){					
					 $orderby = " order by ".$_POST['sort-by-1']." ".$_POST['sort-by-2'];				   
					}	
					else
					{
						$orderby = " order by modifydate desc ";
					}
				  
					$sql = $sql." ".$orderby;
 				  
				   // echo 'sql = '.$sql;				  
				  
				  $result = $conn->query($sql);
				  $row = $result->fetch_assoc();
				  $n_of_recs = $row["n_recs"];
				  				  				  
				  /////////////////////////////////////
				  // do some mathematics with pages :)
				  /////////////////////////////////////				  				 
				  
				  $num_of_pages = ceil($n_of_recs / $max_items_per_page);
				  
				  if ($p > $num_of_pages) 
				  {
						$p = 1;
				  }
				  				  				  
				  /////////////////////////////////////
				  
				  if ($n_of_recs>0)
				  {				  				  
				  
				  $sql = "select * 
								from products 
								where status = 1 ";
				  
					if ($where_s)
					{					
						$sql = $sql . " and ".$where_s." ";
					}
			  
					if ($rr)
					{
						$sql = $sql . " and category in (".$rr.") ";
					}
					
					if ($orderby)
					{
						$sql = $sql . "  ".$orderby." ";
					}
					
					$start_position = ($p - 1) * $max_items_per_page;
					
					$sql = $sql . " limit ".$start_position.",".$max_items_per_page." ";
					
					// echo 'sql = '.$sql;
			  
					$the_data = array();		
					$results_the_data = mysqli_query($conn, $sql); 	
					
					$n_of_results_the_data  = 0;
					
					while($line = mysqli_fetch_assoc($results_the_data)){
						$the_data[] = $line;
						$n_of_results_the_data++;
					}					  										    
				  
				  ?>
				  
				  <!---  start of thumbnails -->
				  
				  <div class="row">
				  
					<?
					for($idx=0; $idx<$n_of_results_the_data; $idx++)
					{
					?>
					
					  <div class="col-sm-4 col-md-4">
						<div class="thumbnail"  style="background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888; ">
						  <?php
						  if ($the_data[$idx]["is_discount"] == 1)
						  {						  
						  ?>
							<div class="ribbon_red" style="margin-left:15px;"><span>скидка</span></div>
						  <?php
						  }
						  else if ($the_data[$idx]["is_new"] == 1)
						  {
						  ?>
							<div class="ribbon_green" style="margin-left:15px;"><span>новинка</span></div>
						  <?php
						  } 
						  
						  // show price - 0 - the product is out of stock...
						  if ($the_data[$idx]["show_price"] == 0)
						  {
						  ?>
							<div class="ribbon_blue" style="margin-left:15px;"><span>продано</span></div>
						  <?php
						  }						  
						  ?>
						  <a href="item.php?i=<?php echo $the_data[$idx]["id"]; ?>"><img src="<?php echo $the_data[$idx]["photo1"]; ?>" border="0" alt="<?php echo $the_data[$idx]["title"]; ?>" style="min-height:250px;height:250px; border-radius:15px;"></a>
						  <div class="caption equalize">
							<p class="product_title"><a href="item.php?i=<?php echo $the_data[$idx]["id"]; ?>"><?php echo $the_data[$idx]["title"]; ?></a></p>
							<p><?php echo $the_data[$idx]["short_desc"]; ?></p>
						  </div>
						  
						  <div class="caption likes">
							<?php
							if ($is_to_show_product_views == '1')
							{
							?>
								<p><i class="fa fa-eye" style="margin-left:7px;"></i> <span id='nOfViews'><?php echo $the_data[$idx]["nviews"]; ?></span> | <a href="#" onclick="return false;">Просмотров</a></p>
							<?
							}
							?>
								<p><i class="fa fa-thumbs-up" style="margin-left:7px;"></i> <span id='nOfLikes'><?php echo $the_data[$idx]["likes"]; ?></span> | <a href="#" onClick="doLike(<?php echo $the_data[$idx]["id"]; ?>,'<?php echo $the_data[$idx]["title"]; ?>'); return false;">Поставить Лайк</a></p>
						  </div>						  
						  
							<p class="ebuttonz" style="padding:15px" >
								<a href="item.php?i=<?php echo $the_data[$idx]["id"]; ?>" class="btn btn-success" role="button">Далее...</a> 
								<?php 
									if ($the_data[$idx]["show_price"] == 1) 
									{ 									
										if ($_SESSION['sign_place'] == 'r')
										{									
								?>
										<span class="pull-right" style="font-weight:bold;font-size:20px; color:#337ab7;"><?php echo money_format('%i', ceil($the_data[$idx]["price"]/$_SESSION['rate']) ).$_SESSION['the_curr_sign']; ?></span>
								<?php 
										}
										else
										{
								?>
										<span class="pull-right" style="font-weight:bold;font-size:20px; color:#337ab7;"><?php echo $_SESSION['the_curr_sign'].money_format('%i', ceil($the_data[$idx]["price"]/$_SESSION['rate']) ); ?></span>
								<?php
										}
									} 
								?>								
							</p>							
						</div>
					  </div>	
					  
				<?
					
					} // for
									
				?>

				  </div>						
						
				<!----- items ----->

                    <div class="pages pull-right" >
                        <ul class="pagination" style="border-radius:15px; box-shadow: 2px 2px 3px #888888;">
                            <li><a href="catalog.php?r=<?php echo $rr; ?>&p=1#come_here">&laquo;</a>
                            </li>
							<?php
								$paging_tail=2;
								
								for($idx=$p-$paging_tail; $idx<=$p+$paging_tail; $idx++)
								{
								
									if ($idx >= 1 && $idx <= $num_of_pages)
									{
							?>							
										<li <?php if ($idx==$p) echo "class=\"active\""; ?> ><a href="catalog.php?r=<?php echo $rr; ?>&p=<?php echo $idx; ?>#come_here"><?php echo $idx; ?></a></li>							
							<?php
									}
								}
							?>
                            <li><a href="catalog.php?r=<?php echo $rr; ?>&p=<?php echo $num_of_pages; ?>#come_here">&raquo;</a>
                            </li>
                        </ul>						
                    </div>
               	
				<?php
					
					} // n recs >0
				
				$conn->close();	
				
				?>
				
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

                        <form enctype="multipart/form-data" method="post" name="SubscribeEmail" autocomplete="off" onsubmit="subscribeEmail()">
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
	

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!--<script src="jquery.min.js"></script>-->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>

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
	
	<script>
	
		$('.dropdown-menu a').on('click', function(){    
			$(this).parent().parent().prev().html($(this).html() + '<span class="caret"></span>');    
		})

	</script>	
	
  </body>
</html>