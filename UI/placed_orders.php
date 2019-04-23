<?php

use Connection\Connection;
use Orders\OrderManager;
require_once __DIR__."/header.php";
require_once __DIR__."/../Data/managers/OrderManager.php";

$orderNumber = $_GET['id'];
try {
    $om = new OrderManager(new Connection());
    $order = $om->getCustomerOrder($orderNumber);
    $orderItems = $om->getAllItemsByOrder($orderNumber);
} catch (Exception $e) {
    die($e->getMessage());
}
?>
<style>
    .flex-center{
        display: flex;
        justify-content: center;
    }
    .order-items{
        width: 50%;

    }
    .right{
        float:  right;
    }
    .overall-container{
        width 95%;
    }
    .overall-container table{
        width: 45%;
    }
</style>
<br>
<h2 class="text-center">Order #<?php echo $orderNumber?> has been placed.</h2>
<br>
<div class="flex-center">
    <div class="order-items">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Item Name</th>
                    <th scope="col">Item Price</th>
                    <th scope="col">Notes</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($orderItems as $o) {
                    echo '<tr>';
                    echo '<td scope="row">'.$o->getName().'</td>';
                    echo '<td>$'.number_format($o->getItemPrice(), 2).'</td>';
                    echo '<td colspan="2">'.$o->getNotes().'</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <br>
        <div class="overall-container">
        <table>
            <tbody>
                <tr><th>Expected Pickup Time</th><td class="right" colspan="2"><?php echo date('m-d-Y H:i A', $order->getDateReady()->getTimestamp()); ?></td></tr>
                <tr><th>Number of Items</th><td class="right" colspan="2"><?php echo $order->getOrderItemCount(); ?></td></tr>
                <tr><th>Subtotal</th><td class="right" colspan="2">$<?php echo number_format($order->getSubtotal(), 2);?></td></tr>
                <tr><th>Grand Total</th><td class="right"  colspan="2">$<?php echo number_format($order->getGrandTotal(), 2);?></td></tr>
            </tbody>
        </table>
        </div>
    </div>
</div>
<?php
require_once __DIR__."/footer.php";
?>
