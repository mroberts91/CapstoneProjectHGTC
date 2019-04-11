<?php
namespace Menu;
use Connection\Connection;
use Core\_DataManager;
use Exception;
require_once __DIR__.'/_DataManager.php';
require_once __DIR__."/../dto/MenuItem.php";

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
     * @param int $id - The ID of the menu item that you are attempting to query.
     * @return MenuItem[] - Array of MenuItem Objects
     * @throws Exception
     */
    public function GetItemById($id)
    {
        $result = $this->Connection->SQLRequest(
            "SELECT id_MenuItem, ItemName, ItemPrice, ItemCat FROM menu_MenuItems WHERE id_MenuItem=?", $id
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
}