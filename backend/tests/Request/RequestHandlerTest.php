<?php

use BVZ\Request\Request;
use BVZ\Request\RequestHandler;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../vendor/autoload.php';

class RequestHandlerTest extends TestCase
{
    public function testHandleTriggersRequest() {
        $handler = new class extends RequestHandler {
            function handleGet($dummy){}
            function handlePost($dummy){}
        };

        $mockRequest = $this->createMock(Request::class);
        $mockRequest->expects($this->once())->method('trigger')->with($handler);

        $handler->handle($mockRequest);
    }
}
