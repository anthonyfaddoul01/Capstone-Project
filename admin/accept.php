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
// nggn aljx doux joah google key
// Prepared statement to prevent SQL injection
$sql1 = "UPDATE bookbud.record SET Date_of_Issue=CURDATE(), Due_Date=DATE_ADD(CURDATE(), INTERVAL 10 DAY), Renewals_left=1 WHERE bookId='$bookid' AND userId='$userid'";

    $stmt4 = $conn->prepare("SELECT title FROM book WHERE bookId=?");
    $stmt4->bind_param("s", $bookid);
    $stmt4->execute();
    $result1 = $stmt4->get_result();
    $title = $result1->fetch_assoc()['title'];

    $stmt3 = $conn->prepare("INSERT INTO bookbud.message (userId, Msg, Date, Time) VALUES (?, ?, CURDATE(), CURTIME())");
    $msg = "Your request for issue of $title has been accepted";
    $stmt3->bind_param("ss", $userid, $msg);
    $stmt3->execute();

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
        $mail->addAddress('ramadanhasan118@gmail.com');  // Set recipient
        $mail->isHTML(true);
        $mail->Subject = 'Book Issue Confirmation';
        $mail->Body = "Hello, <b>$title</b> has been successfully issued to you.";
        $mail->AltBody = "Hello, $title has been successfully issued to you.";

        $mail->send();
        echo "<script>alert('Success'); window.location.href='issue_request.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Mailer Error: {$mail->ErrorInfo}'); window.location.href='issue_request.php';</script>";
    }
 
?>
