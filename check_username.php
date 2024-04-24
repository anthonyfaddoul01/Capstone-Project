<?php
/*require 'dbconn.php';  // Make sure dbconn.php correctly sets up a database connection
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
$username = $_POST['username'];

// Replace 'users' and 'username_column' with your actual table and column names
$query = $mysqli->prepare("SELECT COUNT(*) FROM users WHERE username_column = ?");
$query->bind_param("s", $username);
$query->execute();
$query->bind_result($count);
$query->fetch();

$response = ['exists' => $count > 0];
$query->close();
$mysqli->close();

echo json_encode(['exists' => $count > 0]);
echo json_encode($response);*/


require 'dbconn.php';  // This assumes dbconn.php sets up $mysqli correctly as shown above

header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

$username = $_POST['username'] ?? ''; // Use null coalescing operator to default to an empty string if not set

if (empty($username)) {
    echo json_encode(['error' => 'Username is required']);
    exit;
}

$query = $conn->prepare("SELECT COUNT(*) FROM user WHERE  name= ?"); // Replace 'username_column' with the actual column name
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
// $mysqli->close();
?>
