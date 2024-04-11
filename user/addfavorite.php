<?php
require('dbconn.php');

$bookid = $_GET['bookId'];
$userid = $_SESSION['userId'];

$sql = "INSERT INTO bookbud.favorites (userId,bookId) values ('$userid', '$bookid')";

if ($conn->query($sql) == TRUE) {
    echo 'success';
} else {
    echo 'failure';
}

?>