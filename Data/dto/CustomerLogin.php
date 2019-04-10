<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 3/20/2019
 * Time: 9:42 PM
 */

namespace Customer;
use Core\_DataEntity;
require_once __DIR__."/_DataEntity.php";

/**
 * Class CustomerLogin
 * @package Customer
 */
class CustomerLogin extends _DataEntity
{
    /**
     * @var int Customer ID
     */
    private $id_Customer;
    /**
     * @var Customer Email
     */
    private $Email;
    /**
     * @var string Customer Hashed Password
     */
    private $Password;
    /**
     * @var bool Is the Customer Password Temporary.
     */
    private $IsTempPassword;

    /**
     * CustomerLogin constructor.
     */
    public function __construct()
    {
        $this->id_Customer = null;
        $this->Email = null;
        $this->Password = null;
        $this->IsTempPassword = null;
        parent::__construct();
    }

    /**
     * @param $array
     * @return bool
     * @throws \Exception
     */
    public function buildFromArray($array){
        $this->id_Customer = $array['id_Customer'];
        $this->Email = $array['Email'];
        $this->Password = $array['Password'];
        $this->IsTempPassword = $array['isTempPassword'] == 1? true: false;
        return true;
    }

    /**
     * @param $id_Customer
     * @param $Email
     * @param $Password
     * @param $IsTempPass
     */
    public function buildFromParams($id_Customer, $Email, $Password, $IsTempPass){
        $this->id_Customer = $id_Customer;
        $this->Email = $Email;
        $this->Password = $Password;
        $this->IsTempPassword = $IsTempPass;
    }

    /**
     * @return int
     */
    public function getIdCustomer(): int
    {
        return $this->id_Customer;
    }

    /**
     * @return Customer
     */
    public function getEmail(): Customer
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
     * @param int $id_Customer
     */
    public function setIdCustomer(int $id_Customer): void
    {
        $this->id_Customer = $id_Customer;
    }

    /**
     * @param Customer $Email
     */
    public function setEmail(Customer $Email): void
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