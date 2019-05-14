<?php

use Connection\Connection;
use Menu\MenuManager;

require_once __DIR__."/header.php";
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
<link rel="stylesheet" href="styles/menuItem.css">
<style>
    .price{
        float: right;
    }
    h3{
        margin-top: .5em;
    }
</style>
<br>
<div class="wrapper">
    <h1 class="title text-center">Our Menu</h1>
    <br>
    <div class="row">
        <div class="col-md-2 d-none d-lg-block">
            <div class="row">
                <div class="col" id="pic4"></div>
            </div>
            <div class="row">
                <div class="col" id="pic5"></div>
            </div>
            <div class="row">
                <div class="col" id="pic6"></div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8" id="menu-container">
            <div class="row" id="table-div">
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
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr></thead>
                        <tbody>';
                    foreach ($items as $item){
                        echo '<tr>
                    <td scope="row">'.$item->getName().'</td>
                    <td><span class="price">$'.$item->getPrice().'</span></td>
                     </tr>';
                         }
                         echo '
                 </tbody>
                 </table>
                 </div><!-- End Col -->';
                     }
                     ?>
            </div>
        </div>
        <div class="col-md-2 d-none d-lg-block">
            <div class="row">
                <div class="col" id="pic1"></div>
            </div>
            <div class="row">
                <div class="col" id="pic2"></div>
            </div>
            <div class="row">
                <div class="col" id="pic3"></div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'footer.php';
?>
