<?php session_start(); 

if (!$_SESSION['auth_login'])
{
	header("Location: index.php");
	exit;
}

?>

<?php
	require_once("./../db_connect.php");

	// page number
	//
	if (!$_GET["p"]) 
	{
		$p = 0;
	}
	else
	{				
		$p = $_GET['p'];
					
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
	
	$n_results_on_page = 7;
	
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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
	
	
<script>
function ajax_post()
	{
		var nErrors =0;
				
		if (document.getElementById("coupon_name").value==null || document.getElementById("coupon_name").value=="")
		{					
			document.getElementById("coupon_name").style.borderColor = "red";
			document.getElementById("coupon_name").style.boxShadow = "2px 2px 2px lightgray";
			nErrors++;
		}
		else
		{
			var str=document.getElementById("coupon_name").value;
			var n= str.length;
			var specialChars = "<>@!#$%^&*()_+[]{}?:;|'\"\\,./~`-=";
			
			var nErrSpecChars = 0;
			
			for(i = 0; i < specialChars.length;i++)
			{
				if(str.indexOf(specialChars[i]) > -1)
				{
					nErrSpecChars++;
				}
			}
			
			if (n > 10 || str.indexOf(' ')>=0 || nErrSpecChars>0)
			{			
				document.getElementById("coupon_name").style.borderColor = "red";
				document.getElementById("coupon_name").style.boxShadow = "3px 3px 3px lightgray";
				nErrors++;						
			}			
			else
			{
				document.getElementById("coupon_name").style.borderColor = "green";
				document.getElementById("coupon_name").style.boxShadow = "2px 2px 2px lightgray";
			}
		}

			
		
		if (document.getElementById("coupon_type").value==null || document.getElementById("coupon_type").value=="")
		{					
			document.getElementById("coupon_type").style.borderColor = "red";
			document.getElementById("coupon_type").style.boxShadow = "2px 2px 2px lightgray";
			nErrors++;
		}
		else
		{
			document.getElementById("coupon_type").style.borderColor = "green";
			document.getElementById("coupon_type").style.boxShadow = "2px 2px 2px lightgray";
		}		

		if (document.getElementById("coupon_period").value==null || document.getElementById("coupon_period").value=="")
		{					
			document.getElementById("coupon_period").style.borderColor = "red";
			document.getElementById("coupon_period").style.boxShadow = "2px 2px 2px lightgray";
			nErrors++;
		}
		else
		{
			document.getElementById("coupon_period").style.borderColor = "green";
			document.getElementById("coupon_period").style.boxShadow = "2px 2px 2px lightgray";
		}			
		
		if (nErrors==0)
		{
			
			// Create our XMLHttpRequest object
			var hr = new XMLHttpRequest();
			// Create some variables we need to send to our PHP file
			var url = "create_new_coupon.php";
			var cn = document.getElementById("coupon_name").value;			
			var ct = document.getElementById("coupon_type").value;			
			var cp = document.getElementById("coupon_period").value;			
			
			var vars = "cn="+cn+"&ct="+ct+"&cp="+cp;
			hr.open("POST", url, true);
			// Set content type header information for sending url encoded variables in the request
			hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			// Access the onreadystatechange event for the XMLHttpRequest object
			hr.onreadystatechange = function() {
				if(hr.readyState == 4 && hr.status == 200) {
					var return_data = hr.responseText;
												
					// alert('return_data= '+return_data);

					$('#myModalNewRecord').modal('hide');
					
					//location.reload(true);
					location.replace("dashboard3.php");
				}
			}
			// Send the data to PHP now... and wait for response to update the status div			
			hr.send(vars); // Actually execute the request						
		}
	}	
	
	
	function cancelCoupon(n, s)
	{	
		if (s==1)
		{
			// Create our XMLHttpRequest object
			var hr = new XMLHttpRequest();
			// Create some variables we need to send to our PHP file
			var url = "CancelCoupon.php";			
			
			var vars = "recn="+n;
			hr.open("POST", url, true);
			// Set content type header information for sending url encoded variables in the request
			hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			// Access the onreadystatechange event for the XMLHttpRequest object
			hr.onreadystatechange = function() {
				if(hr.readyState == 4 && hr.status == 200) {
					var return_data = hr.responseText;
												
					// alert('return_data= '+return_data);							
					
					// $('#myModalEditRecord').modal('show');
					
					// refresh...
					
					location.replace("dashboard3.php");
					
				}
			}
			// Send the data to PHP now... and wait for response to update the status div			
			hr.send(vars); // Actually execute the request	
		}
		
		if (s==0)
		{
			// Create our XMLHttpRequest object
			var hr = new XMLHttpRequest();
			// Create some variables we need to send to our PHP file
			var url = "ReactivateCoupon.php";			
			
			var vars = "recn="+n;
			hr.open("POST", url, true);
			// Set content type header information for sending url encoded variables in the request
			hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			// Access the onreadystatechange event for the XMLHttpRequest object
			hr.onreadystatechange = function() {
				if(hr.readyState == 4 && hr.status == 200) {
					var return_data = hr.responseText;
												
					// alert('return_data= '+return_data);							
					
					// $('#myModalEditRecord').modal('show');
					
					// refresh...
					
					location.replace("dashboard3.php");
					
				}
			}
			// Send the data to PHP now... and wait for response to update the status div			
			hr.send(vars); // Actually execute the request	
		}		
	}
	
</script>	
	
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="grey" data-image="assets/img/sidebar-5.jpg">

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="dashboard1.php" class="simple-text">
                    "Crystal Sky"
                </a>
            </div>

            <ul class="nav">

                <li>
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

                <li class="active">
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
                    <a class="navbar-brand" href="#">Купоны</a> 
					<a class="navbar-brand" href="dashboard3.php" style="margin-left:10px;"><span class="glyphicon glyphicon-refresh"></span></a>
					<div id="retroclockbox1" style="margin-left:8px; margin-top:-2px;" class="navbar-brand"></div>
					<a class="navbar-brand" href="https://crystalsky.co.il" target='_blank' style="margin-left:10px;">перейти в магазин...</a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">

						<!--
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Options
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Recent Hour</a></li>
                                <li><a href="#">Recent 6 Hours</a></li>
                                <li><a href="#">Recent Day</a></li>
                                <li><a href="#">Recent Week</a></li>
                                <li><a href="#">Recent Month</a></li>
								<li><a href="#">Recent 6 Month</a></li>
								<li><a href="#">Recent Year</a></li>                                
								<li><a href="#">All History</a></li> 
                              </ul>
                        </li>
						-->

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

                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Купоны магазина "Crystal Sky"</h4>
                                <p class="category">Эти купоны могут быть использованны при покупке в магазине "Crystal Sky". Купоны не работают на товары по скидке (отмечены красной ленточкой). Купоны работают только на те товары, которые не по скидке.</p>
                            </div>
                            <div class="content" style="overflow-x:auto;">   

								  <table class="table table-striped">
									<thead>
									  <tr>
										<th>Номер</th>
										<th>Купон</th>
										<th>Назначение</th>
										<th>Начало</th>
										<th>Окончание</th>
										<th>Статус</th>
										<th>
											<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModalNewRecord">
												Добавить
											</button>											
										</th>
									  </tr>
									</thead>
									<tbody>
									 
							
								<?php
								
								// Create connection
								$conn = new mysqli($servername, $username, $password, $dbname);
								// Check connection
								if ($conn->connect_error) {
									die("Connection failed: " . $conn->connect_error);
								} 

								$conn->query("set names 'utf8'");
								
																
								$sql0="select count(1) n_of_r from coupons x";								
								$result0 = $conn->query($sql0);
								$row0 = $result0->fetch_assoc();								
								$total_results = $row0["n_of_r"];									
								
								$sql = "select * from (select x.*, DATE_FORMAT(x.start_dt,'%d/%m/%Y') as the_start_dt ,  DATE_FORMAT(x.exp_dt,'%d/%m/%Y') as the_end_dt from coupons x order by id desc) M limit ".$p*$n_results_on_page.", ".$n_results_on_page;
								$result = $conn->query($sql);
								
								$first_page=0;
								$last_page=ceil($total_results/$n_results_on_page)- 1;
								
								if (($p+1) < ceil($total_results/$n_results_on_page))
								{	
									$nxt_page =$p+1;
									$prv_page = $p-1;
									if ($prv_page < 0) $prv_page=0;
								}	
							 
								if (($p+1) == ceil($total_results/$n_results_on_page))
								{	
									$nxt_page =$p;
									$prv_page = $p-1;
									if ($prv_page < 0) $prv_page=0;
								}
							 
								if ($nxt_page < 0)
								{
									$nxt_page =1;
									$prv_page =0;
								}
								
								if (1 == ceil($total_results/$n_results_on_page))
								{	
									$nxt_page =0;
									$prv_page = 0;
								}	
								
								if ($result->num_rows > 0)
								{
								
									while($row = $result->fetch_assoc()) 
									{
								
								?>	
										<tr>
										<td><?php echo $row["id"]; ?></td>
										<td><?php echo $row["name"]; ?></td>
										<td><?php echo $row["display_name"]; ?></td>
										<td><?php echo $row["the_start_dt"]; ?></td>
										<td><?php echo $row["the_end_dt"]; ?></td>
										<td><?php echo $row["status"]; ?></td>
										<td>
											<button type="button" class="btn btn-success btn-sm" onClick="cancelCoupon('<?php echo $row["name"]; ?>', <?php echo $row["status"]; ?>);">
												<?php 
													if ($row["status"]==1)
													{
												?>
													Деактивировать
												<?php
													}
													else
													{
												?>
													Активировать
												<?
													}
												?>
											</button>										
										</td>
										</tr>											
								 
								<?php
								
									}
								
								}
								
								$conn->close();								
								
								?>
								
								
									  									  
									</tbody>
								  </table>
								
								<!-- pager -->
								<nav>
								  <ul class="pager">
									<li><a href="dashboard3.php?p=<?php echo $first_page; ?>">Начало</a></li>
									<li><a href="dashboard3.php?p=<?php echo $prv_page; ?>">Предыдущая</a></li>
									<li><a href="dashboard3.php?p=<?php echo $p; ?>">Это <?php echo ($p+1); ?> страница</a></li>
									<li><a href="dashboard3.php?p=<?php echo $nxt_page; ?>">Следующая</a></li>
									<li><a href="dashboard3.php?p=<?php echo $last_page; ?>">Конец</a></li>
								  </ul>
								</nav>
								<!-- pager -->
								
                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> <b><?php echo $n_results_on_page; ?></b> результатов на странице; всего <b><?php echo $total_results; ?></b> результатов.
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



<!-- Start Modal New Record -->
<div class="modal fade" id="myModalNewRecord" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Создать новый купон
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form role="form" data-toggle="validator" id="CreateNewCoupon">
						
					<div class="form-group">
						<label >Тип</label>
						<div >
							<select class="form-control" id="coupon_type" name="coupon_type">
								<option value="">Выберете...</option>
								<option value="t1_10">Подарок 10 шекелей</option>
								<option value="t1_20">Подарок 20 шекелей</option>
								<option value="t1_50">Подарок 50 шекелей</option>
								<option value="t1_75">Подарок 75 шекелей</option>
								<option value="t1_100">Подарок 100 шекелей</option>
								<option value="t2_5">Скидка 5%</option>
								<option value="t2_10">Скидка 10%</option>
								<option value="t2_15">Скидка 15%</option>
								<option value="t2_20">Скидка 20%</option>
								<option value="t2_25">Скидка 25%</option>
								<option value="t2_30">Скидка 30%</option>
								<option value="t2_50">Скидка 50%</option>
								<option value="t3_10_100">Бонус 10 шек. при покупке на сумму более 100 шек.</option>
								<option value="t3_20_100">Бонус 20 шек. при покупке на сумму более 100 шек.</option>
								<option value="t3_20_200">Бонус 20 шек. при покупке на сумму более 200 шек.</option>
								<option value="t3_30_200">Бонус 30 шек. при покупке на сумму более 200 шек.</option>
								<option value="t3_30_300">Бонус 30 шек. при покупке на сумму более 300 шек.</option>
								<option value="t3_40_300">Бонус 40 шек. при покупке на сумму более 300 шек.</option>
								<option value="t3_50_300">Бонус 50 шек. при покупке на сумму более 300 шек.</option>
								<option value="t4_5_100">Скидка 5% на покупку более 100 шекелей</option>							
								<option value="t4_10_100">Скидка 10% на покупку более 100 шекелей</option>
								<option value="t4_15_100">Скидка 15% на покупку более 100 шекелей</option>
								<option value="t4_5_200">Скидка 5% на покупку более 200 шекелей</option>
								<option value="t4_10_200">Скидка 10% на покупку более 200 шекелей</option>
								<option value="t4_15_200">Скидка 15% на покупку более 200 шекелей</option>
								<option value="t4_20_200">Скидка 20% на покупку более 200 шекелей</option>
								<option value="t4_10_300">Скидка 10% на покупку более 300 шекелей</option>
								<option value="t4_15_300">Скидка 15% на покупку более 300 шекелей</option>
								<option value="t4_20_300">Скидка 20% на покупку более 300 шекелей</option>
							</select>
						</div>
					</div>
				
					<div id="inp_coupon_name" class="form-group">
						<label for="exampleInputCouponType">Наименование Купона (уникальная комбинация букв и цифр без пробелов)</label>
						  <input type="email" class="form-control"
						  id="coupon_name" placeholder="Например, DXSY10PCT"/>
					</div>

					<div class="form-group">
						<label >Срок Действия Купона</label>
						<div >
							<select class="form-control" id="coupon_period" name="coupon_period">
								<option value="">Выберете...</option>
								<option value="stdt_1">Немедленно, без ограничения по времени</option>
								<option value="stdt_2">Немедленно, с окончанием через неделю</option>
								<option value="stdt_3">Немедленно, с окончанием через месяц</option>								
							</select>
						</div>
					</div>					

                </form>
				

            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Я передумал, не создавать!
                </button>
                <button type="button" onclick="ajax_post(); return false;" class="btn btn-primary">
                    Создать новый купон
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal New Record -->

</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>	
	
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>
		
	<script type="text/javascript" src="assets/js/jquery.flipcountdown.js"></script>
		
	<script type="text/javascript">	
		

	/*
	$(document).ready(function(){
			
		$.notify({
			icon: 'pe-7s-gift',
			message: "Добро пожаловать в панель управления<br/> сайтом <b>Crystal Sky</b>! Хорошей работы!"

		},{
			type: 'info',
			timer: 4000
		});
	}); */
	
	$(function(){
		$("#retroclockbox1").flipcountdown({
			size:"sm"
		});
	})
	
	</script> 
    

</html>
