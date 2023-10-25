<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

require_once './mailPw.php';

if(!isset($_POST['full-name'])){
    header('Location: https://neu.brettspiel-zofingen.ch');
    die();
}

// Instantiation and passing [ICODE]true[/ICODE] enables exceptions
$mail = new PHPMailer(true);
// TODO: Form validation!
try {
 //Server settings
 $mail->SMTPDebug = $SMTP::DEBUG_OFF;
 $mail->isSMTP(); // Set mailer to use SMTP
 $mail->Host = 'authsmtp.securemail.pro'; // Specify main and backup SMTP servers
 $mail->SMTPAuth = true; // Enable SMTP authentication
 $mail->Username = 'versand@brettspiel-zofingen.ch'; // SMTP username
 $mail->Password = $SMTP_PASSWORD; // SMTP password
 $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, [ICODE]ssl[/ICODE] also accepted
 $mail->Port = 465; // TCP port to connect to

//Recipients
 $mail->setFrom($_POST["email"], 'BVZ Mailer');
 $mail->addAddress('versand@brettspiel-zofingen.ch', 'Versand Brettspielverein Zofingen'); // Add a recipient
 $mail->addAddress('luki.schaer@hispeed.ch'); // Name is optional
 $mail->addAddress('steven-lang@bluewin.ch'); // Name is optional
 $mail->addReplyTo('versand@brettspiel-zofingen.ch', 'Versand Brettspielverein Zofingen');

// Content
 $transformArray = array("{fullName}" => $_POST["full-name"]);
 $mail->isHTML(false);
 $mail->Subject = strtr("Frage von {fullName}", $transformArray);
 $mail->Body = $_POST["message"];

$mail->send();
 echo 'Message has been sent';
} catch (Exception $e) {
 echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
header('Location: https://neu.brettspiel-zofingen.ch');
die();