<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

use BVZ\Newsletter\NewsletterParser;
use BVZ\ParserException;

require_once __DIR__ . "/../../vendor/autoload.php";

class NewsletterParserTest extends TestCase
{
    public static function invalidBodyProvider() : array {
        return array(
            [""],
            ["{hallo}"],
            ["{'wrong': 'quotes'}"],
            ['{"incomplete": "Wow"']
        );
    }

    #[DataProvider("invalidBodyProvider")]
    public function testFailsWhenInputIsNotValidJSON(string $invalidBody) : void 
    {
        $this->expectException(ParserException::class);
        $this->expectExceptionMessage("Body not valid JSON!");
        (new NewsletterParser())->parse($invalidBody);
    }

    public function testFailsWhenInputDoesNotHaveAnEmailField()
    {
        $this->expectException(ParserException::class);
        $this->expectExceptionMessage("Email address not found!");
        (new NewsletterParser())->parse('{"something": "unit@test.com"}');
    }

    public function testFailsWhenInputDoesNotContainAValidEmail()
    {
        $this->expectException(ParserException::class);
        $this->expectExceptionMessage("Email address not valid!");
        (new NewsletterParser())->parse('{"email": "unittest.com"}');
    }

    public function testReturnsEmailWhenContainedInBody()
    {
        $result = (new NewsletterParser())->parse('{"email": "unit@test.com"}');
        $this->assertEquals("unit@test.com", $result);
    }
}
