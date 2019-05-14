<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 4/30/2019
 * Time: 12:11 PM
 */

namespace Core;


class DayOfWeek
{
    public static $Monday = 1;
    public static $Tuesday = 2;
    public static $Wednesday = 3;
    public static $Thursday = 4;
    public static $Friday = 5;
    public static $Saturday = 6;
    public static $Sunday = 7;


    public static function openArray(){
        return array(
            DayOfWeek::$Tuesday,
            DayOfWeek::$Wednesday,
            DayOfWeek::$Thursday,
            DayOfWeek::$Friday,
            DayOfWeek::$Saturday,
            DayOfWeek::$Sunday
        );
    }
}