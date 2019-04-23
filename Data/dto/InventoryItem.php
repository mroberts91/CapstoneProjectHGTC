<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 4/23/2019
 * Time: 9:35 AM
 */

namespace Menu;


/**
 * Class InventoryItem
 * @package Menu
 */
class InventoryItem
{
    /**
     * @var int
     */
    private $id_MenuItem;
    /**
     * @var int
     */
    private $id_Category;
    /**
     * @var string
     */
    private $ItemName;
    /**
     * @var int
     */
    private $Inventory;
    /**
     * @var bool
     */
    private $IsLow;
    /**
     * @var string
     */
    private $CategoryName;

    /**
     * InventoryItem constructor.
     * @param $id_MenuItem
     * @param $id_Category
     * @param $ItemName
     * @param $Inventory
     * @param $IsLow
     * @param $CategoryName
     */
    public function __construct($id_MenuItem = null, $id_Category = null, $ItemName = null, $Inventory = null, $IsLow = null, $CategoryName = null)
    {
        $this->id_MenuItem = $id_MenuItem;
        $this->id_Category = $id_Category;
        $this->ItemName = $ItemName;
        $this->Inventory = $Inventory;
        $this->IsLow = $IsLow;
        $this->CategoryName = $CategoryName;
    }

    /**
     * @return null
     */
    public function getIdMenuItem()
    {
        return $this->id_MenuItem;
    }

    /**
     * @param null $id_MenuItem
     */
    public function setIdMenuItem($id_MenuItem)
    {
        $this->id_MenuItem = $id_MenuItem;
    }

    /**
     * @return null
     */
    public function getIdCategory()
    {
        return $this->id_Category;
    }

    /**
     * @param null $id_Category
     */
    public function setIdCategory($id_Category)
    {
        $this->id_Category = $id_Category;
    }

    /**
     * @return null
     */
    public function getItemName()
    {
        return $this->ItemName;
    }

    /**
     * @param null $ItemName
     */
    public function setItemName($ItemName)
    {
        $this->ItemName = $ItemName;
    }

    /**
     * @return null
     */
    public function getInventory()
    {
        return $this->Inventory;
    }

    /**
     * @param null $Inventory
     */
    public function setInventory($Inventory)
    {
        $this->Inventory = $Inventory;
    }

    /**
     * @return null
     */
    public function getisLow()
    {
        return $this->IsLow;
    }

    /**
     * @param null $IsLow
     */
    public function setIsLow($IsLow)
    {
        $this->IsLow = $IsLow;
    }

    /**
     * @return null
     */
    public function getCategoryName()
    {
        return $this->CategoryName;
    }

    /**
     * @param null $CategoryName
     */
    public function setCategoryName($CategoryName)
    {
        $this->CategoryName = $CategoryName;
    }


}