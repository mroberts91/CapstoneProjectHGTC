<?php

use Connection\Connection;
use Menu\MenuItem;
use Menu\MenuManager;

require_once __DIR__."/includes/header.php";
require_once __DIR__."/../Data/managers/MenuManager.php";
require_once __DIR__."/../Data/dto/MenuItem.php";
$itemID = (isset($_GET['id']) || $_GET['id'] != '') ? $_GET['id'] : null;
$item = null;
$cats = array();
$invCount = null;
if ($itemID == null){
    echo '<p class="text-center">Please go to the view page to edit items</p>';
    require_once __DIR__."/includes/footer.php";
}
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $errmsg = 1;
//    if (!isset($_POST['fullname'])){ $errmsg .= '<p>Item full name is required</p>'; }
//    if (!isset($_POST['shortname'])){ $errmsg .= '<p>Item short name is required</p>'; }
//    if (!isset($_POST['price'])){ $errmsg .= '<p>Item price is required</p>'; }
//    if (!isset($_POST['cat'])){ $errmsg .= '<p>Item category name is required</p>'; }
    if ($errmsg != null){
        $updateItem = new MenuItem();
        $updateItem->setIdMenuItem($itemID);
        $updateItem->setName($_POST['fullname']);
        $updateItem->setShortName($_POST['shortname']);
        $updateItem->setPrice((float)$_POST['price']);
        $updateItem->setIdCatagory($_POST['cat']);
        $newCount = (int)$_POST['inventory'];
        try {
            $db = new Connection();
            $mman = new MenuManager($db);
            $mman->updateMenuItem($updateItem);
            $mman->updateInventory($newCount, $updateItem->getIdMenuItem());
            echo '<script>alert("Menu item updated succesfully!")</script>';

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }else{
        $errmsg .= 'There are Errors';
        echo '<script>alert("'.$errmsg.'")</script>';
    }
}
try {
    $db = new Connection();
    $mm = new MenuManager($db);
    $item = $mm->GetItemById($itemID);
    $cats = $mm->getAllMenuCatagories();
    $invCount = $mm->getInventoryCount($itemID);
    $invCount = ($invCount == null )? 0 : $invCount;
} catch (Exception $e) {
    die($e->getMessage());
}
if ($item == null || count($cats) < 1){
    die('Errrr');
}
?>
<style>
    .row{
        display: flex;
        justify-content: center;
    }
</style>
<br>
<h1 class="text-center"><?php echo 'Edit ' . $item->getName(); ?></h1>
<div class="row">
    <div class="form-container">
    <form class="form-group" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="fullname">Full Name</label>
        <input class="form-control" id="fullname" name="fullname" type="text"
               value="<?php echo $item->getName() ?>" required>
        <label for="shortname">Short Name</label>
        <input class="form-control" id="shortname" name="shortname" type="text"
               value="<?php echo $item->getShortName() ?>" required>
        <label for="price">Price</label>
        <input class="form-control" id="price" name="price" type="text"
               value="<?php echo $item->getPrice() ?>" required>
        <label for="cat">Category</label>
        <select class="form-control" id="cat" name="cat" required>
            <?php
                foreach ($cats as $c){
                    $sel = ($c->getIdCatagory() == $item->getIdCatagory()) ? 'selected' : '';
                    echo '<option value="'. $c->getIdCatagory().'" '.$sel.'>'.$c->getName().'</option>';
                }
            ?>
        </select>
        <label for="inventory">Units in Inventory</label>
        <input class="form-control" type="number" id="inventory" name="inventory"
            value="<?php echo $invCount ?>">
        <br>
        <input type="submit" class="btn btn-primary" value="Submit">
    </form>
    </div>
</div>
<?php
require_once __DIR__."/includes/footer.php";
?>