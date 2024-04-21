<?php
require ('dbconn.php');
$bookid = $_GET['bookId'];
$sql = "SELECT * FROM bookbud.book WHERE bookId = '$bookid'";  

$result = $conn->query($sql);
$r = $result->fetch_assoc();
echo json_encode($r);
?>