<?php

use Connection\Connection;
use Core\State;
use Core\GeoManager;
use Core\Department;
use Employee\EmployeeManager;
use Employee\NewEmployee;

require_once __DIR__."/includes/header.php";
require_once __DIR__."/../Data/dto/State.php";
require_once __DIR__."/../Data/managers/GeoManager.php";
require_once __DIR__."/../Data/enum/Department.php";
require_once __DIR__."/../Data/managers/EmployeeManager.php";
require_once __DIR__."/../Data/dto/NewEmployee.php";
$errormsg = '';
$postSuccess = false;
try{
    $db = new Connection();
    $geoManager = new GeoManager($db);
    $states = $geoManager->getAllStates();
} catch (Exception $e){
    $errormsg = $e->getMessage();
    // TODO Add Error Modal to indicate error
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // TODO Empty Checks on req post values
    //TODO NEED!!! to implement email check when creating new emp or customer!!!!!
    if (!isset($_POST['lastname'])){$errormsg = '<p>Last Name is Required</p>'; }
    if (!isset($_POST['dept'])){$errormsg = '<p>Department is Required</p>'; }
    if (!isset($_POST['email'])){$errormsg = '<p>Email is Required</p>'; }
    if(!isset($_POST['password'])){$errormsg.= '<p>Password is Required</p>';}
    $lname = trim($_POST['lastname']);
    $dept = $_POST['dept'];
    $email = strtolower($_POST['email']);
    $password = trim($_POST['password']);

    $fname = isset($_POST['firstname'])? $_POST['firstname'] : null;
    $addr = isset($_POST['address'])? $_POST['address'] : null;
    $city = isset($_POST['city'])? $_POST['city'] : null;
    $state = isset($_POST['state'])? $_POST['state'] : null;
    $zip = isset($_POST['zip'])? $_POST['zip'] : null;

    if ($errormsg == ''){
        try {
            $db = new Connection();
            $em = new EmployeeManager($db);
            $newEmp = new NewEmployee($dept, $lname,$email, $password, $fname, $addr, $city, $state, $zip);
            if ($em->createNewEmployee($newEmp)){
                $postSuccess = true;
            }
        } catch (Exception $e) {
            $errormsg .= "<p>".$e->getMessage()."</p>";
            $postError = true;
        }
    }
}
?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <h1 class="text-center">Create New Employee</h1>
    </div>
    <div class="col-md-3"></div>
</div>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="form-group">
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <label for="dept">Department</label>
                <select class="form-control" id="dept" name="dept">
                    <option value="<?php echo (int)Department::$ADMIN ?>">Administrator</option>
                    <option value="<?php echo (int)Department::$MANAGER ?>">Manager</option>
                    <option value="<?php echo (int)Department::$WAITSTAFF ?>">Wait Staff</option>
                    <option value="<?php echo (int)Department::$KITCHEN ?>">Kitchen Staff</option>
                    <option value="<?php echo (int)Department::$SUPPORT ?>">Support Staff</option>
                </select>
                <label for="firstname">First Name</label>
                <input class="form-control" id="firstname" name="firstname" type="text">
                <label for="lastname">Last Name</label>
                <input class="form-control" id="lastname" name="lastname" type="text">
                <label for="password">Password</label>
                <input class="form-control" id="password" name="password" type="password">
                <label for="showPassword">Show Password </label>
                <input type="checkbox" id="showPassword" onclick="myFunction()">
                <br>
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
<div class="modal fade" id="newEmpError" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error</h5>
            </div>
            <div class="modal-body"><?php echo $errormsg ?>
            </div>
            <div class="modal-footer">
                <a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </a>
            </div>
        </div>
    </div>
</div>
<script> function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }</script>
<?php
require_once __DIR__."/includes/footer.php";
if ($postError){
    echo '<script src="js/employee/empCreateError.js"></script>';
}
if ($postSuccess){
    echo '<script src="js/employee/empCreateSuccess.js"></script>';
}
?>
