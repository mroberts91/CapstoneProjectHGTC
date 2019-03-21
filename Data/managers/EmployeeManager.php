<?php
namespace Employee;
use Core\_DataManager;
use Core\PasswordUtils;
use \Exception;
require_once __DIR__."/_DataManager.php";
require_once __DIR__."/../dto/EmployeeLogin.php";
require_once __DIR__."/../common/PasswordUtils.php";

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
     * @param $email
     * @param $password
     * @return bool | EmployeeLogin
     * @throws Exception
     */
    public function checkEmployeeLogin($email, $password){
        $result = $this->Connection->SQLRequest(
            "SELECT * FROM vw_emp_Login WHERE Email = ?", $email
        );
        if (count($result) > 0 ){
            $empLoginArray = $this->buildEmpLoginArrayFromResultSet($result);
            $emp = $empLoginArray[0];
            return (PasswordUtils::verifyPassword($password, $emp->getPassword()))? $emp : false;
        } else{
            return false;
        }
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

    /**
     * @param $ResultSet - The result set from a SQL query
     * @return EmployeeLogin[]
     * @throws Exception
     */
    private function buildEmpLoginArrayFromResultSet($ResultSet){
        $rtn = array();
        foreach ($ResultSet as $item){
            $emp = new EmployeeLogin();
            if (!$emp->buildFromArray($item)) {
                throw new Exception("DB RESULT PROPAGATION ERROR - 
                    Menu Item failed to initialize fields, OBJECT:  " . print_r($item),
                    999
                );
            }
            array_push($rtn, $emp);
        }
        return $rtn;
    }
}