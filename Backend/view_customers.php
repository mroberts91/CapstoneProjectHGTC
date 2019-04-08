<?php

use Connection\Connection;
use Employee\EmployeeManager;

require_once __DIR__."/includes/header.php";
require_once __DIR__."/../Data/dto/State.php";
require_once __DIR__."/../Data/managers/GeoManager.php";
require_once __DIR__."/../Data/enum/Department.php";
require_once __DIR__."/../Data/managers/CustomerManager.php";
require_once __DIR__."/../Data/dto/NewEmployee.php";
$errormsg = '';
$postSuccess = false;
try{
    $db = new Connection();
    $custManager = new \Customer\CustomerManager($db);
    $custs = $custManager->getAllCustomersForManagment();
} catch (Exception $e){
    $errormsg = $e->getMessage();
}
?>
<h1 class="text-center">Customer List</h1>
<br>
<div class="row">
    <div class="col-md-12">
        <table id="example" class="display" style="width:100%">
            <thead>
            <tr>
                <th>Customer ID #</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Prefered<br>Location</th>
                <th>Email</th>
                <th>State</th>
                <th>Zip</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($custs as $cust){
                echo '<tr>';
                echo '<th>'.$cust->getIdCustomer().'</th>';
                echo '<td>'.$cust->getLastname().'</td>';
                echo '<td>'.$cust->getFirstname().'</td>';
                echo '<td>'.$cust->getLocationName().'</td>';
                echo '<td>'.$cust->getEmail().'</td>';
                echo '<td>'.$cust->getState().'</td>';
                echo '<td>'.$cust->getZip().'</td>';
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
