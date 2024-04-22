<?php
require 'dbconn.php';  // Make sure dbconn.php correctly sets up a database connection

$username = $_POST['username'] ?? '';

header('Content-Type: application/json'); // Good practice for AJAX responses

if ($username) {
    $sql = "SELECT COUNT(*) AS count FROM users WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $param_username);
        $param_username = $username;

        if ($stmt->execute()) {
            $stmt->bind_result($count);
            $stmt->fetch();

            if ($count > 0) {
                echo json_encode(['status' => 'taken']);
            } else {
                echo json_encode(['status' => 'not_taken']);
            }
        } else {
            echo json_encode(['error' => 'Error on database query.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['error' => 'Failed to prepare the statement.']);
    }
} else {
    echo json_encode(['error' => 'No username provided.']);
}

$conn->close();
?>
