<?php
class DataManager
{
    /**
     * @var Connection $_conn - A PDO connection object for database operations
     */
    protected $Connection;

    /**
     * MenuManager constructor.
     * @param $Connection - PDO Connection Object
     * @throws Exception - PDO OBJECT NULL REFERENCE.
     */
    public function __construct($Connection)
    {
        if ($Connection === null){
            throw new Exception(
                "PDO OBJECT NULL REFERENCE - The injected PDO object is is null",
                999
            );
        }

        $this->Connection = $Connection;
    }
}