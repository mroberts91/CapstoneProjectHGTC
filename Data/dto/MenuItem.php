<?php
require_once __DIR__.'/_DataEntity.php';
/**
 * Class MenuItem
 * DTO Object representing a single row in the menu_MenuItems table in the database.
 */
class MenuItem extends _DataEntity
{
    private $id_MenuItem;
    private $ItemName;
    private $ItemPrice;
    private $ItemCat;

    public function __construct()
    {
        $this->id_MenuItem = null;
        $this->ItemName = null;
        $this->ItemPrice = null;
        $this->ItemCat = null;
        parent::__construct();
    }

    /**
     * Allows all the object fields to be initialized from an associative array.
     * @param array $array An assoc array returned from DB query.
     * @return bool Returns boolean if the field initialization was successful.
     */
    public function buildFromArray($array)
    {
        if (is_array($array)){
            $this->id_MenuItem = $array['id_MenuItem'];
            $this->ItemName = $array['ItemName'];
            $this->ItemPrice = $array['ItemPrice'];
            $this->ItemCat = $array['ItemCat'];
            $this->IsValid = true;
            return true;
        } else{
            $this->IsValid = false;
            return false;
        }
    }

    /**
     * @param int $id_MenuItem
     * @param string $ItemName
     * @param float $ItemPrice
     * @param int $ItemCat
     * @return bool Returns boolean if the field initialization was successful.
     */
    public function buildFromParams($id_MenuItem, $ItemName, $ItemPrice, $ItemCat){
        if (is_int($id_MenuItem) && is_string($ItemName) && is_float($ItemPrice) && is_int($ItemCat)){
            $this->id_MenuItem = $id_MenuItem;
            $this->ItemName = $ItemName;
            $this->ItemPrice = $ItemPrice;
            $this->ItemCat = $ItemCat;
            $this->IsValid = true;
            return true;
        } else{
            $this->IsValid = false;
            return false;
        }
    }

    // Getters
    /**
     * @return int
     */
    public function getID()
    {
        return $this->id_MenuItem;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->ItemName;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->ItemPrice;
    }

    /**
     * @return int
     */
    public function getCatagory()
    {
        return $this->ItemCat;
    }

}