<?php

// This file is a temporary source of events. Eventually we will fetch the data from DB here in this file

header('Content-Type: application/json');
$march = array(
    "epoch" => 1712354399,
    "day" => "06",
    "month" => "Apr 2024",
    "name" => "Brettspielabend im Spittelhof",
    "location" => "Strengelbacherstrasse 29, 4800 Zofingen",
    "time" => "19:30",
    "price" => "5.-"
);

$april = array(
    "epoch" => 1714168799,
    "day" => "26",
    "month" => "Apr 2024",
    "name" => "Brettspielabend im Spittelhof",
    "location" => "Strengelbacherstrasse 29, 4800 Zofingen",
    "time" => "19:30",
    "price" => "5.-"
);

$may = array(
    "epoch" => 1717192799,
    "day" => "31",
    "month" => "Mai 2024",
    "name" => "Brettspielabend im Spittelhof",
    "location" => "Strengelbacherstrasse 29, 4800 Zofingen",
    "time" => "19:30",
    "price" => "5.-"
);

$june = array(
    "epoch" => 1719611999,
    "day" => "28",
    "month" => "Jun 2024",
    "name" => "Brettspielabend im Spittelhof",
    "location" => "Strengelbacherstrasse 29, 4800 Zofingen",
    "time" => "19:30",
    "price" => "5.-"
);

$july = array(
    "epoch" => 1722031199,
    "day" => "26",
    "month" => "Jul 2024",
    "name" => "Brettspielabend im Spittelhof",
    "location" => "Strengelbacherstrasse 29, 4800 Zofingen",
    "time" => "19:30",
    "price" => "5.-"
);

$august = array(
    "epoch" => 1725055199,
    "day" => "30",
    "month" => "Aug 2024",
    "name" => "Brettspielabend im Spittelhof",
    "location" => "Strengelbacherstrasse 29, 4800 Zofingen",
    "time" => "19:30",
    "price" => "5.-"
);

$september = array(
    "epoch" => 1727474399,
    "day" => "27",
    "month" => "Sep 2024",
    "name" => "Brettspielabend im Spittelhof",
    "location" => "Strengelbacherstrasse 29, 4800 Zofingen",
    "time" => "19:30",
    "price" => "5.-"
);

$october = array(
    "epoch" => 1729893599,
    "day" => "25",
    "month" => "Okt 2024",
    "name" => "Brettspielabend im Spittelhof",
    "location" => "Strengelbacherstrasse 29, 4800 Zofingen",
    "time" => "19:30",
    "price" => "5.-"
);

$november = array(
    "epoch" => 1732921199,
    "day" => "29",
    "month" => "Nov 2024",
    "name" => "Brettspielabend im Spittelhof",
    "location" => "Strengelbacherstrasse 29, 4800 Zofingen",
    "time" => "19:30",
    "price" => "5.-"
);

$december = array(
    "epoch" => 1735340399,
    "day" => "27",
    "month" => "Dez 2024",
    "name" => "Brettspielabend im Spittelhof",
    "location" => "Strengelbacherstrasse 29, 4800 Zofingen",
    "time" => "19:30",
    "price" => "5.-"
);

$data = array($march, $april, $may, $june, $july, $august, $september, $october, $november, $december);
echo (json_encode($data));
