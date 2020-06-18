<?php session_start(); 

	echo "check bonus_coupon: ". "\n";

	if(!isset($_SESSION['bonus_coupon'])){
		print "<pre>";
		print "the array is empty...";
		print "</pre>";
	}				
	else
	{
		$n_of_elements = count($_SESSION['bonus_coupon']);
		print "n of elements: ".$n_of_elements;
		print "<pre>";
		print_r($_SESSION['bonus_coupon']);
		print "</pre>";
				
	}
				
?>