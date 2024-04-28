<?php
header('Content-Type: application/json');
require('dbconn.php');

$query = "SELECT DATE_FORMAT(Date_of_Issue, '%Y-%m') AS Month, COUNT(*) AS TotalCheckouts FROM record WHERE Date_of_Issue != '0000-00-00' GROUP BY Month ORDER BY Month";
$result = $conn->query($query);

$data = array();
foreach ($result as $row) {
    $data[] = $row;
}

echo json_encode($data);

