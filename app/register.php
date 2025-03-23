<?php

use BVZ\MailConfigurator;

require_once __DIR__ . "/vendor/autoload.php";

function validateForm($postBody)
{
    $valid = true;
    $firstName = $postBody->{'firstName'} ?? null;
    if (!isset($firstName) || strlen(trim($firstName)) === 0) {
        header('X-Error-State: firstName not found or empty!', false);
        $valid = false;
    }
    $lastName = $postBody->{'lastName'} ?? null;
    if (!isset($lastName) || strlen(trim($lastName)) === 0) {
        header('X-Error-State: lastName not found or empty!', false);
        $valid = false;
    }
    $emailAddr = $postBody->{'email'} ?? null;
    if (!isset($emailAddr) || filter_var($emailAddr, FILTER_VALIDATE_EMAIL) === false) {
        header('X-Error-State: email not found or not a valid email!', false);
        $valid = false;
    }
    $addr1 = $postBody->{'address'} ?? null;
    if (!isset($addr1) || strlen(trim($addr1)) === 0) {
        header('X-Error-State: address not found or empty!', false);
        $valid = false;
    }
    $addr2 = $postBody->{'address2'} ?? null;
    if (!isset($addr2) || strlen(trim($addr2)) === 0) {
        header('X-Error-State: address2 not found or empty!', false);
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

$transformArray = array(
    "{fullName}" => $postBody->{"firstName"} . ' ' . $postBody->{"lastName"}, "{addr1}" => $postBody->{"address"},
    "{addr2}" => $postBody->{"address2"}, "{email}" => $postBody->{"email"}, "{message}" => $postBody->{"message"}
);
$templateString =
    "\n Name: {fullName}\n Adresse: {addr1}\n Plz + Wohnort: {addr2}\nE-Mail: {email}\n\nNachricht\n {message}";
$subject = strtr("Registrierung von {fullName}", $transformArray);
$mail = MailConfigurator::configureMail($subject, strtr($templateString, $transformArray), $postBody->{"email"});

$success = $mail->send();
if (!$success) {
    // TODO: Logging
    // echo "Message could not be sent. Mailer Error: {$e}";
    http_response_code(500);
}
http_response_code(204);
die();
