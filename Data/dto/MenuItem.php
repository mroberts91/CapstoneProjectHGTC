<?php

/**
 * Class MenuItem
 * DTO Object representing a single row in the menu_MenuItems table in the database.
 */
class MenuItem
{
    public $id_MenuItem;
    public $ItemName;
    public $ItemPrice;
    public $ItemCat;

    /**
     * MenuItem constructor.
     * @param array|null $data
     * @param int $id_MenuItem
     * @param string $ItemName
     * @param float $ItemPrice
     * @param int $ItemCat
     */
        public function __construct(array $data = null, int $id_MenuItem = null, string $ItemName = null,
                                    float $ItemPrice = null,int $ItemCat = null)
    {
        if (is_array($data)){
            $this->id_MenuItem = $data['id_MenuItem'];
            $this->ItemName = $data['ItemName'];
            $this->ItemPrice = $data['ItemPrice'];
            $this->ItemCat = $data['ItemCat'];
        }
    }
}