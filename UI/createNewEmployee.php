<?php
use Connection\Connection;
use Employee\EmployeeManager;
use Employee\NewEmployee;
use Core\Department;
require_once __DIR__."/../Data/init.php";
require_once __DIR__."/../Data/db/Connection.php";
require_once __DIR__."/../Data/managers/EmployeeManager.php";
require_once __DIR__."/../Data/dto/NewEmployee.php";
require_once __DIR__."/../Data/enum/Department.php";

try{
    // Create a new PDO Connection for injecting to the Manager
    $db = new Connection();
    $em = new EmployeeManager($db);
    $a = new NewEmployee(Department::$KITCHEN, "Robertson", "test@test.com", "Michelle");
    $em->createNewEmployee($a);
    echo 'New Employee Created with Temp Password<br><br>';
    print_r($a);
    echo '<br><br>';
    var_dump($a);
//    // Create a new manager that querys the  DB
//    $mm = new MenuManager($db);
//    // Returns and array of MenuItem DTO objects
//    $q = $mm->GetAllMenuItems();
//    echo '<br><br>';
} catch (Exception $e){
    die($e->getMessage());
}

// Echo each object as human readable data.
?>
<!--<h1>PipelinesTest</h1>-->
<!--<table border>-->
<!--    <thead>-->
<!--    <tr>-->
<!--        <th>Id</th>-->
<!--        <th>Name</th>-->
<!--        <th>Price</th>-->
<!--        <th>Catagory</th>-->
<!--    </tr>-->
<!--    </thead>-->
<!--    <tbody>-->
<!--    --><?php
//    foreach ($q as $menuItem){
//        echo '<tr>';
//        echo '<td>'.$menuItem->getID()."</td>";
//        echo '<td>'.$menuItem->getName()."</td>";
//        echo '<td>'.$menuItem->getPrice()."</td>";
//        echo '<td>'.$menuItem->getCatagory()."</td>";
//        echo "</tr>";
//    }
//    ?>
<!--    </tbody>-->
<!--</table>-->
<?php

?>
