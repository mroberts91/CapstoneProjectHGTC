<?php
namespace Employee;
use Core\_DataEntity;
require_once __DIR__.'/_DataEntity.php';

/**
 * Class Employee
 * @package Employee
 * Represents a employee from the Database.
 */
class Employee extends _DataEntity
{
    // Temp fields
    private $id_Emp;
    private $Firstname;
    private $Lastname;
    private $Department;

    /**
     * Employee constructor.
     *
     */
    public function __construct()
    {
        $this->id_Emp = null;
        $this->Firstname = null;
        $this->Lastname = null;
        $this->Department = null;
        parent::__construct();
    }


}