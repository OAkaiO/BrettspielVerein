<?php

use BVZ\MailConfigurator;

require_once __DIR__ . "/../vendor/autoload.php";

function validateForm($postBody)
{
    $valid = true;
    $fullName = $postBody->{'full-name'} ?? null;
    if (!isset($fullName) || strlen(trim($fullName)) === 0) {
        header('X-Error-State: full-name not found or empty!', false);
        $valid = false;
    }
    $emailAddr = $postBody->{'email'} ?? null;
    if (!isset($emailAddr) || filter_var($emailAddr, FILTER_VALIDATE_EMAIL) === false) {
        header('X-Error-State: email not found or not a valid email!', false);
        $valid = false;
    }
    $message = $postBody->{'message'} ?? null;
    if (!isset($message) || strlen(trim($message)) === 0) {
        header('X-Error-State: message not found or empty!', false);
        $valid = false;
    }
    return $valid;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('X-Error-State: Not a POST');
    http_response_code(405);
    die();
}

$postBody = json_decode(file_get_contents("php://input"));
if (!validateForm($postBody)) {
    http_response_code(400);
    die();
}

$transformArray = array("{fullName}" => $postBody->{'full-name'});
$subject = strtr("Frage von {fullName}", $transformArray);
$mail =  MailConfigurator::configureMail($subject, $postBody->{'message'}, $postBody->{"email"});
$success = $mail->send();
if (!$success) {
    // TODO: logging
    // echo "Message could not be sent. Mailer Error: {$e}";
    http_response_code(500);
    die();
}

http_response_code(204);
die();
