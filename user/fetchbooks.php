<?php
// Connect to the database
include 'db_connection.php';
session_start();

$genre = $_GET['genre'] ?? '';
$special = $_GET['special'] ?? '';

// Prepare SQL based on parameters
if ($genre) {
    $sql = "SELECT bookId, coverImage FROM bookbud.book WHERE mainGenre = ? ORDER BY RAND() LIMIT 20";
} elseif ($special == 'toprated') {
    $sql = "SELECT bookId, coverImage FROM bookbud.book WHERE numRating > 1000000 ORDER BY rating DESC";
} elseif ($special == 'newbooks') {
    $sql = "SELECT bookId, coverImage FROM bookbud.book WHERE yearOfPublication='2024'";
} else {
    // Handle error or provide a default action
}

// Execute SQL and fetch data
$books = [];
if ($sql) {
    $stmt = $conn->prepare($sql);
    if ($genre) {
        $stmt->bind_param("s", $genre);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
    $stmt->close();
}

// Return data as JSON
echo json_encode($books);