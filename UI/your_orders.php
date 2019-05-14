<?php

use Connection\Connection;
use Core\DayOfWeek;
use Orders\OrderManager;
use Schedule\ReserauntSchedule;
use Schedule\ScheduleManager;

require_once __DIR__."/header.php";
require_once __DIR__."/../Data/managers/OrderManager.php";
require_once __DIR__."/../Data/dto/Order.php";
require_once __DIR__."/../Data/dto/ReserauntSchedule.php";
require_once __DIR__."/../Data/managers/ScheduleManager.php";
require_once __DIR__."/../Data/enum/DayOfWeek.php";
$errormsg = '';
$postSuccess = false;
$customer = $_SESSION['customer_id'];
$canOrder = false;
try{
    $userID = $_SESSION['user_id'];
    $db = new Connection();
    $orderManager = new OrderManager($db);
    $sm = new ScheduleManager($db);
    $schedule = $sm->getRestrauntSchedule();
    $orders = $orderManager->getAllCustomerOrdersByCustID($customer);
    $canOrder = (in_array($schedule->getCurrentDayOfWeek(), DayOfWeek::openArray())) &&
                (time() > $schedule->getOpenTime()) && (time() < ($schedule->getCloseTime() - 3600));
} catch (Exception $e){
    $errormsg = $e->getMessage();
}
var_dump($canOrder);
?>
    <br>
    <div class="container">
        <div class="row" <?php if($canOrder) echo 'hidden'; ?>>
            <div class="col-md-1 col-xl-2"></div>
            <div class="col-md-10 col-xl-8">
                <div class="alert alert-warning text-center" role="alert">
                    Online Orders are not available at this time.<br>
                    Our hours for online ordering are from <strong>4pm - 1am</strong>.
                </div>
            </div>
            <div class="col-md-1 col-xl-2"></div>
        </div>
        <div class="row">
            <div class="col-xl-2 d-none d-xl-block"></div>
            <div class="col-md-10 col-xl-8">
                <h1 class="text-center">Your Placed Orders</h1>
            </div>
            <div class="col-md-2 col-xl-2">
                <div class="btnContainer" <?php if(!$canOrder) echo 'hidden'; ?>>
                <button class="btn btn-success" id="newOrderButton">Create New Order</button>
                <script>
                    $('#newOrderButton').on('click', function () {
                        window.location = "create_online_order.php";
                    })
                </script>
                </div>
            </div>


        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <table id="example" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>Order ID #</th>
                        <th>Subtotal</th>
                        <th>GrandTotal</th>
                        <th>Item Count</th>
                        <th>OrderStatus</th>
                        <th>Pickup Time</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($orders as $o) {
                        $pickup = ($o->getDateReady() == null) ? 'N/A' : date("m-d-Y H:i A", $o->getDateReady()->getTimestamp());
                        echo '<tr>';
                        echo '<th>' . $o->getIdOrder() . '</th>';
                        echo '<td>$' . $o->getSubtotal() . '</td>';
                        echo '<td>$' . $o->getGrandTotal() . '</td>';
                        echo '<td>' . $o->getOrderItemCount() . ' Items</td>';
                        echo '<td>' . $o->getOrderStatus() . '</td>';
                        echo '<td>' . $pickup . '</td>';
                        echo '<th><a href="placed_orders.php?id=' . $o->getIdOrder() . '">View Order Details</a></th>';
                        echo '</tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
require_once __DIR__."/footer.php";
echo '<script src="../Backend/js/employee/manageEmployees.js"></script>'
?>
