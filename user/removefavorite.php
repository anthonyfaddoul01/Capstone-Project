<?php
require('dbconn.php');

$bookid = $_GET['bookId'];
$userid = $_SESSION['userId'];

$sql = "DELETE FROM bookbud.favorites WHERE userId='$userid' and bookId='$bookid'";

if ($conn->query($sql) == TRUE) {
    echo 'success';
} else {
    echo 'failure';
}

?>