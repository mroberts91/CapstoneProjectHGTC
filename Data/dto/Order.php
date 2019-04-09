<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 4/9/2019
 * Time: 9:45 AM
 */

namespace Orders;
use Core\_DataEntity;
use Core\OrderStatus;

require_once __DIR__."/_DataEntity.php";
require_once __DIR__."/OrderItem.php";
require_once __DIR__."/../enum/OrderStatus.php";

class Order extends _DataEntity
{
    /**
     * @var int
     */
    private $id_Order;
    /**
     * @var \DateTime
     */
    private $Created;
    /**
     * @var float
     */
    private $Subtotal;
    /**
     * @var float
     */
    private $GrandTotal;
    /**
     * @var int
     */
    private $id_Employee;
    /**
     * @var string
     */
    private $EmpFirstname;
    /**
     * @var string
     */
    private $EmpLastname;
    /**
     * @var int
     */
    private $OrderItemCount;
    /**
     * @var OrderItem[]
     */
    private $OrderItems;
    /**
     * @var int
     */
    private $id_OrderStatus;
    /**
     * @var string
     */
    private $OrderStatus;

    /**
     * Order constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->id_Order = null;
        $this->Created = null;
        $this->Subtotal = null;
        $this->GrandTotal = null;
        $this->id_Employee = null;
        $this->EmpFirstname = null;
        $this->EmpLastname = null;
        $this->OrderItemCount = null;
        $this->OrderItems = null;
        $this->id_OrderStatus = null;
        $this->OrderStatus = null;
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
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->Created;
    }

    /**
     * @param \DateTime $Created
     */
    public function setCreated(\DateTime $Created)
    {
        $this->Created = $Created;
    }

    /**
     * @return float
     */
    public function getSubtotal(): float
    {
        return $this->Subtotal;
    }

    /**
     * @param float $Subtotal
     */
    public function setSubtotal(float $Subtotal)
    {
        $this->Subtotal = $Subtotal;
    }

    /**
     * @return float
     */
    public function getGrandTotal(): float
    {
        return $this->GrandTotal;
    }

    /**
     * @param float $GrandTotal
     */
    public function setGrandTotal(float $GrandTotal)
    {
        $this->GrandTotal = $GrandTotal;
    }

    /**
     * @return int
     */
    public function getIdEmployee(): int
    {
        return $this->id_Employee;
    }

    /**
     * @param int $id_Employee
     */
    public function setIdEmployee(int $id_Employee)
    {
        $this->id_Employee = $id_Employee;
    }

    /**
     * @return string
     */
    public function getEmpFirstname(): string
    {
        return $this->EmpFirstname;
    }

    /**
     * @param string $EmpFirstname
     */
    public function setEmpFirstname(string $EmpFirstname)
    {
        $this->EmpFirstname = $EmpFirstname;
    }

    /**
     * @return string
     */
    public function getEmpLastname(): string
    {
        return $this->EmpLastname;
    }

    /**
     * @param string $EmpLastname
     */
    public function setEmpLastname(string $EmpLastname)
    {
        $this->EmpLastname = $EmpLastname;
    }

    /**
     * @return int
     */
    public function getOrderItemCount(): int
    {
        return $this->OrderItemCount;
    }

    /**
     * @param int $OrderItemCount
     */
    public function setOrderItemCount(int $OrderItemCount)
    {
        $this->OrderItemCount = $OrderItemCount;
    }

    /**
     * @return OrderItem[]
     */
    public function getOrderItems(): array
    {
        return $this->OrderItems;
    }

    /**
     * @param OrderItem[] $OrderItems
     */
    public function setOrderItems(array $OrderItems)
    {
        $this->OrderItems = $OrderItems;
    }

    /**
     * @return int
     */
    public function getIdOrderStatus(): int
    {
        return $this->id_OrderStatus;
    }

    /**
     * @param int $id_OrderStatus
     */
    public function setIdOrderStatus(int $id_OrderStatus)
    {
        $this->id_OrderStatus = $id_OrderStatus;
    }

    /**
     * @return string
     */
    public function getOrderStatus(): string
    {
        return $this->OrderStatus;
    }

    /**
     * @param string $OrderStatus
     */
    public function setOrderStatus(string $OrderStatus)
    {
        $this->OrderStatus = $OrderStatus;
    }


}