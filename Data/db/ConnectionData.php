<?php

namespace Connection;

use PDO;

class ConnectionData
{
    /**
     * @var string Database url
     */
    private static $uri = "[Database URL]";
    /**
     * @var string Database name
     */
    private static $dbname = "[Database Name]";
    /**
     * @var string Datbase User
     */
    public static $username = "[Username]";
    /**
     * @var string Database password
     */
    public static $password = "[Password]";
    /**
     * @var array PDO options
     */
    public static $pdoOptions = array(
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    /**
     * @var string The built database connection string
     */
    public static $dsn;

    public function __construct()
    {
        $this::$dsn = "mysql: host=" . $this::$uri . ";dbname=" . $this::$dbname;
    }
}
