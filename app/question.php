<?php
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . "/sendMail.php";
require_once __DIR__ ."/vendor/autoload.php";

function validateForm()
{
    $valid = true;
    if (!isset($_POST['full-name'])) {
        header('Form-Error: full-name', false);
        $valid = false;
    }
    if (!isset($_POST['email'])) {
        header('Form-Error: email', false);
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
    $transformArray = array("{fullName}" => $_POST["full-name"]);
    $subject = strtr("Frage von {fullName}", $transformArray);
    sendMail($subject, $_POST['message'], $_POST["email"]);
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$e}";
}
header('Location: https://neu.brettspiel-zofingen.ch');
die();

?>