<?php
use PHPMailer\PHPMailer\PHPMailer;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

require_once './mailPw.php';

function sendMail($subject, $message, $from)
{
    global $SMTP_PASSWORD;
    // Instantiation and passing [ICODE]true[/ICODE] enables exceptions
    $mail = new PHPMailer(true);
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'authsmtp.securemail.pro'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'versand@brettspiel-zofingen.ch'; // SMTP username
    $mail->Password = $SMTP_PASSWORD; // SMTP password
    $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, [ICODE]ssl[/ICODE] also accepted
    $mail->Port = 465; // TCP port to connect to

    //Recipients
    $mail->setFrom($from, 'BVZ Mailer');
    $mail->addAddress('versand@brettspiel-zofingen.ch', 'Versand Brettspielverein Zofingen'); // Add a recipient

    // Content
    $mail->isHTML(false);
    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();
    echo 'Message has been sent';

}
