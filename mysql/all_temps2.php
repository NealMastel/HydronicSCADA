<?php
$mysqli = new mysqli("localhost", "********", "********", "currenttemp");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$query = "SELECT temperature FROM temperatures";

if ($result = $mysqli->query($query)) {

    /* fetch associative array */
    $array = array();    
while($row = mysqli_fetch_assoc($result)) {
    $array[] = $row['temperature'];
}

echo json_encode($array);

$fp = fopen('results.json', 'w');
fwrite($fp, json_encode($array));
fclose($fp);

		
    /* free result set */
    $result->free();
}

/* close connection */
$mysqli->close();

$url1=$_SERVER['REQUEST_URI'];
    header("Refresh: 5; URL=$url1");
?>
