<?php
require('dbconn.php');

$bookid = $_GET['id1'];
$userid = $_GET['id2'];

$sql6 = "delete from bookbud.renew where bookId='$bookid' and userId='$userid'";

if ($conn->query($sql6) == TRUE) {
    $sql1 = "insert into bookbud.message (userId,Msg,Date,Time) values ('$userid', 'Your Request for renew of BookId: $bookid has been rejected', curdate(),curtime())";
    $result = $conn->query($sql1);
    echo "<script type='text/javascript'> alert ('Success')</script>";
    header("Refresh:0.01; url=renew_request.php", true, 303);
} else {
    echo "<script type='text/javascript'>alert('Error')</script>";
    header("Refresh:0.01; url=renew_request.php", true, 303);
}

?>