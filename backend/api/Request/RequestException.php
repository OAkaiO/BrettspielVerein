<?php

namespace BVZ\Request;

require_once __DIR__ . "/../../vendor/autoload.php";

class RequestException extends \Exception
{

    public function __construct(string $message)
    {
        parent::__construct($message, 0, null);
    }
}
