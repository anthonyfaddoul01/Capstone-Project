<?php
require('dbconn.php');

$id = $_GET['id'];
$userid = $_SESSION['userId'];

$checkSql = "SELECT * FROM bookbud.return WHERE userId = '$userid' AND bookId = '$id'";
$checkResult = $conn->query($checkSql);

if ($checkResult->num_rows > 0) {
    echo "error";
} else {
    $sql = "insert into bookbud.return (userId,bookId) values ('$userid','$id')";
    if ($conn->query($sql) === TRUE) {
        echo "success";
    }
}
?>