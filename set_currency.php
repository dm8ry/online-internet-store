<?php session_start(); 

	if(isset($_POST['the_curr']) && isset($_POST['the_curr_sign']) && isset($_POST['rate']) && isset($_POST['sign_place']) && isset($_POST['curr_name']))
	{
	
		$_SESSION['the_curr'] = $_POST['the_curr'];
		$_SESSION['the_curr_sign'] = $_POST['the_curr_sign'];
		$_SESSION['rate'] = $_POST['rate'];
		$_SESSION['sign_place'] = $_POST['sign_place'];
		$_SESSION['curr_desc'] = $_POST['curr_desc'];
		$_SESSION['curr_name'] = $_POST['curr_name'];
		
	}
	
?>