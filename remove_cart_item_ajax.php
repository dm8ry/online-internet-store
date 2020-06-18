<?php session_start(); 
 
if(isset($_POST['itmtodel']))
	{
		$itmtodel = $_POST['itmtodel'];		
	
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
		if(array_key_exists($itmtodel, $_SESSION['cart_items']))
		{			
			unset($_SESSION['cart_items'][$itmtodel]);	

			if (count($_SESSION['cart_items']) == 0)
			{
				unset($_SESSION['coupon']);
				unset($_SESSION['bonus_coupon']);
			}
			
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