<?php

use Connection\Connection;

use Core\GeoManager;

use Customer\CustomerManager;
use Customer\NewCustomer;


require_once __DIR__."/includes/header.php";
require_once __DIR__."/../Data/dto/State.php";
require_once __DIR__."/../Data/managers/GeoManager.php";
require_once __DIR__."/../Data/enum/Department.php";
require_once __DIR__."/../Data/managers/EmployeeManager.php";
require_once __DIR__."/../Data/dto/NewEmployee.php";
require_once __DIR__."/includes/header.php";

$errormsg ='';
$postSuccess = false;

try{
    $db = new Connection();
    $geoManager = new GeoManager($db);
    $states = $geoManager->getAllStates();
} catch (Exception $e){
    $errormsg = $e->getMessage();
}
if ($_SERVER['Request_Method'] == 'POST'){

    if (!isset($_POST['lastname'])){$errormsg = '<p>Last Name is Required</p>'; }
    if (!isset($_POST['dept'])){$errormsg = '<p>Department is Required</p>'; }
    if (!isset($_POST['email'])){$errormsg = '<p>Email is Required</p>'; }
    $lname = trim($_POST['lastname']);
    $dept = $_POST['dept'];
    $email = $_POST['email'];
    $fname = isset($_POST['firstname'])? $_POST['firstname'] : null;
    $addr = isset($_POST['address'])? $_POST['address'] : null;
    $city = isset($_POST['city'])? $_POST['city'] : null;
    $state = isset($_POST['state'])? $_POST['state'] : null;
    $zip = isset($_POST['zip'])? $_POST['zip'] : null;

    if ($errormsg == ''){
        try {
            $db = new Connection();
            $cm = new CustomerManager($db);
            $newCust = new NewCustomer($fname, $lname, $addr, $city, $state, $zip, $email);
            if ($cm->createNewCustomer($newCust)) {
                $postSuccess = true;
            }
        }catch (Exception $e){
        }
    }
}
?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <h1 class="text-center">Create New Customer</h1>
    </div>
    <div class="col-md-3"></div>
</div>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="form-group">
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <label for="firstname">First Name</label>
                <input class="form-control" id="firstname" name="firstname" type="text">
                <label for="lastname">Last Name</label>
                <input class="form-control" id="lastname" name="lastname" type="text">
                <label for="email">Email</label>
                <input class="form-control" id="email" name="email" type="text">
                <label for="address">Address</label>
                <input class="form-control" id="address" name="address" type="text">
                <label for="city">City</label>
                <input class="form-control" id="city" name="city" type="text">
                <label for="state">State</label>
                <select class="form-control" id="state" name="state">
                    <option value="XX">Select a State</option>
                    <?php
                    foreach ($states as $s) {
                        echo '<option value="'.$s->getIdState().'" >'. $s->getName().'</option>';
                    }
                    ?>
                </select>
                <label for="zip">Zip Code</label>
                <input class="form-control" id="zip" name="zip" type="number">
                <br>
                <input class="btn btn-primary" type="submit" name="newEmpSubmit">
            </form>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
<div class="modal fade" id="newEmpSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="modal-body">
                <p>New Employee was created successfully!</p>
            </div>
            <div class="modal-footer">
                <a href="index.php"><button type="button" class="btn btn-secondary">Close</button></a>
            </div>
        </div>
    </div>
</div>
<?php
require_once __DIR__."/includes/footer.php";
?>
