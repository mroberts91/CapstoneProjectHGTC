<?php
namespace Schedule;
use \DateTime;

class ReserauntSchedule
{
    /**
     */
    private $OpenTime;
    /**
     */
    private $CloseTime;
    /**
     */
    private $CurrentDate;
    /**
     */
    private $CurrentDayOfWeek;
    /**
     *
     */
    private $DaysClosed;

    /**
     * ReserauntSchedule constructor.
     * @param string $OpenTime
     * @param int $CloseTime
     * $@param array $DaysClosed
     */
    public function __construct($OpenTime, $CloseTime, $DaysClosed)
    {
        $this->OpenTime = strtotime($OpenTime);
        $this->CloseTime = $this->OpenTime + (3600 * $CloseTime);
//        $this->OpenTime = ($OpenTime == null)? $OpenTime = date(time()) : date('h:i:s',strtotime($OpenTime));
//        $this->CloseTime = ($CloseTime == null)? $CloseTime = date(time()) : date('h:i:s',strtotime($CloseTime));
        $this->CurrentDate = date(DateTime::ISO8601);
        $this->CurrentDayOfWeek = date('N');
        $this->DaysClosed = $DaysClosed;
    }

    /**
     */
    public function getOpenTime()
    {
        return $this->OpenTime;
    }

    /**
     */
    public function setOpenTime($OpenTime)
    {
        $this->OpenTime = $OpenTime;
    }

    /**
     */
    public function getCloseTime()
    {
        return $this->CloseTime;
    }

    /**
     */
    public function setCloseTime($CloseTime)
    {
        $this->CloseTime = $CloseTime;
    }

    /**
     */
    public function getCurrentDate()
    {
        return $this->CurrentDate;
    }

    /**
     */
    public function setCurrentDate($CurrentDate)
    {
        $this->CurrentDate = $CurrentDate;
    }

    /**
     */
    public function getCurrentDayOfWeek()
    {
        return $this->CurrentDayOfWeek;
    }

    /**
     * @param false|string $CurrentDayOfWeek
     */
    public function setCurrentDayOfWeek($CurrentDayOfWeek)
    {
        $this->CurrentDayOfWeek = $CurrentDayOfWeek;
    }

    public function getCurrentTime(){
        return date("h:i", time());
    }

    /**
     * @return array
     */
    public function getDaysClosed()
    {
        return $this->DaysClosed;
    }

    /**
     * @param mixed $DaysClosed
     */
    public function setDaysClosed($DaysClosed)
    {
        $this->DaysClosed = $DaysClosed;
    }




}