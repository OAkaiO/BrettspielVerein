<?php

namespace BVZ\Request;

require_once __DIR__ . "/../../vendor/autoload.php";

class RequestHandler {

    function __construct(private string $inputFile = "php://input")
    {}

    public function getRequestUri(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public function extractPostBody(): object 
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new RequestException("Not a POST");
        }
        $rawBody = file_get_contents($this->inputFile);
        $parsed = json_decode($rawBody);
        if ($parsed === null)
        {
            throw new RequestException("Body not valid JSON!");
        }
        return $parsed;
    }
}
