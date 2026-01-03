<?php

namespace BVZ\Request;

require_once __DIR__ . "/../../vendor/autoload.php";

abstract class Request
{
    public function __construct(public readonly string $url)
    {}
}
