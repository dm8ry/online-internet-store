<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>магазин "Crystal Sky" - результаты поиска</title>

    <meta name="keywords" content="украшения из серебра, подарки,  натуральные камни, позолота, Crystal Sky, магазин, Crystal, Sky, Нацерет-Илит, Израиль, Раско, ювелирные, серебро, 925, позолота, камни, выбор, рубин, топаз, сапфир, аметист" />
	<meta name="description" content="магазин Crystal Sky - украшения из серебра, натуральные камни, позолота" />
		
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
	
	</script>
	
  </head>
  <body>
  <!-- start google analytics -->
  <?php include_once("analyticstracking.php") ?>
  <!-- end google analytics -->
  
  <?php
  
	require_once('db_connect.php');
  
  	// start calculate num items in the basket

	$n_items_in_the_basket = 0;

	if(!isset($_SESSION['cart_items'])){
		$n_items_in_the_basket = 0;
	}				
	else
	{
		$n_items_in_the_basket = count($_SESSION['cart_items']);			
	}	 
  
	$q_def = 'Фраза поиска не определена';
  
	if (!$_GET["q"]) 
	{
		$q = $q_def;
	}
	else
	{				
		$q = $_GET['q'];
					
	} 


	// page number
	//
	if (!$_GET["p"]) 
	{
		$p = 0;
	}
	else
	{				
		$p = $_GET['p'];
		
		// echo "is_int($p) = ".is_int($p)."<br/>";
		
		if (is_numeric($p))
		{				
			if (round($p, 0) == $p)
			{
				// Ok
			}
			else
			{
				$p = 0;
			}
		}
		else
		{				
			$p = 0;
		}
	}	
	
	$n_results_on_page = 5;
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	$q_search_length = mb_strlen($q,'UTF-8'); 
	
	if ($q_search_length > 6)
	{
		$q_search_length = mb_substr($q, 0, $q_search_length-4);
	}
	else
	{
		$q_search_length = $q;
	}
	
	$conn->query("set names 'utf8'");

	$sql0 = "select count(1) n_of_r 
	        from
				(
					select * 
					from 
					(
						select concat('Товар: ',title) the_title, id the_item_id, photo1, long_desc, createdate the_datex from products where concat(upper(title), upper(short_desc), upper(long_desc), upper(makat)) like upper('%".$q_search_length."%') 
						union all
						select concat('Отзыв: ',feedback_title) the_title, id the_item_id, 'assets/images/avatar_1.png' photo1, concat('Автор: ',user_name,' из ', user_city, '.  ', feedback_msg ) feedback_msg, datex the_datex from feedbacks where concat(upper(feedback_title), upper(feedback_msg), upper(user_name), upper(user_city)) like upper('%".$q_search_length."%') 
					) A
					order by the_datex desc 
				) B";	
	
	$result0 = $conn->query($sql0);
	
	$row0 = $result0->fetch_assoc();
	
	$n_of_rows0 = $row0["n_of_r"];	
	
	$sql = "select * 
	        from
				(
					select * 
					from 
					(
						select concat('item.php?i=',id) the_item_lnk, concat('Товар: ',title) the_title, id the_item_id, photo1, long_desc, createdate the_datex from products where concat(upper(title), upper(short_desc), upper(long_desc), upper(makat)) like upper('%".$q_search_length."%') 
						union all
						select 'feedbacks.php' the_item_lnk, concat('Отзыв: ',feedback_title) the_title, id the_item_id, 'assets/images/avatar_1.png' photo1, concat('Автор: ',user_name,' из ', user_city, '.  ', feedback_msg ) feedback_msg, datex the_datex from feedbacks where concat(upper(feedback_title), upper(feedback_msg), upper(user_name), upper(user_city)) like upper('%".$q_search_length."%') 
					) A
					order by the_datex desc 
				) B
			limit ".$p*$n_results_on_page.", ".$n_results_on_page;
	
	//echo "sql = ".$sql."<br/>";
	
	$result = $conn->query($sql);	
	$n_of_rows = $result->num_rows;
	
	/*
	echo "p = ".$p."<br/>";
	echo "n_results_on_page = ".$n_results_on_page."<br/>";
	echo "n_of_rows0 = ".$n_of_rows0."<br/>";
	*/
	
	if (($p+1) < ceil($n_of_rows0/$n_results_on_page))
	{	
	$nxt_page =$p-1;
	$prv_page = $p+1;
	}	
 
	if (($p+1) == ceil($n_of_rows0/$n_results_on_page))
	{	
	$nxt_page =$p-1;
	$prv_page = $p;
	}
 
	if ($nxt_page < 0)
	{
		$nxt_page =0;
		$prv_page =1;
	}
	
	if (1 == ceil($n_of_rows0/$n_results_on_page))
	{	
	$nxt_page =0;
	$prv_page = 0;
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
				<li>Результаты поиска: <strong><?php echo $q; ?></strong> и все, что включает <strong><?php echo $q; ?></strong></li>
			</ul>
		</div>
		<!-- the end of breadcrumb --->		
		
		<!-- start of search content --->
		<div class="col-md-9" id="blog-listing">		

					<?php
										
						if ($n_of_rows==0)
						{
					?>
					
						<div class="post" style="border-radius:15px; box-shadow: 2px 2px 3px #888888;">
							<h4><?php if ($q == $q_def) { echo $q; } else { echo "Фраза: ".$q; } ?></h4>                        
							<hr>                        
							<div class="image">
								<a href="#">
									<img style="border-radius:15px; box-shadow: 2px 2px 3px #888888;" src="assets/images/banner_b_01.png" class="img-responsive" alt="В магазине "Crystal Sky" вы сможете найти регулярно пополняемый ассортимент">
								</a>
							</div>
							<p class="intro">К сожалению, поиск по введенной Вами фразе не дал результатов. Попробуйте задать другую фразу поиска. Попробуйте задать для поиска слова-синонимы.</p>
							<p class="read-more"></p>
						</div>					
					
					
					<?php
						}
						else
						{
							
							while($row = $result->fetch_assoc()) 
							{
					
					?>
		
								<div class="post" style="border-radius:15px; box-shadow: 2px 2px 3px #888888;">
									<h4><a href="<?php echo $row["the_item_lnk"]; ?>" target="_blank"><?php echo $row["the_title"]; ?></a></h4>                        
									<hr>                        
									<div class="image">
										<a href="<?php echo $row["the_item_lnk"]; ?>" target="_blank">
											<img style="border-radius:15px; box-shadow: 2px 2px 3px #888888; width:300px; " src="<?php echo $row["photo1"]; ?>" border="0" class="img-responsive" alt="<?php echo $row["the_title"]; ?>">
										</a>
									</div>
									<p class="intro"><?php echo $row["long_desc"]; ?></p>
									<p class="read-more"><a href="<?php echo $row["the_item_lnk"]; ?>" target="_blank" class="btn btn-primary">Далее</a>
									</p>
								</div>

					<?php
					
							}
					
						}
					
					?>
										
                    <ul class="pager">
						<li class="previous"><a href="<?php echo "search_result.php?q=".$q."&p=".$nxt_page; ?>">&larr; Назад</a>
                        </li>					
                        <li class="next"><a href="<?php echo "search_result.php?q=".$q."&p=".$prv_page; ?>">Вперед &rarr;</a>
                        </li>                        
                    </ul>
		
		</div>
		<!-- end of search content --->	
	
		<div class="col-md-3"> <!-- start right side menu -->    

			<div class="hidden-lg hidden-md">&nbsp;</div>		
		
			<div class="panel panel-default sidebar-menu" style="border-radius: 15px; box-shadow: 2px 2px 3px #888888;">
				<div class="panel-body">
					<ul class="nav nav-pills nav-stacked ">

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
    <script src="jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>

	<?php require_once('trace_login_businesslog.php'); ?>
	
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