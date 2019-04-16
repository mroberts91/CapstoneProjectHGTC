<?php
use Connection\Connection;
use Core\GeoManager;
use Core\Location;
use Customer\CustomerManager;
use Customer\NewCustomer;

require_once __DIR__."/header.php";
require_once __DIR__."/../Data/dto/State.php";
require_once __DIR__."/../Data/managers/GeoManager.php";
require_once __DIR__."/../Data/managers/CustomerManager.php";
require_once __DIR__."/../Data/dto/NewCustomer.php";
require_once __DIR__."/../Data/enum/Location.php";

$errormsg = '';
$postSuccess = false;
$postError = false;

try{
    $db = new Connection();
    $geoManager = new GeoManager($db);
    $states = $geoManager->getAllStates();
} catch (Exception $e){
    $errormsg = $e->getMessage();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    if (!isset($_POST['lastname'])){$errormsg .= '<p>Last Name is Required</p>'; }
    if (!isset($_POST['email'])){$errormsg .= '<p>Email is Required</p>'; }
    if(!isset($_POST['password'])){$errormsg.= '<p>Password is Required</p>';}

    if ($errormsg == ''){
        try {
            $lname = trim($_POST['lastname']);
            $email = trim(strtolower($_POST['email']));
            $password = trim($_POST['password']);
            $fname = isset($_POST['firstname'])? $_POST['firstname'] : null;
            $addr = isset($_POST['address'])? $_POST['address'] : null;
            $city = isset($_POST['city'])? $_POST['city'] : null;
            $state = isset($_POST['state'])? $_POST['state'] : null;
            $zip = isset($_POST['zip'])? $_POST['zip'] : null;
            $location = isset($_POST['location'])? $_POST['location'] : null;

            $db = new Connection();
            $cm = new CustomerManager($db);
            $newCust = new NewCustomer($lname, $email, $fname, $addr, $city, $state, $zip, $location);
            if ($cm->createNewCustomer($newCust)) {
                $postSuccess = true;
                $postError = false;
            }
        }catch (\Exception $e){
            $errormsg .= "<p>".$e->getMessage()."</p>";
            $postError = true;
        }
    }else{
        $postError = true;
    }

}
?>
<link rel="stylesheet" type="text/css" href="styles/create-customer.css">
<br>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h1 class="text-center">Create Your Account</h1>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="form-group">
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                    <label for="firstname">First Name</label>
                    <input class="form-control" id="firstname" name="firstname" type="text" >
                    <label for="lastname">Last Name</label>
                    <input class="form-control" id="lastname" name="lastname" type="text" >
                    <label for="password">Password</label>
                    <label for="showPassword">Show Password </label>
                    <input type="checkbox" id="showPassword" onclick="myFunction()">
                    <br>
                    <label for="email">Email</label>
                    <input class="form-control" id="email" name="email" type="email" >
                    <label for="address">Address</label>
                    <input class="form-control" id="address" name="address" type="text">
                    <label for="city">City</label>
                    <input class="form-control" id="city" name="city" type="text" >
                    <label for="state">State</label>
                    <select class="form-control" id="state" name="state">
                        <option value="">Select a State</option>
                        <?php
                        foreach ($states as $s) {
                            echo '<option value="'.$s->getIdState().'" >'. $s->getName().'</option>';
                        }
                        ?>
                    </select>
                    <label for="zip">Zip Code</label>
                    <input class="form-control" id="zip" name="zip" type="number" placeholder="12345">
                    <label for="location">Prefer Location</label>
                    <select class="form-control" id="location" name="location">
                        <option value="<?php echo (int)Location::$NMB?>">North Myrtle Beach</option>
                        <option value="<?php echo (int)Location::$MYRTLE?>">Myrtle Beach</option>
                        <option value="<?php echo (int)Location::$CONWAY?>">Conway</option>
                        <option value="<?php echo (int)Location::$SURFSIDE?>">Surfside</option>
                        <option value="<?php echo (int)Location::$MI?>">Murrells Inlet</option>
                    </select>
                    <br>
                    <input class="btn btn-danger" type="submit" name="newCustSubmit">
                    <br>
                    <br>
                    <p>Already have an account?</p>
                    <a href="login.php"><button class="btn btn-danger" type="button">Return to Login</button> </a>
                </form>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<div class="modal fade" id="newCustomerSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="modal-body">
                <p>New Customer was created successfully!</p>
            </div>
            <div class="modal-footer">
                <a href="index.php"><button type="button" class="btn btn-secondary">Close</button></a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="newCustomerError" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
require_once __DIR__."/footer.php";
if ($postError){
    echo "<script src='js/customer/createCustomerError.js'></script>";
}
if ($postSuccess){
    echo "<script src='js/customer/createCustomerSuccess.js'></script>";
}
?>
