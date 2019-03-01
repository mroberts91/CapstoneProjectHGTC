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
    private $id_MenuItem;
    private $ItemName;
    private $ItemPrice;
    private $ItemCat;

    /**
     * MenuItem constructor.
     */
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
     * Getter
     * @return int - The ID of the menu item.
     */
    public function getID()
    {
        return $this->id_MenuItem;
    }

    /**
     * Getter
     * @return string - The name of the menu item.
     */
    public function getName()
    {
        return $this->ItemName;
    }

    /**
     * Getter
     * @return float - The price of the menu item.
     */
    public function getPrice()
    {
        return $this->ItemPrice;
    }

    /**
     * Getter
     * @return int - The catagory of the menu item.
     */
    public function getCatagory()
    {
        return $this->ItemCat;
    }

}