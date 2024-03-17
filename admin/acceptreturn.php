<?php
require('dbconn.php');

$bookid = $_GET['id1'];
$userid = $_GET['id2'];
$dues = $_GET['id3'];

$sql1 = "update bookbud.record set Date_of_Return=curdate(),Dues='$dues' where bookId='$bookid' and userId='$userid'";

if ($conn->query($sql1) === TRUE) {
    $sql2 = "update bookbud.book set isAvailable=isAvailable+1 where bookId='$bookid'";
    $result = $conn->query($sql2);
    $sql3 = "delete from bookbud.return where bookId='$bookid' and userId='$userid'";
    $result = $conn->query($sql3);
    $sql4 = "delete from bookbud.renew where bookId='$bookid' and userId='$userid'";
    $result = $conn->query($sql4);
    $sql5 = "insert into bookbud.message (userId,Msg,Date,Time) values ('$userid','Your request for return of BookId: $bookid  has been accepted',curdate(),curtime())";
    $result = $conn->query($sql5);
    echo "<script type='text/javascript'>alert('Success')</script>";
    header("Refresh:0.01; url=return_request.php", true, 303);
} else {
    echo "<script type='text/javascript'>alert('Error')</script>";
    header("Refresh:1; url=return_request.php", true, 303);
}

?>