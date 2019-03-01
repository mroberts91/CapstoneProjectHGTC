<?php

namespace Core;
use Exception;
use Connection\Connection;

/**
 * Class _DataManager
 * @package Core
 * Base class for all Manager classes, contains an instance of a PDO connection. This
 * connection must be passed in through the constructor.
 */
class _DataManager
{
    /**
     * @var Connection $Connection - A PDO connection object for database operations
     */
    protected $Connection;

    /**
     * MenuManager constructor.
     * @param $Connection - PDO Connection Object
     * @throws Exception - PDO OBJECT NULL REFERENCE.
     */
    public function __construct($Connection)
    {
        if ($Connection === null) {
            throw new Exception(
                "PDO OBJECT NULL REFERENCE - The injected PDO object is is null",
                999
            );
        }
        $this->Connection = $Connection;
    }
}