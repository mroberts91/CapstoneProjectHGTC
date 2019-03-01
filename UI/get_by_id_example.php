<?php
use Connection\Connection;
use Menu\MenuManager;
require_once __DIR__."/../Data/init.php";
require_once __DIR__."/../Data/db/Connection.php";
require_once __DIR__."/../Data/managers/MenuManager.php";
try{
    $db = new Connection();
    $mm = new MenuManager($db);
    $id = $_GET['id'];
    $id = (int)$id;
    $q = $mm->GetItemById($id);
    print_r($q);
    echo '<br><br>';


} catch (Exception $e){
    die($e->getMessage());
}
?>
<table border>
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Price</th>
            <th>Catagory</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach ($q as $menuItem){
        echo '<tr>';
        echo '<td>'.$menuItem->getID()."</td>";
        echo '<td>'.$menuItem->getName()."</td>";
        echo '<td>'.$menuItem->getPrice()."</td>";
        echo '<td>'.$menuItem->getCatagory()."</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
