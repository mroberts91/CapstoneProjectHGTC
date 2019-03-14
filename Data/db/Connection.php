<?php
/** edit hehe  :P*/
namespace Connection;
use \PDO;
use Exception;
require(__DIR__."/../factories/ConnectionDataFactory.php");
class Connection extends PDO
{
    private $statements = array();

    /**
     * Connection constructor.
     * @throws Exception - CONNECTION DATA OBJECT NOT FOUND
     */
    public function __construct()
    {
        $ConnectionData = ConnectionDataFactory::Create();

        if ($ConnectionData === null || !is_a($ConnectionData, "Connection\ExConnectionData")){
            throw new Exception(
                "CONNECTION DATA OBJECT NOT FOUND - PDO Connection requires a ConnectionData Object as a parameter."
            );
        }
        parent::__construct(
            $ConnectionData::$dsn,
            $ConnectionData::$username,
            $ConnectionData::$password,
            $ConnectionData::$pdoOptions
        );
    }

    /**
     * Takes a sql statement and replacement values for question marks placeholders (if there are any) executes the query by a prepared statement and
     * returns the result (if any) as an multidimentional array with the first key the index num in the row of results, the second the name of result column.
     * @param $statement - The query statement
     * @param $values - The replacement values as array for question marks placeholders if there are any. If there is only one then this can be a string
     * @throws Exception
     * @return array|null - Returns the result (if any) as an assoc array with the first key, the index num in the row of results, the second the name of result column and the value.
     */
    public function request($statement, $values = null)
    {
        $result = array();
        $statement = trim($statement);
        if (is_null($values)) {
            $values = array();
        } else if (!is_array($values)) {
            $values = array($values);
        }
        if (substr_count($statement, "?") !== count($values)) {
            throw new Exception(
                "PREPARED STATEMENT - Bind Parameters, ? Count Mismatch : " . $statement
                , 4561);
        }
        // Creating a prepared statment with passed in statement
        if (!isset($this->statements[$statement])) {
            $this->statements[$statement] = $this->prepare($statement);
        }

        // Execute the prepared statment, passed bound values if any, or else and empty array.
        $this->statements[$statement]->execute($values);

        if ($this->statements[$statement]->errorCode() != "00000") {
            $error = $this->statements[$statement]->errorInfo();
            throw new Exception($error[2], (int)$error[0]);
        }
        // Fetct the assoc array and return.
        $result = $this->statements[$statement]->fetchAll();
        return $result;
    }
}