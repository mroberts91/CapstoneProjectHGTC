<?php
namespace Employee;
use Core\_DataEntity;
use Core\Department;
require_once __DIR__.'/_DataEntity.php';

/**
 * Class Employee
 * @package Employee
 * Represents a employee from the Database.
 */
class Employee extends _DataEntity
{
    /**
     * @var int Employee ID
     */
    private $id_Employee;
    /**
     * @var int Department code / Permisson level
     */
    private $id_Department;
    /**
     * @var string Department Name
     */
    private $DepartmentName;
    /**
     * @var string Employee Firstname
     */
    private $Firstname;
    /**
     * @var string Employee Lastname
     */
    private $Lastname;
    /**
     * @var string Employee Address
     */
    private $Address;
    /**
     * @var string Employee City
     */
    private $City;
    /**
     * @var string Employee State
     */
    private $State;
    /**
     * @var string Employee Zip Code
     */
    private $Zip;
    /**
     * @var string Employee Company Email
     */
    private $Email;

    /**
     * Employee constructor.
     */
    public function __construct()
    {
        $this->id_Employee = null;
        $this->id_Department = null;
        $this->DepartmentName = null;
        $this->Firstname = null;
        $this->Lastname = null;
        $this->Address = null;
        $this->City = null;
        $this->State = null;
        $this->Zip = null;
        $this->Email = null;
        parent::__construct();
    }

    public function buildFromArray($array){
        if (is_array($array)){
            $this->id_Employee = $array['id_Employee'];
            $this->id_Department =$array['id_Department'];
            $this->DepartmentName = $array['Name'];
            $this->Firstname = $array['Firstname'];
            $this->Lastname = $array['Lastname'];
            $this->Address = $array['Address'];
            $this->City = $array['City'];
            $this->State = $array['State'];
            $this->Zip = $array['Zip'];
            $this->Email = $array['Email'];
            return true;
        }else{
            $this->IsValid = false;
            return false;
        }
    }

    public function buildFromParameters($id_Employee, $id_Department, $Firstname, $Lastname, $Address, $City, $State, $Zip, $Email, $DepartmentName = null){
        $this->id_Employee = $id_Employee;
        $this->id_Department = $id_Department;
        $this->DepartmentName = $DepartmentName;
        $this->Firstname = $Firstname;
        $this->Lastname = $Lastname;
        $this->Address = $Address;
        $this->City = $City;
        $this->State = $State;
        $this->Zip = $Zip;
        $this->Email = $Email;
    }

    /**
     * @return int
     */
    public function getIdEmployee()
    {
        return $this->id_Employee;
    }

    /**
     * @return int
     */
    public function getIdDepartment(): int
    {
        return $this->id_Department;
    }

    /**
     * @return string
     */
    public function getDepartmentName(): string
    {
        return $this->DepartmentName;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->Firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->Lastname;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->Address;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->City;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->State;
    }

    /**
     * @return string
     */
    public function getZip(): string
    {
        return $this->Zip;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->Email;
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
    public function setIdEmployee(int $id_Employee)
    {
        $this->id_Employee = $id_Employee;
    }

    /**
     * @param int $id_Department
     */
    public function setIdDepartment(int $id_Department)
    {
        $this->id_Department = $id_Department;
    }

    /**
     * @param string $DepartmentName
     */
    public function setDepartmentName(string $DepartmentName)
    {
        $this->DepartmentName = $DepartmentName;
    }

    /**
     * @param string $Firstname
     */
    public function setFirstname(string $Firstname)
    {
        $this->Firstname = $Firstname;
    }

    /**
     * @param string $Lastname
     */
    public function setLastname(string $Lastname)
    {
        $this->Lastname = $Lastname;
    }

    /**
     * @param string $Address
     */
    public function setAddress(string $Address)
    {
        $this->Address = $Address;
    }

    /**
     * @param string $City
     */
    public function setCity(string $City)
    {
        $this->City = $City;
    }

    /**
     * @param string $State
     */
    public function setState(string $State)
    {
        $this->State = $State;
    }

    /**
     * @param string $Zip
     */
    public function setZip(string $Zip)
    {
        $this->Zip = $Zip;
    }

    /**
     * @param string $Email
     */
    public function setEmail(string $Email)
    {
        $this->Email = $Email;
    }



}