<?php

session_start();
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbdata = "bookbud";
$conn = mysqli_connect($dbservername, $dbusername, $dbpassword,$dbdata);
if (!$conn) {
    echo "Connected unsuccessfully";
    die("Connection failed: " . mysqli_connect_error());
}


?>

