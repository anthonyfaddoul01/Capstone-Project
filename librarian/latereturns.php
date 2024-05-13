<?php
header('Content-Type: application/json');
require('dbconn.php');

$sql = "SELECT DATE_FORMAT(Date_of_Return, '%Y-%m') AS ReturnMonth, COUNT(*) AS LateReturns FROM record WHERE Date_of_Return > Due_Date GROUP BY ReturnMonth ORDER BY ReturnMonth";
$result = $conn->query($sql);

$data = array();
foreach ($result as $row) {
    $data[] = $row;
}

echo json_encode($data);

