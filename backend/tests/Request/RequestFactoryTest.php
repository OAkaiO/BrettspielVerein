<?php

use BVZ\Request\GetRequest;
use BVZ\Request\PostRequest;
use BVZ\Request\RequestException;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use BVZ\Request\RequestFactory;

require_once __DIR__ . "/../../vendor/autoload.php";

class RequestFactoryTest extends TestCase
{

    public function testGetRequestCreatedSuccessfully()
    {
        $_SERVER['REQUEST_URI'] = "/api/unit/test";
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $request = (new RequestFactory())->getRequest();

        $this->assertInstanceOf(GetRequest::class, $request);
    }

    public static function invalidBodyProvider() : array {
        return array(
            [""],
            ["{hallo}"],
            ["{'wrong': 'quotes'}"],
            ['{"incomplete": "Wow"']
        );
    }

    #[DataProvider("invalidBodyProvider")]
    public function testExtractPostBodyFailsWhenNotValidJson(string $invalidBody)
    {
        $file = $this->getTemporaryFile($invalidBody);
        $fileName = stream_get_meta_data($file)['uri'];
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $factory = new RequestFactory($fileName);

        $this->expectException(RequestException::class);
        $this->expectExceptionMessage("Body not valid JSON!");
        $factory->getRequest();
    }

    public function testExtractPostBodyReturnsFilePassedToHandler()
    {
        $file = $this->getTemporaryFile('{"email":"test@unit.com"}');
        $fileName = stream_get_meta_data($file)['uri'];
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $handler = new RequestFactory($fileName);

        $request = $handler->getRequest();
        $this->assertInstanceOf(PostRequest::class, $request);

        $expectedBody = new stdClass();
        $expectedBody->email = "test@unit.com";
        $this->assertEquals($expectedBody, $request->body);
    }

    private function getTemporaryFile(string $contents)
    {
        $file = tmpfile();
        fwrite($file, $contents);
        fseek($file, 0);
        return $file;
    }
}
