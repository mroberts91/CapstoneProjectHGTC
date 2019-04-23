<?php

use Connection\Connection;
use Menu\MenuManager;

require_once __DIR__."/includes/header.php";
require_once __DIR__."/../Data/managers/MenuManager.php";
$catId = (isset($_GET['id']))? $_GET['id'] : null;
$cat = null;
if ($catId == null){
    echo '<script>window.location = "menu_catagories.php"</script>';
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    try {
        $id_Cat = (int)trim($_POST['category']);
        $newName = trim($_POST['catName']);
        $hidden = (isset($_POST['hideItem']))? 1 : 0;
        $man = new MenuManager(new Connection());
        $man->updateMenuCategoryName($id_Cat, $newName, $hidden);
        echo "<script>window.location = 'menu_catagories.php'</script>";
    } catch (Exception $e) {
        die($e->getMessage());
    }
}
try {
    $db = new Connection();
    $mm = new MenuManager($db);
    $cat = $mm->getCategoryByID($catId);
} catch (Exception $e) {
    die($e->getMessage());
}
?>
<style>
    .flex-center{
        display: flex;
        justify-content: center;
    }
    #form-container{
        width: 45%;
    }
</style>
<h1 class="text-center">Edit <?php echo $cat->getName()?> Category</h1>
<br>
<div class="flex-center">
<div class="form-group" id="form-container">
    <form action="<?php echo $_SERVER['PHP_SELF'].'?id='. $cat->getIdCatagory();?>" method="post">
        <input type="hidden" value="<?php echo $cat->getIdCatagory()?>" name="category">
        <label for="catName">New Category Name</label>
        <input class="form-control" id="catName" name="catName" value="<?php echo $cat->getName() ?>">
        <br>
        <label for="hideItem">Remove category from menu?</label>
        <input class="" type="checkbox" id="hideItem" name="hideItem">
        <br>
        <input class="btn btn-primary" type="submit">
    </form>
</div>
</div>
<?php
require_once __DIR__."/includes/footer.php";
?>