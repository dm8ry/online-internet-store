<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name='robots' content='noindex,follow' />

        <title>Crystal Sky - Панель Управления - Контактная Форма</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>	 

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-7 text">
                            <h1><strong>"Crystal Sky"</strong> Панель Управления</h1>
                            <div class="description">
                            	<p>
	                            	Пожалуйста, свяжитесь с администратором, пользуясь формой.
                            	</p>
                            </div>

                        </div>
                        <div class="col-sm-5 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Связаться с нами</h3>
                            		<p>Заполните следующую форму:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-pencil"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="sendmessage_and_thankyou.php" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-first-name">Имя</label>
			                        	<input type="text" name="form-first-name" placeholder="Имя..." class="form-first-name form-control" id="form-first-name">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-email">Емайл</label>
			                        	<input type="text" name="form-email" placeholder="Емайл..." class="form-email form-control" id="form-email">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-about-yourself">Ваше сообщение</label>
			                        	<textarea name="form-about-yourself" placeholder="Ваше сообшение..." 
			                        				class="form-about-yourself form-control" id="form-about-yourself"></textarea>
			                        </div>
			                        <button type="submit" class="btn">Отправить!</button>
			                    </form>
		                    </div>
							
							<div class="row">
								<div class="col-sm-6 col-sm-offset-4 social-login" >
									<h3>...или <a href='index.php'>вернитесь</a></h3>                        	
								</div>
							</div>
							
                        </div>
												
                    </div>
					
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>