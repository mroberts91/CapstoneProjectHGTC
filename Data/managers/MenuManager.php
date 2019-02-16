<?php
require_once __DIR__.'/_DataManager.php';
require_once __DIR__."/../dto/MenuItem.php";
class MenuManager extends _DataManager
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
    public function GetAllMenuItems()
    {
        $result = $this->Connection->request(
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
     * @param int $id
     * @return MenuItem[] - Array of MenuItem
     * @throws Exception
     */
    public function GetItemById($id)
    {
        // Type check the input parameter
        if (!is_int($id)) {
            throw new Exception("TYPE ERROR/MenuManager->GetItemById - 
            The id parameter must be of type int.",
                20
            );
        }
        $result = $this->Connection->request(
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
     * @param $ResultSet
     * @return array
     * @throws Exception
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