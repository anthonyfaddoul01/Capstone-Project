<?php
require('dbconn.php');

if (isset($_POST['delete'])) {
    $M_Id = $_POST['M_Id'];
    $sql2 = "DELETE FROM `message` WHERE M_Id = '$M_Id'";
    $conn->query($sql2);
    echo header("Location:../librarian/receive_message.php");
}
?>