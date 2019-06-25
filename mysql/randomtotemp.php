<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="refresh" content="5">
</head>
<body>

<?php
$servername = "localhost";
$username = "********";
$password = "********";
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
$sql1 = "UPDATE `temperatures`SET thermocouple = 1, temperature = ROUND((1770 + rand() * 180)/10,1), time = NOW()WHERE thermocouple = 1";		// M250Supply1WaterTemp
$sql2 = "UPDATE `temperatures`SET thermocouple = 2, temperature = ROUND((1770 + rand() * 180)/10,1), time = NOW()WHERE thermocouple = 2";		// M250Supply2WaterTemp
$sql3 = "UPDATE `temperatures`SET thermocouple = 3, temperature = ROUND((1750 + rand() * 210)/10,1), time = NOW()WHERE thermocouple = 3";		// M250Return1WaterTemp
$sql4 = "UPDATE `temperatures`SET thermocouple = 4, temperature = ROUND((1750 + rand() * 210)/10,1), time = NOW()WHERE thermocouple = 4";		// M250Return2WaterTemp
$sql5 = "UPDATE `temperatures`SET thermocouple = 5, temperature = ROUND((1750 + rand() * 210)/10,1), time = NOW()WHERE thermocouple = 5";		// M250Return1FlowRate
$sql6 = "UPDATE `temperatures`SET thermocouple = 6, temperature = ROUND((1750 + rand() * 210)/10,1), time = NOW()WHERE thermocouple = 6";		// M250Return2FlowRate
$sql7 = "UPDATE `temperatures`SET thermocouple = 7, temperature = ROUND((1800 + rand() * 100)/10,1), time = NOW()WHERE thermocouple = 7";		// AirHandlingUnitSupplyWaterTemp
$sql8 = "UPDATE `temperatures`SET thermocouple = 8, temperature = ROUND((1700 + rand() * 100)/10,1), time = NOW()WHERE thermocouple = 8";		// AirHandlingUnitReturnWaterTemp
$sql9 = "UPDATE `temperatures`SET thermocouple = 9, temperature = ROUND((20 + rand() * 1.5)/10,1), time = NOW()WHERE thermocouple = 9";			// AirHandlingUnitReturnFlowRate
$sql10 = "UPDATE `temperatures`SET thermocouple = 10, temperature = ROUND((1800 + rand() * 100)/10,1), time = NOW()WHERE thermocouple = 10";	// HouseSupplyWaterTemp
$sql11 = "UPDATE `temperatures`SET thermocouple = 11, temperature = ROUND((1600 + rand() * 100)/10,1), time = NOW()WHERE thermocouple = 11";	// HouseReturnWaterTemp
$sql12 = "UPDATE `temperatures`SET thermocouple = 12, temperature = ROUND((20 + rand() * 20)/10,1), time = NOW()WHERE thermocouple = 12";		// HouseReturnFlowRate
$sql13 = "UPDATE `temperatures`SET thermocouple = 13, temperature = ROUND((1800 + rand() * 100)/10,1), time = NOW()WHERE thermocouple = 13";	// DomesticHotWaterSupplyWaterTemp
$sql14 = "UPDATE `temperatures`SET thermocouple = 14, temperature = ROUND((1700 + rand() * 100)/10,1), time = NOW()WHERE thermocouple = 14";	// DomesticHotWaterFlatPlateReturnWaterTemp
$sql15 = "UPDATE `temperatures`SET thermocouple = 15, temperature = ROUND((70 + rand() * 20)/10,1), time = NOW()WHERE thermocouple = 15";		// DomesticHotWaterSupplyFlowRate
$sql16 = "UPDATE `temperatures`SET thermocouple = 16, temperature = ROUND((1600 + rand() * 100)/10,1), time = NOW()WHERE thermocouple = 16";	// DomesticHotWaterShellReturnWaterTemp
$sql17 = "UPDATE `temperatures`SET thermocouple = 17, temperature = ROUND((510 + rand() * 50)/10,1), time = NOW()WHERE thermocouple = 17";		// DomesticHotWaterPotableSupplyTemp
$sql18 = "UPDATE `temperatures`SET thermocouple = 18, temperature = ROUND((20 + rand() * 20)/10,1), time = NOW()WHERE thermocouple = 18";		// DomesticHotWaterPotableSupplyFlowRate
$sql19 = "UPDATE `temperatures`SET thermocouple = 19, temperature = ROUND((1100 + rand() * 100)/10,1), time = NOW()WHERE thermocouple = 19";	// DomesticHotWaterPotableFlatPlateSupplyTemp
$sql20 = "UPDATE `temperatures`SET thermocouple = 20, temperature = ROUND((1300 + rand() * 100)/10,1), time = NOW()WHERE thermocouple = 20";	// DomesticHotWaterPotableHotSupplyTemp
$sql21 = "UPDATE `temperatures`SET thermocouple = 21, temperature = ROUND((8000 + rand() * 1000)/10,1), time = NOW()WHERE thermocouple = 21";	// M250StackTemp
$sql22 = "UPDATE `temperatures`SET thermocouple = 22, temperature = ROUND((rand() * 1000)/10,1), time = NOW()WHERE thermocouple = 22";			// M250HopperLevel		
$sql23 = "UPDATE `temperatures`SET thermocouple = 23, temperature = FLOOR((RAND() * 2)), time = NOW()WHERE thermocouple = 23";					// M250WaterLevel
$sql24 = "UPDATE `temperatures`SET thermocouple = 24, temperature = ROUND((630 + rand() * 210)/10,1), time = NOW()WHERE thermocouple = 24"; 	// AirHandlingUnitReturnAirTemp
$sql25 = "UPDATE `temperatures`SET thermocouple = 25, temperature = ROUND((850 + rand() * 210)/10,1), time = NOW()WHERE thermocouple = 25";		// AirHandlingUnitSupplyAirTemp
$sql26 = "UPDATE `temperatures`SET thermocouple = 26, temperature = ROUND((17500 + rand() * 2100)/10,1), time = NOW()WHERE thermocouple = 26";	// AirHandlingUnitSupplyAirCFM
$sql27 = "UPDATE `temperatures`SET thermocouple = 27, temperature = FLOOR((RAND() * 2)), time = NOW()WHERE thermocouple = 27";					// AirHandlingUnitElectricStripPower
$sql28 = "UPDATE `temperatures`SET thermocouple = 28, temperature = ROUND((200 + rand() * 20)/10,1), time = NOW()WHERE thermocouple = 28";		// AirHandlingUnitSupplyAirRH
$sql29 = "UPDATE `temperatures`SET thermocouple = 29, temperature = ROUND((170 + rand() * 20)/10,1), time = NOW()WHERE thermocouple = 29";		// AirHandlingUnitReturnAirRH
$sql30 = "UPDATE `temperatures`SET thermocouple = 30, temperature = ROUND((1180 + rand() * 20)/10,1), time = NOW()WHERE thermocouple = 30";		// DomesticDomesticHotWaterPotableHotSupplyTemp
$sql31 = "UPDATE `temperatures`SET thermocouple = 31, temperature = ROUND((1180 + rand() * 20)/10,1), time = NOW()WHERE thermocouple = 31";		// DomesticHotWaterPotableShellSupplyTemp
$sql32 = "UPDATE `temperatures`SET thermocouple = 32, temperature = ROUND((1300 + rand() * 20)/10,1), time = NOW()WHERE thermocouple = 32";		// DomesticHotWaterPotableShellReturnTemp
$sql33 = "UPDATE `temperatures`SET thermocouple = 33, temperature = ROUND((1800 + rand() * 100)/10,1), time = NOW()WHERE thermocouple = 33";	// GarageSupplyWaterTemp
$sql34 = "UPDATE `temperatures`SET thermocouple = 34, temperature = ROUND((1700 + rand() * 100)/10,1), time = NOW()WHERE thermocouple = 34";	// GarageReturnWaterTemp
$sql35 = "UPDATE `temperatures`SET thermocouple = 35, temperature = ROUND((20 + rand() * 1.5)/10,1), time = NOW()WHERE thermocouple = 35";		// GarageReturnFlowRate
$sql36 = "UPDATE `temperatures`SET thermocouple = 36, temperature = ROUND((1180 + rand() * 20)/10,1), time = NOW()WHERE thermocouple = 36";
$sql37 = "UPDATE `temperatures`SET thermocouple = 37, temperature = ROUND((1180 + rand() * 20)/10,1), time = NOW()WHERE thermocouple = 37";
$sql38 = "UPDATE `temperatures`SET thermocouple = 38, temperature = ROUND((1180 + rand() * 20)/10,1), time = NOW()WHERE thermocouple = 38";
$sql39 = "UPDATE `temperatures`SET thermocouple = 39, temperature = ROUND((1180 + rand() * 20)/10,1), time = NOW()WHERE thermocouple = 39";
$sql40 = "UPDATE `temperatures`SET thermocouple = 40, temperature = ROUND((1180 + rand() * 20)/10,1), time = NOW()WHERE thermocouple = 40";

if ($conn->query($sql1) === TRUE) {
    echo "Thermocouple 1 updated successfully <br />";
} else {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
	echo "Thermocouple 2 updated successfully <br />";
} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}
if ($conn->query($sql3) === TRUE) {
    echo "Thermocouple 3 updated successfully <br />";
} else {
    echo "Error: " . $sql3 . "<br>" . $conn->error;
}
if ($conn->query($sql4) === TRUE) {
    echo "Thermocouple 4 updated successfully <br />";
} else {
    echo "Error: " . $sql4 . "<br>" . $conn->error;
}
if ($conn->query($sql5) === TRUE) {
    echo "Thermocouple 5 updated successfully <br />";
} else {
    echo "Error: " . $sql5 . "<br>" . $conn->error;
}
if ($conn->query($sql6) === TRUE) {
    echo "Thermocouple 6 updated successfully <br />";
} else {
    echo "Error: " . $sql6 . "<br>" . $conn->error;
}
if ($conn->query($sql7) === TRUE) {
    echo "Thermocouple 7 updated successfully <br />";
} else {
    echo "Error: " . $sql7 . "<br>" . $conn->error;
}
if ($conn->query($sql8) === TRUE) {
    echo "Thermocouple 8 updated successfully <br />";
} else {
    echo "Error: " . $sql8 . "<br>" . $conn->error;
}
if ($conn->query($sql9) === TRUE) {
    echo "Thermocouple 9 updated successfully <br />";
} else {
    echo "Error: " . $sql9 . "<br>" . $conn->error;
}
if ($conn->query($sql10) === TRUE) {
    echo "Thermocouple 10 updated successfully <br />";
} else {
    echo "Error: " . $sql10 . "<br>" . $conn->error;
}
if ($conn->query($sql11) === TRUE) {
    echo "Thermocouple 11 updated successfully <br />";
} else {
    echo "Error: " . $sql11 . "<br>" . $conn->error;
}
if ($conn->query($sql12) === TRUE) {
    echo "Thermocouple 12 updated successfully <br />";
} else {
    echo "Error: " . $sql12 . "<br>" . $conn->error;
}
if ($conn->query($sql13) === TRUE) {
    echo "Thermocouple 13 updated successfully <br />";
} else {
    echo "Error: " . $sql13 . "<br>" . $conn->error;
}
if ($conn->query($sql14) === TRUE) {
    echo "Thermocouple 14 updated successfully <br />";
} else {
    echo "Error: " . $sql14 . "<br>" . $conn->error;
}
if ($conn->query($sql15) === TRUE) {
    echo "Thermocouple 15 updated successfully <br />";
} else {
    echo "Error: " . $sql15 . "<br>" . $conn->error;
}
if ($conn->query($sql16) === TRUE) {
    echo "Thermocouple 16 updated successfully <br />";
} else {
    echo "Error: " . $sql16 . "<br>" . $conn->error;
}
if ($conn->query($sql17) === TRUE) {
    echo "Thermocouple 17 updated successfully <br />";
} else {
    echo "Error: " . $sql17 . "<br>" . $conn->error;
}
if ($conn->query($sql18) === TRUE) {
    echo "Thermocouple 18 updated successfully <br />";
} else {
    echo "Error: " . $sql18 . "<br>" . $conn->error;
}
if ($conn->query($sql19) === TRUE) {
    echo "Thermocouple 19 updated successfully <br />";
} else {
    echo "Error: " . $sql19 . "<br>" . $conn->error;
}
if ($conn->query($sql20) === TRUE) {
    echo "Thermocouple 20 updated successfully <br />";
} else {
    echo "Error: " . $sql20 . "<br>" . $conn->error;
}
if ($conn->query($sql21) === TRUE) {
    echo "Thermocouple 21 updated successfully <br />";
} else {
    echo "Error: " . $sql21 . "<br>" . $conn->error;
}
if ($conn->query($sql22) === TRUE) {
    echo "Thermocouple 22 updated successfully <br />";
} else {
    echo "Error: " . $sql22 . "<br>" . $conn->error;
}
if ($conn->query($sql23) === TRUE) {
    echo "Thermocouple 23 updated successfully <br />";
} else {
    echo "Error: " . $sql23 . "<br>" . $conn->error;
}
if ($conn->query($sql24) === TRUE) {
    echo "Thermocouple 24 updated successfully <br />";
} else {
    echo "Error: " . $sql24 . "<br>" . $conn->error;
}
if ($conn->query($sql25) === TRUE) {
    echo "Thermocouple 25 updated successfully <br />";
} else {
    echo "Error: " . $sql25 . "<br>" . $conn->error;
}
if ($conn->query($sql26) === TRUE) {
    echo "Thermocouple 26 updated successfully <br />";
} else {
    echo "Error: " . $sql26 . "<br>" . $conn->error;
}
if ($conn->query($sql27) === TRUE) {
    echo "Thermocouple 27 updated successfully <br />";
} else {
    echo "Error: " . $sql27 . "<br>" . $conn->error;
}
if ($conn->query($sql28) === TRUE) {
    echo "Thermocouple 28 updated successfully <br />";
} else {
    echo "Error: " . $sql28 . "<br>" . $conn->error;
}
if ($conn->query($sql29) === TRUE) {
    echo "Thermocouple 29 updated successfully <br />";
} else {
    echo "Error: " . $sql29 . "<br>" . $conn->error;
}
if ($conn->query($sql30) === TRUE) {
    echo "Thermocouple 30 updated successfully <br />";
} else {
    echo "Error: " . $sql30 . "<br>" . $conn->error;
}
if ($conn->query($sql31) === TRUE) {
    echo "Thermocouple 31 updated successfully <br />";
} else {
    echo "Error: " . $sql31 . "<br>" . $conn->error;
}
if ($conn->query($sql32) === TRUE) {
    echo "Thermocouple 32 updated successfully <br />";
} else {
    echo "Error: " . $sql32 . "<br>" . $conn->error;
}
if ($conn->query($sql33) === TRUE) {
    echo "Thermocouple 33 updated successfully <br />";
} else {
    echo "Error: " . $sql33 . "<br>" . $conn->error;
}
if ($conn->query($sql34) === TRUE) {
    echo "Thermocouple 34 updated successfully <br />";
} else {
    echo "Error: " . $sql34 . "<br>" . $conn->error;
}
if ($conn->query($sql35) === TRUE) {
    echo "Thermocouple 35 updated successfully <br />";
} else {
    echo "Error: " . $sql35 . "<br>" . $conn->error;
}
if ($conn->query($sql36) === TRUE) {
    echo "Thermocouple 36 updated successfully <br />";
} else {
    echo "Error: " . $sql36 . "<br>" . $conn->error;
}
if ($conn->query($sql37) === TRUE) {
    echo "Thermocouple 37 updated successfully <br />";
} else {
    echo "Error: " . $sql37 . "<br>" . $conn->error;
}
if ($conn->query($sql38) === TRUE) {
    echo "Thermocouple 38 updated successfully <br />";
} else {
    echo "Error: " . $sql38 . "<br>" . $conn->error;
}
if ($conn->query($sql39) === TRUE) {
    echo "Thermocouple 39 updated successfully <br />";
} else {
    echo "Error: " . $sql39 . "<br>" . $conn->error;
}
if ($conn->query($sql40) === TRUE) {
    echo "Thermocouple 40 updated successfully <br />";
} else {
    echo "Error: " . $sql40 . "<br>" . $conn->error;
}
$conn->close();
?>

</body>
</html>
