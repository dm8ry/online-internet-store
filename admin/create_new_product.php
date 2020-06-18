<?php

	//
	// create new product
	//

	include_once('./../db_connect.php');
	include_once('./../admin_email.php');
	
	mb_internal_encoding("UTF-8");
	
	$uploadOk = 1;
	$uploadOk1 = 1;
	$uploadOk2 = 1;	
	
	/////////////////////////////////////////
	//
	// check if makat exists
	//
	///////////////////////////////////////////
	

	// Create connection
	$conn0 = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn0->connect_error) {
		die("Connection failed: " . $conn0->connect_error);
	} 

	$conn0->query("set names 'utf8'");	
	
	$sql0 = "SELECT * FROM products where makat = '".$_POST['makat']."'";
	
	$result0 = $conn0->query($sql0);

	if ($result0->num_rows == 1) 
	{    
		echo "Ошибка! Существующий Макат!";
		exit;	    
	} 
	else 
	{
		// Ok
	}
	
	$conn0->close();
	
	////////////////////////////////
	//  upload img 1
	//
	
	if ($_FILES["my-file-selector"]["name"])
	{	
		/*
		$sfx_date = new DateTime("now", new DateTimeZone('Asia/Jerusalem') );
		$sfx_cur_dt =  $sfx_date->format('Ymd_His'); */
		
		$now = DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', ''));
		$sfx_date = $now->setTimeZone(new DateTimeZone('Asia/Jerusalem'));
		$sfx_cur_dt = $sfx_date->format("Ymd_His_u");			
			
		$target_suffix = "";
		$target_dir = "./../app_data/app_images/";
		$target_file = $target_dir . $sfx_cur_dt. "_". basename($_FILES["my-file-selector"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		
		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["my-file-selector"]["tmp_name"]);
		if($check !== false) {
			// echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
			
			if ($check[0] > 600 || $check[1] > 600 || $check[0] < 300 || $check[1] < 300)
			{
				echo "ФОТО1: дл/шир 300...600";
				exit;
				$uploadOk = 0;
			}			
			
		} else {
			echo "ФОТО1: это не фото!";
			exit;
			$uploadOk = 0;
		}	

		// Check if file already exists
		if (file_exists($target_file)) {
			echo "ФОТО1: Файл уже существует!";
			exit;
			$uploadOk = 0;
		}	
		
		// Check file size
		if ($_FILES["my-file-selector"]["size"] > 204800) {
			echo "ФОТО1: максимум 200КБ!";
			exit;
			$uploadOk = 0;
		}	
		
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "ФОТО1: только JPG, JPEG, PNG & GIF!";
			exit;
			$uploadOk = 0;
		}	
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "ФОТО1: не было загружено!";
			exit;
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["my-file-selector"]["tmp_name"], $target_file)) {
				// echo "Ok"; //echo "The file ". $target_file. " has been uploaded.";
			} else {
				echo "ФОТО1: Ошибка загрузки!";
				exit;
			}
		}	
	
	}
	
	//////////////////// end upload img 1 ///////////////////////////
	
	
	////////////////////////////////
	//  upload img 2
	//
	
	if ($_FILES["my-file-selector2"]["name"])
	{
		/*
		$sfx_date2 = new DateTime("now", new DateTimeZone('Asia/Jerusalem') );
		$sfx_cur_dt2 =  $sfx_date2->format('Ymd_His'); */
		
		$now = DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', ''));
		$sfx_date2 = $now->setTimeZone(new DateTimeZone('Asia/Jerusalem'));
		$sfx_cur_dt2 = $sfx_date2->format("Ymd_His_u");			
			
		$target_suffix2 = "";
		$target_dir2 = "./../app_data/app_images/";
		$target_file2 = $target_dir2 . $sfx_cur_dt2. "_". basename($_FILES["my-file-selector2"]["name"]);
		$uploadOk2 = 1;
		$imageFileType2 = pathinfo($target_file2,PATHINFO_EXTENSION);
		
		// Check if image file is a actual image or fake image
		$check2 = getimagesize($_FILES["my-file-selector2"]["tmp_name"]);
		if($check2 !== false) {
			// echo "File is an image - " . $check["mime"] . ".";
			$uploadOk2 = 1;
			
			if ($check2[0] > 600 || $check2[1] > 600 || $check2[0] < 300 || $check2[1] < 300)
			{
				echo "ФОТО2: дл/шир 300...600";
				exit;
				$uploadOk2 = 0;
			}				
			
		} else {
			echo "ФОТО2: это не фото!";
			exit;
			$uploadOk2 = 0;
		}	

		// Check if file already exists
		if (file_exists($target_file2)) {
			echo "ФОТО2: Файл уже существует!";
			exit;
			$uploadOk2 = 0;
		}	
		
		// Check file size
		if ($_FILES["my-file-selector2"]["size"] > 204800) {
			echo "ФОТО2: максимум 200КБ!";
			exit;
			$uploadOk2 = 0;
		}	
		
		// Allow certain file formats
		if($imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType2 != "jpeg"
		&& $imageFileType2 != "gif" ) {
			echo "ФОТО2: только JPG, JPEG, PNG & GIF!";
			exit;
			$uploadOk2 = 0;
		}	
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk2 == 0) {
			echo "ФОТО2: не было загружено!";
			exit;
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["my-file-selector2"]["tmp_name"], $target_file2)) {
				// echo "Ok"; //echo "The file ". $target_file. " has been uploaded.";
			} else {
				echo "ФОТО2: Ошибка загрузки!";
				exit;
			}
		}	
	
	}
	//////////////////// end upload img 2 ///////////////////////////	
	
	
	////////////////////////////////
	//  upload img 3
	//
	
	if ($_FILES["my-file-selector3"]["name"])
	{
		/*
		$sfx_date3 = new DateTime("now", new DateTimeZone('Asia/Jerusalem') );
		$sfx_cur_dt3 =  $sfx_date3->format('Ymd_His'); */
		
		$now = DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', ''));
		$sfx_date3 = $now->setTimeZone(new DateTimeZone('Asia/Jerusalem'));
		$sfx_cur_dt3 = $sfx_date3->format("Ymd_His_u");			
			
		$target_suffix3 = "";
		$target_dir3 = "./../app_data/app_images/";
		$target_file3 = $target_dir3 . $sfx_cur_dt3. "_". basename($_FILES["my-file-selector3"]["name"]);
		$uploadOk3 = 1;
		$imageFileType3 = pathinfo($target_file3,PATHINFO_EXTENSION);
		
		// Check if image file is a actual image or fake image
		$check3 = getimagesize($_FILES["my-file-selector3"]["tmp_name"]);
		if($check3 !== false) {
			// echo "File is an image - " . $check["mime"] . ".";
			$uploadOk3 = 1;
			
			if ($check3[0] > 600 || $check3[1] > 600 || $check3[0] < 300 || $check3[1] < 300)
			{
				echo "ФОТО3: дл/шир 300...600";
				exit;
				$uploadOk3 = 0;
			}			
			
		} else {
			echo "ФОТО3: это не фото!";
			exit;
			$uploadOk3 = 0;
		}	

		// Check if file already exists
		if (file_exists($target_file3)) {
			echo "ФОТО3: Такой файл уже существует!";
			exit;
			$uploadOk3 = 0;
		}	
		
		// Check file size
		if ($_FILES["my-file-selector3"]["size"] > 204800) {
			echo "ФОТО3: максимум 200КБ!";
			exit;
			$uploadOk3 = 0;
		}	
		
		// Allow certain file formats
		if($imageFileType3 != "jpg" && $imageFileType3 != "png" && $imageFileType3 != "jpeg"
		&& $imageFileType3 != "gif" ) {
			echo "ФОТО3: только JPG, JPEG, PNG & GIF!";
			exit;
			$uploadOk3 = 0;
		}	
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk3 == 0) {
			echo "ФОТО3: не было загружено!";
			exit;
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["my-file-selector3"]["tmp_name"], $target_file3)) {
				// echo "Ok"; //echo "The file ". $target_file. " has been uploaded.";
			} else {
				echo "ФОТО3: Ошибка загрузки!";
				exit;
			}
		}	
	
	}
	//////////////////// end upload img 3 ///////////////////////////	
	
	
	if ( ($uploadOk2==0) || ($uploadOk1==0) || ($uploadOk==0) )
	{
		echo "Error!";
		exit;
	}
	else
	{
		echo 'Ok';
	}
	
	
	function isValidEmail($email){ 
		return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
	}

	if (isset($_POST['makat']) && isset($_POST['title']) && isset($_POST['price']) && isset($_POST['categ']) && isset($_POST['sub_categ'])
		&& isset($_POST['short_desc']) && isset($_POST['long_desc']))
	{
	
		if ($target_file)
		{
			$photo1 = str_replace("./../", "", $target_file);
		}
		
		if ($target_file2)
		{
			$photo2 = str_replace("./../", "", $target_file2);
		}
		
		if ($target_file3)
		{
			$photo3 = str_replace("./../", "", $target_file3);
		}		
	
		//Email information
		$admin_email = $admin_email_address;
		$subject = "A new product created from Crystalsky.co.il";	

		$makat = htmlspecialchars (mb_substr($_POST['makat'], 0, 15));
	
		$makat=str_replace('"', "", $makat);
		$makat = str_replace("'", "", $makat);
		$makat = stripslashes($makat);	
			
		$title = htmlspecialchars (mb_substr($_POST['title'], 0, 24));
	
		$title=str_replace('"', "", $title);
		$title = str_replace("'", "", $title);
		$title = stripslashes($title);
		
		$subcateg = $_POST['sub_categ'];
	
		// $short_desc = htmlspecialchars (mb_substr($_POST['short_desc'], 0, 60));
	
		$short_desc = mb_substr($_POST['short_desc'], 0, 60);
		
		$short_desc=str_replace('"', "", $short_desc);
		$short_desc = str_replace("'", "", $short_desc);
		$short_desc = stripslashes($short_desc);
	
		// $lng_desc = htmlspecialchars (mb_substr($_POST['long_desc'], 0, 1000));
		
		$lng_desc = mb_substr($_POST['long_desc'], 0, 1000);
	
		$lng_desc=str_replace('"', "", $lng_desc);
		$lng_desc = str_replace("'", "", $lng_desc);
		$lng_desc = stripslashes($lng_desc);	

		$price = $_POST['price'];
			
		$is_new = $_POST['is_new'];	
		$is_discount = $_POST['is_discount'];
		
		if (($is_new == 1) and ($is_discount== 1))
		{
			$is_discount=1;
			$is_new =0;
		}
		
		$show_price = $_POST['show_price'];
		$metall = $_POST['metall'];	
		$qty = $_POST['qty'];
		$statuss= $_POST['statuss'];
		
		$color1= $_POST['color_1'];
		$color2= $_POST['color_2'];
		$color3= $_POST['color_3'];
		
		if ($color2 == $color1)  
		{ 
			$color2 = "";
		}
			
		if ($color3 == $color1)  
		{ 
			$color3 = "";
		}

		if ($color3 == $color2)  
		{ 
			$color3 = "";
		}


		$stone1= $_POST['stone_1'];
		$stone2= $_POST['stone_2'];
		$stone3= $_POST['stone_3'];
		
		if ($stone2 == $stone1)  
		{ 
			$stone2 = "";
		}
			
		if ($stone3 == $stone1)  
		{ 
			$stone3 = "";
		}

		if ($stone3 == $stone2)  
		{ 
			$stone3 = "";
		}		
	
		$size1= $_POST['size_1'];
		$size2= $_POST['size_2'];
		$size3= $_POST['size_3'];
		
		if ($size2 == $size1)  
		{ 
			$size2 = "";
		}
			
		if ($size3 == $size1)  
		{ 
			$size3 = "";
		}

		if ($size3 == $size2)  
		{ 
			$size3 = "";
		}					
		
		$isfeatured = $_POST['isfeatured'];
		
		$deviz = htmlspecialchars (mb_substr($_POST['deviz'], 0, 50));
	
		$deviz=str_replace('"', "", $deviz);
		$deviz = str_replace("'", "", $deviz);
		$deviz = stripslashes($deviz);		
			
		$date = new DateTime("now", new DateTimeZone('Asia/Jerusalem') );
		$cur_dt =  $date->format('d-m-Y H:i:s');  
		$db_cur_dt = $date->format('Y-m-d H:i:s'); // same format as NOW()	
		
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		
		$headers = "From: " . strip_tags($admin_email) . "\r\n";
		$headers .= "Reply-To: ". strip_tags($admin_email) . "\r\n";		
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";		
		  
		$message = '<html><body>Здравствуйте, Crystalsky!' . '<br/><br/> ' ."\n" .
					 'Новый продукт был добавлен с панели управления Crystalsky.co.il!' . '<br/><br/> ' ."\n" .
					 'Дата добавления: <b>' . $cur_dt . '</b><br/> ' ."\n" .
					 'Макат товара: <b>' . $makat . '</b><br/>' ."\n" .
					 'Наименование товара: <b>' . $title . '</b><br/>' ."\n" .
					 'Короткое описание товара: <b>' . $short_desc . '</b><br/>' ."\n" .
					 'Расширенное описание товара: <b>' . $lng_desc . '</b><br/>' ."\n" .
					 'Изображение товара: <img src="http://crystalsky.co.il/'.$photo1.'" width="100" height="100" border="0"><br/>' ."\n" .
					 '<br/>С уважением, ' . ' <br/> ' ."\n" .
					 'Администрация.</body></html>';		
		
		 	if (!mail($admin_email, "$subject", $message, $headers)) 
			{
			   // something wrong...
			   // echo "something wrong ";
			   
			} else
			{  				
				// everything is good...
				// echo "everything is good ";
				
				// log into businesslog
				
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 

				$conn->query("set names 'utf8'");
				
				$sql = "INSERT INTO businesslog (datex, alert_type, ip_addr, email, the_info) 
				VALUES ('$db_cur_dt', 'NEW_PRODUCT_CREATED', '$ip_addr', '$admin_email', '$message' )";

				if ($conn->query($sql) === TRUE) {
					//  echo "1 New record created successfully";
				} else {
					// echo "Error1: " . $sql . "<br>" . $conn->error;
				}

				$sql2 = "INSERT INTO products (createdate, modifydate, makat, title, category, short_desc, long_desc, price, photo1, is_new, is_discount, show_price, metall, quantity, status, color1, color2, color3, stone1, stone2, stone3, size1, size2, size3, remark, photo2, photo3, is_featured) 
				VALUES ('$db_cur_dt', '$db_cur_dt', '$makat', '$title', '$subcateg', '$short_desc', '$lng_desc', $price, '$photo1', '$is_new', '$is_discount', '$show_price', '$metall', $qty, '$statuss', '$color1', '$color2', '$color3', '$stone1', '$stone2', '$stone3', '$size1', '$size2', '$size3', '$deviz', '$photo2', '$photo3', '$isfeatured')";

				if ($conn->query($sql2) === TRUE) {
					//  echo "2 New record created successfully";
				} else {
					//  echo "Error2: " . $sql . "<br>" . $conn->error;
				}				
				
				$sql3 = "update sub_category  sc
						set sc.qty= (select count(1) from products  p where p.status = 1 and p.category = sc.id)";

				if ($conn->query($sql3) === TRUE) {
					//  echo "2 New record created successfully";
				} else {
					//  echo "Error2: " . $sql . "<br>" . $conn->error;
				}								
				
				
				$conn->close();				
		 	} 
					
		
	}	
	
	
?>