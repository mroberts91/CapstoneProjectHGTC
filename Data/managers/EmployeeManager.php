<?php
namespace Employee;
use Core\_DataManager;
require_once __DIR__."/_DataManager.php";

/**
 * Class EmployeeManager
 * @package Employee
 * TODO Not Implemented yet
 */
class EmployeeManager extends _DataManager
{
    public function __construct($Connection)
    {
        parent::__construct($Connection);
    }
}