<?php

namespace BVZ\Member;

use BVZ\MailConfigurator;

require_once __DIR__ . "/../../vendor/autoload.php";

class MemberService
{
    function __construct(private MailConfigurator $mailConfigurator = new MailConfigurator())
    {}

    public function register(MemberDTO $dto)
    {
        $transformArray = array(
            "{fullName}" => $dto->{"firstName"} . ' ' . $dto->{"lastName"}, "{addr1}" => $dto->{"address1"},
            "{addr2}" => $dto->{"address2"}, "{email}" => $dto->{"email"}, "{message}" => $dto->{"message"}
        );
        $templateString =
            "\n Name: {fullName}\n Adresse: {addr1}\n Plz + Wohnort: {addr2}\nE-Mail: {email}\n\nNachricht\n {message}";
        $subject = strtr("Registrierung von {fullName}", $transformArray);
        $mail = $this->mailConfigurator->configureMail($subject, strtr($templateString, $transformArray), $dto->{"email"});
        

        $success = $mail->send();
        if (!$success) {
            // TODO: Logging, as echo kills the http response approach, and doesn't provide value, anyways
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
            header("X-Error-State: Could not process member signup!");
            http_response_code(500);
        } else {
            http_response_code(204);
        }
    }
}
