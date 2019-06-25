<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="refresh" content="60">
</head>
<body>

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
$sql1 = "INSERT INTO `charttemps` (`ID`, `thermocouple`, `temperature`, `timestamp`) VALUES (NULL, '1', ROUND((1770 + rand() * 180)/10,1), CURRENT_TIMESTAMP)";		// M250Supply1WaterTemp
$sql2 = "INSERT INTO `charttemps` (`ID`, `thermocouple`, `temperature`, `timestamp`) VALUES (NULL, '2', ROUND((1770 + rand() * 180)/10,1), CURRENT_TIMESTAMP)";	// M250Supply2WaterTemp
$sql3 = "INSERT INTO `charttemps` (`ID`, `thermocouple`, `temperature`, `timestamp`) VALUES (NULL, '3', ROUND((1750 + rand() * 210)/10,1), CURRENT_TIMESTAMP)";		// M250Return1WaterTemp
$sql4 = "INSERT INTO `charttemps` (`ID`, `thermocouple`, `temperature`, `timestamp`) VALUES (NULL, '4', ROUND((1750 + rand() * 210)/10,1), CURRENT_TIMESTAMP)";		// M250Return2WaterTemp
$sql5 = "INSERT INTO `charttemps` (`ID`, `thermocouple`, `temperature`, `timestamp`) VALUES (NULL, '5', ROUND((1750 + rand() * 210)/10,1), CURRENT_TIMESTAMP)";		// M250Return1FlowRate

if ($conn->query($sql1) === TRUE) {
    echo "Thermocouple 1 inserted successfully <br />";
} else {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
	echo "Thermocouple 2 inserted successfully <br />";
} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}
if ($conn->query($sql3) === TRUE) {
    echo "Thermocouple 3 inserted successfully <br />";
} else {
    echo "Error: " . $sql3 . "<br>" . $conn->error;
}
if ($conn->query($sql4) === TRUE) {
    echo "Thermocouple 4 inserted successfully <br />";
} else {
    echo "Error: " . $sql4 . "<br>" . $conn->error;
}
if ($conn->query($sql5) === TRUE) {
    echo "Thermocouple 5 inserted successfully <br />";
} else {
    echo "Error: " . $sql5 . "<br>" . $conn->error;
}

$conn->close();
?>

</body>
</html>