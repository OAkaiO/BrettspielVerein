<?php
namespace BVZ;

use PHPMailer\PHPMailer\PHPMailer;
use BVZ\Env;
use PHPMailer\PHPMailer\SMTP;

require_once __DIR__ ."/vendor/autoload.php";

abstract class Mailer{
    protected $mail;
    
    function __construct() {
        $this->mail = new PHPMailer(true);
        $this->mail->isSmtp();
        $this->mail->Host = Env::get(Env::MAIL_HOST); // Specify main and backup SMTP servers
        $this->mail->Port = $_ENV[Env::MAIL_PORT]; // TCP port to connect to

        $this->mail->addAddress('versand@brettspiel-zofingen.ch', 'Versand Brettspielverein Zofingen'); // Add a recipient    
        $this->mail->isHTML(false);
    }


    static function configureMail() : Mailer {
        $profile = Env::get(Env::PROFILE);
        if($profile == Env::DEV_PROFILE){
            return new DummyMailer();
        } else if ($profile == Env::PRODUCTION_PROFILE){
            return new ProductionMailer();
        } else {
            throw new \Exception("Unexpected profile: " . $profile ."");
        }
    }

    

    function sendMail($subject, $message, $from)
    {
        //Recipients
        $this->mail->setFrom($from, 'BVZ Mailer');
        $this->mail->Subject = $subject;
        $this->mail->Body = $message;
    
        $this->mail->send();
    }
    
}

class DummyMailer extends Mailer{

    function __construct() {
        parent::__construct();
        $this->mail->SMTPDebug = SMTP::DEBUG_CONNECTION;
    }
}

class ProductionMailer extends Mailer{

    function __construct() {
        parent::__construct();
        $this->mail->SMTPDebug = SMTP::DEBUG_OFF;

        $this->mail->SMTPAuth = true; // Enable SMTP authentication
        $this->mail->Username = 'versand@brettspiel-zofingen.ch'; // SMTP username
        $this->mail->Password = Env::get(Env::MAIL_PW); // SMTP password
        $this->mail->SMTPSecure = 'ssl'; // Enable TLS encryption, [ICODE]ssl[/ICODE] also accepted
    }
}