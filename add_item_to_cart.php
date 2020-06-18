<?php session_start(); 

if(isset($_POST['it']) && isset($_POST['ph']) && isset($_POST['tt']) && isset($_POST['mt']) && isset($_POST['pr']) && isset($_POST['id']))
	{
		$it = $_POST['it'];
		$ph = $_POST['ph'];
		$tt = $_POST['tt'];
		$mt = $_POST['mt'];
		$pr = $_POST['pr'];
		$id = $_POST['id'];
	
		/*
		 * check if the 'cart' session array was created
		 * if it is NOT, create the 'cart' session array
		 */
		 
		if(!isset($_SESSION['cart_items'])){
			$_SESSION['cart_items'] = array();
			echo intval('0');
		}
 	
		
		// check if the item is in the array, if it is, do not add
		if(array_key_exists($it, $_SESSION['cart_items']))
		{			
			$n_of_elements = count($_SESSION['cart_items']);
			echo intval($n_of_elements);
		}	
		// else, add the item to the array
		else
		{
			$_SESSION['cart_items'][$it]= array('title' => $tt, 'makat' => $mt, 'photo' => $ph, 'price' => $pr, 'is_discount' => $id, 'qty' => 1);
			$n_of_elements = count($_SESSION['cart_items']);
			echo intval($n_of_elements);
		}					
		
	}
	else
	{
		echo 'Error';
	}



?>