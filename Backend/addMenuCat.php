<?php

use Connection\Connection;
use Menu\MenuManager;
require_once __DIR__."/includes/header.php";
require_once __DIR__."/../Data/managers/MenuManager.php";
$newCatNumber = null;
$categories = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['submitNewCat'])){
        try {
            $newName = trim($_POST['newName']);
            $newCat = trim($_POST['newCat']);
            $db = new Connection();
            $menuMan = new MenuManager($db);
            $menuMan->createNewMenuCategory($newCat, $newName);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
try {
    $db = new Connection();
    $mm = new MenuManager($db);
    $categories = $mm->getAllMenuCatagories();
    $newCatNumber = $mm->getNewMenuCategory();
} catch (Exception $e) {
    die($e->getMessage());
}
?>
<style>

</style>
<h1 class="text-center">Create New Menu Category</h1>
<br>
<br>
<div class="row">
    <div class="col-md-12 col-xl-6">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="newName">New Category Name</label>
            <br>
            <input class="form-contol" type="text" id="newName" name="newName">
            <br>
            <br>
            <input class="form-contol" type="hidden" id="newCat" name="newCat"
                   value="<?php echo $newCatNumber; ?>">
            <input type="submit" id="submitNewCat" name="submitNewCat" class="btn btn-primary" value="Create">
        </form>
    </div>
    <div class="col-md-12 col-xl-6">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Categories</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($categories as $c) {
                echo '
                    <tr>
                        <td scope="row">'.$c->getName().'</td>
                    </tr>
                ';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<?php
require_once __DIR__."/includes/footer.php";
?>