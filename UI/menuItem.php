<?php

require_once  'header.php';
//DATABASE CONNECTION
require_once "conn.php";

$sqlselect = "SELECT * from menu_MenuItem where id_Category = '10'";
$result = $db->prepare($sqlselect);
$result->execute();
$result = $db-> query($sqlselect);

$sqlselect2 = "SELECT * from menu_MenuItem where id_Category = '20'";
$result2 = $db->prepare($sqlselect2);
$result2->execute();
$result2 = $db-> query($sqlselect2);

$sqlselect3 = "SELECT * from menu_MenuItem where id_Category = '30'";
$result3 = $db->prepare($sqlselect3);
$result3 ->execute();
$result3 = $db-> query($sqlselect3);

$sqlselect4 = "SELECT * from menu_MenuItem where id_Category = '40'";
$result4 = $db->prepare($sqlselect4);
$result4 ->execute();
$result4 = $db-> query($sqlselect4);


?>
<link rel="stylesheet" href="styles/menuItem.css">
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
            <div class="menu" align="center"al>
                <H2>Appetizers</H2>
                <?php
                while ( $row = $result-> fetch() )
                {
                    echo '<tr><td>' . $row['Name'] . '</td><td> ' . $row['Price'] . '</td></tr><br>';
                }
                ?>
                <H2>Entrees and Salads</H2>
                <?php
                while ( $row = $result2-> fetch() )
                {
                    echo '<tr><td>' . $row['Name'] . '</td><td> ' . $row['Price'] . '</td></tr><br>';
                }
                ?>
                <H2>Desserts</H2>
                <?php
                while ( $row = $result3 -> fetch() )
                {
                    echo '<tr><td>' . $row['Name'] . '</td><td> ' . $row['Price'] . '</td></tr><br>';
                }
                ?>
                <H2>Beverages</H2>
                <?php
                while ( $row = $result4 -> fetch() )
                {
                    echo '<tr><td>' . $row['Name'] . '</td><td> ' . $row['Price'] . '</td></tr><br>';
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
