<?php

use BVZ\MailConfigurator;
use BVZ\Question\QuestionController;
use BVZ\Question\QuestionParser;
use BVZ\Question\QuestionService;
use BVZ\Request\RequestHandler;
use PHPMailer\PHPMailer\PHPMailer;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../../vendor/autoload.php";

class QuestionIT extends TestCase
{
    public function testSuccessfulRequest()
    {
        $body = '{"fullName":"Unit Test", "email": "unit@test.com", "message": "Hello there"}';

        $file = $this->getTemporaryFile($body);
        $fileName = stream_get_meta_data($file)['uri'];

        $mockRequestHandler = new RequestHandler($fileName);

        $mockMail = $this->createStub(PHPMailer::class);
        $mockMail->method('send')->willReturn(true);

        $mockMailer = $this->createMock(MailConfigurator::class);
        $mockMailer->expects($this->once())->method('configureMail')
            ->with('Frage von Unit Test', 'Hello there', 'unit@test.com')
            ->willReturn($mockMail);


        $parser = new QuestionParser();
        $service = new QuestionService($mockMailer);

        $controller = new QuestionController($parser, $service, $mockRequestHandler);

        $_SERVER['REQUEST_METHOD'] = "POST";
        $controller->handle();

        $this->assertEquals(204, http_response_code());
    }

    public function testReturnsWith500WhenMailingFails()
    {
        $body = '{"fullName":"Unit Test", "email": "unit@test.com", "message": "Hello there"}';

        $file = $this->getTemporaryFile($body);
        $fileName = stream_get_meta_data($file)['uri'];

        $mockRequestHandler = new RequestHandler($fileName);

        $mockMail = $this->createStub(PHPMailer::class);
        $mockMail->method('send')->willReturn(false);

        $mockMailer = $this->createMock(MailConfigurator::class);
        $mockMailer->expects($this->once())->method('configureMail')
            ->with('Frage von Unit Test', 'Hello there', 'unit@test.com')
            ->willReturn($mockMail);


        $parser = new QuestionParser();
        $service = new QuestionService($mockMailer);

        $controller = new QuestionController($parser, $service, $mockRequestHandler);

        $_SERVER['REQUEST_METHOD'] = "POST";
        $controller->handle();

        $this->assertEquals(500, http_response_code());
        $this->assertContains("X-Error-State: Could not process question!", xdebug_get_headers());
    }

    public function testFailsWhenMissingData()
    {
        $body = '{"fullName":"Unit Test", "email": "unit@test.com"}';

        $file = $this->getTemporaryFile($body);
        $fileName = stream_get_meta_data($file)['uri'];

        $mockRequestHandler = new RequestHandler($fileName);

        $mockMailer = $this->createMock(MailConfigurator::class);
        $mockMailer->expects($this->never())->method('configureMail');


        $parser = new QuestionParser();
        $service = new QuestionService($mockMailer);

        $controller = new QuestionController($parser, $service, $mockRequestHandler);

        $_SERVER['REQUEST_METHOD'] = "POST";
        $controller->handle();

        $this->assertEquals(400, http_response_code());
        $this->assertContains("X-Error-State: message not found or empty!", xdebug_get_headers());
    }

    private function getTemporaryFile(string $contents)
    {
        $file = tmpfile();
        fwrite($file, $contents);
        fseek($file, 0);
        return $file;
    }
}
