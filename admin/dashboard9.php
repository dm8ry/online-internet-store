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

function confirmDeleteFn()
{
	if (document.getElementById("confirmDelete").checked == true)
	{
		  $('#deleteButton').removeClass('disabled');
	}
	else
	{
		 $('#deleteButton').addClass('disabled');
	}
}

// delete the product
function deletePost()
{			
	var url = "delete_the_post.php";

	var oData = new FormData(document.forms.namedItem("EditPost"));
	
	var oReq = new XMLHttpRequest();
	  oReq.open("POST", url, true);
	  oReq.onload = function(oEvent) {
	  
		if (oReq.status == 200) 
		{			
			$('#myModalEditRecord').modal('hide');																									
			// page reload from server
			location.replace("https://crystalsky.co.il/admin/dashboard9.php");
			return;					
		} else {
		  alert("Error: " + oReq.status);
		}
	  };
	oReq.send(oData); 	
}

/// change_the_product
function change_the_post ()
{

	var nErrors =0;
					
	document.getElementById("emdl_msg").style.display="none";
	
	// check post_title
	if (document.getElementById("epost_title").value==null || document.getElementById("epost_title").value=="")
	{					
		document.getElementById("epost_title").style.borderColor = "red";
		document.getElementById("epost_title").style.boxShadow = "2px 2px 2px lightgray";
		nErrors++;
	}
	else
	{
		var str=document.getElementById("epost_title").value;
		var n= str.length;
		var specialChars = "^&'\"\\/~`";
		
		var nErrSpecChars = 0;
		
		for(i = 0; i < specialChars.length;i++)
		{
			if(str.indexOf(specialChars[i]) > -1)
			{
				nErrSpecChars++;
			}
		}
		
		if (n > 60 || nErrSpecChars>0)
		{			
			document.getElementById("epost_title").style.borderColor = "red";
			document.getElementById("epost_title").style.boxShadow = "3px 3px 3px lightgray";
			nErrors++;						
		}			
		else
		{
			document.getElementById("epost_title").style.borderColor = "green";
			document.getElementById("epost_title").style.boxShadow = "2px 2px 2px lightgray";
		}
	}		
		

	// check keyword1
	if (document.getElementById("ekeyword1").value==null || document.getElementById("ekeyword1").value=="")
	{					
		document.getElementById("ekeyword1").style.borderColor = "red";
		document.getElementById("ekeyword1").style.boxShadow = "2px 2px 2px lightgray";
		nErrors++;
	}
	else
	{
		var str=document.getElementById("ekeyword1").value;
		var n= str.length;
		var specialChars = "^&'\"\\/~`";
		
		var nErrSpecChars = 0;
		
		for(i = 0; i < specialChars.length;i++)
		{
			if(str.indexOf(specialChars[i]) > -1)
			{
				nErrSpecChars++;
			}
		}
		
		if (n > 20 || nErrSpecChars>0)
		{			
			document.getElementById("ekeyword1").style.borderColor = "red";
			document.getElementById("ekeyword1").style.boxShadow = "3px 3px 3px lightgray";
			nErrors++;						
		}			
		else
		{
			document.getElementById("ekeyword1").style.borderColor = "green";
			document.getElementById("ekeyword1").style.boxShadow = "2px 2px 2px lightgray";
		}
	}	

	// check keyword2
	if (document.getElementById("ekeyword2").value==null || document.getElementById("ekeyword2").value=="")
	{					
		document.getElementById("ekeyword2").style.borderColor = "red";
		document.getElementById("ekeyword2").style.boxShadow = "2px 2px 2px lightgray";
		nErrors++;
	}
	else
	{
		var str=document.getElementById("ekeyword2").value;
		var n= str.length;
		var specialChars = "^&'\"\\/~`";
		
		var nErrSpecChars = 0;
		
		for(i = 0; i < specialChars.length;i++)
		{
			if(str.indexOf(specialChars[i]) > -1)
			{
				nErrSpecChars++;
			}
		}
		
		if (n > 20 || nErrSpecChars>0)
		{			
			document.getElementById("ekeyword2").style.borderColor = "red";
			document.getElementById("ekeyword2").style.boxShadow = "3px 3px 3px lightgray";
			nErrors++;						
		}			
		else
		{
			document.getElementById("ekeyword2").style.borderColor = "green";
			document.getElementById("ekeyword2").style.boxShadow = "2px 2px 2px lightgray";
		}
	}				
		
	// check keyword3
	if (document.getElementById("ekeyword3").value==null || document.getElementById("ekeyword3").value=="")
	{					
		document.getElementById("ekeyword3").style.borderColor = "red";
		document.getElementById("ekeyword3").style.boxShadow = "2px 2px 2px lightgray";
		nErrors++;
	}
	else
	{
		var str=document.getElementById("ekeyword3").value;
		var n= str.length;
		var specialChars = "^&'\"\\/~`";
		
		var nErrSpecChars = 0;
		
		for(i = 0; i < specialChars.length;i++)
		{
			if(str.indexOf(specialChars[i]) > -1)
			{
				nErrSpecChars++;
			}
		}
		
		if (n > 20 || nErrSpecChars>0)
		{			
			document.getElementById("ekeyword3").style.borderColor = "red";
			document.getElementById("ekeyword3").style.boxShadow = "3px 3px 3px lightgray";
			nErrors++;						
		}			
		else
		{
			document.getElementById("ekeyword3").style.borderColor = "green";
			document.getElementById("ekeyword3").style.boxShadow = "2px 2px 2px lightgray";
		}
	}							
		
	// check categ
	if (document.getElementById("ecateg").value==null || document.getElementById("ecateg").value=="")
	{					
		document.getElementById("ecateg").style.borderColor = "red";
		document.getElementById("ecateg").style.boxShadow = "2px 2px 2px lightgray";
		nErrors++;
	}
	else
	{
		document.getElementById("ecateg").style.borderColor = "green";
		document.getElementById("ecateg").style.boxShadow = "2px 2px 2px lightgray";
	}	

	/*
	if (document.getElementById("my-efile-selector").value==null || document.getElementById("my-efile-selector").value=="")
	{					
		document.getElementById("ephoto1_btn").style.borderColor = "red";
		document.getElementById("ephoto1_btn").style.boxShadow = "2px 2px 2px lightgray";
		nErrors++;
	}
	else
	{
		document.getElementById("ephoto1_btn").style.borderColor = "green";
		document.getElementById("ephoto1_btn").style.boxShadow = "2px 2px 2px lightgray";
	}*/

	
	// check post_details
	if (document.getElementById("epost_details").value==null || document.getElementById("epost_details").value=="")
	{					
		document.getElementById("epost_details").style.borderColor = "red";
		document.getElementById("epost_details").style.boxShadow = "2px 2px 2px lightgray";
		nErrors++;
	}
	else
	{
		document.getElementById("epost_details").style.borderColor = "green";
		document.getElementById("epost_details").style.boxShadow = "2px 2px 2px lightgray";
	}								
					
	if (nErrors==0)
	{					
		var url = "update_the_post.php";
					
		var oData = new FormData(document.forms.namedItem("EditPost"));
		
		var oReq = new XMLHttpRequest();
		  oReq.open("POST", url, true);
		  oReq.onload = function(oEvent) {
								
			if (oReq.status == 200) 
			{																				
				// alert('....'+oReq.responseText);
				
				if (oReq.responseText!='Ok')
				{					
					document.getElementById("emdl_msg").innerHTML=oReq.responseText;
					document.getElementById("emdl_msg").style.display="block";									
					return;
				}
				else
				{
					$('#myModalEditRecord').modal('hide')
					window.location.replace("https://crystalsky.co.il/admin/dashboard9.php");
					return;								
				}
				
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

function create_new_post()
	{
		
		var nErrors =0;
						
		document.getElementById("mdl_msg").style.display="none";
		
		// check post_title
		if (document.getElementById("post_title").value==null || document.getElementById("post_title").value=="")
		{					
			document.getElementById("post_title").style.borderColor = "red";
			document.getElementById("post_title").style.boxShadow = "2px 2px 2px lightgray";
			nErrors++;
		}
		else
		{
			var str=document.getElementById("post_title").value;
			var n= str.length;
			var specialChars = "^&'\"\\/~`";
			
			var nErrSpecChars = 0;
			
			for(i = 0; i < specialChars.length;i++)
			{
				if(str.indexOf(specialChars[i]) > -1)
				{
					nErrSpecChars++;
				}
			}
			
			if (n > 60 || nErrSpecChars>0)
			{			
				document.getElementById("post_title").style.borderColor = "red";
				document.getElementById("post_title").style.boxShadow = "3px 3px 3px lightgray";
				nErrors++;						
			}			
			else
			{
				document.getElementById("post_title").style.borderColor = "green";
				document.getElementById("post_title").style.boxShadow = "2px 2px 2px lightgray";
			}
		}		
			

		// check keyword1
		if (document.getElementById("keyword1").value==null || document.getElementById("keyword1").value=="")
		{					
			document.getElementById("keyword1").style.borderColor = "red";
			document.getElementById("keyword1").style.boxShadow = "2px 2px 2px lightgray";
			nErrors++;
		}
		else
		{
			var str=document.getElementById("keyword1").value;
			var n= str.length;
			var specialChars = "^&'\"\\/~`";
			
			var nErrSpecChars = 0;
			
			for(i = 0; i < specialChars.length;i++)
			{
				if(str.indexOf(specialChars[i]) > -1)
				{
					nErrSpecChars++;
				}
			}
			
			if (n > 20 || nErrSpecChars>0)
			{			
				document.getElementById("keyword1").style.borderColor = "red";
				document.getElementById("keyword1").style.boxShadow = "3px 3px 3px lightgray";
				nErrors++;						
			}			
			else
			{
				document.getElementById("keyword1").style.borderColor = "green";
				document.getElementById("keyword1").style.boxShadow = "2px 2px 2px lightgray";
			}
		}	

		// check keyword2
		if (document.getElementById("keyword2").value==null || document.getElementById("keyword2").value=="")
		{					
			document.getElementById("keyword2").style.borderColor = "red";
			document.getElementById("keyword2").style.boxShadow = "2px 2px 2px lightgray";
			nErrors++;
		}
		else
		{
			var str=document.getElementById("keyword2").value;
			var n= str.length;
			var specialChars = "^&'\"\\/~`";
			
			var nErrSpecChars = 0;
			
			for(i = 0; i < specialChars.length;i++)
			{
				if(str.indexOf(specialChars[i]) > -1)
				{
					nErrSpecChars++;
				}
			}
			
			if (n > 20 || nErrSpecChars>0)
			{			
				document.getElementById("keyword2").style.borderColor = "red";
				document.getElementById("keyword2").style.boxShadow = "3px 3px 3px lightgray";
				nErrors++;						
			}			
			else
			{
				document.getElementById("keyword2").style.borderColor = "green";
				document.getElementById("keyword2").style.boxShadow = "2px 2px 2px lightgray";
			}
		}				
			
		// check keyword3
		if (document.getElementById("keyword3").value==null || document.getElementById("keyword3").value=="")
		{					
			document.getElementById("keyword3").style.borderColor = "red";
			document.getElementById("keyword3").style.boxShadow = "2px 2px 2px lightgray";
			nErrors++;
		}
		else
		{
			var str=document.getElementById("keyword3").value;
			var n= str.length;
			var specialChars = "^&'\"\\/~`";
			
			var nErrSpecChars = 0;
			
			for(i = 0; i < specialChars.length;i++)
			{
				if(str.indexOf(specialChars[i]) > -1)
				{
					nErrSpecChars++;
				}
			}
			
			if (n > 20 || nErrSpecChars>0)
			{			
				document.getElementById("keyword3").style.borderColor = "red";
				document.getElementById("keyword3").style.boxShadow = "3px 3px 3px lightgray";
				nErrors++;						
			}			
			else
			{
				document.getElementById("keyword3").style.borderColor = "green";
				document.getElementById("keyword3").style.boxShadow = "2px 2px 2px lightgray";
			}
		}							
			
		// check categ
		if (document.getElementById("categ").value==null || document.getElementById("categ").value=="")
		{					
			document.getElementById("categ").style.borderColor = "red";
			document.getElementById("categ").style.boxShadow = "2px 2px 2px lightgray";
			nErrors++;
		}
		else
		{
			document.getElementById("categ").style.borderColor = "green";
			document.getElementById("categ").style.boxShadow = "2px 2px 2px lightgray";
		}	

		// check photo
		if (document.getElementById("my-file-selector").value==null || document.getElementById("my-file-selector").value=="")
		{					
			document.getElementById("photo1_btn").style.borderColor = "red";
			document.getElementById("photo1_btn").style.boxShadow = "2px 2px 2px lightgray";
			nErrors++;
		}
		else
		{
			document.getElementById("photo1_btn").style.borderColor = "green";
			document.getElementById("photo1_btn").style.boxShadow = "2px 2px 2px lightgray";
		}

		
		// check post_details
		if (document.getElementById("post_details").value==null || document.getElementById("post_details").value=="")
		{					
			document.getElementById("post_details").style.borderColor = "red";
			document.getElementById("post_details").style.boxShadow = "2px 2px 2px lightgray";
			nErrors++;
		}
		else
		{
			document.getElementById("post_details").style.borderColor = "green";
			document.getElementById("post_details").style.boxShadow = "2px 2px 2px lightgray";
		}				
		
			
		if (nErrors==0)
		{					
			var url = "create_new_post.php";
						
			var oData = new FormData(document.forms.namedItem("CreateNewPost"));
			
			var oReq = new XMLHttpRequest();
			  oReq.open("POST", url, true);
			  oReq.onload = function(oEvent) {
									
				if (oReq.status == 200) 
				{			
					// alert('>>'+oReq.responseText);
					
					if (oReq.responseText!='Ok')
					{					
						document.getElementById("mdl_msg").innerHTML=oReq.responseText;
						document.getElementById("mdl_msg").style.display="block";									
						return;
					}
					else
					{		
						$('#myModalNewRecord').modal('hide');																				
						location.replace("dashboard9.php");															
					}
					
					return;
					
				} else {
				  alert("Error " + oReq.status + " occurred uploading your file.<br \/>");
				}
			  };

			oReq.send(oData); 
		}
	}	

function getBLdetails(n)
{
	// Create our XMLHttpRequest object
	var hr = new XMLHttpRequest();
	// Create some variables we need to send to our PHP file
	var url = "xxxx.php"; //"getBusinessLogDetails.php";			
	
	var vars = "recn="+n;
	hr.open("POST", url, true);
	// Set content type header information for sending url encoded variables in the request
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	// Access the onreadystatechange event for the XMLHttpRequest object
	hr.onreadystatechange = function() {
		if(hr.readyState == 4 && hr.status == 200) {
			var return_data = hr.responseText;
										
			// alert('return_data= '+return_data);				
			document.getElementById("the_info").innerHTML=return_data;			
			$('#myModalBusinesslogDetails').modal('show');
			
		}
	}
	// Send the data to PHP now... and wait for response to update the status div			
	hr.send(vars); // Actually execute the request	
}

		// change Img
function showImageModalWindow(n) {
		  
  document.getElementById("imgPresenterBody").innerHTML='<img src="'+n.src+'" border="0" width="350px" height="350px" >';
  document.getElementById("imgPresenterTitle").innerHTML= n.title;
  
  $('#imgPresenter').modal('show')
}

function editBlog(n)
{
	alert('Работаю над этим...');
}

function addBlog(n)
{
	 //alert('Работаю над этим...');
	 $('#imgPresenter').modal('CreateNewPost')	
}

function deleteBlog(n)
{
	alert('Работаю над этим...');
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

                <li class="active">
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
                    <a class="navbar-brand" href="#">Управление Блогом</a> 
					<a class="navbar-brand" href="dashboard9.php" style="margin-left:10px;"><span class="glyphicon glyphicon-refresh"></span></a>
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
                                <h4 class="title">Управлением блогом магазина "Crystal Sky"</h4>
                                <p class="category">Управление блогом магазина "Crystal Sky", сообщения представлены в обратном порядке по времени.</p>
                            </div>
                            <div class="content"  style="overflow-x:auto;">   

								  <table class="table table-striped">
									<thead>
									  <tr>
										<th>Номер</th>
										<th>Дата</th>
										<th>Заголовок</th>
										<th>Фото</th>										
										<th>Текст</th>
										<th>Просм.</th>
										<th>Лайки</th>
										<th>Статус</th>
										<th>
											<button type="button" class="btn btn-primary btn-sm" onClick="$('#myModalNewRecord').modal('show')">
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
								
																
								$sql0="select count(1) n_of_r from posts";								
								$result0 = $conn->query($sql0);
								$row0 = $result0->fetch_assoc();								
								$total_results = $row0["n_of_r"];									
																								
								$sql = "select * from (select x.*, DATE_FORMAT(x.modifydate,'%d/%m/%Y %H:%i:%s') as the_date from posts x order by modifydate desc) M limit ".$p*$n_results_on_page.", ".$n_results_on_page;
								
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
								
										$recs_on_screen[] = $row;
									
								?>	
										<tr>
										<td><a href='./../post.php?i=<?php echo $row["id"]; ?>#come_here' target='_blank'><?php echo $row["id"]; ?></a></td>
										<td><?php echo $row["the_date"]; ?></td>
										<td><?php echo $row["title"]; ?></td>
										<td><a href='#'><img src='./../<?php echo $row["post_photo1"]; ?>' width='60' height='60' border="0" title="<?php echo $row["title"]; ?>" onClick="showImageModalWindow(this);"  style="border-radius:3px; box-shadow: 2px 2px 3px #888888;"></a></td>
										<td><?php mb_internal_encoding("UTF-8"); echo mb_substr($row["post_txt"], 0, 200)."..." ?></td>
										<td><?php echo $row["nviews"]; ?></td>
										<td><?php echo $row["likes"]; ?></td>
										<td><?php echo $row["post_status"]; ?></td>
										<td>
											<button type="button" class="btn btn-success btn-sm" onClick="editPost('<?php echo $row["id"]; ?>');">
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
								
								<!-- pager -->
								<nav>
								  <ul class="pager">
									<li><a href="dashboard9.php?p=<?php echo $first_page; ?>">Начало</a></li>
									<li><a href="dashboard9.php?p=<?php echo $prv_page; ?>">Предыдущая</a></li>
									<li><a href="dashboard9.php?p=<?php echo $p; ?>">Это <?php echo ($p+1); ?> страница</a></li>
									<li><a href="dashboard9.php?p=<?php echo $nxt_page; ?>">Следующая</a></li>
									<li><a href="dashboard9.php?p=<?php echo $last_page; ?>">Конец</a></li>
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



<!--- image presenter --->

<div class="modal fade" tabindex="-1" role="dialog" id="wrkOnIt" name="wrkOnIt">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="wrkOnItTitle">Работаю над этим</h4>
      </div>      
      <div class="modal-body" id="wrkOnItBody" name="wrkOnItBody" style="margin-left:auto; margin-right:auto; text-align:center">       
	  Работаю над этим...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--- image presenter --->



<!----- create new post for blog modal window start ----->

<!-- Start Modal New Record -->
<div class="modal fade" id="myModalNewRecord" tabindex="-1" role="dialog" 
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
                    Создать новый пост в блоге
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form role="form" data-toggle="validator" name="CreateNewPost" enctype="multipart/form-data" method="post">
						
					<div>

					  <!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#aa" aria-controls="aa" role="tab" data-toggle="tab">Свойства</a></li>
						<!--
						<li role="presentation"><a href="#bb" aria-controls="bb" role="tab" data-toggle="tab">Дополнение #1</a></li>
						<li role="presentation"><a href="#cc" aria-controls="cc" role="tab" data-toggle="tab">Дополнение #2</a></li> -->
						
						<!--
						<li role="presentation" class="pull-right">	
							<span id="sp_btn_010">
							<input type='checkbox' id='confirmDelete' onChange="confirmDeleteFn()">&nbsp;
							<button type="reset" onclick="deletePost()" class="btn btn-danger btn-sm disabled" id="deleteButton" name="deleteButton">
								Удалить этот товар!
							</button></span>							
						</li>	
						-->
						
					  </ul>

					  <!-- Tab panes -->
					  <div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="aa">
												
							<div>
							
								<div class="clearfix" style="margin-bottom:20px;"></div>
																								
								<input type="hidden" id="rowid" name="rowid" value="">
							
								<div class="content"  style="overflow-x:auto;">  
							
								<!-- start главные свойства -->
								<table border='0' class="table" style="margin-left:auto; margin-right:auto">
									<tr>
										<td colspan="3" style="padding:5px;">
											<div id="inp_post_title" class="form-group" >
												<label for="post_title">Заголовок</label>
												  <input class="form-control" onkeydown="limit(this, 60);" onkeyup="limit(this, 60);"
												  id="post_title" name="post_title" placeholder="Это самая чудесная новость на свете!"/>
											</div>									
										</td>
									</tr>								
									<tr>
										<td style="padding:5px;">
											<div id="inp_keyword1" class="form-group" >
												<label for="keyword1">Ключевое слово #1</label>
												  <input class="form-control" onkeydown="limit(this, 20);" onkeyup="limit(this, 20);"
												  id="keyword1" name="keyword1" placeholder="серебро"/>
											</div>									
										</td>
										<td style="padding:5px;">								 
											<div id="inp_keyword2" class="form-group" >
												<label for="keyword2">Ключевое слово #2</label>
												  <input class="form-control" onkeydown="limit(this, 20);" onkeyup="limit(this, 20);"
												  id="keyword2" name="keyword2" placeholder="украшения"/>
											</div>																		
										</td>	
										<td style="padding:5px;">								 
											<div id="inp_keyword3" class="form-group" >
												<label for="keyword3">Ключевое слово #3</label>
												  <input class="form-control" onkeydown="limit(this, 20);" onkeyup="limit(this, 20);"
												  id="keyword3" name="keyword3" placeholder="позолота"/>
											</div>																		
										</td>									
									</tr>
									<tr>
										<td style="padding:5px;">
											<div id="inp_categ" class="form-group" >
												<label >Категория</label>
												<div >
													<select class="form-control" id="categ" name="categ">
														<option value="">Выберите...</option>
														<option value="Общая">Общая</option>
														<option value="Интересно">Интересно</option>
														<option value="Наш Магазин">Наш Магазин</option>
														<option value="Мероприятия">Мероприятия</option>
													</select>
												</div>
											</div>									
										</td>
										<td  colspan='2' style="padding:5px;">								 
											<div id="inp_photo1" class="form-group" >
											<label for="photo1">Фото</label><br/>
											<label class="btn btn-default" id="photo1_btn" for="my-file-selector">
												<input id="my-file-selector" name="my-file-selector" type="file" style="display:none;" onchange="$('#upload-file-info').html($(this).val());">
												<span id="upload-file-info">Загрузить</span>
											</label>
											&nbsp;<span id="img_placer" style="display:none;"><img src="https://placehold.it/50x50" border="0" width="50" height="50" id="imgPlacerImg"></span>
											<!--
												<label for="exampleInputCouponType">Фото</label>
												  <span id="upload-file-info" class="btn btn-default btn-file" onchange="$('#upload-file-info').html($(this).val());">
													Загрузить Фото <input type="file">
												  </span> -->
											</div>																		
										</td>									
									</tr>

									<tr>
										<td colspan="3" style="padding:5px;">
											<div id="inp_post_details" class="form-group">
												<label for="post_details">Содержание Поста</label>
												<textarea id="post_details"  name="post_details" class="form-control" placeholder="Самая чудесная новость на всем белом свете!"></textarea>
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
                <div id="mdl_msg" name="mdl_msg" class="alert alert-danger pull-left" style="display:none;">                            
                </div>					
                <span id="sp_btn_001"><button type="button" class="btn btn-default"
                        data-dismiss="modal" id="btn_001">
                            Я передумал, не создавать!
                </button></span>               			
                &nbsp;<span id="sp_btn_003"><button type="submit" onclick="create_new_post(); return false;" class="btn btn-primary" id="btn_002">
                    Создать новый пост!
                </button></span>
            </div>
        </div>
    </div>
</div>
<!-- End Modal New Record -->



<!----- create new post for blog modal window end ----->



<!----- edit post for blog modal window start ----->

<!-- Start Modal New Record -->
<div class="modal fade" id="myModalEditRecord" tabindex="-1" role="dialog" 
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
                    Изменить пост в блоге
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form role="form" data-toggle="validator" name="EditPost" enctype="multipart/form-data" method="post">
						
					<div>

					  <!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#aa" aria-controls="aa" role="tab" data-toggle="tab">Свойства</a></li>
						<!--
						<li role="presentation"><a href="#bb" aria-controls="bb" role="tab" data-toggle="tab">Дополнение #1</a></li>
						<li role="presentation"><a href="#cc" aria-controls="cc" role="tab" data-toggle="tab">Дополнение #2</a></li> -->
						
						 
						<li role="presentation" class="pull-right">	
							<span id="sp_btn_010">
							<input type='checkbox' id='confirmDelete' onChange="confirmDeleteFn()">&nbsp;
							<button type="reset" onclick="deletePost()" class="btn btn-danger btn-sm disabled" id="deleteButton" name="deleteButton">
								Удалить этот пост!
							</button></span>							
						</li>	
						 
						
					  </ul>

					  <!-- Tab panes -->
					  <div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="aa">
												
							<div>
							
								<div class="clearfix" style="margin-bottom:20px;"></div>
																								
								<input type="hidden" id="erowid" name="erowid" value="">
							
								<div class="content"  style="overflow-x:auto;">  
							
								<!-- start главные свойства -->
								<table border='0' class="table" style="margin-left:auto; margin-right:auto">
									<tr>
										<td colspan="3" style="padding:5px;">
											<div id="inp_epost_title" class="form-group" >
												<label for="epost_title">Заголовок</label>
												  <input class="form-control" onkeydown="limit(this, 60);" onkeyup="limit(this, 60);"
												  id="epost_title" name="epost_title" placeholder="Это самая чудесная новость на свете!"/>
											</div>									
										</td>
									</tr>								
									<tr>
										<td style="padding:5px;">
											<div id="inp_ekeyword1" class="form-group" >
												<label for="ekeyword1">Ключевое слово #1</label>
												  <input class="form-control" onkeydown="limit(this, 20);" onkeyup="limit(this, 20);"
												  id="ekeyword1" name="ekeyword1" placeholder="серебро"/>
											</div>									
										</td>
										<td style="padding:5px;">								 
											<div id="inp_ekeyword2" class="form-group" >
												<label for="ekeyword2">Ключевое слово #2</label>
												  <input class="form-control" onkeydown="limit(this, 20);" onkeyup="limit(this, 20);"
												  id="ekeyword2" name="ekeyword2" placeholder="украшения"/>
											</div>																		
										</td>	
										<td style="padding:5px;">								 
											<div id="inp_ekeyword3" class="form-group" >
												<label for="ekeyword3">Ключевое слово #3</label>
												  <input class="form-control" onkeydown="limit(this, 20);" onkeyup="limit(this, 20);"
												  id="ekeyword3" name="ekeyword3" placeholder="позолота"/>
											</div>																		
										</td>									
									</tr>
									<tr>
										<td style="padding:5px;">
											<div id="inp_ecateg" class="form-group" >
												<label >Категория</label>
												<div >
													<select class="form-control" id="ecateg" name="ecateg">
														<option value="">Выберите...</option>
														<option value="Общая">Общая</option>
														<option value="Интересно">Интересно</option>
														<option value="Наш Магазин">Наш Магазин</option>
														<option value="Мероприятия">Мероприятия</option>
													</select>
												</div>
											</div>									
										</td>
										<td  colspan='2' style="padding:5px;">								 
											<div id="inp_ephoto1" class="form-group" >
											<label for="ephoto1">Фото</label><br/>
											<label class="btn btn-default" id="ephoto1_btn" for="my-efile-selector">
												<input id="my-efile-selector" name="my-efile-selector" type="file" style="display:none;" onchange="$('#upload-efile-info').html($(this).val());">
												<span id="upload-efile-info">Загрузить</span>
											</label>
											&nbsp;<span id="img_eplacer" style="display:none;"><img src="https://placehold.it/50x50" border="0" width="50" height="50" id="imgePlacerImg"></span>
											<!--
												<label for="exampleInputCouponType">Фото</label>
												  <span id="upload-file-info" class="btn btn-default btn-file" onchange="$('#upload-file-info').html($(this).val());">
													Загрузить Фото <input type="file">
												  </span> -->
											</div>																		
										</td>									
									</tr>

									<tr>
										<td colspan="3" style="padding:5px;">
											<div id="inp_epost_details" class="form-group">
												<label for="epost_details">Содержание Поста</label>
												<textarea id="epost_details"  name="epost_details" class="form-control" placeholder="Самая чудесная новость на всем белом свете!"></textarea>
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
                &nbsp;<span id="sp_btn_003"><button type="submit" onclick="change_the_post(); return false;" class="btn btn-primary" id="btn_002">
                   Изменить пост!
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
		
		function editPost(n)
		{			
			
			// clean up red color...
					
			document.getElementById("epost_title").style.borderColor = "#e3e3e3";
			document.getElementById("epost_title").style.boxShadow = "none";
					
			document.getElementById("inp_ekeyword1").style.borderColor = "#e3e3e3";
			document.getElementById("inp_ekeyword1").style.boxShadow = "none";			
								
			document.getElementById("inp_ekeyword2").style.borderColor = "#e3e3e3";
			document.getElementById("inp_ekeyword2").style.boxShadow = "none";	
		
			document.getElementById("inp_ekeyword3").style.borderColor = "#e3e3e3";
			document.getElementById("inp_ekeyword3").style.boxShadow = "none";			
		
			document.getElementById("categ").style.borderColor = "#e3e3e3";
			document.getElementById("categ").style.boxShadow = "none";											
			
			document.getElementById('img_eplacer').style.display= "none";
 
	 		document.getElementById("ephoto1_btn").style.borderColor = "#e3e3e3";
			document.getElementById("ephoto1_btn").style.boxShadow = "none";
				 		
			document.getElementById("epost_details").style.borderColor = "#e3e3e3";
			document.getElementById("epost_details").style.boxShadow = "none";					
										
			var js_recs_on_screen = <?php echo json_encode($recs_on_screen) ?>;
			
			for(idx=0; idx<js_recs_on_screen.length; idx++)
			{
				if (js_recs_on_screen[idx]["id"] == n)
				{
									
					document.getElementById("erowid").value=js_recs_on_screen[idx]["id"];
					
					document.getElementById("epost_title").value=js_recs_on_screen[idx]["title"];
					document.getElementById("ekeyword1").value=js_recs_on_screen[idx]["post_keyword1"];
					document.getElementById("ekeyword2").value=js_recs_on_screen[idx]["post_keyword2"];
					document.getElementById("ekeyword3").value=js_recs_on_screen[idx]["post_keyword3"];
					
					document.getElementById('ecateg').value=js_recs_on_screen[idx]["post_category"];
					
					document.getElementById('imgePlacerImg').src='./../'+js_recs_on_screen[idx]["post_photo1"];
					document.getElementById('img_eplacer').style.display="inline";
					
					
					document.getElementById("epost_details").value=js_recs_on_screen[idx]["post_txt"];
					
				}
			}			
			
			$('#myModalEditRecord').modal('show');
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

