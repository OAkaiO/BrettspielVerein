<?php

namespace BVZ;

use PHPMailer\PHPMailer\PHPMailer;
use BVZ\Env;
use PHPMailer\PHPMailer\SMTP;

require_once __DIR__ . "/../vendor/autoload.php";

class MailConfigurator
{

    private static function baseConfigure()
    {
        $mail = new PHPMailer();
        $mail->isSmtp();
        $mail->Host = Env::get(Env::MAIL_HOST); // Specify main and backup SMTP servers
        $mail->Port = Env::get(Env::MAIL_PORT); // TCP port to connect to

        $mail->addAddress('versand@brettspiel-zofingen.ch', 'Versand Brettspielverein Zofingen'); // Add a recipient
        $mail->isHTML(false);
        return $mail;
    }


    static function configureMail($subject, $message, $from): PHPMailer
    {
        $mail = MailConfigurator::baseConfigure();
        $profile = Env::get(Env::PROFILE);
        if ($profile == Env::DEV_PROFILE) {
            MailConfigurator::configureDummy($mail);
        } else if ($profile == Env::PRODUCTION_PROFILE) {
            MailConfigurator::configureProduction($mail);
        } else {
            throw new \Exception("Unexpected profile: " . $profile . "");
        }
        //Recipients
        $mail->setFrom($from, 'BVZ Mailer');
        $mail->Subject = $subject;
        $mail->Body = $message;

        return $mail;
    }

    private static     function configureDummy($mail)
    {
        // $mail->SMTPDebug = SMTP::DEBUG_CONNECTION; //TODO: Need to figure out how to not print this to browser
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
    }

    private static function configureProduction($mail)
    {
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'versand@brettspiel-zofingen.ch'; // SMTP username
        $mail->Password = Env::get(Env::MAIL_PW); // SMTP password
        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, [ICODE]ssl[/ICODE] also accepted
    }
}
