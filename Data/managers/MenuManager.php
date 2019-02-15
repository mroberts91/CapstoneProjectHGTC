<?php
require_once 'DataManager.php';
require_once __DIR__."/../dto/MenuItem.php";
class MenuManager extends DataManager
{
    public function __construct($Connection)
    {
        parent::__construct($Connection);
    }

    /**
     * Get all the menu items from the menu table
     * @return MenuItem[] - Array of MenuItem
     * @throws Exception
     */
    public function GetAllMenuItems(){
        $menuItems = array();
        $result = $this->Connection->request(
            "SELECT id_MenuItem, ItemName, ItemPrice, ItemCat FROM menu_MenuItems"
        );
        if (count($result) > 0){
            foreach ($result as $item) {
                $m = new MenuItem($item);
                array_push($menuItems, $m);
            }
        }
        return $menuItems;
    }
}