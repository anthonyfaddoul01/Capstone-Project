<?php
include_once("dbconn.php");

if (isset($_POST['delete'])) {
    $bookid = $_POST['bookId'];
    $sql = "DELETE FROM `book` WHERE bookId = '$bookid'";
    $conn->query($sql) or die($conn->error);

    echo header("Location: book.php");
}
?>