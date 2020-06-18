<?php

	//
	// update the product
	//

	include_once('./../db_connect.php');
	include_once('./../admin_email.php');
	
	mb_internal_encoding("UTF-8");
	
	$flg_photo1 = false;
	 
	$uploadOk = 1;
	 
	////////////////////////////////
	//  upload img 1
	//
	
	if ($_FILES["my-efile-selector"]["name"])
	{	
		
		/*
		$sfx_date = new DateTime("now", new DateTimeZone('Asia/Jerusalem') );
		$sfx_cur_dt =  $sfx_date->format('Ymd_His'); */
			
		$now = DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', ''));
		$sfx_date = $now->setTimeZone(new DateTimeZone('Asia/Jerusalem'));
		$sfx_cur_dt = $sfx_date->format("Ymd_His_u");				
			
		$target_suffix = "";
		$target_dir = "./../app_data/app_images/";
		$target_file = $target_dir . $sfx_cur_dt. "_". basename($_FILES["my-efile-selector"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		
		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["my-efile-selector"]["tmp_name"]);
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
		if ($_FILES["my-efile-selector"]["size"] > 204800) {
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
			if (move_uploaded_file($_FILES["my-efile-selector"]["tmp_name"], $target_file)) {
				// echo "Ok"; //echo "The file ". $target_file. " has been uploaded.";
				$flg_photo1 = true;
			} else {
				echo "ФОТО1: Ошибка загрузки!";
				exit;
			}
		}	
	
	}
	else
	{
		$flg_photo1 = false;
	}
	
	//////////////////// end upload img 1 ///////////////////////////
	

	if ( $uploadOk==0) 
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

	if (isset($_POST['erowid']) && isset($_POST['epost_title']) && isset($_POST['ekeyword1']) && isset($_POST['ekeyword2']) && isset($_POST['ekeyword3'])
		&& isset($_POST['ecateg']) && isset($_POST['epost_details']) )
	{
	
		if ($target_file)
		{
			$photo1 = str_replace("./../", "", $target_file);
		}
		
	
		//Email information
		$admin_email = $admin_email_address;
		$subject = "The updated post in blog from Crystalsky.co.il";	

		$rowid = $_POST['erowid'];
		
		$post_title = htmlspecialchars (mb_substr($_POST['epost_title'], 0, 60));
	
		$post_title=str_replace('"', "", $post_title);
		$post_title = str_replace("'", "", $post_title);
		$post_title = stripslashes($post_title);	
				 
		$keyword1 = htmlspecialchars (mb_substr($_POST['ekeyword1'], 0, 20));
	
		$keyword1=str_replace('"', "", $keyword1);
		$keyword1 = str_replace("'", "", $keyword1);
		$keyword1 = stripslashes($keyword1);	

		$keyword2 = htmlspecialchars (mb_substr($_POST['ekeyword2'], 0, 20));
	
		$keyword2=str_replace('"', "", $keyword2);
		$keyword2 = str_replace("'", "", $keyword2);
		$keyword2 = stripslashes($keyword2);		
			
		$keyword3 = htmlspecialchars (mb_substr($_POST['ekeyword3'], 0, 20));
	
		$keyword3=str_replace('"', "", $keyword3);
		$keyword3 = str_replace("'", "", $keyword3);
		$keyword3 = stripslashes($keyword3);		

		$categ = htmlspecialchars (mb_substr($_POST['ecateg'], 0, 20));
	
		$categ=str_replace('"', "", $categ);
		$categ = str_replace("'", "", $categ);
		$categ = stripslashes($categ);	

		$post_details = htmlspecialchars (mb_substr($_POST['epost_details'], 0, 4000));
	
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
		  
		$message = '<html><body>Здравствуйте, Crystalsky!' . '<br/><br/> ' ."\n" .
					 'Пост из блога был изменен с панели управления Crystalsky.co.il!' . '<br/><br/> ' ."\n" .
					 'Дата изменения: <b>' . $cur_dt . '</b><br/> ' ."\n" .
					 'ID поста, который был изменен: <a href="http://crystalsky.co.il/post.php?i='.$rowid.'" target="_blank"><b>'.$rowid.'</b></a><br/>' ."\n" .					
					 'Заголовок: <b>' . $post_title . '</b><br/> ' ."\n" .
					 'Категория поста: <b>' . $categ . '</b><br/>' ."\n" .					 
					 'Ключевое слово #1: <b>' . $keyword1 . '</b><br/>' ."\n" .
					 'Ключевое слово #2: <b>' . $keyword2 . '</b><br/>' ."\n" .
					 'Ключевое слово #3: <b>' . $keyword3 . '</b><br/>' ."\n" .	
					 'Тескт поста (начало): <b>' . mb_substr($post_details, 0, 300) . '...</b><br/><br/>' ."\n" .					 
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
				VALUES ('$db_cur_dt', 'POST_UPDATED', '$ip_addr', '$admin_email', '$message' )";

				if ($conn->query($sql) === TRUE) {
					//  echo "1 New record created successfully";
				} else {
					// echo "Error1: " . $sql . "<br>" . $conn->error;
				}
				
				//$sql2 = "INSERT INTO products (createdate, modifydate, makat, title, category, short_desc, long_desc, price, photo1, is_new, is_discount, show_price, metall, quantity, status, color1, color2, color3, stone1, stone2, stone3, size1, size2, size3, remark, photo2, photo3) 
				//VALUES ('$db_cur_dt', '$db_cur_dt', '$makat', '$title', '$subcateg', '$short_desc', '$lng_desc', $price, '$photo1', '$is_new', '$is_discount', '$show_price', '$metall', $qty, '$statuss', '$color1', '$color2', '$color3', '$stone1', '$stone2', '$stone3', '$size1', '$size2', '$size3', '$deviz', '$photo2', '$photo3')";

				$sql2 = " update posts 
							set 
								modifydate = '$db_cur_dt', 								
								title = '$post_title', 
								post_category = '$categ',
								post_txt = '$post_details',
								post_keyword1='$keyword1',
								post_keyword2='$keyword2',
								post_keyword3='$keyword3'
							where id = ".$rowid;
				
				if ($conn->query($sql2) === TRUE) {
					 // echo "2 Record created successfully";
				} else {
					 // echo "Error2: " . $sql2 . "<br>" . $conn->error;
				}


				if ($flg_photo1)
				{
					$sql21 = " update posts 
								set post_photo1 = '$photo1'
								where id = ".$rowid;
					
					if ($conn->query($sql21) === TRUE) {
						// echo "3 Record created successfully";
					} else {
						//  echo "Error3: " . $sql21 . "<br>" . $conn->error;
					}		
				}		
				
				$conn->close();				
		 	} 
					
		
	}	
	
	
?>