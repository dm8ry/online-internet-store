<?php session_start();
include_once('db_connect.php');

if(isset($_POST['bc']))
	{

		$bc = htmlspecialchars (substr($_POST['bc'], 0, 20));

		$bc=str_replace('"', "", $bc);
		$bc = str_replace("'", "", $bc);
		$bc = stripslashes($bc);
	
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$conn->query("set names 'utf8'");
		
		$sql = "select * from coupons where upper(name) = upper('".$bc."') and status=1 and (now()+INTERVAL 10 HOUR)>=start_dt and ((now()+INTERVAL 10 HOUR)<exp_dt or exp_dt is null or exp_dt = '0000-00-00 00:00:00')";

		$result = $conn->query($sql);
		
		if ($result->num_rows == 1)
		{			
			
			$row = $result->fetch_assoc();
							 		
			
			$bonus_coupon= array('bonus_name' => $row['name'], 
												'bonus_type' => $row['type'], 
												'bonus_par1' => $row['par1'],
												'bonus_par2' => $row['par2'],
												'bonus_display_name' => $row['display_name']);
									
			$_SESSION['coupon'] = $row['name'];
			$_SESSION['bonus_coupon'] = array('bonus_name' => $row['name'], 
												'bonus_type' => $row['type'], 
												'bonus_par1' => $row['par1'],
												'bonus_par2' => $row['par2'],
												'bonus_display_name' => $row['display_name']);
			echo json_encode($bonus_coupon);
		}
		else
		{
			unset($_SESSION['coupon']);
			unset($_SESSION['bonus_coupon']);
			echo 'NOT_FOUND';
		}

		$conn->close();		
		
	}

?>