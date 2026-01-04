<?php

use BVZ\Logging\LoggerFactory;
use BVZ\MailConfigurator;
use BVZ\Newsletter\NewsletterDTO;
use PHPUnit\Framework\TestCase;

use BVZ\Newsletter\NewsletterParser;
use BVZ\Newsletter\NewsletterService;
use PHPMailer\PHPMailer\PHPMailer;

require_once __DIR__ . "/../../vendor/autoload.php";

class NewsletterServiceTest extends TestCase
{
    public function testReturns500WhenMailingDoesntWork() 
    {
        $mockMail = $this->createStub(PHPMailer::class);
        $mockMail->method('send')->willReturn(false);
        $mailConfigurator = $this->createStub(MailConfigurator::class);
        $mailConfigurator->method('configureMail')
            ->willReturn($mockMail);

        $service = new NewsletterService($mailConfigurator, new LoggerFactory(true));
        $service->subscribe(NewsletterDTO::create("unit@test.com"));

        $this->assertEquals(500, http_response_code());
        $this->assertContains('X-Error-State: Could not process registration request!', xdebug_get_headers());
    }
    
    public function testReturns204WhenMailingWorks() 
    {
        $mockMail = $this->createStub(PHPMailer::class);
        $mockMail->method('send')->willReturn(true);

        $mailConfigurator = $this->createMock(MailConfigurator::class);
        $mailConfigurator->method('configureMail')
            ->willReturn($mockMail);
        $mailConfigurator->expects($this->once())->method('configureMail')
            ->with('Newsletter-Abo von unit@test.com', 'Ich melde mich hiermit an :)', 'unit@test.com');

        $service = new NewsletterService($mailConfigurator, new LoggerFactory(true));
        $service->subscribe(NewsletterDTO::create("unit@test.com"));
        $this->assertEquals(204, http_response_code());
    }
}
