<?php
namespace Customer;
use Core\_DataEntity;
require_once __DIR__.'/_DataEntity.php';

/**
 * Class Customer
 * @package Customer
 * Represents a employee from the Database.
 */
class Customer extends _DataEntity
{
    /**
     * @var int Customer ID
     */
    private $id_Customer;
    /**
     * @var int Department code / Permisson level
     */
    private $id_Department;
    /**
     * @var string Department Name
     */
    private $DepartmentName;
    /**
     * @var string Customer Firstname
     */
    private $Firstname;
    /**
     * @var string Customer Lastname
     */
    private $Lastname;
    /**
     * @var string Customer Address
     */
    private $Address;
    /**
     * @var string Customer City
     */
    private $City;
    /**
     * @var string Customer State
     */
    private $State;
    /**
     * @var string Customer Zip Code
     */
    private $Zip;
    /**
     * @var string Customer Company Email
     */
    private $Email;
    /**
     * @var string Password.
     */
    private $Password;

    /**
     * Customer constructor.
     */
    public function __construct()
    {
        $this->id_Customer = null;
        $this->id_Department = null;
        $this->DepartmentName = null;
        $this->Firstname = null;
        $this->Lastname = null;
        $this->Address = null;
        $this->City = null;
        $this->State = null;
        $this->Zip = null;
        $this->Email = null;
        $this->Password = null;
        parent::__construct();
    }

    /**
     * @param $array
     * @return bool
     */
    public function buildFromArray($array)
    {
        if (is_array($array)) {
            $this->id_Customer = $array['id_Customer'];
            $this->id_Department = $array['id_Department'];
            $this->DepartmentName = $array['Name'];
            $this->Firstname = $array['Firstname'];
            $this->Lastname = $array['Lastname'];
            $this->Address = $array['Address'];
            $this->City = $array['City'];
            $this->State = $array['State'];
            $this->Zip = $array['Zip'];
            $this->Email = $array['Email'];
            $this->Password = $array['Password'];
            return true;
        } else {
            $this->IsValid = false;
            return false;
        }

    }

    /**
     * @param $array
     * @return bool
     */
    public function buildForLogin($array){
        if (is_array($array)) {
            $this->id_Customer = $array['id_Customer'];

            $this->Email = $array['Email'];
            return true;
        } else {
            $this->IsValid = false;
            return false;
        }
    }

    /**
     * @param $id_Customer
     * @param $id_Department
     * @param $DepartmentName
     * @param $Firstname
     * @param $Lastname
     * @param $Address
     * @param $City
     * @param $State
     * @param $Zip
     * @param $Email
     * @param $Password
     */
    public function buildFromParameters($id_Customer, $id_Department, $DepartmentName, $Firstname, $Lastname, $Address, $City, $State, $Zip, $Email, $Password){
        $this->id_Customer = $id_Customer;
        $this->id_Department = $id_Department;
        $this->DepartmentName = $DepartmentName;
        $this->Firstname = $Firstname;
        $this->Lastname = $Lastname;
        $this->Address = $Address;
        $this->City = $City;
        $this->State = $State;
        $this->Zip = $Zip;
        $this->Email = $Email;
        $this->Password = $Password;
    }

    /**
     * @return int
     */
    public function getIdCustomer(): int
    {
        return $this->id_Customer;
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
     * @return string
     */
    public function getPassword(): string
    {
        return $this->Password;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->IsValid;
    }

    /**
     * @return array
     */
    public function getAsArray(): array
    {
        return array(
            $this->Firstname,
            $this->Lastname,
            $this->Address,
            $this->City,
            $this->State,
            $this->Zip,
            $this->Email,
            $this->Password
        );
    }

    /**
     * @param int $id_Customer
     */
    public function setIdCustomer(int $id_Customer): void
    {
        $this->id_Customer = $id_Customer;
    }

    /**
     * @param int $id_Department
     */
    public function setIdDepartment(int $id_Department): void
    {
        $this->id_Department = $id_Department;
    }

    /**
     * @param string $DepartmentName
     */
    public function setDepartmentName(string $DepartmentName): void
    {
        $this->DepartmentName = $DepartmentName;
    }

    /**
     * @param string $Firstname
     */
    public function setFirstname(string $Firstname): void
    {
        $this->Firstname = $Firstname;
    }

    /**
     * @param string $Lastname
     */
    public function setLastname(string $Lastname): void
    {
        $this->Lastname = $Lastname;
    }

    /**
     * @param string $Address
     */
    public function setAddress(string $Address): void
    {
        $this->Address = $Address;
    }

    /**
     * @param string $City
     */
    public function setCity(string $City): void
    {
        $this->City = $City;
    }

    /**
     * @param string $State
     */
    public function setState(string $State): void
    {
        $this->State = $State;
    }

    /**
     * @param string $Zip
     */
    public function setZip(string $Zip): void
    {
        $this->Zip = $Zip;
    }

    /**
     * @param string $Email
     */
    public function setEmail(string $Email): void
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



}