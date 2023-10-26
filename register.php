<?php

use PHPMailer\PHPMailer\Exception;

require_once(dirname(__FILE__) . "sendMail.php");

function validateForm()
{
    $valid = true;
    if (!isset($_POST['full-name'])) {
        header('Form-Error: full-name');
        $valid = false;
    }
    if (!isset($_POST['email'])) {
        header('Form-Error: email', false);
        $valid = false;
    }
    if (!isset($_POST['address'])) {
        header('Form-Error: address', false);
        $valid = false;
    }
    if (!isset($_POST['address2'])) {
        header('Form-Error: address2', false);
        $valid = false;
    }
    if (!isset($_POST['message'])) {
        header('Form-Error: message', false);
        $valid = false;
    }
    return $valid;
}

if (!isset($_POST['full-name'])) {
    header('Location: https://neu.brettspiel-zofingen.ch');
    die();
}

if (!validateForm()) {
    header('Location: https://neu.brettspiel-zofingen.ch');
    die();
}

try {
    $transformArray = array("{fullName}" => $_POST["full-name"], "{addr1}" => $_POST["address"],
        "{addr2}" => $_POST["address2"], "{email}" => $_POST["email"], "{message}" => $_POST["message"]);
    $templateString =
        "\n Name: {fullName}\n Adresse: {addr1}\n Plz + Wohnort: {addr2}\nE-Mail: {email}\n\nNachricht\n {message}";
    $subject = strtr("Registrierung von {fullName}", $transformArray);
    sendMail($subject, strtr($templateString, $transformArray), $_POST["email"]);
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$e}";
}
header('Location: https://neu.brettspiel-zofingen.ch');
die();
