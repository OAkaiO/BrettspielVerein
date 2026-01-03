<?php

use BVZ\MailConfigurator;
use BVZ\Member\MemberController;
use BVZ\Member\MemberParser;
use BVZ\Member\MemberService;
use BVZ\Request\RequestHandler;
use PHPMailer\PHPMailer\PHPMailer;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../../vendor/autoload.php";

class MemberIT extends TestCase
{
    public function testSuccessfulRequest()
    {
        $body = '{"firstName":"Unit", "lastName":"Test","address1":"Teststreet","address2":"Testcity", "email": "unit@test.com", "message": "Hello"}';
        $expectedMessage = <<<TEST
        
         Name: Unit Test
         Adresse: Teststreet
         Plz + Wohnort: Testcity
        E-Mail: unit@test.com

        Nachricht
         Hello
        TEST;

        $file = $this->getTemporaryFile($body);
        $fileName = stream_get_meta_data($file)['uri'];

        $mockRequestHandler = new RequestHandler($fileName);

        $mockMail = $this->createStub(PHPMailer::class);
        $mockMail->method('send')->willReturn(true);

        $mockMailer = $this->createMock(MailConfigurator::class);
        $mockMailer->expects($this->once())->method('configureMail')
            ->with('Registrierung von Unit Test', $expectedMessage, 'unit@test.com')
            ->willReturn($mockMail);


        $parser = new MemberParser();
        $service = new MemberService($mockMailer);

        $controller = new MemberController($parser, $service, $mockRequestHandler);

        $_SERVER['REQUEST_METHOD'] = "POST";
        $controller->handle();

        $this->assertEquals(204, http_response_code());
    }

    public function testReturnsWith500WhenMailingFails()
    {
        $body = '{"firstName":"Unit", "lastName":"Test","address1":"Teststreet","address2":"Testcity", "email": "unit@test.com", "message": "Hello"}';
        $expectedMessage = <<<TEST
        
         Name: Unit Test
         Adresse: Teststreet
         Plz + Wohnort: Testcity
        E-Mail: unit@test.com

        Nachricht
         Hello
        TEST;

        $file = $this->getTemporaryFile($body);
        $fileName = stream_get_meta_data($file)['uri'];

        $mockRequestHandler = new RequestHandler($fileName);

        $mockMail = $this->createStub(PHPMailer::class);
        $mockMail->method('send')->willReturn(false);

        $mockMailer = $this->createMock(MailConfigurator::class);
        $mockMailer->expects($this->once())->method('configureMail')
            ->with('Registrierung von Unit Test', $expectedMessage, 'unit@test.com')
            ->willReturn($mockMail);


        $parser = new MemberParser();
        $service = new MemberService($mockMailer);

        $controller = new MemberController($parser, $service, $mockRequestHandler);

        $_SERVER['REQUEST_METHOD'] = "POST";
        $controller->handle();

        $this->assertEquals(500, http_response_code());
        $this->assertContains("X-Error-State: Could not process member signup!", xdebug_get_headers());
    }

    public function testFailsWhenMissingData()
    {
        $body = '{"lastName":"Test","address1":"Teststreet","address2":"Testcity", "email": "unit@test.com", "message": "Hello"}';

        $file = $this->getTemporaryFile($body);
        $fileName = stream_get_meta_data($file)['uri'];

        $mockRequestHandler = new RequestHandler($fileName);

        $mockMailer = $this->createMock(MailConfigurator::class);
        $mockMailer->expects($this->never())->method('configureMail');


        $parser = new MemberParser();
        $service = new MemberService($mockMailer);

        $controller = new MemberController($parser, $service, $mockRequestHandler);

        $_SERVER['REQUEST_METHOD'] = "POST";
        $controller->handle();

        $this->assertEquals(400, http_response_code());
        $this->assertContains("X-Error-State: firstName not found or empty!", xdebug_get_headers());
    }

    private function getTemporaryFile(string $contents)
    {
        $file = tmpfile();
        fwrite($file, $contents);
        fseek($file, 0);
        return $file;
    }
}
