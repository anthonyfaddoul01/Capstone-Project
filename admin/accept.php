<?php
require ('dbconn.php');
require ('vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$bookid = $_GET['id1'];
$userid = $_GET['id2'];

$sql = "SELECT name, email, borrowedNb FROM user WHERE userId = '$userid'";

$userresult = $conn->query($sql);
$userr = $userresult->fetch_assoc();
$email = $userr['email'];
$name = $userr['name'];
$nbreserved = $userr['borrowedNb'];
if ($nbreserved >= 10) {
    echo "<script type='text/javascript'>alert('Max number of allowed book!')</script>";
    header("Refresh:1; url=issue_request.php", true, 303);
} else {


    $sql1 = "update bookbud.record set Date_of_Issue=curdate(),Due_Date=date_add(curdate(),interval 10 day),Renewals_left=1 where bookId='$bookid' and userId='$userid'";

    if ($conn->query($sql1) === TRUE) {
        $sql2 = "update bookbud.book set isAvailable=isAvailable-1 , reservedNb = reservedNb+1 where bookId='$bookid'";
        $result = $conn->query($sql2);
        $sql5 = "update bookbud.user set borrowedNb = borrowedNb+1 where userId='$userid'";
        $result = $conn->query($sql5);
        $sql4 = "Select title from book where bookId='$bookid'";
        $result1 = $conn->query($sql4);
        $t = $result1->fetch_assoc();
        $u = $t['title'];
        $sql3 = "insert into bookbud.message (userId,Msg,Date,Time) values ('$userid','Your request for issue of $u has been accepted',curdate(),curtime())";
        $result = $conn->query($sql3);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'bookkbudd@gmail.com';
            $mail->Password = 'nggn aljx doux joah';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('bookkbudd@gmail.com', 'BookBud');
            $mail->addAddress($email); 
            $mail->isHTML(true);
            $mail->Subject = 'Book Issue Confirmation';
            $mail->Body = "Hello $name, <b>$u</b> has been successfully issued to you.";
            $mail->AltBody = "Hello $name, $u has been successfully issued to you.";

            $mail->send();
            echo "<script type='text/javascript'>alert('Success')</script>";
            header("Refresh:0.01; url=issue_request.php", true, 303);
        } catch (Exception $e) {
            echo "<script>alert('Mailer Error: {$mail->ErrorInfo}'); window.location.href='issue_request.php';</script>";
        }

        echo "<script type='text/javascript'>alert('Success')</script>";
        header("Refresh:0.01; url=issue_request.php", true, 303);
    } else {
        echo "<script type='text/javascript'>alert('Error')</script>";
        header("Refresh:1; url=issue_request.php", true, 303);

    }
}

?>