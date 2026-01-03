<?php

use BVZ\Member\MemberController;
use BVZ\Newsletter\NewsletterController;
use BVZ\Question\QuestionController;
use BVZ\Request\RequestException;
use BVZ\Request\RequestFactory;

require_once __DIR__ . "/../vendor/autoload.php";

// Makes errors not output an error text, but instead return 500 when set to false
ini_set('display_errors', 1);

try {
    $request = (new RequestFactory())->getRequest();
}
catch (RequestException $e)
{
    $message = $e->getMessage();
    header("X-Error-State: $message");
    http_response_code(405);
    return;
}

switch ($request->url)
{
    case '/api/newsletter':
        (new NewsletterController())->handle($request);
        return;
    case '/api/question':
        (new QuestionController())->handle($request);
        return;
    case '/api/member':
        (new MemberController())->handle($request);
        return;
    default:
        http_response_code(404);
        return;
}
