<?php
namespace Menu;
use Connection\Connection;
use Core\_DataManager;
use Exception;
require_once __DIR__.'/_DataManager.php';
require_once __DIR__."/../dto/MenuItem.php";
require_once __DIR__."/../dto/MenuCatagory.php";
require_once __DIR__."/../dto/InventoryItem.php";

/**
 * Class MenuManager
 * @package Menu
 * This class is used to abstract SQL operations to the menu data objects from the UI.
 * All main queries made to or involving menu objects should be created in the Menu Manager.
 */
class MenuManager extends _DataManager
{
    /**
     * MenuManager constructor.
     * @param Connection $Connection - PDO Connection Object
     * @throws Exception - Throws Exception if PDO connection is null.
     */
    public function __construct($Connection)
    {
        parent::__construct($Connection);
    }

    /**
     * Get all the menu items from the menu table
     * @return MenuItem[] - Array of MenuItem objects
     * @throws Exception - Throws an exception if a SQL Exception was thrown or the Result Set was empty.
     */
    public function GetAllMenuItems()
    {
        $result = $this->Connection->SQLRequest(
            "SELECT id_MenuItem, ItemName, ItemPrice, ItemCat FROM menu_MenuItems"
        );
        if (count($result) > 0) {
            $menuItems = $this->buildReturnArray($result);
            return $menuItems;
        } else{
            throw new Exception("EMPTY RESULT SET - The result set was empty.", 21);
        }
    }

    /**
     * @return MenuCatagory[]
     * @throws Exception
     */
    public function getAllMenuCatagories(){
        $rtn = array();
        $result = $this->Connection->SQLRequest(
            "SELECT id_Category, Name FROM lu_MenuCategory WHERE hidden = 0"
        );
        foreach ($result as $cat){
            $mc = new MenuCatagory(
                $cat['id_Category'],
                $cat['Name']
            );
            array_push($rtn, $mc);
        }

        return $rtn;
    }
    /**
     * @param int $id - The ID of the menu item that you are attempting to query.
     * @return MenuItem
     * @throws Exception
     */
    public function GetItemById($id)
    {
        $result = $this->Connection->SQLRequest(
            "SELECT id_MenuItem, Name, Price, ShortName, id_Category FROM menu_MenuItem WHERE id_MenuItem=?", $id
        );
        if (count($result) > 0) {
            $menuItems = $this->buildReturnArray($result);
            return $menuItems[0];
        } else{
            throw new Exception("EMPTY RESULT SET - The result set was empty.", 21);
        }
    }

    /**
     * @param $catagory
     * @return MenuItem[]
     * @throws Exception
     */
    public function GetAllByCatagory($catagory){
        $result = $this->Connection->SQLRequest(
            "SELECT * FROM menu_MenuItem WHERE id_Category=?", $catagory
        );
        if (count($result) > 0) {
            $menuItems = $this->buildReturnArray($result);
            return $menuItems;
        } else{
            throw new Exception("EMPTY RESULT SET - The result set was empty.", 21);
        }
    }
    /**
     * @param $catagory
     * @return MenuItem[]
     * @throws Exception
     */
    public function GetAllByCatagoryCustomer($catagory){
        $result = $this->Connection->SQLRequest(
            "SELECT * FROM menu_MenuItem WHERE id_Category=? AND hidden=0", $catagory
        );
        if (count($result) > 0) {
            $menuItems = $this->buildReturnArray($result);
            return $menuItems;
        } else{
            throw new Exception("EMPTY RESULT SET - The result set was empty.", 21);
        }
    }

    /**
     * @param $ResultSet - Results set of a SQL query
     * @return MenuItem[] - Returns an array of Menu Item Objects
     * @throws Exception - If error occurs in building the array.
     */
    private function buildReturnArray($ResultSet){
        $rtn = array();
        foreach ($ResultSet as $item) {
            $m = new MenuItem();
            if (!$m->buildFromArray($item)) {
                throw new Exception("DB RESULT PROPAGATION ERROR -
                    Menu Item failed to initalize fields, OBJECT:  " . print_r($item),
                    999
                );
            }
            array_push($rtn, $m);
        }
        return $rtn;
    }

    /**
     * @param MenuItem $menuItem
     * @throws Exception
     */
    public function updateMenuItem($menuItem){
        $params = array(
            $menuItem->getName(),
            $menuItem->getShortName(),
            $menuItem->getPrice(),
            $menuItem->getIdCatagory(),
            $menuItem->getIdMenuItem()
        );
        $this->Connection->SQLNonQuery(
            "UPDATE menu_MenuItem SET Name=?, ShortName=?, Price=?, id_Category=?
                      WHERE id_MenuItem=?", $params
        );
    }

    /**
     * @return int - Potential new category number;
     * @throws Exception
     */
    public function getNewMenuCategory(){
        $result = $this->Connection->SQLRequest("
            SELECT id_Category FROM lu_MenuCategory ORDER BY id_Category DESC LIMIT 1;
        ");
        return ((int)$result[0]['id_Category']) + 10;
    }

    /**
     * @param $id
     * @param $name
     * @throws Exception
     */
    public function createNewMenuCategory($id, $name){
        $params = array(
            $id,
            $name
        );
        $this->Connection->SQLNonQuery(
            "INSERT INTO lu_MenuCategory (id_Category, Name) VALUES (?, ?)", $params
        );
    }

    /**
     * @param $id
     * @return MenuCatagory
     * @throws Exception
     */
    public function getCategoryByID($id){
        $result = $this->Connection->SQLRequest(
            "SELECT id_Category, Name FROM lu_MenuCategory WHERE id_Category = ?", $id
        );
        return new MenuCatagory($result[0]['id_Category'], $result[0]['Name']);
    }

    /**
     * @param $id
     * @param $name
     * @param $hidden
     * @throws Exception
     */
    public function updateMenuCategoryName($id, $name, $hidden){
        $params = array(
            $name,
            $hidden,
            $id
        );
        $this->Connection->SQLNonQuery(
            "UPDATE lu_MenuCategory SET Name = ?, hidden = ? WHERE id_Category = ?", $params
        );
    }

    /**
     * @return InventoryItem[]
     * @throws Exception
     */
    public function getItemsForInventory(){
        $rtn = array();
        $result = $this->Connection->SQLRequest(
            "SELECT * FROM vw_inventory"
        );
        foreach ($result as $i) {
            $item = new InventoryItem(
                $i['id_MenuItem'],
                $i['id_Category'],
                $i['ItemName'],
                $i['Inventory'],
                $i['IsLow'],
                $i['CategoryName']
            );
            array_push($rtn, $item);
        }
        return $rtn;
    }

    public function getInventoryCount($id){
        $result = $this->Connection->SQLRequest(
            "SELECT Inventory FROM menu_Inventory WHERE id_MenuItem = ?", $id
        );
        return (int)$result[0]['Inventory'];
    }

    public function updateInventory($count, $id){
        $params = array(
            $count,
            $id
        );
        $this->Connection->SQLNonQuery(
            "UPDATE menu_Inventory SET Inventory = ? WHERE id_MenuItem = ?", $params
        );
    }
}