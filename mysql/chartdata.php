<?php

$url1=$_SERVER['REQUEST_URI'];
    header("Refresh: 60; URL=$url1");
	
$mysqli = new mysqli("localhost", "root", "summit800", "currenttemp");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$query = "SELECT thermocouple, temperature, UNIX_TIMESTAMP(timestamp) FROM `charttemps` WHERE thermocouple BETWEEN 1 AND 5 ORDER BY timestamp DESC, thermocouple ASC LIMIT 500"; 

if ($result = $mysqli->query($query)) {

    /* fetch associative array */
	$array = array();
    $arraythermocouple = array();
	$arraytemperature = array();
	$arraytimestamp = array();    
while($row = mysqli_fetch_array($result)) {
    $arraythermocouple[] = $row['thermocouple'];
	$arraytemperature[] = $row['temperature'];
	$arraytimestamp[] = $row['UNIX_TIMESTAMP(timestamp)'];
	$array = array_merge($arraythermocouple, $arraytemperature, $arraytimestamp);
}

echo json_encode($array);

$fp = fopen('chartresults.json', 'w');
fwrite($fp, json_encode($array));
fclose($fp);

		
    /* free result set */
    $result->free();
}

/* close connection */
$mysqli->close();

?>