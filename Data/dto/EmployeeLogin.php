<?php
namespace Employee;
use Core\_DataEntity;
require_once __DIR__."/../dto/_DataEntity.php";

/**
 * Class EmployeeLogin
 * @package Employee
 */
class EmployeeLogin extends _DataEntity
{
    /**
     * @var int Employee ID
     */
    private $id_Employee;
    /**
     * @var Employee Email
     */
    private $Email;
    /**
     * @var string Employee Hashed Password
     */
    private $Password;
    /**
     * @var bool Is the Employee Password Temporary.
     */
    private $IsTempPassword;

    /**
     * EmployeeLogin constructor.
     */
    public function __construct()
    {
        $this->id_Employee = null;
        $this->Email = null;
        $this->Password = null;
        $this->IsTempPassword = null;
        parent::__construct();
    }

    /**
     * @param $array
     */
    public function buildFromArray($array){
        $this->id_Employee = $array['id_Employee'];
        $this->Email = $array['Email'];
        $this->Password = $array['Password'];
        $this->IsTempPassword = $array['isTempPassword'] == 1? true: false;
    }

    /**
     * @param $id_Employee
     * @param $Email
     * @param $Password
     * @param $IsTempPass
     */
    public function buildFromParams($id_Employee, $Email, $Password, $IsTempPass){
        $this->id_Employee = $id_Employee;
        $this->Email = $Email;
        $this->Password = $Password;
        $this->IsTempPassword = $IsTempPass;
    }

    /**
     * @return int
     */
    public function getIdEmployee(): int
    {
        return $this->id_Employee;
    }

    /**
     * @return Employee
     */
    public function getEmail(): Employee
    {
        return $this->Email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->Password;
    }

    /**
     * @return bool
     */
    public function isTempPassword(): bool
    {
        return $this->IsTempPassword;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->IsValid;
    }

    /**
     * @param int $id_Employee
     */
    public function setIdEmployee(int $id_Employee): void
    {
        $this->id_Employee = $id_Employee;
    }

    /**
     * @param Employee $Email
     */
    public function setEmail(Employee $Email): void
    {
        $this->Email = $Email;
    }

    /**
     * @param string $Password
     */
    public function setPassword(string $Password): void
    {
        $this->Password = $Password;
    }

    /**
     * @param bool $IsTempPassword
     */
    public function setIsTempPassword(bool $IsTempPassword): void
    {
        $this->IsTempPassword = $IsTempPassword;
    }

    /**
     * @param bool $IsValid
     */
    public function setIsValid(bool $IsValid): void
    {
        $this->IsValid = $IsValid;
    }
}