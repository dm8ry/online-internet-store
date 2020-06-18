<?php session_start(); 

if (!$_SESSION['auth_login'])
{
	header("Location: index.php");
	exit;
}

?>

<?php
	require_once("./../db_connect.php");

	$recs_on_screen = array();
	
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

// confirm delete record


/// change_the_product
function change_the_currency ()
{

	var nErrors =0;
					
	// check post_title
	if (document.getElementById("rate").value==null || document.getElementById("rate").value=="")
	{					
		document.getElementById("rate").style.borderColor = "red";
		document.getElementById("rate").style.boxShadow = "2px 2px 2px lightgray";
		nErrors++;
	}
	else
	{	
		var regex  = /^\d+(?:\.\d{0,2})$/;
		var numStr = document.getElementById("rate").value;
		if (regex.test(numStr))
		{
			document.getElementById("rate").style.borderColor = "green";
			document.getElementById("rate").style.boxShadow = "2px 2px 2px lightgray";	
		}
		else
		{
			document.getElementById("rate").style.borderColor = "red";
			document.getElementById("rate").style.boxShadow = "2px 2px 2px lightgray";		
			nErrors++;
		}
	}		
							
	if (nErrors==0)
	{					
		var url = "update_the_currency.php";
					
		var oData = new FormData(document.forms.namedItem("EditCurrency"));
		
		var oReq = new XMLHttpRequest();
		  oReq.open("POST", url, true);
		  oReq.onload = function(oEvent) {
								
			if (oReq.status == 200) 
			{																				
				// alert('....'+oReq.responseText);
			 
				$('#myModalCurrencyRate').modal('hide')
				window.location.replace("https://crystalsky.co.il/admin/dashboard10.php");
				return;								
 				
			} else {
			  alert("Error " + oReq.status + " occurred uploading your file.<br \/>");
			}
		  };

		oReq.send(oData); 
	}		

}
		
// limit input chars
function limit(element, n_max_chars)
{
	var max_chars = n_max_chars;

	if(element.value.length > n_max_chars) {
		element.value = element.value.substr(0, n_max_chars);
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

                <li class="active">
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
                    <a class="navbar-brand" href="#">Управление Валютами</a> 
					<a class="navbar-brand" href="dashboard10.php" style="margin-left:10px;"><span class="glyphicon glyphicon-refresh"></span></a>
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Управлением валютами магазина "Crystal Sky"</h4>
                                <p class="category">Управление валютами магазина "Crystal Sky", здесь можно изменить курс валют по отношению к шекелю.</p>
                            </div>
                            <div class="content"  style="overflow-x:auto;">   

								  <table class="table table-striped">
									<thead>
									  <tr>
										<th>Название</th>
										<th>Описание</th>
										<th>Знак</th>
										<th>Форматирование</th>										
										<th>Курс по отношению к Шекелю</th>
										<th>Статус</th>
										<th> + </th>
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
																										
										$sql = "select * from currencies";
										
										$result = $conn->query($sql);
																										
										if ($result->num_rows > 0)
										{
										
											while($row = $result->fetch_assoc()) 
											{
										
												$recs_on_screen[] = $row;
											
										?>	
												<tr>
												<td><?php echo $row["curr_name"]; ?></td>
												<td><?php echo $row["curr_desc"]; ?></td>
												<td><?php echo $row["curr_sign"]; ?></td>
												
												<?
													if ($row["sign_place"] == 'r')
													{
												?>
												
													<td><?php echo "123.45".$row["curr_sign"]; ?></td>
												
												<?
													}
													else
													{
												?>
													<td><?php echo $row["curr_sign"]."123.45"; ?></td>
													
												<?
													}
												?>
												
												<td><b><?php echo money_format('%i', $row["rate"]); ?></b>
												
												<?
													if ($row["sign_place"] == 'r')
													{												
												?>
														<br/><i>1<?php echo $row["curr_sign"]; ?>=<?php echo $row["rate"]; ?> Шек</i>
														<br/><i>10<?php echo $row["curr_sign"]; ?>=<?php echo 10*$row["rate"]; ?> Шек</i>
														<br/><i>100<?php echo $row["curr_sign"]; ?>=<?php echo 100*$row["rate"]; ?> Шек</i>
												<?
													}
													else
													{
												?>
														<br/><i><?php echo $row["curr_sign"]; ?>1=<?php echo $row["rate"]; ?> Шек</i>
														<br/><i><?php echo $row["curr_sign"]; ?>10=<?php echo 10*$row["rate"]; ?> Шек</i>
														<br/><i><?php echo $row["curr_sign"]; ?>100=<?php echo 100*$row["rate"]; ?> Шек</i>
												<?
													}
												?>
												</td>												
												<td><?php echo $row["status"]; ?></td>
												<td>
													<button type="button" class="btn btn-success btn-sm" onClick="editCurrency('<?php echo $row["id"]; ?>');">
														Изменить
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

<!--- image presenter --->

<div class="modal fade" tabindex="-1" role="dialog" id="imgPresenter" name="imgPresenter">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="imgPresenterTitle">Modal title</h4>
      </div>
      <div class="modal-body" id="imgPresenterBody" name="imgPresenterBody" style="margin-left:auto; margin-right:auto; text-align:center">       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--- image presenter --->


<!----- edit post for blog modal window start ----->

<!-- Start Modal New Record -->
<div class="modal fade" id="myModalCurrencyRate" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:70%; ">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Изменить курс валюты
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form role="form" data-toggle="validator" name="EditCurrency" enctype="multipart/form-data" method="post">
						
					<div>

					  <!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#aa" aria-controls="aa" role="tab" data-toggle="tab">Свойства</a></li>
						<!--
						<li role="presentation"><a href="#bb" aria-controls="bb" role="tab" data-toggle="tab">Дополнение #1</a></li>
						<li role="presentation"><a href="#cc" aria-controls="cc" role="tab" data-toggle="tab">Дополнение #2</a></li> -->						
						
					  </ul>

					  <!-- Tab panes -->
					  <div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="aa">
												
							<div>
							
								<div class="clearfix" style="margin-bottom:20px;"></div>
																								
								<input type="hidden" id="curr_rowid" name="curr_rowid" value="">
								<input type="hidden" id="curr_orig_rate" name="curr_orig_rate" value="">
							
								<div class="content"  style="overflow-x:auto;">  
							
								<!-- start главные свойства -->
								<table border='0' class="table" style="margin-left:auto; margin-right:auto">
									<tr>
										<td style="padding:5px;">
											<div id="inp_curr_name" class="form-group" >
												<label for="curr_name">Наименование</label>
												  <input class="form-control"
												  id="curr_name" name="curr_name" readonly />
											</div>									
										</td>
										<td style="padding:5px;">
											<div id="inp_curr_desc" class="form-group" >
												<label for="curr_desc">Описание</label>
												  <input class="form-control"
												  id="curr_desc" name="curr_desc" readonly />
											</div>									
										</td>
									</tr>
									<tr>
										<td style="padding:5px;">
											<div id="inp_curr_sign" class="form-group" >
												<label for="curr_sign">Знак</label>
												  <input class="form-control"
												  id="curr_sign" name="curr_sign" readonly />
											</div>									
										</td>
										<td style="padding:5px;">
											<div id="inp_status" class="form-group" >
												<label for="status">Статус <i>[0-неактивный; 1-активный]</i></label>
												  <input class="form-control"
												  id="status" name="status" readonly />
											</div>									
										</td>										
									</tr>
									<tr>
										<td style="padding:5px;" colspan='2'>
											<div id="inp_rate" class="form-group" >
												<label for="rate">Курс <i>[формат n.nn - например 1.00]</i>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.orbita.co.il/currency.php" target="_blank">Информация по курсу валют...</a></label>
												  <input class="form-control"
												  id="rate" name="rate" />
											</div>									
										</td>									
									</tr>									
								</table>
								<!-- end главные свойства -->
								
								</div> <!-- content -->
							
							</div>
						
						</div>
						<div role="tabpanel" class="tab-pane" id="bb">
						

						</div>
						<div role="tabpanel" class="tab-pane" id="cc">
			
						
						</div>

					  </div>

					</div>

                </form>
				

            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <div id="emdl_msg" name="emdl_msg" class="alert alert-danger pull-left" style="display:none;">                            
                </div>					
                <span id="sp_btn_001"><button type="button" class="btn btn-default"
                        data-dismiss="modal" id="btn_001">
                            Я передумал, не изменять!
                </button></span>               			
                &nbsp;<span id="sp_btn_003"><button type="submit" onclick="change_the_currency(); return false;" class="btn btn-primary" id="btn_002">
                   Изменить курс!
                </button></span>
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
	
	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>
		
	<script type="text/javascript" src="assets/js/jquery.flipcountdown.js"></script>
		
	

	<script type="text/javascript">
	
		// edit product dialog
		
		function editCurrency(n)
		{			
			
			// clean up red color...
					
			//document.getElementById("curr_rate").style.borderColor = "#e3e3e3";
			//document.getElementById("curr_rate").style.boxShadow = "none";
										
			var js_recs_on_screen = <?php echo json_encode($recs_on_screen) ?>;
			
			for(idx=0; idx<js_recs_on_screen.length; idx++)
			{
				if (js_recs_on_screen[idx]["id"] == n)
				{
				
					document.getElementById("curr_rowid").value=js_recs_on_screen[idx]["id"];
					document.getElementById("curr_name").value=js_recs_on_screen[idx]["curr_name"];
				 	document.getElementById("curr_desc").value=js_recs_on_screen[idx]["curr_desc"];
				 	document.getElementById("curr_sign").value=js_recs_on_screen[idx]["curr_sign"];
				// 	document.getElementById("sign_place").value=js_recs_on_screen[idx]["sign_place"];
				  	document.getElementById("rate").value=Number(js_recs_on_screen[idx]["rate"]).toFixed(2);					
					document.getElementById("curr_orig_rate").value=Number(js_recs_on_screen[idx]["rate"]).toFixed(2);					
					document.getElementById("status").value=js_recs_on_screen[idx]["status"];
				}
			}			
			
			$('#myModalCurrencyRate').modal('show');
		}		
	
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

