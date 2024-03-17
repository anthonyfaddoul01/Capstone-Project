<?php
require('dbconn.php');

$bookid = $_GET['id1'];
$userid = $_GET['id2'];

$sql1 = "update bookbud.record set Due_Date=date_add(Due_Date,interval 03 day),Renewals_left=0 where bookId='$bookid' and userId='$userid'";

if ($conn->query($sql1) === TRUE) {
    $sql3 = "delete from bookbud.renew where bookId='$bookid' and userId='$userid'";
    $result = $conn->query($sql3);

    $sql5 = "insert into bookbud.message (userId,Msg,Date,Time) values ('$userid','Your request for renewal of BookId: $bookid  has been accepted',curdate(),curtime())";
    $result = $conn->query($sql5);
    echo "<script type='text/javascript'>alert('Success')</script>";
    header("Refresh:0.01; url=renew_request.php", true, 303);
} else {
    echo "<script type='text/javascript'>alert('Error')</script>";
    header("Refresh:0.01; url=renew_request.php", true, 303);

}

?>