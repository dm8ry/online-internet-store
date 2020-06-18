<?php
require_once("./../db_connect.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$conn->query("set names 'utf8'");

$sql = "SELECT * FROM coupons where id = ".$_POST['recn'];
$result = $conn->query($sql);

if ($result->num_rows == 1) 
{
    // output data of each row
    $row = $result->fetch_assoc();
	
    echo $row["name"];
} 
else {
    echo " ";
}
$conn->close();
?>