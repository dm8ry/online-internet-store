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

	<script>
	
	function do_icon_refresh()
	{
				
		var strHTML = document.getElementById("loade_r").innerHTML;
	
		if (strHTML.indexOf("refresh_b") > 0) return;
	
		document.getElementById("loade_r").innerHTML = '<img style="margin-top:-3px;" width="30" height="30" src="assets/img/refresh_b.gif" border="0">';
		
		location.reload(true);	
		
	}
	
	</script>
 
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
					<a class="navbar-brand" onclick="do_icon_refresh()" style="margin-left:10px;"><span id='loade_r'><img style="margin-top:-3px;" alt="Обновить" title="Обновить" width="30" height="30" src="assets/img/refresh_a.gif" border="0"></span></a>
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

        <div class="content">
            <div class="container-fluid">
                <div class="row">
					
                    <div class="col-md-12">
						<div class="card">
                            <div class="header">
                                <h4 class="title">Уникальные посетители по часам</h4>
                                <p class="category">Кол-во уникальных посетителей по часам</p>
                            </div>
                            <div class="content" id="cont_chart400">
                                <div id="chart400" class="ct-chart"></div>

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
                                <h4 class="title">Уникальные посетители за неделю</h4>
                                <p class="category">Кол-во уникальных посетителей за неделю</p>
                            </div>
                            <div class="content" id="cont_chart2">
                                <div id="chart2" class="ct-chart"></div>

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Последняя неделя
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>		

                    <div class="col-md-12">
						<div class="card">
                            <div class="header">
                                <h4 class="title">Аналитика Товаров Магазина</h4>
                                <p class="category">Всего Товаров в Магазине: <font style='color:#000000'><b><span id='grand_total_sum'></span></b></font> <br/>
													Изделия из серебра: <font style='color:#1dc7ea'><b>всего <span id='total_sum_1'></span></b></font> | <font style='color:#fb404b'><b>активных <span id='total_active_1'></span></b></font> | <font style='color:#ffa534'><b>с указанной ценой <span id='total_show_price_1'></span></b></font> | <font style='color:#9368e9'><b>без цены <span id='total_not_show_price_1'></span></b></font><br/>
													Изделия из позолоты: <font style='color:#1dc7ea'><b>всего <span id='total_sum_2'></span></b></font> | <font style='color:#fb404b'><b>активных <span id='total_active_2'></span></b></font> | <font style='color:#ffa534'><b>с указанной ценой <span id='total_show_price_2'></span></b></font> | <font style='color:#9368e9'><b>без цены <span id='total_not_show_price_2'></span></b></font><br/>
													Изделия из камней: <font style='color:#1dc7ea'><b>всего <span id='total_sum_3'></span></b></font> | <font style='color:#fb404b'><b>активных <span id='total_active_3'></span></b></font> | <font style='color:#ffa534'><b>с указанной ценой <span id='total_show_price_3'></span></b></font> | <font style='color:#9368e9'><b>без цены <span id='total_not_show_price_3'></span></b></font><br/>
													Модные украшения: <font style='color:#1dc7ea'><b>всего <span id='total_sum_4'></span></b></font> | <font style='color:#fb404b'><b>активных <span id='total_active_4'></span></b></font> | <font style='color:#ffa534'><b>с указанной ценой <span id='total_show_price_4'></span></b></font> | <font style='color:#9368e9'><b>без цены <span id='total_not_show_price_4'></span></b></font><br/>
													Итого: <font style='color:#1dc7ea'><b>всего <span id='total_sum'></span></b></font> | <font style='color:#fb404b'><b>активных <span id='total_active'></span></b></font> | <font style='color:#ffa534'><b>с указанной ценой <span id='total_show_price'></span></b></font> | <font style='color:#9368e9'><b>без цены <span id='total_not_show_price'></span></b></font>
								</p>
                            </div>
                            <div class="content" id="cont_chart3">
                                <div id="chart3" class="ct-chart"></div>

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
										<td><a href="./../item.php?i=<?php echo $row["id"]; ?>" target="_blank"><?php echo $row["id"]; ?></a></td>
										<td><a href="./../item.php?i=<?php echo $row["id"]; ?>" target="_blank"><?php echo $row["makat"]; ?></a></td>
										<td><a href="./../item.php?i=<?php echo $row["id"]; ?>" target="_blank"><img src='./../<?php echo $row["photo1"]; ?>' width='70' height='70' border='0' style="border-radius:3px; box-shadow: 2px 2px 3px #888888;"></a></td>
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
										<td><a href="./../item.php?i=<?php echo $row["id"]; ?>" target="_blank"><?php echo $row["id"]; ?></a></td>
										<td><a href="./../item.php?i=<?php echo $row["id"]; ?>" target="_blank"><?php echo $row["makat"]; ?></a></td>
										<td><a href="./../item.php?i=<?php echo $row["id"]; ?>" target="_blank"><img src='./../<?php echo $row["photo1"]; ?>' width='70' height='70' border='0' style="border-radius:3px; box-shadow: 2px 2px 3px #888888;"></a></td>
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
	<script src="assets/js/chartist.min.js"></script>	
	
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
	
	
  <?php
	
	$query = " SELECT date_format(bl.datex, '%H') hh24, count(distinct(bl.ip_addr)) n_of_uniq_visitors 
				FROM businesslog_logins bl
				where bl.datex >= (now() + INTERVAL 10 HOUR - INTERVAL 23 HOUR) 
				group by date_format(bl.datex, '%H')
				order by bl.datex";
		
	$the_data = array();		
	$results_the_data = mysqli_query($conn, $query); 	
	
	while($line = mysqli_fetch_assoc($results_the_data)){
		$the_data[] = $line;
	}
	
   ?>		
	
	var js_the_data_chart400 = <?php echo json_encode( $the_data ) ?>;	

	var the_labels = [];
	var the_series = [];
	  
	for(var i=0 ; i<js_the_data_chart400.length ; i++)
	{			
		the_labels.push(js_the_data_chart400[i].hh24);
		the_series.push(js_the_data_chart400[i].n_of_uniq_visitors);			
	} 

	new Chartist.Line('#chart400', {
	 labels: the_labels,
	 series: [the_series]
	});	

	<?php
	
	$query = "select 
				case 
					when date_format(bl.datex,'%e') 
							in ('2', '4' , '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26', '28', '30') 
						then '.' 
						else date_format(bl.datex,'%e') 
					end how_to_show, 
				count(distinct(bl.ip_addr)) n_of_uniq_visitors
			   from businesslog_logins bl
			   where bl.datex >= (now() + INTERVAL 10 HOUR - INTERVAL 7 DAY)
			   group by date_format(bl.datex,'%e')
			   order by bl.datex";
		
	$the_data = array();		
	$results_the_data = mysqli_query($conn, $query); 	
	
	while($line = mysqli_fetch_assoc($results_the_data)){
		$the_data[] = $line;
	}	
	
   ?>		
	
	var js_the_data_chart2  = <?php echo json_encode( $the_data ) ?>;	

	var the_labels = [];
	var the_series = [];
	  
	for(var i=0 ; i<js_the_data_chart2.length ; i++)
	{			
		the_labels.push(js_the_data_chart2[i].how_to_show);
		the_series.push(js_the_data_chart2[i].n_of_uniq_visitors);			
	}	 	  
	
	new Chartist.Bar('#chart2', {
	labels: the_labels,
	series: [the_series]
	});	
	 
	<?php
	
	$query = "select 
                sum(total) total_sum,
                sum(active) total_active,
                sum(show_price) total_show_price,
                sum(not_show_price) total_not_show_price
			from
			(select 
							1 total, 
							case when status='1' then 1 else 0 end as active,
							case when show_price='1' then 1 else 0 end as show_price,
							case when show_price!='1' then 1 else 0 end as not_show_price
			from products 
			where category in (select id from sub_category where main_category = 1)) C1
			union all
			select 
							sum(total) total_sum,
							sum(active) total_active,
							sum(show_price) total_show_price,
							sum(not_show_price) total_not_show_price
			from
			(select 
							1 total, 
							case when status='1' then 1 else 0 end as active,
							case when show_price='1' then 1 else 0 end as show_price,
							case when show_price!='1' then 1 else 0 end as not_show_price
			from products 
			where category in (select id from sub_category where main_category = 2)) C2
			union all
			select 
							sum(total) total_sum,
							sum(active) total_active,
							sum(show_price) total_show_price,
							sum(not_show_price) total_not_show_price
			from
			(select 
							1 total, 
							case when status='1' then 1 else 0 end as active,
							case when show_price='1' then 1 else 0 end as show_price,
							case when show_price!='1' then 1 else 0 end as not_show_price
			from products 
			where category in (select id from sub_category where main_category = 3)) C3
			union all
			select 
							sum(total) total_sum,
							sum(active) total_active,
							sum(show_price) total_show_price,
							sum(not_show_price) total_not_show_price
			from
			(select 
							1 total, 
							case when status='1' then 1 else 0 end as active,
							case when show_price='1' then 1 else 0 end as show_price,
							case when show_price!='1' then 1 else 0 end as not_show_price
			from products 
			where category in (select id from sub_category where main_category = 4)) C4";
		
	$the_data = array();		
	$results_the_data = mysqli_query($conn, $query); 	
	
	while($line = mysqli_fetch_assoc($results_the_data)){
		$the_data[] = $line;
	}	
	
   ?>	
	
	var js_the_data_chart3  = <?php echo json_encode( $the_data ) ?>;
	
	var the_series = [];
	var the_series2 = [];
	var the_series3 = [];
	var the_series4 = [];
	
	for(var i=0 ; i<js_the_data_chart3.length ; i++)
	{					
		the_series[i] = js_the_data_chart3[i].total_sum;
		the_series2[i] = js_the_data_chart3[i].total_active;
		the_series3[i] = js_the_data_chart3[i].total_show_price;
		the_series4[i] = js_the_data_chart3[i].total_not_show_price;		
	}
	
	// statistics update
	document.getElementById("total_sum_1").innerHTML = the_series[0];
	document.getElementById("total_sum_2").innerHTML = the_series[1];
	document.getElementById("total_sum_3").innerHTML = the_series[2];
	document.getElementById("total_sum_4").innerHTML = the_series[3];
	
	document.getElementById("total_active_1").innerHTML = the_series2[0];
	document.getElementById("total_active_2").innerHTML = the_series2[1];
	document.getElementById("total_active_3").innerHTML = the_series2[2];
	document.getElementById("total_active_4").innerHTML = the_series2[3];	
	
	document.getElementById("total_show_price_1").innerHTML = the_series3[0];
	document.getElementById("total_show_price_2").innerHTML = the_series3[1];
	document.getElementById("total_show_price_3").innerHTML = the_series3[2];
	document.getElementById("total_show_price_4").innerHTML = the_series3[3];	
	
	document.getElementById("total_not_show_price_1").innerHTML = the_series4[0];
	document.getElementById("total_not_show_price_2").innerHTML = the_series4[1];
	document.getElementById("total_not_show_price_3").innerHTML = the_series4[2];
	document.getElementById("total_not_show_price_4").innerHTML = the_series4[3];

	document.getElementById("grand_total_sum").innerHTML = Number(the_series[0]) + 
															Number(the_series[1]) + 
															Number(the_series[2]) + 
															Number(the_series[3]);	
															
	document.getElementById("total_sum").innerHTML = Number(the_series[0]) + 
															Number(the_series[1]) + 
															Number(the_series[2]) + 
															Number(the_series[3]);

	document.getElementById("total_active").innerHTML = Number(the_series2[0]) + 
															Number(the_series2[1]) + 
															Number(the_series2[2]) + 
															Number(the_series2[3]);															
	
	document.getElementById("total_show_price").innerHTML = Number(the_series3[0]) + 
															Number(the_series3[1]) + 
															Number(the_series3[2]) + 
															Number(the_series3[3]);		
	
	document.getElementById("total_not_show_price").innerHTML = Number(the_series4[0]) + 
															Number(the_series4[1]) + 
															Number(the_series4[2]) + 
															Number(the_series4[3]);	
	
	var data_chart3 = {
	  labels: ['Изделия из серебра', 'Изделия из позолоты', 'Изделия из камней', 'Модные украшения'],
		series: [the_series, the_series2, the_series3, the_series4]
	};

	var options_chart3 = {
	  seriesBarDistance: 15
	};

	var responsiveOptions_chart3 = [
	  ['screen and (min-width: 641px) and (max-width: 1024px)', {
		seriesBarDistance: 10,
		axisX: {
		  labelInterpolationFnc: function (value) {
			return value;
		  }
		}
	  }],
	  ['screen and (max-width: 640px)', {
		seriesBarDistance: 5,
		axisX: {
		  labelInterpolationFnc: function (value) {
			return value[0];
		  }
		}
	  }]
	];

	new Chartist.Bar('#chart3', data_chart3, options_chart3, responsiveOptions_chart3);	 
	 
	</script> 
    
	<?php 
		$conn->close();		
	?>
</html>
