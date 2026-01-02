<?php

namespace BVZ\Question;

use BVZ\MailConfigurator;

require_once __DIR__ . "/../../vendor/autoload.php";

class QuestionService
{
    function __construct(private MailConfigurator $mailConfigurator = new MailConfigurator())
    {}

    public function ask(QuestionDTO $dto)
    {
        $transformArray = array("{fullName}" => $dto->fullName);
        $subject = strtr("Frage von {fullName}", $transformArray);
        $mail =  $this->mailConfigurator->configureMail($subject, $dto->message, $dto->email);

        $success = $mail->send();
        if (!$success) {
            // TODO: Logging, as echo kills the http response approach, and doesn't provide value, anyways
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
            header("X-Error-State: Could not process question!");
            http_response_code(500);
        } else {
            http_response_code(204);
        }
    }
}
