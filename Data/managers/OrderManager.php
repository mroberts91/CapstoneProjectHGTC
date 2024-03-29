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
        $params = array(
            $userID,
            OrderStatus::$OPEN,
            OrderStatus::$NEW,
            OrderStatus::$FOODMADE
        );
        $rtn = array();
        $result = $this->Connection->SQLRequest(
            "SELECT * FROM vw_order_OpenOrders WHERE id_Employee = ? AND id_OrderStatus IN(?, ?, ?)", $params
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
            $o->setTableNumber($order['TableNumber']);
            array_push($rtn, $o);
        }
        return $rtn;
    }

    /**
     * @param $id
     * @return Order[]
     * @throws \Exception
     */
    public function getAllCustomerOrdersByCustID($id){
        $params = array(
            38,
            $id,
            OrderStatus::$OPEN,
            OrderStatus::$NEW,
            OrderStatus::$FOODMADE,
            OrderStatus::$COMPLETED
        );
        $rtn = array();
        $result = $this->Connection->SQLRequest(
            "SELECT * FROM vw_order_OpenOrders WHERE id_Employee = ? AND id_Customer = ? AND id_OrderStatus IN(?, ?, ?, ?)", $params
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
            $o->setTableNumber($order['TableNumber']);
            $o->setIdCustomer($order['id_Customer']);
            $o->setDateReady(new DateTime($order['DateReady']));
            array_push($rtn, $o);
        }
        return $rtn;
    }

    /**
     * @param $orderID
     * @return Order
     * @throws \Exception
     */
    public function getCustomerOrder($orderID){
        $params = array(
            $orderID
        );
        $rtn = array();
        $result = $this->Connection->SQLRequest(
            "SELECT * FROM vw_order_OpenOrders WHERE id_Order = ?", $params
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
            $o->setTableNumber($order['TableNumber']);
            $o->setDateReady(new DateTime($order['DateReady']));
            array_push($rtn, $o);
        }
        return $rtn[0];
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
            $o->setSubtotal(($order['Subtotal'] == null)? 0.00 : $order['Subtotal']);
            $o->setGrandTotal(($order['GrandTotal'] == null)? 0.00 : $order['GrandTotal']);
            $o->setIdEmployee($order['id_Employee']);
            $o->setEmpFirstname($order['Firstname']);
            $o->setEmpLastname($order['Lastname']);
            $o->setOrderItemCount($order['Item Count']);
            $o->setIdOrderStatus($order['id_OrderStatus']);
            $o->setOrderStatus($order['Name']);
            $o->setTableNumber($order['TableNumber']);
            array_push($rtn, $o);
        }
        return $rtn;
    }

    /**
     * @return Order[]
     * @throws \Exception
     */
    public function getAllCompletedOrders(){
        $params = array(
            OrderStatus::$COMPLETED,
            OrderStatus::$CANCELLED
        );
        $rtn = array();
        $result = $this->Connection->SQLRequest(
            "SELECT * FROM vw_order_OpenOrders WHERE id_OrderStatus IN (?,?)",
            $params
        );
        foreach ($result as $order){
            $o = new Order();
            $o->setIdOrder($order['id_Order']);
            $o->setCreated(new DateTime($order['Created']));
            $o->setSubtotal(($order['Subtotal'] == null)? 0.00 : $order['Subtotal']);
            $o->setGrandTotal(($order['GrandTotal'] == null)? 0.00 : $order['GrandTotal']);
            $o->setIdEmployee($order['id_Employee']);
            $o->setEmpFirstname($order['Firstname']);
            $o->setEmpLastname($order['Lastname']);
            $o->setOrderItemCount($order['Item Count']);
            $o->setIdOrderStatus($order['id_OrderStatus']);
            $o->setOrderStatus($order['Name']);
            $o->setTableNumber($order['TableNumber']);
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
                $item->getItemPrice(),
                $item->getNotes(),
                $item->getisCooked()
            );
//            if ($item->isToDelete()){
//
//            }
            try{
                $this->Connection->SQLNonQuery(
                    "INSERT INTO order_OrderDetail (id_Order, id_MenuItem, ItemPrice, Notes, IsCooked)
                    VALUES (?, ?, ?, ?, ?)",
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
    public function createNewOrder($creatorID, $tableNum){
        $params = array($creatorID, 0.00, 0.00, 0.00, $creatorID, $tableNum);
        $this->Connection->SQLNonQuery(
            "INSERT INTO order_Order 
            (CreatedBy, Subtotal, CalculatedTax, GrandTotal, id_Employee, TableNumber)
            VALUES (?,?,?,?,?,?)", $params
        );
        $id = $this->Connection->SQLRequest(
            "SELECT id_Order FROM order_Order ORDER BY id_Order DESC LIMIT 1"
        );
        return $id[0]['id_Order'];
    }

    /**
     * @param $creatorID - EmployeeID
     * @throws \Exception
     * @return int new order ID
     */
    public function createNewCustomerOrder($creatorID, $id_Customer){
        $params = array($creatorID, 0.00, 0.00, 0.00, $creatorID, $id_Customer);
        $this->Connection->SQLNonQuery(
            "INSERT INTO order_Order 
            (CreatedBy, Subtotal, CalculatedTax, GrandTotal, id_Employee, id_Customer, IsCustomer, id_OrderStatus)
            VALUES (?,?,?,?,?,?, 1, 400)", $params
        );

        $id = $this->Connection->SQLRequest(
            "SELECT id_Order FROM order_Order ORDER BY id_Order DESC LIMIT 1"
        );
        $newOrder = $id[0]['id_Order'];
        $this->Connection->SQLNonQuery(
            "UPDATE order_Order SET DateReady = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE id_Order = ?", $newOrder
        );
        return $newOrder;
    }

    /**
     * @param $id
     * @return OrderItem[]
     * @throws \Exception
     */
    public function getAllItemsByOrderIdForUI($id){
        $results = $this->Connection->SQLRequest(
            "SELECT * FROM vw_order_DisplayOrder WHERE id_Order = ?", $id
        );
        return $results;
    }
    /**
     * @param $id
     * @return OrderItem[]
     * @throws \Exception
     */
    public function getAllItemsByOrder($id){
        $rtn = array();
        $results = $this->Connection->SQLRequest(
            "SELECT * FROM vw_order_DisplayOrder WHERE id_Order = ?", $id
        );
        foreach ($results as $item) {
            $i = new OrderItem();
            $i->setIdOrder($item['id_Order']);
            $i->setIdMenuItem($item['id_MenuItem']);
            $i->setName($item['Name']);
            $i->setNotes($item['Notes']);
            $i->setIsCooked($item['IsCooked']);
            $i->setItemPrice($item['ItemPrice']);

            array_push($rtn, $i);
        }
        return $rtn;
    }

    /**
     * @param $orderID
     * @return OrderItem[]
     * @throws \Exception
     */
    public function getAllNeedToBeCookedItems($orderID){
        $rtn = array();
        $results = $this->Connection->SQLRequest(
            "SELECT * FROM vw_order_DisplayOrder WHERE id_Order = ? AND IsCooked = 0", $orderID
        );
        foreach ($results as $item) {
            $i = new OrderItem();
            $i->setIdOrder($item['id_Order']);
            $i->setIdMenuItem($item['id_MenuItem']);
            $i->setName($item['Name']);
            $i->setNotes($item['Notes']);
            $i->setIsCooked($item['IsCooked']);
            array_push($rtn, $i);
        }
        return $rtn;
    }


    /**
     * @param $Status
     * @param $id
     * @throws \Exception
     */
    public function updateOrderStatus($Status, $id){
        $params = array($Status, $id);
        $this->Connection->SQLNonQuery("UPDATE order_Order SET id_OrderStatus = ?, Updated = now() WHERE id_Order = ?", $params);
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
        $this->Connection->SQLNonQuery("UPDATE order_Order SET GrandTotal = ?, Updated = now() WHERE id_Order = ?", $params);
    }

    /**
     * @param int $id orderID
     * @throws \Exception
     */
    public function setCancelledStatus($id){
        $params = array(
            OrderStatus::$CANCELLED,
            $id
        );
        $this->Connection->SQLNonQuery(
            "UPDATE order_Order SET id_OrderStatus = ?, Updated = now() WHERE id_Order = ?", $params);
    }

    /**
     * @param $id
     * @throws \Exception
     */
    public function updateInventoryForOrder($id){
        $items = $this->getAllItemsByOrder($id);
        $this->Connection->SQLNonQuery(
            "UPDATE order_OrderDetail SET IsCooked = 1 WHERE id_Order=?",
            $id
        );
        foreach ($items as $item){
            $this->Connection->SQLNonQuery(
                "UPDATE menu_Inventory SET Inventory = Inventory-1 WHERE id_MenuItem=?",
                $item->getIdMenuItem()
            );
        }
    }

}