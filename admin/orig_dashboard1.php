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
	
	function refresh_dashboard1_main()
	{

		var strHTML = document.getElementById("loade_r").innerHTML;
	
		if (strHTML.indexOf("refresh_b") > 0) return;
	
		document.getElementById("loade_r").innerHTML = '<img style="margin-top:-3px;" width="30" height="30" src="assets/img/refresh_b.gif" border="0">';
	
		var http = new XMLHttpRequest();
		var url = "dashboard1_data_main.php";
		var params = null;
		http.open("POST", url, true);
	
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		http.onreadystatechange = function() {
			if(http.readyState == 4 && http.status == 200) {
			
				  // alert(http.responseText);			  
				  // location.reload(true);
				  refresh_dashboard1();
				  
				  document.getElementById("loade_r").innerHTML = '<img style="margin-top:-3px;" width="30" height="30" src="assets/img/refresh_a.gif" border="0">';
			}
		}
		http.send(params);	
	}
	
	
	function refresh_dashboard1()
	{
	
		document.getElementById("chart400").style.display = "none";
		document.getElementById("chart1").style.display = "none";
		document.getElementById("chart2").style.display = "none";
		document.getElementById("chart3").style.display = "none";
		document.getElementById("chart4").style.display = "none";
		document.getElementById("chart10").style.display = "none";
		document.getElementById("div_n_of_vis").style.display = "none";
		document.getElementById("div_n_of_uniq_vis").style.display = "none";
		document.getElementById("div_n_products").style.display = "none";
		document.getElementById("div_n_feedbacks").style.display = "none";
		$('#cont_chart400').append('<img src="assets/img/loading.gif" class="img-responsive center-block" id="loader400">');	
		$('#cont_chart1').append('<img src="assets/img/loading.gif" class="img-responsive center-block" id="loader1">');	
		$('#cont_chart2').append('<img src="assets/img/loading.gif" class="img-responsive center-block" id="loader2">');
		$('#cont_chart3').append('<img src="assets/img/loading.gif" class="img-responsive center-block" id="loader3">');
		$('#cont_chart4').append('<img src="assets/img/loading.gif" class="img-responsive center-block" id="loader4">');
		$('#cont_chart10').append('<img src="assets/img/loading.gif" class="img-responsive center-block" id="loader10">');
		$('#cont_n_of_vis').append('<img src="assets/img/loading.gif" class="img-responsive center-block" id="loadern_of_vis">');
		$('#cont_n_of_uniq_vis').append('<img src="assets/img/loading.gif" class="img-responsive center-block" id="loadern_of_uniq_vis">');
		$('#cont_n_products').append('<img src="assets/img/loading.gif" class="img-responsive center-block" id="loadern_products">');
		$('#cont_n_feedbacks').append('<img src="assets/img/loading.gif" class="img-responsive center-block" id="loadern_feedbacks">');
	
		var http = new XMLHttpRequest();
		var url = "dashboard1_data.php";
		var params = null;
		http.open("POST", url, true);
	
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		http.onreadystatechange = function() {
			if(http.readyState == 4 && http.status == 200) {
			
				  // alert(http.responseText);			  
				  // location.reload(true);
				  
			  var response_data = JSON.parse(http.responseText);
			  
			  $('#loader1').remove();
			  $('#loader2').remove();
			  $('#loader3').remove();
			  $('#loader4').remove();
			  $('#loader10').remove();
			  $('#loader400').remove();
			  $('#loadern_of_vis').remove();
			  $('#loadern_of_uniq_vis').remove();
			  $('#loadern_products').remove();
			  $('#loadern_feedbacks').remove();			  
			  			  
				// data1
				var js_the_data_chart1 = response_data.the_data1;	

				var the_labels = [];
				var the_series = [];
				  
				for(var i=0 ; i<js_the_data_chart1.length ; i++)
				{			
					the_labels.push(js_the_data_chart1[i].d_of_week);
					the_series.push(js_the_data_chart1[i].n_of_uniq_visitors);			
				}	  
					  
				new Chartist.Line('#chart1', {
				labels: the_labels,
				series: [the_series]
				});	

				// data2	  
				var js_the_data_chart2 = response_data.the_data2; 

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

				// data3
				var js_the_data_chart3 = response_data.the_data3; 	

				var the_labels = [];
				var the_series = [];
				  
				for(var i=0 ; i<js_the_data_chart3.length ; i++)
				{			
					the_labels.push(js_the_data_chart3[i].dwname);
					the_series.push(js_the_data_chart3[i].n_of_uniq_visitors);			
				} 

				new Chartist.Bar('#chart3', {
				labels: the_labels,
				series: [the_series]
				}); 

				// data4
				var js_the_data_chart4 = response_data.the_data4; 

				var the_labels = [];
				var the_series = [];
				  
				for(var i=0 ; i<js_the_data_chart4.length ; i++)
				{			
					the_labels.push(js_the_data_chart4[i].hh24);
					the_series.push(js_the_data_chart4[i].n_of_uniq_visitors);			
				} 

				new Chartist.Line('#chart4', {
				labels: the_labels,
				series: [the_series]
				}); 	

				// data10
				var js_the_data_chart10 = response_data.the_data10;	

				var the_labels = [];
				var the_series = [];
				  
				for(var i=0 ; i<js_the_data_chart10.length ; i++)
				{			
					the_labels.push(js_the_data_chart10[i].name);
					the_series.push(js_the_data_chart10[i].n_of_products);			
				} 

				new Chartist.Bar('#chart10', {
					labels: the_labels,
					series: [the_series]
				}); 			  

				// data400
				var js_the_data_chart400 = response_data.the_data400;

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
				
			   document.getElementById("chart400").style.display = "block";
			   document.getElementById("chart1").style.display = "block";
			   document.getElementById("chart2").style.display = "block";
			   document.getElementById("chart3").style.display = "block";
			   document.getElementById("chart4").style.display = "block";
			   document.getElementById("chart10").style.display = "block";
			   
			  
			   document.getElementById("div_n_of_vis").innerHTML = '<p>Посещений</p>'+response_data.n_of_vis;
			   document.getElementById("div_n_of_vis").style.display = "block";
			   
			   document.getElementById("div_n_of_uniq_vis").innerHTML = '<p>Уникальные</p>'+response_data.n_of_uniq_vis;
			   document.getElementById("div_n_of_uniq_vis").style.display = "block";
			   
			   document.getElementById("div_n_products").innerHTML = '<p>Товаров</p>'+response_data.n_products;
			   document.getElementById("div_n_products").style.display = "block";

			   document.getElementById("div_n_feedbacks").innerHTML = '<p>Отзывов</p>'+response_data.n_feedbacks;
			   document.getElementById("div_n_feedbacks").style.display = "block";	
				
				
			}
		}
		http.send(params);	
	}
	
	</script>
	
</head>
<body onload="refresh_dashboard1();" >

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
					<a class="navbar-brand" href="#" onClick="refresh_dashboard1_main();" style="margin-left:10px;"><span id='loade_r'><img style="margin-top:-3px;" width="30" height="30" src="assets/img/refresh_a.gif" border="0"></span></a>
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

					<!-- Icons start --->
					
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-warning text-center">
                                            <i class="ti-server"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7" id="cont_n_of_vis">
                                        <div class="numbers" id="div_n_of_vis" >
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
                                            <i class="ti-pulse"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7" id="cont_n_of_uniq_vis">
                                        <div class="numbers" id="div_n_of_uniq_vis" >
                                            <p>Уникальные </p>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i> Последние 30 дней
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
                                            <i class="ti-wallet"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7" id="cont_n_products">
                                        <div class="numbers" id="div_n_products">
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
					
					<!-- Icons end --->
					
	
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
	
                   <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Уникальные посетители за неделю</h4>
                                <p class="category">Кол-во уник. посетителей за посл. неделю</p>
                            </div>
                            <div class="content" id="cont_chart1">
                                <div id="chart1" class="ct-chart ct-perfect-fourth"></div>

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Последняя неделя
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
						<div class="card">
                            <div class="header">
                                <h4 class="title">Уникальные посетители за месяц</h4>
                                <p class="category">Кол-во уникальных посетителей за месяц</p>
                            </div>
                            <div class="content" id="cont_chart2">
                                <div id="chart2" class="ct-chart ct-perfect-fourth"></div>

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Последний месяц
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                
				
                   <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Посетители по дням недели</h4>
                                <p class="category">Кол-во уникальных посетителей по дням недели</p>
                            </div>
                            <div class="content" id="cont_chart3">
                                <div id="chart3" class="ct-chart ct-perfect-fourth"></div>

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Последний месяц
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
						<div class="card">
                            <div class="header">
                                <h4 class="title">Посетители по часам</h4>
                                <p class="category">Кол-во уникальных посетителей по часам</p>
                            </div>
                            <div class="content" id="cont_chart4">
                                <div id="chart4" class="ct-chart ct-perfect-fourth"></div>

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
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Товары по категориям</h4>
                                <p class="category">Распределение товаров по категориям</p>
                            </div>
                            <div class="content" id="cont_chart10">
                                <div id="chart10" class="ct-chart"></div>

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
						  

                   <div class="col-md-12">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Топ 15 IP адресов, посещающих сайт</h4>
                                <p class="category">Топ 15 IP адресов, посещающих сайт, последние 30 дней</p>
                            </div>
                            <div class="content">
                                <div id="eee" >
								
								<div style="overflow-x:auto;">
								<table class="table table-striped">
									<thead>
									  <tr>
										<th>IP адрес</th>
										<th>Кол-во визитов</th>									
									  </tr>
									</thead>
									<tbody>
	
										<?php
										
										$sql = "select *
												from 
												(
												select ip_addr, count(1) n_of_clicks
												from businesslog_logins_rep
												where  datex >= (now() + INTERVAL 10 HOUR - INTERVAL 30 DAY)												
												group by ip_addr
												order by 2 desc) M
												limit 0, 15";
														
										$result = $conn->query($sql);
										
										if ($result->num_rows > 0)
										{
										
											while($row = $result->fetch_assoc()) 
											{								
										
										?>									  
									  
										<tr>
										<td><a href="http://www.geoplugin.net/json.gp?ip=<?php echo $row["ip_addr"]; ?>" target="_blank"><?php echo $row["ip_addr"]; ?></a></td>
										<td><?php echo $row["n_of_clicks"]; ?></td>
										</tr>
										
										<?php
										
											}
										}
										
										?>
																			  									  
									</tbody>
								  </table>		
								  </div>
								
								</div>

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Последний месяц
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
	/*
	$(document).ready(function(){
		
		$.notify({
			icon: 'pe-7s-gift',
			message: "Добро пожаловать в панель управления сайтом <b>Crystal Sky</b>! <i>Очень</i> хорошей работы!"

		},{
			type: 'info',
			timer: 4000
		});

	});*/
	
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
