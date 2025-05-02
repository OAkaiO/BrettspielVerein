<?php

use BVZ\MailConfigurator;

require_once __DIR__ . "/../vendor/autoload.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('X-Error-State: Not a POST');
    http_response_code(405);
    die();
}

$postBody = json_decode(file_get_contents("php://input"));
$emailAddr = $postBody->{'email'};
if (!isset($emailAddr) || filter_var($emailAddr, FILTER_VALIDATE_EMAIL) === false) {
    header('X-Error-State: Email address not found or invalid!');
    http_response_code(400);
    die();
}

$transformArray = array("{mail}" => $emailAddr);
$subject = strtr("Newsletter-Abo von {mail}", $transformArray);
$mail = MailConfigurator::configureMail($subject, "Ich melde mich hiermit and :)", $emailAddr);
$success = $mail->send();
if (!$success) {
    // TODO: Logging, as echo kills the http response approach, and doesn't provide value, anyways
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
    http_response_code(500);
} else {
    http_response_code(204);
}
