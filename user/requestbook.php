<?php
require('dbconn.php');

$id = $_GET['id'];
$userid = $_SESSION['userId'];

$checkSql = "SELECT * FROM bookbud.record WHERE userId = '$userid' AND bookId = '$id'";
$checkResult = $conn->query($checkSql);

if ($checkResult->num_rows > 0) {
    echo "<script type='text/javascript'>alert('Request Already Sent.');</script>";
    header("Refresh:0.01; url=book.php", true, 303);
} else {
    $sql = "INSERT INTO bookbud.record (userId, bookId, Time) VALUES ('$userid', '$id', CURTIME())";
    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>alert('Request Sent Successfully.');</script>";
        header("Refresh:0.01; url=book.php", true, 303);
    }
}
?>