<?php
require ('dbconn.php');
$userid = $_SESSION['userId'];
$sql = "SELECT * FROM bookbud.record,bookbud.book WHERE userId = '$userid' 
        and Date_of_Issue is NOT NULL and Date_of_Return is NOT NULL and book.bookId = record.bookId ORDER BY RAND() LIMIT 10";  

$result = $conn->query($sql);
$books = [];
while ($row = $result->fetch_assoc()) {
    array_push($books, ['title' => $row['title'], 'bookId' => $row['bookId']]);
}

echo json_encode($books);
?>