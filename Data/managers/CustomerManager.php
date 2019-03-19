<?php
namespace Customer;
use Core\_DataManager;
use Customer\Customer;
use \Exception;
require_once __DIR__."/_DataManager.php";

class CustomerManager extends _DataManager
{
    public function __construct($Connection)
    {
        parent::__construct($Connection);
    }

    /**
     * @param int $id Customer ID
     * @return Customer
     * @throws Exception
     */
    public function getCustomerById($id){
        $result = $this->Connection->SQLRequest(
            "SELECT * FROM vw_cust_CustomerFull WHERE id_Customer = ?", $id
        );
        if (count($result) > 0) {
            $customerArray = $this->buildReturnArrayFromResultSet($result);
            return $customerArray[0];
        } else{
            throw new Exception("EMPTY RESULT SET - The result set was empty.", 21);
        }

    }

    /**
     * @param string $email Customer email address
     * @return Customer
     * @throws Exception
     */
    public function getCustomerByEmail($email){
        $result = $this->Connection->SQLRequest(
            "SELECT * FROM vw_cust_CustomerFull WHERE Email = ?", $email
        );
        if (count($result) > 0) {
            $customerArray = $this->buildReturnArrayFromResultSet($result);
            return $customerArray[0];
        } else{
            throw new Exception("EMPTY RESULT SET - The result set was empty.", 21);
        }
    }

    public function checkCustomerLogin($email, $password){
        $result = $this->Connection->SQLRequest(
            "SELECT * FROM vw_cust_Login WHERE Email = ?", $email
        );
        if (count($result) > 0 ){
            $customerArray = $this->buildReturnArrayFromResultSet($result);
            $customer = $customerArray[0];
            if (password_verify("", "")){
                // TODO ADD Passowrd to Customer DTO Obj
            }
        } else{
            return false;
        }
    }

    /**
     * @param array $ResultSet - The result of a SQL Query.
     * @return Customer[] - Returns an array of Customer Objects
     * @throws Exception - Throws if the DTO object cannot be initialized from the data provided.
     */
    private function buildReturnArrayFromResultSet($ResultSet){
        $rtn = array();
        foreach ($ResultSet as $item){
            $c = new Customer();
            if (!$c->buildFromArray($item)) {
                throw new Exception("DB RESULT PROPAGATION ERROR - 
                    Menu Item failed to initalize fields, OBJECT:  " . print_r($item),
                    999
                );
            }
            array_push($rtn, $c);
        }
        return $rtn;
    }

    private function buildLoginCheckCustomer($ResultSet){

    }
}