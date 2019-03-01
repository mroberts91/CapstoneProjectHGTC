<?php
namespace Connection;
use PDO;
class ConnectionData
{
    private static $uri = "http://mrober23.istwebclass.org:3306";
    private static $dbname = "mrober23_michaels";
    public static $username = "mrober23_michael";
    public static $password = "password";
    public static $pdoOptions = array(
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    public static $dsn;

    public function __construct()
    {
        $this::$dsn = "mysql: host=".$this::$uri.";dbname=".$this::$dbname;
    }
}