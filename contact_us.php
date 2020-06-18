<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>магазин "Crystal Sky" - обратная связь</title>

    <meta name="keywords" content="украшения, Нацерет-Илит, Израиль, ювелирные, серебро, 925, позолота, камни" />
	<meta name="description" content="магазин CrystalSky - самые изысканные украшения для ВАС!" />
		
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
	
	<?php
	// some reCaptcha :)
	$a = rand(1, 10);
	$b = rand(2, 8);	
	
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
	
	<!-- start js	-->	
	
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
			
	function validateEmail(email) {
		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	}	
	
	function ajax_post()
	{
		var nErrors =0;
		
		
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
		
		if (document.getElementById("subject").value==null || document.getElementById("subject").value=="")
		{
		
			document.getElementById("inp_subject").className = "form-group has-error";
			nErrors++;
		}	
		else
		{
			document.getElementById("inp_subject").className = "form-group";
		}		
		
		if (document.getElementById("message").value==null || document.getElementById("message").value=="")
		{
		
			document.getElementById("inp_message").className = "form-group has-error";
			nErrors++;
		}	
		else
		{
			document.getElementById("inp_message").className = "form-group";
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
			var url = "send_email_contact_us.php";
			var fn = document.getElementById("firstname").value;
			var ln = document.getElementById("lastname").value;
			var em = document.getElementById("email").value;
			var sb = document.getElementById("subject").value;
			var ms = document.getElementById("message").value;
			
			var vars = "fn="+fn+"&ln="+ln+"&em="+em+"&sb="+sb+"&ms="+ms;
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
	
	<!-- end js -->
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
									<li class="active"><a style="color:#5a5a5a;" href="contact_us.php">Контакты</a></li>
									 
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
			<li>Контакты</li>
		</ul>
	</div>
	<!-- the end of breadcrumb --->			
	

	<!-- contact us main panel start --->
	
	<div class="col-md-12">
	<div class="panel panel-default" style="background:#ffffff; border-radius:15px; box-shadow: 2px 2px 3px #888888;">

		<div class="panel-body">	
		
		<!-- Contact Us -->	 		
		 
				<div class="col-md-12">

                    <div class="box" id="contact">
                        <h1>Обратная связь</h1>

                        <p class="lead">У Вас есть вопрос? Вы хотите побольше узнать о наших ювелирных изделиях и украшениях?</p>
                        <p>Пожалуйста, свяжитесь с нами, наш центр обслуживания клиентов работает 24 часа в день, 7 дней в неделю.</p>

                        <hr>

                        <div class="row">
							
                            <!-- /.col-sm-6 -->
                            <div class="col-sm-6">
                                <h3><i class="fa fa-phone"></i> Центр Обслуживания</h3>
                                <p class="text-muted">Заполните контактную форму, <br>представленную ниже,</p>
                                <p><strong>и наш менеджер свяжется с Вами для консультации или ответа на вопрос.</strong></p>
                            </div>
                            <!-- /.col-sm-6 -->
                            <div class="col-sm-6">
                                <h3><i class="fa fa-envelope"></i> Вопрос по Eмайлу</h3>
                                <p class="text-muted">Пожалуйста, отправьте нам емайл, мы будем рады ответить на Ваш вопрос.</p>
                                <ul>
                                    <li><strong><a href="mailto:info@crystalsky.co.il?Subject=Обращение с контактной страницы">info@crystalsky.co.il</a></strong>
                                    </li>                                  
                                </ul>
                            </div>
                            <!-- /.col-sm-4 -->
                        </div>
                        <!-- /.row -->						
						
                        <hr>

                        <div class="row">
                            <div class="col-sm-4">
                                <h3><i class="fa fa-map-marker"></i> Адрес (Нацерет-Илит)</h3>
                                <p>магазин "Crystal Sky"
                                    <br>Мерказ Раско
                                    <br>улица Ацмон 18
                                    <br>город Нацерет-Илит
                                    <br>
                                    <strong>Израиль</strong>
                                </p>
                            </div>
                        </div>

						<hr>
						
                        <div id="map">
                        </div>
						
						<hr>
						
                        <div class="row">
                            <div class="col-sm-4">
                                <h3><i class="fa fa-map-marker"></i> Адрес (Тверия)</h3>
                                <p>магазин "Crystal Sky"
                                    <br>Шук Ирони
                                    <br>улица Апрахим 18
                                    <br>город Тверия
                                    <br>
                                    <strong>Израиль</strong>
                                </p>
                            </div>
                        </div>

						<hr>
						
                        <div id="map2">
                        </div>						

                        <hr>
                        <h2>Контактная форма</h2>
						
                        <form data-toggle="validator" role="form" id="ContactForm">
                            <div class="row" id="contact_status">
                                <div class="col-sm-6">
                                    <div id="inp_first_name" class="form-group">
                                        <label for="firstname">Имя</label>
                                        <input type="text" class="form-control" name="firstname" id="firstname">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div id="inp_last_name" class="form-group">
                                        <label for="lastname">Фамилия</label>
                                        <input type="text" class="form-control" name="lastname" id="lastname">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div id="inp_email" class="form-group">
                                        <label for="email">Емайл</label>
                                        <input type="text" class="form-control" name="email" id="email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div id="inp_subject" class="form-group">
                                        <label for="subject">Тема</label>
                                        <input type="text" class="form-control" name="subject" id="subject">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div id="inp_message" class="form-group">
                                        <label for="message">Ваше сообщение</label>
                                        <textarea id="message"  name="message" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div id="inp_captcha" class="form-group">
                                        <label for="captcha">Сколько будет <?php echo $a; ?> + <?php echo $b; ?> = ?</label>
                                        <input type="text" class="form-control" name="captcha" id="captcha">
                                    </div>
                                </div>								
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-primary" onclick="ajax_post(); return false;"><i class="fa fa-envelope-o"></i> Отправить</button>
                                </div>
                            </div>
                            <!-- /.row -->
							
							<div class="jumbotron" id='txtreply' style='display:none'>
								<h2 style='text-align:center'>Ваше сообщение успешно отправлено!</h2>
								<p style='text-align:center'>Наши менеджеры обязательно свяжутся с Вами и ответят на все Ваши вопросы!</p>
								<p style='text-align:center'><a class="btn btn-primary btn-lg" href="#" onclick="reload_page();" role="button">Ок</a></p>
							</div>
						
                        </form>					

                    </div>


                </div>
                <!-- /.col-md-9 -->

		 
			<!-- End Contact Us -->	
		 
		</div>
	</div>
	</div>		
	
	<!-- contact us main panel end --->
	
	
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
									<button class="btn btn-default" type="button" onclick="subscribeEmail(); return false;">Подписаться!</button>
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
                            <a href="#" class="gplus external" data-animate-hover="shake"><i class="fa fa-google-plus"></i></a>
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
    <script src="jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>	

	<!-- Google Maps -->
    <script>
      function initMap() {
	  
			var latlng = new google.maps.LatLng(32.7076913,35.3234793);
			var latlng2 = new google.maps.LatLng(32.7864528,35.5383924);
			var myOptions =
			{
				zoom: 17,
				center: latlng,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				scrollwheel: false
			};

			var myOptions2 =
			{
				zoom: 17,
				center: latlng2,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				scrollwheel: false
			};

			var map = new google.maps.Map(document.getElementById("map"), myOptions);
			
			var map2 = new google.maps.Map(document.getElementById("map2"), myOptions2);

			var myMarker = new google.maps.Marker(
			{
				position: latlng,
				map: map,				
				title:"магазин Crystal Sky (Нацерет-Илит)"				
		   });

			var myMarker2 = new google.maps.Marker(
			{
				position: latlng2,
				map: map2,				
				title:"магазин Crystal Sky (Тверия)"				
			});	  

      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRZI734sZXqw3PeXRa5P9dO4OD5is5hL0&callback=initMap"
        async defer></script>
	
	
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