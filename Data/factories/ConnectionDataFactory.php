<?php
require_once __DIR__."/../db/ConnectionData.php";
class ConnectionDataFactory
{
    public static function Create(){
        return new ConnectionData();
    }
}