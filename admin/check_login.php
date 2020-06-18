<?php session_start();

//
// for debug only 
//
//  echo 'Username: '.$_POST['form-username'];
//  echo 'Password: '.$_POST['form-password'];
//

if (empty($_POST['form-username']) || empty($_POST['form-password'])) 
{
	$error = "Wrong";
}
else
{
	$username = $_POST['form-username'];
	$password = $_POST['form-password'];
		
	if ((strcmp($username, 'Alex')==0) && (strcmp($password, 'gend20!6')==0))
	{
		$error = "Success";
		$_SESSION['auth_login']='Ok';
	}
	else
	if ((strcmp($username, 'Dmitry')==0) && (strcmp($password, 'gend20!6')==0))
	{
		$error = "Success";
		$_SESSION['auth_login']='Ok';
	}
	else
	{
		$error = "Wrong";
		unset($_SESSION['auth_login']);
	}
}

if (strcmp($error, 'Success')==0)
{
	// success
	header("Location: dashboard1.php"); // Redirecting To The Welcome Dashboard Page	
}
else
{
	unset($_SESSION['auth_login']);
	// wrong
	if(session_destroy()) // Destroying All Sessions
	{
		header("Location: wrong_login.php"); // Redirecting To The Wrong Login Page
	}
}

?>
