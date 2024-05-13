<?php
require('dbconn.php');

$sql = "SELECT DATE_FORMAT(creationDate, '%Y-%m') AS MembershipMonth, COUNT(*) AS NewMemberships FROM user GROUP BY MembershipMonth ORDER BY MembershipMonth";
$result = $conn->query($sql);

$data = [];
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
?>
