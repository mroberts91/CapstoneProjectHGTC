<?php

use Connection\Connection;
use Orders\OrderManager;

require_once __DIR__."/includes/header.php";
require_once __DIR__."/../Data/managers/OrderManager.php";
require_once __DIR__."/../Data/dto/Order.php";
$errormsg = '';
$postSuccess = false;
try{
    $userID = $_SESSION['user_id'];
    $db = new Connection();
    $orderManager = new OrderManager($db);
    $orders = $orderManager->getAllOpenOrders();
} catch (Exception $e){
    $errormsg = $e->getMessage();
}
?>
<br>
<div class="row">
    <div class="col-xl-2 d-none d-xl-block"></div>
    <div class="col-md-10 col-xl-8">
        <h1 class="text-center">All Open Orders</h1>
    </div>
    <div class="col-md-2 col-xl-2">
        <button class="btn btn-success" id="newOrderButton" >Create New Order</button>
        <script>
            $('#newOrderButton').on('click', function () {
                window.location = "create_new_order.php";
            })
        </script>
    </div>


</div>
<br>
<div class="row">
    <div class="col-md-12">
        <table id="example" class="display" style="width:100%">
            <thead>
            <tr>
                <th>Order ID #</th>
                <th>Employee</th>
                <th>Table #</th>
                <th>Subtotal</th>
                <th>GrandTotal</th>
                <th>Item Count</th>
                <th>OrderStatus</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($orders as $o){
                echo '<tr>';
                echo '<th>'.$o->getIdOrder().'</th>';
                echo '<td>'.$o->getEmpFirstname().' '. $o->getEmpLastname().'</td>';
                echo '<td>'.$o->getTableNumber().'</td>';
                echo '<td>'.$o->getSubtotal().'</td>';
                echo '<td>'.$o->getGrandTotal().'</td>';
                echo '<td>'.$o->getOrderItemCount().'</td>';
                echo '<td>'.$o->getOrderStatus().'</td>';
                echo '<th><a href="edit_order.php?id='.$o->getIdOrder().'">Edit</a></th>';
                echo '<th><a href="complete_order.php?id='.$o->getIdOrder().'">Complete Order</a></th>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<?php
require_once __DIR__."/includes/footer.php";
echo '<script src="js/employee/manageEmployees.js"></script>'
?>
