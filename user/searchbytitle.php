<?php
require("dbconn.php");

$searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 24; 
$offset = ($page - 1) * $limit;

$sql = "SELECT bookId, coverImage FROM book WHERE (title LIKE ? OR author LIKE ?) LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$searchTerm = "%$searchTerm%";
$stmt->bind_param("ssii", $searchTerm, $searchTerm, $offset, $limit);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $bookid = $row['bookId'];
    $img = $row['coverImage'];
    echo "<div class='col-lg-3 col-sm-6 mb-5 d-flex justify-content-center'>
            <div class='card' style='width: 18rem;'>
                <a href='bookdetails.php?id=$bookid'><img src='$img' class='card-img-top imgcontainer'></a>
            </div>
          </div>";
}

$totalSql = "SELECT COUNT(*) FROM book WHERE (title LIKE ? OR author LIKE ?)";
$totalStmt = $conn->prepare($totalSql);
$totalStmt->bind_param("ss", $searchTerm, $searchTerm);
$totalStmt->execute();
$totalResult = $totalStmt->get_result();
$totalRows = $totalResult->fetch_array()[0];
$totalPages = ceil($totalRows / $limit);

echo "<div class='d-flex justify-content-center'>";

if ($page > 1) {
    echo "<a href='#' class='p-3 mb-2 bg-warning' onclick='searchBooks(\"".htmlspecialchars($searchTerm)."\", ".($page-1).")'><i class='fas fa-angle-left'></i></a> ";
}

echo "<span class='p-3 mb-2 mx-2 bg-warning'>$page</span>";

if ($page < $totalPages) {
    echo "<a href='#' class='p-3 mb-2 bg-warning' onclick='searchBooks(\"".htmlspecialchars($searchTerm)."\", ".($page+1).")'><i class='fas fa-angle-right'></i></a>";
}

echo "</div>";

?>