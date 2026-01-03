<?php

use BVZ\Member\MemberController;
use BVZ\Newsletter\NewsletterController;
use BVZ\Question\QuestionController;
use BVZ\Request\RequestHandler;

require_once __DIR__ . "/../vendor/autoload.php";

// Makes errors not output an error text, but instead return 500 when set to false
ini_set('display_errors', 1);

$handler = new RequestHandler();
$uri = $handler->getRequestUri();
switch ($uri)
{
    case '/api/newsletter':
        (new NewsletterController())->handle();
        return;
    case '/api/question':
        (new QuestionController())->handle();
        return;
    case '/api/member':
        (new MemberController())->handle();
        return;
    default:
        http_response_code(404);
        return;
}
