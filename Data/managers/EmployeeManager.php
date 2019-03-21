<?php
namespace Employee;
use Core\_DataManager;
use Employee\NewEmployee;
use \Exception;
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

    /**
     * @param NewEmployee $employee
     * @throws \Exception
     */
    public function createNewEmployee($employee){
        try {
            $array = array(
                $employee->getIdDepartment(),
                $employee->getFirstname(),
                $employee->getLastname(),
                $employee->getAddress(),
                $employee->getCity(),
                $employee->getState(),
                $employee->getZip(),
                $employee->getEmail(),
                $employee->getPassword()
            );
            $this->Connection->SQLCallProcedure(
                "CALL sp_emp_CreateNewEmployee(?,?,?,?,?,?,?,?,?)", $array
            );
        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}