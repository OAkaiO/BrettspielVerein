<?php

use BVZ\MailConfigurator;
use BVZ\Question\QuestionDTO;
use PHPUnit\Framework\TestCase;

use BVZ\Question\QuestionParser;
use BVZ\Question\QuestionService;
use PHPMailer\PHPMailer\PHPMailer;

require_once __DIR__ . "/../../vendor/autoload.php";

class QuestionServiceTest extends TestCase
{
    public function testReturns500WhenMailingDoesntWork() 
    {
        $mockMail = $this->createStub(PHPMailer::class);
        $mockMail->method('send')->willReturn(false);
        $mailConfigurator = $this->createStub(MailConfigurator::class);
        $mailConfigurator->method('configureMail')
            ->willReturn($mockMail);

        $service = new QuestionService($mailConfigurator);
        $service->ask(QuestionDTO::create("unit@test.com", "Unit Test", "Hello"));

        $this->assertEquals(500, http_response_code());
        $this->assertContains('X-Error-State: Could not process question!', xdebug_get_headers());
    }
    
    public function testReturns204WhenMailingtWorks() 
    {
        $mockMail = $this->createStub(PHPMailer::class);
        $mockMail->method('send')->willReturn(true);

        $mailConfigurator = $this->createMock(MailConfigurator::class);
        $mailConfigurator->method('configureMail')
            ->willReturn($mockMail);
        $mailConfigurator->expects($this->once())->method('configureMail')
            ->with('Frage von Unit Test', 'Hello', 'unit@test.com');

        $service = new QuestionService($mailConfigurator);
        $service->ask(QuestionDTO::create("unit@test.com", "Unit Test", "Hello"));
        $this->assertEquals(204, http_response_code());
    }
}
