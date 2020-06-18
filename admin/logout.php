<?php session_start(); 

unset($_SESSION['auth_login']);
session_destroy();
header("Location: index.php");
exit;

?>