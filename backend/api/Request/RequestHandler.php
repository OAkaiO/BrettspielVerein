<?php

namespace BVZ\Request;

require_once __DIR__ . "/../../vendor/autoload.php";

abstract class RequestHandler
{
    public function handle(Request $request)
    {
        $request->trigger($this);
    }

    abstract function handleGet(GetRequest $get);
    abstract function handlePost(PostRequest $post);
}
