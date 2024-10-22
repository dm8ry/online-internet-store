<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="ru">
<head>
<title>магазин украшений "Crystal Sky" - скидки, бонусы, подарки</title>
<link href="css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="магазин, украшений, CrystalSky, Crystal, Sky, скидки, бонусы, подарки" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
</script>
<script src="js/jquery.min.js"></script>
<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#horizontalTab').easyResponsiveTabs({
				type: 'default',        
				width: 'auto',  
				fit: true   
			});
		});
	   </script>
	   
		<script>
		
		function validateEmail(email) {
			var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return re.test(email);
		}	  		
		
		function createLead()
		{			
		
			document.getElementById("lead_email").style.border = "thick solid black";
			document.getElementById("lead_name").style.border = "thick solid black";
			document.getElementById("lead_phone").style.border = "thick solid black";
			document.getElementById("lead_city").style.border = "thick solid black";
		
			var nErrors =0;
			
			
			if (document.getElementById("lead_name").value==null || document.getElementById("lead_name").value=="")
			{									
				document.getElementById("lead_name").style.border = "thick solid red";
				nErrors++;
			}	
			else 
			{
				document.getElementById("lead_name").style.border = "thick solid green";
			}				
			
			if (document.getElementById("lead_email").value==null || document.getElementById("lead_email").value=="")
			{	
				document.getElementById("lead_email").style.border = "thick solid red";
				nErrors++;
			}	
			else if (!validateEmail(document.getElementById("lead_email").value))
			{							
				document.getElementById("lead_email").style.border = "thick solid red";
				nErrors++;			
			}		
			else 
			{
				document.getElementById("lead_email").style.border = "thick solid green";
			}				
				
			if (document.getElementById("lead_phone").value==null || document.getElementById("lead_phone").value=="")
			{	
				document.getElementById("lead_phone").style.border = "thick solid red";
				nErrors++;
			}	
			else 
			{
				document.getElementById("lead_phone").style.border = "thick solid green";
			}
			
			if (document.getElementById("lead_city").value==null || document.getElementById("lead_city").value=="")
			{	
				document.getElementById("lead_city").style.border = "thick solid red";
				nErrors++;
			}	
			else 
			{
				document.getElementById("lead_city").style.border = "thick solid green";
			}
			
			if (nErrors==0)
			{

				var url = "sendmail.php";
			
				var oData = new FormData(document.forms.namedItem("frmCreateLead"));
				
				var oReq = new XMLHttpRequest();
				  oReq.open("POST", url, true);
				  oReq.onload = function(oEvent) {
					  												
					if (oReq.status == 200) 
					{										
						document.getElementById("lead_span").innerHTML=oReq.responseText;
						document.getElementById("lead_register").innerHTML='';
						return;	
					}
					
				  };
				oReq.send(oData);

			}

		}  		
		
		</script>
</head>
<body>
	<h1><a href="http://crystalsky.co.il/lp/2" style="color:white">магазин украшений "Crystal Sky"</a></h1>
			
<div class="main-content">
	<div class="sap_tabs">	
		 
		<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
		 
			  <ul>
			  	  <li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><a href="http://crystalsky.co.il/lp/2" style="color:white"><span id="lead_span">Наши мероприятия и скидки</span></a></li>
			  </ul>		

			<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
				<div class="facts">
					<!--login1-->
					<div class="register" id="lead_register">
						<form  enctype="multipart/form-data" method="post" name="frmCreateLead">	
							<input placeholder="Ваше Имя" name="lead_name" id="lead_name" type="text" >
							<input placeholder="Ваш Емайл" name="lead_email" id="lead_email" type="text" >									
							<input placeholder="Ваш Телефон" name="lead_phone" id="lead_phone" type="text" >	
							<input placeholder="Ваш Город" name="lead_city" id="lead_city" type="text" >
								<div class="sign-up">
									<input type="submit" onclick="createLead(); return false;" value="Узнать подробнее..."/>									
								</div>
						</form>
					</div>
				</div>
			</div>	
					        					            	      			 	
		</div>	
		
	</div>
</div>
	 <!--start-copyright-->
   		<div class="copy-right">
   			<div class="wrap">
				<p>&copy; 2016 магазин украшений "Crystal Sky". All Rights Reserved.</p>
			</div>
		</div>
	<!--//end-copyright-->
 
</body>
</html>