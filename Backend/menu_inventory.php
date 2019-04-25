<?php

use Connection\Connection;
use Core\State;
use Core\GeoManager;
use Core\Department;
use Employee\EmployeeManager;
use Employee\NewEmployee;
use Menu\MenuManager;

require_once __DIR__."/includes/header.php";
require_once __DIR__."/../Data/managers/MenuManager.php";
$errormsg = '';
$postSuccess = false;
$items = null;
try{
    $db = new Connection();
    $mm = new MenuManager($db);
    $items = $mm->getItemsForInventory();
} catch (Exception $e){
    $errormsg = $e->getMessage();
}
?>
<style>
    .fa-thumbs-down{
        color: red;
    }
</style>
<h1 class="text-center">Inventory Report</h1>
<br>
<div class="row">
    <div class="col-md-1 col-lg-2"></div>
    <div class="col-md-10 col-lg-8">
        <table id="example" class="display" style="width:100%">
            <thead>
            <tr>
                <th>Item Name</th>
                <th>Category</th>
                <th>Inventory</th>
                <th>Low Stock</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($items as $i){
                $isLowBool = ($i->getisLow() == 1)? "low" : "";
                $isLowStr = ($i->getisLow() == 1)? "<i class=\"fa fa-thumbs-down\" aria-hidden=\"true\"></i>" : "";
                echo '<tr class="'.$isLowBool.'">';
                echo '<th>'.$i->getItemName().'</th>';
                echo '<td>'.$i->getCategoryName().'</td>';
                echo '<td>'.$i->getInventory().'</td>';
                echo '<td>'.$isLowStr.'</td>';
//                echo '<th><a href="manageMenuItem.php">Update</a></th>';
                echo '<th><a href="edit_menu_item.php?id='.$i->getIdMenuItem().'">Update</a></th>';
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
