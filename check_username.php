<?php
require 'dbconn.php';  // Make sure dbconn.php correctly sets up a database connection

$username = $_POST['username'] ?? '';

if ($username) {
    $sql = "SELECT COUNT(*) AS count FROM users WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        if ($stmt->execute()) {
            $stmt->bind_result($count);
            $stmt->fetch();
            if ($count > 0) {
                echo "exists";  // Username exists
            } else {
                echo "available";  // Username is available
            }
        } else {
            echo "error";
        }
        $stmt->close();
    } else {
        echo "error";
    }
} else {
    echo "error";
}

?>
