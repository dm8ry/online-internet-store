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
	
	
	if ( $uploadOk==0 )
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

	if (isset($_POST['post_title']) && isset($_POST['keyword1']) && isset($_POST['keyword2']) && isset($_POST['keyword3']) && isset($_POST['categ'])
		&& isset($_POST['post_details']))
	{
	
		if ($target_file)
		{
			$photo1 = str_replace("./../", "", $target_file);
		}
		
	
		//Email information
		$admin_email = $admin_email_address;
		$subject = "A new post created from Crystalsky.co.il";	

		$post_title = htmlspecialchars (mb_substr($_POST['post_title'], 0, 60));
	
		$post_title=str_replace('"', "", $post_title);
		$post_title = str_replace("'", "", $post_title);
		$post_title = stripslashes($post_title);	
				 
		$keyword1 = htmlspecialchars (mb_substr($_POST['keyword1'], 0, 20));
	
		$keyword1=str_replace('"', "", $keyword1);
		$keyword1 = str_replace("'", "", $keyword1);
		$keyword1 = stripslashes($keyword1);	

		$keyword2 = htmlspecialchars (mb_substr($_POST['keyword2'], 0, 20));
	
		$keyword2=str_replace('"', "", $keyword2);
		$keyword2 = str_replace("'", "", $keyword2);
		$keyword2 = stripslashes($keyword2);		
			
		$keyword3 = htmlspecialchars (mb_substr($_POST['keyword3'], 0, 20));
	
		$keyword3=str_replace('"', "", $keyword3);
		$keyword3 = str_replace("'", "", $keyword3);
		$keyword3 = stripslashes($keyword3);		

		$categ = htmlspecialchars (mb_substr($_POST['categ'], 0, 20));
	
		$categ=str_replace('"', "", $categ);
		$categ = str_replace("'", "", $categ);
		$categ = stripslashes($categ);	

		$post_details = htmlspecialchars (mb_substr($_POST['post_details'], 0, 4000));
	
		$post_details=str_replace('"', "", $post_details);
		$post_details = str_replace("'", "", $post_details);
		$post_details = stripslashes($post_details);		
			
		$date = new DateTime("now", new DateTimeZone('Asia/Jerusalem') );
		$cur_dt =  $date->format('d-m-Y H:i:s');  
		$db_cur_dt = $date->format('Y-m-d H:i:s'); // same format as NOW()	
		
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		
		$headers = "From: " . strip_tags($admin_email) . "\r\n";
		$headers .= "Reply-To: ". strip_tags($admin_email) . "\r\n";		
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";		
		  
		mb_internal_encoding("UTF-8");
		
		$message = '<html><body>Здравствуйте, Crystalsky!' . '<br/><br/> ' ."\n" .
					 'Новый пост был добавлен в блог с панели управления Crystalsky.co.il!' . '<br/><br/> ' ."\n" .
					 'Дата добавления: <b>' . $cur_dt . '</b><br/> ' ."\n" .
					 'Автор: <b>Crystal Sky</b><br/> ' ."\n" .
					 'Заголовок поста: <b>' . $post_title . '</b><br/>' ."\n" .					 
					 'Категория поста: <b>' . $categ . '</b><br/>' ."\n" .					 
					 'Ключевое слово #1: <b>' . $keyword1 . '</b><br/>' ."\n" .
					 'Ключевое слово #2: <b>' . $keyword2 . '</b><br/>' ."\n" .
					 'Ключевое слово #3: <b>' . $keyword3 . '</b><br/>' ."\n" .	
					 'Тескт поста (начало): <b>' . mb_substr($post_details, 0, 300) . '...</b><br/>' ."\n" .						 
					 'Посмотреть пост в блоге: <b><a href="http://crystalsky.co.il/blog.php#come_here" target="_blank">--></a></b><br/><br/>' ."\n" .					 
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
				VALUES ('$db_cur_dt', 'NEW_POST_CREATED', '$ip_addr', '$admin_email', '$message' )";

				if ($conn->query($sql) === TRUE) {
					//  echo "1 New record created successfully";
				} else {
					// echo "Error1: " . $sql . "<br>" . $conn->error;
				}

				$sql2 = "INSERT INTO posts (createdate, modifydate, title, author, email, likes, last_like_ip, post_category, post_photo1, post_txt, post_keyword1, post_keyword2, post_keyword3, post_link1_url, post_link2_url, post_link3_url, post_status, nviews) 
				VALUES ('$db_cur_dt', '$db_cur_dt', '$post_title', 'Crystal Sky', '', 0, '', '$categ', '$photo1', '$post_details', '$keyword1', '$keyword2', '$keyword3', '', '', '', '1', 0)";

				if ($conn->query($sql2) === TRUE) {
					//  echo "2 New record created successfully";
				} else {
					//  echo "Error2: " . $sql . "<br>" . $conn->error;
				}				
				
				$conn->close();				
		 	} 
					
		
	}	
	
	
?>