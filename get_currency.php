<?php session_start(); 

 
	echo "================ check currency =====================";
	echo "<br/>";
	echo "the_curr (sess) = ".$_SESSION['the_curr'];
	echo "<br/>";
	echo "the_curr_sign (sess) = ".$_SESSION['the_curr_sign'];
	echo "<br/>";
	echo "rate (sess) = ".$_SESSION['rate'];	
	echo "<br/>";
	echo "sign_place (sess) = ".$_SESSION['sign_place'];	
	echo "<br/>";
	echo "curr_desc (sess) = ".$_SESSION['curr_desc'];	
	echo "<br/>";
	echo "curr_name (sess) = ".$_SESSION['curr_name'];		
	
 
?>