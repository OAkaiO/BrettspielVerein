<?php

use BVZ\MailConfigurator;

require_once __DIR__ . "/vendor/autoload.php";

function validateForm()
{
    $valid = true;
    $fullName = $_POST['full-name'];
    if (!isset($fullName) || strlen(trim($fullName)) === 0) {
        header('X-Error-State: full-name not found or empty!', false);
        $valid = false;
    }
    $emailAddr = $_POST['email'];
    if (!isset($emailAddr) || filter_var($emailAddr, FILTER_VALIDATE_EMAIL) === false) {
        header('X-Error-State: email not found or not a valid email!', false);
        $valid = false;
    }
    $message = $_POST['message'];
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

if (!validateForm()) {
    http_response_code(400);
    die();
}

$transformArray = array("{fullName}" => $_POST["full-name"]);
$subject = strtr("Frage von {fullName}", $transformArray);
$mail =  MailConfigurator::configureMail($subject, $_POST['message'], $_POST["email"]);
$success = $mail->send();
if (!$success) {
    // TODO: logging
    // echo "Message could not be sent. Mailer Error: {$e}";
    http_response_code(500);
    die();
}

http_response_code(204);
die();
