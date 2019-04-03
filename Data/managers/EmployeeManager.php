<?php
namespace Employee;
use Core\_DataManager;
use Core\PasswordUtils;
use \Exception;
require_once __DIR__."/_DataManager.php";
require_once __DIR__."/../dto/EmployeeLogin.php";
require_once __DIR__."/../dto/NewEmployee.php";
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
     * @return bool
     * @throws \Exception
     */
    public function createNewEmployee($employee){
        try {
            if ($this->checkIfEmailIsUnique($employee->getEmail())) {
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
                return true;
            } else{
                throw new Exception("An account with that email already exits. <br> Please use a different email.");
            }
        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return bool | Employee - Returns and Employee Object or a false
     * @throws Exception
     */
    public function getFullEmployeeById($id){
        $result = $this->Connection->SQLRequest(
            "SELECT * FROM vw_emp_EmployeeFull WHERE id_Employee = ?",$id
        );
        if (count($result) > 0){
            $empArray = $this->buildFullEmpArrayFromResultSet($result);
            return $empArray[0];
        } else{
            return false;
        }

    }

    /**
     * @param $email
     * @return bool - Returns a bool whether a record with that email already exists
     * @throws Exception
     */
    public function checkIfEmailIsUnique($email){
        $result = $this->Connection->SQLRequest(
            "SELECT * FROM vw_emp_Login WHERE Email = ?",$email
        );
        return (count($result) > 0 )? false : true;
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

    /**
     * @param $ResultSet
     * @return array
     * @throws Exception
     */
    private function buildFullEmpArrayFromResultSet($ResultSet){
        $rtn = array();
        foreach ($ResultSet as $item){
            $emp = new Employee();
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