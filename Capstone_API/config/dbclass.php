<?php
class DBClass {

    private $host = "http://mrober23.istwebclass.org";
    private $username = "mrober23_michael";
    private $password = "password";
    private $database = "mrober23_php";

    public $connection;

    // get the database connection
    public function getConnection(){

        $this->connection = null;

        try{
            $this->connection = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
            $this->connection->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Error: " . $exception->getMessage();
        }

        return $this->connection;
    }
}
?>