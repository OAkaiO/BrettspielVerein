<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home/eg5mx54b/neu.brettspiel-zofingen.ch/PHPMailer/src/Exception.php';
require '/home/eg5mx54b/neu.brettspiel-zofingen.ch/PHPMailer/src/PHPMailer.php';
require '/home/eg5mx54b/neu.brettspiel-zofingen.ch/PHPMailer/src/SMTP.php';

require_once './mailPw.php'

// Instantiation and passing [ICODE]true[/ICODE] enables exceptions
$mail = new PHPMailer(true);

try {
 //Server settings
 $mail->SMTPDebug = 2; // Enable verbose debug output
 $mail->isSMTP(); // Set mailer to use SMTP
 $mail->Host = 'authsmtp.securemail.pro'; // Specify main and backup SMTP servers
 $mail->SMTPAuth = true; // Enable SMTP authentication
 $mail->Username = 'versand@brettspiel-zofingen.ch'; // SMTP username
 $mail->Password = $SMTP_PASSWORD; // SMTP password
 $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, [ICODE]ssl[/ICODE] also accepted
 $mail->Port = 465; // TCP port to connect to

//Recipients
 $mail->setFrom('versand@brettspiel-zofingen.ch', 'Mailer');
 $mail->addAddress('versand@brettspiel-zofingen.ch', 'Versand Brettspielverein Zofingen'); // Add a recipient
 $mail->addAddress('steven-lang@bluewin.ch'); // Name is optional
 $mail->addReplyTo('versand@brettspiel-zofingen.ch', 'Versand Brettspielverein Zofingen');

// Attachments
// $mail->addAttachment('/home/cpanelusername/attachment.txt'); // Add attachments
// $mail->addAttachment('/home/cpanelusername/image.jpg', 'new.jpg'); // Optional name

// Content
 $mail->isHTML(true); // Set email format to HTML
 $mail->Subject = 'Here is the subject';
 $mail->Body = 'This is the HTML message body <b>in bold!</b>';
 $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

$mail->send();
 echo 'Message has been sent';

} catch (Exception $e) {
 echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}