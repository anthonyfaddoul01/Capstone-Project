<?php
header('Content-Type: application/json');
require('dbconn.php');

$sql = "SELECT DATE_FORMAT(Date_of_Issue, '%Y-%m') AS Month, SUM(Penalty) AS TotalFines FROM record GROUP BY Month ORDER BY Month";
$result = $conn->query($sql);

$data = array();
foreach ($result as $row) {
    $data[] = $row;
}

echo json_encode($data);

