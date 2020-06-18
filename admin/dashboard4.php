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
		
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$conn->query("set names 'utf8'");	
	
	
	$sql_is_to_show_product_views = "select * from app_properties where prop_name='admin_n_rows_products' ";
								
	$arr_is_to_show_product_views = array();		
	$results_is_to_show_product_views = mysqli_query($conn, $sql_is_to_show_product_views); 	
	
	while($line = mysqli_fetch_assoc($results_is_to_show_product_views)){
		$arr_is_to_show_product_views[] = $line;
	}		
	
	$n_results_on_page = $arr_is_to_show_product_views[0]['prop_value'];
	
	
	/// bring all the categories
	
	$query_bring_all_the_categ = "select mc.id main_cat_id, mc.name main_cat_name from  main_category mc order by 1";
		
	$arr_categ = array();		
	$results_arr_categ = mysqli_query($conn, $query_bring_all_the_categ); 	
	
	while($line = mysqli_fetch_assoc($results_arr_categ)){
		$arr_categ[] = $line;
	}	
	
	//////// populate cats and subcats
	
	$query = "select mc.id main_cat_id, mc.name main_cat_name, sc.id sub_cat_id, sc.name sub_cat_name from sub_category sc, main_category mc where mc.id = sc.main_category order by 2, 4";
		
	$cats_and_subcats = array();		
	$results = mysqli_query($conn, $query); 	
	
	while($line = mysqli_fetch_assoc($results)){
		$cats_and_subcats[] = $line;
	}
	
	//////// populate metalls
	
	$query = "select id, name from metall order by ord";
		
	$metalls = array();		
	$results_metalls = mysqli_query($conn, $query); 	
	
	while($line = mysqli_fetch_assoc($results_metalls)){
		$metalls[] = $line;
	}
	
	//////// populate colors
	
	$query = "select id, name from color order by name";
		
	$colors = array();		
	$results_colors = mysqli_query($conn, $query); 	
	
	while($line = mysqli_fetch_assoc($results_colors)){
		$colors[] = $line;
	}	
	
	//////// populate stones
	
	$query = "select id, name from stones order by name";
		
	$stones = array();		
	$results_stones = mysqli_query($conn, $query); 	
	
	while($line = mysqli_fetch_assoc($results_stones)){
		$stones[] = $line;
	}		
	
	//////// populate sizes
	
	$query = "select id, name from sizes order by name";
		
	$sizes = array();		
	$results_sizes = mysqli_query($conn, $query); 	
	
	while($line = mysqli_fetch_assoc($results_sizes)){
		$sizes[] = $line;
	}	
	

	/*
	echo "<pre>";
	print_r($colors);
	echo "</pre>";
	*/
		
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
	
		.btn-file {
			position: relative;
			overflow: hidden;
		}
		.btn-file input[type=file] {
			position: absolute;
			top: 0;
			right: 0;
			min-width: 100%;
			min-height: 100%;
			font-size: 100px;
			text-align: right;
			filter: alpha(opacity=0);
			opacity: 0;
			outline: none;
			background: white;
			cursor: inherit;
			display: block;
		}	
	
	</style>
	
	
	<script>	
	
		// reload page
		function ReloadPage(selectObject)
		{
			 var value = selectObject.value;  
			 window.location.href = 'dashboard4.php?p='+value;
		}	
	
		// limit input chars
		function limit(element, n_max_chars)
		{
			var max_chars = n_max_chars;

			if(element.value.length > n_max_chars) {
				element.value = element.value.substr(0, n_max_chars);
			}
		}
	
		// delete the product
		function deleteProduct()
		{			
			var url = "delete_the_product.php";
		
			var oData = new FormData(document.forms.namedItem("CreateNewProduct"));
			
			var oReq = new XMLHttpRequest();
			  oReq.open("POST", url, true);
			  oReq.onload = function(oEvent) {
			  
				if (oReq.status == 200) 
				{			
					$('#myModalNewRecord').modal('hide');																									
					// page reload from server
					location.replace("https://crystalsky.co.il/admin/dashboard4.php");
					return;					
				} else {
				  alert("Error: " + oReq.status);
				}
			  };
			oReq.send(oData); 	
		}
		
		// change Img
		function showImageModalWindow(n) {
		  		  
		  document.getElementById("imgPresenterBody").innerHTML='<img src="'+n.src+'" border="0" width="300px" height="300px" >';
		  document.getElementById("imgPresenterTitle").innerHTML= n.title;
		  
		  $('#imgPresenter').modal('show')
		}	
		
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
				
		
		/// change_the_product
		function change_the_product ()
		{
		
			var nErrors =0;
							
			document.getElementById("mdl_msg").style.display="none";
				
			// check makat
			if (document.getElementById("makat").value==null || document.getElementById("makat").value=="")
			{					
				document.getElementById("makat").style.borderColor = "red";
				document.getElementById("makat").style.boxShadow = "2px 2px 2px lightgray";
				nErrors++;
			}
			else
			{
				var str=document.getElementById("makat").value;
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
				
				if (n > 15 || str.indexOf(' ')>=0 || nErrSpecChars>0)
				{			
					document.getElementById("makat").style.borderColor = "red";
					document.getElementById("makat").style.boxShadow = "3px 3px 3px lightgray";
					nErrors++;						
				}			
				else
				{
					document.getElementById("makat").style.borderColor = "green";
					document.getElementById("makat").style.boxShadow = "2px 2px 2px lightgray";
				}
			}
			
			
			// check title
			if (document.getElementById("title").value==null || document.getElementById("title").value=="")
			{					
				document.getElementById("title").style.borderColor = "red";
				document.getElementById("title").style.boxShadow = "2px 2px 2px lightgray";
				nErrors++;
			}
			else
			{
				var str=document.getElementById("title").value;
				var n= str.length;
				var specialChars = "<>@#$%^&()_+[]{}?:;|'\"\\/~`-=";
				
				var nErrSpecChars = 0;
				
				for(i = 0; i < specialChars.length;i++)
				{
					if(str.indexOf(specialChars[i]) > -1)
					{
						nErrSpecChars++;
					}
				}
				
				if (n > 24 || nErrSpecChars>0)
				{			
					document.getElementById("title").style.borderColor = "red";
					document.getElementById("title").style.boxShadow = "3px 3px 3px lightgray";
					nErrors++;						
				}			
				else
				{
					document.getElementById("title").style.borderColor = "green";
					document.getElementById("title").style.boxShadow = "2px 2px 2px lightgray";
				}
			}
			
			
			// check price
			if (document.getElementById("price").value==null || document.getElementById("price").value=="")
			{					
				document.getElementById("price").style.borderColor = "red";
				document.getElementById("price").style.boxShadow = "2px 2px 2px lightgray";
				nErrors++;
			}
			else
			{
				var the_val = document.getElementById("price").value;
				
				
				if (!IsNumeric(the_val))
				{			
					document.getElementById("price").style.borderColor = "red";
					document.getElementById("price").style.boxShadow = "3px 3px 3px lightgray";
					nErrors++;						
				}			
				else
				{
					document.getElementById("price").style.borderColor = "green";
					document.getElementById("price").style.boxShadow = "2px 2px 2px lightgray";
				}
			}				
			
			
			// check main category
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


			// check sub category
			if (document.getElementById("sub_categ").value==null || document.getElementById("sub_categ").value=="")
			{					
				document.getElementById("sub_categ").style.borderColor = "red";
				document.getElementById("sub_categ").style.boxShadow = "2px 2px 2px lightgray";
				nErrors++;
			}
			else
			{
				document.getElementById("sub_categ").style.borderColor = "green";
				document.getElementById("sub_categ").style.boxShadow = "2px 2px 2px lightgray";
			}	
			
			// check short desc
			if (document.getElementById("short_desc").value==null || document.getElementById("short_desc").value=="")
			{					
				document.getElementById("short_desc").style.borderColor = "red";
				document.getElementById("short_desc").style.boxShadow = "2px 2px 2px lightgray";
				nErrors++;
			}
			else
			{
				document.getElementById("short_desc").style.borderColor = "green";
				document.getElementById("short_desc").style.boxShadow = "2px 2px 2px lightgray";
			}				
			
			// check long desc
			if (document.getElementById("long_desc").value==null || document.getElementById("long_desc").value=="")
			{					
				document.getElementById("long_desc").style.borderColor = "red";
				document.getElementById("long_desc").style.boxShadow = "2px 2px 2px lightgray";
				nErrors++;
			}
			else
			{
				document.getElementById("long_desc").style.borderColor = "green";
				document.getElementById("long_desc").style.boxShadow = "2px 2px 2px lightgray";
			}						
								
			if (nErrors==0)
			{					
				var url = "update_the_product.php";
							
				var oData = new FormData(document.forms.namedItem("CreateNewProduct"));
				
				var oReq = new XMLHttpRequest();
				  oReq.open("POST", url, true);
				  oReq.onload = function(oEvent) {
										
					if (oReq.status == 200) 
					{																				
						// alert('....'+oReq.responseText);
						
						if (oReq.responseText!='Ok')
						{					
							document.getElementById("mdl_msg").innerHTML=oReq.responseText;
							document.getElementById("mdl_msg").style.display="block";									
							return;
						}
						else
						{
							$('#myModalNewRecord').modal('hide')
							window.location.replace("https://crystalsky.co.il/admin/dashboard4.php");
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
		
		
		function catalogChanged(n)
		{
			var js_cats_and_subcats = <?php echo json_encode($cats_and_subcats) ?>;
			var subCatSelect = document.getElementById("sub_categ");
			
			subCatSelect.options.length = 0;
			
			var opt = document.createElement('option');
				opt.value = "";
				opt.innerHTML = "Выберите...";
				subCatSelect.appendChild(opt);		
				
			 
			for(var i=0 ; i<js_cats_and_subcats.length ; i++)
			{
			
				if (js_cats_and_subcats[i].main_cat_id == n)
				{
					var opt = document.createElement('option');
						opt.value = js_cats_and_subcats[i]['sub_cat_id'];
						opt.innerHTML = js_cats_and_subcats[i]['sub_cat_name'];
						subCatSelect.appendChild(opt);
				}
			}
	 			
		}
		
		function IsNumeric(input)
			{
				var RE = /^-{0,1}\d*\.{0,1}\d+$/;
				return (RE.test(input));
			}
	
		function ajax_post()
			{
				
				var nErrors =0;
								
				document.getElementById("mdl_msg").style.display="none";
					
				// check makat
			 	if (document.getElementById("makat").value==null || document.getElementById("makat").value=="")
				{					
					document.getElementById("makat").style.borderColor = "red";
					document.getElementById("makat").style.boxShadow = "2px 2px 2px lightgray";
					nErrors++;
				}
				else
				{
					var str=document.getElementById("makat").value;
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
					
					if (n > 15 || str.indexOf(' ')>=0 || nErrSpecChars>0)
					{			
						document.getElementById("makat").style.borderColor = "red";
						document.getElementById("makat").style.boxShadow = "3px 3px 3px lightgray";
						nErrors++;						
					}			
					else
					{
						document.getElementById("makat").style.borderColor = "green";
						document.getElementById("makat").style.boxShadow = "2px 2px 2px lightgray";
					}
				}

				// check title
			 	if (document.getElementById("title").value==null || document.getElementById("title").value=="")
				{					
					document.getElementById("title").style.borderColor = "red";
					document.getElementById("title").style.boxShadow = "2px 2px 2px lightgray";
					nErrors++;
				}
				else
				{
					var str=document.getElementById("title").value;
					var n= str.length;
					var specialChars = "<>@#$%^&()_+[]{}?:;|'\"\\/~`-=";
					
					var nErrSpecChars = 0;
					
					for(i = 0; i < specialChars.length;i++)
					{
						if(str.indexOf(specialChars[i]) > -1)
						{
							nErrSpecChars++;
						}
					}
					
					if (n > 24 || nErrSpecChars>0)
					{			
						document.getElementById("title").style.borderColor = "red";
						document.getElementById("title").style.boxShadow = "3px 3px 3px lightgray";
						nErrors++;						
					}			
					else
					{
						document.getElementById("title").style.borderColor = "green";
						document.getElementById("title").style.boxShadow = "2px 2px 2px lightgray";
					}
				}
				
				
				// check price
			 	if (document.getElementById("price").value==null || document.getElementById("price").value=="")
				{					
					document.getElementById("price").style.borderColor = "red";
					document.getElementById("price").style.boxShadow = "2px 2px 2px lightgray";
					nErrors++;
				}
				else
				{
					var the_val = document.getElementById("price").value;
					
					
					if (!IsNumeric(the_val))
					{			
						document.getElementById("price").style.borderColor = "red";
						document.getElementById("price").style.boxShadow = "3px 3px 3px lightgray";
						nErrors++;						
					}			
					else
					{
						document.getElementById("price").style.borderColor = "green";
						document.getElementById("price").style.boxShadow = "2px 2px 2px lightgray";
					}
				}				
				
				
				// check main category
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


				// check sub category
			 	if (document.getElementById("sub_categ").value==null || document.getElementById("sub_categ").value=="")
				{					
					document.getElementById("sub_categ").style.borderColor = "red";
					document.getElementById("sub_categ").style.boxShadow = "2px 2px 2px lightgray";
					nErrors++;
				}
				else
				{
					document.getElementById("sub_categ").style.borderColor = "green";
					document.getElementById("sub_categ").style.boxShadow = "2px 2px 2px lightgray";
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
				
				// check short desc
			 	if (document.getElementById("short_desc").value==null || document.getElementById("short_desc").value=="")
				{					
					document.getElementById("short_desc").style.borderColor = "red";
					document.getElementById("short_desc").style.boxShadow = "2px 2px 2px lightgray";
					nErrors++;
				}
				else
				{
					document.getElementById("short_desc").style.borderColor = "green";
					document.getElementById("short_desc").style.boxShadow = "2px 2px 2px lightgray";
				}				
				
				// check long desc
			 	if (document.getElementById("long_desc").value==null || document.getElementById("long_desc").value=="")
				{					
					document.getElementById("long_desc").style.borderColor = "red";
					document.getElementById("long_desc").style.boxShadow = "2px 2px 2px lightgray";
					nErrors++;
				}
				else
				{
					document.getElementById("long_desc").style.borderColor = "green";
					document.getElementById("long_desc").style.boxShadow = "2px 2px 2px lightgray";
				}						
									
				if (nErrors==0)
				{					
					var url = "create_new_product.php";
								
					var oData = new FormData(document.forms.namedItem("CreateNewProduct"));
					
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
								location.replace("dashboard4.php");															
							}
							
							return;
							
						} else {
						  alert("Error " + oReq.status + " occurred uploading your file.<br \/>");
						}
					  };

					oReq.send(oData); 
				}
			}

	function show_products_option_changed(selectObject)
	{
		var the_value = selectObject.value;
		
		// Create our XMLHttpRequest object
		var hr = new XMLHttpRequest();
		// Create some variables we need to send to our PHP file
		var url = "which_products_to_show_ajax.php";
		
		var vars = "which_products_to_show="+the_value;	
		
		hr.open("POST", url, true);
		// Set content type header information for sending url encoded variables in the request
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		// Access the onreadystatechange event for the XMLHttpRequest object
		hr.onreadystatechange = function() {
			if(hr.readyState == 4 && hr.status == 200) {
				var return_data = hr.responseText;
				
				 //alert('return_data = '+return_data);
				 location.reload(true ); // reload the page from the server	
				window.location.href = 'dashboard4.php?p=0';
			}
		}
		// Send the data to PHP now... and wait for response to update the status div			
		hr.send(vars); // Actually execute the request		
	}
			
	</script>

	<?php
		
		if (!isset($_SESSION['which_products_to_show']))
		{
			$which_products_to_show = 1;
		}
		else
		{
			$which_products_to_show = $_SESSION['which_products_to_show'];			
		}
		
		$search_suffix = ' ';
		
		switch ($which_products_to_show)
		{
			case 1: // показывать все товары
				$search_suffix = ' '; 
				break;
			case 2: // показывать товары с указанной ценой
				$search_suffix = ' and show_price = \'1\' ';
				break;
			case 3: // показывать товары без указанной ценой
				$search_suffix = ' and show_price != \'1\' ';
				break;
			default:
				$search_suffix = ' '; 
		}
	
	?>
	
	
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
				
                <li class="active">
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
                    <a class="navbar-brand" href="#">Товары</a> 
					<a class="navbar-brand" href="dashboard4.php" style="margin-left:10px;"><span class="glyphicon glyphicon-refresh"></span></a>
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

				<!-- end Товары -->
				
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Товары магазина "Crystal Sky"</h4>
                                <p class="category">Управление товарами магазина "Crystal Sky"</p>
                            </div>
                            <div class="content" style="overflow-x:auto;">   

								<form method="post" action="dashboard4.php">
								<table border='0' class="table" style="margin-left:auto; margin-right:auto">
								<tr>
									
									<td style="background:#f9f9f9;">
										<label for="search_makat">Поиск по Макату</label>
										<div class="input-group"  id="inp_search_makat">											
											<input type="text" class="form-control" onkeydown="limit(this, 10);" onkeyup="limit(this, 10);"
																  id="search_makat" name="search_makat" placeholder="AB10C235" value="<?php echo $_POST["search_makat"]; ?>" />	
											<span class="input-group-btn">
												<button type="submit" class="btn btn-default">
												<span class="glyphicon glyphicon-search"></span>
												</button>
											</span>
										</div>										
									</td>								
									<td style="background:#fdfdfd;">
										<label for="search_product">Поиск по Номеру</label>
										<div class="input-group"  id="inp_search_makat">											
											<input type="text" class="form-control" onkeydown="limit(this, 5);" onkeyup="limit(this, 5);"
																  id="search_product" name="search_product" placeholder="29" value="<?php echo $_POST["search_product"]; ?>" />	
																  
											<span class="input-group-btn">
												<button type="submit" class="btn btn-default">												
												<span class="glyphicon glyphicon-search"></span>
												</button>
											</span>
										</div>	
									</td>																	
								</tr>
								</table>
								</form>
								
								
								<table border='0' class="table" style="margin-left:auto; margin-right:auto">
								<tr>
									<td style="background:#fefefe;">
										<div class="form-group pull-left">				
											<label class="control-label">Опции Показа Товаров</label>
											<div class="selectContainer">
												<select name="show_products_option" class="form-control" onchange="show_products_option_changed(this)">											
													<option <?php if ($which_products_to_show == 1) { echo ' selected '; } ?> value="1">Показывать Все Товары</option>
													<option <?php if ($which_products_to_show == 2) { echo ' selected '; } ?> value="2">Показывать Товары С Указанной Ценой</option>
													<option <?php if ($which_products_to_show == 3) { echo ' selected '; } ?> value="3">Показывать Товары Без Указанной Цены</option>											
												</select>
											</div>
										</div>									
									</td>								
									<td style="background:#f3f3f3;">
										<div class="form-group pull-right">
												<div class="selectContainer">
													<label class="control-label">Перейти на страницу</label>
													<select name="page_nu" class="form-control" onchange="ReloadPage(this)">	
													<?php
													
														if (isset($_POST['search_makat']) && $_POST['search_makat']!='')
														{
															$mkt_to_search = $_POST['search_makat'];
															$sql0="select count(1) n_of_r from products x where makat = '".$mkt_to_search."'";
														}
														elseif (isset($_POST['search_product']) && $_POST['search_product']!='')
														{
															$prd_to_search = $_POST['search_product'];
															$sql0="select count(1) n_of_r from products x where id = '".$prd_to_search."'";
														}
														else
														{
															$sql0="select count(1) n_of_r from products x where 1=1 ".$search_suffix;
														}
																						
														$result0 = $conn->query($sql0);
														$row0 = $result0->fetch_assoc();								
														$total_results = $row0["n_of_r"];									
														
														
														if (isset($_POST['search_makat']) && $_POST['search_makat']!='')
														{						
															$mkt_to_search = $_POST['search_makat'];
															$sql = "select * from (select p.id, p.is_featured, sc.name sub_cat, sc.id sub_cat_id, mc.name main_cat, mc.id main_cat_id, DATE_FORMAT(p.createdate,'%d/%m/%Y %H:%i:%s') created, DATE_FORMAT(p.modifydate, '%d/%m/%Y %H:%i:%s') modified, p.makat, p.title, p.photo1, p.category, p.short_desc, p.long_desc, p.price, p.show_price, p.nviews, p.status, p.is_new, p.is_discount, p.metall, p.quantity, p.color1, p.color2, p.color3, p.stone1, p.stone2, p.stone3, p.size1, p.size2, p.size3, p.remark, p.photo2, p.photo3 from products p, main_category mc, sub_category sc where p.makat='".$mkt_to_search."' and p.category=sc.id and sc.main_category = mc.id order by DATE_FORMAT(modifydate,'%d/%m/%Y %H:%i:%s') desc, id desc) M limit ".$p*$n_results_on_page.", ".$n_results_on_page;
														}
														elseif (isset($_POST['search_product']) && $_POST['search_product']!='')
														{
															$prd_to_search = $_POST['search_product'];
															$sql = "select * from (select p.id, p.is_featured, sc.name sub_cat, sc.id sub_cat_id, mc.name main_cat, mc.id main_cat_id, DATE_FORMAT(p.createdate,'%d/%m/%Y %H:%i:%s') created, DATE_FORMAT(p.modifydate, '%d/%m/%Y %H:%i:%s') modified, p.makat, p.title, p.photo1, p.category, p.short_desc, p.long_desc, p.price, p.show_price, p.nviews, p.status, p.is_new, p.is_discount, p.metall, p.quantity, p.color1, p.color2, p.color3, p.stone1, p.stone2, p.stone3, p.size1, p.size2, p.size3, p.remark, p.photo2, p.photo3 from products p, main_category mc, sub_category sc where p.id=".$prd_to_search." and p.category=sc.id and sc.main_category = mc.id order by DATE_FORMAT(modifydate,'%Y%m%d %H:%i:%s') desc, id desc) M limit ".$p*$n_results_on_page.", ".$n_results_on_page;
														}
														else
														{
															$sql = "select * from (select p.id, p.is_featured, sc.name sub_cat, sc.id sub_cat_id, mc.name main_cat, mc.id main_cat_id, DATE_FORMAT(p.createdate,'%d/%m/%Y %H:%i:%s') created, DATE_FORMAT(p.modifydate, '%d/%m/%Y %H:%i:%s') modified, p.makat, p.title, p.photo1, p.category, p.short_desc, p.long_desc, p.price, p.show_price, p.nviews, p.status, p.is_new, p.is_discount, p.metall, p.quantity, p.color1, p.color2, p.color3, p.stone1, p.stone2, p.stone3, p.size1, p.size2, p.size3, p.remark, p.photo2, p.photo3 from products p, main_category mc, sub_category sc where p.category=sc.id and sc.main_category = mc.id ".$search_suffix." order by DATE_FORMAT(modifydate,'%Y%m%d %H:%i:%s') desc, id desc) M limit ".$p*$n_results_on_page.", ".$n_results_on_page;								
														}
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
													
														for ($idx=$first_page; $idx<=$last_page; $idx++)
														{
															
															if ($idx == $p)
															{
																$prefix_selected = 'selected';
															}
															else
															{
																$prefix_selected = '';
															}
													?>
														<option <? echo $prefix_selected; ?> value="<? echo $idx ; ?>"><? echo ($idx + 1); ?></option>
													<?php
														}
													?>
													</select>
												</div>
											</div>
									</td>																	
								</tr>
								</table>								
								
									
								  <table class="table table-striped" >
									<thead>
									  <tr>
										<th>Номер</th>									
										<th>Изменен</th>
										<th>Категория</th>
										<th>Под-категория</th>
										<th>Макат</th>
										<th>Название</th>
										<th>Фото</th>
										<th>Просм.</th>									
										<th>Цена</th>										
										<th>
											<button type="button" class="btn btn-primary btn-sm" onClick="newProduct();">
												Добавить
											</button>											
										</th>
								
									  </tr>
									</thead>
									<tbody>								 
							
								<?php
								
								if ($result->num_rows > 0)
								{
								
									while($row = $result->fetch_assoc()) 
									{
									
										$recs_on_screen[] = $row;
									
											if ($row["status"] == 0)
											{
										?>
											<tr style="background-color: #fc9f9f">
										<?php
											}
											elseif ($row["show_price"] == '0')
											{
										?>	
											<tr style="background-color: #f3fbc9">
											
										<?php
											}
											else
											{											
										?>
											<tr>
										<?php
											}
										?>
										<td><a href="./../item.php?i=<?php echo $row["id"]; ?>#come_here" target="_blank"><?php echo $row["id"]; ?></a></td>
										<td><?php echo $row["modified"]; ?></td>
										<td><?php echo $row["main_cat"]; ?></td>
										<td><?php echo $row["sub_cat"]; ?></td>
										<td><?php echo $row["makat"]; ?></td>
										<td><?php echo $row["title"]; ?></td>
										<td><a href="#"><img src="./../<?php echo $row["photo1"]; ?>" width="60" title="<?php echo $row["title"]; ?>" height="60" border="0" onClick="showImageModalWindow(this);"  style="border-radius:3px; box-shadow: 2px 2px 3px #888888;"></a></td>
										<td><?php echo $row["nviews"]; ?></td>										
										<td <?php if ($row["show_price"] == '0') { echo 'style="text-decoration: line-through"'; } ?>><?php echo $row["price"]; ?></td>										
										<td>
											<button type="button" class="btn btn-success btn-sm" onClick="editProduct('<?php echo $row["id"]; ?>');">
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
									<li><a href="dashboard4.php?p=<?php echo $first_page; ?>">Начало</a></li>
									<li><a href="dashboard4.php?p=<?php echo $prv_page; ?>">Предыдущая</a></li>
									<li><a href="dashboard4.php?p=<?php echo $p; ?>">Это <?php echo ($p+1); ?> страница</a></li>
									<li><a href="dashboard4.php?p=<?php echo $nxt_page; ?>">Следующая</a></li>
									<li><a href="dashboard4.php?p=<?php echo $last_page; ?>">Конец</a></li>
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
				
				<!-- start Товары -->
					
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
                    Создать новый товар
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form role="form" data-toggle="validator" name="CreateNewProduct" enctype="multipart/form-data" method="post">
						
					<div>

					  <!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#aa" aria-controls="aa" role="tab" data-toggle="tab">Свойства</a></li>
						<li role="presentation"><a href="#bb" aria-controls="bb" role="tab" data-toggle="tab">Дополнение #1</a></li>
						<li role="presentation"><a href="#cc" aria-controls="cc" role="tab" data-toggle="tab">Дополнение #2</a></li>	
						<li role="presentation" class="pull-right">	
							<span id="sp_btn_010">
							<input type='checkbox' id='confirmDelete' onChange="confirmDeleteFn()">&nbsp;
							<button type="reset" onclick="deleteProduct()" class="btn btn-danger btn-sm disabled" id="deleteButton" name="deleteButton">
								Удалить этот товар!
							</button></span>							
						</li>	
						
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
										<td style="padding:5px;">
											<div id="inp_makat" class="form-group" >
												<label for="makat">Макат</label>
												  <input class="form-control" onkeydown="limit(this, 10);" onkeyup="limit(this, 10);"
												  id="makat" name="makat" placeholder="AB10C235"/>
											</div>									
										</td>
										<td style="padding:5px;">								 
											<div id="inp_title" class="form-group" >
												<label for="title">Название</label>
												  <input class="form-control" onkeydown="limit(this, 24);" onkeyup="limit(this, 24);"
												  id="title" name="title" placeholder="Черный принц"/>
											</div>																		
										</td>	
										<td style="padding:5px;">								 
											<div id="inp_price" class="form-group" >
												<label for="price">Цена</label>
												  <input class="form-control" onkeydown="limit(this, 10);" onkeyup="limit(this, 10);"
												  id="price" name="price" placeholder="100"/>
											</div>																		
										</td>									
									</tr>
									<tr>
										<td style="padding:5px;">
											<div id="inp_categ" class="form-group" >
												<label >Категория</label>
												<div >
													<select class="form-control" id="categ" name="categ" onChange="catalogChanged(this.options[this.selectedIndex].value);">
														<option value="">Выберите...</option>
														<option value="cat_1">Категория 1</option>
														<option value="cat_2">Категория 2</option>
														<option value="cat_2">Категория 3</option>								
													</select>
												</div>
											</div>									
										</td>
										<td style="padding:5px;">								 
											<div id="inp_sub_categ" class="form-group" >
												<label >Под-Категория</label>
												<div >
													<select class="form-control" id="sub_categ" name="sub_categ">
														<option value="">Выберите...</option>							
													</select>
												</div>
											</div>																		
										</td>	
										<td style="padding:5px;">								 
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
											<div id="inp_short_desc" class="form-group" >
												<label for="short_desc">Краткое описание</label>
												  <input class="form-control" onkeydown="limit(this, 60);" onkeyup="limit(this, 60);"
												  id="short_desc" name="short_desc" placeholder="Самое чудесное украшение на свете!"/>
											</div>									
										</td>
									</tr>
									<tr>
										<td colspan="3" style="padding:5px;">
											<div id="inp_long_desc" class="form-group">
												<label for="long_desc">Расширенное описание</label>
												<textarea id="long_desc"  name="long_desc" class="form-control" placeholder="Самое чудесное украшение на свете!"></textarea>
											</div>
										</td>
									</tr>								
								</table>
								<!-- end главные свойства -->
								
								</div> <!-- content -->
							
							</div>
						
						</div>
						<div role="tabpanel" class="tab-pane" id="bb">
						
						
							<div>
							
								<div class="clearfix" style="margin-bottom:20px;"></div>
							
							
								<div class="content"  style="overflow-x:auto;">  
								<!-- start second panel -->
							
								<table border='0' class="table" style="margin-left:auto; margin-right:auto">
									<tr>
										<td style="padding:5px;">
											<div id="inp_is_new" class="form-group" >
												<label >Новинка?</label>
												<div >
													<select class="form-control" id="is_new" name="is_new">
														<option value="">Выберите...</option>
														<option value="1" selected>Да</option>
														<option value="0">Нет</option>								
													</select>
												</div>
											</div>									
										</td>
										<td style="padding:5px;">
											<div id="inp_is_discount" class="form-group" >
												<label >По скидке?</label>
												<div >
													<select class="form-control" id="is_discount" name="is_discount">
														<option value="">Выберите...</option>
														<option value="1">Да</option>
														<option value="0" selected>Нет</option>								
													</select>
												</div>
											</div>									
										</td>	
										<td style="padding:5px;">
											<div id="inp_show_price" class="form-group" >
												<label>Показ цену?</label>
												<div >
													<select class="form-control" id="show_price" name="show_price">
														<option value="">Выберите...</option>
														<option value="1" selected>Да</option>
														<option value="0">Нет</option>														
													</select>
												</div>
											</div>									
										</td>									
									</tr>
									<tr>
										<td style="padding:5px;">
											<div id="inp_metall" class="form-group" >
												<label>Материал</label>
												<div >
													<select class="form-control" id="metall" name="metall">
														<option value="">Выберите...</option>
														<option value="1">Серебро 925</option>
														<option value="2">Позолота</option>
														<option value="3">Другой</option>								
													</select>
												</div>
											</div>									
										</td>
										<td style="padding:5px;">
											<div id="inp_qty" class="form-group" >
												<label for="qty">Количество</label>
												  <input class="form-control" onkeydown="limit(this, 5);" onkeyup="limit(this, 5);"
												  id="qty" name="qty" placeholder="1" value="1" />
											</div>									
										</td>
										<td style="padding:5px;">
											<div id="inp_statuss" class="form-group" >
												<label >Статус</label>
												<div >
													<select class="form-control" id="statuss" name="statuss">
														<option value="">Выберите...</option>
														<option value="1" selected>Активный</option>
														<option value="0">Неактивный</option>														
													</select>
												</div>
											</div>									
										</td>								
									</tr>
									<tr>
										<td style="padding:5px;">
											<div id="inp_color_1" class="form-group" >
												<label >Цвет 1</label>
												<div >
													<select class="form-control" id="color_1" name="color_1">
														<option value="">Выберите...</option>
														<option value="cat_1">Да</option>
														<option value="cat_2">Нет</option>								
													</select>
												</div>
											</div>									
										</td>
										<td style="padding:5px;">
											<div id="inp_color_2" class="form-group" >
												<label >Цвет 2</label>
												<div >
													<select class="form-control" id="color_2" name="color_2">
														<option value="">Выберите...</option>
														<option value="cat_1">Да</option>
														<option value="cat_2">Нет</option>								
													</select>
												</div>
											</div>									
										</td>	
										<td style="padding:5px;">
											<div id="inp_color_3" class="form-group" >
												<label >Цвет 3</label>
												<div >
													<select class="form-control" id="color_3" name="color_3">
														<option value="">Выберите...</option>
														<option value="cat_1">Да</option>
														<option value="cat_2">Нет</option>														
													</select>
												</div>
											</div>									
										</td>									
									</tr>
									<tr>
										<td style="padding:5px;">
											<div id="inp_stone_1" class="form-group" >
												<label >Камень 1</label>
												<div >
													<select class="form-control" id="stone_1" name="stone_1">
														<option value="">Выберете...</option>
														<option value="cat_1">Да</option>
														<option value="cat_2">Нет</option>								
													</select>
												</div>
											</div>									
										</td>
										<td style="padding:5px;">
											<div id="inp_stone_2" class="form-group" >
												<label >Камень 2</label>
												<div >
													<select class="form-control" id="stone_2" name="stone_2">
														<option value="">Выберите...</option>
														<option value="cat_1">Да</option>
														<option value="cat_2">Нет</option>								
													</select>
												</div>
											</div>									
										</td>	
										<td style="padding:5px;">
											<div id="inp_stone_3" class="form-group" >
												<label >Камень 3</label>
												<div >
													<select class="form-control" id="stone_3" name="stone_3">
														<option value="">Выберите...</option>
														<option value="cat_1">Да</option>
														<option value="cat_2">Нет</option>														
													</select>
												</div>
											</div>									
										</td>									
									</tr>									
									<tr>
										<td style="padding:5px;">
											<div id="inp_size_1" class="form-group" >
												<label >Размер 1</label>
												<div >
													<select class="form-control" id="size_1" name="size_1">
														<option value="">Выберите...</option>
														<option value="cat_1">Да</option>
														<option value="cat_2">Нет</option>								
													</select>
												</div>
											</div>									
										</td>
										<td style="padding:5px;">
											<div id="inp_size_2" class="form-group" >
												<label >Размер 2</label>
												<div >
													<select class="form-control" id="size_2" name="size_2">
														<option value="">Выберите...</option>
														<option value="ans_yes">Да</option>
														<option value="ans_no">Нет</option>								
													</select>
												</div>
											</div>									
										</td>	
										<td style="padding:5px;">
											<div id="inp_size_3" class="form-group" >
												<label >Размер 3</label>
												<div >
													<select class="form-control" id="size_3" name="size_3">
														<option value="">Выберите...</option>
														<option value="ans_yes">Да</option>
														<option value="ans_no">Нет</option>														
													</select>
												</div>
											</div>									
										</td>									
									</tr>								
								</table>							
							
							<!-- end second panel -->
							
								</div> <!-- content -->
						
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="cc">
						
							<div>
							
								<div class="clearfix" style="margin-bottom:20px;"></div>
						
								<div class="content"  style="overflow-x:auto;">  
						
								<!-- start 3 свойства -->
								<table border='0' class="table" style="margin-left:auto; margin-right:auto">
									<tr>
										<td style="padding:5px;">
										
											<table border='0' style="margin-left:auto; margin-right:auto">
											<tr>
											<td style="padding:15px; width:150px">
											<div id="inp_isfeatured" class="form-group" >
												<label >Рекомендуем</label>
												<div>
													<select class="form-control" id="isfeatured" name="isfeatured">
														<option value="">Выберите...</option>
														<option value="1">Да</option>
														<option value="0" selected>Нет</option>								
													</select>
												</div>
											</div>
											</td>											
											<td style="padding:15px; width:450px">
											<div id="inp_deviz" class="form-group" >
												<label for="deviz">Девиз товара</label>
												  <input class="form-control" onkeydown="limit(this, 50);" onkeyup="limit(this, 50);"
												  id="deviz" name="deviz" placeholder="Оригинальная идея!"/>
											</div>	
											</td>
											</table>
											
										</td>
									</tr>
									<tr>
										<td style="padding:5px;">	


											<table border='0' style="margin-left:auto; margin-right:auto">
											<tr>
											<td style="padding:15px; width:300px">
												<div id="inp_photo2" class="form-group" >
												<label for="photo2">Доп. фото #2</label><br/>
												<label class="btn btn-default" id="photo2_btn" for="my-file-selector2">
													<input id="my-file-selector2" name="my-file-selector2" type="file" style="display:none;" onchange="$('#upload-file-info2').html($(this).val());">
													<span id="upload-file-info2">Загрузить</span>												
												</label>
												&nbsp;<span id="img_placer2" style="display:none;"><img src="https://placehold.it/50x50" border="0" width="50" height="50" id="imgPlacerImg2"></span>															
												<!--
													<label for="exampleInputCouponType">Фото</label>
													  <span id="upload-file-info" class="btn btn-default btn-file" onchange="$('#upload-file-info').html($(this).val());">
														Загрузить Фото <input type="file">
													  </span> -->
												</div>	
											</td>											
											<td style="padding:15px; width:300px">
												<div id="inp_photo3" class="form-group" >
												<label for="photo3">Доп. фото #3</label><br/>
												<label class="btn btn-default" id="photo3_btn" for="my-file-selector3">
													<input id="my-file-selector3" name="my-file-selector3" type="file" style="display:none;" onchange="$('#upload-file-info3').html($(this).val());">
													<span id="upload-file-info3">Загрузить</span>												
												</label>
												&nbsp;<span id="img_placer3" style="display:none;"><img src="https://placehold.it/50x50" border="0" width="50" height="50" id="imgPlacerImg3"></span>
																						
												<!--
													<label for="exampleInputCouponType">Фото</label>
													  <span id="upload-file-info" class="btn btn-default btn-file" onchange="$('#upload-file-info').html($(this).val());">
														Загрузить Фото <input type="file">
													  </span> -->
												</div>	
											</td>
											</table>

										</td>	
									</tr>

								</table>
								<!-- end 3 свойства -->	

								</div> <!-- content -->
						
							</div>
						
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
                &nbsp;<span id="sp_btn_002"><button type="button" class="btn btn-default"
                        data-dismiss="modal" id="btn_004">
                            Я передумал, не изменять!
                </button></span>			
                &nbsp;<span id="sp_btn_003"><button type="submit" onclick="ajax_post(); return false;" class="btn btn-primary" id="btn_002">
                    Создать новый товар
                </button></span>
                &nbsp;<span id="sp_btn_004"><button type="submit" onclick="change_the_product(); return false;" class="btn btn-primary" id="btn_005">
                    Изменить товар
                </button></span>				
            </div>
        </div>
    </div>
</div>
<!-- End Modal New Record -->


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
	
			
		// new product dialog
		
		function newProduct()
		{
			document.getElementById("myModalLabel").innerHTML="Создать товар";
			
			document.getElementById("sp_btn_001").style.display='inline';
			document.getElementById("sp_btn_003").style.display='inline';			
			document.getElementById("sp_btn_002").style.display='none';
			document.getElementById("sp_btn_004").style.display='none';	
			document.getElementById("sp_btn_010").style.display='none';			
						
			document.getElementById("makat").value='';			
			document.getElementById("makat").style.borderColor = "#e3e3e3";
			document.getElementById("makat").style.boxShadow = "none";
			
			document.getElementById("title").value='';			
			document.getElementById("title").style.borderColor = "#e3e3e3";
			document.getElementById("title").style.boxShadow = "none";			
						
			document.getElementById("price").value='';			
			document.getElementById("price").style.borderColor = "#e3e3e3";
			document.getElementById("price").style.boxShadow = "none";	

			document.getElementById("categ").value='';			
			document.getElementById("categ").style.borderColor = "#e3e3e3";
			document.getElementById("categ").style.boxShadow = "none";			
						
			document.getElementById("sub_categ").value='';			
			document.getElementById("sub_categ").style.borderColor = "#e3e3e3";
			document.getElementById("sub_categ").style.boxShadow = "none";									
			
			document.getElementById('img_placer').style.display= "none";
			document.getElementById('img_placer2').style.display= "none";
			document.getElementById('img_placer3').style.display= "none";
	 
	 		document.getElementById("photo1_btn").style.borderColor = "#e3e3e3";
			document.getElementById("photo1_btn").style.boxShadow = "none";
			
	 		document.getElementById("photo2_btn").style.borderColor = "#e3e3e3";
			document.getElementById("photo2_btn").style.boxShadow = "none";

	 		document.getElementById("photo3_btn").style.borderColor = "#e3e3e3";
			document.getElementById("photo3_btn").style.boxShadow = "none";			
			
			document.getElementById("short_desc").value='';			
			document.getElementById("short_desc").style.borderColor = "#e3e3e3";
			document.getElementById("short_desc").style.boxShadow = "none";	

			document.getElementById("long_desc").value='';			
			document.getElementById("long_desc").style.borderColor = "#e3e3e3";
			document.getElementById("long_desc").style.boxShadow = "none";				
						
						
			document.getElementById("stone_1").value='';			
			document.getElementById("stone_1").style.borderColor = "#e3e3e3";
			document.getElementById("stone_1").style.boxShadow = "none";					
					
			document.getElementById("stone_2").value='';			
			document.getElementById("stone_2").style.borderColor = "#e3e3e3";
			document.getElementById("stone_2").style.boxShadow = "none";	

			document.getElementById("stone_3").value='';			
			document.getElementById("stone_3").style.borderColor = "#e3e3e3";
			document.getElementById("stone_3").style.boxShadow = "none";


			document.getElementById("color_1").value='';			
			document.getElementById("color_1").style.borderColor = "#e3e3e3";
			document.getElementById("color_1").style.boxShadow = "none";					
					
			document.getElementById("color_2").value='';			
			document.getElementById("color_2").style.borderColor = "#e3e3e3";
			document.getElementById("color_2").style.boxShadow = "none";	

			document.getElementById("color_3").value='';			
			document.getElementById("color_3").style.borderColor = "#e3e3e3";
			document.getElementById("color_3").style.boxShadow = "none";
			
			document.getElementById("size_1").value='';			
			document.getElementById("size_1").style.borderColor = "#e3e3e3";
			document.getElementById("size_1").style.boxShadow = "none";					
					
			document.getElementById("size_2").value='';			
			document.getElementById("size_2").style.borderColor = "#e3e3e3";
			document.getElementById("size_2").style.boxShadow = "none";	

			document.getElementById("size_3").value='';			
			document.getElementById("size_3").style.borderColor = "#e3e3e3";
			document.getElementById("size_3").style.boxShadow = "none";						
			
			document.getElementById("deviz").value='';			
			document.getElementById("deviz").style.borderColor = "#e3e3e3";
			document.getElementById("deviz").style.boxShadow = "none";				
			
			document.getElementById("is_new").value='1';			
			document.getElementById("is_new").style.borderColor = "#e3e3e3";
			document.getElementById("is_new").style.boxShadow = "none";
			
			document.getElementById("is_discount").value='0';			
			document.getElementById("is_discount").style.borderColor = "#e3e3e3";
			document.getElementById("is_discount").style.boxShadow = "none";			
			
			document.getElementById("show_price").value='1';			
			document.getElementById("show_price").style.borderColor = "#e3e3e3";
			document.getElementById("show_price").style.boxShadow = "none";
			
			document.getElementById("metall").value='';			
			document.getElementById("metall").style.borderColor = "#e3e3e3";
			document.getElementById("metall").style.boxShadow = "none";	

			document.getElementById("qty").value='1';			
			document.getElementById("qty").style.borderColor = "#e3e3e3";
			document.getElementById("qty").style.boxShadow = "none";				
			
			document.getElementById("statuss").value='1';			
			document.getElementById("statuss").style.borderColor = "#e3e3e3";
			document.getElementById("statuss").style.boxShadow = "none";			
			
			$('#myModalNewRecord').modal('show')
		}		
		
		// edit product dialog
		
		function editProduct(n)
		{			
			
			// clean up red color...
					
			document.getElementById("makat").style.borderColor = "#e3e3e3";
			document.getElementById("makat").style.boxShadow = "none";
					
			document.getElementById("title").style.borderColor = "#e3e3e3";
			document.getElementById("title").style.boxShadow = "none";			
								
			document.getElementById("price").style.borderColor = "#e3e3e3";
			document.getElementById("price").style.boxShadow = "none";	
		
			document.getElementById("categ").style.borderColor = "#e3e3e3";
			document.getElementById("categ").style.boxShadow = "none";			
	
			document.getElementById("sub_categ").style.borderColor = "#e3e3e3";
			document.getElementById("sub_categ").style.boxShadow = "none";									
			
			document.getElementById('img_placer').style.display= "none";
			document.getElementById('img_placer2').style.display= "none";
			document.getElementById('img_placer3').style.display= "none";
	 
	 		document.getElementById("photo1_btn").style.borderColor = "#e3e3e3";
			document.getElementById("photo1_btn").style.boxShadow = "none";
				 		
			document.getElementById("short_desc").style.borderColor = "#e3e3e3";
			document.getElementById("short_desc").style.boxShadow = "none";	
			
			document.getElementById("long_desc").style.borderColor = "#e3e3e3";
			document.getElementById("long_desc").style.boxShadow = "none";					
			
			
			// open modal dialog for this item to edit
						
			document.getElementById("myModalLabel").innerHTML="Изменить товар";

			document.getElementById("sp_btn_001").style.display='none';
			document.getElementById("sp_btn_003").style.display='none';			
			document.getElementById("sp_btn_002").style.display='inline';
			document.getElementById("sp_btn_004").style.display='inline';
			document.getElementById("sp_btn_010").style.display='inline';

						
			var js_recs_on_screen = <?php echo json_encode($recs_on_screen) ?>;
			
			for(idx=0; idx<js_recs_on_screen.length; idx++)
			{
				if (js_recs_on_screen[idx]["id"] == n)
				{
									
					document.getElementById("rowid").value=js_recs_on_screen[idx]["id"];
					
					document.getElementById("makat").value=js_recs_on_screen[idx]["makat"];
					document.getElementById("title").value=js_recs_on_screen[idx]["title"];
					document.getElementById("price").value=js_recs_on_screen[idx]["price"];
					
					document.getElementById('categ').value=js_recs_on_screen[idx]["main_cat_id"];
					
					var js_cats_and_subcats = <?php echo json_encode($cats_and_subcats) ?>;
					var subCatSelect = document.getElementById("sub_categ");
					
					subCatSelect.options.length = 0;
					
					var opt = document.createElement('option');
						opt.value = "";
						opt.innerHTML = "Выберите...";
						subCatSelect.appendChild(opt);		
						
					 
					for(var i=0 ; i<js_cats_and_subcats.length ; i++)
					{
					
						if (js_cats_and_subcats[i].main_cat_id == js_recs_on_screen[idx]["main_cat_id"])
						{
							var opt = document.createElement('option');
								opt.value = js_cats_and_subcats[i]['sub_cat_id'];
								opt.innerHTML = js_cats_and_subcats[i]['sub_cat_name'];
								subCatSelect.appendChild(opt);
						}
					}
																
					document.getElementById('sub_categ').value=js_recs_on_screen[idx]["sub_cat_id"];
										
					document.getElementById('imgPlacerImg').src='./../'+js_recs_on_screen[idx]["photo1"];
					document.getElementById('img_placer').style.display="inline";
					
					
					document.getElementById("short_desc").value=js_recs_on_screen[idx]["short_desc"];
					document.getElementById("long_desc").value=js_recs_on_screen[idx]["long_desc"];
					
					
					document.getElementById("is_new").value=js_recs_on_screen[idx]["is_new"];
					document.getElementById("is_discount").value=js_recs_on_screen[idx]["is_discount"];
					document.getElementById("show_price").value=js_recs_on_screen[idx]["show_price"];
					document.getElementById("metall").value=js_recs_on_screen[idx]["metall"];
					document.getElementById("qty").value=js_recs_on_screen[idx]["quantity"];
					document.getElementById("statuss").value=js_recs_on_screen[idx]["status"];
					
					document.getElementById("color_1").value=js_recs_on_screen[idx]["color1"];
					document.getElementById("color_2").value=js_recs_on_screen[idx]["color2"];
					document.getElementById("color_3").value=js_recs_on_screen[idx]["color3"];
		
					document.getElementById("stone_1").value=js_recs_on_screen[idx]["stone1"];
					document.getElementById("stone_2").value=js_recs_on_screen[idx]["stone2"];
					document.getElementById("stone_3").value=js_recs_on_screen[idx]["stone3"];

					document.getElementById("size_1").value=js_recs_on_screen[idx]["size1"];
					document.getElementById("size_2").value=js_recs_on_screen[idx]["size2"];
					document.getElementById("size_3").value=js_recs_on_screen[idx]["size3"];					
					
					document.getElementById("deviz").value=js_recs_on_screen[idx]["remark"];
					document.getElementById("isfeatured").value=js_recs_on_screen[idx]["is_featured"];
					
					if (js_recs_on_screen[idx]["photo2"])
					{
						document.getElementById('imgPlacerImg2').src='./../'+js_recs_on_screen[idx]["photo2"];
						document.getElementById('img_placer2').style.display="inline";
					}

					if (js_recs_on_screen[idx]["photo3"])
					{
						document.getElementById('imgPlacerImg3').src='./../'+js_recs_on_screen[idx]["photo3"];
						document.getElementById('img_placer3').style.display="inline";					
					}
					
				}
			}
			
			
			$('#myModalNewRecord').modal('show');
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

	});*/
	
	$(function(){
		$("#retroclockbox1").flipcountdown({
			size:"sm"
		});
	})
	
	// populate category drop down -- start
			
	var js_cats = <?php echo json_encode( $arr_categ ) ?>;	
	var catSelect = document.getElementById("categ");
	
	catSelect.options.length = 0;
	
	var opt = document.createElement('option');
		opt.value = "";
		opt.innerHTML = "Выберите...";
		catSelect.appendChild(opt);		
		
	 
	for(var i=0 ; i<js_cats.length ; i++)
	{
		var opt = document.createElement('option');
			opt.value = js_cats[i]['main_cat_id'];
			opt.innerHTML = js_cats[i]['main_cat_name'];
			catSelect.appendChild(opt);
	}
	 
	// populate category drop down -- end
	
	
	// populate metall drop down -- start
			
	var js_metalls = <?php echo json_encode( $metalls ) ?>;	
	var metallSelect = document.getElementById("metall");
	
	metallSelect.options.length = 0;
	
	var opt = document.createElement('option');
		opt.value = "";
		opt.innerHTML = "Выберите...";
		metallSelect.appendChild(opt);		
		
	 
	for(var i=0 ; i<js_metalls.length ; i++)
	{
		var opt = document.createElement('option');
			opt.value = js_metalls[i]['id'];
			opt.innerHTML = js_metalls[i]['name'];
			metallSelect.appendChild(opt);
	}
	 
	// populate metall drop down -- end	
	
	
	// populate colors drop down x 3 -- start
			
	var js_colors = <?php echo json_encode( $colors ) ?>;
	
	var colors1Select = document.getElementById("color_1");
	var colors2Select = document.getElementById("color_2");
	var colors3Select = document.getElementById("color_3");
	
	colors1Select.options.length = 0;
	colors2Select.options.length = 0;
	colors3Select.options.length = 0;
	
	var opt1 = document.createElement('option');
		opt1.value = "";
		opt1.innerHTML = "Выберите...";
		colors1Select.appendChild(opt1);

	var opt2 = document.createElement('option');
		opt2.value = "";
		opt2.innerHTML = "Выберите...";
		colors2Select.appendChild(opt2);
		
	var opt3 = document.createElement('option');
		opt3.value = "";
		opt3.innerHTML = "Выберите...";
		colors3Select.appendChild(opt3);
			 
	for(var i=0 ; i<js_colors.length ; i++)
	{
		var opt1 = document.createElement('option');
			opt1.value = js_colors[i]['id'];
			opt1.innerHTML = js_colors[i]['name'];
			colors1Select.appendChild(opt1);
			
		var opt2 = document.createElement('option');
			opt2.value = js_colors[i]['id'];
			opt2.innerHTML = js_colors[i]['name'];
			colors2Select.appendChild(opt2);
			
		var opt3 = document.createElement('option');
			opt3.value = js_colors[i]['id'];
			opt3.innerHTML = js_colors[i]['name'];
			colors3Select.appendChild(opt3);
	}
	 
	// populate colors drop down -- end		
	
	
	// populate stones drop down x 3 -- start
			
	var js_stones = <?php echo json_encode( $stones ) ?>;
	
	var stones1Select = document.getElementById("stone_1");
	var stones2Select = document.getElementById("stone_2");
	var stones3Select = document.getElementById("stone_3");
	
	stones1Select.options.length = 0;
	stones2Select.options.length = 0;
	stones3Select.options.length = 0;
	
	var opt1 = document.createElement('option');
		opt1.value = "";
		opt1.innerHTML = "Выберите...";
		stones1Select.appendChild(opt1);

	var opt2 = document.createElement('option');
		opt2.value = "";
		opt2.innerHTML = "Выберите...";
		stones2Select.appendChild(opt2);
		
	var opt3 = document.createElement('option');
		opt3.value = "";
		opt3.innerHTML = "Выберите...";
		stones3Select.appendChild(opt3);
			 
	for(var i=0 ; i<js_stones.length ; i++)
	{
		var opt1 = document.createElement('option');
			opt1.value = js_stones[i]['id'];
			opt1.innerHTML = js_stones[i]['name'];
			stones1Select.appendChild(opt1);
			
		var opt2 = document.createElement('option');
			opt2.value = js_stones[i]['id'];
			opt2.innerHTML = js_stones[i]['name'];
			stones2Select.appendChild(opt2);
			
		var opt3 = document.createElement('option');
			opt3.value = js_stones[i]['id'];
			opt3.innerHTML = js_stones[i]['name'];
			stones3Select.appendChild(opt3);
	}
	 
	// populate stones drop down -- end	


	// populate sizes drop down x 3 -- start
			
	var js_sizes = <?php echo json_encode( $sizes ) ?>;
	
	var sizes1Select = document.getElementById("size_1");
	var sizes2Select = document.getElementById("size_2");
	var sizes3Select = document.getElementById("size_3");
	
	sizes1Select.options.length = 0;
	sizes2Select.options.length = 0;
	sizes3Select.options.length = 0;
	
	var opt1 = document.createElement('option');
		opt1.value = "";
		opt1.innerHTML = "Выберите...";
		sizes1Select.appendChild(opt1);

	var opt2 = document.createElement('option');
		opt2.value = "";
		opt2.innerHTML = "Выберите...";
		sizes2Select.appendChild(opt2);
		
	var opt3 = document.createElement('option');
		opt3.value = "";
		opt3.innerHTML = "Выберите...";
		sizes3Select.appendChild(opt3);
			 
	for(var i=0 ; i<js_sizes.length ; i++)
	{
		var opt1 = document.createElement('option');
			opt1.value = js_sizes[i]['id'];
			opt1.innerHTML = js_sizes[i]['name'];
			sizes1Select.appendChild(opt1);
			
		var opt2 = document.createElement('option');
			opt2.value = js_sizes[i]['id'];
			opt2.innerHTML = js_sizes[i]['name'];
			sizes2Select.appendChild(opt2);
			
		var opt3 = document.createElement('option');
			opt3.value = js_sizes[i]['id'];
			opt3.innerHTML = js_sizes[i]['name'];
			sizes3Select.appendChild(opt3);
	}
	 
	// populate sizes drop down -- end		
	
	</script> 
    

</html>
