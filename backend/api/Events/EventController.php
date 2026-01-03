<?php

namespace BVZ\Events;

use BVZ\Request\GetRequest;
use BVZ\Request\PostRequest;
use BVZ\Request\RequestHandler;

require_once __DIR__ . "/../../vendor/autoload.php";

class EventController extends RequestHandler {

    function __construct(
        private EventService $service = new EventService()
    )
    {}

    function handleGet(GetRequest $get)
    {
        // We only have one operation for now, therefore we don't do any explicit
        // checks for what to call.
        $this->getNextThreeEvents();
    }

    function handlePost(PostRequest $post)
    {
        http_response_code(405);
        header("X-Error-State: POST not supported", false);
        return;
    }

    private function getNextThreeEvents()
    {
        $this->service->getNextThreeEvents();
    }
}
