<?php

namespace BVZ\Events;

require_once __DIR__ . "/../../vendor/autoload.php";

class EventService
{
    public function __construct(
        private readonly EventRepository $repository = new EventRepository()
    )
    {}

    public function getNextThreeEvents()
    {
        $nextEvents = $this->repository->getNextThreeEvents();
        header('Content-Type: application/json');
        echo(json_encode($nextEvents));
    }
}
