<?php
namespace Connection;
require_once __DIR__."/../db/ConnectionData.php";

/**
 * Class ConnectionDataFactory
 * @package Connection
 * Class that follows the factory pattern, static methods that return new
 * instances of Domain Objects
 */
class ConnectionDataFactory
{
    /**
     * Create a new ConnectionData object, used of new PDO connections.
     * @return ConnectionData - New ConnectionData Object
     *
     */
    public static function Create(){
        return new ConnectionData();
    }
}