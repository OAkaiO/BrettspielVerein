<?php

use BVZ\Newsletter\NewsletterController;
use BVZ\Request\RequestHandler;

require_once __DIR__ . "/../vendor/autoload.php";

$handler = new RequestHandler();
$uri = $handler->getRequestUri();
switch ($uri)
{
    case '/api/newsletter':
        (new NewsletterController())->handle();
        return;
    default:
        http_response_code(404);
        return;
}
