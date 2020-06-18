<?php session_start(); 
 
if(isset($_POST['en']) && isset($_POST['ev']))
	{
		$en = $_POST['en'];
		$ev = $_POST['ev'];		
	
		/*
		 * check if the 'cart' session array was created
		 * if it is NOT, create the 'cart' session array
		 */
		 
		if(!isset($_SESSION['cart_items']))
		{
			// just do nothing...
		}
 	
		$keys = array_keys($_SESSION['cart_items']);		
		
		// check if the item is in the array, if it is, do assign
		if(array_key_exists($keys[$en], $_SESSION['cart_items']))
		{			
			$_SESSION['cart_items'][$keys[$en]]['qty']=$ev;		
		}	
		// else, add the item to the array
		else
		{
			// just do nothing...
		}					
	
	}
	else
	{
		// just do nothing...
	}



?>