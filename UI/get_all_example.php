<?php
use Connection\Connection;
use Menu\MenuManager;
require_once __DIR__."/../Data/init.php";
require_once __DIR__."/../Data/db/Connection.php";
require_once __DIR__."/../Data/managers/MenuManager.php";
try{
    // Create a new PDO Connection for injecting to the Manager
    $db = new Connection();
    // Create a new manager that querys the DB
    $mm = new MenuManager($db);
    // Returns and array of MenuItem DTO objects
    $q = $mm->GetAllMenuItems();
    echo '<br><br>';
} catch (Exception $e){
    die($e->getMessage());
}

// Echo each object as human readable data.
?>
<h1>PipelinesTest</h1>
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
<?php
// Dump of the MenuItem[]
print_r($q);
?>
