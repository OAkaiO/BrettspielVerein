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
    $addr1 = $_POST['address'];
    if (!isset($addr1) || strlen(trim($addr1)) === 0) {
        header('X-Error-State: address not found or empty!', false);
        $valid = false;
    }
    $addr2 = $_POST['address2'];
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
http_response_code(204);
die();
