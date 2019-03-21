<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 3/20/2019
 * Time: 11:55 PM
 */

namespace Core;
/**
 * Class State
 * @package Core
 */
class State
{
    /**
     * @var
     */
    private $id_State;
    /**
     * @var
     */
    private $Name;

    /**
     * State constructor.
     */
    public function __construct()
    {
        $this->id_State = null;
        $this->Name = null;
    }

    /**
     * @param $array
     * @return bool
     */
    public function buildFromArray($array){
        $this->id_State = $array['id_State'];
        $this->Name = $array['Name'];
        return true;
    }

    /**
     * @return mixed
     */
    public function getIdState()
    {
        return $this->id_State;
    }

    /**
     * @param mixed $id_State
     */
    public function setIdState($id_State): void
    {
        $this->id_State = $id_State;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param mixed $Name
     */
    public function setName($Name): void
    {
        $this->Name = $Name;
    }
}