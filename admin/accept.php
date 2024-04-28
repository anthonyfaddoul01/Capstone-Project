<?php
require('dbconn.php');
require('vendor/autoload.php');  // Ensure this path is correct

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$mail->SMTPDebug=SMTP::DEBUG_SERVER;
$bookid = $_GET['id1'];
$userid = $_GET['id2'];

// Prepared statement to prevent SQL injection
$sql1 = "UPDATE bookbud.record SET Date_of_Issue=CURDATE(), Due_Date=DATE_ADD(CURDATE(), INTERVAL 10 DAY), Renewals_left=1 WHERE bookId='$bookid' AND userId='$userid'";

if ($conn->query($sql1) === TRUE) {
    $sql2 = "update bookbud.book set isAvailable=isAvailable-1 , reservedNb = reservedNb+1 where bookId='$bookid'";
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
    echo "<script>alert('Database Error'); window.location.href='issue_request.php';</script>";
}
?>
