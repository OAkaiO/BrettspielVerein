<?php

use BVZ\Request\RequestException;
use PHPUnit\Framework\TestCase;
use BVZ\Request\RequestHandler;

require_once __DIR__ . "/../../vendor/autoload.php";

class RequestHandlerTest extends TestCase
{

    public function testRequestUriReturnsExtractedEndOfPath()
    {
        $_SERVER['REQUEST_URI'] = "/api/unit/test";
        $this->assertEquals('/api/unit/test', (new RequestHandler())->getRequestUri());
    }

    public function testExtractPostBodyFailsWhenNotAPost()
    {
        $file = $this->getTemporaryFile("");
        $fileName = stream_get_meta_data($file)['uri'];
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $handler = new RequestHandler($fileName);

        $this->expectException(RequestException::class);
        $this->expectExceptionMessage("Not a POST");
        $handler->extractPostBody();
    }

    public function testExtractPostBodyReturnsFilePassedToHandler()
    {
        $file = $this->getTemporaryFile('{"email":"test@unit.com"}');
        $fileName = stream_get_meta_data($file)['uri'];
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $handler = new RequestHandler($fileName);

        $result = $handler->extractPostBody();
        $this->assertEquals('{"email":"test@unit.com"}', $result);
    }

    private function getTemporaryFile(string $contents)
    {
        $file = tmpfile();
        fwrite($file, $contents);
        fseek($file, 0);
        return $file;
    }
}
