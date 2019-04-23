<?php

use Connection\Connection;
use Core\OrderStatus;
use Menu\MenuManager;
use Menu\MenuItem;
use Orders\OrderItem;
use Orders\OrderManager;

require_once __DIR__ . "/header.php";
require_once __DIR__."/../Data/managers/MenuManager.php";
require_once __DIR__."/../Data/managers/OrderManager.php";
require_once __DIR__."/../Data/dto/MenuItem.php";
require_once __DIR__."/../Data/dto/OrderItem.php";
require_once __DIR__."/../Data/enum/OrderStatus.php";
$mm = null;
$orderNumber = null;
$customer = $_SESSION['customer_id'];
$errormsg = '';
$presentItems = null;
try{
    $db = new Connection();
    $mm = new MenuManager($db);

}catch (\Exception $e){
    die($e->getMessage());
}
try{
    $db = new Connection();
    $om = new OrderManager($db);
    $orderNumber = $om->createNewCustomerOrder(33, $customer);
//    $presentItems = $om->getAllItemsByOrderIdForUI($orderNumber);
//    die(json_encode($presentItems));
}catch (\Exception $e){
//    var_dump($presentItems);
    die($e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    try {
        $db = new Connection();
        $orderManager = new OrderManager($db);

        if (isset($_POST['saveOrder'])) {
            $itemsToSave = array();
            $postItems = (array)json_decode($_POST['itemsToSave'], true);
            foreach ($postItems as $item) {
                $newItem = new OrderItem();
                $newItem->setIdOrder($orderNumber);
                $newItem->setIdMenuItem((int)$item['id_MenuItem']);
                $newItem->setItemPrice((float)$item['ItemPrice']);
                $newItem->setNotes(($item['Notes'] == null) ? "" : $item['Notes']);
                $newItem->setIsCooked((int)$item['IsCooked']);
                $newItem->setIsNew(($item['IsNew'] == 1)? true : false);
                $newItem->setToDelete(($item['ToDelete'] == 1)? true : false);
                array_push($itemsToSave, $newItem);
            }
            $orderManager->updateOrderStatus(OrderStatus::$OPEN, $orderNumber);
            $orderManager->addItemsToOrder($itemsToSave, $orderNumber);
            $subtotal = $orderManager->getOrderSubtotal($orderNumber);
            $orderManager->updateOrderGrandTotal($orderNumber, $subtotal);
            echo '<script>window.location = "placed_orders.php?id='.$orderNumber.'"</script>';

        } elseif (isset($_POST['completeOrder'])) {
            $itemsToSave = array();
            $postItems = (array)json_decode($_POST['itemsToComplete'], true);
            foreach ($postItems as $item) {
                $newItem = new OrderItem();
                $newItem->setIdOrder($orderNumber);
                $newItem->setIdMenuItem((int)$item['id_MenuItem']);
                $newItem->setItemPrice((float)$item['ItemPrice']);
                $newItem->setNotes(($item['Notes'] == null) ? "" : $item['Notes']);
                array_push($itemsToSave, $newItem);
            }
            $orderManager->updateOrderStatus(OrderStatus::$COMPLETED, $orderNumber);
            $orderManager->addItemsToOrder($itemsToSave, $orderNumber);
            $subtotal = $orderManager->getOrderSubtotal($orderNumber);
            $orderManager->updateOrderGrandTotal($orderNumber, $subtotal);
            echo '<script>window.location = "your_orders.php"</script>';

        }elseif (isset($_POST['cancelOrder'])) {
            $orderManager->setCancelledStatus($orderNumber);
            echo '<script>window.location = "your_orders.php"</script>';
        }
    } catch (\Exception $e){
        die($e->getMessage());
    }
}
?>
<div class="container">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet"type="text/css" href="styles/create_order.css" >
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/order/create_order.js"></script>
    <h1 class="text-center">Order # <?php echo $orderNumber; ?></h1>
    <br>
    <input id="presentItems" value='<?php if ($presentItems != null) echo json_encode($presentItems); ?>' hidden>
    <div id="goodOptions">
        <form action="<?php echo $_SERVER['PHP_SELF'] . '?id='.$orderNumber; ?>" method="POST">
            <input type="text" value="" id="itemsToSave" name="itemsToSave" hidden>
            <button class="btn btn-success optionButton" type="submit" name="saveOrder">Place Order</button>
        </form>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-xl-8">
            <div id="tabs">
                <ul>
                    <li><a href="#tabs-1">Appitizers</a></li>
                    <li><a href="#tabs-2">Entr&eacute;es & Salads</a></li>
                    <li><a href="#tabs-3">Desserts</a></li>
                    <li><a href="#tabs-4">Beverages</a></li>
                </ul>
                <div id="tabs-1">
                    <div class="row">
                        <?php
                        try {
                            $apps = $mm->GetAllByCatagoryCustomer(10);
                            foreach ($apps as $a){
                                echo '<div class="btn btn-secondary col-md-5 menuItem appItem" id="'.$a->getIdMenuItem().'"  price="'.$a->getPrice().'" item="'.$a->getName().'">';
                                echo '<p>'.$a->getName().'</p>';
                                echo '<p>'.$a->getPrice().'</p>';
                                echo '</div>';
                            }
                        } catch (Exception $e) {
                            $errormsg .= '<p>Get all appatizers -- '.$e->getMessage().'</p>';
                        }
                        ?>
                    </div>
                </div>
                <div id="tabs-2">
                    <div class="row">
                        <?php
                        try {
                            $meals = $mm->GetAllByCatagoryCustomer(20);
                            foreach ($meals as $a){
                                echo '<div class="btn btn-secondary col-md-5 menuItem entreeItem" id="'.$a->getIdMenuItem().'"  price="'.$a->getPrice().'" item="'.$a->getName().'">';
                                echo '<p>'.$a->getName().'</p>';
                                echo '<p>'.$a->getPrice().'</p>';
                                echo '</div>';
                            }
                        } catch (Exception $e) {
                            $errormsg .= '<p>Get all Entrees -- '.$e->getMessage().'</p>';
                        }
                        ?>
                    </div>
                </div>
                <div id="tabs-3">
                    <div class="row">
                        <?php
                        try {
                            $desserts = $mm->GetAllByCatagoryCustomer(30);
                            foreach ($desserts as $a){
                                echo '<div class="btn btn-secondary col-md-5 menuItem dessertItem" id="'.$a->getIdMenuItem().'" price="'.$a->getPrice().'" item="'.$a->getName().'">';
                                echo '<p>'.$a->getName().'</p>';
                                echo '<p>'.$a->getPrice().'</p>';
                                echo '</div>';
                            }
                        } catch (Exception $e) {
                            $errormsg .= '<p>Get all desserts -- '.$e->getMessage().'</p>';
                        }
                        ?>
                    </div>
                </div>
                <div id="tabs-4">
                    <div class="row">
                        <?php
                        try {
                            $drinks = $mm->GetAllByCatagoryCustomer(40);
                            foreach ($drinks as $a){
                                echo '<div class="btn btn-secondary col-md-5 menuItem bevItem" id="'.$a->getIdMenuItem().'" price="'.$a->getPrice().'" item="'.$a->getName().'">';
                                echo '<p>'.$a->getName().'</p>';
                                echo '<p>'.$a->getPrice().'</p>';
                                echo '</div>';
                            }
                        } catch (Exception $e) {
                            $errormsg .= '<p>Get all drinks -- '.$e->getMessage().'</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-xl-4" id="order-items-container">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Item Name</th>
                    <th scope="col">Item Price</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="order-list">

                </tbody>
                <tr>
                    <th>Total</th>
                    <td id="total"></td>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <br>
    <div id="badOptions">
        <form action="<?php echo $_SERVER['PHP_SELF'] . '?id='.$orderNumber; ?>" method="POST">
            <button class="btn btn-danger optionButton" id="cancelOrder" type="button">Cancel Order</button>
            <button class="btn btn-danger optionButton" id="areYouSure" name="cancelOrder" type="submit">YES, CANCEL ORDER</button>
        </form>
    </div>
    <br><br>
    <div class="modal" id="editItem" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Item</h5>
                </div>
                <div class="modal-body">
                    <form class="form-group">
                        <label for="editItemName">Item Name</label>
                        <input class="form-control" id="editItemName" name="editItemName" value="" readonly>
                        <label for="editItemPrice">Item Price</label>
                        <input class="form-control" id="editItemPrice" name="editItemPrice" value="" type="number">
                        <label for="editItemNote">Notes</label>
                        <input class="form-control" id="editItemNote" name="editItemNote" value="" type="text">
                    </form>
                </div>
                <div class="modal-footer">
                    <a>
                        <button type="button" class="btn btn-success" id="submitEditItem">Submit</button>
                    </a>
                    &nbsp;
                    <a>
                        <button type="button" class="btn btn-secondary" id="closeEditItem">Close</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once __DIR__."/footer.php";
?>