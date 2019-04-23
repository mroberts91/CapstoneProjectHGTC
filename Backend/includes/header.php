<?php
use Connection\Connection;
use Connection\ConnectionDataFactory;
use Connection\ConnectionData;
use Core\Department;
require_once __DIR__ ."/session.php";
require_once __DIR__ . "/loggedInCheck.php";
require_once __DIR__ ."/init.php";
require_once __DIR__ ."/functions.php";
require_once __DIR__."/../../Data/db/Connection.php";
require_once __DIR__."/../../Data/db/ConnectionData.php";
require_once __DIR__."/../../Data/common/ConnectionDataFactory.php";
require_once __DIR__."/../../Data/enum/Department.php";
require_once __DIR__."/../../Data/enum/Department.php";
$empID = $_SESSION['user_id'];
$isLoginPage = (end(explode('/', $_SERVER['PHP_SELF'])) == 'login.php')? true : false;
$isAdmin = false;
if (isset($_SESSION['user_perm_level']) && !empty($_SESSION['user_perm_level'])){
    $isAdmin = ($_SESSION['user_perm_level'] == Department::$ADMIN ||
                $_SESSION['user_perm_level'] == Department::$MANAGER)? true : false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>JT's Admin Portal</title>
    <link rel="icon" type="image/png" href="../UI/images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../UI/images/favicon-16x16.png" sizes="16x16" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="styles/main.css" />
    <link rel="stylesheet" type="text/css" href="styles/navbar.css" />
    <script src="js/jquery.min.js"></script>
</head>
<body>
<?php
    if (!$isLoginPage){
        require_once __DIR__."/nav.php";
        echo '<div class="container">';
    }
?>