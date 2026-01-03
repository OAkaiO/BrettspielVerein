<?php

namespace BVZ\Request;

require_once __DIR__ . "/../../vendor/autoload.php";

class RequestFactory {

    function __construct(private string $inputFile = "php://input")
    {}

    private function getRequestUri(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    private function extractPostBody(): object 
    {
        $rawBody = file_get_contents($this->inputFile);
        $parsed = json_decode($rawBody);
        if ($parsed === null)
        {
            throw new RequestException("Body not valid JSON!");
        }
        return $parsed;
    }

    public function getRequest()
    {
        $uri = $this->getRequestUri();
        switch ($_SERVER['REQUEST_METHOD'])
        {
            case 'GET':
                return new GetRequest($uri);
            case 'POST':
                return new PostRequest($uri, $this->extractPostBody());
        }
    }
}
