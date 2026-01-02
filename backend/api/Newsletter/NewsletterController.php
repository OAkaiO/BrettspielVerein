<?php

namespace BVZ\Newsletter;

use BVZ\Request\RequestException;
use BVZ\Request\RequestHandler;

require_once __DIR__ . "/../../vendor/autoload.php";

class NewsletterController {

    function __construct(private NewsletterParser $parser = new NewsletterParser(),
        private NewsletterService $service = new NewsletterService(),
        private RequestHandler $request_handler = new RequestHandler())
    {}

    public function handle()
    {
        // for now, we only have one endpoint, so we just call it, otherwise there would 
        // have to be some differentiation logic here
        try {
            $this->subscribe($this->request_handler->extractPostBody());
        }
        catch (RequestException $e)
        {
            $message = $e->getMessage();
            header("X-Error-State: $message");
            http_response_code(405);
            return;
        }
    }

    private function subscribe(object $body)
    {
        $parsed = $this->parser->parse($body);
        if (empty($parsed->errors))
        {
            $this->service->subscribe($parsed);
            return;
        }
        else
        {
            foreach($parsed->errors as $error)
            {
                header("X-Error-State: $error", false);
            }
            http_response_code(400);
            return;
        }
    }
}
