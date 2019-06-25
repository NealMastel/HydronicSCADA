<?php
$servername = "localhost";
$username = "root";
$password = "summit800";
$dbname = "currenttemp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
$sql1 = "UPDATE `temperatures`
		SET thermocouple = 1, temperature = '".$_GET["temp1"]."', time = NOW()
		WHERE thermocouple = 1";
		
$sql2 = "UPDATE `temperatures`
		SET thermocouple = 2, temperature = '".$_GET["temp2"]."', time = NOW()
		WHERE thermocouple = 2";

// '".$_GET["temp"]."'

if ($conn->query($sql1) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}

$conn->close();
?>