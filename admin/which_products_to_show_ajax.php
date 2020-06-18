<?php session_start(); 
 
if(isset($_POST['which_products_to_show']) )
	{	
		 
		if(!isset($_SESSION['which_products_to_show']))
		{
			$_SESSION['which_products_to_show'] = 1;
		}
		else
		{
			$_SESSION['which_products_to_show'] = $_POST['which_products_to_show'];
		}
	
	}
	else
	{
		$_SESSION['which_products_to_show'] = 1;
	}

	// echo $_SESSION['which_products_to_show'];
?>