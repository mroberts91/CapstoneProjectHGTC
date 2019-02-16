<?php
require_once __DIR__.'/_DataEntity.php';

class Employee extends _DataEntity
{
    // Temp fields
    private $id_Emp;
    private $Firstname;
    private $Lastname;
    private $Department;

    public function __construct()
    {
        $this->id_Emp = null;
        $this->Firstname = null;
        $this->Lastname = null;
        $this->Department = null;
        parent::__construct();
    }


}