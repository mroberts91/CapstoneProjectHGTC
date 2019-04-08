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
    $empManager = new EmployeeManager($db);
    $emps = $empManager->getAllEmployeesForUserList();
} catch (Exception $e){
    $errormsg = $e->getMessage();
}
?>
<h1 class="text-center">Employee Management</h1>
<br>
<div class="row">
    <div class="col-md-1 col-lg-2"></div>
    <div class="col-md-10 col-lg-8">
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Employee ID #</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Department</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($emps as $emp){
                        echo '<tr>';
                        echo '<th>'.$emp->getIdEmployee().'</th>';
                        echo '<td>'.$emp->getLastname().'</td>';
                        echo '<td>'.$emp->getFirstname().'</td>';
                        echo '<td>'.$emp->getDepartmentName().'</td>';
                        echo '<td>'.$emp->getEmail().'</td>';
                        echo '<th><a href="employee_profile.php?id='.$emp->getIdEmployee().'">Edit</a></th>';
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
