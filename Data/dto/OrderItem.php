<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 4/9/2019
 * Time: 9:52 AM
 */

namespace Orders;
use Core\_DataEntity;
require_once __DIR__."/_DataEntity.php";
class OrderItem extends _DataEntity
{
    /**
     * @var int
     */
    private $id_Order;

    /**
     * @var int
     */
    private $id_MenuItem;

    /**
     * @var float
     */
    private $ItemPrice;

    /**
     * @var string
     */
    private $Notes;

    /**
     * @var string
     */
    private $Name;

    /**
     * @var int
     */
    private $IsCooked;

    /**
     * @var bool
     */
    private $IsNew;

    /**
     * @var bool
     */
    private $ToDelete;

    /**
     * OrderItem constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->id_Order = null;
        $this->id_MenuItem = null;
        $this->ItemPrice = null;
        $this->Notes = null;
        $this->Name = null;
        $this->IsCooked = null;
        $this->IsNew = false;
        $this->ToDelete = false;
    }

    /**
     * @return int
     */
    public function getIdOrder(): int
    {
        return $this->id_Order;
    }

    /**
     * @param int $id_Order
     */
    public function setIdOrder(int $id_Order)
    {
        $this->id_Order = $id_Order;
    }

    /**
     * @return int
     */
    public function getIdMenuItem(): int
    {
        return $this->id_MenuItem;
    }

    /**
     * @param int $id_MenuItem
     */
    public function setIdMenuItem(int $id_MenuItem)
    {
        $this->id_MenuItem = $id_MenuItem;
    }

    /**
     * @return float
     */
    public function getItemPrice(): float
    {
        return $this->ItemPrice;
    }

    /**
     * @param float $ItemPrice
     */
    public function setItemPrice(float $ItemPrice)
    {
        $this->ItemPrice = $ItemPrice;
    }

    /**
     * @return string
     */
    public function getNotes()
    {
        return $this->Notes;
    }

    /**
     * @param string $Notes
     */
    public function setNotes($Notes)
    {
        $this->Notes = $Notes;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->Name;
    }

    /**
     * @param string $Name
     */
    public function setName(string $Name)
    {
        $this->Name = $Name;
    }

    /**
     * @return int
     */
    public function getisCooked()
    {
        return $this->IsCooked;
    }

    /**
     * @param int $IsCooked
     */
    public function setIsCooked($IsCooked)
    {
        $this->IsCooked = $IsCooked;
    }

    /**
     * @return bool
     */
    public function isNew()
    {
        return $this->IsNew;
    }

    /**
     * @param bool $IsNew
     */
    public function setIsNew($IsNew)
    {
        $this->IsNew = $IsNew;
    }

    /**
     * @return bool
     */
    public function isToDelete()
    {
        return $this->ToDelete;
    }

    /**
     * @param bool $ToDelete
     */
    public function setToDelete($ToDelete)
    {
        $this->ToDelete = $ToDelete;
    }








}