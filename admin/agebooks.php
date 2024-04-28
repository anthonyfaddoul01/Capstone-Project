<?php
require('dbconn.php');

$sql = "SELECT yearOfPublication, COUNT(*) AS NumberOfBooks FROM book WHERE yearOfPublication IS NOT NULL GROUP BY yearOfPublication ORDER BY yearOfPublication";
$result = $conn->query($sql);

$data = [];
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}


header('Content-Type: application/json');
echo json_encode($data);