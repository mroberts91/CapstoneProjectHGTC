<?php
require_once __DIR__."/_DataManager.php";
class OrderManager extends _DataManager
{
    public function __construct($Connection)
    {
        parent::__construct($Connection);
    }
}