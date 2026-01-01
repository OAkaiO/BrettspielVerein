<?php
use PHPUnit\Framework\TestCase;

class newsletterTest extends TestCase
{
    public function testFailsWhenMethodNotPost() : void 
    {
        ob_start();
        include __DIR__ . "/../api/newsletter.php";
        ob_get_clean();
        $this->assertEquals(405, http_response_code());
        $this->assertContains('X-Error-State: Not a POST', xdebug_get_headers());
    }
}
