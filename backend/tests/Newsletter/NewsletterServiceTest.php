<?php

use BVZ\MailConfigurator;
use PHPUnit\Framework\TestCase;

use BVZ\Newsletter\NewsletterParser;
use BVZ\Newsletter\NewsletterService;
use BVZ\ParserException;
use PHPMailer\PHPMailer\PHPMailer;

require_once __DIR__ . "/../../vendor/autoload.php";

class NewsletterServiceTest extends TestCase
{

    public function testReturns400WhenParserThrows() 
    {
        $parser = $this->createStub(NewsletterParser::class);
        $parser->method('parse')->willThrowException(new ParserException("Dummy"));
        $mailConfigurator = $this->createMock(MailConfigurator::class);
        $mailConfigurator->expects($this->never())
            ->method('configureMail');

        $service = new NewsletterService($parser, $mailConfigurator);
        $service->subscribe("Unit Test input");

        $this->assertEquals(400, http_response_code());
        $this->assertContains('X-Error-State: Dummy', xdebug_get_headers());
    }

    public function testReturns500WhenMailingDoesntWork() 
    {
        $parser = $this->createStub(NewsletterParser::class);
        $parser->method('parse')->willReturn("unit@test.com");
        $mockMail = $this->createStub(PHPMailer::class);
        $mockMail->method('send')->willReturn(false);
        $mailConfigurator = $this->createStub(MailConfigurator::class);
        $mailConfigurator->method('configureMail')
            ->willReturn($mockMail);

        $service = new NewsletterService($parser, $mailConfigurator);
        $service->subscribe("Unit Test input");

        $this->assertEquals(500, http_response_code());
        $this->assertContains('X-Error-State: Could not process registration request!', xdebug_get_headers());
    }
    
    public function testReturns204WhenMailingtWorks() 
    {
        $parser = $this->createStub(NewsletterParser::class);
        $parser->method('parse')->willReturn("unit@test.com");

        $mockMail = $this->createStub(PHPMailer::class);
        $mockMail->method('send')->willReturn(true);

        $mailConfigurator = $this->createMock(MailConfigurator::class);
        $mailConfigurator->method('configureMail')
            ->willReturn($mockMail);
        $mailConfigurator->expects($this->once())->method('configureMail')
            ->with('Newsletter-Abo von unit@test.com', 'Ich melde mich hiermit an :)', 'unit@test.com');

        $service = new NewsletterService($parser, $mailConfigurator);
        $service->subscribe("Unit Test input");
        $this->assertEquals(204, http_response_code());
    }
}
