<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 4/17/2019
 * Time: 10:14 PM
 */

namespace Menu;

/**
 * Class MenuCatagory
 * @package Menu
 */
class MenuCatagory
{
    /**
     * @var int
     */
    private $id_Catagory;
    /**
     * @var string
     */
    private $Name;

    /**
     * MenuCatagory constructor.
     * @param int $id_Catagory
     * @param string $Name
     */
    public function __construct($id_Catagory = null, $Name = null)
    {
        $this->Name = $Name;
        $this->id_Catagory = $id_Catagory;
    }

    /**
     * @return int
     */
    public function getIdCatagory()
    {
        return $this->id_Catagory;
    }

    /**
     * @param int $id_Catagory
     */
    public function setIdCatagory($id_Catagory)
    {
        $this->id_Catagory = $id_Catagory;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param string $Name
     */
    public function setName($Name)
    {
        $this->Name = $Name;
    }


}