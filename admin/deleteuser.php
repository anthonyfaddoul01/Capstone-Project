<?php
include_once("dbconn.php");

 if (isset($_POST['delete'])) {
 $id = $_POST['userId'];
$sql2 = "DELETE FROM `user` WHERE userId = '$id'";
$conn->query($sql2) or die($conn->error);
                                
  	  echo header("Location: user.php")  ;
 }
?>