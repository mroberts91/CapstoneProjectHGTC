<?php
require_once __DIR__ . "/includes/header.php";
?>
<!--
    !*!*!*! PLACE CONTENT HERE !*!*!*!
    Header and footer already contain the outer container div
     which give a margin on the left and right sides of the page.
 -->
    <h1 class="text-center">Welcome to the<br>Adminitrative Portal</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div id="home-logo"></div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

<?php
// This is just here to test to make sure data is being stored in Session variable
//echo $_SESSION['user_id'];
//echo '<br>';
//echo $_SESSION['user_name'];
//echo '<br>';
//echo $_SESSION['user_perm_level'];
//echo '<br>';
//echo $_SESSION['user_department'];
//echo '<br>';
//var_dump($_SESSION['full_user']);
require_once __DIR__ . "/includes/footer.php";
