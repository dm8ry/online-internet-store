<?php session_start(); 

if (!$_SESSION['auth_login'])
{
	header("Location: index.php");
	exit;
}

?>

<?php
require_once("./../db_connect.php");

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

$conn->query("set names 'utf8'");

$query_prepare_businesslog_logins_1 = "insert into businesslog_logins_rep select * from businesslog_logins";
$query_prepare_businesslog_logins_2 = "delete from businesslog_logins";

$conn->query($query_prepare_businesslog_logins_1);
$conn->query($query_prepare_businesslog_logins_2);
 
?>

<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8" />
	
    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Crystal Sky - Панель Управления</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
	<meta name='robots' content='noindex,follow' />

	
	<link href="stylesheet" href="assets/css/chartist.min.css" />
	
    <!-- Bootstrap core CSS     -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/bootstrap/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />    
	<link rel="stylesheet" type="text/css" href="assets/css/jquery.flipcountdown.css" />

    <!--     Fonts and icons     -->
    <link href="./../assets/css/font-awesome.min.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />	
	
	<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">		
	
	<style>
	
	.card .icon-big {
		  font-size: 3em;
		  min-height: 64px;
	}

	.card .numbers {
	  font-size: 2em;
	  text-align: right;
	}
	.card .numbers p {
	  margin: 0;
	}
			
	.icon-primary {
	  color: #7A9E9F;
	}

	.icon-info {
	  color: #68B3C8;
	}

	.icon-success {
	  color: #7AC29A;
	}

	.icon-warning {
	  color: #F3BB45;
	}

	.icon-danger {
	  color: #EB5E28;
	}		
			
		
	</style>

 
</head>
<body >

<div class="wrapper">
    <div class="sidebar" data-color="grey" data-image="assets/img/sidebar-5.jpg">

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="dashboard1.php" class="simple-text">
                    "Crystal Sky"
                </a>
            </div>

            <ul class="nav">

                <li class="active">
                    <a href="dashboard1.php">
                        <i class="pe-7s-graph"></i>
                        <p>Статистика</p>
                    </a>
                </li>  			

                <li>
                    <a href="dashboard2.php">
                        <i class="pe-7s-note2"></i>
                        <p>Журнал</p>
                    </a>
                </li> 

                <li>
                    <a href="dashboard11.php">
                        <i class="pe-7s-users"></i>
                        <p>Посещения</p>
                    </a>
                </li> 				

                <li>
                    <a href="dashboard3.php">
                        <i class="pe-7s-cash"></i>
                        <p>Купоны</p>
                    </a>
                </li>   

                <li>
                    <a href="dashboard6.php">
                        <i class="pe-7s-like2"></i>
                        <p>Отзывы</p>
                    </a>
                </li> 				
				
                <li>
                    <a href="dashboard4.php">
                        <i class="pe-7s-piggy"></i>
                        <p>Товары</p>
                    </a>
                </li>  
				
                <li>
                    <a href="dashboard7.php">
                        <i class="pe-7s-cart"></i>
                        <p>Заказы</p>
                    </a>
                </li> 				
				
                <li>
                    <a href="dashboard8.php">
                        <i class="pe-7s-photo"></i>
                        <p>Фотографии</p>
                    </a>
                </li> 					
				
                <li>
                    <a href="dashboard9.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Блог</p>
                    </a>
                </li> 

                <li>
                    <a href="dashboard10.php">
                        <i class="pe-7s-world"></i>
                        <p>Валюты</p>
                    </a>
                </li> 				
				
                <li>
                    <a href="dashboard5.php">
                        <i class="pe-7s-tools"></i>
                        <p>Параметры</p>
                    </a>
                </li>				

            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--<a class="navbar-brand" href="#"></a> -->
                    <a class="navbar-brand" href="#">Статистика</a> 
					<a class="navbar-brand" href="dashboard1.php" style="margin-left:10px;"><span id='loade_r'><img style="margin-top:-3px;" width="30" height="30" src="assets/img/refresh_a.gif" border="0"></span></a>
					<div id="retroclockbox1" style="margin-left:8px; margin-top:-2px;" class="navbar-brand"></div>
					<a class="navbar-brand" href="https://crystalsky.co.il" target='_blank' style="margin-left:10px;">перейти в магазин...</a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">

                        <li>
                           <a href="logout.php">
                               Выйти
                            </a>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>

		<?php
					

		
		?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">

				<!--- controls start --->
				
					<div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-warning text-center">
                                            <i class="ti-bar-chart"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7" id="cont_n_of_vis">
                                        <div class="numbers" id="div_n_of_vis" >
										<?
										$sql = "select count(1) n_vis
													from businesslog_logins_rep";
										$result = $conn->query($sql);
										$row = $result->fetch_assoc();
										$n_of_vis = $row["n_vis"];
										echo $n_of_vis;
										?>										
                                            <p>Посещений</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i> За все время
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-success text-center">
                                            <i class="ti-user"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7" id="cont_n_of_uniq_vis">
                                        <div class="numbers" id="div_n_of_uniq_vis" >
										<?
										/*$sql = "select count(distinct ip_addr) n_uniq_vis
													from businesslog_logins_rep
													where datex >= (now() + INTERVAL 10 HOUR - INTERVAL 30 DAY)";*/
										$sql = "select count(distinct ip_addr) n_uniq_vis
													from businesslog_logins_rep";
										$result = $conn->query($sql);
										$row = $result->fetch_assoc();			
										$n_of_uniq_vis = $row["n_uniq_vis"];
										echo $n_of_uniq_vis;
										?>
                                            <p>Уникальные </p>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i> За все время
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-danger text-center">
                                            <i class="ti-package"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7" id="cont_n_products">
                                        <div class="numbers" id="div_n_products">
										<?
										$sql = "select count(1) n_products from products where status='1'";
										$result = $conn->query($sql);
										$row = $result->fetch_assoc();
										$n_products = $row["n_products"];
										echo $n_products;
										?>										
                                            <p>Товаров</p>                                             
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i> На данный момент
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-info text-center">
                                            <i class="ti-twitter-alt"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7" id="cont_n_feedbacks">
                                        <div class="numbers" id="div_n_feedbacks">
										<?
										$sql = "select count(1) n_feedbacks from feedbacks where status='1'";														
										$result = $conn->query($sql);
										$row = $result->fetch_assoc();			
										$n_feedbacks = $row["n_feedbacks"];
										echo $n_feedbacks;
										?>
                                            <p>Отзывов</p>                                          
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i> На данный момент
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>	

					<div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-warning text-center">
                                            <i class="ti-bar-chart"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7" id="cont_n_of_vis24">
                                        <div class="numbers" id="div_n_of_vis24" >
										<?
										$sql = "select count(1) n_vis
													from businesslog_logins_rep
													where datex >= (now() + INTERVAL 10 HOUR - INTERVAL 24 HOUR)";
										$result = $conn->query($sql);
										$row = $result->fetch_assoc();
										$n_of_vis = $row["n_vis"];
										echo $n_of_vis;
										?>										
                                            <p>Посещений</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i> За последние 24 часа
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-success text-center">
                                            <i class="ti-user"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7" id="cont_n_of_uniq_vis24">
                                        <div class="numbers" id="div_n_of_uniq_vis24" >
										<?
										$sql = "select count(distinct ip_addr) n_uniq_vis
													from businesslog_logins_rep
													where datex >= (now() + INTERVAL 10 HOUR - INTERVAL 24 HOUR)";										
										$result = $conn->query($sql);
										$row = $result->fetch_assoc();			
										$n_of_uniq_vis = $row["n_uniq_vis"];
										echo $n_of_uniq_vis;
										?>
                                            <p>Уникальные </p>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i> За последние 24 часа
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					
 					<div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-warning text-center">
                                            <i class="ti-bar-chart"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7" id="cont_n_of_vis7">
                                        <div class="numbers" id="div_n_of_vis7" >
										<?
										$sql = "select count(1) n_vis
													from businesslog_logins_rep
													where datex >= (now() + INTERVAL 10 HOUR - INTERVAL 7 DAY)";
										$result = $conn->query($sql);
										$row = $result->fetch_assoc();
										$n_of_vis = $row["n_vis"];
										echo $n_of_vis;
										?>										
                                            <p>Посещений</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i> За последние 7 дней
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-success text-center">
                                            <i class="ti-user"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7" id="cont_n_of_uniq_vis7">
                                        <div class="numbers" id="div_n_of_uniq_vis7" >
										<?
										$sql = "select count(distinct ip_addr) n_uniq_vis
													from businesslog_logins_rep
													where datex >= (now() + INTERVAL 10 HOUR - INTERVAL 7 DAY)";										
										$result = $conn->query($sql);
										$row = $result->fetch_assoc();			
										$n_of_uniq_vis = $row["n_uniq_vis"];
										echo $n_of_uniq_vis;
										?>
                                            <p>Уникальные </p>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i> За последние 7 дней
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>						
				
                    <div class="col-md-12">
						<div class="card">
                            <div class="header">
                                <h4 class="title">Уникальные посетители по часам</h4>
                                <p class="category">Кол-во уникальных посетителей по часам</p>
                            </div>
                            <div class="content" id="cont_chart_uniq_visitors_hourly">
                                <canvas  id="chart_uniq_visitors_hourly"></canvas>

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Последние 24 часа
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 						
					
                    <div class="col-md-12">
						<div class="card">
                            <div class="header">
                                <h4 class="title">Уникальные посетители по дням</h4>
                                <p class="category">Кол-во уникальных посетителей по дням</p>
                            </div>
                            <div class="content" id="cont_chart_uniq_visitors_daily">
                                <canvas id="chart_uniq_visitors_daily"></canvas>

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Последний месяц
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>					
				
					<div class="col-md-12">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Топ 15 популярных товаров</h4>
                                <p class="category">Топ 15 популярных товаров по количеству просмотров</p>
                            </div>
                            <div class="content">
                                <div id="ccc"></div>

								<div style="overflow-x:auto;">
								
								<table class="table table-striped">
									<thead>
									  <tr>
										<th>Номер</th>
										<th>Макат</th>
										<th>Изображение</th>
										<th>Название</th>
										<th>Кол-во просмотров</th>
									  </tr>
									</thead>
									<tbody>
	
										<?php
										
										$sql = "select * 
													from 
															(select id, makat, title, photo1, nviews
															   from products 
															  where nviews >= 0				  
															   order by 5 desc) n
													limit 0, 15";
																									
										$result = $conn->query($sql);
										
										if ($result->num_rows > 0)
										{
										
											while($row = $result->fetch_assoc()) 
											{								
										
										?>									  
									  
										<tr>
										<td><a href="./../item.php?i=<?php echo $row["id"]; ?>#come_here" target="_blank"><?php echo $row["id"]; ?></a></td>
										<td><a href="./../item.php?i=<?php echo $row["id"]; ?>#come_here" target="_blank"><?php echo $row["makat"]; ?></a></td>
										<td><a href="./../item.php?i=<?php echo $row["id"]; ?>#come_here" target="_blank"><img src='./../<?php echo $row["photo1"]; ?>' width='70' height='70' border='0' style="border-radius:3px; box-shadow: 2px 2px 3px #888888;"></a></td>
										<td><?php echo $row["title"]; ?></td>
										<td><?php echo $row["nviews"]; ?></td>
										</tr>
										
										<?php
										
											}
										}
										
										?>
																			  									  
									</tbody>
								  </table>									
								
								 </div>
								
                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> За все время
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
          	              

                    <div class="col-md-12">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Топ 15 товаров с минимальными просмотрами</h4>
                                <p class="category">Топ 15 товаров с минимальным количеством просмотров</p>
                            </div>
                            <div class="content">
                                <div id="ccc"></div>

								<div style="overflow-x:auto;">
								
								<table class="table table-striped">
									<thead>
									  <tr>
										<th>Номер</th>
										<th>Макат</th>
										<th>Изображение</th>
										<th>Название</th>
										<th>Кол-во просмотров</th>
									  </tr>
									</thead>
									<tbody>
	
										<?php
										
										$sql = "select * 
													from 
															(select id, makat, title, photo1, nviews
															   from products 
															  where nviews >= 0				  
															   order by 5) n
													limit 0, 15";
																									
										$result = $conn->query($sql);
										
										if ($result->num_rows > 0)
										{
										
											while($row = $result->fetch_assoc()) 
											{								
										
										?>									  
									  
										<tr>
										<td><a href="./../item.php?i=<?php echo $row["id"]; ?>#come_here" target="_blank"><?php echo $row["id"]; ?></a></td>
										<td><a href="./../item.php?i=<?php echo $row["id"]; ?>#come_here" target="_blank"><?php echo $row["makat"]; ?></a></td>
										<td><a href="./../item.php?i=<?php echo $row["id"]; ?>#come_here" target="_blank"><img src='./../<?php echo $row["photo1"]; ?>' width='70' height='70' border='0' style="border-radius:3px; box-shadow: 2px 2px 3px #888888;"></a></td>
										<td><?php echo $row["title"]; ?></td>
										<td><?php echo $row["nviews"]; ?></td>
										</tr>
										
										<?php
										
											}
										}
										
										?>
																			  									  
									</tbody>
								  </table>									
								
								 </div>
								
                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> За все время
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>				
				
				<!--- controls end --->
					
                </div>				
            </div>
        </div>  

        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Панель Управления
                            </a>
                        </li>

                    </ul>
                </nav>
                <p class="copyright pull-right">
                    магазин "Crystal Sky"
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>	
	
	<!--  Charts Plugin -->
	<!--<script src="assets/js/chartist.min.js"></script>-->

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>
		
	<script type="text/javascript" src="assets/js/jquery.flipcountdown.js"></script>
		
	<script type="text/javascript">
	 
	$(document).ready(function(){
		
		$.notify({
			icon: 'pe-7s-gift',
			message: "Добро пожаловать в панель управления сайтом <b>Crystal Sky</b>! <i>Очень</i> хорошей работы!"

		},{
			type: 'info',
			timer: 4000
		});

	}); 
	
	$(function(){
		$("#retroclockbox1").flipcountdown({
			size:"sm"
		});
	})
	 
	</script> 
    
	<?php 
		$conn->close();		
	?>
</html>
