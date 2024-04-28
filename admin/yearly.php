<?php
header('Content-Type: application/json');
require('dbconn.php');

$sql = "SELECT DATE_FORMAT(Date_of_Issue, '%Y') AS Year, COUNT(*) AS TotalCheckouts FROM record WHERE Date_of_Issue != '0000-00-00' GROUP BY Year ORDER BY Year";
$result = $conn->query($sql);

$data = array();
foreach ($result as $row) {
    $data[] = $row;
}

echo json_encode($data);

