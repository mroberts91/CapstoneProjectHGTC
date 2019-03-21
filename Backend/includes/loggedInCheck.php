<?php
$url = $_SERVER['PHP_SELF'];
$page = end(explode("/", $url));
if ($page != 'login.php'){
    if (empty($_SESSION['user_id'])){
        header("Location: logout.php");
    }
}

