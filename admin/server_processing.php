<?php
require('dbconn.php');


$draw = $_GET['draw'];
$start = $_GET['start'];
$length = $_GET['length'];
//$searchValue = $_GET['search']['value']; 


$sql = "SELECT bookId, title, author, mainGenre, isAvailable FROM bookbud.book";
// if (!empty($searchValue)) {
//     $sql .= " WHERE title LIKE '%$searchValue%' OR author LIKE '%$searchValue%' OR mainGenre LIKE '%$searchValue%'";
// }
$filteredCountQuery = $sql;
$sql .= " LIMIT $start, $length";


$result = $conn->query($sql);
$data = [];
while ($row = $result->fetch_assoc()) {
    $nestedData = []; 
    $nestedData[] = $row["bookId"];
    $nestedData[] = $row["title"];
    $nestedData[] = $row["author"];
    $nestedData[] = $row["mainGenre"];
    $nestedData[] = $row["isAvailable"] == '1' ? 'Yes' : 'No';
    $nestedData[] = '';

    $data[] = $nestedData;
}


$totalRecordsQuery = "SELECT COUNT(bookId) AS count FROM bookbud.book";
$totalRecordsResult = $conn->query($totalRecordsQuery);
$totalRecordsRow = $totalRecordsResult->fetch_assoc();
$totalRecords = $totalRecordsRow['count'];


$filteredRecordsResult = $conn->query($filteredCountQuery);
$filteredRecords = $filteredRecordsResult->num_rows; 


$json_response = array(
    "draw" => intval($draw),
    "recordsTotal" => intval($totalRecords),
    "recordsFiltered" => intval($filteredRecords),
    "data" => $data
);

echo json_encode($json_response);

?>