<?php
use Connection\Connection;
use Menu\MenuManager;
require_once __DIR__."/includes/header.php";
require_once __DIR__."/../Data/managers/MenuManager.php";
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
    .flex-center{
        display: flex;
        justify-content: center;
    }
    #cat-container{
        width: 60%;
    }
</style>
<h1 class="text-center">Menu Categories</h1>
<br>
<div class="flex-center">
    <div id="cat-container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Category Name</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($catagories as $c) {
                echo "<tr>";
                echo "<td scope='row'>".$c->getName()."</td>";
                echo "<td><a href='edit_cat.php?id=".$c->getIdCatagory()."'>Edit</a></td>";
                echo "</tr>";
            }
            ?>
            <tr>
                <th><a href="addMenuCat.php">Add new category</a></th>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
require_once __DIR__."/includes/footer.php";
?>
