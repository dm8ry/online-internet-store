<?php session_start(); 

if (!$_SESSION['auth_login'])
{
	header("Location: index.php");
	exit;
} 

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

<style>
.flip-container {
  -webkit-perspective: 1000;
  -moz-perspective: 1000;
  -o-perspective: 1000;
  perspective: 1000;

	border: 1px solid #ccc;
}

	.flip-container:hover .flipper,  
  .flip-container.hover .flipper {
		-webkit-transform: rotateY(180deg);
		-moz-transform: rotateY(180deg);
    -o-transform: rotateY(180deg);
		transform: rotateY(180deg);
	}

.flip-container, .front, .back {
	width: 350px;
	height: 350px;
}

.flipper {
	-webkit-transition: 0.6s;
	-webkit-transform-style: preserve-3d;

	-moz-transition: 0.6s;
	-moz-transform-style: preserve-3d;
  
  -o-transition: 0.6s;
	-o-transform-style: preserve-3d;

	transition: 0.6s;
	transform-style: preserve-3d;

	position: relative;
}

.front, .back {
	-webkit-backface-visibility: hidden;
	-moz-backface-visibility: hidden;
  -o-backface-visibility: hidden;
	backface-visibility: hidden;

	position: absolute;
	top: 0;
	left: 0;
}

.front {	
	z-index: 2;
}

.back {
	-webkit-transform: rotateY(180deg);
	-moz-transform: rotateY(180deg);
  -o-transform: rotateY(180deg);
	transform: rotateY(180deg);

	background: #f8f8f8;
}

.front .name {
	font-size: 2em;
	display: inline-block;
	background: rgba(33, 33, 33, 0.9);
	color: #f8f8f8;
	font-family: Courier;
	padding: 5px 10px;
	border-radius: 5px;
	bottom: 60px;
	left: 25%;
	position: absolute;
	text-shadow: 0.1em 0.1em 0.05em #333;

	-webkit-transform: rotate(-20deg);
	-moz-transform: rotate(-20deg);
  -o-transform: rotate(-20deg);
	transform: rotate(-20deg);
}

.back-logo {
	position: absolute;
	top: 40px;
	left: 90px;
	width: 160px;
	height: 117px;	
}

.back-title {
	font-weight: bold;
	color: #00304a;
	position: absolute;
	top: 180px;
	left: 0;
	right: 0;
	text-align: center;
	text-shadow: 0.1em 0.1em 0.05em #acd7e5;
	font-family: Courier;
	font-size: 2em;
}

.back p {
	position: absolute;
	bottom: 40px;
	left: 0;
	right: 0;
	text-align: center;
	padding: 0 20px;
  font-family: arial;
  line-height: 2em;
}
</style>	
	
<script>

function processPhoto()
{			
	var size_positions = document.getElementsByName('size_position');
	var size_positions_value;
	for(var i = 0; i < size_positions.length; i++){
		if(size_positions[i].checked){
			size_positions_value = size_positions[i].value;
		}
	}	
	
	// alert("size_positions_value>>>> "+size_positions_value);
	
	var watermark_positions = document.getElementsByName('watermark_position');
	var watermark_positions_value;
	for(var i = 0; i < watermark_positions.length; i++){
		if(watermark_positions[i].checked){
			watermark_positions_value = watermark_positions[i].value;
		}
	}	
	
	// alert("watermark_positions_value>>>> "+watermark_positions_value);
	
	var url = "orig_file_process.php";
		
	var oData = new FormData(document.forms.namedItem("TheImageProcessor"));
	
	var oReq = new XMLHttpRequest();
	  oReq.open("POST", url, true);
	  oReq.onload = function(oEvent) {
	  
		if (oReq.status == 200) 
		{			
		
			var resp = oReq.responseText;
			
			if (resp.indexOf("Ошибка!") >=0)
			{
				// Error				 
			}
			else
			{
				// Everything is Good!	

				// alert('resp = '+ resp);
				
				document.getElementById("the_img1").src = resp;
				document.getElementById("the_img2").src = resp;
				document.getElementById("HrefProcessing").href = resp;	
				document.getElementById("the_file_name").value = resp;	
								
				var onlyName = resp.substring(resp.lastIndexOf("/") + 1);
				document.getElementById("HrefProcessing").download = onlyName;
				
				document.getElementById("watermark_tool").style.display = 'none';
				document.getElementById("size_tool").style.display = 'none';
				document.getElementById("button_tool").style.display = 'none';
				document.getElementById("uploader_tool").style.display = 'table-row';								
				
			}						
			
			return;					
		} else {
		  alert("Error: " + oReq.status);
		}
	  };
	oReq.send(oData); 		
	
}

function UploadOriginPhoto()
{
	var url = "orig_img_upload.php";
	
	document.getElementById("errorProcessing").innerHTML = "";

	var oData = new FormData(document.forms.namedItem("TheImageProcessor"));
	
	var oReq = new XMLHttpRequest();
	  oReq.open("POST", url, true);
	  oReq.onload = function(oEvent) {
	  
		if (oReq.status == 200) 
		{			
		
			var resp = oReq.responseText;
			
			if (resp.indexOf("Ошибка!") >=0)
			{
				// Error
				document.getElementById("errorProcessing").innerHTML = resp; 
				document.getElementById("the_img1").src = 'assets/img/place_holder_350_2.png';				
				document.getElementById("the_img2").src = 'assets/img/place_holder_350_2.png';
				document.getElementById("HrefProcessing").href = 'assets/img/place_holder_350_2.png';	
				document.getElementById("HrefProcessing").download = "CrystalSky.png";
				document.getElementById("the_file_name").value = 'assets/img/place_holder_350_2.png';		
			}
			else
			{
				// Everything is Good!
				document.getElementById("the_img1").src = resp;				
				document.getElementById("the_img2").src = resp;
				document.getElementById("HrefProcessing").href = resp;	
				document.getElementById("the_file_name").value = resp;	
				
				var onlyName = resp.substring(resp.lastIndexOf("/") + 1);
				document.getElementById("HrefProcessing").download = onlyName;
				
				document.getElementById("watermark_tool").style.display = 'table-row';
				document.getElementById("size_tool").style.display = 'table-row';
				document.getElementById("button_tool").style.display = 'table-row';
				document.getElementById("uploader_tool").style.display = 'none';				
				
			}						
			
			return;					
		} else {
		  alert("Error: " + oReq.status);
		}
	  };
	oReq.send(oData); 	
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

                <li class="active">
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
                    <a class="navbar-brand" href="#">Фотографии</a> 
					<a class="navbar-brand" href="dashboard8.php" style="margin-left:10px;"><span class="glyphicon glyphicon-refresh"></span></a>
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
			
                   <div class="col-md-12">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Обработать фотографию - обрезать и/или наложить прозрачную печать магазина</h4>
                                <p class="category">Нажмите на кнопку "Загрузить" и выберите желаемую фотографию на Вашем компьютере. Исходная фотография отобразится справа. Далее, выберите в каком углу будет расположена прозрачная печать магазина "Crystal Sky". Затем, выберите желаемый размер фотографии. Нажмите на кнопку "Обработать Фотографию", и обработанная фотография появится справа. Нажав мышкой на правую панель с фотографией, обработанная фотография сохранится на Вашем компьютере. Кнопка "Фотография и Так Хороша" возвращает Вас на начало обработчика фотографий.</p>
                            </div>
                            <div class="content">
                                <div id="bbb" >
								
									<div style="overflow-x:auto;">
									
									<form name="TheImageProcessor" enctype="multipart/form-data" method="post" action="#">	
									<table border='0'>
										<tr style="vertical-align:center;">
											<td style="padding: 10px; vertical-align: top;">
												<table border='0' class="table table-striped" style="width:350px;">
													<tr id="uploader_tool">
														<td colspan='5'>															
															<div id="inp_photo1" class="form-group" >
															<br/>
															<label for="photo1" style='margin-top:12px;'>Выберите Фотографию</label> 
															<label class="btn btn-default pull-right" id="photo1_btn" for="my-file-selector">
																<input id="my-file-selector" name="my-file-selector" type="file" style="display:none;" onchange="UploadOriginPhoto();">
																<span id="upload-file-info">Загрузить</span>
															</label>															
															<!--
																<label for="exampleInputCouponType">Фото</label>
																  <span id="upload-file-info" class="btn btn-default btn-file" onchange="$('#upload-file-info').html($(this).val());">
																	Загрузить Фото <input type="file">
																  </span> -->
															</div>
														</td>
													</tr>
													<tr id="watermark_tool" style="display: none;">
														<td style="padding: 10px;">
															<label>
															<img src='assets/img/sample2_1.png' width='50' height='50' alt='' border='0' style='box-shadow: 2px 2px 3px #888888;'><br/>
															<div style='text-align:center'><input type="radio" name="watermark_position" value="1" checked="checked"></div>
															</label>
														</td>
														<td style="padding: 10px;">
															<label>
															<img src='assets/img/sample3_1.png' width='50' height='50' alt='' border='0' style='box-shadow: 2px 2px 3px #888888;'><br/>
															<div style='text-align:center'><input type="radio" name="watermark_position" value="2" ></div>
															</label>
														</td>
														<td style="padding: 10px;">
															<label>
															<img src='assets/img/sample1_1.png' width='50' height='50' alt='' border='0' style='box-shadow: 2px 2px 3px #888888;'><br/>
															<div style='text-align:center'><input type="radio" name="watermark_position" value="3" ></div>
															</label>
														</td>
														<td style="padding: 10px;">
															<label>
															<img src='assets/img/sample4_1.png' width='50' height='50' alt='' border='0' style='box-shadow: 2px 2px 3px #888888;'><br/>
															<div style='text-align:center'><input type="radio" name="watermark_position" value="4" ></div>
															</label>
														</td>
														<td style="padding: 10px;">
															<label>
															<img src='assets/img/sample5_1.png' width='50' height='50' alt='' border='0' style='box-shadow: 2px 2px 3px #888888;'><br/>
															<div style='text-align:center'><input type="radio" name="watermark_position" value="5" checked="checked"></div>
															</label>
														</td>														
													</tr>
													<tr id="size_tool" style="display: none;">
														<td style="padding: 10px;">
															<label>
															<img src='assets/img/sample1_2.png' width='50' height='50' alt='' border='0' style='box-shadow: 2px 2px 3px #888888;'><br/>
															<div style='text-align:center'><input type="radio" name="size_position" value="1" checked="checked"></div>
															</label>
														</td>
														<td style="padding: 10px;">
															<label>
															<img src='assets/img/sample2_2.png' width='50' height='50' alt='' border='0' style='box-shadow: 2px 2px 3px #888888;'><br/>
															<div style='text-align:center'><input type="radio" name="size_position" value="2" ></div>
															</label>
														</td>
														<td style="padding: 10px;">
															<label>
															<img src='assets/img/sample3_2.png' width='50' height='50' alt='' border='0' style='box-shadow: 2px 2px 3px #888888;'><br/>
															<div style='text-align:center'><input type="radio" name="size_position" value="3" ></div>
															</label>
														</td>
														<td style="padding: 10px;">
															<label>
															<img src='assets/img/sample4_2.png' width='50' height='50' alt='' border='0' style='box-shadow: 2px 2px 3px #888888;'><br/>
															<div style='text-align:center'><input type="radio" name="size_position" value="4" ></div>
															</label>
														</td>
														<td style="padding: 10px;">
															<label>
															<img src='assets/img/sample5_2.png' width='50' height='50' alt='' border='0' style='box-shadow: 2px 2px 3px #888888;'><br/>
															<div style='text-align:center'><input type="radio" name="size_position" value="5" checked="checked"></div>
															</label>
														</td>														
													</tr>													
													<tr id="button_tool" style="display: none;">
														<td colspan='5'>															
															<div id="inp_processPhoto" class="form-group" style='text-align:center'>	
															<br/>
															<button type="submit" onclick="processPhoto(); return false;" class="btn btn-primary" id="btn_001">
															Обработать Фотографию!
															</button>	
															<br/><br/>
															<button type="button"  onClick="window.location.reload();" class="btn btn-default" id="btn_002">
															Фотография и Так Хороша!
															</button>															
															</div>
														</td>
													</tr>													
												</table>											
											</td>
											<td style="padding: 10px; text-align:center; vertical-align:center;">												
												<a id="HrefProcessing" download="CrystalSky.png" href='assets/img/place_holder_350_2.png' title='CrystalSky'>
											<!--	<img style="margin-top: 0px; box-shadow: 2px 2px 3px #888888;" name="the_img2" id="the_img2" src='assets/img/place_holder_350_2.png' border='0' alt='CrystalSky' width='350' height='350'> -->
													<div class="flip-container" ontouchstart="this.classList.toggle('hover');">
													  <div class="flipper">
														<div class="front">
														   <img style="margin-top: 0px; box-shadow: 2px 2px 3px #888888;" name="the_img1" id="the_img1" src='assets/img/place_holder_350_2.png' border='0' alt='CrystalSky' width='350' height='350'>
														</div>
														<div class="back">
														  <img style="margin-top: 0px; box-shadow: 2px 2px 3px #888888;" name="the_img2" id="the_img2" src='assets/img/place_holder_350_2.png' border='0' alt='CrystalSky' width='350' height='350'>
														</div>
													  </div>
													</div>												
												</a>
												<br/><input type="hidden" id="the_file_name" name="the_file_name" value=""><br/>
												<div id="errorProcessing" name="errorProcessing" style="color:red; font-weight:bold; font-size: large;"></div>
											</td>
										</tr>
									</table>
									</form>

									</div>
								
								</div>

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Хорошей работы! Удачного дня!
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
			message: "Добро пожаловать в панель управления<br/> сайтом <b>Crystal Sky</b>! Хорошей работы!"

		},{
			type: 'info',
			timer: 4000
		});

	});
	*/
	
	$(function(){
		$("#retroclockbox1").flipcountdown({
			size:"sm"
		});
	})
	
	</script> 
    

</html>
