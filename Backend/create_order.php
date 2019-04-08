<?php

use Connection\Connection;
use Menu\MenuManager;
use Menu\MenuItem;
require_once __DIR__ . "/includes/header.php";
require_once __DIR__."/../Data/managers/MenuManager.php";
require_once __DIR__."/../Data/dto/MenuItem.php";
$errormsg = '';
$mm = null;
try {
    $db = new Connection();
    $mm = new MenuManager($db);
} catch (Exception $e) {
    $errormsg .= '<p>'.$e->getMessage().'</p>';
}
?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>

    .menuItem{
        background-color: #c9af98 !important;
        border-color: #c9af98 !important;
        color: #FFF;
        font-size: 115%;
        height: 150px;
        width: 300px;
        border: 1px solid;
        margin: .2em .5em;
        padding: 1em;
    }
    .menuItem:hover{
        background-color: #DAA520 !important;
    }
    #tabs{
        font-size: 115%;
    }
    #tabs ul li{
        margin: 0 .3em;
    }
    .ui-state-active{
        background-color: #3a4660 !important;
        border-color: #3a4660 !important;
    }
    .ui-tabs-active{
        background-color: #3a4660 !important;
        border-color: #3a4660 !important;
    }

</style>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/order/create_order.js"></script>
<h1 class="text-center">Order Entry</h1>
<br>
<div class="row">
    <div class="col-md-12">
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Appitizers</a></li>
            <li><a href="#tabs-2">Entr&eacute;es & Salads</a></li>
            <li><a href="#tabs-3">Desserts</a></li>
            <li><a href="#tabs-4">Beverages</a></li>
        </ul>
        <div id="tabs-1">
            <div class="row">
            <?php
            try {
                $apps = $mm->GetAllByCatagory(10);
                foreach ($apps as $a){
                    echo '<div class="btn col-md-2 menuItem appItem" id="'.$a->getIdMenuItem().'">';
                    echo '<p>'.$a->getShortName().'</p>';
                    echo '<p>'.$a->getPrice().'</p>';
                    echo '</div>';
                }
            } catch (Exception $e) {
                $errormsg .= '<p>Get all appatizers -- '.$e->getMessage().'</p>';
            }
            ?>
            </div>
        </div>
        <div id="tabs-2">
            <?php
            try {
                $meals = $mm->GetAllByCatagory(20);
                foreach ($meals as $a){
                    echo '<div class="btn btn-secondary col-md-2 menuItem entreeItem" id="'.$a->getIdMenuItem().'">';
                    echo '<p>'.$a->getShortName().'</p>';
                    echo '<p>'.$a->getPrice().'</p>';
                    echo '</div>';
                }
            } catch (Exception $e) {
                $errormsg .= '<p>Get all Entrees -- '.$e->getMessage().'</p>';
            }
            ?>
        </div>
        <div id="tabs-3">
            <?php
            try {
                $desserts = $mm->GetAllByCatagory(30);
                foreach ($desserts as $a){
                    echo '<div class="btn btn-secondary col-md-2 menuItem dessertItem id="'.$a->getIdMenuItem().'">';
                    echo '<p>'.$a->getShortName().'</p>';
                    echo '<p>'.$a->getPrice().'</p>';
                    echo '</div>';
                }
            } catch (Exception $e) {
                $errormsg .= '<p>Get all desserts -- '.$e->getMessage().'</p>';
            }
            ?>
        </div>
        <div id="tabs-4">
            <?php
            try {
                $drinks = $mm->GetAllByCatagory(40);
                foreach ($drinks as $a){
                    echo '<div class="btn btn-secondary col-md-2 menuItem bevItem" id="'.$a->getIdMenuItem().'">';
                    echo '<p>'.$a->getShortName().'</p>';
                    echo '<p>'.$a->getPrice().'</p>';
                    echo '</div>';
                }
            } catch (Exception $e) {
                $errormsg .= '<p>Get all drinks -- '.$e->getMessage().'</p>';
            }
            ?>
        </div>
    </div>
    </div>
</div>
<?php
echo $errormsg;
require_once __DIR__ . "/includes/footer.php";
?>