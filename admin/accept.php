<?php
require('dbconn.php');

$bookid = $_GET['id1'];
$userid = $_GET['id2'];

$sql1 = "update bookbud.record set Date_of_Issue=curdate(),Due_Date=date_add(curdate(),interval 10 day),Renewals_left=1 where bookId='$bookid' and userId='$userid'";

if ($conn->query($sql1) === TRUE) {
    $sql2 = "update bookbud.book set isAvailable=isAvailable-1 where bookId='$bookid'";
    $result = $conn->query($sql2);
    $sql4= "Select title from book where bookId='$bookid'";
    $result1 = $conn->query($sql4);
    $t=$result1->fetch_assoc();
    $u=$t['title'];
    $sql3 = "insert into bookbud.message (userId,Msg,Date,Time) values ('$userid','Your request for issue of $u has been accepted',curdate(),curtime())";
    $result = $conn->query($sql3);
    echo "<script type='text/javascript'>alert('Success')</script>";
    header("Refresh:0.01; url=issue_request.php", true, 303);
} else {
    echo "<script type='text/javascript'>alert('Error')</script>";
    header("Refresh:1; url=issue_request.php", true, 303);

}

?>