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

	function getFBdetails(n)
	{		 
		// alert('return_data= '+return_data);				
		document.getElementById("the_info").innerHTML=n;			
		$('#myModalFeedbackDetails').modal('show');			 
	}

	function cancelFeedback(n, s, un, uc, ft)
	{	
		if (s==1)
		{
			// Create our XMLHttpRequest object
			var hr = new XMLHttpRequest();
			// Create some variables we need to send to our PHP file
			var url = "CancelFeedback.php";			
			
			var vars = "recn="+n+"&un="+un+"&uc="+uc+"&ft="+ft;
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
					
					location.replace("dashboard6.php");
					
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
			var url = "ReactivateFeedback.php";			
			
			var vars = "recn="+n+"&un="+un+"&uc="+uc+"&ft="+ft;
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
					
					location.replace("dashboard6.php");
					
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

                <li>
                    <a href="dashboard3.php">
                        <i class="pe-7s-cash"></i>
                        <p>Купоны</p>
                    </a>
                </li>  

                <li class="active">
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
                    <a class="navbar-brand" href="#">Отзывы</a> 
					<a class="navbar-brand" href="dashboard6.php" style="margin-left:10px;"><span class="glyphicon glyphicon-refresh"></span></a>
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
                                <h4 class="title">Отзывы магазина "Crystal Sky"</h4>
                                <p class="category">Управление отзывами клиентов магазине "Crystal Sky"</p>
                            </div>
                            <div class="content" style="overflow-x:auto;">   

								  <table class="table table-striped">
									<thead>
									  <tr>
										<th>Номер</th>
										<th>Дата</th>
										<th>Емайл</th>
										<th>Имя</th>
										<th>Город</th>
										<th>Заголовок</th>										
										<th>Статус</th>
										<th>
											+
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
								
																
								$sql0="select count(1) n_of_r from feedbacks x";								
								$result0 = $conn->query($sql0);
								$row0 = $result0->fetch_assoc();								
								$total_results = $row0["n_of_r"];									
								
								$sql = "select * from (select x.*, DATE_FORMAT(x.datex,'%d/%m/%Y') as the_start_dt from feedbacks x order by id desc) M limit ".$p*$n_results_on_page.", ".$n_results_on_page;
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
										<td><a href="#" onClick="getFBdetails('<?php echo $row["feedback_msg"]; ?>');"><?php echo $row["id"]; ?></a></td>
										<td><?php echo $row["the_start_dt"]; ?></td>										
										<td><?php echo $row["email"]; ?></td>
										<td><?php echo $row["user_name"]; ?></td>
										<td><?php echo $row["user_city"]; ?></td>
										<td><?php echo $row["feedback_title"]; ?></td>
										<td><?php echo $row["status"]; ?></td>
										<td>
											<button type="button" class="btn btn-success btn-sm" onClick="cancelFeedback('<?php echo $row["id"]; ?>', <?php echo $row["status"]; ?>, '<?php echo $row["user_name"]; ?>', '<?php echo $row["user_city"]; ?>', '<?php echo $row["feedback_title"]; ?>');">
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
									<li><a href="dashboard6.php?p=<?php echo $first_page; ?>">Начало</a></li>
									<li><a href="dashboard6.php?p=<?php echo $prv_page; ?>">Предыдущая</a></li>
									<li><a href="dashboard6.php?p=<?php echo $p; ?>">Это <?php echo ($p+1); ?> страница</a></li>
									<li><a href="dashboard6.php?p=<?php echo $nxt_page; ?>">Следующая</a></li>
									<li><a href="dashboard6.php?p=<?php echo $last_page; ?>">Конец</a></li>
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



<!-- Start Modal Details Record -->
<div class="modal fade" id="myModalFeedbackDetails" tabindex="-1" role="dialog" 
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
                    Отзыв
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body" id="the_info">
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Ок
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Details Record -->

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
