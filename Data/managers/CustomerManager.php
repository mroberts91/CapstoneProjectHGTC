<?php
namespace Customer;
use Core\_DataManager;
use Core\PasswordUtils;
use \Exception;
require_once __DIR__."/_DataManager.php";
require_once __DIR__."/../common/PasswordUtils.php";
require_once __DIR__."/../dto/Customer.php";


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
     * @return bool Returns true if a new customer was created.
     * @throws Exception - Throws an exception if call to stored procedure failed.
     */
    public function createNewCustomer($customer){
        try {
            $isUnique = $this->checkIfEmailIsUnique($customer->getEmail());

            if ($isUnique) {
                $cust = array(
                    $customer->getFirstname(),
                    $customer->getLastname(),
                    $customer->getAddress(),
                    $customer->getCity(),
                    $customer->getState(),
                    $customer->getZip(),
                    $customer->getEmail(),
                    $customer->getPassword(),
                    $customer->getLocation()
                );
                $this->Connection->SQLCallProcedure(
                    "CALL sp_cust_CreateNewCustomer(?,?,?,?,?,?,?,?,?)", $cust
                );
                return true;
            }else{
                throw new Exception("An account with that email already exits. <br> Please use a different email.");
            }

        } catch (Exception $e){
            throw $e;
        }
    }

    /**
     * @param $email
     * @return bool - Returns a bool whether a record with that email already exists
     * @throws Exception
     */
    public function checkIfEmailIsUnique($email) : bool{
        $result = $this->Connection->SQLRequest(
            "SELECT * FROM vw_cust_Login WHERE Email = ?",$email
        );
        return (count($result) > 0 )? false : true;
    }

    /**
     * @param Customer $CustomerObj
     * @return bool
     * @throws Exception
     */
    public function updateCustomer($CustomerObj) : bool{
        try{
            $data1 = array($CustomerObj->getIdLocation(), $CustomerObj->getIdCustomer());
            $data2 = array($CustomerObj->getFirstname(), $CustomerObj->getLastname(),
                $CustomerObj->getAddress(), $CustomerObj->getCity(), $CustomerObj->getState(),
                $CustomerObj->getZip(), $CustomerObj->getIdCustomer());

            $this->Connection->SQLNonQuery(
                "UPDATE cust_Customer SET id_Location = ? where id_Customer = ?", $data1);
            $this->Connection->SQLNonQuery(
                "UPDATE cust_CustomerDetail SET Firstname=?, Lastname=?, Address=?, City=?, State=?, Zip=? WHERE id_Customer = ?",
                $data2
            );
            return true;
        } catch (Exception $e){
            echo $e->getTraceAsString();
            echo $e->getMessage();
            throw $e;
        }
    }

    /**
     * @return bool | Customer[]
     * @throws Exception
     */
    public function getAllCustomersForManagment(){
        $result = $this->Connection->SQLRequest("SELECT * FROM vw_cust_Manage");
        $rtn = array();
        if (count($result) > 0 ){
            foreach ($result as $item){
                $cust = new Customer();
                $cust->setIdCustomer($item['id_Customer']);
                $cust->setIdLocation($item['id_Location']);
                $cust->setLocationName($item['PrefLocation']);
                $cust->setFirstname($item['Firstname']);
                $cust->setLastname($item['Lastname']);
                $cust->setAddress($item['Address']);
                $cust->setState($item['State']);
                $cust->setZip($item['Zip']);
                $cust->setEmail($item['Email']);
                array_push($rtn, $cust);
            }
            return $rtn;
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