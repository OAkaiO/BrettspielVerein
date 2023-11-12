<?php

use BVZ\MailConfigurator;

require_once __DIR__ . "/vendor/autoload.php";

function validateForm()
{
    $valid = true;
    if (!isset($_POST['full-name'])) {
        header('X-Error-State: full-name not found in request!');
        $valid = false;
    }
    if (!isset($_POST['email'])) {
        header('X-Error-State: email not found in request!', false);
        $valid = false;
    }
    if (!isset($_POST['address'])) {
        header('X-Error-State: address not found in request!', false);
        $valid = false;
    }
    if (!isset($_POST['address2'])) {
        header('X-Error-State: address2 not found in request!', false);
        $valid = false;
    }
    if (!isset($_POST['message'])) {
        header('X-Error-State: message not found in request!', false);
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

$transformArray = array(
    "{fullName}" => $_POST["full-name"], "{addr1}" => $_POST["address"],
    "{addr2}" => $_POST["address2"], "{email}" => $_POST["email"], "{message}" => $_POST["message"]
);
$templateString =
    "\n Name: {fullName}\n Adresse: {addr1}\n Plz + Wohnort: {addr2}\nE-Mail: {email}\n\nNachricht\n {message}";
$subject = strtr("Registrierung von {fullName}", $transformArray);
$mail = MailConfigurator::configureMail($subject, strtr($templateString, $transformArray), $_POST["email"]);

$success = $mail->send();
if (!$success) {
    // TODO: Logging
    // echo "Message could not be sent. Mailer Error: {$e}";
    http_response_code(500);
}
http_response_code(200);
die();
