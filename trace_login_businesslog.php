<?php

	// trace login into businesslog

	include_once('db_connect.php');
	
	
	function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
		$output = NULL;
		if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
			$ip = $_SERVER["REMOTE_ADDR"];
			if ($deep_detect) {
				if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
					$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
					$ip = $_SERVER['HTTP_CLIENT_IP'];
			}
		}
		$purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
		$support    = array("country", "countrycode", "state", "region", "city", "location", "address");
		$continents = array(
			"AF" => "Africa",
			"AN" => "Antarctica",
			"AS" => "Asia",
			"EU" => "Europe",
			"OC" => "Australia (Oceania)",
			"NA" => "North America",
			"SA" => "South America"
		);
		if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
			$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
			if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
				switch ($purpose) {
					case "location":
						$output = array(
							"city"           => @$ipdat->geoplugin_city,
							"state"          => @$ipdat->geoplugin_regionName,
							"country"        => @$ipdat->geoplugin_countryName,
							"country_code"   => @$ipdat->geoplugin_countryCode,
							"continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
							"continent_code" => @$ipdat->geoplugin_continentCode
						);
						break;
					case "address":
						$address = array($ipdat->geoplugin_countryName);
						if (@strlen($ipdat->geoplugin_regionName) >= 1)
							$address[] = $ipdat->geoplugin_regionName;
						if (@strlen($ipdat->geoplugin_city) >= 1)
							$address[] = $ipdat->geoplugin_city;
						$output = implode(", ", array_reverse($address));
						break;
					case "city":
						$output = @$ipdat->geoplugin_city;
						break;
					case "state":
						$output = @$ipdat->geoplugin_regionName;
						break;
					case "region":
						$output = @$ipdat->geoplugin_regionName;
						break;
					case "country":
						$output = @$ipdat->geoplugin_countryName;
						break;
					case "countrycode":
						$output = @$ipdat->geoplugin_countryCode;
						break;
				}
			}
		}
		return $output;
	}	
	
		
	  function curPageURL() {
		 $pageURL = 'http';
		 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		 $pageURL .= "://";
		 if ($_SERVER["SERVER_PORT"] != "80") {
		  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		 } else {
		  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		 }
		 return $pageURL;
		}	
		
		
	function getOS() { 

		global $user_agent;

		$os_platform    =   "Unknown OS Platform";

		$os_array       =   array(
								'/windows nt 10/i'     =>  'Windows 10',
								'/windows nt 6.3/i'     =>  'Windows 8.1',
								'/windows nt 6.2/i'     =>  'Windows 8',
								'/windows nt 6.1/i'     =>  'Windows 7',
								'/windows nt 6.0/i'     =>  'Windows Vista',
								'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
								'/windows nt 5.1/i'     =>  'Windows XP',
								'/windows xp/i'         =>  'Windows XP',
								'/windows nt 5.0/i'     =>  'Windows 2000',
								'/windows me/i'         =>  'Windows ME',
								'/win98/i'              =>  'Windows 98',
								'/win95/i'              =>  'Windows 95',
								'/win16/i'              =>  'Windows 3.11',
								'/macintosh|mac os x/i' =>  'Mac OS X',
								'/mac_powerpc/i'        =>  'Mac OS 9',
								'/linux/i'              =>  'Linux',
								'/ubuntu/i'             =>  'Ubuntu',
								'/iphone/i'             =>  'iPhone',
								'/ipod/i'               =>  'iPod',
								'/ipad/i'               =>  'iPad',
								'/android/i'            =>  'Android',
								'/blackberry/i'         =>  'BlackBerry',
								'/webos/i'              =>  'Mobile'
							);

		foreach ($os_array as $regex => $value) { 
			if (preg_match($regex, $user_agent)) {
				$os_platform    =   $value;
			}
		}   
		return $os_platform;
	}		
	
	
	function getBrowser() {

		global $user_agent;

		$browser        =   "Unknown Browser";

		$browser_array  =   array(
								'/msie|trident/i'       =>  'Internet Explorer',
								'/firefox/i'    =>  'Firefox',
								'/safari/i'     =>  'Safari',
								'/chrome/i'     =>  'Chrome',
								'/edge/i'       =>  'Edge',
								'/opera/i'      =>  'Opera',
								'/netscape/i'   =>  'Netscape',
								'/maxthon/i'    =>  'Maxthon',
								'/konqueror/i'  =>  'Konqueror',
								'/mobile/i'     =>  'Handheld Browser'
							);

		foreach ($browser_array as $regex => $value) { 
			if (preg_match($regex, $user_agent)) {
				$browser    =   $value;
			}
		}
		return $browser;
	}	
	
	$user_agent     =   $_SERVER['HTTP_USER_AGENT'];
	$user_os        =   getOS();
	$user_browser   =   getBrowser();
		
	$curr_url= curPageURL();
	$curr_url = str_replace("http://www.crystalsky.co.il/" ,"", $curr_url);
	
	$ip_addr=$_SERVER['REMOTE_ADDR'];
	
	$the_country = "";
	$the_city = "";
	$the_region = ""; 

	/*
	if (strpos($curr_url, 'index') !== false)
	{
		$the_country = ip_info($ip_addr, "Country");
		$the_city = ip_info($ip_addr, "City");
		$the_region = ip_info($ip_addr, "Region");		
	}
	else if (!isset($curr_url) || trim($curr_url)==='')
	{
		$the_country = ip_info($ip_addr, "Country");
		$the_city = ip_info($ip_addr, "City");
		$the_region = ip_info($ip_addr, "Region");	
	} 
	else
	{
		$the_country = "";
		$the_city = "";
		$the_region = "";	
	}
	*/
	
	$date = new DateTime("now", new DateTimeZone('Asia/Jerusalem') );
	$cur_dt =  $date->format('d-m-Y H:i:s');  
	$db_cur_dt = $date->format('Y-m-d H:i:s'); // same format as NOW()	

	$the_page = $curr_url;
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$conn->query("set names 'utf8'");
	
	$from_which_page = substr($_SERVER['HTTP_REFERER'], 0, 200);
	
	$message = '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!' . '<br/><br/> ' ."\n" .
				 'Новый посетитель пришел на сайт Crystalsky.co.il!' . '<br/><br/> ' ."\n" .
				 'Дата посещения: <b>' . $cur_dt . '</b><br/> ' ."\n".
				 'Страница посещения: <b>' . $curr_url . '</b><br/> ' ."\n".
				 'IP адрес: <a href="http://www.geoplugin.net/json.gp?ip='.$ip_addr.'" target="_blank"><b>'.$ip_addr.'</b></a><br/> ' ."\n" .
				/* 'Страна по IP адресу: <b>' . $the_country . '</b><br/> ' ."\n" .
				 'Город по IP адресу: <b>' . $the_city . '</b><br/> ' ."\n" .
				 'Регион по IP адресу: <b>' . $the_region . '</b><br/> ' ."\n" . */
				 'Переход со страницы: <b>' . $from_which_page . '</b><br/> ' ."\n" .
				 'Операционная система: <b>' . $user_os . '</b><br/> ' ."\n" .
				 'Браузер: <b>' . $user_browser . '</b><br/><br/> ' ."\n" .
				 'С уважением, ' . ' <br/> ' ."\n" .
				 'Администрация.</body></html>';
	
	$sql = "INSERT INTO businesslog_logins (datex, alert_type, ip_addr, email, the_info, the_page, the_country, the_city, the_region) 
	VALUES ('$db_cur_dt', 'LOGIN', '$ip_addr', 'n/a', '$message', '$the_page', '$the_country', '$the_city', '$the_region' )";

	if ($conn->query($sql) === TRUE) {
		// echo "New record created successfully";
	} else {
		//  echo "Error: " . $sql . "<br>" . $conn->error;					
	}
	
	$conn->close();				

?>