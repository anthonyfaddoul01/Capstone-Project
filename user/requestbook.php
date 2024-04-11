<?php
require('dbconn.php');

$id = $_GET['id'];
$userid = $_SESSION['userId'];

$checkSql = "SELECT * FROM bookbud.record WHERE userId = '$userid' AND bookId = '$id'";
$checkResult = $conn->query($checkSql);

if ($checkResult->num_rows > 0) {
    echo "error";
    //header("Refresh:0.01; url=book.php", true, 303);
} else {
    $sql = "INSERT INTO bookbud.record (userId, bookId, Time) VALUES ('$userid', '$id', CURTIME())";
    if ($conn->query($sql) === TRUE) {
        echo "success";
        //header("Refresh:0.01; url=book.php", true, 303);
    }
}
?>