<?php
require ('dbconn.php');
$userid = $_SESSION['userId'];
$sql = "SELECT * FROM bookbud.record,bookbud.book WHERE userId = '$userid' 
        and Date_of_Issue != '0000-00-00' and Date_of_Return != '0000-00-00' and book.bookId = record.bookId ORDER BY RAND() LIMIT 10";  

$result = $conn->query($sql);
$books = [];
while ($row = $result->fetch_assoc()) {
    array_push($books, ['title' => $row['title'], 'bookId' => $row['bookId']]);
}

echo json_encode($books);
?>