<?php

use BVZ\MailConfigurator;

require_once __DIR__ . "/vendor/autoload.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('X-Error-State: Not a POST');
    http_response_code(405);
    die();
}

if (!isset($_POST['email'])) {
    header('X-Error-State: Email address not found in request!');
    http_response_code(400);
    die();
}

$transformArray = array("{mail}" => $_POST["email"]);
$subject = strtr("Newsletter-Abo von {mail}", $transformArray);
$mail = MailConfigurator::configureMail($subject, "Ich melde mich hiermit and :)", $_POST["email"]);
$success = $mail->send();
if (!$success) {
    // TODO: Logging, as echo kills the http response approach, and doesn't provide value, anyways
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
    http_response_code(500);
} else {
    http_response_code(204);
}
