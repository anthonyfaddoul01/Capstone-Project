<?php
require('dbconn.php');
require ('vendor/autoload.php');  // Ensure this path is correct

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$bookid = $_GET['id1'];
$userid = $_GET['id2'];

$sql6 = "delete from bookbud.renew where bookId='$bookid' and userId='$userid'";
$sql = "SELECT name, email FROM user WHERE userId = '$userid'";

$userresult = $conn->query($sql);
$userr = $userresult->fetch_assoc();
$email = $userr['email'];
$name = $userr['name'];
if ($conn->query($sql6) == TRUE) {
    $sql4= "Select title from book where bookId='$bookid'";
    $result1 = $conn->query($sql4);
    $t=$result1->fetch_assoc();
    $u=$t['title'];
    $sql1 = "insert into bookbud.message (userId,Msg,Date,Time) values ('$userid', 'Your Request for renew of $u has been rejected', curdate(),curtime())";
    $result = $conn->query($sql1);
    try {
        // Configure PHPMailer
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bookkbudd@gmail.com';
        $mail->Password = 'nggn aljx doux joah';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email content
        $mail->setFrom('bookkbudd@gmail.com', 'BookBud');
        $mail->addAddress($email);  // Set recipient
        $mail->isHTML(true);
        $mail->Subject = 'Book Issue Confirmation';
        $mail->Body = "Hello $name, your request for return of <b>$u</b> has been accepted.";
        $mail->AltBody = "Hello $name, your request for return of $u has been accepted.";

        $mail->send();
        echo "<script type='text/javascript'> alert ('Success')</script>";
    header("Refresh:0.01; url=renew_request.php", true, 303);
    } catch (Exception $e) {
        echo "<script>alert('Mailer Error: {$mail->ErrorInfo}'); window.location.href='issue_request.php';</script>";
    }
    echo "<script type='text/javascript'> alert ('Success')</script>";
    header("Refresh:0.01; url=renew_request.php", true, 303);
} else {
    echo "<script type='text/javascript'>alert('Error')</script>";
    header("Refresh:0.01; url=renew_request.php", true, 303);
}

?>