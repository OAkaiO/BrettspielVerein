<?php

namespace BVZ\Newsletter;

use BVZ\Logging\LoggerFactory;
use BVZ\MailConfigurator;
use Monolog\Logger;

require_once __DIR__ . "/../../vendor/autoload.php";

class NewsletterService
{
    private readonly Logger $logger;

    function __construct(private MailConfigurator $mailConfigurator = new MailConfigurator(),
        private readonly LoggerFactory $loggerFactory = new LoggerFactory()
    )
    {
        $this->logger = $loggerFactory->getLogger('NewsletterService');
    }

    public function subscribe(NewsletterDTO $dto)
    {
        $transformArray = array("{mail}" => $dto->email);
        $subject = strtr("Newsletter-Abo von {mail}", $transformArray);
        $message = "Ich melde mich hiermit an :)";
        $mail = $this->mailConfigurator->configureMail($subject, $message, $dto->email);

        $success = $mail->send();
        if (!$success) {
            $this->logger->error("Message could not be sent. Mailer Error: " . $mail->ErrorInfo);
            header("X-Error-State: Could not process registration request!");
            http_response_code(500);
        } else {
            http_response_code(204);
        }
    }
}
