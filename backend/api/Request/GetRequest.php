<?php

namespace BVZ\Request;

require_once __DIR__ . "/../../vendor/autoload.php";

class GetRequest extends Request
{
    public function __construct(
        string $url
    )
    {
        parent::__construct($url);
    }
}
