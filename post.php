<?php session_start(); ?>
<!DOCTYPE html>
<?
	// conn db parameters
	require_once('db_connect.php');
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$conn->query("set names 'utf8'");
	
	
	// item id
	//
	if (!$_GET["i"]) 
	{
		$i = 1;
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
				
				$sqlu = "update posts set nviews=nviews+1 where id = ".$i;

				if ($conn->query($sqlu) === TRUE) {
					// Ok
				} else {
					// Not Ok
				}				
				
				//
			}
			else
			{
				$i = 1;
			}
		}
		else
		{				
			$i = 1;
		}
	}				
			
	$sql = "select p.*, date_format(p.createdate, '%d/%m/%Y') dt_to_print from posts p where post_status =1 and id = ".$i;
	
	$result = $conn->query($sql);
	
	$n_of_rows = $result->num_rows;
	
	$row = $result->fetch_assoc();
		
	if ($n_of_rows==1)
	{
			// Ok
	}
	else
	{
		$i = 1;		
		$sql = "select p.*, date_format(p.createdate, '%d/%m/%Y') dt_to_print from posts p where post_status =1 and id = ".$i;	
		$result = $conn->query($sql);					
		$row = $result->fetch_assoc();			
	}

	$conn->close();
?>	
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $row["title"]; ?> - магазин украшений "Crystal Sky"</title>

	<?php
	if (($row["post_keyword1"] == '') && ($row["post_keyword2"] == '') && ($row["post_keyword3"] == '')) // 000
	{
	?>
	
		<meta name="keywords" content="украшения из серебра, натуральные камни, позолота, ювелирные изделия, магазин, Нацрат-Илит, марказ Раско, Ацмон 18, подарки, туризм, сувениры, контакты, бизнес, красота" />
	
	<?php
	}
	elseif (($row["post_keyword1"] != '') && ($row["post_keyword2"] == '') && ($row["post_keyword3"] == '')) // 100
	{	
	?>
	
		<meta name="keywords" content="<?php echo $row["post_keyword1"]; ?>, ювелирные изделия, магазин, серебро 925, изделия из серебра, Афула, Нацрат-Илит, Хайфа, Йокнеам, Тель-Авив, Иерусалим, Кфар-Саба, Акко, Кирьят-Шмона" />	
		
	<?php
	} 
	elseif (($row["post_keyword1"] != '') && ($row["post_keyword2"] != '') && ($row["post_keyword3"] == '')) // 110
	{
	?>
	
		<meta name="keywords" content="<?php echo $row["post_keyword1"]; ?>,<?php echo $row["post_keyword2"]; ?>, Хадера, Афула, Нацрат-Илит, Хайфа, Раанана, Герцлия, Нетания, Йокнеам, Тверия, Тель-Авив, Иерусалим, Кфар-Саба, Акко, Ашдод, Кирьят-Шмона, Кирьят-Гат" />
	
	<?php
	}
	elseif (($row["post_keyword1"] == '') && ($row["post_keyword2"] != '') && ($row["post_keyword3"] == '')) // 010
	{
	?>
	
		<meta name="keywords" content="<?php echo $row["post_keyword2"]; ?>, украшения из серебра, натуральные камни, позолота, ювелирные изделия, магазин, Нацрат-Илит, Йокнеам, Ришон, Реховот, Кирьят-Ям, Крайот, Хадера, Афула, Хайфа, Раанана, Герцлия, Нетания, Тверия, Тель-Авив, Иерусалим, Кфар-Саба, Акко, Ашдод, Кирьят-Шмона, Кирьят-Гат" />	
	
	<?php
	}
	elseif (($row["post_keyword1"] != '') && ($row["post_keyword2"] != '') && ($row["post_keyword3"] != '')) // 111
	{
	?>
	
		<meta name="keywords" content="<?php echo $row["post_keyword1"]; ?>, <?php echo $row["post_keyword2"]; ?>, <?php echo $row["post_keyword3"]; ?>, украшения из серебра, натуральные камни, позолота, ювелирные изделия, магазин, Crystal Sky" />		
	
	<?php
	}
	elseif (($row["post_keyword1"] == '') && ($row["post_keyword2"] == '') && ($row["post_keyword3"] != '')) // 001
	{
	?>

		<meta name="keywords" content="<?php echo $row["post_keyword3"]; ?>, украшения из серебра, натуральные камни, позолота, красота, кольцо, серьги, подвески, кулон, цепочка, ожерелье, свадьба, юбилей, идея, презент, ювелирные изделия, магазин, Crystal Sky" />	
	
	<?
	}
	elseif (($row["post_keyword1"] == '') && ($row["post_keyword2"] != '') && ($row["post_keyword3"] != '')) // 011
	{
	?>
	
		<meta name="keywords" content="<?php echo $row["post_keyword2"]; ?>, <?php echo $row["post_keyword3"]; ?>, украшения из серебра, натуральные камни, позолота, необычная, удивительный, загадочный, память, мама, бабушка, девушка, что-то, юбилей, идея, презент, ювелирные изделия, магазин, Crystal Sky" />	
	
	<?
	}
	?>
	
	<meta name="description" content="<?php echo $row["title"]; ?> - магазин Crystal Sky - ювелирные украшения из серебра, подарки, сувениры, натуральные камни, позолота." />
	
	
	<!-- facebook guys -->
	<meta property="og:title" content="<?php echo $row["title"]; ?> - магазин Crystal Sky - серебряные украшения, натуральные камни, позолота" />
	<meta property="og:url"content="https://www.facebook.com/sharer/sharer.php?u=http://www.crystalsky.co.il/post.php?i=<?php echo $i; ?>" />
	<meta property="og:image" content="<?php echo $row["post_photo1"]; ?>" />
	<meta property="og:description"   content="<?php echo $row["title"]; ?> - <?php echo $row["post_txt"]; ?> - Cеребряные украшения, натуральные камни, позолота. Самые изысканные украшения для Вас! Нацерет-Илит, Мерказ Раско, улица Ацмон 18, www.crystalsky.co.il" />
	<meta property="og:type"          content="website" />	
	<!-- facebook guys -->
	
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

	function doLike()
	{			
		var nErrors =0;
				 
		var url = "doPostLike.php";
	
		var oData = new FormData(document.forms.namedItem("PostLike"));
		
		var oReq = new XMLHttpRequest();
		  oReq.open("POST", url, true);
		  oReq.onload = function(oEvent) {
		  
			if (oReq.status == 200) 
			{						
				$('#myModalOk').modal('show');				
				document.getElementById("nOfLikes").innerHTML=oReq.responseText;
				return;					
			} else {
			  alert("Error: " + oReq.status);
			}
		  };
		oReq.send(oData); 
		 			
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
					$('#myModalOk2').modal('show');																																			
					return;					
				} else {
				  alert("Error: " + oReq.status);
				}
			  };
			oReq.send(oData); 

		}			
	}  		
  
  </script>
  </head>
  <body>
  <!-- start google analytics -->
  <?php include_once("analyticstracking.php") ?>
  <!-- end google analytics -->  
 
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
				<li><a href="index.php">Главная</a>
				</li>
				<li><a href="blog.php">Блог</a>
				</li>				
				<li><?php echo $row["title"]; ?></li>
			</ul>
		</div>
		<!-- the end of breadcrumb --->		
		
		<!-- start of about us content --->
		<div class="col-md-9" id="blog-post">			
		
					<form  enctype="multipart/form-data" method="post" name="PostLike">
                    <div class="box" style="background:#ffffff; padding:20px; border-radius:15px; box-shadow: 2px 2px 3px #888888;">
			
						<input type="hidden" name="postId" value="<?php echo $row["id"]; ?>">
						<input type="hidden" name="postTitle" value="<?php echo $row["title"]; ?>">						
                        <h2><a href='post.php?i=<? echo $row[id]; ?>'><?php echo $row["title"]; ?></a></h2>
                        <p class="author-date">Автор <a href="#"><?php echo $row["author"]; ?></a> | <?php echo $row["dt_to_print"]; ?> | <i class="fa fa-thumbs-up"></i> <span id='nOfLikes'><?php echo $row["likes"]; ?></span> Понравилось | <a href="#" onClick="doLike(); return false;">Поставить Лайк</a></p>
						
                        <div id="post-content">
                            <p style="padding-right:20px;"><?php echo nl2br($row["post_txt"]); ?></p>
														                            
                            <p>
								<?
								if ($row["to_show_photo1"] == 1)
								{
								?>
									<img style="border-radius:15px; box-shadow: 2px 2px 3px #888888;" src="<?php echo $row["post_photo1"]; ?>" class="img-responsive" alt="<?php echo $row["title"]; ?>">
								<?
								}
								?>
								
								<?
								if ($row["has_html_code"] == 1)
								{
								?>
									<div class="embed-responsive embed-responsive-4by3">
									<? echo $row["the_html_code"]; ?>									
									</div>																		
								<?
								}
								?>
								
                            </p>

                        </div>
						
						<div class="social">
							<h4>Поделиться с другом</h4>								
							
							<div id="tell_a_friend">
							<p class="social">
								<a href="http://ok.ru/crystalsky" target='_blank' class="odnoklassniki external" data-animate-hover="shake"><i class="fa fa-odnoklassniki"></i></a>
								<a href="https://www.facebook.com/sharer/sharer.php?u=http://www.crystalsky.co.il/post.php?i=<?php echo $i; ?>" target='_blank' class="facebook external" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>
								
								<a href="http://twitter.com/share?text=<?php echo $row["title"]; ?> - магазин Crystal Sky - украшения из серебра, позолота, камни&url=http://www.crystalsky.co.il/post.php?i=<?php echo $i; ?>&hashtags=blog, блог" target='_blank' class="twitter external" data-animate-hover="shake"><i class="fa fa-twitter"></i></a>
								
								<a href="https://www.instagram.com/crystal_sky_jewelry/" target='_blank' class="instagram external" data-animate-hover="shake"><i class="fa fa-instagram"></i></a>
								<a href="#" class="gplus external" data-animate-hover="shake"><i class="fa fa-google-plus"></i></a>
								<a href="mailto: info@crystalsky.co.il?Subject=contact from website CrystalSky.co.il" class="email external" data-animate-hover="shake"><i class="fa fa-envelope"></i></a>							
						   </p>
						   </div>
							  
                        </div>							
						
						
						<p class="author-date">Категория: <b><i><a href='#'><?php echo mb_convert_case($row["post_category"], MB_CASE_TITLE, 'UTF-8'); ?></a></i></b></p>
						
						<p class="author-date">Ключевые слова: 
												
						<?
						if ($row["post_keyword1"]!='') 
						{
						?>
							<b><i><a href="#"><?php echo mb_convert_case($row["post_keyword1"], MB_CASE_TITLE, 'UTF-8'); ?></a></i></b>
						<?
						}
						else
						{
						?>
							<b><i><a href="#">Украшения</a></i></b>
						<?
						}
						?>
						
						<? echo ' | '; ?>
						
						<?
						if ($row["post_keyword2"]!='') 
						{
						?>
							<b><i><a href="#"><?php echo mb_convert_case($row["post_keyword2"], MB_CASE_TITLE, 'UTF-8'); ?></a></i></b>
						<?
						}
						else
						{
						?>
							<b><i><a href="#">Серебро</a></i></b>
						<?
						}
						?>
						
						<? echo ' | '; ?>
						
						<?
						if ($row["post_keyword3"]!='') 
						{
						?>
							<b><i><a href="#"><?php echo mb_convert_case($row["post_keyword3"], MB_CASE_TITLE, 'UTF-8'); ?></a></i></b>
						<?
						}
						else
						{						
						?>
							<b><i><a href="#">Камни</a></i></b>
						<?
						}
						?>	

						</p>
						
						
						<p class="author-date">Ссылки: 
						
						<?
						if ($row["post_link1_url"]!='') 
						{
						?>
							<b><i><a href='<? echo $row["post_link1_url"]; ?>' target='_blank' title='<? echo mb_convert_case($row["post_link1_title"], MB_CASE_TITLE, 'UTF-8'); ?>'><? echo mb_convert_case($row["post_link1_title"], MB_CASE_TITLE, 'UTF-8'); ?></a></i></b>
						<?
						}
						else
						{
						?>
							<b><i><a href='http://ok.ru/crystalsky' target='_blank' title='Crystal Sky в Одноклассниках'>Crystal Sky в Одноклассниках</a></i></b>
						<?
						}
						?>
						
						<? echo ' | '; ?>
						
						<?
						if ($row["post_link2_url"]!='') 
						{
						?>
							<b><i><a href='<? echo $row["post_link2_url"]; ?>' target='_blank' title='<? echo mb_convert_case($row["post_link2_title"], MB_CASE_TITLE, 'UTF-8'); ?>'><? echo mb_convert_case($row["post_link2_title"], MB_CASE_TITLE, 'UTF-8'); ?></a></i></b>
						<?
						}
						else
						{
						?>
							<b><i><a href='http://fb.com/crystalsky.jewelry' target='_blank' title='Crystal Sky в Фейсбуке'>Crystal Sky в Фейсбуке</a></i></b>
						<?
						}
						?>
						
						<? echo ' | '; ?>
						
						<?
						if ($row["post_link3_url"]!='') 
						{
						?>
							<b><i><a href='<? echo $row["post_link3_url"]; ?>' target='_blank' title='<? echo mb_convert_case($row["post_link3_title"], MB_CASE_TITLE, 'UTF-8'); ?>'><? echo mb_convert_case($row["post_link3_title"], MB_CASE_TITLE, 'UTF-8'); ?></a></i></b>
						<?
						}
						else
						{						
						?>
							<b><i><a href='http://twitter.com/crystalsky925' target='_blank' title='Crystal Sky в Твиттере'>Crystal Sky в Твиттере</a></i></b>
						<?
						}
						?>
						
						</p>						
						 
                    </div>
					</form>
                    <!-- /.box -->
					
				<ul class="pager">
					<li class="previous <?php echo $btn_previous_is_distabled; ?>"><a href="post.php?i=<?php if($i-1 > 0) echo $i-1; else echo 1; ?>">&larr; Назад</a>
					</li>
					<li class="next <?php echo $btn_next_is_distabled; ?>"><a href="post.php?i=<?php echo $i+1; ?>">Вперед &rarr;</a>
					</li>
				</ul>				
									
					
                </div>
                <!-- /#blog-post -->
								

		<!-- end of about us content --->	
	
		<div class="col-md-3"> <!-- start right side menu -->    

			<div class="hidden-lg hidden-md">&nbsp;</div>				
		
			<div class="panel panel-default sidebar-menu" style="border-radius: 15px; box-shadow: 2px 2px 3px #888888;">
				<div class="panel-body">
					<ul class="nav nav-pills nav-stacked ">

						<li>
							<a href="index.php">Главная</a>
						</li>					
						<li>
							<a href="catalog.php">Каталог</a>
						</li>	
						<li>
							<a href="new.php">Новинки</a>
						</li>
						<li>
							<a href="popular.php">Популярные</a>
						</li>						
						<li>
							<a href="discounts.php">Скидки</a>
						</li>							
						<li>
							<a href="blog.php">Блог</a>
						</li>
						<li>
							<a href="events.php">Мероприятия</a>
						</li>						
						<li>
							<a href="feedbacks.php">Отзывы покупателей</a>
						</li>	
						<li>
							<a href="about_us.php">О нас</a>
						</li>						
						<li>
							<a href="contact_us.php">Контакты</a>
						</li>
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
        </div> <!-- end right side menu -->
	
	
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
			<div class="col-md-6">
				<p class="pull-left">© 2016 Магазин "Crystal Sky"</p>
			</div>
			<div class="col-md-6">
				<p class="pull-right"><a href="#">Back To Top</a></p>
			</div>
		</div>
	</div>	
			
	<a href="#" class="scrollup"></a>
	
	<!-- End Footer -->		
	

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>

	<?php require_once('trace_login_businesslog.php'); ?>
	
	<div class="modal fade" tabindex="-1" role="dialog" id="myModalOk" name="myModalOk">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="imgPresenterTitle">Спасибо за Ваш "лайк"!</h4>
		  </div>
		  <div class="modal-body" id="imgPresenterBody" name="imgPresenterBody" style="margin-left:auto; margin-right:auto; text-align:center">       
		  Ваш голос учтен! Спасибо!  
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>        
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->	
	
	
<!--- image presenter --->

<div class="modal fade" tabindex="-1" role="dialog" id="myModalOk2" name="myModalOk2">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="imgPresenterTitle2">Подпишитесь на новости</h4>
      </div>
      <div class="modal-body" id="imgPresenterBody2" name="imgPresenterBody2" style="margin-left:auto; margin-right:auto; text-align:center">       
	  Спасибо! Ваш емайл успешно занесен в нашу базу данных! <br/>Вы будьте в курсе всех новостей и мероприятий магазина "Crystal Sky"! 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--- image presenter --->		
	
<?php
	//$conn->close();	
?>	


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