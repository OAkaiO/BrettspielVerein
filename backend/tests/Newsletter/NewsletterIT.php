<?php

use BVZ\MailConfigurator;
use BVZ\Newsletter\NewsletterController;
use BVZ\Newsletter\NewsletterParser;
use BVZ\Newsletter\NewsletterService;
use BVZ\Request\RequestHandler;
use PHPMailer\PHPMailer\PHPMailer;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../../vendor/autoload.php";

class NewsletterIT extends TestCase
{
    public function testSuccessfulRequest()
    {
        $body = '{"email": "unit@test.com"}';

        $file = $this->getTemporaryFile($body);
        $fileName = stream_get_meta_data($file)['uri'];

        $mockRequestHandler = new RequestHandler($fileName);

        $mockMail = $this->createStub(PHPMailer::class);
        $mockMail->method('send')->willReturn(true);

        $mockMailer = $this->createMock(MailConfigurator::class);
        $mockMailer->expects($this->once())->method('configureMail')
            ->with('Newsletter-Abo von unit@test.com', 'Ich melde mich hiermit an :)', 'unit@test.com')
            ->willReturn($mockMail);


        $parser = new NewsletterParser();
        $service = new NewsletterService($mockMailer);

        $controller = new NewsletterController($parser, $service, $mockRequestHandler);

        $_SERVER['REQUEST_METHOD'] = "POST";
        $controller->handle();

        $this->assertEquals(204, http_response_code());
    }

    public function testReturnsWith500WhenMailingFails()
    {
        $body = '{"email": "unit@test.com"}';

        $file = $this->getTemporaryFile($body);
        $fileName = stream_get_meta_data($file)['uri'];

        $mockRequestHandler = new RequestHandler($fileName);

        $mockMail = $this->createStub(PHPMailer::class);
        $mockMail->method('send')->willReturn(false);

        $mockMailer = $this->createMock(MailConfigurator::class);
        $mockMailer->expects($this->once())->method('configureMail')
            ->with('Newsletter-Abo von unit@test.com', 'Ich melde mich hiermit an :)', 'unit@test.com')
            ->willReturn($mockMail);


        $parser = new NewsletterParser();
        $service = new NewsletterService($mockMailer);

        $controller = new NewsletterController($parser, $service, $mockRequestHandler);

        $_SERVER['REQUEST_METHOD'] = "POST";
        $controller->handle();

        $this->assertEquals(500, http_response_code());
        $this->assertContains("X-Error-State: Could not process registration request!", xdebug_get_headers());
    }

    public function testFailsWhenMissingData()
    {
        $body = '{"notemail": "unit@test.com"}';

        $file = $this->getTemporaryFile($body);
        $fileName = stream_get_meta_data($file)['uri'];

        $mockRequestHandler = new RequestHandler($fileName);

        $mockMailer = $this->createMock(MailConfigurator::class);
        $mockMailer->expects($this->never())->method('configureMail');


        $parser = new NewsletterParser();
        $service = new NewsletterService($mockMailer);

        $controller = new NewsletterController($parser, $service, $mockRequestHandler);

        $_SERVER['REQUEST_METHOD'] = "POST";
        $controller->handle();

        $this->assertEquals(400, http_response_code());
        $this->assertContains("X-Error-State: Email address not found!", xdebug_get_headers());
    }

    private function getTemporaryFile(string $contents)
    {
        $file = tmpfile();
        fwrite($file, $contents);
        fseek($file, 0);
        return $file;
    }
}
