<?php
require('dbconn.php');

$genre = isset($_GET['genre']) ? $_GET['genre'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 24; // Adjust as needed
$offset = ($page - 1) * $limit;

// Query to fetch books by genre
$sql = "SELECT bookId, coverImage FROM book WHERE mainGenre = ? LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $genre, $offset, $limit);
$stmt->execute();
$result = $stmt->get_result();

// Fetch and display the books
while ($row = $result->fetch_assoc()) {
    $bookid = $row['bookId'];
    $img = $row['coverImage'];
    echo "<div class='col-lg-3 col-sm-6 mb-5 d-flex justify-content-center'>
            <div class='card' style='width: 18rem;'>
                <a href='bookdetails.php?id=$bookid'><img src='$img' class='card-img-top imgcontainer'></a>
            </div>
          </div>";
}

// Pagination logic (calculate total pages)
$totalSql = "SELECT COUNT(*) FROM book WHERE mainGenre LIKE ?";
$totalStmt = $conn->prepare($totalSql);
$totalStmt->bind_param("s", $genre);
$totalStmt->execute();
$totalResult = $totalStmt->get_result();
$totalRows = $totalResult->fetch_array()[0];
$totalPages = ceil($totalRows / $limit);

// Start Pagination Display
echo "<div class='d-flex justify-content-center'>";

// Previous Page Arrow
if ($page > 1) {
    echo "<a href='#' class='p-3 mb-2 bg-warning' onclick='fetchBooksByGenre(\"".htmlspecialchars($genre)."\", ".($page-1).")'><i class='fas fa-angle-left'></i></a> ";
}

// Display Current Page Number
echo "<span class='p-3 mb-2 mx-2 bg-warning'>$page</span>";

// Next Page Arrow
if ($page < $totalPages) {
    echo "<a href='#' class='p-3 mb-2 bg-warning' onclick='fetchBooksByGenre(\"".htmlspecialchars($genre)."\", ".($page+1).")'><i class='fas fa-angle-right'></i></a>";
}

// End Pagination Display
echo "</div>";

?>