<?php session_start(); 

	echo "check cart: ". "\n";

	if(!isset($_SESSION['cart_items'])){
		print "<pre>";
		print "the array is empty...";
		print "</pre>";
	}				
	else
	{
		$n_of_elements = count($_SESSION['cart_items']);
		print "n of elements: ".$n_of_elements;
		print "<pre>";
		print_r($_SESSION['cart_items']);
		print "</pre>";
				
	}
				
?>