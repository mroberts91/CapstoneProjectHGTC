<?php

use Connection\Connection;
use Core\Department;
use Core\GeoManager;
use Employee\Employee;
use Employee\EmployeeManager;

require_once __DIR__."/includes/header.php";
require_once __DIR__."/../Data/managers/EmployeeManager.php";
require_once __DIR__."/../Data/dto/Employee.php";
require_once __DIR__."/../Data/enum/Location.php";
require_once __DIR__."/../Data/enum/Department.php";
require_once __DIR__."/../Data/managers/GeoManager.php";
$errormsg = '';
$empID =  (isset($_GET['id']) && !empty($_GET['id'])) ? $_GET['id'] : $_SESSION['user_id'];
if ($empID != $_SESSION['user_id'] && !$isAdmin) {
    echo "<script>window.location = 'index.php'</script>";
}
$postError = false;
$postSuccess = false;
try{
    $db = new Connection();
    $geoManager = new GeoManager($db);
    $states = $geoManager->getAllStates();
} catch (Exception $e){
    $errormsg = $e->getMessage();
}
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
//    if (!isset($_GET['id']) || $_GET['id'] != $custID){echo"<script>window.location = 'login.php'</script>"; }
    try {
        $db = new Connection();
        $em = new EmployeeManager($db);
        $model = $em->getFullEmployeeById($empID);
        $name = ($model->getFirstname() != null && $model->getLastname() != null ) ? $model->getFirstname() .' '. $model->getLastname() : null;
    } catch (\Exception $e) {
        $errormsg .= '<p>'.$e->getMessage().'</p>';
        $postError = true;
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    try {
        $db = new Connection();
        $em = new EmployeeManager($db);
        $model = $em->getFullEmployeeById($empID);
        $name = ($model->getFirstname() != null && $model->getLastname() != null ) ? $model->getFirstname() .' '. $model->getLastname() : null;
        if (!isset($_POST['lastname']) || empty($_POST['lastname'])){$errormsg .= '<p>Last Name is Required</p>'; }

        if ($errormsg == ''){
            try {
                $lname = trim($_POST['lastname']);
                $email = trim(strtolower($_POST['email']));
                $fname = isset($_POST['firstname'])? $_POST['firstname'] : null;
                $addr = isset($_POST['address'])? $_POST['address'] : null;
                $city = isset($_POST['city'])? $_POST['city'] : null;
                $state = isset($_POST['state'])? $_POST['state'] : null;
                $zip = isset($_POST['zip'])? $_POST['zip'] : null;
                $dept = $_POST['dept'];

                $db = new Connection();
                $em = new EmployeeManager($db);
                $gm = new GeoManager($db);
                $employee = new Employee();
                $employee->buildFromParameters($empID, $dept, $fname, $lname,
                    $addr, $city, $state, $zip, $model->getEmail());
                if ($em->updateEmployee($employee)) {
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
    } catch (\Exception $e) {
        $errormsg .= '<p>'.$e->getMessage().'</p>';
        $postError = true;
    }
}

?>
    <link rel="stylesheet" type="text/css" href="styles/employeeProfile.css">
    <br>
    <h1 class="title text-center"><?php $displayName = ($name != null)?  $name : 'Your Profile'; echo $displayName?> </h1>
    <br>
    <div class="container">
        <form class="form-group" action="<?php echo $_SERVER['PHP_SELF']. '?id='. $empID; ?>" method="post">
            <div class="row">
                <div class="col-md-12 col-lg-5 profile-group">
                    <h3 class="text-center">Employee Name</h3>
                    <label for="firstname">First Name:</label>
                    <input class="form-control" type="text" name="firstname" id="firstname"
                           value="<?php if ($model->getFirstname()!= null) echo $model->getFirstname(); ?>">
                    <label for="lastname">Last Name:</label>
                    <input class="form-control" type="text" name="lastname" id="lastname"
                           value="<?php echo $model->getLastname(); ?>">
                    <br>
                    <br>
                    <h3 class="text-center">Department</h3>
                    <select class="form-control" id="dept" name="dept" <?php if(!$isAdmin){ echo 'readonly'; } ?>>
                        <option value="<?php echo (int)Department::$ADMIN ?>"
                            <?php if ($model->getIdDepartment() != null && $model->getIdDepartment() == (int)Department::$ADMIN){ echo 'selected'; } ?>
                            >Administrator</option>
                        <option value="<?php echo (int)Department::$MANAGER ?>"
                            <?php if ($model->getIdDepartment() != null && $model->getIdDepartment() == (int)Department::$MANAGER){ echo 'selected'; } ?>
                            >Manager</option>
                        <option value="<?php echo (int)Department::$WAITSTAFF ?>"
                            <?php if ($model->getIdDepartment() != null && $model->getIdDepartment() == (int)Department::$WAITSTAFF){ echo 'selected'; } ?>
                            >Wait Staff</option>
                        <option value="<?php echo (int)Department::$KITCHEN ?>"
                            <?php if ($model->getIdDepartment() != null && $model->getIdDepartment() == (int)Department::$KITCHEN){ echo 'selected'; } ?>
                            >Kitchen Staff</option>
                        <option value="<?php echo (int)Department::$SUPPORT ?>"
                            <?php if ($model->getIdDepartment() != null && $model->getIdDepartment() == (int)Department::$SUPPORT){ echo 'selected'; } ?>
                            >Support Staff</option>
                    </select>
                </div>
                <div class="col-lg-1 d-none d-lg-block"></div>
                <div class="col-md-12 col-lg-5 profile-group">
                    <h3 class="text-center">Address</h3>
                    <label for="address">Street Address:</label>
                    <input class="form-control" type="text" name="address" id="address"
                           value="<?php if ($model->getAddress()!= null) echo $model->getAddress(); ?>">
                    <label for="city">City:</label>
                    <input class="form-control" type="text" name="city" id="city"
                           value="<?php if ($model->getCity()!= null) echo $model->getCity(); ?>">
                    <label for="state">State:</label>
                    <select class="form-control" id="state" name="state">
                        <option value="XX">Select a State</option>
                        <?php
                        foreach ($states as $s) {
                            $selected = '';
                            if($model->getState()!= null && $model->getState() == $s->getIdState()){
                                $selected = 'selected';
                            }
                            echo '<option value="'.$s->getIdState().'" '.$selected.'>'. $s->getName().'</option>';
                            $selected = '';
                        }
                        ?>
                    </select>
                    <label for="zip">Zip Code:</label>
                    <input class="form-control" type="text" name="zip" id="zip"
                           value="<?php if ($model->getZip()!= null) echo $model->getZip(); ?>">
                    <br><br>
                    <button class="btn btn-primary" type="submit" name="profileSubmit" id="profileSubmit"><i class="fa fa-check-circle" aria-hidden="true"> </i> Submit</button>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="profileSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>The Employee information was successfully updated!</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo $_SERVER['PHP_SELF'] . '?id='. $empID; ?> "><button type="button" class="btn btn-secondary">Close</button></a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="profileError" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
    <div class="modal fade" id="permDenied" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Please contact your Administrator/Manager to access that page.</p>
                </div>
                <div class="modal-footer">
                    <a href="index.php"><button type="button" class="btn btn-secondary">Close</button></a>
                </div>
            </div>
        </div>
    </div>
<?php
require_once __DIR__."/includes/footer.php";
if ($postError){
    echo "<script src='js/employee/profileError.js'></script>";
}
if ($postSuccess){
    echo "<script src='js/employee/profileSuccess.js'></script>";
}

?>