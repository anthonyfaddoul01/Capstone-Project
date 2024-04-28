<?php
require 'dbconn.php';  // This assumes dbconn.php sets up $mysqli correctly as shown above

header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

$email = $_POST['email'] ?? ''; // Use null coalescing operator to default to an empty string if not set

if (empty($email)) {
    echo json_encode(['error' => 'Email is required']);
    exit;
}

$query = $conn->prepare("SELECT COUNT(*) FROM user WHERE  email= ?"); // Replace 'email' with the actual column name
if ($query) {
    $query->bind_param("s", $email);
    $query->execute();
    $query->bind_result($count);
    $query->fetch();
    $query->close();

    echo json_encode(['exists' => $count > 0]);
} else {
    echo json_encode(['error' => 'Query preparation failed: ' . $conn->error]);
}
// $mysqli->close();
?>
