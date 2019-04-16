<?php

namespace Employee;
use Core\_DataEntity;
use Core\PasswordUtils;
require_once __DIR__."/../dto/_DataEntity.php";
require_once __DIR__."/../common/PasswordUtils.php";

class NewEmployee extends _DataEntity
{
    const TempPassword = "NewEmp1!";
    /**
     * @var int Employee Department
     */
    private $id_Department;
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
     * @var string Password.
     */
    private $Password;

    /**
     * NewEmployee constructor.
     * @param int $id_Department
     * @param string $Lastname
     * @param string $Email
     * @param string $Firstname
     * @param string $Address
     * @param string $City
     * @param string $State
     * @param string $Zip
     */
    public function __construct(int $id_Department, string $Lastname, string $Email, string $Password, string $Firstname = null, string $Address = null, string $City = null, string $State = null, string $Zip = null)
    {
        $this->id_Department = $id_Department;
        $this->Firstname = $Firstname;
        $this->Lastname = $Lastname;
        $this->Address = $Address;
        $this->City = $City;
        $this->State = $State;
        $this->Zip = $Zip;
        $this->Email = $Email;
        $this->Password = PasswordUtils::generateHash($Password);

        parent::__construct();
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->Firstname != null ? $this->Firstname : "";
    }

    /**
     * @param string $Firstname
     */
    public function setFirstname(string $Firstname): void
    {
        $this->Firstname = $Firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->Lastname;
    }

    /**
     * @param string $Lastname
     */
    public function setLastname(string $Lastname): void
    {
        $this->Lastname = $Lastname;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->Address != null ? $this->Address : "";
    }

    /**
     * @param string $Address
     */
    public function setAddress(string $Address): void
    {
        $this->Address = $Address;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->City != null ? $this->City : "";
    }

    /**
     * @param string $City
     */
    public function setCity(string $City): void
    {
        $this->City = $City;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->State != null ? $this->State : "";
    }

    /**
     * @param string $State
     */
    public function setState(string $State): void
    {
        $this->State = $State;
    }

    /**
     * @return string
     */
    public function getZip(): string
    {
        return $this->Zip != null ? $this->Zip : "";
    }

    /**
     * @param string $Zip
     */
    public function setZip(string $Zip): void
    {
        $this->Zip = $Zip;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->Email;
    }

    /**
     * @param string $Email
     */
    public function setEmail(string $Email): void
    {
        $this->Email = $Email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->Password;
    }

    /**
     * @param string $Password
     */
    public function setPassword(string $Password): void
    {
        $this->Password = $Password;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->IsValid;
    }

    /**
     * @param bool $IsValid
     */
    public function setIsValid(bool $IsValid): void
    {
        $this->IsValid = $IsValid;
    }

    /**
     * @return int
     */
    public function getIdDepartment(): int
    {
        return $this->id_Department;
    }

    /**
     * @param int $id_Department
     */
    public function setIdDepartment(int $id_Department): void
    {
        $this->id_Department = $id_Department;
    }



}