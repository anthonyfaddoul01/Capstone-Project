<?php
require('dbconn.php');

// Retrieve the request parameters sent by DataTables
$draw = $_GET['draw'];
$start = $_GET['start'];
$length = $_GET['length'];
$searchValue = $_GET['search']['value']; // Global search value

// Construct the SQL query
$sql = "SELECT bookId, title, author, mainGenre, isAvailable FROM bookbud.book";
$whereClause = "";

if ($searchValue) {
    $whereClause = "WHERE title LIKE '%" . $searchValue . "%' OR author LIKE '%" . $searchValue . "%' OR mainGenre LIKE '%" . $searchValue . "%'";
    // Adjust your limit query to first select IDs
    $limitSubQuery = "SELECT bookId FROM bookbud.book $whereClause LIMIT $start, $length";
    // Then, join those IDs with the original table to fetch the full rows
    $dataQuery = "SELECT bookId, title, author, mainGenre, isAvailable FROM bookbud.book WHERE bookId IN ($limitSubQuery)";
}

$limitClause = "LIMIT $start, $length";

// Total number of records without filtering
$totalRecordsQuery = "SELECT COUNT(*) FROM bookbud.book";
$totalRecordsResult = $conn->query($totalRecordsQuery);
$totalRecords = $totalRecordsResult->fetch_row()[0];

// Total number of records with filtering
if ($whereClause) {
    $filteredRecordsQuery = "SELECT COUNT(*) FROM bookbud.book $whereClause";
    $filteredRecordsResult = $conn->query($filteredRecordsQuery);
    $filteredRecords = $filteredRecordsResult->fetch_row()[0];
} else {
    $filteredRecords = $totalRecords;
}

// Fetch the actual data
$dataQuery = "$sql $whereClause $limitClause";
$dataResult = $conn->query($dataQuery);

$data = [];
while ($row = $dataResult->fetch_assoc()) {
    $detailsButton = "<button class='btn btn-primary details-btn mx-2' data-id='" . $row['bookId'] . "'>Details</button>";
    $editButton = "<button class='btn btn-success edit-btn mx-2' data-id='" . $row['bookId'] . "'>Edit</button>";
    $actions = "<div class='d-flex'>{$detailsButton} {$editButton}</div>";

    $data[] = [
        $row['bookId'],
        $row['title'],
        $row['author'],
        $row['mainGenre'],
        $row['isAvailable'] == '1' ? '<span class="text-success"><b>Yes</b></span>' : '<span class="text-danger"><b>No</b></span>',
        $actions
    ];
}

// Prepare the response for DataTables
$response = [
    "draw" => intval($draw),
    "recordsTotal" => intval($totalRecords),
    "recordsFiltered" => intval($filteredRecords),
    "data" => $data
];

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>