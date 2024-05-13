<?php
require('dbconn.php');
require ('vendor/autoload.php');  // Ensure this path is correct

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$id = $_GET['id'];
$penalty = $_GET['penalty'];
$balance = $_GET['balance'];
$email = $_GET['email'];
$name = $_GET['name'];

if($penalty==0){
    echo "<script type='text/javascript'>alert('Cannot pay 0$')</script>";
    header("Refresh:0.01; url=user.php", true, 303);
}else{
    if($balance-$penalty>=0 && $penalty>0){
        $sql = "update user set balance = balance - '$penalty' where userId = '$id'";
        $conn->query($sql);
        $sql = "select balance from user where userId = '$id'";
        $result = $conn->query($sql);
        $x = $result->fetch_assoc();
        $balance = $x['balance'];
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
            $mail->Body = "Hello $name, amount of $penalty has been payed. Your current balance is: $balance";
            $mail->AltBody = "Hello $name, amount of $penalty has been payed. Your balance is now: $balance";
    
            $mail->send();
            echo "<script type='text/javascript'>alert('Success')</script>";
            header("Refresh:0.01; url=user.php", true, 303);
        } catch (Exception $e) {
            echo "<script>alert('Mailer Error: {$mail->ErrorInfo}'); window.location.href='user.php';</script>";
        }
    
    }else{
        echo "<script type='text/javascript'>alert('Balance is less then amount payed!')</script>";
        header("Refresh:0.01; url=user.php", true, 303);
    }
}



?>