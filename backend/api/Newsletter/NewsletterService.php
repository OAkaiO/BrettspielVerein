<?php

namespace BVZ\Newsletter;

use BVZ\MailConfigurator;
use BVZ\Newsletter\NewsletterParser;
use BVZ\ParserException;

class NewsletterService
{
    function __construct(private NewsletterParser $parser = new NewsletterParser(),
                         private MailConfigurator $mailConfigurator = new MailConfigurator())
    {
        $this->parser=$parser;
    }

    public function process(string $body)
    {
        try {
            $email = $this->parser->parse($body);
        }
        catch(ParserException $e)
        {
            $error = $e->getMessage();
            header("X-Error-State: $error");
            http_response_code(400);
            return;
        }

        $transformArray = array("{mail}" => $email);
        $subject = strtr("Newsletter-Abo von {mail}", $transformArray);
        $message = "Ich melde mich hiermit an :)";
        $mail = $this->mailConfigurator->configureMail($subject, $message, $email);

        $success = $mail->send();
        if (!$success) {
            // TODO: Logging, as echo kills the http response approach, and doesn't provide value, anyways
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
            header("X-Error-State: Could not process registration request!");
            http_response_code(500);
        } else {
            http_response_code(204);
        }
    }
}
