<?php

include_once('./../../../db_connect.php');
include_once('./../../../admin_email.php');
 
// Email address verification

function isEmail($email) {
    return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email));
}

if($_POST) {

	// for production
	$emailTo = $admin_email_address;

    $subscriber_email = ($_POST['email']);

    if(!isEmail($subscriber_email)) {
        $array = array();
        $array['valid'] = 0;
        $array['message'] = 'Введите правильный адрес Вашей электронной почты!';
        echo json_encode($array);
    }
    else {

		// processing
	
		$admin_email = $admin_email_address;
		$subject = "A new Subscriber (Landing Page #1) from Crystalsky.co.il";
		
		$email = htmlspecialchars (substr($subscriber_email, 0, 50));

		$email=str_replace('"', "", $email);
		$email = str_replace("'", "", $email);
		$email = stripslashes($email);			
		
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		
		$headers = "From: " . strip_tags($admin_email) . "\r\n";
		$headers .= "Reply-To: ". strip_tags($email) . "\r\n";		
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";			
		
		$date = new DateTime("now", new DateTimeZone('Asia/Jerusalem') );
		$cur_dt =  $date->format('d-m-Y H:i:s');  
		$db_cur_dt = $date->format('Y-m-d H:i:s'); // same format as NOW()			
	  
		$message = '<html><body>Здравствуйте, Crystalsky!' . '<br/><br/>' .
					 'Новый Подписчик на сайте Crystalsky.co.il!' . '<br/><br/>' .
					 'Дата Подписки: <b>' . $cur_dt . '</b><br/>' .					
					 'Подписчик пришел со страницы: <a href="http://crystalsky.co.il/lp/1/" target="_blank"><b>Landing Page #1</b></a><br/>' .						
					 'Емайл подписчика: <b>' . $subscriber_email . '</b><br/><br/>' .					
					 'Этот пользователь проявил интерес к магазину.<br/>' .
					 'Постарайтесь с ним(ней) связаться и предложить ему(ей) особое мероприятие или изделие.<br/><br/>' .
					 'С уважением, ' . ' <br/>' .
					 'Администрация.</body></html>';
		
		if (!mail($admin_email, "$subject", $message, $headers)) 
		{
		   // something wrong...
		} 
		else
		{  
			// everything is good...
			
			// log into businesslog
			
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 

			$conn->query("set names 'utf8'");
			
			$sql = "INSERT INTO businesslog (datex, alert_type, ip_addr, email, the_info) 
			VALUES ('$db_cur_dt', 'LEAD_LP_1', '$ip_addr', '$email', '$message' )";

			if ($conn->query($sql) === TRUE) {
				// echo "New record created successfully";
			} else {
				// echo "Error: " . $sql . "<br>" . $conn->error;
			}
						
			$sql = "INSERT INTO customerlead
					(`lead_fname`, 
					`lead_lname`, 
					`lead_createdt`, 
					`lead_modifydt`, 
					`lead_ip`, 
					`lead_email`, 
					`lead_country`, 
					`lead_city`, 
					`lead_phone`,
					`lead_status_id`,
					`lead_product_id`,
					`lead_comments`) 
					VALUES 
					('No','No','$db_cur_dt','$db_cur_dt','$ip_addr','$email','','','', 0, '', 'Посетитель подписался на новости от магазина. Емайл пользователя: $email. Подписчик пришел со страницы Landing Page #1. Возможно, ему будут интересны товары магазина, и он - потенциальный покупатель!')";

			if ($conn->query($sql) === TRUE) {
				// echo "New record created successfully";
			} else {
				// echo "Error: " . $sql . "<br>" . $conn->error;
			}				
			
			// activity for subscriber	

			$subject = "Бесплатный календарь 2017 от магазина украшений Crystalsky.co.il";
				
			$message = '<html><body>Здравствуйте!' . '<br/><br/>' ."\n" .
						 'Благодарим Вас за подписку на новости и мероприятия от магазина "Crystal Sky"!' . '<br/><br/>' ."\n" .
						 'Дата подписки: <b>' . $cur_dt . '</b><br/>' ."\n" .
						 'Подписка произведена со страницы: <a href="http://crystalsky.co.il/lp/1/" target="_blank"><b>"Календарь на 2017 год"</b></a>.<br/><br/>' ."\n" .					
						 'Дарим Вам бесплатный календарь на 2017 год от магазина украшений Crystalsky.co.il!' . '<br/>' ."\n" .
						 'Для просмотра календаря, нажмите на <a href="http://crystalsky.co.il/lp/1/downloads/Calendar_2017_CrystalSky_v3.jpg" target="_target"><b>ссылку #1</b></a>. ' ."\n" .
						 'Для того, чтобы календарь скачался на Ваш компьютер, планшет или мобильный телефон, нажмите на <a href="http://crystalsky.co.il/lp/1/downloads/Calendar_2017_CrystalSky_v3.jpg" download="Calendar_2017_CrystalSky.jpg"><b>ссылку #2</b></a>. ' ."\n" .						 
						 'Вы можете распечатать этот календарь на принтере, отправить его всем своим друзьям или напечатать на памятном сувенире в близлежащем магазине фотографии.' . '<br/><br/>' ."\n" .
						 'Приглашаем Вас в наш магазин <a href="http://crystalsky.co.il" target="_blank"><b>"Crystal Sky"</b></a>! ' . '<br/>' ."\n" .
						 'Магазин "Crystal Sky". Cеребряные украшения, натуральные камни, позолота. Самые изысканные украшения для Вас! Богатые стилистические решения – от классики до авангарда. ' ."\n" .
						 'Широкий выбор ювелирных украшений на любой вкус! Высокий уровень обслуживания! ' ."\n" .						 						 
						 'Приобретая серебряные ювелирные изделия в нашем магазине, Вы непременно будете довольны! Разнообразие дизайна и доступные цены! ' . '<br/>' ."\n" .
						 'Приглашаем Вас за покупками! ' . '<br/><br/>' ."\n" .						 						 
						 '<u>Адреса наших магазинов:</u> ' . '<br/>' ."\n" .
						 'город Нацерет-Илит, ул.Ацмон 18, мерказ Раско  ' . '<br/>' ."\n" .
						 'город Тверия, ул.Апрахим 18, шук Ирони  ' . '<br/><br/>' ."\n" .
						 'Добро пожаловать на наш сайт в Интернете - <a href="http://crystalsky.co.il" target="_blank"><b>"Crystal Sky"</b></a>! ' . '<br/><br/>' ."\n" .
						 '<a href="http://ok.ru/crystalsky" target="_blank"><b>Приглашаем Вас</b></a> в клуб магазина "Crystal Sky" в "Одноклассниках"! ' . '<br/>' ."\n" .
						 '<a href="http://facebook.com/crystalsky.jewelry" target="_blank"><b>Приглашаем Вас</b></a> в клуб магазина "Crystal Sky" в "Фейсбуке"! ' . '<br/>' ."\n" .
						 '<a href="https://www.youtube.com/channel/UCeiNKvNYTd4sTA-h3VlyrBg" target="_blank"><b>Приглашаем Вас</b></a> на видеоканал магазина "Crystal Sky" на "YouTube"! ' . '<br/>' ."\n" .
						 '<a href="https://twitter.com/CrystalSky925" target="_blank"><b>Приглашаем Вас</b></a> в клуб магазина "Crystal Sky" в "Твиттере"! ' . '<br/><br/>' ."\n" .						 
						 'Спасибо Вам за интерес к нашему магазину!<br/><br/>' ."\n" .				 
						 'С уважением, ' . ' <br/>'  ."\n" .
						 'магазин украшений "Crystal Sky".' . ' <br/>'  ."\n" .
						 'www.crystalsky.co.il' . ' <br/>'  ."\n" .
						 'info@crystalsky.co.il</body></html>';	
		

			$headers = "From: " . strip_tags($admin_email) . "\r\n";
			$headers .= "Reply-To: ". strip_tags($subscriber_email) . "\r\n";		
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";				
					
			mail($subscriber_email, "$subject", $message, $headers);
			
			$array = array();
			$array['valid'] = 1;
			$array['message'] = 'Спасибо! Приглашаем за покупками в наш магазин!';
			echo json_encode($array);			
		
		}
						
		$conn->close();				
	
    }

}

?>
