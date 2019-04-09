<?php
namespace Menu;
use Core\_DataEntity;
require_once __DIR__.'/_DataEntity.php';
/**
 * Class MenuItem
 * DTO Object representing a menu item from the Database.
 */
class MenuItem extends _DataEntity
{
    /**
     * @var
     */
    private $id_MenuItem;
    /**
     * @var
     */
    private $Name;
    /**
     * @var
     */
    private $Price;
    /**
     * @var
     */
    private $ShortName;
    /**
     * @var
     */
    private $id_Catagory;

    /**
     * MenuItem constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $array
     * @return bool
     */
    public function buildFromArray($array){
        try{
            $this->id_MenuItem = $array['id_MenuItem'];
            $this->Name = $array['Name'];
            $this->Price = $array['Price'];
            $this->ShortName = $array['ShortName'];
            $this->id_Catagory = $array['id_Catagory'];
            return true;
        } catch (\Exception $e){
            return false;
        }

    }

    /**
     * @return mixed
     */
    public function getIdMenuItem()
    {
        return $this->id_MenuItem;
    }

    /**
     * @param mixed $id_MenuItem
     */
    public function setIdMenuItem($id_MenuItem): void
    {
        $this->id_MenuItem = $id_MenuItem;
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

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->Price;
    }

    /**
     * @param mixed $Price
     */
    public function setPrice($Price): void
    {
        $this->Price = $Price;
    }

    /**
     * @return mixed
     */
    public function getShortName()
    {
        return $this->ShortName;
    }

    /**
     * @param mixed $ShortName
     */
    public function setShortName($ShortName): void
    {
        $this->ShortName = $ShortName;
    }

    /**
     * @return mixed
     */
    public function getIdCatagory()
    {
        return $this->id_Catagory;
    }

    /**
     * @param mixed $id_Catagory
     */
    public function setIdCatagory($id_Catagory): void
    {
        $this->id_Catagory = $id_Catagory;
    }

}