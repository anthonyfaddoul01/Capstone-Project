<?php
include_once("dbconn.php");

 if (isset($_POST['delete'])) {
 $id = $_POST['userId'];
$sql2 = "DELETE FROM user WHERE userId = '$id'";
$conn->query($sql2) or die($conn->error);
$sql2 = "DELETE FROM record WHERE userId = '$id'";
$conn->query($sql2) or die($conn->error);
$sql2 = "DELETE FROM return WHERE userId = '$id'";
$conn->query($sql2) or die($conn->error);
$sql2 = "DELETE FROM renew WHERE userId = '$id'";
$conn->query($sql2) or die($conn->error);
$sql2 = "DELETE FROM favorites WHERE userId = '$id'";
$conn->query($sql2) or die($conn->error);
$sql2 = "DELETE FROM message WHERE userId = '$id'";
$conn->query($sql2) or die($conn->error);

  	  echo header("Location: user.php")  ;
 }
?>