<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 3/20/2019
 * Time: 10:06 PM
 */

namespace Customer;


use Core\_DataEntity;
use Core\PasswordUtils;
require_once __DIR__."/../dto/_DataEntity.php";
require_once __DIR__."/../common/PasswordUtils.php";

class NewCustomer extends _DataEntity
{
    const TempPassword = "Welcome1!";
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
     * NewCustomer constructor.
     * @param string $Lastname
     * @param string $Email
     * @param string $Firstname
     * @param string $Address
     * @param string $City
     * @param string $State
     * @param string $Zip
     */
    public function __construct( string $Lastname, string $Email, string $Firstname = null, string $Address = null, string $City = null, string $State = null, string $Zip = null)
    {
        $this->Firstname = $Firstname;
        $this->Lastname = $Lastname;
        $this->Address = $Address;
        $this->City = $City;
        $this->State = $State;
        $this->Zip = $Zip;
        $this->Email = $Email;
        $this->Password = PasswordUtils::generateHash(self::TempPassword);
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


}