<?php
use PHPMailer\PHPMailer\Exception;
use BVZ\Mailer;

require_once __DIR__ . "/vendor/autoload.php";


if (!isset($_POST['email'])) {
    header('Form-Error: email');
    header('Location: https://neu.brettspiel-zofingen.ch');
    die();
}

try {
    $transformArray = array("{mail}" => $_POST["email"]);
    $subject = strtr("Newsletter-Abo von {mail}", $transformArray);
    Mailer::configureMail()->sendMail($subject, "Ich melde mich hiermit and :)", $_POST["email"]);
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$e}";
}
header('Location: https://neu.brettspiel-zofingen.ch');
die();
