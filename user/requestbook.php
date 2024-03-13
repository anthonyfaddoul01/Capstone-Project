<?php
require('dbconn.php');

$id=$_GET['id'];

$userid=$_SESSION['userId'];

$sql="insert into bookbud.record (userId,bookId,Time) values ('$userid','$id', curtime())";
if($conn->query($sql) === TRUE)
{
	echo "<script type='text/javascript'>alert('Request Already Sent.')</script>";
    header( "Refresh:0.01; url=book.php", true, 303);
}

?>
