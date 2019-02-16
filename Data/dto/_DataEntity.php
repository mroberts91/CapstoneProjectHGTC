<?php

class _DataEntity
{
    /**
     * @var boolean $IsValid - Boolean flag to determine if the object's fields have been properly initialized.
     */
    public $IsValid;

    public function __construct()
    {
        $this->IsValid = false;
    }
}