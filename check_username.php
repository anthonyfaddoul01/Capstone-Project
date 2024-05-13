<?php
require 'dbconn.php';

header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

$username = $_POST['username'] ?? '';

if (empty($username)) {
    echo json_encode(['error' => 'Username is required']);
    exit;
}

$query = $conn->prepare("SELECT COUNT(*) FROM user WHERE  username= ?"); 
if ($query) {
    $query->bind_param("s", $username);
    $query->execute();
    $query->bind_result($count);
    $query->fetch();
    $query->close();

    echo json_encode(['exists' => $count > 0]);
} else {
    echo json_encode(['error' => 'Query preparation failed: ' . $conn->error]);
}

?>
