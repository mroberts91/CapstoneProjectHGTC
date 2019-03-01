<?php
namespace Core;
/**
 * Class _DataEntity
 * @package Core
 * Base class of all database entiy DTOs (Data Transfer Objects)
 * Can add more properties to base class that can be used by all entities.
 */
class _DataEntity
{
    /**
     * @var boolean $IsValid - Boolean flag to determine if the object's fields have been properly initialized.
     */
    public $IsValid;

    /**
     * _DataEntity constructor.
     */
    public function __construct()
    {
        $this->IsValid = false;
    }
}