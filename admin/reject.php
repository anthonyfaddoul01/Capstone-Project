<?php
require('dbconn.php');

$bookid = $_GET['id1'];

$userid = $_GET['id2'];

$sql = "delete from bookbud.record where userId='$userid' and bookId='$bookid'";

if ($conn->query($sql) === TRUE) {
    $sql4= "Select title from book where bookId='$bookid'";
    $result1 = $conn->query($sql4);
    $t=$result1->fetch_assoc();
    $u=$t['title'];
    $sql1 = "insert into bookbud.message (userId,Msg,Date,Time) values ('$userid','Your request for issue of $u  has been rejected',curdate(),curtime())";
    $result = $conn->query($sql1);
    echo "<script type='text/javascript'>alert('Success')</script>"; 
    header("Refresh:0.01; url=issue_request.php", true, 303);
} else {
    echo "<script type='text/javascript'>alert('Error')</script>";
    header("Refresh:0.01; url=issue_request.php", true, 303); 

}

?>