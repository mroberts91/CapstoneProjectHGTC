<?php


namespace Schedule;
use Core\_DataManager;
require_once __DIR__."/../managers/_DataManager.php";


class ScheduleManager extends _DataManager
{

    /**
     * ScheduleManager constructor.
     * @param $Connection
     * @throws \Exception
     */
    public function __construct($Connection)
    {
        parent::__construct($Connection);
    }

    /**
     * @return ReserauntSchedule
     * @throws \Exception
     */
    public function getRestrauntSchedule(){
        date_default_timezone_set("America/New_York");
        $result = $this->Connection->SQLRequest(
            "SELECT OpenTime, CloseTime FROM core_Schedule WHERE id_Schedule = 1"
        );
        $curDate = date('Y-m-d');
        $OpenTime = $curDate." ".$result[0]['OpenTime'];
        $CloseTime = $result[0]['CloseTime'];
        $DaysClosed = array((int)$result[0]['DaysClosed']);
        return new ReserauntSchedule($OpenTime, $CloseTime, $DaysClosed);
    }
}