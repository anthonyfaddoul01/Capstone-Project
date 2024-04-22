<?php
require('dbconn.php');

// SQL to fetch data
$sql = "SELECT bookId, title, rating, mainGenre, numRating, reservedNb FROM book LIMIT 50";
$result = $conn->query($sql);

$books = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

echo json_encode($books);
?>