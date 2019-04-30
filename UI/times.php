<?php

use Connection\Connection;
use Schedule\ReserauntSchedule;
use Schedule\ScheduleManager;

require_once __DIR__."/../Data/dto/ReserauntSchedule.php";
require_once __DIR__."/../Data/managers/ScheduleManager.php";
require_once __DIR__."/../Data/db/Connection.php";


try {
    $conn = new Connection();
    $sm = new ScheduleManager($conn);
    $s = $sm->getRestrauntSchedule();
} catch (Exception $e) {
    die($e->getMessage());
}
echo ("<p>Current Date: ".$s->getCurrentDate()."</p>");
echo ("<p>DoW:  ".$s->getCurrentDayOfWeek()."</p>");
echo ("<p>Now:  ".$s->getCurrentTime()."</p>");
echo ("<p>Open Time:  ".$s->getOpenTime()."</p>");
echo ("<p>Close Time:  ".$s->getCloseTime()."</p>");
