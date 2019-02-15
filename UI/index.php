<?php
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
    // Dump the array
    print_r($q);
    // Echo each object as human readable data.
    echo '<br><br>';
    foreach ($q as $menuItem){
        echo $menuItem->id_MenuItem ."<br>";
        echo $menuItem->ItemName."<br>";
        echo $menuItem->ItemPrice."<br>";
        echo $menuItem->ItemCat."<br>";
        echo "<br><br>";
    }
} catch (Exception $e){
    die($e->getMessage());
}
