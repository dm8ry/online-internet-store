<?php
include_once('db_connect.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$conn->query("set names 'utf8'");

$sql = "SELECT * FROM businesslog";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " datex: " . $row["datex"]. " alert_type: " . $row["alert_type"]. " ip_addr: " . $row["ip_addr"]. " email: " . $row["email"]. " the_info: " . $row["the_info"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>