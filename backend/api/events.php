<?php

use BVZ\EventRepository;

require_once __DIR__ . "/../vendor/autoload.php";

$eventRepo = new EventRepository();
$next_events = $eventRepo->getNextThreeEvents();

header('Content-Type: application/json');
echo (json_encode($next_events));


