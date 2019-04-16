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
$orderNumber = (isset($_GET['id']))? (int)$_GET['id'] : null;
$errormsg = '';
try{
    if ($orderNumber == null){
        echo '<script>window.location = "index.php"</script>';
    }
    $db = new Connection();
    $om = new OrderManager($db);
    $om->updateOrderStatus(OrderStatus::$FOODMADE, $orderNumber);
    $om->updateInventoryForOrder($orderNumber);
    echo '<script>window.location = "total_make_list.php"</script>';


}catch (\Exception $e){
    die($e->getMessage());
}
