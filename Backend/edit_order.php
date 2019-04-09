<?php

use Connection\Connection;
use Core\OrderStatus;
use Menu\MenuManager;
use Menu\MenuItem;
use Orders\OrderItem;
use Orders\OrderManager;

require_once __DIR__ . "/includes/header.php";
require_once __DIR__."/../Data/managers/MenuManager.php";
require_once __DIR__."/../Data/managers/OrderManager.php";
require_once __DIR__."/../Data/dto/MenuItem.php";
require_once __DIR__."/../Data/dto/OrderItem.php";
require_once __DIR__."/../Data/enum/OrderStatus.php";
$mm = null;
$orderNumber = (isset($_GET['id']))? (int)$_GET['id'] : 'Not Present';
$errormsg = '';
$presentItems = null;
try{
    $db = new Connection();
    $mm = new MenuManager($db);

}catch (\Exception $e){

}
try{
    $db = new Connection();
    $om = new OrderManager($db);
    $presentItems = $om->getAllItemsByOrderIdForUI($orderNumber);

}catch (\Exception $e){

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
                array_push($itemsToSave, $newItem);
            }
            $orderManager->updateOrderStatus(OrderStatus::$OPEN, $orderNumber);
            $orderManager->addItemsToOrder($itemsToSave, $orderNumber);
            $subtotal = $orderManager->getOrderSubtotal($orderNumber);
            $orderManager->updateOrderGrandTotal($orderNumber, $subtotal);
            echo '<script>window.location = "your_orders.php"</script>';

        }
        if (isset($_POST['completeOrder'])) {
            print_r(json_decode($_POST['itemsToComplete']));

            die('Complete');
        }
    } catch (\Exception $e){
        die($e->getMessage());
    }
}
?>
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
        <button class="btn btn-primary optionButton" type="submit" name="saveOrder">Save Order</button>
    </form>
    <form action="<?php echo $_SERVER['PHP_SELF'] . '?id='.$orderNumber; ; ?>" method="POST">
        <input type="text" value="" id="itemsToComplete" name="itemsToComplete" hidden>
        <button class="btn btn-success optionButton" type="submit" name="completeOrder">Complete Order</button>
    </form>
</div>
<br>
<div class="row">
    <div class="col-md-12 col-xl-12">
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
                $apps = $mm->GetAllByCatagory(10);
                foreach ($apps as $a){
                    echo '<div class="btn btn-secondary col-md-3 menuItem appItem" id="'.$a->getIdMenuItem().'"  price="'.$a->getPrice().'" item="'.$a->getName().'">';
                    echo '<p>'.$a->getShortName().'</p>';
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
                $meals = $mm->GetAllByCatagory(20);
                foreach ($meals as $a){
                    echo '<div class="btn btn-secondary col-md-3 menuItem entreeItem" id="'.$a->getIdMenuItem().'"  price="'.$a->getPrice().'" item="'.$a->getName().'">';
                    echo '<p>'.$a->getShortName().'</p>';
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
                $desserts = $mm->GetAllByCatagory(30);
                foreach ($desserts as $a){
                    echo '<div class="btn btn-secondary col-md-3 menuItem dessertItem" id="'.$a->getIdMenuItem().'" price="'.$a->getPrice().'" item="'.$a->getName().'">';
                    echo '<p>'.$a->getShortName().'</p>';
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
                $drinks = $mm->GetAllByCatagory(40);
                foreach ($drinks as $a){
                    echo '<div class="btn btn-secondary col-md-3 menuItem bevItem" id="'.$a->getIdMenuItem().'" price="'.$a->getPrice().'" item="'.$a->getName().'">';
                    echo '<p>'.$a->getShortName().'</p>';
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
</div>
<br>
<div id="order-items-container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Item Name</th>
                <th scope="col">Item Price</th>
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
<br>
<div id="badOptions">
    <button class="btn btn-danger optionButton">Cancel Order</button>
</div>
<?php
echo $errormsg;
require_once __DIR__ . "/includes/footer.php";
?>