<?php
// DB connection
require('dbconn.php');

// DataTables server-side processing request parameters
$draw = $_GET['draw'];
$start = $_GET['start'];
$length = $_GET['length'];
$searchValue = $_GET['search']['value']; // Global search value

// Build the SQL query
$sql = "SELECT bookId, title, author, mainGenre, isAvailable FROM bookbud.book";
if (!empty($searchValue)) {
    $sql .= " WHERE title LIKE '%$searchValue%' OR author LIKE '%$searchValue%' OR mainGenre LIKE '%$searchValue%'";
}
$filteredCountQuery = $sql; // Query to get the count of filtered records
$sql .= " LIMIT $start, $length";

// Execute the query
$result = $conn->query($sql);
$data = [];
while ($row = $result->fetch_assoc()) {
    $nestedData = []; // Prepare nested array to match DataTables expected format
    $nestedData[] = $row["bookId"];
    $nestedData[] = $row["title"];
    $nestedData[] = $row["author"];
    $nestedData[] = $row["mainGenre"];
    $nestedData[] = $row["isAvailable"] == '1' ? 'Yes' : 'No';
    $nestedData[] = '';
    // Add more columns as needed
    $data[] = $nestedData;
}

// Get total number of records in the database
$totalRecordsQuery = "SELECT COUNT(bookId) AS count FROM bookbud.book";
$totalRecordsResult = $conn->query($totalRecordsQuery);
$totalRecordsRow = $totalRecordsResult->fetch_assoc();
$totalRecords = $totalRecordsRow['count'];

// Get the total number of records after filtering
$filteredRecordsResult = $conn->query($filteredCountQuery);
$filteredRecords = $filteredRecordsResult->num_rows; // Might need adjustment based on the actual query used

// Prepare the JSON response
$json_response = array(
    "draw" => intval($draw),
    "recordsTotal" => intval($totalRecords),
    "recordsFiltered" => intval($filteredRecords),
    "data" => $data
);

echo json_encode($json_response);
?>