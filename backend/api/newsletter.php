<?php

use BVZ\Newsletter\NewsletterService;

require_once __DIR__ . "/../vendor/autoload.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('X-Error-State: Not a POST');
    http_response_code(405);
    return;
}

$postBody = file_get_contents("php://input");

(new NewsletterService())->subscribe($postBody);
