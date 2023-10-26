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
        header('Form-Error: email');
        $valid = false;
    }
    if (!isset($_POST['message'])) {
        header('Form-Error: message');
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