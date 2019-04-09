<?php
namespace Orders;
use Core\_DataManager;
use Core\OrderStatus;
use DateTime;
use http\Exception\BadMethodCallException;

require_once __DIR__."/_DataManager.php";
require_once __DIR__."/../dto/Order.php";
require_once __DIR__."/../dto/OrderItem.php";
require_once __DIR__."/../enum/OrderStatus.php";

/**
 * Class OrderManager
 * @package Orders
 * TODO Not Implemented yet
 */
class OrderManager extends _DataManager
{
    public function __construct($Connection)
    {
        parent::__construct($Connection);
    }

    /**
     * @param int $userID
     * @return Order[]
     * @throws \Exception
     */
    public function getAllOpenOrdersByEmp($userID){
        $rtn = array();
        $result = $this->Connection->SQLRequest(
            "SELECT * FROM vw_order_OpenOrders WHERE id_Employee = ?", $userID
        );
        foreach ($result as $order){
            $o = new Order();
            $o->setIdOrder($order['id_Order']);
            $o->setCreated(new DateTime($order['Created']));
            $o->setSubtotal($order['Subtotal']);
            $o->setGrandTotal($order['GrandTotal']);
            $o->setIdEmployee($order['id_Employee']);
            $o->setEmpFirstname($order['Firstname']);
            $o->setEmpLastname($order['Lastname']);
            $o->setOrderItemCount($order['Item Count']);
            $o->setIdOrderStatus($order['id_OrderStatus']);
            $o->setOrderStatus($order['Name']);
            array_push($rtn, $o);
        }
        return $rtn;
    }

    /**
     * @return Order[]
     * @throws \Exception
     */
    public function getAllOpenOrders(){
        $params = array(100, 200);
        $rtn = array();
        $result = $this->Connection->SQLRequest(
            "SELECT * FROM vw_order_OpenOrders WHERE id_OrderStatus = ? OR id_OrderStatus = ?",
            $params
        );
        foreach ($result as $order){
            $o = new Order();
            $o->setIdOrder($order['id_Order']);
            $o->setCreated(new DateTime($order['Created']));
            $o->setSubtotal($order['Subtotal']);
            $o->setGrandTotal($order['GrandTotal']);
            $o->setIdEmployee($order['id_Employee']);
            $o->setEmpFirstname($order['Firstname']);
            $o->setEmpLastname($order['Lastname']);
            $o->setOrderItemCount($order['Item Count']);
            $o->setIdOrderStatus($order['id_OrderStatus']);
            $o->setOrderStatus($order['Name']);
            array_push($rtn, $o);
        }
        return $rtn;
    }

    /**
     * @param OrderItem[] $items
     * @param int $idOrder
     * @return bool
     * @throws \Exception
     */
    public function addItemsToOrder($items, $idOrder){
        $this->Connection->SQLNonQuery("DELETE FROM order_OrderDetail where id_Order = ?", $idOrder);
        $this->Connection->SQLNonQuery("UPDATE order_Order SET Subtotal = 0.00 WHERE id_Order = ?", $idOrder);
        foreach ($items as $item) {
            $params = array(
                $item->getIdOrder(),
                $item->getIdMenuItem(),
                $item->getItemPrice()
            );
            try{
                $this->Connection->SQLNonQuery(
                    "INSERT INTO order_OrderDetail (id_Order, id_MenuItem, ItemPrice) VALUES (?, ?, ?)",
                    $params
                );

            } catch (\Exception $e){
                echo $e->getMessage();
                print_r($item);
            }

        }
        return true;
    }

    /**
     * @param $creatorID - EmployeeID
     * @throws \Exception
     * @return int new order ID
     */
    public function createNewOrder($creatorID){
        $params = array($creatorID, 0.00, 0.00, 0.00, $creatorID);
        $this->Connection->SQLNonQuery(
            "INSERT INTO order_Order 
            (CreatedBy, Subtotal, CalculatedTax, GrandTotal, id_Employee)
            VALUES (?,?,?,?,?)", $params
        );
        $id = $this->Connection->SQLRequest(
            "SELECT id_Order FROM order_Order ORDER BY id_Order DESC LIMIT 1"
        );
        return $id[0]['id_Order'];
    }

    /**
     * @param $id
     * @return array|null
     * @throws \Exception
     */
    public function getAllItemsByOrderIdForUI($id){
        $results = $this->Connection->SQLRequest(
            "SELECT * FROM vw_order_DisplayOrder WHERE id_Order = ?", $id
        );
        return $results;
    }

    public function updateOrderStatus($Status, $id){
        $params = array($Status, $id);
        $this->Connection->SQLNonQuery("UPDATE order_Order SET id_OrderStatus = ? WHERE id_Order = ?", $params);
    }

    /**
     * @param $id
     * @return float
     * @throws \Exception
     */
    public function getOrderSubtotal($id){
        $result = $this->Connection->SQLRequest("SELECT Subtotal FROM order_Order WHERE id_Order = ?", $id);
        return (float)$result[0]['Subtotal'];
    }

    /**
     * @param int $id
     * @param float $subtotal
     * @throws \Exception
     */
    public function updateOrderGrandTotal($id, $subtotal){
        $grandTotal = ($subtotal * 0.07) + $subtotal;
        $params = array($grandTotal, $id);
        $this->Connection->SQLNonQuery("UPDATE order_Order SET GrandTotal = ? WHERE id_Order = ?", $params);
    }
}