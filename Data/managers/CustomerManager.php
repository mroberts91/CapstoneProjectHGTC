<?php
namespace Customer;
use Core\_DataManager;
use Core\PasswordUtils;
use \Exception;
require_once __DIR__."/_DataManager.php";
require_once __DIR__."/../common/PasswordUtils.php";


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

    /**
     * @param $email
     * @param $password
     * @return bool | CustomerLogin Returns a CustomerLogin Object or else false if the credentials don't validate.
     * @throws Exception
     */
    public function checkCustomerLogin($email, $password){
        $result = $this->Connection->SQLRequest(
            "SELECT * FROM vw_cust_Login WHERE Email = ?", $email
        );
        if (count($result) > 0 ){
            $customerLoginArray = $this->buildCustomerLoginArrayFromResultSet($result);
            $customer = $customerLoginArray[0];
            return (PasswordUtils::verifyPassword($password, $customer->getPassword()))? $customer : false;
        } else{
            return false;
        }
    }

    /**
     * @param NewCustomer $customer - Customer DTO Object
     * @throws Exception - Throws an exception if call to stored procedure failed.
     */
    public function createNewCustomer($customer){
        try {
            $array = array(
                $customer->getFirstname(),
                $customer->getLastname(),
                $customer->getAddress(),
                $customer->getCity(),
                $customer->getState(),
                $customer->getZip(),
                $customer->getEmail(),
                $customer->getPassword()
            );
            $this->Connection->SQLCallProcedure(
                "CALL sp_cust_CreateNewCustomer(?,?,?,?,?,?,?,?)", $array
            );
        } catch (Exception $e){
            throw new Exception($e->getMessage());
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
                    Menu Item failed to initialize fields, OBJECT:  " . print_r($item),
                    999
                );
            }
            array_push($rtn, $c);
        }
        return $rtn;
    }

    /**
     * @param $ResultSet
     * @return CustomerLogin[]
     * @throws Exception
     */
    private function buildCustomerLoginArrayFromResultSet($ResultSet){
        $rtn = array();
        foreach ($ResultSet as $item){
            $c = new CustomerLogin();
            if (!$c->buildFromArray($item)) {
                throw new Exception("DB RESULT PROPAGATION ERROR - 
                    Menu Item failed to initialize fields, OBJECT:  " . print_r($item),
                    999
                );
            }
            array_push($rtn, $c);
        }
        return $rtn;
    }

}