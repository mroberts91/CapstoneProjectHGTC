<?php

use Connection\Connection;
use Core\State;
use Core\GeoManager;
use Core\Department;
use Employee\EmployeeManager;
use Employee\NewEmployee;
use Menu\MenuManager;
use Orders\OrderManager;

require_once __DIR__."/includes/header.php";
require_once __DIR__."/../Data/managers/OrderManager.php";
$errormsg = '';
$postSuccess = false;
$items = null;
try{
    $db = new Connection();
    $mm = new OrderManager($db);
    $items = $mm->getAllCompletedOrders();
} catch (Exception $e){
    $errormsg = $e->getMessage();
}
?>
<h1 class="text-center">Completed Order Report</h1>
<br>
<div class="row">
    <div class="col-md-1 col-lg-2"></div>
    <div class="col-md-10 col-lg-8">
        <table id="example" class="display" style="width:100%">
            <thead>
            <tr>
                <th>Order #</th>
                <th>Employee</th>
                <th>Item Count</th>
                <th>Date Created</th>
                <th>Grand Total</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($items as $i){
                $created = ($i->getCreated() == null)? "N/A": date("m-d-Y H:i A", $i->getCreated()->getTimestamp());
                echo '<tr>';
                echo '<th>'.$i->getIdOrder().'</th>';
                echo '<td>'.$i->getEmpFirstname() .' '.$i->getEmpLastname().'</td>';
                echo '<td>'.$i->getOrderItemCount().'</td>';
                echo '<td>'.$created.'</td>';
                echo '<td>$'.number_format($i->getGrandTotal(), 2).'</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>

    <div class="col-md-1 col-lg-2"></div>

</div>
<?php
require_once __DIR__."/includes/footer.php";
echo '<script src="js/employee/manageEmployees.js"></script>'
?>
