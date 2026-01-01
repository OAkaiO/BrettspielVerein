<?php

use BVZ\Newsletter\NewsletterController;
use BVZ\Newsletter\NewsletterService;
use BVZ\Request\RequestException;
use BVZ\Request\RequestHandler;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../../vendor/autoload.php";

class NewsletterControllerTest extends TestCase
{
    public function testReturnsWithoutCallingServiceIfRequestHandlerThrows()
    {
        $mockService = $this->createMock(NewsletterService::class);
        $mockService->expects($this->never())->method('subscribe');
        $mockRequestHandler = $this->createStub(RequestHandler::class);

        $mockRequestHandler->method('extractPostBody')
            ->willThrowException(new RequestException("Dummy"));

        $controller = new NewsletterController($mockService, $mockRequestHandler);

        $controller->handle();

        $this->assertEquals(405, http_response_code());
        $this->assertContains('X-Error-State: Dummy', xdebug_get_headers());
    }

    public function testHandleCallsServiceWithResultFromRequestHandler()
    {
        $body = "Unit Test";
        $mockService = $this->createMock(NewsletterService::class);
        $mockService->expects($this->once())->method('subscribe')->with($body);
        $mockRequestHandler = $this->createStub(RequestHandler::class);
        $mockRequestHandler->method('extractPostBody')->willReturn($body);

        $controller = new NewsletterController($mockService, $mockRequestHandler);

        $controller->handle();
    }
}
