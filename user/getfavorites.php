<?php
require("dbconn.php");
$userid = $_SESSION['userId'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 24;
$offset = ($page - 1) * $limit;

$sql = "SELECT bookId FROM favorites WHERE userId='$userid' LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $offset, $limit);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $bookid = $row['bookId'];
    $sql1 = "SELECT coverImage FROM book WHERE bookId='$bookid' ";
    $result2 = $conn->query($sql1);
    $r = $result2->fetch_assoc();
    $img = $r['coverImage'];
    echo "<div class='col-lg-3 col-sm-6 mb-5 d-flex justify-content-center'>
            <div class='card' style='width: 18rem;'>
                <a href='bookdetails.php?id=$bookid'><img src='$img' class='card-img-top imgcontainer'></a>
            </div>
          </div>";
}

$totalSql = "SELECT COUNT(*) FROM favorites WHERE userId='$userid'";
$totalStmt = $conn->prepare($totalSql);
$totalStmt->execute();
$totalResult = $totalStmt->get_result();
$totalRows = $totalResult->fetch_array()[0];
$totalPages = ceil($totalRows / $limit);

echo "<div class='d-flex justify-content-center'>";

if ($page > 1) {
    echo "<a href='#' class='p-3 mb-2 bg-warning' onclick='searchBooks( ".($page-1).")'><i class='fas fa-angle-left'></i></a> ";
}

echo "<span class='p-3 mb-2 mx-2 bg-warning'>$page</span>";

if ($page < $totalPages) {
    echo "<a href='#' class='p-3 mb-2 bg-warning' onclick='searchBooks(".($page+1).")'><i class='fas fa-angle-right'></i></a>";
}

echo "</div>";

?>