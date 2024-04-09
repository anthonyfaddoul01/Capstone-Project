<?php
require('dbconn.php');

$genre = isset($_GET['genre']) ? $_GET['genre'] : '';

// Prepare the SQL statement to fetch books by genre
$sql = "SELECT bookId, coverImage FROM book WHERE mainGenre = ? LIMIT 24";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $genre);
$stmt->execute();
$result = $stmt->get_result();

// Fetch and display the books
while ($row = $result->fetch_assoc()) {
    $bookid = $row['bookId'];
    $img = $row['coverImage'];
    echo "<div class='col-3 mb-5 d-flex justify-content-center'>
            <div class='card' style='width: 18rem;'>
                <a href='bookdetails.php?id=$bookid'><img src='$img' class='card-img-top'></a>
            </div>
          </div>";
}