<?php

use Connection\Connection;
use Menu\MenuManager;

require_once __DIR__."/includes/header.php";
require_once __DIR__."/../Data/managers/MenuManager.php";
//DATABASE CONNECTION
require_once "conn.php";
$catagories = null;
try {
    $conn = new Connection();
    $mm = new MenuManager($conn);
    $catagories = $mm->getAllMenuCatagories();
} catch (Exception $e) {
    die($e->getMessage());
}
?>
<style>
    .edit-link{
        float: right;
    }
    .add-item-link{
        font-weight: bold;
    }
</style>
<h1 class="text-center">View Menu</h1>
<br>
<div class="row">
    <?php
    foreach ($catagories as $catagory) {
        $items = array();
        try {
            $items = $mm->GetAllByCatagory($catagory->getIdCatagory());
        } catch (Exception $e) {
            die($e->getMessage());
        }
        echo '<div class="col-md-12 menu-section">
                    <h3>'.$catagory->getName().'</h3>
                    <table class="table">
                        <thead><tr>
                            <th scope="col">ID</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Short Name</th>
                            <th scope="col">Price</th>
                            <th></th>
                        </tr></thead>
                        <tbody>';
        foreach ($items as $item){
            echo '<tr>
                    <th scope="row">'.$item->getIdMenuItem().'</th>
                    <td>'.$item->getName().'</td>
                    <td>'.$item->getShortName().'</td>
                    <td>$'.$item->getPrice().'</td>
                    <td><a class="edit-link" href="edit_menu_item.php?id='.$item->getIdMenuItem().'">Edit</a> </td>
                </tr>';
        }
        echo '<tr>
                <td><a class="add-item-link" href="add_menu.php?cat='.$catagory->getIdCatagory().'">
                Add a new item to '.$catagory->getName().'
                </a></td>
            </tr>
            </tbody>
            </table>
        </div><!-- End Col -->';
    }
    ?>
</div>
<?php
require_once __DIR__."/includes/footer.php";
?>
